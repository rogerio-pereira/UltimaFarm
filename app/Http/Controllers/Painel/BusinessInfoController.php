<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\BusinessInfoRequest;
use App\Repositories\BusinessInfoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class BusinessInfoController extends Controller
{
    private $repository;

    public function __construct(BusinessInfoRepository $repository)
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
        if(Gate::denies('view-business-info'))
            return redirect('/');

        $businessInfo = $this->repository->paginate();

        return view('painel.business_info.index', compact('businessInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/business_info');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusinessInfoRequest $request)
    {
        return redirect('/business_info');
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
        if(Gate::denies('update-business-info'))
            return redirect('/');

        $businessInfo = $this->repository->find($id);

        return view('painel.business_info.edit', compact('businessInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BusinessInfoRequest $request, $id = 1)
    {
        if(Gate::denies('update-business-info'))
            return redirect('/');

        $data = $request->all();

        $this->repository->update($data, 1);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Informações da Empresa alterada com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('business_info.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect('/business_info');
    }
}
