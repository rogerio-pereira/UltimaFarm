@extends('site.layout.layout')

@section('content')
    <div class='container siteContainer padding-bottom-g'>
        <div class='col-md-12'>
            <h1>Empresa</h1>
        </div>

        <div class='row'>
            <div class='col-md-6'>
                <script type="text/javascript" src="https://marketing.ultimatefarmcannabiscenter.com.br/form/generate.js?id=1"></script>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('/js/common/maskedinput.min.js') !!}
    {!! Html::script('/js/common/mascaras.min.js') !!}
@endsection