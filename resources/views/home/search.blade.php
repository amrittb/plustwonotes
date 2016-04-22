@extends('_layouts.app')

@section('title')
    {{ $query }} - Search - Plus Two Notes
@stop

@section('content')
    <h3>Posts for: {{ $query }}</h3>

    @include('_partials.posts.postlist')
@stop