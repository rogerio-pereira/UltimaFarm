@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Nova Subcategoria de Produto</h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::open(['route' => 'product_subcategories.store']) !!}
        @include('painel.product_subcategories._form')
    {!! Form::close() !!}
@endsection
