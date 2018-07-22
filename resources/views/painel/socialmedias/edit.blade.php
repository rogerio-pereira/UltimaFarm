@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Mídia Social: {{$socialmedia->name}}  - ID: {{$socialmedia->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($socialmedia, ['route' => ['socialmedias.update', $socialmedia->id], 'method' => 'put']) !!}
        @include('painel.socialmedias._form')
    {!! Form::close() !!}
@endsection