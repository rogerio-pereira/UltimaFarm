@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Categorias de Posts</h1>
    </div>

    @can('create-post_categories')
        <div class='col-md-12 text-center'>
            <a href='{{route('post_categories.create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
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
            @forelse ($postCategories as $postCategory)
            <tr>
                <td>
                    @can('delete-post_categories')
                        {!! Form::open(['route' => ['post_categories.destroy', $postCategory->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                    
                    @can('update-post_categories')
                        <a href='post_categories/{{$postCategory->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$postCategory->id}}</td>
                <td>{{$postCategory->title}}</td>
            </tr>
            @empty
            <tr>
                <td colspan='3' class='text-center'>
                    Nenhuma Categoria de Post cadastrada
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$postCategories->render()}}
    </div>
@endsection
