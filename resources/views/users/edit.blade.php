@extends('_layouts.app')

@section('title')
    {{ $user->name }} - Edit Your Profile - Plus Two Notes
@stop

@section('content')
    <div class="mdl-typography--text-left">
        <h3 class="text--thin">Edit Your Profile</h3>

        @include('_partials.bags.errorbag')

        <div>
            {!! Form::model($user,['url' => route('users.update',['users' => $user->username]),'method' => 'PATCH']) !!}

            <!-- First Name Input -->
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('first_name','First Name',['class'=>'mdl-textfield__label']) !!}
                {!! Form::text('first_name',null,['class' => 'mdl-textfield__input']) !!}
            </div>

            <br />

            <!-- Middle Name Input -->
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('middle_name','Middle Name',['class'=>'mdl-textfield__label']) !!}
                {!! Form::text('middle_name',null,['class' => 'mdl-textfield__input']) !!}
            </div>

            <br />

            <!-- Last Name Input -->
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('last_name','Last Name',['class'=>'mdl-textfield__label']) !!}
                {!! Form::text('last_name',null,['class' => 'mdl-textfield__input']) !!}
            </div>

            <br /><br />

            <strong>Enter Nothing if you don't want to change the password!</strong>

            <br />

            <!-- Password Input -->
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('password','Password',['class'=>'mdl-textfield__label']) !!}
                {!! Form::password('password',['class' => 'mdl-textfield__input']) !!}
            </div>

            <br />

            <!-- Re-enter password Input -->
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('password_confirmation','Re-enter password',['class'=>'mdl-textfield__label']) !!}
                {!! Form::password('password_confirmation',['class' => 'mdl-textfield__input']) !!}
            </div>

            <br /><br />

            <input type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" value="Update Your Profile" />

            {!! Form::close() !!}
        </div>
    </div>
@stop