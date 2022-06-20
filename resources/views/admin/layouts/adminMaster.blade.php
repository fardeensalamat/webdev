<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  @if(isset($websiteParameter) and ($websiteParameter->favicon))

    <link rel="shortcut icon" href="{{asset('storage/favicon/'. $websiteParameter->favicon)}}" type="image/x-icon">
    <link rel="icon" href="{{asset('storage/favicon/'. $websiteParameter->favicon)}}" type="image/x-icon">

        <!-- Favicon -->
    <link rel="apple-touch-icon" href="{{asset('storage/favicon/'. $websiteParameter->favicon)}}">

    @else

    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{asset('img/favicon.ico')}}">

    @endif

  <title>{{ env('APP_NAME') }}</title>

  <link rel="stylesheet" href="{{asset('assets/sweetalert2/dist/sweetalert2.css')}}">

  <!-- SweetAlert2 -->
  {{-- <link rel="stylesheet" href="{{ asset('cp/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> --}}

  <script src="{{asset('assets/sweetalert2/dist/sweetalert2.min.js')}}"></script>
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('cp/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('cp/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('cp/dist/css/adminlte.min.css') }}">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('cp/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700') }}" rel="stylesheet">



  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <link rel="stylesheet" href="{{ asset('css/w3.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('cp/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('cp/plugins/daterangepicker/daterangepicker.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">

{{--   <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

   <!-- Scripts -->
   {{--  <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    --}}

  <style>
    .nav-legacy.nav-sidebar .nav-item>.nav-link {
      border-top: 1px solid #dfdfdf !important;
    }
  </style>
  @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm ">

<div class="wrapper">
  <!-- Admin Header section -->
  @include('admin.layouts.adminHeader')

  <!-- Admin Sidebar section -->
  @include('admin.layouts.adminLeftsidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- Admin footer section -->

  @include('admin.layouts.footer')

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

  <script src="{{ asset('js/custom.js') }}"></script>
  <script src="{{ asset('js/jquery.PrintArea.js') }}"></script>

  <!-- Bootstrap 4 -->
  <script src="{{ asset('cp/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- overlayScrollbars -->
  <script src="{{ asset('cp/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

  <!-- AdminLTE App -->
  <script src="{{ asset('cp/dist/js/adminlte.min.js') }}"></script>


  @stack('js')
  <script>



    $(function(){


        var delay = (function() {
            var timer = 0;
            return function(callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();


    //////////////////////
    $(document).on('keypress', '.ajax-data-search', function(e) {
        if(e.which == 13) {
            e.preventDefault();
        }
    });
//////////////////////
    $(document).on("keyup", ".ajax-data-search", function(e){
    e.preventDefault();
    var that = $( this );
    var q = e.target.value;
    console.log(q)
    var url = that.attr("data-url");
    var urls = url+'?q='+q;


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
$(document).on('click', '.ajax-pagination-area .pagination li a', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');

    $.ajax({
      url: url,
      type: 'GET',
      cache: false,
      dataType: 'json',
      success: function(response)
      {
        $(".ajax-data-container").empty().append(response.page);
      },
      error: function(){}
    });

        });

    });
  </script>


</body>
</html>
