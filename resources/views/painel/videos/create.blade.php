@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Novo Video</h1>
    </div>

    @include('painel.layout.errors')

    {!! Form::open(['route' => 'videos.store']) !!}
        @include('painel.videos._form')
    {!! Form::close() !!}
@endsection
