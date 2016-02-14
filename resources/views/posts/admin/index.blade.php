@extends('_layouts.app')

@section('title')
    Posts - Plus Two Notes
@stop

@section('content')
    <h4>Post List</h4>

    @if(count($posts) > 0)
        <div class="mdl-typography__text-left">
            <table class="mdl-data-table mdl-js-data-table mdl-data-table--responsive">
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
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">{!! link_to_route('posts.edit',$post->post_title_truncated,['posts' => $post->post_slug]) !!}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $post->category->category_name }}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $post->grade_and_subject }}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $post->created_at->diffForHumans() }}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $post->published_at->diffForHumans() }}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $post->user_id }}</td>
                            <td class="mdl-data-table__cell--non-numeric">Actions</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $post->status_text }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $posts->render() !!}

            <ul class="pagination">
                <li><a href="#!" class="pagination__link mdl-js-ripple-effect mdl-js-button mdl-button">&laquo;</a></li>
                <li><a href="#" class="pagination__link mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--accent">1</a></li>
                <li><a href="#" class="pagination__link mdl-button mdl-js-button mdl-js-ripple-effect">2</a></li>
                <li><a href="#" class="pagination__link mdl-button mdl-js-button mdl-js-ripple-effect">3</a></li>
                <li><a href="#!" class="pagination__link mdl-button mdl-js-button mdl-js-ripple-effect">&raquo;</a></li>
            </ul>
        </div>
    @else
        No Posts Found
    @endif
@stop