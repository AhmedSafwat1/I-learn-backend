<?php

namespace Modules\Learn\Repositories\Api;

use File;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Modules\Learn\Entities\HomeWorkSolution;
use Modules\Learn\Entities\HomeWork as Model;
use Modules\Core\Packages\Payment\Contract\PaymenInterface;

class HomeWorkRepository
{
    public function __construct(Model $model, PaymenInterface $payment)
    {
        $this->model   = $model;
        $this->payment  = $payment;

    }

    public function getAllForUser($request, $with=["attachs"] ,$order = 'id', $sort = 'desc')
    {
        $user = auth()->user();
        $base_query = $this->model;
        if ($user->type == "student") {
            $base_query->where("student_id", $user->id);
            $with = array_merge($with, ["teacher.subjects","teacher.profile","teacher.sections"]);
        } else {
            $with = array_merge($with, ["student"]);
            $base_query
                    ->where("teacher_id", $user->id)
                    ->paied();
        }
        return $base_query
            ->with($with)
            ->orderBy($order, $sort)
            ->paginate($request->page_count ?? env("PAGE_COUNT", 15));
    }

    public function getSolutionsStudent($request, $with){
        return HomeWorkSolution::whereHas("homework", function($query){
            $query->where("student_id", auth()->id());
        })
        ->with($with)
        ->latest()
        ->paginate($request->page_count ?? env("PAGE_COUNT", 15));
    }

    

    public function findById($id, $with=[])
    {
        return $this->model->with($with)->where('id', $id)->first();
    }

    public function findByIdTalent($id, $with=[])
    {
        $model =  $this->model->where("id", $id);
        $user  = auth()->user();
        if ($user->type == "student") {
            $model->where("student_id", $user->id);
            $with= array_merge($with, ["teacher.subjects","teacher.profile","teacher.sections"]);
        } else {
            $model->where("teacher_id", $user->id)
                    ->paied();
            $with = array_merge($with, ["student"])    ;
        }
        return $model->with($with)->firstOrFail();
        ;
    }


    public function giveSolutionForHomeWork($id, &$request)
    {
        DB::beginTransaction();

        $homework = $this->findByIdTalent($id);
       
        try {
            $data = [
                "home_work_id" => $homework->id,
                "note"    => $request->note,
            ];

            
            $solution = $homework->solution()->updateOrCreate(
                [
                "home_work_id" => $id
               ],
                $data
            );
            

            if (!$solution->wasRecentlyCreated && is_array($request->attachs)) {
                  $this->deleteAttachs($solution ,$id."/solutions");
            };

            $this->saveAttachs($solution,$request, $id."/solutions");
            $homework->update(["status"=>"solution"]);

            DB::commit();

            event(HomeWorkSolutionEvent($homework, !$solution->wasRecentlyCreated));
            
            return $solution;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function create(&$request)
    {
        DB::beginTransaction();
        $teacher = User::With("profile")->findOrFail($request->teacher_id);
       
        try {
            $data = array_merge(
                [
                 "student_id"  => auth()->id(),
                "note"    => $request->note,
                "title"    => $request->title,
            ],
                $this->handleTeacherData($teacher, $request)
            );

            $model = $this->model->updateOrCreate(
                [
                "is_paied" => 0 ,
                "student_id"  => auth()->id(),
            ],
                $data
            );

            if (!$model->wasRecentlyCreated) {
                $this->deleteAttachs($model, $model->id);
            }

            $this->saveAttachs($model, $request, $model->id);
            if (
                !($model->is_free &&  $model->is_paied)
              ) {
                $this->createPayment($model);
            }

            DB::commit();

            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(&$request, $id)
    {
        DB::beginTransaction();
        $model = $this->findByIdTalent($id, ["attachs"]);
       
        try {
            $data = [
                "note"    => $request->note,
                "title"    => $request->title,
            ];

            $this->deletelAttachsFromArray($model, $request);

            $model->update(
                $data
            );

        
            $this->saveAttachs($model, $request, $model->id);
            
            DB::commit();

            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    // handle data from teacher
    public function handleTeacherData(&$teacher, &$request)
    {
        $price = optional($teacher->profile)->homework_price ?? 0;
        return  [
                "price"    =>  $price ,
                "is_free"  =>  $price <= 0,
                "is_paied" =>  $price <= 0 ,
                "teacher_id"=> $teacher->id,
            ];
    }

    // handle the delete old attachs
    public function deleteAttachs(&$model, $key="id")
    {
        $model->attachs()->delete();
        deleteDirecotoryInStroage("homeworks/".$key);
    }

    // handle uploded attachs
    public function saveAttachs(&$model, &$request, $folder="id")
    {
        if (is_array($request->attachs)) :
            foreach ($request->attachs as $key=> $attach) {
                $path = pathFileInStroage($request, "attachs.".$key, "homeworks/".$folder);
                $model->attachs()->create(
                    [
                            "url"=>$path,
                            "type" => getFileType($attach)
                        ]
                );
            }
        endif;
    }

    

    public function createPayment($model)
    {
        $model->payment()->updateOrCreate([
            "status" => "wait"
        ], [
            "owner"=> auth()->user() ,
            "total" => $model->price ,
            "user_id"=> auth()->id(),
        ]);
    }

    public function getUrlForPayment($model)
    {
        $model->loadMissing("payment.user");
        
        if ($model->payment) {
            return $this->payment->getResultForPayment($model->payment);
        }
        return "";
    
    }

    public function deletelAttachsFromArray(&$model, &$request){
        if(is_array($request->attachsDelete)){
            
            foreach ($request->attachsDelete as $delete) {
              $attach = $model->attachs->firstWhere("id", $delete);
              if($attach) $attach->delete();
            }
        }
    }
}
