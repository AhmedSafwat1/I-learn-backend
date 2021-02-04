<?php

namespace Modules\Learn\Repositories\Api;

use Modules\Learn\Entities\Subject as Model;

class SubjectRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        return $this->model->active()->orderBy($order, $sort)->get();
    }

    

    public function findById($id, $with=[])
    {
        return $this->model->with($with)->active()->where('id', $id)->first();
    }
}
