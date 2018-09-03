<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\Comission;
use App\Models\PayPal;
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
                        ->orderBy('id desc');

        foreach ($invoices as $invoice) {
            $paypal = new PayPal($invoice);
            $response = $paypal->execute($invoice->paymentId, $invoice->token, $invoice->payerId);

            $invoice->updatePaypalDataReturn($invoice->token, $invoice->payerId, $response);

            try {
                DB::beginTransaction();
                    if($response == 'approved') {
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
}
