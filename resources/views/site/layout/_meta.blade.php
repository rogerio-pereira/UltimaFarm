{{--
    TAGS QUE PRECISAM ALTERAR DENTRO DO BODY
        title,
        meta_description
        meta_title
        og_title
        og_description
        itemprop_description
--}}

<meta name='language' content='Portuguese' />
<meta property='og:locale' content='pt_BR' />
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta charset='UTF-8' />

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv='Expires' content='none' />
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />

<meta name='viewport' content='width=device-width, initial-scale=1.0' />

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel='shortcut icon' href='{{ asset('img/template/favicon.ico') }}' type='image/x-icon' />

<meta name='author' content='{{ config('app.name')}}' />
<meta name='copyright' content='{{ config('app.name')}}' />
<meta name='generator' content='{{ config('app.name')}}' />
<meta itemprop='name' content='{{ config('app.name') }}' />
<meta property='og:site_name' content='{{ config('app.name') }}' />

<meta name='GENERATOR' content='MSHTML 6.00.3790.3959' />
<meta name='robots' content='index, follow'/>
<meta name='DISTRIBUTION' content='GLOBAL' />
<meta name='RATING' content='General, HTML' />
<meta name='REVISIT-AFTER' content='7 days' />
<meta name='Audience' content='All' />

<meta name='url' content='http://{{$_SERVER['HTTP_HOST']}}{{$_SERVER['REQUEST_URI']}}' />
<meta property='og:url' content='http://{{$_SERVER['HTTP_HOST']}}{{$_SERVER['REQUEST_URI']}}'/>


<title>{{ $title or config('app.name') }}</title>
<meta name='title' content='{{ $title or config('app.name') }}'/>
<meta property='og:title' content='{{ $title or config('app.name') }}' />


<meta name='description' content='{{ $description or config('app.name') }}' />
<meta property='og:description' content='{{ $description or config('app.name') }}' />
<meta itemprop='description' content='{{ $description or config('app.name') }}' />


<meta property='og:image' content='{{ $image or config('app.name') }}' />
<meta itemprop='image' content='{{ $image or config('app.name') }}' />