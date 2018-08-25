<?php

namespace App\Http\Controllers\Painel\Investor;

use App\Criteria\Painel\Investor\InvestorCriteria;
use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\Investor\SaleRequest;
use App\Repositories\ClientRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SaleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class SaleController extends Controller
{
    private $repository;
    private $productRepository;

    public function __construct(
                                    SaleRepository $repository,
                                    ProductRepository $productRepository
                                )
    {
        $this->repository = $repository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = $this->repository->pushCriteria(InvestorCriteria::class)->paginate();

        return view('painel.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productRepository->comboboxList();

        return view('painel.investor.sales.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        $data = $request->all();

        $product = $this->productRepository->find($data['product_id']);

        $data['client_id'] = Auth::user()->client->id;
        $data['value'] = $product->price;
        $data['profitability'] = $product->profitability;
        $data['deadline'] = Carbon::now()->addMonths($product->deadline);
        $data['refundValue'] = $product->price + ( ($product->price * ($product->profitability / 100)) * $product->deadline);

        $this->repository->create($data);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Venda salva com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/sales');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect('/');
    }
}
