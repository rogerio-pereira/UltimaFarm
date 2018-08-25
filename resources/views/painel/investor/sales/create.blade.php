@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Novo Título</h1>
    </div>

    @include('painel.layout.errors')

    {!! Form::open(['route' => 'painel.investor.meus-titulos.store']) !!}
        @include('painel.investor.sales._form')
    {!! Form::close() !!}
@endsection

@section('scripts')
    {!! Html::script('/js/painel/sales.min.js') !!}
@endsection