@extends('_layouts.app')

@section('title')
    Plus Two Notes - Posts
@stop

@section('content')
    <h3>Posts</h3>

    @include('_partials.posts.postlist')
@stop