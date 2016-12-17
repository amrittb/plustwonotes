@extends ('_layouts.home')

@section('title')
    Plus Two Notes - not just another NEB (HSEB) Plus Two (+2) guide
@stop

@section('content')
    <div class="hero hero--home">
        <div class="hero__content-container">
                <h1 class="reveal reveal-top">Oh! Hi there.<br />In case you're wondering, We provide you with <span class="text--normal">NEB (HSEB) Plus Two</span> <span class="text--color-accent">Notes</span>, <span class="text--color-accent">News</span> &amp; <span class="text--color-accent">References</span>.</h1>
                <h2 class="reveal reveal-bottom-delay-250">Browse our rich and easy notes or go through syllabus to better manage your studying. Ready to dive in?</h2>
                <a href="{{ route('posts.index') }}" class="hero__btn mdl-button mdl-js-button mdl-button--raised mdl-button--primary mdl-js-ripple-effect reveal reveal-right-delay-500">Read what we got</a>
                <h6 class="text--light mdl-typography--text-center reveal reveal-top">
                    You said "Make it easier for me!"? We gottcha. <br>
                    <span class="text--normal">You are in...</span>
                </h6>
                @foreach($grades as $grade)
                    <a href="{{ route('posts.index.grade',['grades' => $grade->grade_name]) }}" class="hero__btn mdl-button mdl-js-button mdl-button--primary mdl-js-ripple-effect reveal reveal-bottom">Grade {{ $grade->grade_name }}</a>
                @endforeach

        </div>
        <div class="hero__img-container">
            <div class="hero__img reveal reveal-bottom-delay-1000">
                <img src="{{ asset('img/science_teacher.svg') }}" alt="Plus Two Notes, NEB (HSEB) Notes, NEB (HSEB) Books, Plus Two Books, Plus Two Practicals, NEB (HSEB) Practicals">
            </div>
        </div>
    </div>

    <section class="section section--intro mdl-grid">
        <div class="mdl-cell mdl-cell--12-col section--center mdl-typography--text-left">
            <h1 class="section__heading reveal reveal-left">
                Plus Two Notes
                <small> - not just another NEB (HSEB) guide, its the innovative way of learning.</small>
            </h1>

            <div class="section__body mdl-grid">
                <div class="mdl-cell mdl-cell--5-col">
                    <div class="section--intro__img reveal reveal-left-delay-500">
                        <img src="{{ asset('img/education_desk.svg') }}" alt="Plus Two Notes Education Desk, NEB (HSEB) Practicals, NEB (HSEB) Chemistry Practical, NEB (HSEB) Biology Practical, NEB (HSEB) Books">
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--7-col mdl-typography--text-justify">
                    <p class="reveal reveal-right-delay-250">
                        <b>Plus Two Notes</b> is an application created to help students get NEB (HSEB) notes and references easily.  We provide you with rich, easy and comprehensive notes based on NEB (HSEB) plus two Syllabus. Also we have other educational materials like NEB (HSEB) syllabus to help you to study in systematic order.
                    </p>
                    <p class="reveal reveal-bottom-delay-500">
                        We also post NEB (HSEB) related news on this site on blog section so that you can get updates about Exam routines and NEB (HSEB) Board exam results.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-category post-category">
        <div class="mdl-cell
                    mdl-cell--12-col
                    mdl-typography--text-center
        ">
            <div class="mdl-grid section__body">
                @foreach($postCategories as $category)
                   @include('_partials.categories.section',compact('category'))
                @endforeach
            </div>
            <a href="{{ route('posts.index') }}"
               target="_blank"
               class="
                    mdl-button
                    mdl-js-button
                    mdl-js-ripple-effect
                    text--color-primary
                    reveal reveal-right-delay-750
            ">
                Show All
            </a>
        </div>
    </section>

    <section class="section section--recommendations mdl-grid">
        <div class="mdl-cell mdl-cell--12-col section--center">
            <h2 class="section__heading mdl-typography--text-left reveal reveal-top">
                We recommend you to read...
            </h2>

            @if(count($recomendations) > 0)
                <div class="section__body mdl-grid mdl-typography--text-center">
                    @foreach($recomendations as $post)
                        @include('_partials.posts.card',['post' => $post])
                    @endforeach
                </div>
            @else
                @include('_partials.empty')
            @endif
        </div>
    </section>

    <section class="section section--future mdl-grid">
        <div class="mdl-cell mdl-cell--12-col section--center">
            <h2 class="section__heading mdl-typography--text-left reveal reveal-top">
                Whatcha Doin'?
            </h2>

            <div class="section__body">
                <p class="section--future__description text--light mdl-typography--text-justify reveal reveal-right">
                    So you wanna know what we are our goals for <b>2017</b> huh. We are planning to release <span class="text--color-primary text--light">Plus Two Notes Android app</span> in 2017's first 3 months. Also we have plans to use <span class="text--color-primary text--light">Augmented Reality \ Virtual Reality</span> technology to innovate traditional learning methodologies. We will be the <b>first in Nepal</b> to actually use <b>AR \ VR technology</b> in education field. We will be launching an app called <span class="text--color-primary text--light">Plus Two AR Labs</span> and <span class="text--color-primary text--light">Homo Sapiens VR</span> in 2017, which is currently under development as of December 2016.
                </p>

                <div class="mdl-typography--text-center">
                    <img src="{{ asset('img/browser_mockup.png') }}"
                         class="section--future__browser-mockup reveal reveal-bottom-delay-250"
                         alt="Plus Two Notes, NEB (HSEB) Notes"
                    >
                </div>
            </div>
        </div>
    </section>

    <section class="section section--footnote mdl-grid">
        <div class="mdl-cell mdl-cell--12-col section--center">
            <h2 class="section__heading mdl-typography--text-left reveal reveal-top">
                What about 'disbanding <b>NEB (HSEB)</b>'?
            </h2>

            <div class="section__body">
                <p class=" section--footnote__description reveal reveal-bottom">
                    After <a href="http://neb.gov.np" class="text--color-primary text--decoration-none" target="_blank">National Education Board</a>, has officially released all syllabus and plans for Secondary Level (From Grade IX to XII) of Nepalese Education System we will correspondingly update our site to fit changing needs.
                </p>
            </div>
        </div>
    </section>
@stop