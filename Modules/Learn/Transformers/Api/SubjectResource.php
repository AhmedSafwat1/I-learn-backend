<?php

namespace Modules\Learn\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id'            => $this->id,
           'color'         => $this->color,
           'title'         => $this->translateOrDefault(locale())->title,
           "image"         => $this->image ? url($this->image) : "",
       ];
    }
}
