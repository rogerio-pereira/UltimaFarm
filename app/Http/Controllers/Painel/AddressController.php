<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\AddressRequest;
use App\Models\Address\States;
use App\Repositories\AddressCategoryRepository;
use App\Repositories\AddressRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class AddressController extends Controller
{
    private $repository;
    private $addressCategoryRepository;

    public function __construct(
                                    AddressRepository $repository,
                                    AddressCategoryRepository $addressCategoryRepository
                                )
    {
        $this->repository = $repository;
        $this->addressCategoryRepository = $addressCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('view-addresses'))
            return redirect('/');

        $addresses = $this->repository->paginate();

        return view('painel.addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-addresses'))
            return redirect('/');

        $categories = $this->addressCategoryRepository->comboboxList();
        $states = States::getStates();

        return view('painel.addresses.create', compact('categories', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        if(Gate::denies('create-addresses'))
            return redirect('/');

        $data = $request->all();

        $this->repository->create($data);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Endereço salvo com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/addresses');
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
        if(Gate::denies('update-addresses'))
            return redirect('/');

        $address = $this->repository->find($id);

        $categories = $this->addressCategoryRepository->comboboxList();
        $states = States::getStates();

        return view('painel.addresses.edit', compact('address', 'categories', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {
        if(Gate::denies('update-addresses'))
            return redirect('/');

        $data = $request->all();

        $this->repository->update($data, $id);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Endereço alterado com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('addresses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-addresses'))
            return redirect('/');

        $this->repository->delete($id);

        //Grava Log
        Activity::all()->last();

        return redirect()->route('addresses.index');
    }
}
