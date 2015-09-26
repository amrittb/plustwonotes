@extends('_layouts.app')

@section('title')
    Plus Two Notes - Posts
@stop

@section('content')
    <h4>Post List</h4>

    <div class="mdl-typography__text-left">
        @foreach($posts as $post)
            <div>
                <h6>{{ $post->post_title }}</h6>
                <p>{{ $post->post_body }}</p>
            </div>
        @endforeach
    </div>
@stop