@extends('_layouts.app')

@section('title')
    {{ $post->post_title }}
@stop

@section('content')
    <h4>{{ $post->post_title }}</h4>

    <div>
        {{ $post->post_body }}
    </div>
@stop