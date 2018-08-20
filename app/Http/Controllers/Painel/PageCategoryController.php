<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\PageCategoryRequest;
use App\Repositories\PageCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class PageCategoryController extends Controller
{
    private $repository;

    public function __construct(PageCategoryRepository $repository)
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
        if(Gate::denies('view-page_categories'))
            return redirect('/');

        $pageCategories = $this->repository->paginate();

        return view('painel.page_categories.index', compact('pageCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-page_categories'))
            return redirect('/');

        return view('painel.page_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageCategoryRequest $request)
    {
        if(Gate::denies('create-page_categories'))
            return redirect('/');

        $data = $request->all();

        $this->repository->create($data);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Categoria de Página salva com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('page_categories.index');
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
        if(Gate::denies('update-page_categories'))
            return redirect('/');

        $pageCategory = $this->repository->find($id);

        return view('painel.page_categories.edit', compact('pageCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageCategoryRequest $request, $id)
    {
        if(Gate::denies('update-page_categories'))
            return redirect('/');

        $data = $request->all();

        $this->repository->update($data, $id);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Categoria de Página alterada com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('page_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-page_categories'))
            return redirect('/');

        $this->repository->delete($id);

        //Grava Log
        Activity::all()->last();

        return redirect()->route('page_categories.index');
    }
}
