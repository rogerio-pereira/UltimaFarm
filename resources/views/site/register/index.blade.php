@extends('site.layout.layout')

@section('content')
    <div class='container siteContainer padding-bottom-g'>
        <div class='text-center'>
            <h1>Cadastro</h1>
        </div>

        @include('site.layout._errors')

        <div class='row'>
            {!! Form::open(['route' => 'site.cadastro.store']) !!}
                @include('site.register._form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('/js/common/maskedinput.min.js') !!}
    {!! Html::script('/js/common/mascaras.min.js') !!}
@endsection