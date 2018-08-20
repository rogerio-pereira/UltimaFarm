@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Categorias de Páginas</h1>
    </div>

    @can('create-page_categories')
        <div class='col-md-12 text-center'>
            <a href='{{route('page_categories.create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
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
            </tr>
        </thead>
        <tbody>
            @forelse ($pageCategories as $pageCategory)
            <tr>
                <td>
                    @can('delete-page_categories')
                        {!! Form::open(['route' => ['page_categories.destroy', $pageCategory->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                    
                    @can('update-page_categories')
                        <a href='page_categories/{{$pageCategory->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$pageCategory->id}}</td>
                <td>{{$pageCategory->title}}</td>
            </tr>
            @empty
            <tr>
                <td colspan='3' class='text-center'>
                    Nenhuma Categoria de Página cadastrada
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$pageCategories->render()}}
    </div>
@endsection
