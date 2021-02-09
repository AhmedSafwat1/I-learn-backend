<?php

namespace Modules\User\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'id'            => $this->id,
           'name'          => $this->name,
           'email'         => $this->email,
           'mobile'        => "0".$this->phone_code ."".$this->mobile,
           'image'         => url($this->image),
           "is_active"     => $this->is_active,
           "is_verified"    => $this->is_verified ,
           "gender"        => __('user::dashboard.users.create.form.'.$this->gender), 
           'deleted_at'    => $this->deleted_at,
           'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
       ];
    }
}
