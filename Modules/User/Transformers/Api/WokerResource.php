<?php

namespace Modules\User\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\Area\Transformers\Api\CountryResource;
use Modules\Social\Repositories\Api\SocialRepository;
use Modules\Category\Transformers\Api\CategoryResource;

class WokerResource extends JsonResource
{
    
    public function toArray($request)
    {
       
        return [
           'id'            => $this->id,
           'name'          => $this->name ,
           'image'         => url($this->image),
           "email"         => $this->email ?? "",
           "phone_code"    => $this->phone_code,    
           'mobile'        => $this->mobile,
           "is_active"     => $this->is_active ? 1 : 0, 
           "description"   => $this->description, 
           "lat"           => $this->lat,
           "lng"           => $this->lng ,
           "location"      => $this->location ?? "" ,
           "distance"      => $this->distance ?? "", 
           "categories"    => CategoryResource::collection($this->whenLoaded("categories")) ,

           
       ];
    }
    
   
}
