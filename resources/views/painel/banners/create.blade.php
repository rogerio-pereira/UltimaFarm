@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Novo Banner</h1>
    </div>

    @include('painel.layout.errors')

    {!! Form::open(['route' => 'banners.store']) !!}
        @include('painel.banners._form')
    {!! Form::close() !!}
@endsection
