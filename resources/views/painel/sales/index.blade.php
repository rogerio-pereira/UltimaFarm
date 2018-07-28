@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Vendas</h1>
    </div>

    @can('create-sales')
        <div class='col-md-12 text-center'>
            <a href='{{route('sales.create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
                Cadastrar
            </a>
            <br/>
            <br/>
        </div>
    @endcan

    <table class="table table-responsive table-striped table-bordered table-hovered">
        <thead>
            <tr>
                <th width="100px">Ações</th>
                <th width="100px">ID</th>
                <th>Cliente</th>
                <th>Documento</th>
                <th>Produto</th>
                <th>Valor</th>
                <th>Rentabilidade</th>
                <th>Prazo de Retirada</th>
                <th>Valor final</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sales as $sale)   
                <tr>
                    <td>
                        {{--<a href='sales/{{$sale->id}}' class='btn btn-info'>
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </a>--}}
                    </td>
                    <td>{{$sale->id}}</td>
                    <td>{{$sale->client->user->name}}</td>
                    <td>{{$sale->client->document}}</td>
                    <td>{{$sale->product->name}}</td>
                    <td>R$ {{number_format($sale->value, 2, ',', '.')}}</td>
                    <td>{{$sale->profitability}} %</td>
                    <td>
                        {{Carbon\Carbon::parse($sale->deadline)->format('d/m/Y')}}
                    </td>
                    <td>
                        R$ {{number_format($sale->refundValue, 2, ',', '.')}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan='9' class='text-center'>
                        Nenhuma Venda cadastrada
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$sales->render()}}
    </div>
@endsection
