<div class="mdl-card mdl-shadow--4dp post-card mdl-cell mdl-cell--4-col">
    <div class="mdl-card__media post-card__media post-category post-category--{{ strtolower($post->category->category_name) }}">
    </div>
    <div class="mdl-card__title mdl-card--border">
        <h4 class="mdl-card__title-text">{{ $post->post_title }}
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
    <a href="{{ route('posts.show',[str_slug($post->post_slug)]) }}" class="mdl-button mdl-shadow--4dp mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored post-card__action">
        <i class="material-icons">keyboard_arrow_right</i>
    </a>
</div>