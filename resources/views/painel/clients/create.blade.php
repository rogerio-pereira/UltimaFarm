@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Novo Cliente</h1>
    </div>

    @include('painel.layout.errors')

    {!! Form::open(['route' => 'clients.store']) !!}
        @include('painel.clients._form')
    {!! Form::close() !!}
@endsection
