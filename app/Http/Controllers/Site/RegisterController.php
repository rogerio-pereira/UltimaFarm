<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ClientRequest;
use App\Models\Address\States;
use App\Services\Painel\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    private $service;

    public function __construct(ClientService $service)
    {
        $this->service = $service;
    }

    public function index($hash = null)
    {
        $states = States::getStates();

        return view('site.register.index', compact('states', 'hash'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $data = $request->all();
        $data['user']['role'] = 'Cliente';

        $user = $this->service->store($data);

        Session::flash('message', ['Cadastro efetivado com sucesso, acesse o seu email para mais informações!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->back();
    }
}
