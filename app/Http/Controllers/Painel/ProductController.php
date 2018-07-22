<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\ProductRequest;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class ProductController extends Controller
{
    private $repository;
    private $categoryRepository;

    public function __construct(
                                    ProductRepository $repository,
                                    ProductCategoryRepository $categoryRepository
                                )
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('view-products'))
            return redirect('/');

        $products = $this->repository->paginate();

        return view('painel.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-products'))
            return redirect('/');

        $productCategories = $this->categoryRepository->comboboxList();

        return view('painel.products.create', compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if(Gate::denies('create-products'))
            return redirect('/');

        $data = $request->all();
        $data['price'] = str_replace('R$', '', $data['price']);
        $data['price'] = str_replace(' ', '', $data['price']);
        $data['price'] = str_replace('.', '', $data['price']);
        $data['price'] = str_replace(',', '.', $data['price']);

        $this->repository->create($data);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Produto salvo com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/products');
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
        if(Gate::denies('update-products'))
            return redirect('/');

        $product = $this->repository->find($id);

        $productCategories = $this->categoryRepository->comboboxList();

        return view('painel.products.edit', compact('product', 'productCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        if(Gate::denies('update-products'))
            return redirect('/');

        $data = $request->all();
        $data['price'] = str_replace('R$', '', $data['price']);
        $data['price'] = str_replace(' ', '', $data['price']);
        $data['price'] = str_replace('.', '', $data['price']);
        $data['price'] = str_replace(',', '.', $data['price']);

        $this->repository->update($data, $id);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Produto alterado com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-products'))
            return redirect('/');

        $this->repository->delete($id);

        //Grava Log
        Activity::all()->last();

        return redirect()->route('products.index');
    }
}
