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

        <section class="section section--intro mdl-grid">
            <div class="mdl-cell mdl-cell--12-col section--center mdl-typography--text-left">
                <h2 class="section__heading">
                    Introducing Plus Two Notes
                </h2>

                <p class="section__briefing">
                    <p>
                    Plus Two Notes is a website created to help students get HSEB notes and references easily.  We provide you with rich, easy and comprehensive notes based on HSEB plus two Syllabus. Also we have other educational materials like HSEB syllabus to help you to study in systematic order.
                    </p>
                    <p>
                        We also provide you with a platform for discussing any questions that you have with fellow students.
                    </p>
                </p>
            </div>
        </section>

        <section class="section section--categories mdl-grid">
            <div class="mdl-cell mdl-cell--12-col section--center">
                <h2 class="section__heading mdl-typography--text-left">
                    We offer you to read...
                </h2>

                @if(count($postCategories))
                    <div class="mdl-grid post-category">
                        @foreach($postCategories as $category)
                            <div class="mdl-cell mdl-cell--4-col post-category"><div alt="{{ $category->category_name }}" class="post-category__logo img--circular post-category--{{ strtolower($category->category_name) }}"></div>
                                <h4 class="post-category__title section__heading">{{ $category->category_name }}</h4>
                                <a href="{{ route('posts.index.category',['category' => $category->category_slug]) }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">Read 'em</a>
                            </div>
                        @endforeach
                    </div>
                @else
                    @include('_partials.empty')
                @endif
            </div>
        </section>

        <section class="section mdl-grid">
            <div class="mdl-cell mdl-cell--12-col section--center">
                <h2 class="section__heading mdl-typography--text-left">
                    We recommend you to read...
                </h2>

                @if(count($recomendations) > 0)
                    <div class="mdl-grid">
                        @foreach($recomendations as $post)
                            @include('_partials.posts.card',['post' => $post])
                        @endforeach
                    </div>
                @else
                    @include('_partials.empty')
                @endif
            </div>
        </section>
    </div>
@stop