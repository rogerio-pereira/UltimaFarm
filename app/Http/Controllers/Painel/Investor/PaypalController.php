<?php

namespace App\Http\Controllers\Painel\Investor;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Comission;
use App\Models\Invoice;
use App\Models\Sale;
use App\Repositories\InvoiceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;
use Srmklive\PayPal\Services\ExpressCheckout;


/**
 *  https://github.com/srmklive/laravel-paypal#usage-express-checkout
 */
class PaypalController extends Controller
{
    private $provider;
    private $data;

    public function __construct()
    {
        $this->provider = new ExpressCheckout();
    }

    public function setData($invoice)
    {
        $this->data = [];
        $this->data['items'] = [
            [
                'name' => $invoice->product->name,
                'price' => $invoice->value,
                'qty' => 1
            ]
        ];

        $this->data['invoice_id'] = $invoice->id;
        $this->data['invoice_description'] = "Pagamento Título #{$invoice->id}";
        $this->data['return_url'] = route('painel.investor.meus-titulos.success-payment');
        $this->data['cancel_url'] = route('painel.investor.meus-titulos.cancel', ['id' => $invoice->id]);

        $total = 0;
        foreach($this->data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }

        $this->data['total'] = $total;
    }

    public function getCheckoutData()
    {
        return $this->data;
    }

    public function sale()
    {
        try {
            //Cria checkout
            $response = $this->provider->setExpressCheckout($this->getCheckoutData(), false);
            //This will redirect user to PayPal
            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao processar o pagamento do Título {$this->data['invoice_id']} pelo PayPal!", 1);
        }
    }

    public function successPayment(Request $request)
    {
        $token = $request->get('token');
        $payerID = $request->get('PayerID');
        $status = null;

        // Verify Express Checkout Token
        $response = $this->provider->getExpressCheckoutDetails($token);

        $invoiceId = $response['INVNUM'];
        $invoice = Invoice::find($invoiceId);
        $this->setData($invoice);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            // Perform transaction on PayPal
            $payment_status = $this->provider->doExpressCheckoutPayment($this->getCheckoutData(), $token, $payerID);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
        }

        $invoice->token = $token;
        $invoice->payerID = $payerID;
        $invoice->status = $status;
        $invoice->save();

        if($status == 'Completed') {
            try
            {
                DB::beginTransaction();
                    $saleData['client_id'] = $invoice->client_id;
                    $saleData['product_id'] = $invoice->product_id;
                    $saleData['value'] = $invoice->value;
                    $saleData['profitability'] = $invoice->profitability;
                    $saleData['deadline'] = $invoice->deadline;
                    $saleData['refundValue'] = $invoice->refundValue;

                    $sale = Sale::create($saleData);

                    $client = Client::find($invoice->client_id);
                    $client = Client::find($invoice->product_id);
                    if(isset($client->indication_id)) {
                        $comissionValue = $invoice->product->price * ($invoice->product->commission / 100);

                        $dataComission['client_id'] = $client->indication_id;
                        $dataComission['sale_id'] = $sale->id;
                        $dataComission['value'] = $comissionValue;
                        $dataComission['deadline'] = $sale->deadline;

                        $comission = Comission::create($dataComission);
                    }

                    $invoice->processed = true;
                    $invoice->save();
                DB::commit();

                //Grava Log
                Activity::all()->last();
            }
            catch(\Exception $e)
            {
                DB::rollBack();
                throw new \Exception($e->getMessage());
            }
        }

        return redirect()->route('painel.investor.meus-titulos.index');
    }
}
