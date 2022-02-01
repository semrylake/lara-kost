<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cari Kost | {{ $title }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Custom CSS -->
    <link href="{!! asset('assets/bts4/dist/css/style.min.css') !!} " rel="stylesheet">


</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper">

        @include('components.navbar.navbarDashOP')
        @include('components.sidebar.asideDashProfile')

        <div class="page-wrapper bg-white">

            <div class="container-fluid">
                @yield('container')
            </div>
        </div>

    </div>

    <script src="{!! asset('assets/bts4/libs/jquery/dist/jquery.min.js') !!}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{!! asset('assets/bts4/libs/popper.js/dist/umd/popper.min.js') !!}"></script>
    <script src="{!! asset('assets/bts4/libs/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('assets/bts4/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') !!}"></script>
    <script src="{!! asset('assets/bts4/extra-libs/sparkline/sparkline.js') !!}"></script>
    <!--Wave Effects -->
    <script src="{!! asset('assets/bts4/dist/js/waves.js') !!}"></script>
    <!--Menu sidebar -->
    <script src="{!! asset('assets/bts4/dist/js/sidebarmenu.js') !!}"></script>
    <!--Custom JavaScript -->
    <script src="{!! asset('assets/bts4/dist/js/custom.min.js') !!}"></script>

</body>

</html>
