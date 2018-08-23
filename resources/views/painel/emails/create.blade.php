@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Novo Email</h1>
    </div>

    @include('painel.layout.errors')

    {!! Form::open(['route' => 'emails.store']) !!}
        @include('painel.emails._form')
    {!! Form::close() !!}
@endsection
