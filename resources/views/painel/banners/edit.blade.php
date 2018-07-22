@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Banner: {{$banner->title}}  - ID: {{$banner->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($banner, ['route' => ['banners.update', $banner->id], 'method' => 'put']) !!}
        @include('painel.banners._form')
    {!! Form::close() !!}
@endsection