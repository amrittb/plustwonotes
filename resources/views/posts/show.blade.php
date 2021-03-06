@extends('_layouts.app')

@section('title')
    {{ $post->post_title }} - Plus Two Notes
@stop

@section('assets')
    <script type="text/javascript" async
            src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
    </script>
@stop

@section('content')
<div class="post">
    <span class="post__date">
        {{ $post->published_at->diffForHumans() }} | {{ $post->published_at->format('M dS, Y') }}
    </span>

    <h3 class="post__title text--light">{{ $post->post_title }}
        @if($post->imp)
            {!! '<span class="post__imp-tag">Imp</span>' !!}
        @endif
    </h3>

    <div class="post__detail">
        <span class="post__category">
            {{ $post->category->category_name }}
        </span>
        @if($post->category->has_subject)
            | <span class="post__grade-subject">
                {{ $post->grade_subject }}
            </span>
        @endif
    </div>

    <div class="post__breadcrumb">
        @include('_partials.posts.breadcrumb')
    </div>

    @if($post->featured_img != null)
       <featured-image thumbnail-src="{{ $post->featured_img_thumbnail_url }}"
                       src="{{ $post->featured_img_url }}"
                       alt="{{ $post->post_title }}">
       </featured-image>
    @endif

    <div class="post__body">
        {!! $post->post_body !!}
    </div>
</div>

@include('_partials.posts.recent-posts')

@stop
