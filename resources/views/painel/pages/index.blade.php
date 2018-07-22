@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Páginas</h1>
    </div>

    @can('create-pages')
        <div class='col-md-12 text-center'>
            <a href='{{url('/pages/create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
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
                <th>Titulo</th>
                <th>Descrição</th>
                <th width="150px">Imagem</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pages as $page)
            <tr>
                <td>
                    @can('delete-pages')
                        {!! Form::open(['route' => ['pages.destroy', $page->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan

                    @can('update-pages')
                        <a href='pages/{{$page->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$page->id}}</td>
                <td>{{$page->title}}</td>
                <td>{{$page->description}}</td>
                <td>
                    <img src='{{$page->image}}' class='img-responsive'>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan='6' class='text-center'>
                    Nenhuma Página cadastrada
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$pages->render()}}
    </div>
@endsection
