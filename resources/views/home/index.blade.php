@extends ('_layouts.home')

@section('title')
    Plus Two Notes
@stop

@section('content')
    <div class="hero hero--home">
        <div class="hero__bg-container">
            <div class="hero__bg-container-overlay">
                <h1>Oh! Hi there.<br />In case you're wondering,<br />We provide you with HSEB Notes &amp; References</h1>
                <a href="{{ route('posts.index') }}" class="hero__btn mdl-button mdl-js-button mdl-button--raised mdl-button--primary mdl-js-ripple-effect">Read what we got</a>
            </div>
        </div>
    </div>

    <section class="section section--intro mdl-grid">
        <div class="mdl-cell mdl-cell--12-col section--center mdl-typography--text-left">
            <h2 class="text--thin">
                Introducing Plus Two Notes
                <small> - not just another HSEB guide</small>
            </h2>

            <p class="section__briefing">
                <p>
                    <b>Plus Two Notes</b> is an application created to help students get HSEB notes and references easily.  We provide you with rich, easy and comprehensive notes based on HSEB plus two Syllabus. Also we have other educational materials like HSEB syllabus to help you to study in systematic order.
                </p>

                <p>
                    We also post HSEB related news on this site on blog section so that you can get updates about Exam routines and HSEB Board exam results.
                </p>
            </p>
        </div>
    </section>

    @foreach($postCategories as $category)
       @include('_partials.categories.section',compact('category'))
    @endforeach

    <section class="section section--recommendations mdl-grid">
        <div class="mdl-cell mdl-cell--12-col section--center">
            <h2 class="section__heading mdl-typography--text-left text--color-white">
                We recommend you to read...
            </h2>

            @if(count($recomendations) > 0)
                <div class="mdl-grid mdl-typography--text-center">
                    @foreach($recomendations as $post)
                        @include('_partials.posts.card',['post' => $post])
                    @endforeach
                </div>
            @else
                @include('_partials.empty')
            @endif
        </div>
    </section>
@stop