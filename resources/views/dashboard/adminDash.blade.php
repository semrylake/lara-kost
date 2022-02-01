<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cari Kost | {{ $title }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Custom CSS -->
    <link href="{!! asset('assets/bts4/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') !!} " rel="stylesheet">
    <link href="{!! asset('assets/bts4/dist/css/style.min.css') !!} " rel="stylesheet">
    <link href="{!! asset('assets/bts4/libs/magnific-popup/dist/magnific-popup.css') !!} " rel="stylesheet">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    @if ($title == "Detail Kost")
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    @endif

    @livewireStyles

</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper">

        @include('components.navbar.navbarDashAdmin')
        @include('components.sidebar.asideDashAdmin')

        <div class="page-wrapper bg-white">

            <div class="container-fluid">
                @yield('container')
            </div>
        </div>

    </div>

    @yield('plusJs')

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
    <script src="{{ asset('assets/') }}/bts4/extra-libs/DataTables/datatables.min.js"></script>
    <script src="{!! asset('assets/bootstrap/js/bootstrap.min.js') !!}"></script>

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
