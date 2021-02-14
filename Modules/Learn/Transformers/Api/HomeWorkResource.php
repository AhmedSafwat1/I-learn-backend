<?php

namespace Modules\Learn\Transformers\Api;

use Modules\User\Transformers\Api\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Learn\Transformers\Api\AttachResource;

class HomeWorkResource extends JsonResource
{
    public function toArray($request)
    {
        
        return [
           'id'            => $this->id,
           "price"         => $this->price ,
           "title"         => $this->title, 
           "note"          => $this->note ?? "" ,
           "student"       => new UserResource($this->whenLoaded("student"))   ,
           "teacher"       => new UserResource($this->whenLoaded("teacher")) ,
           "created_at"    => $this->created_at->format("d-m-Y h:i a"),
           "attachs"       => AttachResource::collection($this->whenLoaded("attachs")) ,
           "solution"      => new HomeWorkSolutionResource($this->whenLoaded("solution")) ,
           "status"        => $this->status ?? "wait" ,
           "is_free"       => $this->is_free ,
           "is_paied"      =>$this->is_paied
       ];
    }
}
