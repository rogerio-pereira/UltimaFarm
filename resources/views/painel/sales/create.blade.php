@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Nova Venda</h1>
    </div>

    @include('painel.layout.errors')

    {!! Form::open(['route' => 'sales.store']) !!}
        @include('painel.sales._form')
    {!! Form::close() !!}
@endsection
