@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Subcategoria de Produto: {{$productSubcategory->title}}  - ID: {{$productSubcategory->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($productSubcategory, ['route' => ['product_subcategories.update', $productSubcategory->id], 'method' => 'put']) !!}
        @include('painel.product_subcategories._form')
    {!! Form::close() !!}
@endsection