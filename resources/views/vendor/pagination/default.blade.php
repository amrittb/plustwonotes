@if ($paginator->count() > 1)
    <ul class="pagination">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <li class="disabled" disabled><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination__link mdl-js-ripple-effect mdl-js-button mdl-button">&laquo;</a></li>
        @endif

        <!-- Pagination Elements -->
        @foreach ($elements as $element)
            <!-- "Three Dots" Separator -->
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            <!-- Array Of Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="pagination__link mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--accent"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}" class="pagination__link mdl-js-ripple-effect mdl-js-button mdl-button">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination__link mdl-js-ripple-effect mdl-js-button mdl-button">&raquo;</a></li>
        @else
            <li class="disabled" disabled><span>&raquo;</span></li>
        @endif
    </ul>
@endif
