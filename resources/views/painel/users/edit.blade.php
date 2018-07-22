@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>
            Alterar Usuário: {{$user->title}}  - ID: {{$user->id}}
        </h1>
    </div>

    <div class='col-md-12'>
        @include('painel.layout.errors')
    </div>

    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
        @include('painel.users._form')
    {!! Form::close() !!}
@endsection