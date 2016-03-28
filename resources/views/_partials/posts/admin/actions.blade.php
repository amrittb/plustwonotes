<span class="post-list-item__actions">
    @if($post->isReadable())
        <a href="{{ $post->read_url }}" target="_blank">
            <i class="material-icons">visibility</i>
        </a>
    @endif

    @if($post->isEditable())
        <a href="{{ $post->edit_url }}" target="_blank">
            <i class="material-icons">edit</i>
        </a>
    @endif

    @if($post->isSoftDeleteable() || $post->isHardDeleteable())
        {!! Form::open(['url' => $post->delete_url,'method' => 'DELETE']) !!}
            <button type="submit">
                <i class="material-icons">delete</i>
            </button>
        {!! Form::close() !!}
    @endif

    @if($post->isPublishable())
        {!! Form::open(['url' => $post->publish_url,'method' => 'PATCH']) !!}
            <button type="submit">
                <i class="material-icons">publish</i>
            </button>
        {!! Form::close() !!}
    @endif

    @if($post->isDraftable())
        {!! Form::open(['url' => $post->draft_url,'method' => 'PATCH']) !!}
            <button type="submit">
                <i class="material-icons">archive</i>
            </button>
        {!! Form::close() !!}
    @endif
</span>