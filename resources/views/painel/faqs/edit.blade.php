@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar FAQ: {{$faq->title}}  - ID: {{$faq->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($faq, ['route' => ['faqs.update', $faq->id], 'method' => 'put']) !!}
        @include('painel.faqs._form')
    {!! Form::close() !!}
@endsection