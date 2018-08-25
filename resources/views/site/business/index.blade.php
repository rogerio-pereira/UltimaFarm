@extends('site.layout.layout')

@section('css')
    {!! Html::style('/css/site/business.min.css') !!}
@endsection

@section('content')
    <div class='container siteContainer margin-top'>
        @php
            $rowCount = 0;
        @endphp

        @foreach ($pagesBusiness as $page)
            @php
                if($rowCount%2 == 1) {
                    $push = 'col-md-push-4';
                    $pull = 'col-md-pull-8';
                }
                else {
                    $push = '';
                    $pull = '';
                }

                $linkAnchor = App\Http\Controllers\Util\UrlController::friendlyUrl($page->title);
            @endphp
            
            <a id='{{$linkAnchor}}'></a>
            <div class='row margin-top padding-top-p padding-bottom-g border-bottom-golden text-center'>                
                {{--Apenas Texto--}}
                @if($page->show_title == false || ($page->image == null && $page->image == ''))
                    {!!$page->text!!}
                {{--Titulo e Imagem--}}
                @else
                    <div class='col-md-8 {{$push}}'>
                        <h2 class='margin-bottom'>{{$page->title}}</h2>
                        {!!$page->text!!}
                    </div>

                    <div class='col-md-4 {{$pull}} img-center'>
                        <img src='{{$page->image}}' class='img-responsive' alt='{{$page->description}}' title='{{$page->title}}'>
                    </div>
                @endif
            </div>

            @php
                $rowCount++;
            @endphp
        @endforeach

    {{--<div class='container siteContainer padding-bottom-g'>--}}
    <a id='trabalhe'></a>
    <div class='siteContainer padding-bottom-g'>
        <div class='col-md-12 text-center'>
            <h1>Trabalhe conosco</h1>
            <p>
                Quer fazer parte da nossa equipe? Então não perca mais tempo!<br/>
                Cadastre-se abaixo e nos encaminhe seu currículo.
            </p>
        </div>

        <div class='row'>
            <div class='col-md-6'>
                <script type="text/javascript" src="https://marketing.ultimatefarmcannabiscenter.com.br/form/generate.js?id=1"></script>
            </div>
            <div class='col-md-6'>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('/js/common/maskedinput.min.js') !!}
    {!! Html::script('/js/common/mascaras.min.js') !!}
@endsection