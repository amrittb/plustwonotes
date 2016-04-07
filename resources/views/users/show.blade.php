@extends('_layouts.home')

@section('title')
    {{ $user->name }} - Plus Two Notes
@stop

@section('content')
    <div class="user-profile user-profile__bg-container">
        <div class="user-profile__bg-overlay">
            <div class="section--center">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="user-profile__avatar-container mdl-typography--text-center">
                            <img src="{{ $user->avatar_large }}" alt="{{ $user->name }}" class="user-profile__avatar-img img--circular" />
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--9-col">
                        <h3 class="user-profile__name text--thin">
                            {{ $user->name }}
                            <small>
                                {
                                <a href="{{ route('users.show',['users' => $user->username]) }}" class="text--color-white">
                                    {{ '@'.$user->username }}
                                </a>
                                }
                            </small>
                        </h3>
                        <div class="user-profile__details">
                            Member Type: <span class="user-profile__role">{{ implode(', ',$user->roles->lists('name')) }}</span><br />
                            Email: <span class="user-profile__email">{{ $user->email }}</span><br />
                            Joined: <span class="user-profile__created_at">{{ $user->created_at->diffForHumans() }}</span><br />
                            Status: <span class="user-profile__status">{{ $user->status_text }}</span><br /><br />
                            @if($user->isLoggedIn())
                                <a href="{{ route('users.edit',['users' => $user->username]) }}"
                                   class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">
                                    <i class="material-icons">edit</i> Edit Your Profile
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mdl-grid section--center">
        <div class="mdl-cell mdl-cell--12-col">
            <h3 class="text--thin">User Contributions</h3>
        </div>
    </div>
@stop