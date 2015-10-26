@if(!$errors->isEmpty())
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">
                Error!
            </h2>
        </div>
        <div class="mdl-card__supporting-text">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif