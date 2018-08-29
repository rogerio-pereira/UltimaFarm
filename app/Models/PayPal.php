<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PayPal extends Model
{
    private $apiContext;
    private $identify;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret_id'),
            )
        );
        $this->apiContext->setConfig(config('paypal.settings'));
        $this->identify(bcrypt(uniqid(date(YmdHis))));
    }

    public function generate()
    {
        $payer = new Payer(); 
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1
            ->setName('Ground Coffee 40 oz')
            ->setCurrency('BRL')
            ->setQuantity(1)
            ->setPrice(7.5);
        $item2 = new Item(); 
        $item2
            ->setName('Granola bars')
            ->setCurrency('BRL')
            ->setQuantity(5)
            ->setPrice(2);

        $itemList = new ItemList();
        $itemList->setItems(array($item1, $item2));

        $details = new Details();
        $details
            ->setShipping(0.0)
            ->setTax(0.0)
            ->setSubtotal(0.0);

        $amount = new Amount();
        $amount
            ->setCurrency("BRL")
            ->setTotal(20)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction
            ->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber($this->identify);

        $redirectUrls = new RedirectUrls();
        $redirectUrls
            ->setReturnUrl(route('painel.investor.meus-titulos.success-payment'))
            ->setCancelUrl(route('painel.investor.meus-titulos.cancel-payment'));

        $payment = new Payment();
        $payment
            ->setIntent("order")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $request = clone $payment;

        try { 
            $payment->create($this->apiContext); 
        } catch (\Exception $ex) {
            ResultPrinter::printError("Created Payment Order Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
            exit(1);
        }

        $approvalUrl = $payment->getApprovalLink();

        ResultPrinter::printResult("Created Payment Order Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);
        return $payment;
    }
}
