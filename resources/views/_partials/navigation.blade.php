<header class="mdl-layout__header">
    <!-- Top row, always visible -->
    <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">
            <img src="{{ asset('img/header-logo-small.png') }}">
        </span>
        <div class="mdl-layout-spacer"></div>

        <div class=" mdl-layout--large-screen-only">
           @include('_partials.navlink')
        </div>
    </div>
</header>
<div class="mdl-layout__drawer mdl-layout--small-screen-only">
    <span class="mdl-layout-title">Plus Two Notes</span>
    @include('_partials.navlink')
</div>