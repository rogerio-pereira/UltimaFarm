<?php

namespace App\Http\Controllers\Painel;

use App\Criteria\Report\ReportCriteria;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PainelController extends Controller
{
    public function index()
    {
        if(Auth::user()->role != 'Cliente')
            $return = $this->painelHome();
        else
            $return = $this->painelUser();

        return $return;
    }

    private function painelHome()
    {
        $controlador  = new ChartsController();

        $controlador->getClients();
        $controlador->getSales();
        $controlador->getComissions();
        $controlador->getRefunds();
        $controlador->getComissionRefunds();

        return view('painel.index');
    }

    private function painelUser()
    {
        return view('painel.indexUser');
    }
}
