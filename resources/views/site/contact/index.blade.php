@extends('site.layout.layout')

@section('css')
    {!! Html::style('/css/site/contact.min.css') !!}
@endsection

@section('content')
    <div class='container siteContainer padding-bottom-g'>
        <div class='col-md-12'>
            <h1>Contato</h1>
        </div>

        <div class='row'>
            <div class="col-md-6 contactInformation">
                {{--Telefones--}}
                <h2>Telefones</h2>

                <p>
                    @php
                        $localBefore = '';
                        $localNow = '';
                    @endphp

                    @foreach ($contactTelephones as $telephone)
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
                <h2>E-mails</h2>

                <p>
                    @foreach ($contactEmails as $email)
                        <a href='mailto:{{$email}}' target='_blank'>
                            {{$email->email}}
                        </a><br/>
                    @endforeach
                </p>



                {{--Endereços--}}
                <h2>Endereços</h2>

                <p>
                    @php
                        $localBefore = '';
                        $localNow = '';
                    @endphp

                    @foreach ($contactAddresses as $address)
                        @php
                            $localBefore = $localNow;
                            $localNow = $address->address_category_id;

                            if($localNow != $localBefore)
                                echo '</p><h3 class="no-margin">'.$address->category->name.'</h3><p>';

                            $addressUrl = App\Models\Address\GoogleMaps::convertAddress($address->toString())
                        @endphp

                        <a href='{{$addressUrl}}' target='_blank'>
                            {{$address->toString()}}
                        </a><br/>
                    @endforeach
                </p>
            </div>
            <div class="col-md-6">
                <script type="text/javascript" src="https://marketing.ultimatefarmcannabiscenter.com.br/form/generate.js?id=3"></script>
            </div>
        </div>
    </div>
@endsection