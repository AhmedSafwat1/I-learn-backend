<?php

namespace Modules\Learn\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id'            => $this->id,
           'color'         => $this->color,
           "status"        => $this->status, 
           'title'         => $this->translateOrDefault(locale())->title,
           'description'         => $this->translateOrDefault(locale())->description,
           "image"         => $this->image ? url($this->image) : "",
           'deleted_at'    => $this->deleted_at,
           'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
       ];
    }
}
