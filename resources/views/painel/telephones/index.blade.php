@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Telefones</h1>
    </div>

    @can('create-telephones')
        <div class='col-md-12 text-center'>
            <a href='{{route('telephones.create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
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
                <th>Descrição</th>
                <th>Telefone</th>
                <th width="50px">Whatsapp</th>
                <th width="100px">Ativo</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($telephones as $telephone)
            <tr>
                <td>
                    @can('delete-telephones')
                        {!! Form::open(['route' => ['telephones.destroy', $telephone->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan

                    @can('update-telephones')
                        <a href='telephones/{{$telephone->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$telephone->id}}</td>
                <td>{{$telephone->category->name}}</td>
                <td>{{$telephone->description}}</td>
                <td>{{$telephone->telephone}}</td>
                <td class='text-center'>
                    @if($telephone->whatsapp == true )
                        <i class="fa fa-whatsapp whatsappIcon fa-2x" aria-hidden="true"></i>
                    @endif
                </td>
                <td>
                    @php
                        $checked = '';

                        if($telephone->active == true)
                            $checked = 'checked';
                    @endphp

                    <input type="checkbox" {{$checked}} class='checkboxActive' data-model="Telephone" data-id="{{$telephone->id}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Ativo" data-off="Inativo" >
                </td>
            </tr>
            @empty
            <tr>
                <td colspan='7' class='text-center'>
                    Nenhum telefone cadastrado
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$telephones->render()}}
    </div>
@endsection
