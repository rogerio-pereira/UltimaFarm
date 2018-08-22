@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Depoimento: {{$depoiment->name}}  - ID: {{$depoiment->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($depoiment, ['route' => ['depoiments.update', $depoiment->id], 'method' => 'put']) !!}
        @include('painel.depoiments._form')
    {!! Form::close() !!}
@endsection