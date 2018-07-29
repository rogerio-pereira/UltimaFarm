<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\FaqRequest;
use App\Repositories\FaqRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class FaqController extends Controller
{
    private $repository;

    public function __construct(FaqRepository $repository)
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
        if(Gate::denies('view-faqs'))
            return redirect('/');

        $faqs = $this->repository->paginate();

        return view('painel.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-faqs'))
            return redirect('/');

        return view('painel.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        if(Gate::denies('create-faqs'))
            return redirect('/');

        $data = $request->all();
        if(substr($data['question'], -1) != '?')
            $data['question'] .= '?';

        $this->repository->create($data);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Faq salva com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/faqs');
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
        if(Gate::denies('update-faqs'))
            return redirect('/');

        $faq = $this->repository->find($id);

        return view('painel.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, $id)
    {
        if(Gate::denies('update-faqs'))
            return redirect('/');

        $data = $request->all();
        if(substr($data['question'], -1) != '?')
            $data['question'] .= '?';

        $this->repository->update($data, $id);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Faq alterada com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-faqs'))
            return redirect('/');

        $this->repository->delete($id);

        //Grava Log
        Activity::all()->last();

        return redirect()->route('faqs.index');
    }
}
