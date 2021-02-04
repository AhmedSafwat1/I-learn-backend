<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $guarded 				    	= ['id'];
      /**
    * The model's default values for attributes.
    *
    * @var array
    */
    protected $attributes = [
        "lesson_type"=> "both",
        "online_price" => 0,
        "house_price"   => 0
    ];
}
