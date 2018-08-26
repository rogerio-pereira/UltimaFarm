<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\DepoimentRequest;
use App\Repositories\DepoimentCategoryRepository;
use App\Repositories\DepoimentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class DepoimentController extends Controller
{
    private $repository;

    public function __construct(DepoimentRepository $repository )
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
        if(Gate::denies('view-depoiments'))
            return redirect('/');

        $depoiments = $this->repository->paginate();

        return view('painel.depoiments.index', compact('depoiments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-depoiments'))
            return redirect('/');

        return view('painel.depoiments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepoimentRequest $request)
    {
        if(Gate::denies('create-depoiments'))
            return redirect('/');

        $data = $request->all();

        $this->repository->create($data);

        //Grava Log
        Activity::all()->last();

        $this->storeinCache();

        Session::flash('message', ['Depoimento salvo com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/depoiments');
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
        if(Gate::denies('update-depoiments'))
            return redirect('/');

        $depoiment = $this->repository->find($id);

        return view('painel.depoiments.edit', compact('depoiment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepoimentRequest $request, $id)
    {
        if(Gate::denies('update-depoiments'))
            return redirect('/');

        $data = $request->all();

        $this->repository->update($data, $id);

        //Grava Log
        Activity::all()->last();

        $this->storeinCache();

        Session::flash('message', ['Depoimento alterado com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('depoiments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-depoiments'))
            return redirect('/');

        $this->repository->delete($id);

        //Grava Log
        Activity::all()->last();

        $this->storeinCache();

        return redirect()->route('depoiments.index');
    }

    private function storeinCache()
    {
        $depoiments = $this->repository->all();
        $expiresAt = Carbon::now()->addDays(1);
        Cache::put('depoiments', $depoiments, $expiresAt);
    }
}
