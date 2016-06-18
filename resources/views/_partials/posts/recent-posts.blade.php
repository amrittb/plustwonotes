<div class="recent-posts mdl-card mdl-shadow--4dp">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Recent Posts</h2>
    </div>
    <div class="mdl-card__supporting-text">
        @if(count($recentPosts) > 0)
            <ul class="mdl-list recent-posts__list">
                @foreach($recentPosts as $post)
                    <li class="recent-post mdl-list__item">
                        <span class="mdl-grid mdl-list__item-primary-content recent-post__container">
                            <div class="mdl-cell mdl-cell--3-col recent-post__thumbnail-container img--circular">
                                <img src="{{ asset('img/'.strtolower($post->category->category_name).'.png') }}"
                                     alt="{{ $post->post_title }}"
                                     class="recent-post__thumbnail img--circular">
                            </div>
                            <div class="mdl-cell mdl-cell--9-col mdl-cell--3-col-phone mdl-cell--6-col-tablet recent-post__info">
                                <h6 class="recent-post__title">
                                    <a href="{{ route('posts.show',['posts' => $post->post_slug]) }}"
                                       class="recent-post__title-link">
                                        {{ $post->post_title_truncated }}
                                    </a>
                                </h6>
                                <div class="recent-post__detail">
                                    {{ $post->published_at->diffForHumans() }} | {{ $post->category->category_name }}
                                    @if($post->isNotBlog())
                                        | {{ $post->grade_subject }}
                                    @endif
                                </div>
                            </div>
                        </span>
                    </li>
                @endforeach
            </ul>
        @else
            @include('_partials.empty')
        @endif
    </div>
    <div class="mdl-card__actions mdl-card--border">
        <a href="{{ route('posts.index') }}" class="mdl-button mdl-js-buttom mdl-js-ripple-effect mdl-button--colored">See More</a>
    </div>
</div>
