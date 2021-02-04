<?php

namespace Modules\User\Repositories\Dashboard;

use DB;
use Hash;
use Modules\User\Entities\User;
use Modules\User\Notifications\UserStatusChange;

class UserRepository
{
    public function __construct(User $user)
    {
        $this->user      = $user;
    }


    public function userCreatedStatistics()
    {
        $data["userDate"] = $this->user
                            ->studentUser()
                            ->select(\DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date"))
                            ->groupBy('date')
                            ->pluck('date');

        $userCounter = $this->user
                        ->studentUser()
                        ->select(\DB::raw("count(id) as countDate"))
                        ->groupBy(\DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
                        ->get();

                 
        $data["countDate"] = json_encode($userCounter->pluck("countDate")->toArray());

        return $data;
    }

    public function countUsers($order = 'id', $sort = 'desc')
    {
        $users = $this->user->studentUser()->count();

        return $users;
    }

    /*
    * Get All Normal Users Without Roles
    */
    public function getAllUsers($order = 'id', $sort = 'desc')
    {
        $users = $this->user->studentUser()->orderBy($order, $sort)->get();
        return $users;
    }

    /*
    * Get All Normal Users Without Roles
    */
    public function getAllUsersActive($order = 'id', $sort = 'desc')
    {
        $users = $this->user->studentUser()->active()->orderBy($order, $sort)->select("id", "name")->get();
        return $users;
    }

    /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $user = $this->user->withDeleted()->find($id);
        return $user;
    }

    /*
    * Find Object By ID
    */
    public function findByEmail($email)
    {
        $user = $this->user->where('email', $email)->first();
        return $user;
    }


    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {
            $image = $request['image'] ? path_without_domain($request['image']) :  "/uploads/users/{$request->gender}.png";

            $user = $this->user->create([
              'name'          => $request['name'],
              "gender"        => $request->gender,  
              "phone_code"    => $request->phone_code,
              "type"          => "student",
              "is_active"     => $request->is_active == "on" ? 1 :0,
              "is_verified"    => $request->is_verified == "on" ? 1 : 0,
              'email'         => $request['email'],
              'phone_code'    => $request['phone_code'],
              'mobile'        => $request['mobile'],
              'image'         => $image,
            
          ]);
        
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

   
    /*
    * Find Object By ID & Update to DB
    */
    public function update($request, $id)
    {
        DB::beginTransaction();

        $user = $this->findById($id);
        $restore = $request->restore ? $this->restoreSoftDelte($user) : null;

        try {

            $image =  $user->image;
            if ($request->image) {
                deleteFileInStroage($user->image);
                $image = path_without_domain($request['image']);
            } elseif (in_array($user->image, ["/uploads/users/user.png", "/uploads/users/male.png","/uploads/users/female.png"])) {
                $image =  "/uploads/users/{$request->gender}.png";
            }

            $is_verified    =   $user->is_verified ;

            if ($request['password'] == null) {
                $password = $user['password'];
            } else {
                $password  = Hash::make($request['password']);
            }

            $user->update([
                'name'          => $request['name'],
                "phone_code"    => $request->phone_code,
                "is_active"     => $request->is_active == "on" ? 1 :0,
                'email'         => $request['email'],
                'mobile'        => $request['mobile'],
                'image'         => $image,
                'password'      => $password,
                'image'         => $image,
                "is_verified"    => $request->is_verified == "on" ? 1 : 0,
                "gender"        => $request->gender,  
            ]);

            if ($user->is_verified != $is_verified) {
                // send notification
                $this->sendNotifcationStatusChange($user, $user->is_verified  == 1 ? 1 : 0);
            }

           
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function restoreSoftDelte($model)
    {
        $model->restore();
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $model = $this->findById($id);

            if ($model->trashed()):
              deleteFileInStroage($model->image);
            $model->forceDelete(); else:
              $model->delete();
             

            endif;

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /*
    * Find all Objects By IDs & Delete it from DB
    */
    public function deleteSelected($request)
    {
        DB::beginTransaction();

        try {
            foreach ($request['ids'] as $id) {
                $model = $this->delete($id);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->user->withDeleted()->where('id', '!=', auth()->id())->studentUser()->where(function ($query) use ($request) {
            $query->where('id', 'like', '%'. $request->input('search.value') .'%');
            $query->orWhere('name', 'like', '%'. $request->input('search.value') .'%');
            $query->orWhere('email', 'like', '%'. $request->input('search.value') .'%');
            $query->orWhere('mobile', 'like', '%'. $request->input('search.value') .'%');
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    /*
    * Filteration for Datatable
    */
    public function filterDataTable($query, $request)
    {
        // Search Users by Created Dates
        if (isset($request['req']['from']) && $request['req']['from'] != '') {
            $query->whereDate('created_at', '>=', $request['req']['from']);
        }

        if (isset($request['req']['to']) && $request['req']['to'] != '') {
            $query->whereDate('created_at', '<=', $request['req']['to']);
        }

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'only') {
            $query->onlyDeleted();
        }

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'with') {
            $query->withDeleted();
        }
        if (isset($request['req']['status']) &&  $request['req']['status'] != '') {
            $query->where("is_active", $request['req']['status']);
        }

        if (isset($request['req']['is_verified']) &&  $request['req']['is_verified'] != '') {
            $query->where('is_verified', $request['req']['is_verified']);
        }


        return $query;
    }

    public function sendNotifcationStatusChange(&$user, $type)
    {
        $user->notify(new UserStatusChange($type));
    }
}
