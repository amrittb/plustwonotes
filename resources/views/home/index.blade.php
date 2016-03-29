@extends ('_layouts.home')

@section('title')
    Plus Two Notes
@stop

@section('postnav')
    <div class="hero hero--home">
        <div class="hero__bg-container">
            <div class="hero__bg-container-overlay">
                <h1>Oh! Hi there.<br />In case you're wondering,<br />We provide you with HSEB Notes &amp; Refrences</h1>
                <a href="{{ route('posts.index') }}" class="hero__btn mdl-button mdl-js-button mdl-button--raised mdl-button--primary mdl-js-ripple-effect">Read what we got</a>
            </div>
        </div>
    </div>
@stop