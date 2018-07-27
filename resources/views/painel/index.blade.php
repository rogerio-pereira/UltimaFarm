@extends('painel.layout.layout')

@if(Auth::user()->role != 'Cliente')
    @section('content')
        <div class='margin-top'>
            <div class='col-md-6' id='clientsChart'></div>
        </div>
    @endsection

    @section('scripts') 
        {!! Html::script('/js/painel/home.min.js') !!}
    @endsection
@else
    @section('content')
        Home
    @endsection
@endif