<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        @include('site.layout.meta')

        {{--Styles--}}
        {!! Html::style('css/app.css') !!}
        {!! Html::style('css/painel/style.min.css') !!}
    </head>
    <body>
        <header>
            <nav class="navbar navbar-default navbar-static-top navbar-inverse">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            @if (!Auth::guest())
                                @include('painel.layout.menu')
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <section>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='container-fluid'>
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>

        <div class='clearfix'></div>

        <footer class='text-center'>
            &copy; 2017 - 
            <a href='http://colmeiatecnologia.com.br' alt='Colmeia Tecnolgia' title='Colmeia Tecnolgia'>
                Colmeia Tecnolgia
            </a>
        </footer>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/painel/toggle/toggle.min.js') }}"></script>
        @yield('scripts')
    </body>
</html>
