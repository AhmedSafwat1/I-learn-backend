<?php
namespace Modules\Core\Packages\Payment;

use Modules\Core\Packages\Payment\Contract\PaymenInterface;

class KnetPaymentService implements PaymenInterface
{
    // TEST CREDENTIALS
    const MERCHANT_ID    = "1201";
    const USERNAME 			 = "test";
    const PASSWORD     	 = "test";
    const API_KEY        = "jtest123";

    // LIVE CREDENTIALS
    // const MERCHANT_ID    = "1201";
    // const USERNAME 			 = "test";
    // const PASSWORD     	 = "test";
    // const API_KEY        = "jtest123";

    public function send($order, $type ="api-order", $payment = "knet")
    {
        $url = $this->paymentUrls($type);

        $fields = [
                    // 'api_key' 			=> password_hash(self::EMAIL_MYFATOORAH,PASSWORD_BCRYPT),
                    'api_key' 				=> self::API_KEY,
                    'merchant_id'			=> self::MERCHANT_ID,
                    'username' 				=> self::USERNAME,
                    'password' 				=> stripslashes(self::PASSWORD),
                    'order_id' 				=> $order['id'],
                    'CurrencyCode'		=> setting('default_currency'), //only works in production mode
                    'CstFName' 				=> $order["name"] ??  'null',
                    'CstEmail'				=> $order["email "]?? 'null',
                    'CstMobile'				=> $order["mobile"] ? str_replace("-", "",  $order["mobile"] ) : 'null',
                    'success_url'   	=> $url['success'],
                    'error_url'				=> $url['failed'],
                    'test_mode'    		=> 1, // test mode enabled
                    'whitelabled'    	=> true, // only accept in live credentials (it will not work in test)
                    'payment_gateway'	=> $payment,// knet / cc
                    'total_price'			=> $order["total"]
                ];

        // dd($fields);

        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.upayments.com/test-payment");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
		$server_output = json_decode($server_output, true);
	

        return $server_output['paymentURL'];
    }

    public function paymentUrls($type)
    {
        if ($type == 'api-order') {
            $url['success'] = url(route('api.ads.success'));
            $url['failed']  = url(route('api.ads.failed'));
        }

        return $url;
    }


    public  function getResultForPayment($data, $type ="api-order", $payment = "knet")
    {
		
		$order["id"]     = $data["id"];	
		$order["total"]  = $data["money_paied"];
		$order["name"]   = optional($data->user)->name ;
		$order["email"]  = optional($data->user)->email ;
		$order["mobile"] = optional($data->user)->phone_code . "". optional($data->user)->mobile;
        return $this->send($order, $type, $payment);
    }
}
