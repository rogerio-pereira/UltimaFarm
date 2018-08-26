@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Endereço: {{$address->name}}  - ID: {{$address->toString()}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($address, ['route' => ['addresses.update', $address->id], 'method' => 'put']) !!}
        @include('painel.addresses._form')
    {!! Form::close() !!}
@endsection

@section('scripts')
    {!! Html::script('/js/common/maskedinput.min.js') !!}
    {!! Html::script('/js/common/mascaras.min.js') !!}
@endsection