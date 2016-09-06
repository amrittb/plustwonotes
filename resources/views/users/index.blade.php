@extends('_layouts.app')

@section('title')
    Users - Plus Two Notes
@stop

@section('content')
    @include('_partials.users.role-editor')

    <h3>Users List</h3>

    @if(count($users) > 0)
        @include('_partials.liststat',['list' => $users,'entity' => 'users'])

        <div class="mdl-typography__text-left">
            <table class="mdl-data-table mdl-js-data-table mdl-data-table--responsive mdl-shadow--2dp post-list">
                <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Full Name</th>
                    <th class="mdl-data-table__cell--non-numeric">Email</th>
                    <th class="mdl-data-table__cell--non-numeric">User Created At</th>
                    <th class="mdl-data-table__cell--non-numeric">Actions</th>
                    <th class="mdl-data-table__cell--non-numeric">Roles</th>
                    <th class="mdl-data-table__cell--non-numeric">User Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="user-list-item">
                        <td class="mdl-data-table__cell--non-numeric">{{ $user->name }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $user->email }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $user->created_at->diffForHumans() }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{!! $user->actions !!}</td>
                        <td class="mdl-data-table__cell--non-numeric">
                            <user-roles username="{{ $user->username }}"
                                        :user-roles="[{{ implode(',',$user->roles->pluck('id')->all()) }}]"
                                        :is-editable="{{ Auth::user()->isAdministrator()?'true':'false' }}">
                            </user-roles>
                        </td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $user->status_text }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @include('_partials.pagination',['list' => $users])
        </div>
    @else
        @include('_partials.empty')
    @endif
@stop
