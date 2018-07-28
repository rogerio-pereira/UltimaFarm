@extends('painel.layout.layout')

@section('content')
    <div class='margin-top'>
        <div class='col-md-6'>
            <div class='panel panel-info'>
                <div class='panel-heading text-center'>
                    <h1 class='panel-title'>Número de Clientes</h1>
                </div>
                <div class='panel-body'>
                    <div class='chart' id='clientsChart'></div>
                </div>
            </div>
        </div>

        <div class='col-md-6'>
            <div class='panel panel-info'>
                <div class='panel-heading text-center'>
                    <h1 class='panel-title'>Total de Vendas</h1>
                </div>
                <div class='panel-body'>
                    <div class='chart' id='salesChart'></div>
                </div>
            </div>
        </div>

        <div class='col-md-6'>
            <div class='panel panel-info'>
                <div class='panel-heading text-center'>
                    <h1 class='panel-title'>Total de Reembolso</h1>
                </div>
                <div class='panel-body'>
                    <div class='chart' id='refundChart'></div>
                </div>
            </div>
        </div>
    </div>

    {!! \Lava::render('LineChart', 'clients', 'clientsChart') !!}
    {!! \Lava::render('LineChart', 'sales', 'salesChart') !!}
    {!! \Lava::render('LineChart', 'refunds', 'refundChart') !!}
@endsection