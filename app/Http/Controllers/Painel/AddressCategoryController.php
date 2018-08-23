<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\AddressCategoryRequest;
use App\Models\Address\States;
use App\Repositories\AddressCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class AddressCategoryController extends Controller
{
    private $repository;

    public function __construct(AddressCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('view-address-categories'))
            return redirect('/');

        $addressCategories = $this->repository->paginate();

        return view('painel.address_categories.index', compact('addressCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-address-categories'))
            return redirect('/');

        $states = States::getStates();

        return view('painel.address_categories.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressCategoryRequest $request)
    {
        if(Gate::denies('create-address-categories'))
            return redirect('/');

        $data = $request->all();

        $this->repository->create($data);

        Session::flash('message', ['Local salvo com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/address-categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->find($id)->toString();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('update-address-categories'))
            return redirect('/');

        $addressCategory = $this->repository->find($id);
        $states = States::getStates();

        return view('painel.address_categories.edit', compact('addressCategory', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressCategoryRequest $request, $id)
    {
        if(Gate::denies('update-address-categories'))
            return redirect('/');

        $data = $request->all();

        $this->repository->update($data, $id);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Local alterado com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('address-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-address-categories'))
            return redirect('/');

        $this->repository->delete($id);

        //Grava Log
        Activity::all()->last();

        return redirect()->route('address-categories.index');
    }
}
