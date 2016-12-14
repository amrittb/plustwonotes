@extends('_layouts.app')

@section('title')
    {{ (!is_null($query))?$query." - ":'' }} Search - Plus Two Notes
@stop

@section('content')
    <h3 class="text--thin mdl-typography--text-center reveal reveal-top">
        @if(is_null($query))
            Search for...
        @else
            Searched for: {{ $query }}
        @endif
    </h3>
    <br /><br />

    @include('_partials.posts.search')

    <br /><br />

    @if(!is_null($query))
        @include('_partials.posts.postlist')
    @endif

    <br /><br />
@stop