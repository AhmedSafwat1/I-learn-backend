<?php

namespace Modules\Category\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Worker\Transformers\Api\WorkerResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        // dd($this->allChildren);
        return [
           'id'            => $this->id,
           'color'         => $this->color  ? $this->color  : "",
           'image'         => url($this->image),
           'title'         => $this->translateOrDefault(locale())->title,
           "all_children"   => CategoryResource::collection($this->whenLoaded("allChildren"))
       ];
    }
}
