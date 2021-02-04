<?php

namespace Modules\Authentication\Foundation;

use Auth;
use Exception;
use Carbon\Carbon;
use Modules\User\Entities\User;
use Illuminate\Support\MessageBag;

trait Authentication
{

  public static function authentication($credentials)
  {
      // LOGIN BY : Mobile & Password
      if(is_numeric($credentials->email)):

          $auth = Auth::attempt([
                'mobile'     => $credentials->email,
                'password'   => $credentials->password
            ],  $credentials->has('remember')
          );

        // LOGIN BY : Email & Password
      elseif(filter_var($credentials->email, FILTER_VALIDATE_EMAIL)):

          $auth = Auth::attempt([
              'email'     => $credentials->email,
              'password'  => $credentials->password
            ],
            $credentials->has('remember')
          );

      endif;

      return $auth;
  }

  public function login($credentials)
  {
      try {
       
     
        // dd(self::authentication($credentials), auth()->user()->isAbleTo('workers_access') || auth()->user()->isAbleTo('dashboard_access') );
        if (self::authentication($credentials) && ( auth()->user()->isAbleTo('workers_access') || auth()->user()->isAbleTo('dashboard_access')  ) )
            return false;


        $errors = new MessageBag([
          'password' => __('authentication::dashboard.login.validations.failed')
        ]);

        auth()->logout();

        return $errors;

      } catch (Exception $e) {
        throw $e;
        return $e;

      }
  }

  public function loginAfterRegister($credentials)
  {
      try {

        self::authentication($credentials);

      } catch (Exception $e) {

        return $e;

      }
  }

  public function generateToken($user)
  {
      $tokenResult = $user->createToken('Personal Access Token');

      $token = $tokenResult->token;

      $token->save();

      return $tokenResult;
  }

  public function tokenExpiresAt($token)
  {
      return Carbon::parse($token->token->expires_at)->toDateTimeString();
  }

  public function loginApp($credentials){
   
        try {
              $credentials = [
                         "email"        => $credentials->email,
                          'password'    => $credentials->password
              ];

                $user = auth()->once($credentials);
                
               
                if($user){
                  $user = auth()->user();
                  if($user->is_active){
                      return $user;
                  }

                  return new MessageBag([
                    'email' => __('authentication::dashboard.login.validations.block')
                  ]);

                
                 
                } 

                
                
              return new MessageBag([
                'email' => __('authentication::dashboard.login.validations.failed')
              ]);
            
          }catch (Exception $e) {
                  throw $e;
              return $e;
            
          }

  }
}
