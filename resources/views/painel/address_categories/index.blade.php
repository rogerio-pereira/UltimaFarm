@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Locais</h1>
    </div>

    @can('create-address-categories')
        <div class='col-md-12 text-center'>
            <a href='{{route('address-categories.create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
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
            </tr>
        </thead>
        <tbody>
            @forelse ($addressCategories as $addressCategory)
            <tr>
                <td>
                    @can('delete-address-categories')
                        {!! Form::open(['route' => ['address-categories.destroy', $addressCategory->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                    
                    @can('update-address-categories')
                        <a href='address-categories/{{$addressCategory->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$addressCategory->id}}</td>
                <td>{{$addressCategory->name}}</td>
            </tr>
            @empty
            <tr>
                <td colspan='3' class='text-center'>
                    Nenhum Local cadastrado
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$addressCategories->render()}}
    </div>
@endsection
