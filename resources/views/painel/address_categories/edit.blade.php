@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Local: {{$addressCategory->name}}  - ID: {{$addressCategory->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($addressCategory, ['route' => ['address-categories.update', $addressCategory->id], 'method' => 'put']) !!}
        @include('painel.address_categories._form')
    {!! Form::close() !!}
@endsection