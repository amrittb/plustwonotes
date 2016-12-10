<div class="recent-posts">
    <h4 class="recent-posts__title text--light">Recent Posts <span class="material-icons">fiber-new</span></h4>
    <div class="recent-posts__body">
        @if(count($recentPosts) > 0)
            <ul class="mdl-grid recent-posts__grid">
                @foreach($recentPosts as $post)
                    @include('_partials.posts.card',compact('post'))
                @endforeach
            </ul>
        @else
            @include('_partials.empty')
        @endif
    </div>
    <div class="mdl-typography--text-center">
        <a href="{{ route('posts.index') }}" class="mdl-button mdl-js-buttom mdl-js-ripple-effect mdl-button--colored">See More</a>
    </div>
</div>
