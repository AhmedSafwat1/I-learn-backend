<?php
namespace Modules\Core\Packages\Payment\Contract;

interface PaymenInterface
{
    public function send($order, $type ="api-order", $payment = "knet");

    public function getResultForPayment($data, $type ="api-order", $payment = "knet");
}
