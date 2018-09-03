<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Spatie\Activitylog\Models\Activity;

class PayPal extends Model
{
    private $apiContext;
    private $identify;
    private $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret_id')
            )
        );
        $this->apiContext->setConfig(config('paypal.settings'));
        $this->identify = bcrypt(uniqid(date('YmdHis')));

        $this->invoice = $invoice;
    }

    public function generate()
    {
        $payment = $this->payment();
        
        try { 
            $payment->create($this->apiContext); 

            $approvalUrl = $payment->getApprovalLink();

            return [
                'status' => 'true',
                'url_paypal' => $approvalUrl,
                'identify' => $this->identify,
                'paymentId' => $payment->getId(),
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'false',
                'message' => $e->getMessage(),
            ];
        }
    }

    public function payer()
    {
        $payer = new Payer(); 
        $payer->setPaymentMethod("paypal");

        return $payer;
    }

    public function item()
    {
        $item = new Item();
        $item
            ->setName($this->invoice->product->name)
            ->setCurrency('BRL')
            ->setQuantity(1)
            ->setPrice($this->invoice->value);

        return $item;
    }

    public function itemList()
    {
        $itemList = new ItemList();
        $itemList->setItems([$this->item()]);

        return $itemList;
    }

    public function details()
    {
        /*
         * Se somar Shipping, tax e subtotal deve ser o total do amount
         * Subtotal é o valor dos produtos (preco * quantidade) de todos os produtos
         */
        $details = new Details();
        $details
            ->setShipping(0.0)
            ->setTax(0.0)
            ->setSubtotal($this->invoice->value);

        return $details;
    }

    public function amount()
    {
        $amount = new Amount();
        $amount
            ->setCurrency("BRL")
            ->setTotal($this->invoice->value)
            ->setDetails($this->details());

        return $amount;
    }

    public function description()
    {
        $description = 'Compra de Titulo: "'.$this->invoice->product->name.
                        '". Valor: R$ '.number_format($this->invoice->value, 2, ',', '.').
                        '. Rentabilidade: '.$this->invoice->profitability.
                        '%. Data de retirada: '.Carbon::parse($this->invoice->deadline)->format('d/m/Y');

        return $description;
    }

    public function transaction()
    {
        $transaction = new Transaction();
        $transaction
            ->setAmount($this->amount())
            ->setItemList($this->itemList())
            ->setDescription($this->description())
            ->setInvoiceNumber($this->identify);

        return $transaction;
    }

    public function redirectUrls()
    {
        $redirectUrls = new RedirectUrls();
        $redirectUrls
            ->setReturnUrl(route('painel.investor.meus-titulos.success-payment'))
            ->setCancelUrl(route('painel.investor.meus-titulos.cancel-payment'));

        return $redirectUrls;
    }

    public function payment()
    {
        $payment = new Payment();
        $payment
            ->setIntent("order")
            ->setPayer($this->payer())
            ->setRedirectUrls($this->redirectUrls())
            ->setTransactions([$this->transaction()]);

        return $payment;
    }

    public function execute($paymentId, $token, $payerId)
    {
        $payment = Payment::get($paymentId, $this->apiContext);

        if($payment->getState() != 'approved') {
            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);

            $result = $payment->execute($execution, $this->apiContext);

            return $result->getState();
        }

        return $payment->getState();
    }
}
