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
                        <img src='{{asset('img/cifrao.png')}}' alt='Investimento garantido'>
                        <br/>
                        Investimento garantido<br/> pelo UFCC &<br/> Allstate Farm
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='padding-left-g padding-right-g text-center border-left border-right'>
                        <img src='{{asset('img/lampada.png')}}' alt='Segurança'>
                        <br/>
                        A segurança de investimento do mercado americano a apenas um clique de alcance
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='padding-left-g padding-right-g text-center'>
                        <img src='{{asset('img/percento.png')}}' alt='Taxas'>
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

        <div class='row margin-top margin-bottom-g padding-top-p border-top-golden homeBlog'>
            <h1 class='text-center'>Blog</h1>
                
            <div class='row'>
                @foreach ($posts as $post)
                    <div class='col-md-4'>
                        @php
                            $titleUrl = App\Http\Controllers\Util\UrlController::friendlyUrl($post->title);
                        @endphp
                        <a href='{{route('blog.post', ['id' => $post->id, 'title' => $titleUrl])}}'>
                            <img src='{{$post->image}}' class='img-responsive' alt='{{$post->title}}' title='{{$post->title}}'>
                            <div class='text-center'>
                                <strong>{{$post->title}}</strong>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class='col-md-12 text-center margin-top-g'>
                <a href='{{route('blog.index')}}' title='Blog' class='btn btn-primary'>
                    Acesse outros artigos
                </a>
            </div>
        </div>
    </div>
    </section>

    <div class='homeImageBackground'>
        &nbsp;
    </div>

    <section>
        <div class='container margin-top margin-bottom-negative padding-top'>
            <div class='margin-bottom-g'>
                <div class='text-center'>
                    <h1>Planos de Investimento</h1>
                </div>

                <div class='row'>
                    @foreach ($products as $product)
                        <div class='col-md-2 text-center'>
                            <div class='homeProduct'>
                                <div class='no-padding'>
                                    <h2>{{$product->name}}</h2>

                                    <p>
                                        Investimento<br/>
                                        <strong>R$ {{number_format($product->price, 2, ',', '.')}}</strong>
                                    </p>

                                    <p>
                                        Rentabilidade<br/>
                                        <strong>{{number_format($product->profitability, 2, ',', '.')}} %</strong>
                                    </p>

                                    <div class='rentNow'>
                                        Contratar<br/>Agora
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class='col-md-12 text-center margin-top-g '>
                        <a href='#' title='Outros Planos' class='btn btn-primary'>
                            Outros planos
                        </a>
                    </div>
                </div>
            </div>
        </div>
@endsection
