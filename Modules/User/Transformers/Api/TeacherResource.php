<?php

namespace Modules\User\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\Learn\Transformers\Api\SubjectResource;
use Modules\Section\Transformers\Api\SectionResource;
use Modules\Category\Transformers\Api\CategoryResource;
use Modules\User\Transformers\Api\ProfileWorkingResource;

class TeacherResource extends JsonResource
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
            "gender"        => $this->gender ,
            "type"          => $this->type,
            "sections"      => SectionResource::collection($this->whenLoaded("sections")), 
            "subjects"      => SubjectResource::collection($this->whenLoaded("subjects")),     
            "profile"       => new ProfileWorkingResource($this->whenLoaded("profile"))  ,         
       ];
    }

  
    
   
}
