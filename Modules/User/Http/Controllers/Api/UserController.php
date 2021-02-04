<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\User\Transformers\Api\UserResource;
use Modules\User\Transformers\Api\WokerResource;
use Modules\User\Http\Requests\Api\ResetPassword;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\User\Http\Requests\Api\UpdateProfileRequest;
use Modules\User\Repositories\Api\UserRepository as User;

use Modules\User\Http\Requests\Api\UserSettingUpdateRequest;
use Modules\User\Transformers\Api\Notification\UserNotiifcationResource;
use Modules\User\Transformers\Api\Notification\UserNotiifcationCollection;

class UserController extends ApiController
{
    function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getWorkers(Request $request)
    {
        $users =  $this->user->getWorkers($request);
        return $this->responsePagnation(
            WokerResource::collection($users)
        );
    }

    public function profile()
    {
        $user =  $this->user->userProfile();
        if($user->type == "teacher") $user->loadMissing(["subjects", "sections", "profile"]);
        return $this->response(new UserResource($user));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->user->update($request);

        $user =  $this->user->userProfile();

        return $this->response(new UserResource($user));
    }

    public function resetPassword(ResetPassword $request){
        $user = auth()->user();
        if(!Hash::check($request->current_password, $user->password)) {
            return $this->invalidData(["current_password"=>__("user::api.users.validation.password.not_correct")]);
        }
        $this->user->updatePassword($user, $request);
        return $this->response([]);
    }

    public function updateSetting(UserSettingUpdateRequest $request){
        $this->user->updateSetting($request);
        return $this->response([]);
    }

   
    public function testFcm(Request $request){
      
       
        
       
    }


   
    public function notifications(Request $request){
        $notifications = auth()->user()->notifications()->latest()->
                        paginate($request->page_count ?? env("PAGE_COUNT", 15));
        return $this->responsePagnation(
            new UserNotiifcationCollection($notifications)
        );   
    }



    
}
