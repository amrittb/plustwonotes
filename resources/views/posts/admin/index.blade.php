@extends('_layouts.app')

@section('title')
    Posts - Plus Two Notes
@stop

@section('content')
    <h3>Post List</h3>

    @if(count($posts) > 0)
        @include('_partials.liststat',['list' => $posts,'entity' => 'posts'])

        <div class="mdl-typography__text-left">
            <table class="mdl-data-table mdl-js-data-table mdl-data-table--responsive mdl-shadow--2dp post-list">
                <thead>
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
                        <tr class="post-list-item">
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
        No Posts Found
    @endif
@stop