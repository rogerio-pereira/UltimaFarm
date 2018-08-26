@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Clientes</h1>
    </div>

    @can('create-clients')
        <div class='col-md-12 text-center'>
            <a href='{{route('clients.create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
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
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Documento</th>
                <th>Endereço</th>
                <th>Indicado por:</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clients as $client)
            <tr>
                <td>
                    @can('delete-clients')
                        {!! Form::open(['route' => ['clients.destroy', $client->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan

                    @can('update-clients')
                        <a href='clients/{{$client->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$client->id}}</td>
                <td>{{$client->user->name}}</td>
                <td><a href='mailto:{{$client->user->email}}'>{{$client->user->email}}</td>
                <td>{{$client->telephone}}</td>
                <td>{{$client->document}}</td>
                <td>
                    @php
                        $address = $client->street.', '.$client->number;

                        if(isset($client->complement))
                            $address .= ' - '.$client->complement;

                        $address .= '. '.$client->neighborhood.
                        '. '.$client->city.
                        ' - '.$client->state.
                        '. '.$client->zipcode;
                    @endphp

                    {{$address}}
                </td>
                <td>
                    @if(isset($client->indication_id))
                        {{$client->indication->user->name}}
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan='8' class='text-center'>
                    Nenhum Cliente cadastrado
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$clients->render()}}
    </div>
@endsection
