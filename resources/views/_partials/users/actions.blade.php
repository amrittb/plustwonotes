<span class="user-list-item__actions">

    <!-- User View Action -->
    @if($user->isActive())
        <a href="{{ route('users.show',['users' => $user->username]) }}" target="_blank">
            <i class="material-icons">visibility</i>
        </a>
    @endif

    <!-- User Edit Action -->
    @if($user->isLoggedIn())
        <a href="{{ route('users.edit',['users' => $user->username]) }}" target="_blank">
            <i class="material-icons">edit</i>
        </a>
    @endif
</span>