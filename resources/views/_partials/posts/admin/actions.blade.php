<span class="post-list-item__actions">

    <!-- Read Action -->
    @can('view',$post->getObject())
        <a href="{{ $post->read_url }}" target="_blank" class="post-list-item__action post-list-item-action__read">
            <i class="material-icons">visibility</i>
        </a>
    @endcan

    <!-- Edit Action -->
    @can('update',$post->getObject())
        <a href="{{ $post->edit_url }}" target="_blank" class="post-list-item__action">
            <i class="material-icons">edit</i>
        </a>
    @endcan

    <!-- Content Ready Action -->
    @can('contentready',$post->getObject())
        {!! Form::open(['url' => $post->content_ready_url,'method' => 'PATCH']) !!}
            <button type="submit" class="post-list-item__action">
                <i class="material-icons">check_circle</i>
            </button>
        {!! Form::close() !!}
    @endcan

    <!-- Draft Action -->
    @can('draft',$post->getObject())
        {!! Form::open(['url' => $post->draft_url,'method' => 'PATCH']) !!}
        <button type="submit" class="post-list-item__action">
            <i class="material-icons">drafts</i>
        </button>
        {!! Form::close() !!}
    @endcan

    <!-- Publish Action -->
    @can('publish',$post->getObject())
        {!! Form::open(['url' => $post->publish_url,'method' => 'PATCH']) !!}
            <button type="submit" class="post-list-item__action">
                <i class="material-icons">vertical_align_top</i>
            </button>
        {!! Form::close() !!}
    @endcan

    <!-- UnPublish Action -->
    @can('unpublish',$post->getObject())
        {!! Form::open(['url' => $post->unpublish_url,'method' => 'PATCH']) !!}
        <button type="submit" class="post-list-item__action">
            <i class="material-icons">vertical_align_bottom</i>
        </button>
        {!! Form::close() !!}
    @endcan

    <!-- Restore Action -->
    @can('restore',$post->getObject())
        {!! Form::open(['url' => $post->restore_url,'method' => 'PATCH']) !!}
        <button type="submit" class="post-list-item__action">
            <i class="material-icons">refresh</i>
        </button>
        {!! Form::close() !!}
    @endcan

    <!-- Delete Action -->
    @can('delete',$post->getObject())
        {!! Form::open(['url' => $post->delete_url,'method' => 'DELETE']) !!}
        <button type="submit" class="post-list-item__action">
            <i class="material-icons">delete</i>
        </button>
        {!! Form::close() !!}
    @endcan
</span>