<div class='row'>
    <div class='container padding-top padding-bottom'>
        <div class='col-md-3 col-sm-6'>
            <a href='{{route('site.faq')}}'>FAQ</a>

            <div class='margin-top-g'>
                <h2>Razão Social</h2>
                {{Cache::get('businessInfo')->companyName}}

                <h2>CNPJ</h2>
                {{Cache::get('businessInfo')->cnpj}}
            </div>
        </div>

        <div class='col-md-3 col-sm-6'>
            <h2 class='no-margin margin-bottom'>Investimentos</h2>

            @foreach (Cache::get('footerInvestmentPages') as $page)
                @php
                    $linkAnchor = App\Http\Controllers\Util\UrlController::friendlyUrl($page->title);
                @endphp
                    <a href='{{route('site.investimentos')}}#{{$linkAnchor}}'>{{$page->title}}</a><br/>
            @endforeach
                <a href='{{route('site.investimentos')}}#video-institucional'>Video Institucional</a><br/>
                <a href='{{route('site.investimentos')}}#cadastro'>Cadastro</a><br/>
                <a href='{{route('site.investimentos')}}#depoimentos'>Depoimentos</a><br/>
        </div>

        <div class='col-md-3 col-sm-6'>
            <h2 class='no-margin margin-bottom'>A empresa</h2>

            @foreach (Cache::get('footerBusinessPages') as $page)
                @php
                    $linkAnchor = App\Http\Controllers\Util\UrlController::friendlyUrl($page->title);
                @endphp
                    <a href='{{route('site.empresa')}}#{{$linkAnchor}}'>{{$page->title}}</a><br/>
            @endforeach

            <a href='{{route('site.empresa')}}#trabalhe'>Trabalhe Conosco</a>
        </div>

        <div class='col-md-3 col-sm-6'>
            {{--Telefones--}}
            <h2 class='no-margin margin-bottom'>Telefones</h2>

            <p>
                @php
                    $localBefore = '';
                    $localNow = '';
                @endphp

                @foreach (Cache::get('telephones') as $telephone)
                    @php
                        $localBefore = $localNow;
                        $localNow = $telephone->address_category_id;

                        $telCorrect = $telephone->telephone;
                        $telCorrect = str_replace('(', '', $telCorrect);
                        $telCorrect = str_replace(')', '', $telCorrect);
                        $telCorrect = str_replace('-', '', $telCorrect);
                        $telCorrect = str_replace(' ', '', $telCorrect);

                        if($localNow != $localBefore)
                            echo '</p><h3 class="no-margin">'.$telephone->category->name.'</h3><p>';

                        $telephoneUrl = 'tel:'.$telCorrect;
                    @endphp

                    @if(isset($telefone->description) && $telefone->description != '')
                        {{$telefone->description}} - 
                    @endif

                    <a href='{{$telephoneUrl}}' target='_blank'>
                        {{$telephone->telephone}}

                        @if($telephone->whatsapp == 1)
                            <i class="fa fa-whatsapp whatsappIcon" aria-hidden="true"></i>
                        @endif
                    </a><br/>
                @endforeach
            </p>

            {{--E-mails--}}
            <h2 class='margin-top-g'>E-mails</h2>

            <p>
                @foreach (Cache::get('emails') as $email)
                    <a href='mailto:{{$email}}' target='_blank'>
                        {{$email->email}}
                    </a><br/>
                @endforeach
            </p>
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