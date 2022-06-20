<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />--}}


    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

    <!-- Web Fonts  -->
{{--    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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
    <script src="{{asset('prt/vendor/jquery/jquery.min.js')}}"></script>


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


    <script data-ad-client="ca-pub-3860633623050094" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>


    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '557197209041192');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=557197209041192&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Meta Pixel Code -->

</head>
<body>
    @yield('content')
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    <script src="{{ asset('//cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>

{{--    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>--}}
{{--    --}}


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
    <script src="{{asset('js/custom.js')}}"></script>

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
