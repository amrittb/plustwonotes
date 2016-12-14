<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#00796b">
    <title>@yield('title')</title>
    <link rel="shortcut icon" sizes="16x16 32x32" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="57x57" href="/img/favicons/favicon-57.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/img/favicons/favicon-57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/favicons/favicon-72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/favicons/favicon-114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/img/favicons/favicon-120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/favicons/favicon-144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/favicons/favicon-152.png">
    <meta name="application-name" content="Plus Two Notes">
    <meta name="msapplication-TileImage" content=/img/favicons/favicon-144.png">
    <meta name="msapplication-TileColor" content="#B0BEC5">
    <meta name="_token" content="{{ csrf_token() }}">
    @if(\Auth::user())
        <!-- Only showing JWT token when the user is logged in -->
        <meta name="_jwt_token" content="{{ \JWTAuth::fromUser(\Auth::user()) }}">
    @endif
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="{{ elixir("js/preload-app.js") }}"></script>
    <style>
        .scroll-reveal .reveal {
            visibility: hidden;
        }
    </style>

    @yield('assets')
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

    <mdl-snackbar></mdl-snackbar>

    <script type="text/javascript" src="{{ elixir('js/app.js') }}"></script>

    @yield('scripts')

    <script type="text/javascript">
        /**
         * Root Vue Instance.
         */
        window.app = new Vue({
            el : 'body',
            store: window.store,
        });
    </script>
</body>
</html>