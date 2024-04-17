<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>DSI Stage - @yield('title')</title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @yield('style')

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        <!-- Jquery JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>

    <body>
        @include('layouts.dashboard.navbar')
        @guest
            <div style="min-height: 82.9vh">
                @yield('content')
            </div>
        @endguest
        @auth
            <div class="container-fluid" style="min-height: 82.9vh">
                <div class="row">
                    <div class="col-md-2">
                        @if(Auth::user()->is_admin)
                            @include('layouts.dashboard.sidebar')
                        @endif
                    </div>
                    <div class="col-md-10">
                        <div class="d-flex flex-column justify-content-center align-items-around my-5">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        @endauth
        @include('layouts.footer')
        <script>
            $(document).ready(function() {
                //datatables
                $('.table').DataTable();

            });
        </script>

    </body>

</html>
