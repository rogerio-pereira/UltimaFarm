@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Serviço: {{$service->title}}  - ID: {{$service->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($service, ['route' => ['services.update', $service->id], 'method' => 'put']) !!}
        @include('painel.services._form')
    {!! Form::close() !!}
@endsection