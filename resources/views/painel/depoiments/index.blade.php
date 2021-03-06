@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Depoimentos</h1>
    </div>

    @can('create-depoiments')
        <div class='col-md-12 text-center'>
            <a href='{{route('depoiments.create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
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
                <th>Depoimento</th>
                <th width="150px">Imagem</th>
                <th width="100px">Ativo</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($depoiments as $depoiment)
            <tr>
                <td>
                    @can('delete-depoiments')
                        {!! Form::open(['route' => ['depoiments.destroy', $depoiment->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan

                    @can('update-depoiments')
                        <a href='depoiments/{{$depoiment->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$depoiment->id}}</td>
                <td>{{$depoiment->name}}</td>
                <td>{{$depoiment->depoiment}}</td>
                <td>
                    <img src='{{$depoiment->image}}' class='img-responsive img-circle'>
                </td>
                <td>
                    @php
                        $checked = '';

                        if($depoiment->active == true)
                            $checked = 'checked';
                    @endphp

                    <input type="checkbox" {{$checked}} class='checkboxActive' data-model="Depoiment" data-id="{{$depoiment->id}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Ativo" data-off="Inativo" >
                </td>
            </tr>
            @empty
            <tr>
                <td colspan='6' class='text-center'>
                    Nenhum Depoimento cadastrado
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$depoiments->render()}}
    </div>
@endsection
