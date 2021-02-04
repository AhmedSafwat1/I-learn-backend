<?php

namespace Modules\Section\Entities;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\ScopesTrait;

class Section extends Model implements TranslatableContract
{
  	use Translatable , SoftDeletes , ScopesTrait;

    protected $with               = [ 'translations' ];
  	protected $fillable 		  = [ 'status' , 'color', "image"];
  	public $translatedAttributes  = [ 'description' , 'title' , 'slug'];
    public $translationModel 	  = SectionTranslation::class;

    


    public function scopeExcludeBase($query)
		{
//				return $query->WhereNotIn('id',[1,2,3,4]);
                return $query;
		}



}
