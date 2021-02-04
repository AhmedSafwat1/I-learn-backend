<?php

namespace Modules\User\Repositories\Api;

use DB;
use File;
use Hash;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Storage;
use Modules\User\Entities\UserTransaction;
use Modules\Transaction\Services\PaymentService;
use Modules\User\Notifications\UserReachToDeposit;

class UserRepository
{
    public function __construct(User $user)
    {
        $this->user      = $user;
    }

    public function update($request)
    {
        $user = auth()->user();
        $image = $user->image;
        if ($request->image) {
            deleteFileInStroage($user->image);
            $image = pathFileInStroage($request, "image", "users");
        } elseif (in_array($user->image, ["/uploads/users/user.png", "/uploads/users/male.png","/uploads/users/female.png"])) {
            $image =  "/uploads/users/{$request->gender}.png";
        }
        

        DB::beginTransaction();

        try {
            $user->update([
                'name'          => $request['name'],
                'email'         => $request['email'],
                'mobile'        => $request['mobile'],
                'phone_code'    => $request['phone_code'],
                "image"         => $image ,
                "gender"        => $request->gender,    
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

    public function updatePassword(&$user, &$request)
    {
        try {
            $user->update([
                
                'password'      => bcrypt($request->new_password),
               
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function getWorkers(&$request)
    {
        return $this->user
        ->active()
        ->when($request->lat && $request->lng, function ($query) use (&$request) {
            $query->distance($request->lat, $request->lng)
            ->orderByRaw("distance asc");
            ; //29.37958,47.990231
        })
        ->when($request->search, function ($query) use (&$request) {
            $query->searchFilter($request, true);
            ; //29.37958,47.990231
        })
        ->with(["categories"])
        ->orderBy("created_at", "desc")
        ->paginate($request->page_count ?? env("PAGE_COUNT", 15));
    }

    public function userProfile($with= [])
    {
        return auth()->user()->load($with);
    }

    public function updateSetting(&$request)
    {
        DB::beginTransaction();
        $user = auth()->user();
        $setting = array_merge($user->setting ? $user->setting : ["lang"=>"ar"], $request->all());
        try {
            $user->update([
                'setting'      => $setting ,
            ]);
             
            if ($request->has("lang")) {
                $user->deviceTokens()->update([
                    "lang"=> $setting["lang"]
                ]);
            }
           

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function saveTeacherDate(&$model, &$request){
        $model->sections()->sync($request->sections ?? []);
        $model->subjects()->sync($request->subjects ?? []);
        $model->profile()->update([
            "description"  => $request->description,
        ]);

        $model->load("profile", "sections", "subjects");
    }
}
