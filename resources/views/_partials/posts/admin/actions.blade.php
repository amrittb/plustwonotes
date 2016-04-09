<span class="post-list-item__actions">

    <!-- Read Action -->
    @haspermission('post.read')
        @if($post->isReadable())
            <a href="{{ $post->read_url }}" target="_blank" class="post-list-item__action post-list-item-action__read">
                <i class="material-icons">visibility</i>
            </a>
        @endif
    @endhaspermission

    <!-- Edit Action -->
    @haspermission('post.update')
        @if($post->isEditableByUser(Auth::user()))
            <a href="{{ $post->edit_url }}" target="_blank" class="post-list-item__action">
                <i class="material-icons">edit</i>
            </a>
        @endif
    @endhaspermission

    <!-- Content Ready Action -->
    @haspermission('post.create')
        @if($post->isContentReadyableByUser(Auth::user()))
            <a href="#" class="post-list-item__action">
                <i class="material-icons">check_circle</i>
            </a>
        @endif
    @endhaspermission

    <!-- Draft Action -->
    @haspermission('post.create')
        @if($post->isDraftableByUser(Auth::user()))
            {!! Form::open(['url' => $post->draft_url,'method' => 'PATCH']) !!}
            <button type="submit" class="post-list-item__action">
                <i class="material-icons">drafts</i>
            </button>
            {!! Form::close() !!}
        @endif
    @endhaspermission

    <!-- Publish Action -->
    @haspermission('post.publish')
        @if($post->isPublishable())
            {!! Form::open(['url' => $post->publish_url,'method' => 'PATCH']) !!}
                <button type="submit" class="post-list-item__action">
                    <i class="material-icons">vertical_align_top</i>
                </button>
            {!! Form::close() !!}
        @endif
    @endhaspermission

    <!-- UnPublish Action -->
    @haspermission('post.publish')
        @if($post->isUnpublishable())
            {!! Form::open(['url' => $post->publish_url,'method' => 'PATCH']) !!}
            <button type="submit" class="post-list-item__action">
                <i class="material-icons">vertical_align_bottom</i>
            </button>
            {!! Form::close() !!}
        @endif
    @endhaspermission

    <!-- Delete Action -->
    @haspermission('post.destroy')
        @if($post->isDeletableByUser(Auth::user()))
            {!! Form::open(['url' => $post->delete_url,'method' => 'DELETE']) !!}
            <button type="submit" class="post-list-item__action">
                <i class="material-icons">delete</i>
            </button>
            {!! Form::close() !!}
        @endif
    @endhaspermission
</span>