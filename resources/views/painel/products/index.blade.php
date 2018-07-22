@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Produtos</h1>
    </div>

    @can('create-products')
        <div class='col-md-12 text-center'>
            <a href='{{route('products.create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
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
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Categoria</th>
                <th>Subcategoria</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <td>
                    @can('delete-products')
                        {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                    
                    @can('update-products')
                        <a href='products/{{$product->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>R$ {{number_format($product->price, 2, ',', '.')}}</td>
                <td>{{$product->quantity}}</td>
                <td>
                    @if(isset($product->category->title))
                        {{$product->category->title}}
                    @endif
                </td>
                <td>
                    @if(isset($product->subcategory->title))
                        {{$product->subcategory->title}}
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan='7' class='text-center'>
                    Nenhum Produto cadastrado
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$products->render()}}
    </div>
@endsection
