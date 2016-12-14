<div class="list-stat mdl-shadow--2dp reveal reveal-bottom-delay-250">
    <div class="list-stat__page">
        Page <span class="post-stat__numeric">{{ $list->currentPage() }}</span>
    </div>
    <span class="list-stat__numeric">
        {{ ($list->currentPage() - 1) * $list->perPage() + 1 }}
    </span> - <span class="list-stat__numeric">
        {{ (($list->currentPage() - 1) * $list->perPage()) + $list->count()  }}
    </span> out of <span class="list-stat__numeric">{{ $list->total() }}</span> {{ $entity }} showing
</div>