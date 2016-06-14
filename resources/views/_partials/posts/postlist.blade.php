@if( ! count($posts))
    No Posts Found
@else
    @include('_partials.posts.breadcrumb')

    @include('_partials.liststat',['list' => $posts,'entity' => 'posts'])

    @if(count($posts) > 0)
        <div class="post-preview-container mdl-grid">
            @foreach($posts as $post)
                @include('_partials.posts.card')
            @endforeach
        </div>

        @include('_partials.pagination',['list' => $posts])

        {{--@else--}}
        @include('_partials.empty')
    @endif
@endif