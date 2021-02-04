<?php

namespace Modules\Authentication\Http\Controllers\Api\UserApp;

use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Modules\User\Transformers\Api\UserResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Authentication\Foundation\Authentication;
use Modules\DeviceToken\Repositories\Api\DeviceTokenRepository;
use Modules\Authentication\Http\Requests\Api\UserApp\LoginRequest;
use Modules\Authentication\Http\Requests\Api\UserApp\ResendCodeRequest;
use Modules\Authentication\Repositories\Api\UserApp\AuthenticationRepository;

class LoginController extends ApiController
{
    use Authentication;

    function __construct(AuthenticationRepository $user)
    {
        $this->user = $user;
    }

    public function postLogin(LoginRequest $request)
    {
       
        $user =  $this->loginApp($request);

        

        if ($user instanceof User)
            return $this->tokenResponse($user);
        return $this->invalidData($user, [], 422);     
       
    }

    public function tokenResponse($user = null)
    {
        $user = $user ? $user : auth()->user();
        if($user->type == "teacher") $user->loadMissing(["subjects", "sections", "profile"]);
        $token = $this->generateToken($user);

        return $this->response([
            'access_token' => $token->accessToken,
            'user'         => new UserResource($user),
            'token_type'   => 'Bearer',
            'expires_at'   => $this->tokenExpiresAt($token)
        ]);
    }

    public function logout(Request $request)
    {
        $this->user->resetDevciceToken(auth()->user());
        $user = auth()->user()->token()->revoke();

        return $this->response([], __('authentication::api.logout.messages.success') );
    }

    
}
