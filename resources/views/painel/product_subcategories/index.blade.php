@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Subcategorias de Produtos</h1>
    </div>

    @can('create-product_subcategories')
        <div class='col-md-12 text-center'>
            <a href='{{route('product_subcategories.create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
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
                <th>Categoria</th>
                <th>Subcategoria</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productSubcategories as $productSubcategory)
            <tr>
                <td>
                    @can('delete-product_subcategories')
                        {!! Form::open(['route' => ['product_subcategories.destroy', $productSubcategory->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                    
                    @can('update-product_subcategories')
                        <a href='product_subcategories/{{$productSubcategory->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$productSubcategory->id}}</td>
                <td>{{$productSubcategory->category->title}}</td>
                <td>{{$productSubcategory->title}}</td>
            </tr>
            @empty
            <tr>
                <td colspan='4' class='text-center'>
                    Nenhuma Subcategoria de Produto cadastrada
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$productSubcategories->render()}}
    </div>
@endsection
