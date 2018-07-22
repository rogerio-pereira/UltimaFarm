@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Cliente: {{$client->title}}  - ID: {{$client->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($client, ['route' => ['clients.update', $client->id], 'method' => 'put']) !!}
        @include('painel.clients._form')
    {!! Form::close() !!}
@endsection