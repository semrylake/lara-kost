<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>CariKost | {{ $judul }}</title> --}}
    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @if ($judul == "Detail Kost")
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- jsFiddle will insert css and js -->
    @endif

    <!-- Fonts -->
    {{--
    <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{!! asset('assets/bootstrap/css/bootstrap.min.css') !!} " rel="stylesheet">
    <link href="{!! asset('assets/fontawesome/css/all.min.css') !!} " rel="stylesheet">
    <link href="{!! asset('assets/bts4/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') !!} " rel="stylesheet">

</head>

<body>
    <div id="app" class="mb-5">
        @include('components.navbar.navbarIndex')

        <div class="container">
            <main class="py-1">
                @yield('content')
        </div>
        </main>
    </div>

    <script src="{!! asset('assets/jquery/jquery-3.6.0.min.js') !!}"></script>
    <script src="{!! asset('assets/bootstrap/js/bootstrap.min.js') !!}"></script>
    <script src="{{ asset('assets/') }}/bts4/extra-libs/DataTables/datatables.min.js"></script>

    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>

    <script>
        var mycarousel =  document.querySelector('#carouselExampleDark')
        var carousel =  new bootstrap.Carousel(mycarousel, {
            interval: 3000,
            wrap: false
        })
    </script>
</body>

</html>
