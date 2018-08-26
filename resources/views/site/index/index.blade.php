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
        @php
            $rowCount = 0;
        @endphp

        @foreach ($pages as $page)
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

        <div class='row margin-top margin-bottom-g padding-top-p homeBlog'>
            <h1 class='text-center'>Blog</h1>
                
            <div class='row'>
                @foreach ($posts as $post)
                    <div class='col-md-4'>
                        @php
                            $titleUrl = App\Http\Controllers\Util\UrlController::friendlyUrl($post->title);
                        @endphp
                        <a href='{{route('blog.show', ['id' => $post->id, 'title' => $titleUrl])}}'>
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
        <div class='container margin-top padding-top'>
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
                                        <a href='{{route('site.cadastro')}}'>
                                            Contratar<br/>Agora
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class='col-md-12 text-center margin-top-g '>
                        <a href='{{route('site.cadastro')}}' title='Outros Planos' class='btn btn-primary'>
                            Outros planos
                        </a>
                    </div>
                </div>
            </div>
        </div>
@endsection
