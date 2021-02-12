<?php

namespace Modules\Learn\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id'            => $this->id,
            "url"           => url($this->url) ,
            "type"          => $this->type,
           
       ];
    }
}
