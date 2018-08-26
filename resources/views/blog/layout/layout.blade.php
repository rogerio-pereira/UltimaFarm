@extends('site.layout.layout')

@section('css')
    {!! Html::style('/css/blog/style.min.css') !!}
@endsection

@section('content')
    <div class='container blogContainer'>
        <div class='row'>
            <div class='col-md-9 blogContent'>
                @yield('blog-content')
            </div>

            <div class='col-md-3 sidebar hidden-sm hidden-xs text-left'>
                <div class='busca'>
                    <div>
                       <h1>Busca</h1>
                    </div>

                    <div class='row'>
                        {!! Form::open(['route' => 'blog.search',  'class' => 'form']) !!}
                            {{--Busca--}}
                            <div class='form-group'>
                                {!! Form::input('text', 'search', null, ['placeholder' => 'Busca', 'class' => 'form-control', 'required']) !!}
                            </div>

                            {{--Submit--}}
                            <div class='form-group text-center'>
                                {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class='arquivo'>
                    <div>
                       <h1>Categorias</h1>
                    </div>

                    <ul class='sidebarList'>
                        @foreach ($blogCategories as $category)
                            @php
                                $categoryLink = App\Http\Controllers\Util\UrlController::friendlyUrl($category->title);
                            @endphp
                            <li>
                                <a href='{{route('blog.category', ['category' => $categoryLink, 'id' => $category->id])}}'>
                                    {{$category->title}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class='arquivo'>
                    <div>
                       <h1>Arquivo</h1>
                    </div>

                    <ul class='sidebarList'>
                        @foreach ($blogArchives as $blogArchive) 
                            @php
                                $mes = App\Http\Controllers\Util\DateController::mesPorExtenso($blogArchive->month);
                            @endphp

                            <li>
                                <a href='{{route('blog.archive', ['year' => $blogArchive->year, 'month' => $blogArchive->month])}}'>
                                    {{$mes}} de {{$blogArchive->year}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection