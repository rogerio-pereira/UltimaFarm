@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Categoria de Produto: {{$productCategory->title}}  - ID: {{$productCategory->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($productCategory, ['route' => ['product_categories.update', $productCategory->id], 'method' => 'put']) !!}
        @include('painel.product_categories._form')
    {!! Form::close() !!}
@endsection