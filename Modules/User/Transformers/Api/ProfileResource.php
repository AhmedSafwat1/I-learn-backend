<?php

namespace Modules\User\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\Area\Transformers\Api\CountryResource;
use Modules\Social\Repositories\Api\SocialRepository;
use Modules\Category\Transformers\Api\CategoryResource;

class ProfileResource extends JsonResource
{
    
    public function toArray($request)
    {
        
       
        return [
           'id'            => $this->id,
           'description'   => $this->description ,
           "lesson_type"   => $this->lesson_type,
           "online_price"  => $this->online_price, 
           "house_price"   => $this->house_price,  
         
           
       ];
    }

   
    
   
}
