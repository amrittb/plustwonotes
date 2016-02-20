<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    @yield('prenav')

    <div class="app-layout mdl-layout mdl-js-layout mdl-layout--fixed-header">
        @include('_partials.navigation')

        @yield('postnav')

        <main class="mdl-layout__content">
            <div class="page-content section--center mdl-typography--text-left mdl-grid">
                <div class="mdl-cell mdl-cell--12-col">
                    @yield('content')
                </div>
            </div>

            @include('_partials.footer')
        </main>

    </div>

    <script type="text/javascript" src="{{ elixir('js/app.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("input[name='published_at']").pickadate();
        });
    </script>
</body>
</html>