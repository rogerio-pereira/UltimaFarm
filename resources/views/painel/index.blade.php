@extends('painel.layout.layout')

@section('content')
    <div class='margin-top'>
        <div class='col-md-6' id='clientsChart'></div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('/js/painel/home.min.js') !!}
@endsection