@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Video: {{$video->title}}  - ID: {{$video->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($video, ['route' => ['videos.update', $video->id], 'method' => 'put']) !!}
        @include('painel.videos._form')
    {!! Form::close() !!}
@endsection