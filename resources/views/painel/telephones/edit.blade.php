@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Telefone: {{$telephone->telephone}} - ID: {{$telephone->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($telephone, ['route' => ['telephones.update', $telephone->id], 'method' => 'put']) !!}
        @include('painel.telephones._form')
    {!! Form::close() !!}
@endsection