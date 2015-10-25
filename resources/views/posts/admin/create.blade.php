@extends('_layouts.app')

@section('title')
    Create a new Post - Plus Two Notes
@stop

@section('content')
    <div class="mdl-cell mdl-cell--12-col">
        <h5>Create a new Post</h5>

        @if(!$errors->isEmpty())
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">
                        Error!
                    </h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {!! Form::open(['route' => 'posts.store']) !!}
            @include('_partials.posts.save')
        {!! Form::close() !!}
    </div>
@stop