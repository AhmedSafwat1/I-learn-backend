<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\User\Transformers\Api\UserResource;
use Modules\Apps\Http\Controllers\Api\ApiController;

use Modules\User\Transformers\Api\TeacherResource;
use Modules\User\Repositories\Api\TeacherRepository as User;


class TeacherController extends ApiController
{
    function __construct(User $user)
    {
        
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $users =  $this->user->getAllActive($request ,["sections","subjects","profile"]);
        return $this->responsePagnation(
            UserResource::collection($users)
        );
    }

    public function show(Request $request, $id)
    {
        $user  =  $this->user->findById($id ,["sections","subjects","profile"]);
        if(!$user) return $this->notFoundResponse();
        return $this->response(
            new TeacherResource($user)
        );
        
    }

   



    
}
