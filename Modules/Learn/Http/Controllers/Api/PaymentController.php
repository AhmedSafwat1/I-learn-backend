<?php

namespace Modules\Learn\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Apps\Http\Controllers\Api\ApiController;

use Modules\Learn\Repositories\Api\PaymentRepository as Repo;

class PaymentController extends ApiController
{

    function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

   

    public function success(Request $request){
        $this->repo->successPayment($request);
        return  "success";
    }

    public function failed(Request $request){
        $this->repo->failedPayment($request);
        return  "failed";
    }

}
