@if(Session::has('message'))
    <div class="alert alert--success mdl-shadow--2dp">
        <div class="alert__title">
            <h3 class="mdl-typography--text-center text--thin">
                <i class="material-icons">info</i> Message.
            </h3>
        </div>
        <div class="alert__supporting-text">
            {{ Session::get('message')  }}
        </div>
    </div>
@endif