<?php

namespace Modules\Authentication\Repositories\Api\UserApp;

use Modules\User\Entities\PasswordReset;
use Modules\User\Entities\User;
use Carbon\Carbon;
use Hash;
use DB;
use Illuminate\Support\Str;

class AuthenticationRepository
{

    function __construct(User $user ,PasswordReset $password)
    {
        $this->password  = $password;
        $this->user      = $user;
    }

    public function register($request)
    {
        DB::beginTransaction();

        try {
            
            $image = $request['image'] ? getPathFileInStroage($request,"image","users") : "/uploads/users/{$request->gender}.png";
            $user = $this->user->create([
                'name'          => $request['name'],
                'email'         => $request['email'],
                "phone_code"    => $request->phone_code, 
                'mobile'        => $request['mobile'],
                "type"          => $request->type,
                "is_verified"   => $request->type == "student",
                'password'      => $request->password ? Hash::make($request['password']) : "",
                'image'         => $image,
                "gender"        => $request->gender,    
                 "setting"      => [
                     "lang" => locale()
                 ] 
            ]);

            if($user->type == "teacher"){
                $this->saveTeacherDate($user, $request);
            }
           
            DB::commit();
            return $user;

        } catch (\Exception $e) {

            DB::rollback();
            throw $e;

        }

    }

    public function findUserByEmail($request)
    {
        $user = $this->user->where('email',$request->email)->first();
        return $user;
    }

    public function createToken($request)
    {
        $user = $this->findUserByEmail($request);

        $this->deleteTokens($user);

        $newToken = strtolower(Str::random(64));

       


        $token =  $this->password->updateOrCreate(['email'       => $user->email],[
          'email'       => $user->email,
          'token'       => $newToken,
          'created_at'  => Carbon::now(),
        ]);

        $data = [
          'token' => $newToken,
          'user'  => $user
        ];

        return $data;
    }

    public function resetPassword($request)
    {
        $user = $this->findUserByEmail($request);

        $user->update([
          'password' => Hash::make($request->password)
        ]);

        $this->deleteTokens($user);

        return true;
    }

    public function deleteTokens($user)
    {
         $this->password->where('email',$user->email)->delete();
    }

    public function findUser($mobile, $phone_code){
        return  $this->user->where([
            'mobile'       => $mobile,
            'phone_code'   => $phone_code
          ]
        )->first();

    }

    public function resendCode($user){
        
        $user->update([
            "code_verified" =>generateRandomCode(5)
        ]);

    }

    public function resetDevciceToken($user){
        $user->deviceTokens()->update([
            "user_id"=> null
        ]);
    }

    public function saveTeacherDate(&$model, &$request){
        $model->sections()->sync($request->sections);
        $model->subjects()->sync($request->subjects);
        $model->profile()->create([
            "description"  => $request->description,
        ]);

        $model->load("profile", "sections", "subjects");
    }

    

}
