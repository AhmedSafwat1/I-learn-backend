<?php

namespace Modules\Learn\Entities;

use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Subject extends Model implements TranslatableContract
{
    use Translatable , SoftDeletes , ScopesTrait;
    protected $guarded 				    	= ['id'];
    protected $with 					    = ['translations'];
    public $translatedAttributes  = [ 'description' , 'title' ];
    public $translationModel 	  = SubjectTranslation::class;
}
