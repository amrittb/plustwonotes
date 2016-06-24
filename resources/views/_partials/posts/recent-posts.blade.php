<div class="right-section-card mdl-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Recent Posts</h2>
    </div>
    <div class="mdl-card__supporting-text">
        @if(count($recentPosts) > 0)
            <ul class="mdl-list right-section-card__list">
                @foreach($recentPosts as $post)
                    <li class="right-section-list mdl-list__item">
                        <span class="mdl-grid mdl-list__item-primary-content right-section-list__container">
                            <div class="mdl-cell mdl-cell--3-col right-section-list__thumbnail-container img--circular">
                                <img src="{{ asset('img/'.strtolower($post->category->category_name).'.png') }}"
                                     alt="{{ $post->post_title }}"
                                     class="right-section-list__thumbnail img--circular">
                            </div>
                            <div class="mdl-cell mdl-cell--9-col mdl-cell--3-col-phone mdl-cell--6-col-tablet right-section-list__info">
                                <h6 class="right-section-list__title">
                                    <a href="{{ route('posts.show',['posts' => $post->post_slug]) }}"
                                       class="right-section-list__title-link">
                                        {{ $post->post_title_truncated }}
                                    </a>
                                </h6>
                                <div class="right-section-list__detail">
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
    <div class="mdl-card__actions">
        <a href="{{ route('posts.index') }}" class="mdl-button mdl-js-buttom mdl-js-ripple-effect mdl-button--colored">See More</a>
    </div>
</div>
