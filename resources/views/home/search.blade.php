@extends('_layouts.app')

@section('title')
    {{ (!is_null($query))?$query." - ":'' }} Search - Plus Two Notes
@stop

@section('content')
    <h3 class="text--thin mdl-typography--text-center">
        @if(is_null($query))
            Search for...
        @else
            Searched for: {{ $query }}
        @endif
    </h3>
    <br /><br />

    {!! Form::open(['route' => 'search','method' => 'GET','class' => 'mdl-typography--text-center']) !!}
        <!-- Search Input -->
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('q','What do you want to read about?',['class'=>'mdl-textfield__label']) !!}
            {!! Form::text('q',$query,['class' => 'mdl-textfield__input']) !!}
        </div>

        <input class="mdl-button mdl-js-button mdl-button--raised mdl-button--primary mdl-js-ripple-effect"
               value="Find me that!"
               type="submit" />
    {!! Form::close() !!}

    <br /><br />

    @if(!is_null($query))
        @include('_partials.posts.postlist')
    @endif

    <br /><br />
@stop