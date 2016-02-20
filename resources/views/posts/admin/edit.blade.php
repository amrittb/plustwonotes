@extends('_layouts.app')

@section('title')
    Edit a post - Plus Two Notes
@stop

@section('content')
    <h3>Edit a Post</h3>

    @include('_partials.bags.messagebag')

    @include('_partials.bags.errorbag')

    {!! Form::model($post,['url' => route('posts.update',['posts' => $post->id]),'method' => 'PUT']) !!}
        @include('_partials.posts.save')
    {!! Form::close() !!}
@stop