<header class="mdl-layout__header">
    <!-- Top row, always visible -->
    <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">
            <h1 class="header-logo">Plus Two Notes</h1>
        </span>
        <div class="mdl-layout-spacer"></div>

        <div class="app-navigation">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                  mdl-textfield--floating-label mdl-textfield--align-right">
                <label class="mdl-button mdl-js-button mdl-button--icon"
                       for="fixed-header-drawer-exp">
                    <i class="material-icons">search</i>
                </label>
                <div class="mdl-textfield__expandable-holder">
                    {!! Form::open(['route' => 'search','method' => 'GET']) !!}
                        <input class="mdl-textfield__input" type="text" name="q"
                           id="fixed-header-drawer-exp" />
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="avatar__container">
                @if(Auth::check())
                    <button id="avatar-menu-button" class="avatar__menu-button mdl-button mdl-js-button mdl-button--icon">
                        <img src="{{ Auth::user()->getPresenter()->avatar_small }}" alt="{{ Auth::user()->name }}" class="avatar--img-tiny img--circular" />
                    </button>

                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect avatar-menu"
                        data-mdl-for="avatar-menu-button">
                            <li class="mdl-menu__item avatar-menu__item"><a href="{{ route('users.show',['users' => Auth::user()->username]) }}"><b>{{ Auth::user()->getPresenter()->name }}</b></a></li>
                            <li class="mdl-menu__item avatar-menu__item"><a href="{{ route('users.edit',['users' => Auth::user()->username]) }}">Edit your profile</a></li>
                            <li>
                                <form action="{{ url('/logout') }}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" style="width: 100%;" class="mdl-menu__item avatar-menu__item">
                                        Log Out
                                    </button>
                                </form>
                            </li>
                    </ul>
                @else
                    {{--<a href="{{ url('/auth/login') }}"--}}
                       {{--class="mdl-button mdl-js-button mdl-button--raised mdl-button--primary mdl-js-ripple-effect">--}}
                        {{--Login--}}
                    {{--</a>--}}
                @endif
            </div>
        </div>
    </div>
</header>

<div class="mdl-layout__drawer">
    <span class="mdl-layout-title text--thin">Plus Two Notes</span>
    @include('_partials.navlink')
</div>