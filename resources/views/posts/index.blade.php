@extends('_layouts.app')

@section('title')
    Plus Two Notes - Posts
@stop

@section('content')
    <h4>Post List</h4>

    <div class="mdl-typography__text-left">
        @foreach($posts as $post)
            <div>
                <h6>{{ $post->post_title }}</h6> <a class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect mdl-button--raised" href="{{ route('posts.show',[str_slug($post->post_slug)]) }}">Read More</a>
                <p>{{ $post->post_body }}</p>
            </div>
        @endforeach
    </div>

    <div>
        {!! $posts->render() !!}
    </div>
@stop