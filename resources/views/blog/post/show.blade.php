@extends('blog.layout.layout')

@section('blog-content')
    @php
        $title = $post->title;
        $description = $post->description;
        $image = $post->image;
    @endphp

    <div class='text-center'>
        <h1>{{$post->title}}</h1>
    </div>

    <div class='postImage margin-bottom'>
        <img src='{{$post->image}}' title='{{$post->title}}' class='img-responsive'>
    </div>

    <div class='row text-justify'>
        {!!$post->text!!}
    </div>

    <div class='author margin-top'>
        <p>
            {{$post->created_at->format('d/m/Y')}}<br/>
            <strong>{{$post->author->name}}</strong>
        </p>
    </div>

    <div class='row margin-top-g'>
        {{-- Facebook --}}
        <div id="fb-root"></div>
        @php
            $url = urlencode('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        @endphp

        <div class="fb-share-button" data-href="https://{{$_SERVER['HTTP_HOST']}}{{$_SERVER['REQUEST_URI']}}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url}}%2F&amp;src=sdkpreparse">Compartilhar</a></div>

        {{-- Twitter --}}
        <div style='position:relative; top: 5px !important; display: inline;'>
            <a class="twitter-share-button" href="https://twitter.com/intent/" data-size="large">Compartilhar no Tweeter</a>
        </div>

        {{-- Linkedin --}}
        <div style='position:relative; top: 2px !important; display: inline;'>
            <script type="IN/Share" data-counter="right"></script>
        </div>

        {{-- Pinterest --}}
        <div style='position:relative; top: 7px !important; display: inline;'>
            <a data-pin-do="buttonBookmark" data-pin-tall="true" data-pin-round="true" data-pin-save="false" href="https://www.pinterest.com/pin/create/button/"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_round_red_32.png" /></a>
        </div>

        {{-- Google+ --}}
        <div style='position:relative; top: 5px !important; display: inline;'>
            <div class="g-plusone" data-annotation="none" data-size="tall"></div>
        </div>
    </div>


    <div class='row margin-top-p'>
        <div class='col-md-12'>
            <div class="fb-comments" data-href="http://{{$_SERVER['HTTP_HOST']}}{{$_SERVER['REQUEST_URI']}}" data-width="100%" data-numposts="5"></div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Google+ --}}
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

    {{-- Facebook --}}
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=1424205961136633";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    {{-- Twitter --}}
    <script>window.twttr = (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
      if (d.getElementById(id)) return t;
      js = d.createElement(s);
      js.id = id;
      js.src = "https://platform.twitter.com/widgets.js";
      fjs.parentNode.insertBefore(js, fjs);

      t._e = [];
      t.ready = function(f) {
        t._e.push(f);
      };

      return t;
    }(document, "script", "twitter-wjs"));</script>

    {{-- Linkedin --}}
    <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: pt_BR</script>

    {{-- Pinterest --}}
    <script async defer src="//assets.pinterest.com/js/pinit.js"></script>
@endsection