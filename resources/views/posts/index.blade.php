@extends('_layouts.app')

<?php
    $title = [];
    if(isset($grade)) {
        array_push($title,"Grade ".$grade->grade_name);
    }
    if(isset($subject)) {
        array_push($title,"Grade ".$subject->grade->grade_name." ".$subject->subject_name);
    }
    if(isset($category)) {
        array_push($title,$category->category_name);
    }
    array_push($title,"Post List");
    $title = join(" - ",$title);
?>

@section('title')
    {{ $title }} - Plus Two Notes
@stop

@section('content')
    <h2 class="text--light mdl-typography--text-center reveal reveal-top">{{ $title }}</h2>

    <br />

    <h5 class="text--light mdl-typography--text-center reveal reveal-bottom">Not finding what you are looking for?</h5>

    <div class="mdl-typography--text-center reveal reveal-bottom-delay-250">
        @include('_partials.posts.search',['searchId' => 'post-list-search'])
    </div>

    <br />

    @include('_partials.posts.postlist')
@stop