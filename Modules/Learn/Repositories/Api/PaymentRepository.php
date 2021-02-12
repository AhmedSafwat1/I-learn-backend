<?php

namespace Modules\Learn\Repositories\Api;

use File;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Modules\Learn\Events\PaiedEvent;
use Modules\Learn\Entities\Payment as Model;
use Modules\Core\Packages\Payment\Contract\PaymenInterface;

class PaymentRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
       
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
    }

    

    public function findById($id, $with=[])
    {
        return $this->model->with($with)
                   ->where('id', $id)
                   ->where("status","wait")
                   ->first();
    }


  


    public function successPayment($request){
        DB::beginTransaction();
        $payment = $this->findById($request->OrderID, "order.teacher");
        // dd($payment->toArray());
        abort_if(is_null($payment), "404");
        try {
            $payment->update([
                "status" => "paied",
                "transaction"=> $request->all()
            ]);
            $order = $payment->order ;
            $order->update([
                "is_paied" => 1
            ]);
            DB::commit();
            event(new PaiedEvent($payment));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function failedPayment($request){
        DB::beginTransaction();
        $payment = $this->findById($request->OrderID, "order.teacher");
        abort_if(is_null($payment), "404");
        try {
            $payment->delete();
            $order = $payment->order ;
            $order->attachs()->delete();
            $order->forceDelete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

}

