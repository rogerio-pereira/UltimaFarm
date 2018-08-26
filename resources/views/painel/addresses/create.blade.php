@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Novo Endereço</h1>
    </div>

    @include('painel.layout.errors')

    {!! Form::open(['route' => 'addresses.store']) !!}
        @include('painel.addresses._form')
    {!! Form::close() !!}
@endsection

@section('scripts')
    {!! Html::script('/js/common/maskedinput.min.js') !!}
    {!! Html::script('/js/common/mascaras.min.js') !!}
@endsection