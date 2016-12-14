@extends('_layouts.app')

@section('title')
    Posts - Plus Two Notes
@stop

@section('content')
    <h3 class="text--light reveal-top">Post List</h3>

    <div class="mdl-typography--text-center">
        <a href="{{ route('user.posts') }}" class="text--decoration-none">
            All ({{ \App\Models\Post::numPosts() }})
        </a> |
        <a href="{{ route('user.posts')."?by=".\Auth::user()->username }}" class="text--decoration-none">
            Mine ({{ \App\Models\Post::numPostsOfUser(\Auth::user()) }})
        </a> |
        <a href="{{ route('user.posts')."?status=".\App\Models\Post::STATUS_CONTENT_READY }}" class="text--decoration-none">
            Content Ready ({{ \App\Models\Post::numPosts(\App\Models\Post::STATUS_CONTENT_READY) }})
        </a> |
        <a href="{{ route('user.posts')."?status=".\App\Models\Post::STATUS_PUBLISHED }}" class="text--decoration-none">
            Published ({{ \App\Models\Post::numPosts(\App\Models\Post::STATUS_PUBLISHED) }})
        </a> |
        <a href="{{ route('user.posts')."?imp" }}" class="text--decoration-none">
            Important ({{ \App\Models\Post::numImpPosts() }})
        </a> |
        <a href="{{ route('user.posts')."?featured" }}" class="text--decoration-none">
            Featured ({{ \App\Models\Post::numFeaturedPosts() }})
        </a>
        @include('_partials.posts.admin.search')
    </div>

    @if(count($posts) > 0)
        @include('_partials.liststat',['list' => $posts,'entity' => 'posts'])

        <div class="mdl-typography__text-left">
            <table class="mdl-data-table mdl-js-data-table mdl-data-table--responsive mdl-shadow--2dp post-list">
                <thead class="reveal-top">
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Post Title</th>
                        <th class="mdl-data-table__cell--non-numeric">Category</th>
                        <th class="mdl-data-table__cell--non-numeric">Subject</th>
                        <th class="mdl-data-table__cell--non-numeric">Post Created At</th>
                        <th class="mdl-data-table__cell--non-numeric">Publish Date</th>
                        <th class="mdl-data-table__cell--non-numeric">Created By</th>
                        <th class="mdl-data-table__cell--non-numeric">Actions</th>
                        <th class="mdl-data-table__cell--non-numeric">Post Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr class="post-list-item reveal-bottom-staggered-250">
                            <td class="mdl-data-table__cell--non-numeric">
                                {{ $post->post_title_truncated }}
                                @if($post->imp)
                                    <span class="post__imp-tag">IMP</span>
                                @endif
                                @if($post->featured)
                                    <span class="post__featured-tag">Featured</span>
                                @endif
                            </td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $post->category->category_name }}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $post->grade_subject }}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $post->created_at->diffForHumans() }}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $post->published_at->diffForHumans() }}</td>
                            <td class="mdl-data-table__cell--non-numeric">
                                <a href="{{ route('users.show',['users' => $post->user->username]) }}" target="_blank">
                                    {{ $post->creator_name }}
                                </a>
                            </td>
                            <td class="mdl-data-table__cell--non-numeric">{!! $post->actions !!}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $post->status_text }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @include('_partials.pagination',['list' => $posts])
        </div>
    @else
        @include('_partials.empty')
    @endif
@stop