@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Categoria de Post: {{$postCategory->title}}  - ID: {{$postCategory->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($postCategory, ['route' => ['post_categories.update', $postCategory->id], 'method' => 'put']) !!}
        @include('painel.post_categories._form')
    {!! Form::close() !!}
@endsection