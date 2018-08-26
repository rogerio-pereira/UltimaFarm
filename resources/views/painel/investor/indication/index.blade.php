@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Indicação</h1>
    </div>

    <script type="text/javascript" src="https://marketing.ultimatefarmcannabiscenter.com.br/form/generate.js?id=4"></script>
@endsection

@section('scripts')
    <script>
        $('#mauticform_input_indicacao_hash').val('{{Auth::user()->client->hash}}');
    </script>
@endsection
