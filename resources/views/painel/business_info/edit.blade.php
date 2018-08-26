@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Informações da empresa
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($businessInfo, ['route' => ['business_info.update', $businessInfo->id], 'method' => 'put']) !!}
        @include('painel.business_info._form')
    {!! Form::close() !!}
@endsection