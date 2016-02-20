<div class="post-stat mdl-shadow--2dp">
    <div class="post-stat__page">
        Page <span class="post-stat__numeric">{{ $posts->currentPage() }}</span>
    </div>
    <span class="post-stat__numeric">
        {{ ($posts->currentPage() - 1) * $posts->perPage() + 1 }}
    </span> - <span class="post-stat__numeric">
        {{ (($posts->currentPage() - 1) * $posts->perPage()) + $posts->count()  }}
    </span> out of <span class="post-stat__numeric">{{ $posts->total() }}</span> posts showing
</div>