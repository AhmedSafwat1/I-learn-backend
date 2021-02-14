<?php

namespace Modules\Learn\Repositories\Api;

use File;
use Carbon\Carbon;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Modules\Learn\Entities\Lesson as Model;
use Modules\Core\Packages\Payment\Contract\PaymenInterface;

class LessonRepository
{
    public function __construct(Model $model, PaymenInterface $payment)
    {
        $this->model   = $model;
        $this->payment  = $payment;

    }

    public function getRunnigForUser($request, $with=["subject"] ,$order = 'start_at', $sort = 'asc')
    {
        $user = auth()->user();
        $base_query = $this->model
                          ->talent()
                          ->working();

        return $base_query
            ->with($with)
            ->orderBy($order, $sort)
            ->paginate($request->page_count ?? env("PAGE_COUNT", 15));
    }


    public function getInCommingForUser($request, $with=["subject"] ,$order = 'start_at', $sort = 'asc')
    {
        $user = auth()->user();
        $base_query = $this->model
                          ->talent()
                          ->inComming();

        return $base_query
            ->with($with)
            ->orderBy($order, $sort)
            ->paginate($request->page_count ?? env("PAGE_COUNT", 15));
    }


    public function getPreviousForUser($request, $with=["subject"] ,$order = 'end_at', $sort = 'asc')
    {
        $user = auth()->user();
        $base_query = $this->model
                          ->talent()
                          ->Previous();

        return $base_query
            ->with($with)
            ->orderBy($order, $sort)
            ->paginate($request->page_count ?? env("PAGE_COUNT", 15));
    }

   

    public function findById($id, $with=[])
    {
        return $this->model->with($with)->where('id', $id)->first();
    }

    public function findByIdTalent($id, $with=["subject"])
    {
        $model =  $this->model->where("id", $id);
        $user  = auth()->user();
        if ($user->type == "student") {
            $model->where("student_id", $user->id);
            $with= array_merge($with, ["teacher"]);
        } else {
            $model->where("teacher_id", $user->id)
                    ->paied();
            $with = array_merge($with, ["student"])    ;
        }
        return $model->with($with)->firstOrFail();
        ;
    }


  
    public function create(&$request)
    {
        DB::beginTransaction();
        $teacher = User::With("profile")->findOrFail($request->teacher_id);
       
        try {
            $data = array_merge(
                [
                "student_id" => auth()->id(),
                "note"    => $request->note,
                "title"    => $request->title,
                "subject_id"=> $request->subject_id,
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

    // public function update(&$request, $id)
    // {
    //     DB::beginTransaction();
    //     $model = $this->findByIdTalent($id, ["attachs"]);
       
    //     try {
    //         $data = [
    //             "note"    => $request->note,
    //             "title"    => $request->title,
    //         ];

    //         $this->deletelAttachsFromArray($model, $request);

    //         $model->update(
    //             $data
    //         );

        
    //         $this->saveAttachs($model, $request, $model->id);
            
    //         DB::commit();

    //         return $model;
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         throw $e;
    //     }
    // }


    // handle data from teacher
    public function handleTeacherData(&$teacher, &$request)
    {
        $price = optional($teacher->profile)[$request->lesson_type."_price"] ?? 0;
        $date = Carbon::parse($request->start_at);
        $duration = 60;
        $date->second(0);
        return  [
                "price"    =>  $price ,
                "is_free"  =>  $price <= 0,
                "is_paied" =>  $price <= 0 ,
                "teacher_id"=> $teacher->id,
                "type"      => $request->lesson_type, 
                "start_at"  => $date ,
                "date"      => $date,
                "time"      => $date,
                "end_at"    => $date->copy()->addMinutes(60) ,
                "duration"  => $duration
            ];
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
