@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Nova Categoria de Produto</h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::open(['route' => 'product_categories.store']) !!}
        @include('painel.product_categories._form')
    {!! Form::close() !!}
@endsection
