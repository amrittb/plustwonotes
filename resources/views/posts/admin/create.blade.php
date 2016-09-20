@extends('_layouts.app')

@section('title')
    Create a new Post - Plus Two Notes
@stop

@section('content')
    <h3 class="text--thin">Create a new Post</h3>

    @include('_partials.bags.messagebag')

    @include('_partials.bags.errorbag')

    {!! Form::open(['route' => 'posts.store']) !!}
        @include('_partials.posts.save')
    {!! Form::close() !!}
@stop