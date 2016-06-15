@if( ! count($posts))
    @include('_partials.empty')
@else
    @include('_partials.posts.breadcrumb')

    @include('_partials.liststat',['list' => $posts,'entity' => 'posts'])

    <div class="post-preview-container mdl-grid">
        @foreach($posts as $post)
            @include('_partials.posts.card')
        @endforeach
    </div>
    @include('_partials.pagination',['list' => $posts])
@endif