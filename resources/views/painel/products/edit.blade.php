@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Produto: {{$product->title}}  - ID: {{$product->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'put']) !!}
        @include('painel.products._form')
    {!! Form::close() !!}
@endsection