<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid menu">
        <div class="navbar-header">
            <a href='{{route('site.index')}}' title='{{env('APP_NAME')}}' class='logo navbar-brand'>
                <img src='/img/template/ufcc-logo.png' alt='{{env('APP_NAME')}}' class='img-responsive'>
            </a>
        </div>

        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>


    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href='#'>Home</a>
            </li>
            <li>
                <a href='#'>Empresa</a>
            </li>
            <li>
                <a href='{{route('site.investimentos')}}'>Investimentos</a>
            </li>
            <li>
                <a href='#'>Contato</a>
            </li>
            <li>
                <a href='{{route('site.faq')}}'>FAQ</a>
            </li>

            @foreach (Cache::get('socialmedias') as $socialMedia)
                <li>
                    <a href='{{$socialMedia->url}}' title='{{$socialMedia->name}}' target='_blank' class='no-padding no-margin'>
                        {!!$socialMedia->icon!!}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>