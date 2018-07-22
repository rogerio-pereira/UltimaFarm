@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Página: {{$page->title}}  - ID: {{$page->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($page, ['route' => ['pages.update', $page->id], 'method' => 'put']) !!}
        @include('painel.pages._form')
    {!! Form::close() !!}
@endsection