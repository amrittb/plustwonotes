<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    @yield('prenav')

    <div class="app-layout mdl-layout mdl-js-layout mdl-layout--fixed-header">
        @include('_partials.navigation')

        @yield('postnav')

        <main class="mdl-layout__content">
            @yield('pagecontent')

            @yield('footer')
        </main>
    </div>

    <script type="text/javascript" src="{{ elixir('js/app.js') }}"></script>
</body>
</html>