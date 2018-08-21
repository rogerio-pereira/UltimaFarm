@extends('site.layout.layout')

@section('css')
    {!! Html::style('/css/site/faq.min.css') !!}
@endsection

@section('content')
    <div class='container siteContainer padding-bottom-g'>
        <div class='col-md-12'>
            <h1>FAQ</h1>
        </div>

        <div class='row'>
            @foreach ($faqs as $faq)
                <div class='col-md-12 margin-top faqItem' data-id='{{$faq->id}}'>
                    <p>
                        <strong>{{$faq->question}}</strong><br/>
                        <div class='faqAnswer' id='faqAnswer_{{$faq->id}}'>
                            {!!$faq->answer!!}
                        </div>
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('/js/site/faq.min.js') !!}
@endsection
