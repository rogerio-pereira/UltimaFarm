@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Portifólio: {{$portfolio->name}}  - ID: {{$portfolio->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($portfolio, ['route' => ['portfolios.update', $portfolio->id], 'method' => 'put']) !!}
        @include('painel.portfolios._form')
    {!! Form::close() !!}
@endsection