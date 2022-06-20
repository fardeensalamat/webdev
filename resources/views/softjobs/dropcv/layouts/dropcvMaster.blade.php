<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    @php
        $me = Auth::user();
    @endphp
    @if (isset($websiteParameter) and $websiteParameter->favicon)

        <link rel="shortcut icon" href="{{ asset('storage/favicon/' . $websiteParameter->favicon) }}"
            type="image/x-icon">
        <link rel="icon" href="{{ asset('storage/favicon/' . $websiteParameter->favicon) }}" type="image/x-icon">

        <!-- Favicon -->
        <link rel="apple-touch-icon" href="{{ asset('storage/favicon/' . $websiteParameter->favicon) }}">

    @else

        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
        <link rel="apple-touch-icon" href="{{ asset('img/favicon.ico') }}">

    @endif


    <title>{{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/dist/sweetalert2.css') }}">

    <!-- SweetAlert2 -->
    {{-- <link rel="stylesheet" href="{{ asset('cp/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> --}}

    <script src="{{ asset('assets/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    {{-- search ajax --}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('cp/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('cp/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('cp/dist/css/adminlte.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('cp/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700') }}"
        rel="stylesheet">



    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/w3.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('cp/plugins/daterangepicker/daterangepicker.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    {{-- <script>
        window.Laravel = <?php echo json_encode([
    'csrfToken' => csrf_token(),
]); ?>
    </script> --}}

    <style>
        .nav-legacy.nav-sidebar .nav-item>.nav-link {
            border-top: 1px solid #dfdfdf !important;
        }

    </style>
    @stack('css')

    <script data-ad-client="ca-pub-3860633623050094" async
        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm ">

    @if (request()->route()->getName() == 'user.dashboard')
        <!-- Load Facebook SDK for JavaScript -->
        <div id="fb-root"></div>
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    xfbml: true,
                    version: 'v4.0'
                });
            };

            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <!-- Your customer chat code -->
        <div class="fb-customerchat" attribution=install_email theme_color="#ff5722" page_id="107034141441611">
        </div>

    @endif

    <div class="wrapper">
        <!-- Admin Header section -->
        @include('softjobs.dropcv.layouts.dropcvHeader')

        <!-- Admin Sidebar section -->
        @include('softjobs.dropcv.layouts.dropcvLeftSidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @yield('content')
            <form action="">
                <div class="user-location-set" data-url="{{ route('user.locationSet') }}"></div>
                <input type="hidden" id="lati" class="form-control" value="23.7614067">
                <input type="hidden" id="long" class="form-control" value="90.4195412">

                <input type="hidden" id="output_distance" class="form-control" value="0">
            </form>
        </div>
        <!-- Admin footer section -->

        @include('softjobs.dropcv.layouts.footer')

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('cp/plugins/jquery/jquery.min.js') }}"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('cp/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('cp/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- overlayScrollbars -->
    <script src="{{ asset('cp/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('cp/dist/js/adminlte.min.js') }}"></script>


    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/jquery.PrintArea.js') }}"></script>


    @stack('js')
    <script>
        //////////////////////
        $(document).on('keypress', '.ajax-data-search', function(e) {
            if (e.which == 13) {
                e.preventDefault();
            }
        });


        //////////////////////

        var delay = (function() {
            var timer = 0;
            return function(callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();

        //////////////////////
        $(document).on("keyup", ".ajax-data-search", function(e) {
            e.preventDefault();
            var that = $(this);
            var q = e.target.value;
            console.log(q)
            var url = that.attr("data-url");
            var urls = url + '?q=' + q;


      

            delay(function() {
                $.ajax({
                url: urls,
                type: 'GET',
                cache: false,
                dataType: 'json',
                success: function(response)
                {

                    $(".ajax-data-container").empty().append(response.page);
                },
                error: function(){}


                });
            }, 999);


        });
        //////////////////////admin search end //////////////////
    </script>
    <script type="text/javascript">
        window.onload = function() {
            getLocation()
        }

        var geo = navigator
        .geolocation; /*     Here we will check if the browser supports the Geolocation API; if exists, then we will display the location     */

        function getLocation() {
            if (geo) {
                geo.watchPosition(displayLocation);

            } else {

                // alert( "Oops, Geolocation API is not supported");        
            }
        }

        /*     This function displays the latitude and longitude when the browser has a location.     */

        function displayLocation(position) {
            document.getElementById('lati').value = position.coords.latitude;
            document.getElementById('long').value = position.coords.longitude;
        }
    </script>

    <script>
        $(document).ready(function() {
    //       $.ajaxSetup({
    //     headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    // });
            function loadajax() {

                var lat = $("#lati").val();
                var lng = $("#long").val();
                var dist = 0;
                var url = $(".user-location-set").attr('data-url');
                var urls = url + '?lat=' + lat + '&lng=' + lng + '&dist=' + dist;
                $.ajax({
                    url: urls,
                    type: "get",
                    success: function(response) {
                        if (response.success) {
                            $("#lati").val(response.lat);
                            $("#long").val(response.lng);
                        }

                    }
                });
            }


            setTimeout(loadajax, 10000);


        });
    </script>

</body>

</html>
