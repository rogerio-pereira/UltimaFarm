@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Comissões</h1>
    </div>

    <table class="table table-responsive table-striped table-bordered table-hovered">
        <thead>
            <tr>
                <th width="100px">ID</th>
                <th>Cliente</th>
                <th>Venda ID</th>
                <th>Venda Valor</th>
                <th>Venda Cliente</th>
                <th>Porcentagem</th>
                <th>Prazo de Retirada</th>
                <th>Valor</th>
                <th>Reembolsado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($comissions as $comission)   
                <tr>
                    <td>{{$comission->id}}</td>
                    <td>{{$comission->client->user->name}}</td>
                    <td>{{$comission->sale->id}}</td>
                    <td>R$ {{number_format($comission->sale->value, 2, ',', '.')}}</td>
                    <td>{{$comission->sale->client->user->name}}</td>
                    <td>{{$comission->sale->product->commission}} %</td>
                    <td>
                        {{Carbon\Carbon::parse($comission->deadline)->format('d/m/Y')}}
                    </td>
                    <td>
                        R$ {{number_format($comission->value, 2, ',', '.')}}
                    </td>
                    <td>
                        @if(Auth::user()->role != 'Cliente')
                            @can('create-refounds')
                                @if(!$comission->refunded)
                                    <div id='comission_{{$comission->id}}'>
                                        <a href="#" class="btn btn-warning confirmation-callback" data-id='{{$comission->id}}'>
                                            Reembolsar
                                        </a>
                                    </div>
                                @endif
                            @endcan
                        @else
                            @if($comission->refunded)
                                Sim
                            @else
                                Não
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan='10' class='text-center'>
                        Nenhuma Venda cadastrada
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$comissions->render()}}
    </div>
@endsection

@section('scripts')
    {!! Html::script('/js/painel/confirmation/bootstrap-confirmation.min.js') !!}
    {!! Html::script('/js/painel/comission.min.js') !!}
@endsection
