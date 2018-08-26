@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Novo Depoimento</h1>
    </div>

    @include('painel.layout.errors')

    {!! Form::open(['route' => 'depoiments.store']) !!}
        @include('painel.depoiments._form')
    {!! Form::close() !!}
@endsection
