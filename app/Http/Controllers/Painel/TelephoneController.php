<?php

namespace App\Http\Controllers\Painel;

use App\Criteria\Address\OrderByCategoryCriteria;
use App\Criteria\Util\ActiveCriteria;
use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\TelephoneRequest;
use App\Repositories\AddressCategoryRepository;
use App\Repositories\TelephoneRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class TelephoneController extends Controller
{
    private $repository;
    private $addressCategoryRepository;

    public function __construct(
                                    TelephoneRepository $repository,
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
        if(Gate::denies('view-telephones'))
            return redirect('/');

        $telephones = $this->repository->paginate();

        return view('painel.telephones.index', compact('telephones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-telephones'))
            return redirect('/');

        $categories = $this->addressCategoryRepository->comboboxList();

        return view('painel.telephones.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TelephoneRequest $request)
    {
        if(Gate::denies('create-telephones'))
            return redirect('/');

        $data = $request->all();

        $this->repository->create($data);

        //Grava Log
        Activity::all()->last();

        $this->storeinCache();

        Session::flash('message', ['Telefone salvo com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/telephones');
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
        if(Gate::denies('update-telephones'))
            return redirect('/');

        $telephone = $this->repository->find($id);
        $categories = $this->addressCategoryRepository->comboboxList();

        return view('painel.telephones.edit', compact('telephone', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TelephoneRequest $request, $id)
    {
        if(Gate::denies('update-telephones'))
            return redirect('/');

        $data = $request->all();

        $this->repository->update($data, $id);

        //Grava Log
        Activity::all()->last();

        $this->storeinCache();

        Session::flash('message', ['Telefone alterado com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('telephones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-telephones'))
            return redirect('/');

        $this->repository->delete($id);

        //Grava Log
        Activity::all()->last();

        $this->storeinCache();

        return redirect()->route('telephones.index');
    }

    private function storeInCache()
    {
        $telephones = $this
                        ->repository
                        ->pushCriteria(OrderByCategoryCriteria::class)
                        ->pushCriteria(ActiveCriteria::class)
                        ->all();
        $expiresAt = Carbon::now()->addDays(1);
        Cache::put('telephones', $telephones, $expiresAt);
    }
}
