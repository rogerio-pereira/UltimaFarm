@extends('site.layout.layout')

@section('css')
    {!! Html::style('/css/site/home.min.css') !!}
@endsection

@section('content')
    <div class='col-md-12 videoHome'>
        <video poster="{{asset('movies/farm-poster.png')}}" autobuffer="true" autoplay loop>
            <source src="{{asset('movies/farm.mp4')}}"  type="video/mp4">
        </video>
    </div>

    <div>&nbsp;</div>

    <div class='container margin-top'>
        <div class='row'>
            <div class='homeInfo'>
                <div class='col-md-4'>
                    <div class='padding-left-g padding-right-g text-center'>
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle-o fa-stack-2x"></i>
                            <i class="fa fa-usd fa-stack-1x"></i>
                        </span>
                        <br/>
                        Investimento garantido<br/> pelo UFCC &<br/> Allstate Farm
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='padding-left-g padding-right-g text-center border-left border-right'>
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle-o fa-stack-2x"></i>
                            <i class="fa fa-lightbulb-o fa-stack-1x"></i>
                        </span>
                        <br/>
                        A segurança de investimento do mercado americano a apenas um clique de alcance
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='padding-left-g padding-right-g text-center'>
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle-o fa-stack-2x"></i>
                            <i class="fa fa-percent fa-stack-1x"></i>
                        </span>
                        <br/>
                        Taxas de rentabilidade pré-fixadas podendo chegar em até a 40% sobre o investido
                    </div>
                </div>
            </div>
        </div>

        @php
            $rowCount = 0;
        @endphp
        @php
            if($rowCount%2 == 1) {
                $push = 'col-md-push-4';
                $pull = 'col-md-pull-8';
            }
            else {
                $push = '';
                $pull = '';
            }
        @endphp

        <div class='row margin-top padding-top-p border-top-golden text-center'>
            <div class='col-md-8 {{$push}}'>
                <h2>Loren Ipsum</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>

            <div class='col-md-4 {{$pull}} img-center'>
                <img src='{{--$imagem--}}' class='img-responsive' alt='{{--$description--}}' title='{{--$title--}}'>
            </div>
        </div>
    </div>
@endsection
