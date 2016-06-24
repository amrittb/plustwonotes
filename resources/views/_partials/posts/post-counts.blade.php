<div class="right-section-card mdl-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Posts Stats</h2>
    </div>
    <div class="mdl-card__supporting-text">
            <ul class="mdl-list right-section-card__list">
                @foreach($postCategories as $category)
                    <li class="mdl-list__item right-section-list">
                        <span class="mdl-grid mdl-list__item-primary-content right-section-list__container">
                            <div class="mdl-cell
                                        mdl-cell--3-col
                                        right-section-list__thumbnail-container
                                        img--circular">
                                <img src="{{ asset('img/'.strtolower($category->category_name).'.png') }}"
                                     alt="{{ $category->category_name }}"
                                     class="right-section-list__thumbnail img--circular">
                            </div>
                            <div class="mdl-cell
                                        mdl-cell--9-col
                                        mdl-cell--3-col-phone
                                        mdl-cell--6-col-tablet
                                        right-section-list__info">
                                <h6 class="right-section-list__title">
                                    <a href="{{ route('posts.index.category',['category' => $category->category_slug]) }}"
                                       class="right-section-list__title-link">
                                        {{ $category->category_name }}
                                            <strong>
                                                ({{ $category->num_of_published_posts }})
                                            </strong>
                                    </a>
                                </h6>
                            </div>
                        </span>
                    </li>
                @endforeach
            </ul>
    </div>
</div>
