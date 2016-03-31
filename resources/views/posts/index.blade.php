@extends('_layouts.app')

@section('title')
    Plus Two Notes - Posts
@stop

@section('content')
    <h3>Posts</h3>

    @include('_partials.posts.breadcrumb')

    @include('_partials.liststat',['list' => $posts,'entity' => 'posts'])

    <div class="post-preview-container mdl-grid">
        @foreach($posts as $post)
            @include('_partials.posts.card')
        @endforeach
    </div>

    @include('_partials.pagination',['list' => $posts])

@stop