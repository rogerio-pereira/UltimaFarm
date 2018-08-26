@extends('blog.layout.layout')

@section('blog-content')
    <div class='text-center'>
        <h1>Blog</h1>
    </div>

    <div class='row'>
        @foreach ($posts as $post)
            @php
            $linkTitle = App\Http\Controllers\Util\UrlController::friendlyUrl($post->title);
            @endphp
        
            <div class='col-md-6 col-sm-6 blogItem text-center'>
                <a href='{{route('blog.show', ['title' => $post->title, 'id' => $post->id])}}' title='{{$post->title}}'>
                    <img src='{{$post->image}}' alt='{{$post->title}}' class='img-responsive'>
                    <h1>{{$post->title}}</h1>
                </a>
            </div>
        @endforeach
    </div>

    <div class='text-center'>
        {{$posts->render()}}
    </div>
@endsection