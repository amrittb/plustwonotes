@extends('_layouts.app')

@section('title')
    {{ $query }} - Search - Plus Two Notes
@stop

@section('content')
    <h3>Posts for: {{ $query }}</h3>

    {!! Form::open(['route' => 'search','method' => 'GET','class' => 'mdl-typography--text-center']) !!}
        <!-- Search Input -->
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('q','What do you want to read about?',['class'=>'mdl-textfield__label']) !!}
            {!! Form::text('q',$query,['class' => 'mdl-textfield__input']) !!}
        </div>

            <input class="mdl-button mdl-js-button mdl-button--raised mdl-button--primary mdl-js-ripple-effect"
                   value="Search"
                   type="submit" />
    {!! Form::close() !!}

    @include('_partials.posts.postlist')
@stop