@extends('_layouts.app')

@section('title')
    Edit a post - Plus Two Notes
@stop

@section('content')
    <div class="mdl-cell mdl-cell--12-col">
        <h5>Edit a Post</h5>

        @include('_partials.bags.messagebag')

        @include('_partials.bags.errorbag')

        {!! Form::model($post,['url' => route('posts.update',['posts' => $post->id]),'method' => 'PUT']) !!}
            @include('_partials.posts.save')
        {!! Form::close() !!}
    </div>
@stop