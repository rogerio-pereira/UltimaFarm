<?php

namespace App\Services\Painel;

use App\Http\Controllers\Painel\Investor\PaypalController;
use App\Repositories\ClientRepository;
use App\Repositories\ComissionRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SaleRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Activitylog\Models\Activity;

class SaleService
{
    private $saleRepository;
    private $clientRepository;
    private $productRepository;
    private $comissionRepository;

    public function __construct(
                                    SaleRepository $saleRepository,
                                    ClientRepository $clientRepository,
                                    ProductRepository $productRepository,
                                    ComissionRepository $comissionRepository
                                )
    {
        $this->saleRepository = $saleRepository;
        $this->clientRepository = $clientRepository;
        $this->productRepository = $productRepository;
        $this->comissionRepository = $comissionRepository;
    }

    public function store(array $data, $makePayment = null)
    {
        try
        {
            DB::beginTransaction();
                $product = $this->productRepository->find($data['product_id']);
                $client = $this->clientRepository->find($data['client_id']);

                $data['value'] = $product->price;
                $data['profitability'] = $product->profitability;
                $data['deadline'] = Carbon::now()->addMonths($product->deadline);
                $data['refundValue'] = $product->price + ( ($product->price * ($product->profitability / 100)) * $product->deadline);

                $sale = $this->saleRepository->create($data);

                //Se cliente veio de indicações
                if(isset($client->indication_id)) {
                    $comissionValue = $product->price * ($product->commission / 100);

                    $dataComission['client_id'] = $client->indication_id;
                    $dataComission['sale_id'] = $sale->id;
                    $dataComission['value'] = $comissionValue;
                    $dataComission['deadline'] = $data['deadline'];

                    $comission = $this->comissionRepository->create($dataComission);
                }
            DB::commit();

            //Grava Log
            Activity::all()->last();

            return $sale;
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}