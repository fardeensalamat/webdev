<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

   @php
    $me = Auth::user();
  @endphp

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

  <title>Newsfeed | {{ env('APP_NAME') }}</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('cp/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="{{ asset('css/w3.css') }}">

  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('cp/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('cp/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('cp/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('cp/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('cp/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('cp/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('cp/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>    
    .nav-legacy.nav-sidebar .nav-item>.nav-link {
      border-top: 1px solid #efefef !important;
    }
  </style>

  @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm ">
<div class="wrapper">
  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
  <!-- Navbar -->
  @include('newsfeed.layouts.newsfeedNavbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    <!-- Main Sidebar Container -->
    @include('newsfeed.layouts.newsfeedLeftsidebar')
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper mt-4">
    @yield('content')
  </div>

    @auth
        @includeIf('welcome.includes.modals.myModal')
    @endauth

  <!-- /.content-wrapper -->
  @include('newsfeed.layouts.newsfeedFooter')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('cp/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('cp/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('cp/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
{{-- <script src="{{asset('cp/plugins/chart.js/Chart.min.js')}}"></script> --}}
<!-- Sparkline -->
{{-- <script src="cp/plugins/sparklines/sparkline.js"></script> --}}
<!-- JQVMap -->
{{-- <script src="{{asset('cp/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('cp/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script> --}}
<!-- jQuery Knob Chart -->
{{-- <script src="{{asset('cp/plugins/jquery-knob/jquery.knob.min.js')}}"></script> --}}
<!-- daterangepicker -->
{{-- <script src="{{asset('cp/plugins/moment/moment.min.js')}}"></script> --}}
{{-- <script src="{{asset('cp/plugins/daterangepicker/daterangepicker.js')}}"></script> --}}
<!-- Tempusdominus Bootstrap 4 -->
{{-- <script src="{{asset('cp/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script> --}}
<!-- Summernote -->
<script src="{{asset('cp/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('cp/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('cp/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{asset('cp/dist/js/pages/dashboard.js')}}"></script> --}}
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('cp/dist/js/demo.js')}}"></script> --}}

<script src="{{ asset('js/custom.js') }}"></script>
<script type="text/javascript">

  ////// for comment ////////////
  
  $(function(){

    $(document).on('keypress', '.comment_box', function(){
    $( this ).css("height", "")
    // $( this ).elastic();
    });

    ///////////////////////

    $(document).on('keypress','textarea.comment-box',function(e) {
      if(e.which == 13)
      {
        var that = $(this),
        box = that.closest(".card"),
        loading = box.find(".loadingNewComment"),
        form = that.closest("form"),
        url = form.attr('action'),
        type= form.attr('method'),
        alldata = form.serialize(),
        commentArea = box.find(".commentArea"),
        discusses = box.find(".discusses");
        $.ajax({
        url: url,
        type: type,
        cache: false,
        dataType: 'json',
        data: alldata,
        beforeSend: function()
        {
          loading.show();
          // $(".overlay").show();
          that.attr('readonly', 'on');
        },
        complete: function()
        {
          loading.hide();
          // $(".overlay").hide();
          // that.val('').css("height", '30px');
        },
      success: function(response)
      {
          that.removeAttr('readonly');
        that.val('').css("height","auto");
        // that.elastic();


        if(response.comments > 1)
        {
          discusses.empty().append( "<span class='text-muted discusses'> - "+response.comments +" Opinions </span></a>" );
          commentArea.find(".newComment").append(response.commentData);
        }
        else
        {
          discusses.empty().append( "<a href='#'><span class='text-muted discusses'> - "+response.comments +" Opinion </span></a>" );
          commentArea.append("<div class='card-footer box-comments'><span class='newComment'>"+ response.commentData +"</span></div>");
        }
      },
      error: function(){}
      });

      }
    });


    $(document).on('click', 'a.deleteComment', function(e){
      e.preventDefault();
      var that = $( this ),
      box = that.closest(".card"),
      boxcomment = that.closest(".card-comment"),
      url = that.attr('href'),
      commentArea = box.find(".commentArea"),
      discusses = box.find(".discusses");

      $.ajax({
        url: url,
        type: "Get",
        cache: false,
        dataType: 'json',
        beforeSend: function()
        {
          // $(".loadingNewComment").show();
          // $(".overlay").show();
        },
        complete: function()
        {
          // $(".loadingNewComment").hide();
          // $(".overlay").hide();
          // that.val('').css("height", '30px');
        },
      success: function(response)
      {
        // commentArea.empty().append(response.commentArea);
        if(response.comments > 1)
        {
          discusses.empty().append( "<span class='text-muted discusses'> - "+response.comments +" Comments </span></a>" );
          boxcomment.remove();
        }
        else if(response.comments == 1)
        {
          discusses.empty().append( "<a href='#'><span class='text-muted discusses'> - "+response.comments +" Comment </span></a>" );
          boxcomment.remove();
        }
        else
        {
          discusses.empty().append( "<a href='#'><span class='text-muted discusses'> - "+response.comments +" Comment </span></a>" );
          commentArea.empty();
        }

      },
      error: function(){}
      });
    });

  });


  //////////////////////////////

  $(function(){

    $(document).on('click','.likers-modal', function(e){

    e.preventDefault();
    var that =  $( this ),
        url = that.attr( "data-url" );
        
        $("#myModal").modal({backdrop: false});

    // alert(url);
  $.ajax({
    url: url,
    type: "Get",
    cache: false,
    dataType: 'json',
    beforeSend: function()
    {
        // $(".loadingModalData").show();
        $(".modal-feed").show();
    },
    complete: function()
    {
        // $(".loadingModalData").hide();
        $(".modal-feed").hide();
    },
  }).done(function(data){

    $('#modalFeed').empty().append(data);

  }).fail(function(){});
});

  });


  $(function(){
  $(".ntfy").on('click',function(){
     $(this).find(".badge").hide();
    $.ajax({
      url: $(this).attr('data-url'),
      type: 'POST',
      cache: 'false',
      dataType: 'json',
      success: function(response) {},
      error: function(){}
    });
  });
});

  ///////////////////////////
  
  $(function(){

    $(document).on('click','.likeCreate',function(e)
          {
            e.preventDefault();

            var that = $( this ),
            url = that.attr('data-url'),
            likeArea =that.closest(".likeArea");
            var likeicon = that.find(".like-icon");

            // var img = that.find('img');
            // var src = img.attr('src');
            var likeCounter = that.closest('.likeArea').find('.likeCounter');
            var counterValue = +(likeCounter.text());
            // var base_url = window.location.origin;


            // var tarr = src.split('/');      // ["blue.jpg"]
            // var filename = tarr[tarr.length-1]; // "blue.jpg"



            // console.log(filename);
            // 
            
            if(likeicon.hasClass('far'))
            {
              // alert(counterValue);
              // var srcc = src.replace(filename,"clicked.svg");
              // img.attr('src', srcc);
              likeicon.removeClass('far').addClass('fas');
              likeCounter.text(counterValue + 1);
            }
            else if(likeicon.hasClass('fas'))
            {
              // alert('heart');
              likeicon.removeClass('fas').addClass('far');
              likeCounter.text(counterValue - 1);
            }
            
          
            
            // if(filename == "impressed.svg")
            // {
            //   var srcc = src.replace(filename,"clicked.svg");
            //   img.attr('src', srcc);

            //   likeCounter.text(counterValue + 1);
              
            // }else
            // {
            //   var srcc = src.replace(filename,"impressed.svg");
            //   img.attr('src', srcc);

            //   likeCounter.text(counterValue - 1);
            // }

            $.get(url, function(response){
                likeArea.empty().append(response.likeArea);
              });
          });

       

  });
</script>
@stack('js')
</body>
</html>
