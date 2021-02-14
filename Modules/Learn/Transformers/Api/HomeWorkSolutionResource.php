<?php

namespace Modules\Learn\Transformers\Api;

use Modules\User\Transformers\Api\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Learn\Transformers\Api\AttachResource;
use Modules\Learn\Transformers\Api\HomeWorkResource;

class HomeWorkSolutionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id'            => $this->id,
           "note"          => $this->note ?? "" ,
           "attachs"       => AttachResource::collection($this->whenLoaded("attachs")) ,
           "homework"      => new HomeWorkResource($this->whenLoaded("homework")) ,
           "created_at"    => $this->created_at->format("d-m-Y h:i a"),
       ];
    }
}
