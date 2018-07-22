@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Categorias de Produtos</h1>
    </div>

    @can('create-product_categories')
        <div class='col-md-12 text-center'>
            <a href='{{route('product_categories.create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
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
            @forelse ($productCategories as $productCategory)
            <tr>
                <td>
                    @can('delete-product_categories')
                        {!! Form::open(['route' => ['product_categories.destroy', $productCategory->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                    
                    @can('update-   ')
                        <a href='product_categories/{{$productCategory->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$productCategory->id}}</td>
                <td>{{$productCategory->title}}</td>
            </tr>
            @empty
            <tr>
                <td colspan='3' class='text-center'>
                    Nenhuma Categoria de Produto cadastrada
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$productCategories->render()}}
    </div>
@endsection
