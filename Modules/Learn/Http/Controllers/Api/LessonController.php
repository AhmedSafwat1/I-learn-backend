<?php

namespace Modules\Learn\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Learn\Entities\HomeWorkAttach;
use Modules\Apps\Http\Controllers\Api\ApiController;

use Modules\Learn\Http\Requests\Api\LessonStoreRequest;
use Modules\Learn\Repositories\Api\LessonRepository as Repo;
use Modules\Learn\Transformers\Api\LessonResource as ModelResource;

class LessonController extends ApiController
{
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function running(Request $request)
    {
        $with = auth()->user()->type == "student" ? ["subject","teacher"] : ["subject","student"];
        $lessons = $this->repo->getRunnigForUser($request, $with)  ;

        return $this->responsePagnation(
            ModelResource::collection($lessons)
        )
       ;
    }

    public function previous(Request $request)
    {
        $with = auth()->user()->type == "student" ? ["subject","teacher"] : ["subject","student"];
        $lessons = $this->repo->getPreviousForUser($request, $with)  ;

        return $this->responsePagnation(
            ModelResource::collection($lessons)
        )
       ;
    }

    public function incomming(Request $request)
    {
        $with = auth()->user()->type == "student" ? ["subject","teacher"] : ["subject","student"];
        $lessons = $this->repo->getInCommingForUser($request, $with)  ;

        return $this->responsePagnation(
            ModelResource::collection($lessons)
        )
       ;
    }

  

    public function show(Request $request, $id)
    {
        $homework = $this->repo->findByIdTalent($id, ["subject"])  ;
    
        return $this->response(
            new ModelResource($homework)
        )
       ;
    }


    public function store(LessonStoreRequest $request)
    {
        $model  =   $this->repo->create($request);
        return $this->response(
            [
                "lesson" => new ModelResource($model)  ,
                "url"      =>  $model->is_free == false ? $this->repo->getUrlForPayment($model) : ""
            ]
        );
    }

    public function update(LessonStoreRequest $request, $id)
    {
        $model  =   $this->repo->update($request, $id);
        return $this->response(
            new HomeWorkResource($model)
        );
    }
}
