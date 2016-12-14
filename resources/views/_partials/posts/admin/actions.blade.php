<span class="post-list-item__actions">

    <!-- Read Action -->
    @can('view',$post->getObject())
        <a href="{{ $post->read_url }}" target="_blank" class="post-list-item__action post-list-item-action__read" id="post-view-{{ $post->id }}">
            <i class="material-icons">visibility</i>
        </a>
        <p class="
                mdl-tooltip
                mdl-tooltip--large
                mdl-tooltip--top"
           for="post-view-{{ $post->id }}"
        >
            View Post#{{ $post->id }}
        </p>
    @endcan

    <!-- Edit Action -->
    @can('update',$post->getObject())
        <a href="{{ $post->edit_url }}" target="_blank" class="post-list-item__action"  id="post-edit-{{ $post->id }}">
            <i class="material-icons">edit</i>
        </a>
        <p class="
                mdl-tooltip
                mdl-tooltip--large
                mdl-tooltip--top"
           for="post-edit-{{ $post->id }}"
        >
            Edit Post#{{ $post->id }}
        </p>
    @endcan

    <!-- Content Ready Action -->
    @can('contentready',$post->getObject())
        {!! Form::open(['url' => $post->content_ready_url,'method' => 'PATCH']) !!}
            <button type="submit" class="post-list-item__action" id="post-contentready-{{ $post->id }}">
                <i class="material-icons">check_circle</i>
            </button>
        {!! Form::close() !!}
        <p class="
                mdl-tooltip
                mdl-tooltip--large
                mdl-tooltip--top"
           for="post-contentready-{{ $post->id }}"
        >
            Send for publishing Post#{{ $post->id }}
        </p>
    @endcan

    <!-- Draft Action -->
    @can('draft',$post->getObject())
        {!! Form::open(['url' => $post->draft_url,'method' => 'PATCH']) !!}
        <button type="submit" class="post-list-item__action" id="post-draft-{{ $post->id }}">
            <i class="material-icons">drafts</i>
        </button>
        {!! Form::close() !!}
        <p class="
                mdl-tooltip
                mdl-tooltip--large
                mdl-tooltip--top"
           for="post-draft-{{ $post->id }}"
        >
            Draft Post#{{ $post->id }}
        </p>
    @endcan

    <!-- Publish Action -->
    @can('publish',$post->getObject())
        {!! Form::open(['url' => $post->publish_url,'method' => 'PATCH']) !!}
            <button type="submit" class="post-list-item__action" id="post-publish-{{ $post->id }}">
                <i class="material-icons">vertical_align_top</i>
            </button>
        {!! Form::close() !!}
        <p class="
                mdl-tooltip
                mdl-tooltip--large
                mdl-tooltip--top"
           for="post-publish-{{ $post->id }}"
        >
        Publish Post#{{ $post->id }}
        </p>
    @endcan

    <!-- UnPublish Action -->
    @can('unpublish',$post->getObject())
        {!! Form::open(['url' => $post->unpublish_url,'method' => 'PATCH']) !!}
        <button type="submit" class="post-list-item__action" id="post-unpublish-{{ $post->id }}">
            <i class="material-icons">vertical_align_bottom</i>
        </button>
        {!! Form::close() !!}
        <p class="
                mdl-tooltip
                mdl-tooltip--large
                mdl-tooltip--top"
           for="post-unpublish-{{ $post->id }}"
        >
            Take down Post#{{ $post->id }}
        </p>
    @endcan

    <!-- Restore Action -->
    @can('restore',$post->getObject())
        {!! Form::open(['url' => $post->restore_url,'method' => 'PATCH']) !!}
        <button type="submit" class="post-list-item__action" id="post-restore-{{ $post->id }}">
            <i class="material-icons">refresh</i>
        </button>
        {!! Form::close() !!}
        <p class="
                mdl-tooltip
                mdl-tooltip--large
                mdl-tooltip--top"
           for="post-restore-{{ $post->id }}"
        >
            Restore Deleted Post#{{ $post->id }}
        </p>
    @endcan

    <!-- Delete Action -->
    @can('destroy',$post->getObject())
        {!! Form::open(['url' => $post->delete_url,'method' => 'DELETE']) !!}
        <button type="submit" class="post-list-item__action" id="post-delete-{{ $post->id }}">
            <i class="material-icons">delete</i>
        </button>
        {!! Form::close() !!}
        <p class="
                mdl-tooltip
                mdl-tooltip--large
                mdl-tooltip--top"
           for="post-delete-{{ $post->id }}"
        >
        {{ (!$post->isDeleted()?"Move to Trash":"Permanently delete")." Post#".$post->id }}
        </p>
    @endcan
</span>