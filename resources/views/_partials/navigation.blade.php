<header class="mdl-layout__header">
    <!-- Top row, always visible -->
    <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">
            <img src="{{ asset('img/header-logo-small.png') }}">
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
                    <input class="mdl-textfield__input" type="text" name="sample"
                           id="fixed-header-drawer-exp" />
                </div>
            </div>

            <a href="#">
                <i class="material-icons">person</i>
            </a>
        </div>
    </div>
</header>
<div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Plus Two Notes</span>
    @include('_partials.navlink')
</div>