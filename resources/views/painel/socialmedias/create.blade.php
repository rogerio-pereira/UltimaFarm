@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Nova Mídia Social</h1>
    </div>

    @include('painel.layout.errors')

    {!! Form::open(['route' => 'socialmedias.store']) !!}
        @include('painel.socialmedias._form')
    {!! Form::close() !!}
@endsection
