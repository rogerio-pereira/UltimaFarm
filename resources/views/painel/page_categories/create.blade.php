@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Nova Categoria de Página</h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::open(['route' => 'page_categories.store']) !!}
        @include('painel.page_categories._form')
    {!! Form::close() !!}
@endsection
