<?php

namespace App\Http\Controllers\Painel\Investor;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PayPal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class PaypalController extends Controller
{
    public static function pay(Invoice $invoice)
    {
        $paypal = new PayPal($invoice);

        $result = $paypal->generate();

        if($result['status'] == true) {
            $paymentId = $result['paymentId'];
            $identify = $result['identify'];

            $invoice->updatePaypalData($paymentId, $identify);

            Session::put('paymentId', $paymentId);

            return redirect()->away($result['url_paypal']);
        } else {
            Session::flash('message', ['Erro inesperado ao comunicar com o Paypal']); 
            Session::flash('alert-type', 'alert-danger'); 

            return redirect('/');
        }
    }

    public function successPayment(Request $request)
    {
        $authorized = true;
        $sucess = true;
        $paymentId = $request->paymentId;
        $token = $request->token;
        $payerId = $request->PayerID;

        if(empty($paymentId) || empty($token) || empty($payerId))
            $authorized = false;

        if(!Session::has('paymentId') || Session::has('paymentId') != $paymentId)
            $authorized = false;

        if(!$authorized) {
            Session::flash('message', ['Não autorizado!']); 
            Session::flash('alert-type', 'alert-danger'); 

            return redirect('/');
        }

        $invoice = Invoice::where(['paymentId' => $paymentId])->first();
        $paypal = new PayPal($invoice);

        $response = $paypal->execute($paymentId, $token, $payerId);

        if($response == 'approved') {
            $invoice->updatePaypalDataReturn($token, $payerId, 'approved');
            
            Session::forget('paymentId');
        }
        else {

            Session::flash('message', ['Titulo não aprovado!']); 
            Session::flash('alert-type', 'alert-danger'); 

            return redirect('/');
        }

        Session::flash('message', ['Titulo criado com sucesso, aguarde a aprovação!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/');
    }

    public function cancelPayment(Request $request)
    {
        Session::flash('message', ['Titulo cancelado com sucesso!']); 
        Session::flash('alert-type', 'alert-danger'); 

        return redirect('/');
    }
}
