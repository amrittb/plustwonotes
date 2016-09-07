<span class="user-list-item__actions">

    <!-- User View Action -->
    @can('view',$user->getObject())
        <a href="{{ route('users.show',['users' => $user->username]) }}" target="_blank">
            <i class="material-icons">visibility</i>
        </a>
    @endcan

    <!-- User Edit Action -->
    @can('update',$user->getObject())
        <a href="{{ route('users.edit',['users' => $user->username]) }}" target="_blank">
            <i class="material-icons">edit</i>
        </a>
    @endcan
</span>