@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Email: {{$email->email}}  - ID: {{$email->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($email, ['route' => ['emails.update', $email->id], 'method' => 'put']) !!}
        @include('painel.emails._form')
    {!! Form::close() !!}
@endsection