<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\Comission;
use App\Models\Product;
use App\Models\Sale;
use App\Repositories\ComissionRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\SaleRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Srmklive\PayPal\Services\ExpressCheckout;

class UpdateInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all invoices and create sales after invoice paid';

    private $invoiceRepository;
    private $saleRepository;
    private $comissionRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(InvoiceRepository $invoiceRepository)
    {
        parent::__construct();

        $this->invoiceRepository = $invoiceRepository;

        $this->provider = new ExpressCheckout();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $invoices = $this->invoiceRepository
                        ->findWhere([
                            ['processed', '=', '0'],
                            ['token', '<>', null],
                            ['payerID', '<>', null],
                        ]);

        foreach ($invoices as $invoice) {
            // Verify Express Checkout Token
            $response = $this->provider->getExpressCheckoutDetails($invoice->token);

            $this->setData($invoice);

            if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
                // Perform transaction on PayPal
                $payment_status = $this->provider->doExpressCheckoutPayment($this->getCheckoutData(), $invoice->token, $invoice->payerID);
                $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            }

            try {
                DB::beginTransaction();
                    $invoice->status = $status;
                    $invoice->save();

                    if($status == 'Completed') {
                        $saleData['client_id'] = $invoice->client_id;
                        $saleData['product_id'] = $invoice->product_id;
                        $saleData['value'] = $invoice->value;
                        $saleData['profitability'] = $invoice->profitability;
                        $saleData['deadline'] = $invoice->deadline;
                        $saleData['refundValue'] = $invoice->refundValue;

                        $sale = Sale::create($saleData);

                        $client = Client::find($invoice->client_id);
                        $product = Product::find($invoice->product_id);
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
                    }
                DB::commit();

                //Grava Log
                Activity::all()->last();
            }
            catch(\Exception $e)
            {
                DB::rollBack();
                $this->error("Erro ao processar pedidos");
            }
        }

        $this->info("Todos os pedidos foram processados com sucesso");
    }

    private function setData($invoice)
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

    private function getCheckoutData()
    {
        return $this->data;
    }
}
