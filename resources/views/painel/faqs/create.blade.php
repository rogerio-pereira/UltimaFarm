@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Nova FAQ</h1>
    </div>

    @include('painel.layout.errors')

    {!! Form::open(['route' => 'faqs.store']) !!}
        @include('painel.faqs._form')
    {!! Form::close() !!}
@endsection
