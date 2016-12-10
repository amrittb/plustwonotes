@extends('_layouts.main')

@section('title')
    404 Error - Plus Two Notes
@stop

@section('pagecontent')
    <div class="section section--404">
        <div class="section--404__table">
            <div class="section--404__container">
                <div class="section--404__content">
                    <h1 class="text--thin text--color-white mdl-typography--text-center reveal-top">
                        404 Page Not Found
                        <br />
                        <small class="text--thin reveal-bottom-delay-250">
                            Don't Look at me. I didn't do it.
                        </small>
                    </h1>

                    <img src="{{ asset('img/404.png') }}" class="img--responsive reveal-bottom" alt="Plus Two Notes - 404">

                    <h4 class="text--thin text--color-white mdl-typography--text-center reveal-right-delay-500">You shouldn't wander in such dark places! May be go <a href="{{ route('home')  }}" class="text--color-accent">home</a> now?</h4>
                </div>
            </div>
        </div>
    </div>

@stop