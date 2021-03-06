<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\ClientRequest;
use App\Models\Address\States;
use App\Repositories\ClientRepository;
use App\Services\Painel\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class ClientController extends Controller
{
    private $repository;
    private $service;

    public function __construct(
                                    ClientRepository $repository,
                                    ClientService $service
                                )
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('view-clients'))
            return redirect('/');

        $clients = $this->repository->paginate();

        return view('painel.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-clients'))
            return redirect('/');

        $states = States::getStates();
        $clients = $this->repository->comboboxList();
        $clients = $clients->toArray();
        $clients = array_reverse($clients, true);
        $clients['0'] = '';
        $clients = array_reverse($clients, true);

        return view('painel.clients.create', compact('states', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        if(Gate::denies('create-clients'))
            return redirect('/');

        $data = $request->all();

        if($data['indication_id'] == 0)
            $data['indication_id'] = null;

        $this->service->store($data);

        Session::flash('message', ['Cliente salvo com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/clients');
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
        if(Gate::denies('update-clients'))
            return redirect('/');

        $client = $this->repository->find($id);
        $states = States::getStates();
        $clients = $this->repository->comboboxList();
        $clients = $clients->toArray();
        $clients = array_reverse($clients, true);
        $clients['0'] = '';
        $clients = array_reverse($clients, true);

        return view('painel.clients.edit', compact('client', 'states', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        if(Gate::denies('update-clients'))
            return redirect('/');

        $data = $request->all();

        if($data['indication_id'] == 0)
            $data['indication_id'] = null;

        $this->repository->update($data, $id);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Cliente alterado com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-clients'))
            return redirect('/');

        $this->repository->delete($id);

        //Grava Log
        Activity::all()->last();

        return redirect()->route('clients.index');
    }
}
