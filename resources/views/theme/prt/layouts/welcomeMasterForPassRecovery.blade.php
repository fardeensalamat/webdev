<!DOCTYPE html>
<html class="sticky-header-reveal">
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

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
		
		 
		<title>
			Password Recovery | Softcode International
		</title>
	 
		

 


		<meta name="keywords" content="softcode" />
		<meta name="author" content="softcode">
		<meta name="description" content="{{ $websiteParameter->meta_description ?? 'softcode' }}">

		<meta name="keywords" content="{{ $websiteParameter->meta_keyword ?? 'softcode' }}">
		<meta name="csrf-token" content="{{ csrf_token() }}">


	
		@if (isset($websiteParameter->google_analytics_code))
		{!! $websiteParameter->google_analytics_code !!}
		@endif
	
		@if (isset($websiteParameter->facebook_pixel_code))
		{!! $websiteParameter->facebook_pixel_code !!}
		@endif


		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{asset('prt/vendor/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/fontawesome-free/css/all.min.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/animate/animate.min.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/simple-line-icons/css/simple-line-icons.min.css')}}">
        <link rel="stylesheet" href="{{asset('prt/vendor/owl.carousel/assets/owl.carousel.min.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/owl.carousel/assets/owl.theme.default.min.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/magnific-popup/magnific-popup.min.css')}}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{asset('prt/css/theme.css')}}">
		<link rel="stylesheet" href="{{asset('prt/css/theme-elements.css')}}">
		<link rel="stylesheet" href="{{asset('prt/css/theme-blog.css')}}">
		<link rel="stylesheet" href="{{asset('prt/css/theme-shop.css')}}">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="{{asset('prt/vendor/rs-plugin/css/settings.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/rs-plugin/css/layers.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/rs-plugin/css/navigation.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/circle-flip-slideshow/css/component.css')}}">
		<link rel="stylesheet" href="{{asset('prt/css/w3.css')}}">
		
		<!-- Demo CSS -->


		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{asset('prt/css/skins/default.css')}}"> 

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{asset('prt/css/custom.css')}}">

		<!-- Head Libs -->
        <script src="{{asset('prt/vendor/modernizr/modernizr.min.js')}}"></script>

        <style type="text/css">
        	a.no-decoration:hover{
    			text-decoration: none;
			}

			#header .header-btn-collapse-nav {
			    background: #6374a3;
			}
        </style>

		@if(!Auth::check())
		<link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>


		@endif
        @stack('css')



	</head>
	<body>

		<!-- Load Facebook SDK for JavaScript -->
		<div id="fb-root"></div>
		<script>
			window.fbAsyncInit = function() {
			FB.init({
				xfbml            : true,
				version          : 'v4.0'
			});
			};

			(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<!-- Your customer chat code -->
		<div class="fb-customerchat"
			attribution=install_email
			theme_color="#ff5722"
			page_id="107034141441611">
		</div>



		<div class="body">
			@include('theme.prt.layouts.header')
			
			{{-- @include('sweetalert::alert') --}}
			@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

			
			<script src="{{ asset('//cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>





			<div role="main" class="main">
				@yield('contents')
			</div>

			@include('theme.prt.layouts.footer')

			 
			
		</div>

		<!-- Vendor -->
		
		<script src="{{asset('prt/vendor/jquery/jquery.min.js')}}"></script>
		<script src="{{asset('prt/vendor/jquery.appear/jquery.appear.min.js')}}"></script>
		<script src="{{asset('prt/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
		<script src="{{asset('prt/vendor/jquery.cookie/jquery.cookie.min.js')}}"></script>
		<script src="{{asset('prt/vendor/popper/umd/popper.min.js')}}"></script>
		<script src="{{asset('prt/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('prt/vendor/common/common.min.js')}}"></script>
		<script src="{{asset('prt/vendor/jquery.validation/jquery.validate.min.js')}}"></script>
		<script src="{{asset('prt/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
		<script src="{{asset('prt/vendor/jquery.gmap/jquery.gmap.min.js')}}"></script>
		<script src="{{asset('prt/vendor/jquery.lazyload/jquery.lazyload.min.js')}}"></script>
		<script src="{{asset('prt/vendor/isotope/jquery.isotope.min.js')}}"></script>
		<script src="{{asset('prt/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
		<script src="{{asset('prt/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
		<script src="{{asset('prt/vendor/vide/jquery.vide.min.js')}}"></script>
		<script src="{{asset('prt/vendor/vivus/vivus.min.js')}}"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="{{asset('prt/js/theme.js')}}"></script>
		
		<!-- Current Page Vendor and Views -->
		<script src="{{asset('prt/vendor/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
		<script src="{{asset('prt/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
		<script src="{{asset('prt/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js')}}"></script>
		<script src="{{asset('prt/js/views/view.home.js')}}"></script>

		<!-- Theme Custom -->
		<script src="{{asset('prt/js/custom.js')}}"></script>
		
		<!-- Theme Initialization Files -->
		<script src="{{asset('prt/js/theme.init.js')}}"></script>

		

 
 
  {{-- firebase start --}}
 
 <!-- The core Firebase JS SDK is always required and must be listed first -->
 <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-app.js"></script>
 
 <!-- TODO: Add SDKs for Firebase products that you want to use
	  https://firebase.google.com/docs/web/setup#available-libraries -->
 {{-- <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-analytics.js"></script> --}}
 
 <!-- Add Firebase products that you want to use -->
   <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-auth.js"></script>
 
 <script>
   // Your web app's Firebase configuration
   // For Firebase JS SDK v7.20.0 and later, measurementId is optional
   var firebaseConfig = {
    apiKey: "AIzaSyBjcta7pe9lZJovkW-CK5mwm0RT-vNHKyA",
    authDomain: "sc-bd-457be.firebaseapp.com",
    projectId: "sc-bd-457be",
    storageBucket: "sc-bd-457be.appspot.com",
    messagingSenderId: "1019780234133",
    appId: "1:1019780234133:web:c31001ff6cefd4098b949c",
    measurementId: "G-8CX8X7GSKQ"
  };
   // Initialize Firebase
   firebase.initializeApp(firebaseConfig);
   // firebase.analytics();
 </script>
 
 {{-- firebase end --}}
		

         @stack('js')

	</body>
</html>