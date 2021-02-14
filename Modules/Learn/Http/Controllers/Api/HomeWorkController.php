<?php

namespace Modules\Learn\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Learn\Entities\HomeWorkAttach;
use Modules\Apps\Http\Controllers\Api\ApiController;

use Modules\Learn\Http\Requests\Api\SolutionRequest;
use Modules\Learn\Transformers\Api\HomeWorkResource;
use Modules\Learn\Http\Requests\Api\HomeWorkStoreRequst;
use Modules\Learn\Transformers\Api\HomeWorkSolutionResource;
use Modules\Learn\Repositories\Api\HomeWorkRepository as Repo;
use Modules\Learn\Transformers\Api\HomeWorkResource as ModelResource;

class HomeWorkController extends ApiController
{

    function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        
        $homeworks = $this->repo->getAllForUser($request, ["attachs", "solution.attachs"])  ;

        return $this->responsePagnation(
            ModelResource::collection($homeworks)
        )
       ;
    }

    public function getSolutions(Request $request)
    {
        
        $homeworks = $this->repo->getSolutionsStudent($request, ["attachs", "homework.attachs"])  ;

        return $this->responsePagnation(
            HomeWorkSolutionResource::collectionp($homeworks)
        )
       ;
    }


    public function show(Request $request, $id)
    {
        $homework = $this->repo->findByIdTalent($id, ["solution.attachs"])  ;
    
        return $this->response(
            new ModelResource($homework)
        )
       ;
    }

    public function download(Request $request, $id)
    {
    
        $attach = HomeWorkAttach::whereNotNull("url")->where("id",$id)->firstOrFail();
        $path = str_replace("storage", "app/public", $attach->url);
        return response()->download(storage_path($path));
        // dd($attach);
    }

    public function deleteAttach(Request $request, $id)
    {
    
        $attach = HomeWorkAttach::where("id",$id)->firstOrFail();
        $attach->delete();
        return $this->response([]);
        // dd($attach);
    }



    public function solution(SolutionRequest $request, $id)
    {
        $solution = $this->repo->giveSolutionForHomeWork($id, $request)  ;
    
        return $this->response(
            new HomeWorkSolutionResource($solution)
        )
       ;
    }

    public function store(HomeWorkStoreRequst $request){
         $model  =   $this->repo->create($request);
         return $this->response(
             [
                 "homework" => new HomeWorkResource($model)  ,
                 "url"      =>  $model->is_free == false ? $this->repo->getUrlForPayment($model) : ""
             ]
             );
    }

    public function update(HomeWorkStoreRequst $request, $id){
        $model  =   $this->repo->update($request, $id);
        return $this->response(
            new HomeWorkResource($model)
            );
   }

    


}
