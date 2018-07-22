<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\SocialMediaRequest;
use App\Repositories\SocialMediaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class SocialMediaController extends Controller
{
    private $repository;

    public function __construct(SocialMediaRepository $repository)
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
        if(Gate::denies('view-socialmedias'))
            return redirect('/');

        $socialmedias = $this->repository->paginate();

        return view('painel.socialmedias.index', compact('socialmedias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-socialmedias'))
            return redirect('/');

        return view('painel.socialmedias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialMediaRequest $request)
    {
        if(Gate::denies('create-socialmedias'))
            return redirect('/');

        $data = $request->all();

        $this->repository->create($data);

        $this->storeInCache();

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Mídia Social salva com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/socialmedias');
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
        if(Gate::denies('update-socialmedias'))
            return redirect('/');

        $socialmedia = $this->repository->find($id);

        return view('painel.socialmedias.edit', compact('socialmedia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialMediaRequest $request, $id)
    {
        if(Gate::denies('update-socialmedias'))
            return redirect('/');

        $data = $request->all();

        $this->repository->update($data, $id);

        $this->storeInCache();

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Mídia Social alterada com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('socialmedias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-socialmedias'))
            return redirect('/');

        $this->repository->delete($id);

        $this->storeInCache();

        //Grava Log
        Activity::all()->last();

        return redirect()->route('socialmedias.index');
    }

    private function storeInCache()
    {
        $socialMedias = $this->repository->findWhere([
            ['active', '=', 1],
            ['url', '<>', null],
        ]);

        Cache::forever('socialmedias', $socialMedias);
    }
}
