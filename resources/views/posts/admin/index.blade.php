@extends('_layouts.app')

@section('title')
    Posts - Plus Two Notes
@stop

@section('content')
    <h4>Post List</h4>

    @foreach($posts as $post)
        <div>
            Post Number
        </div>
    @endforeach
@stop