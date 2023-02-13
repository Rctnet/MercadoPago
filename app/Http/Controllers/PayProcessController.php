<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Payment;
use Symfony\Component\Console\Input\Input;

class PayProcessController extends Controller
{
    public function pay(Request $request)
    {
        \MercadoPago\SDK::setAccessToken(env("ENV_ACCESS_TOKEN"));

        $payment = new \MercadoPago\Payment();
      
        $payment->transaction_amount = $request->input("transaction_amount");
        $payment->token = $request->input("token");

        if($request->input("paymentMethod")=='billet'){
            $payment->description = "Título do produto";
            $payment->payment_method_id = "bolbradesco";
            $payer = new \MercadoPago\Payer();
            $payer->email = $request->input("cardholderEmail");
            $payer->first_name = $request->input("payerFirstName");
            $payer->last_name = $request->input("payerLastName");
            $payer->identification = array(
                "type" => $request->input("identificationType"),
                "number" => $request->input("identificationNumber")
            );
            $payer->address =  array(
                "zip_code" => $request->input("cep"),
                "street_name" => $request->input("street_name"),
                "street_number" => $request->input("street_number"),
                "neighborhood" => $request->input("neighborhood"),
                "city" => $request->input("city"),
                "federal_unit" => $request->input("state"),
             );
            $payment->payer = $payer;
           
        }else{
            $payment->installments = $request->input("installments");
            $payer = new \MercadoPago\Payer();
            $payer->email = $request->input("payer.email");
            $payer->identification = array(
                "type" => $request->input("payer.identification.type"),
                "number" => $request->input("payer.identification.number")
            );
            $payment->payer = $payer;
        }
        
        $payment->save();

        if($payment->error){
           return response( array(
                'status' => $payment->error->status,
                'message' => $payment->error->message,
            ),400);
        }else{
            return response( array(
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'id' => $payment->id,
                'link'=>  isset($payment->transaction_details->external_resource_url) ? base64_encode($payment->transaction_details->external_resource_url) : '' 
            ),200);

        }
    }
    public function tanks(Request $request)
    {
        if($request->input('link')){
            return view('tanks_page',['link'=>base64_decode($request->input('link'))]);
        }else{
            return view('tanks_page',[]);
        }
    }
}
