<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\EmailRequest;
use App\Repositories\EmailRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class EmailController extends Controller
{
    private $repository;

    public function __construct(EmailRepository $repository)
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
        if(Gate::denies('view-emails'))
            return redirect('/');

        $emails = $this->repository->paginate();

        return view('painel.emails.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-emails'))
            return redirect('/');

        return view('painel.emails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailRequest $request)
    {
        if(Gate::denies('create-emails'))
            return redirect('/');

        $data = $request->all();

        $this->repository->create($data);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Email salvo com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/emails');
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
        if(Gate::denies('update-emails'))
            return redirect('/');

        $email = $this->repository->find($id);

        return view('painel.emails.edit', compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailRequest $request, $id)
    {
        if(Gate::denies('update-emails'))
            return redirect('/');

        $data = $request->all();

        $this->repository->update($data, $id);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Email alterado com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('emails.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-emails'))
            return redirect('/');

        $this->repository->delete($id);

        //Grava Log
        Activity::all()->last();

        return redirect()->route('emails.index');
    }
}
