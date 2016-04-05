@extends('_layouts.home')

@section('title')
    Login - Plus Two Notes
@stop

@section('content')
    <div class="mdl-typography--text-center auth-form auth-form__bg-container">
        <div class="auth-form__bg-overlay">
            <h3 class="text--thin">Login</h3>

            <h4 class="text--thin">Get goodies by logging in to our website!</h4>

            @include('_partials.bags.errorbag')

            <div class="auth-form__container">
                {!! Form::open(['url' => '/auth/login','method' => 'POST']) !!}

                    <!-- Email Input -->
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        {!! Form::label('email','Email',['class'=>'label--inverse mdl-textfield__label']) !!}
                        {!! Form::text('email',null,['class' => 'textfield--inverse mdl-textfield__input']) !!}
                    </div>

                    <br />

                    <!-- Password Input -->
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        {!! Form::label('password','Password',['class'=>'label--inverse mdl-textfield__label']) !!}
                        {!! Form::password('password',['class' => 'textfield--inverse mdl-textfield__input']) !!}
                    </div>

                    <br />

                    <div class="checkbox-container">
                        <label class="checkbox--inverse mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="remember-me">
                            <input type="checkbox" id="remember-me" class="mdl-checkbox__input" name="remember">
                            <span class="mdl-checkbox__label">Remember me?</span>
                        </label>
                    </div>

                    <br /><br />

                    <input type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" value="Login" />

                {!! Form::close() !!}

                <br />

                Or,

                <br />

                @include('_partials.auth.social',['text' => 'Login'])

                <br /><br />

                <a href="#" class="text--color-white">Forgot password?</a>   <a href="{{ url('/auth/register') }}" class="text--color-white">Don't have an account?</a>
            </div>
        </div>
    </div>
@stop