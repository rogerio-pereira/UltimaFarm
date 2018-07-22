@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Novo Post</h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::open(['route' => 'posts.store']) !!}
        @include('painel.posts._form')
    {!! Form::close() !!}
@endsection
