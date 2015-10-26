@extends('_layouts.app')

@section('title')
    Create a new Post - Plus Two Notes
@stop

@section('content')
    <div class="mdl-cell mdl-cell--12-col">
        <h5>Create a new Post</h5>

        @include('_partials.bags.messagebag')

        @include('_partials.bags.errorbag')

        {!! Form::open(['route' => 'posts.store']) !!}
            @include('_partials.posts.save')
        {!! Form::close() !!}
    </div>
@stop