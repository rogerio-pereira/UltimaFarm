@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Novo Produto</h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::open(['route' => 'products.store']) !!}
        @include('painel.products._form')
    {!! Form::close() !!}
@endsection
