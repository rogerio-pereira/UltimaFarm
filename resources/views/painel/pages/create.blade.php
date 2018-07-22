@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Nova Página</h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::open(['route' => 'pages.store']) !!}
        @include('painel.pages._form')
    {!! Form::close() !!}
@endsection
