<a href="{{ route('posts.index.category',['category' => $category->category_slug]) }}"
   class="
        mdl-cell
        mdl-cell--4-col
        mdl-js-button
        mdl-js-ripple-effect
        reveal reveal-bottom-staggered-250
        mdl-typography--text-center
        post-category__item
        text--decoration-none"
    id="post-category--{{ strtolower($category->category_name) }}"
>
    <div data-alt="{{ $category->category_name }}"
     class="post-category__logo
            img--circular
            post-category--{{ strtolower($category->category_name) }}">
    </div>

    <h4 class="
            post-category__title
            text--light
            text--color-default"
    >
        {{ $category->category_name }} (<span class="text--color-accent">{{ $category->num_of_published_posts }}</span>)
    </h4>
</a>
<p class="
        mdl-tooltip
        mdl-tooltip--large
        mdl-tooltip--top"
   for="post-category--{{ strtolower($category->category_name) }}"
>
    {{ $category->category_desc }}
</p>
