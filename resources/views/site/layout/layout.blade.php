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
            <div class='row'>
                <div class='container'>
                    <div class='col-md-3 col-sm-6'>
                        Col 1
                    </div>

                    <div class='col-md-3 col-sm-6'>
                        Col 2
                    </div>

                    <div class='col-md-3 col-sm-6'>
                        Col 3
                    </div>

                    <div class='col-md-3 col-sm-6'>
                        Col 4
                    </div>
                </div>
            </div>

            <div class='copyright text-center'>
                &copy; 2018 {{env('APP_NAME')}} <br/>
                Desenvolvido por: 
                <a href='https://www.facebook.com/growthlabspocos/' alt='GrowthLabs' title='GrowthLabs' target='_blank'>
                    GrowthLabs
                </a> em parceria com 
                <a href='http://colmeiatecnologia.com.br' alt='Colmeia Tecnologia' title='Colmeia Tecnologia' target='_blank'>
                    Colmeia Tecnologia
                </a>
            </div>
        </footer>
    </body>
    
    {{--JS--}}
    {!! Html::script('/js/app.js') !!}
    {!! Html::script('/js/site/template.min.js') !!}
    @yield('scripts')
</html>
