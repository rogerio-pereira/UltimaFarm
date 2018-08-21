@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Categoria de Página: {{$pageCategory->title}}  - ID: {{$pageCategory->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($pageCategory, ['route' => ['page_categories.update', $pageCategory->id], 'method' => 'put']) !!}
        @include('painel.page_categories._form')
    {!! Form::close() !!}
@endsection