<?php

namespace App\Http\Controllers\Painel;

use App\Criteria\Report\ReportCriteria;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PainelController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index()
    {
        /*$clients = $this
                        ->clientRepository
                        ->pushCriteria(ReportCriteria::class)
                        ->get([
                                DB::raw("MONTH(created_at) as m"), 
                                DB::raw("YEAR(created_at) as y"), 
                                DB::raw("count(*) as total")
                            ]);*/

        return view('painel.index'/*, compact('clients')*/);
    }
}
