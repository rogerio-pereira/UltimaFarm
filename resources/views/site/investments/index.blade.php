@extends('site.layout.layout')

@section('css')
    {!! Html::style('/css/site/investments.min.css') !!}
@endsection

@section('content')
    <div class='container siteContainer margin-top'>
        @php
            $rowCount = 0;
        @endphp

        @foreach ($pagesInvestments as $page)
            @php
                if($rowCount%2 == 0) {
                    $push = 'col-md-push-4';
                    $pull = 'col-md-pull-8';
                }
                else {
                    $push = '';
                    $pull = '';
                }
            @endphp

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

        {{--Video--}}
        <div class='row margin-top margin-bottom padding-top-p padding-bottom-g border-bottom-golden text-center'>
            <div class='col-md-8'>
                <h2 class='margin-bottom'>{{$video->title}}</h2>
                {!!$video->description!!}
            </div>

            <div class='col-md-4 img-center'>
                @php
                    $video->url = str_replace('watch?v=', 'embed/', $video->url);
                @endphp

                <div class="embed-responsive embed-responsive-4by3">
                    <iframe width="560" height="315" src="{{$video->url}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        {{--Cadastro--}}
        <div class='row margin-top margin-bottom padding-top-p padding-bottom-g border-bottom-golden text-center'>
            <div class='col-md-12 text-center'>
                <h2>Vamos dar o próximo passo?</h2>
            </div>

            <div class='col-md-8'>
                <p>
                    Ao se cadastrar um corretor irá entrar em contato com você para avaliar sua capacidade de investimento e indicar qual o melhor investimento mais indicado para o seu perfil. Devido a nossa demanda de contato, o retorno inicial pode ocorre em até 72 horas.
                </p>

                <p>
                    Para realizar o seu cadastro tenha em mãos o seu RG e CPF ou Carteira de Motorista.
                </p>
            </div>

            <div class='col-md-4 text-center'>
                <h3 class='black margin-top'>Falar com um Corretor</h3>

                <a href='{{route('site.cadastro')}}' class='btn btn-primary investmentRegisterButton'>
                    Cadastrar-se
                </a>
            </div>
        </div>
    </div>
@endsection
