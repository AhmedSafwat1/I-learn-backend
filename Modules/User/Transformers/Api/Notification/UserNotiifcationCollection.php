<?php

namespace Modules\User\Transformers\Api\Notification;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\User\Transformers\Api\Notification\UserNotiifcationResource;

class UserNotiifcationCollection extends ResourceCollection
{
    public $collects = UserNotiifcationResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
