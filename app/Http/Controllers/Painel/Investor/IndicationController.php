<?php

namespace App\Http\Controllers\Painel\Investor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('painel.investor.indication.index');
    }
}
