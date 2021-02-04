<?php

namespace Modules\User\Entities;

use Modules\Auction\Entities\Bid;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Modules\Area\Entities\Country;
use Modules\Learn\Entities\Subject;
use Modules\Core\Traits\ScopesTrait;
use Modules\Section\Entities\Section;
use Modules\Category\Entities\Category;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Modules\User\Concerns\ForCountryTelant;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\DeviceToken\Entities\DeviceToken;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Modules\Core\Filters\Search\SearchManager;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Translation\HasLocalePreference;

class User extends Authenticatable
{
    use Notifiable , ScopesTrait , HasApiTokens;
    use LaratrustUserTrait,  SearchManager;
    use ForCountryTelant;

    use SoftDeletes ;

    protected $dates = [
      'deleted_at'
    ];

    protected $with = [
        "country"
    ];

 
    /**
    * The model's default values for attributes.
    *
    * @var array
    */
    protected $attributes = [
        'is_active' => 1,
    ];
  
    protected $fillable = [
        'name', 'email', 'password', 'mobile' , 'image' , 'phone_code',"is_verified",
         "is_active", "code_verified","setting", "country_id","type" ,"gender"
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        "setting" => "array" ,
    ];

    

    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class, "user_id");
    }


    public function sections()
    {
        return $this->belongsToMany(Section::class, "user_sections", "user_id", "section_id")
                  ->withTimestamps();
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, "user_subjects", "user_id", "subject_id")
                  ->withTimestamps();
    }

    public function profile(){
        return $this->hasOne(UserProfile::class, "user_id");
    }
   

   

    
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function scopeStudentUser($query)
    {
        return $query->where('type', "student");
    }

    public function scopeTeacherUser($query)
    {
        return $query->where('type', "teacher");
    }

    public function scopeAdminUser($query)
    {
        return $query->where('type', "admin");
    }

    

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }


    
   

    public function preferredLocale()
    {
        return isset($this->setting["lang"]) ? $this->setting["lang"] :locale();
    }


   

    public function scopeSearchFilter($query, &$request , $withCategories= false)
    {
        $query->where(function ($query) use (&$request, &$withCategories) {
            $query->where("name", 'like', '%'. $request->input('search') .'%')
            ->orWhere("name", 'description', '%'. $request->input('search') .'%');

            if($withCategories){
                $query->orWhereHas("categories.translations", function ($category) use (&$request) {
                    $category->where('description', 'like', '%'. $request->input('search') .'%')
                         ->orWhere('title', 'like', '%'. $request->input('search') .'%');
                });
            }
            
        });
    }
}
