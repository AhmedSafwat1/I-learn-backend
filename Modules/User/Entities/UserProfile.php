<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Concerns\AvailabityTrait;

class UserProfile extends Model
{
    use AvailabityTrait;
    protected $guarded 				    	= ['id'];
      /**
    * The model's default values for attributes.
    *
    * @var array
    */
    protected $attributes = [
        "lesson_type"=> "both",
        "online_price" => 0,
        "house_price"   => 0,
        "working"       => [],
        "offs"          => [],  
    ];


    protected $casts = [
      'working' => 'array',
      "offs"    => "array"
    ];
}
