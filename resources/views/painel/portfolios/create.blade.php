@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Novo Portifólio</h1>
    </div>

    @include('painel.layout.errors')

    {!! Form::open(['route' => 'portfolios.store']) !!}
        @include('painel.portfolios._form')
    {!! Form::close() !!}
@endsection
