<section class="section section-category post-category section-category--{{ strtolower($category->category_name) }}">
    <div class="mdl-cell mdl-cell--12-col section--center">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col">
                <div alt="{{ $category->category_name }}" class="post-category__logo img--circular post-category--{{ strtolower($category->category_name) }}"></div>
            </div>
            <div class="mdl-cell mdl-cell--8-col mdl-typography--text-center">
                <h2 class="post-category__title section__heading text--color-white">{{ $category->category_name }}</h2>
                <h5 class="text--thin text--color-white">
                    {{ $category->category_desc }}
                </h5>
                <a href="{{ route('posts.index.category',['category' => $category->category_slug]) }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">Read 'em</a>
            </div>
        </div>
    </div>
</section>