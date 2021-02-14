<?php

namespace Modules\Learn\Transformers\Api;

use Modules\User\Transformers\Api\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Learn\Transformers\Api\AttachResource;
use Modules\Learn\Transformers\Api\SubjectResource;

class LessonResource extends JsonResource
{
    public function toArray($request)
    {
        
        return [
           'id'            => $this->id,
           "price"         => $this->price ,
           "title"         => $this->title ?? "", 
           "note"          => $this->note ?? "" ,
           "student"       => new UserResource($this->whenLoaded("student"))   ,
           "subject"       => new SubjectResource($this->whenLoaded("subject"))   ,
           "teacher"       => new UserResource($this->whenLoaded("teacher")) ,
           "created_at"    => $this->created_at->format("d-m-Y h:i a"),
           "status"        => $this->status ?? "wait" ,
           "is_free"       => $this->is_free ,
           "is_paied"      =>$this->is_paied ,
           "start_at"      => $this->start_at->format("d-m-Y , h:i a") ,
           "end_at"        => $this->end_at->format("d-m-Y h:i a")   ,
           "duration"      => $this->duration,
           "type"          => $this->type   ,
           "is_running"    => $this->isRuuning()
       ];
    }
}
