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
        @include('site.layout._analytics')

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
    </body>
    
    {{--JS--}}
    {!! Html::script('/js/app.js') !!}
    {!! Html::script('/js/site/template.min.js') !!}
    @yield('scripts')
</html>
