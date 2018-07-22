<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\ProductSubcategoryRequest;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductSubcategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class ProductSubcategoryController extends Controller
{
    private $repository;
    private $categoryRepository;

    public function __construct(
                                    ProductSubcategoryRepository $repository,
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
        if(Gate::denies('view-product_subcategories'))
            return redirect('/');

        $productSubcategories = $this->repository->paginate();

        return view('painel.product_subcategories.index', compact('productSubcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-product_subcategories'))
            return redirect('/');

        $productCategories = $this->categoryRepository->comboboxList();

        return view('painel.product_subcategories.create', compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductSubcategoryRequest $request)
    {
        if(Gate::denies('create-product_subcategories'))
            return redirect('/');

        $data = $request->all();

        $this->repository->create($data);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Subcategoria de Produto salva com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/product_subcategories');
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
        if(Gate::denies('update-product_subcategories'))
            return redirect('/');

        $productSubcategory = $this->repository->find($id);

        $productCategories = $this->categoryRepository->comboboxList();

        return view('painel.product_subcategories.edit', compact('productSubcategory', 'productCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductSubcategoryRequest $request, $id)
    {
        if(Gate::denies('update-product_subcategories'))
            return redirect('/');

        $data = $request->all();

        $this->repository->update($data, $id);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Subcategoria de Produto alterada com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('product_subcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-product_subcategories'))
            return redirect('/');

        $this->repository->delete($id);

        //Grava Log
        Activity::all()->last();

        return redirect()->route('product_subcategories.index');
    }
}
