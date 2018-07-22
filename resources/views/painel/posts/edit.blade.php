@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Post: {{$post->title}}  - ID: {{$post->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'put']) !!}
        @include('painel.posts._form')
    {!! Form::close() !!}
@endsection