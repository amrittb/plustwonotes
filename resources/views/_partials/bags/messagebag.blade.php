@if(Session::has('message'))
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">
                Message...
            </h2>
        </div>
        <div class="mdl-card__supporting-text">
            {{ Session::get('message')  }}
        </div>
    </div>
@endif