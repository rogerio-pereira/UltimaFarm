<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        @include('site.layout._meta')

        {{-- Styles --}}
        {!! Html::style('/css/app.css') !!}
        @yield('css')
        {!! Html::style('/css/site/style.min.css') !!}
    </head>
    <body>
        <div class='google'>
            @include('site.layout._analytics')
        </div>

        <sidebar>
            <div class='sidebarContent'>
                @include('site.layout._sidebar')
            </div>

            <div class='sidebarClose'>
                <div class='sidebarIcon'>
                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </div>
            </div>
        </sidebar>
    
        <header>
            @include('site.layout._menu')
        </header>

        <section>
            @yield('content')
        </section>

        <footer>
            @include('site.layout._footer')
        </footer>

        <script>
            (function(w,d,t,u,n,a,m){w['MauticTrackingObject']=n;
                w[n]=w[n]||function(){(w[n].q=w[n].q||[]).push(arguments)},a=d.createElement(t),
                m=d.getElementsByTagName(t)[0];a.async=1;a.src=u;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://marketing.ultimatefarmcannabiscenter.com.br/mtc.js','mt');

            mt('send', 'pageview');
        </script>
    </body>
    
    {{--JS--}}
    {!! Html::script('/js/app.js') !!}
    {!! Html::script('/js/site/template.min.js') !!}
    @yield('scripts')
</html>
