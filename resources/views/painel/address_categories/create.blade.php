@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Novo Local</h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::open(['route' => 'address-categories.store']) !!}
        @include('painel.address_categories._form')
    {!! Form::close() !!}
@endsection
