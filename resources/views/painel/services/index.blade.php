@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Serviços</h1>
    </div>

    @can('create-services')
        <div class='col-md-12 text-center'>
            <a href='{{route('services.create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
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
                <th width="150px">Icone</th>
                <th width="100px">Ativo</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($services as $service)
            <tr>
                <td>
                    @can('delete-services')
                        {!! Form::open(['route' => ['services.destroy', $service->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan

                    @can('update-services')
                        <a href='services/{{$service->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$service->id}}</td>
                <td>{{$service->name}}</td>
                <td>{!!$service->icon!!}</i></td>
                <td>
                    @php
                        $checked = '';

                        if($service->active == true)
                            $checked = 'checked';
                    @endphp

                    <input type="checkbox" {{$checked}} class='checkboxActive' data-model="Service" data-id="{{$service->id}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Ativo" data-off="Inativo" >
                </td>
            </tr>
            @empty
            <tr>
                <td colspan='5' class='text-center'>
                    Nenhum Serviço cadastrado
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$services->render()}}
    </div>
@endsection
