<?php

namespace Modules\Category\Entities;

use Modules\User\Entities\User;
use Modules\Vendor\Entities\Vendor;
use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Vendor\Entities\VendorCategories;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Category extends Model implements TranslatableContract
{
    use Translatable , SoftDeletes , ScopesTrait;

    protected $with 			 = ['translations','children'];
    protected $fillable 		 = ['status' , 'image' , 'category_id' , 'color'];

    public $translatedAttributes = ['title' , 'slug' , 'seo_description' , 'seo_keywords'];
    public $translationModel 	 = CategoryTranslation::class;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    

    public function vendors()
    {
        return $this->belongsToMany(
            Vendor::class,
            'vendor_categories',
            'category_id',
            "vendor_id"
        );
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_categories',
            'category_id',
            "user_id"
        );
    }



    public function vendorCategories()
    {
        return $this->hasMany(VendorCategories::class, 'category_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function allChildren()
    {
        return $this->children()
                    ->active()
                    ->orderBy("sort", "asc")
                     ->orderBy('id', 'DESC')
                    ->with(['allChildren'=>function ($query) {
                        $query->active()
                    ->orderBy("sort", "asc")
                    ->orderBy('id', 'DESC');
                    }]);
    }

    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while (!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }

   
}
