@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Endereços</h1>
    </div>

    @can('create-addresses')
        <div class='col-md-12 text-center'>
            <a href='{{route('addresses.create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
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
                <th>Local</th>
                <th>Endereço</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($addresses as $address)
            <tr>
                <td>
                    @can('delete-addresses')
                        {!! Form::open(['route' => ['addresses.destroy', $address->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan

                    @can('update-addresses')
                        <a href='addresses/{{$address->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$address->id}}</td>
                <td>{{$address->category->name}}</td>
                <td>{{$address->toString()}}</td>
            </tr>
            @empty
            <tr>
                <td colspan='4' class='text-center'>
                    Nenhum Endereço cadastrado
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$addresses->render()}}
    </div>
@endsection
