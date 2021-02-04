<?php

namespace Modules\Learn\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Learn\Transformers\Api\SubjectResource as ModelResource;

use Modules\Learn\Repositories\Api\SubjectRepository as Repo;

class SubjectController extends ApiController
{

    function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $repos =  $this->repo->getAllActive();

    
        return ModelResource::collection($repos);
    }

}
