<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>DSI Stage - @yield('title')</title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        @yield('style')
    </head>

    <body>
        @include('layouts.navbar')
        <div style="min-height: 80.4vh">
            @yield('content')
        </div>
        @include('layouts.footer')
    </body>

</html>
