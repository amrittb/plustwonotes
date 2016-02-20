@extends('_layouts.app')

@section('title')
    {{ $post->post_title }}
@stop

@section('content')
    <div class="post mdl-shadow--2dp">
        <span class="post__date">
            {{ $post->published_at->diffForHumans() }} | {{ $post->published_at->format('M dS, Y') }}
        </span>

        <h3 class="post__title">{{ $post->post_title }}</h3>

        <div class="post__detail">
            <span class="post__category">
                {{ $post->category->category_name }}
            </span>
            @if($post->isNotBlog())
                | <span class="post__grade-subject">
                    {{ $post->grade_subject }}
                </span>
            @endif
        </div>

        <div class="post__breadcrumb">
            @include('_partials.posts.breadcrumb')
        </div>

        <div class="post__body">
            {!! $post->post_body !!}
        </div>
    </div>
@stop