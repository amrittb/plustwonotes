@extends('_layouts.app')

@section('title')
    Plus Two Notes - {{ (isset($category)?$category->category_name:"Posts list") }}
@stop

@section('content')
    <h2 class="text--thin mdl-typography--text-center">{{ (isset($category)?$category->category_name:"Posts list") }}</h2>

    @include('_partials.posts.postlist')
@stop