<a href="{{ route('posts.show',[str_slug($post->post_slug)]) }}"
   class="
        mdl-card
        mdl-cell
        mdl-cell--4-col
        mdl-shadow--4dp
        mdl-js-button
        mdl-js-ripple-effect
        post-card
        text--decoration-none
        reveal-bottom-staggered-250
">
    <div class="mdl-card__media post-card__media">
        <img src="{{ $post->featured_img_thumbnail_url }}" alt="{{ $post->post_title }}">
    </div>
    <div class="mdl-card__title mdl-card--border">
        <h4 class="mdl-card__title-text mdl-typography--text-center">{{ $post->post_title }}
            @if($post->imp)
                {!! '<span class="post__imp-tag">IMP</span>' !!}
            @endif
        </h4>
    </div>
    <div class="mdl-card__supporting-text post-card__post-detail">
        {{ $post->published_at->diffForHumans() }} | {{ $post->category->category_name }}
        @if($post->category->has_subject)
            | {{ $post->grade_subject }}
        @endif
    </div>
</a>
