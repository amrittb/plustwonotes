@if(!$errors->isEmpty())
    <div class="alert alert--error mdl-shadow--2dp">
        <div class="alert__title">
            <h3 class="mdl-typography--text-center text--thin">
                <i class="material-icons">error</i> Error.
            </h3>
        </div>
        <div class="alert__supporting-text">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif