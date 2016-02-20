@extends('_layouts.app')

@section('title')
    Plus Two Notes - Posts
@stop

@section('content')
    <h3>Posts</h3>

    @include('_partials.posts.breadcrumb')

    <div class="post-preview-container mdl-grid">
        @foreach($posts as $post)
            @include('_partials.posts.card')
        @endforeach
    </div>

    <div>
        {!! $posts->render() !!}
    </div>


@stop