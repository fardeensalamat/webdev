<style>
    #header .header-top {
        min-height: 22px;
        /*background: #003366 !important;*/
        /* background: #000033 !important; */
        /* background: #04252b !important; */
        background: #ff0000 !important;


    }

    .header-middle-bg-custom {
        /*background: #001a33 !important;*/
        background: #000052 !important;
        /* background: #074351 !important; */

    }

    .btn-main-bg {
        /*background: #001a33 !important;*/
        background: #000052 !important;
        /* background: #074351 !important; */

        color: #fff !important;

    }

    .header-bottom-bg-custom {
        /*background: #003366 !important;*/
        /* background: #000033 !important; */
        /* background: #04252b !important; */
        background: #000000 !important;

    }

    #header .header-nav-top .nav>li>a,
    #header .header-nav-top .nav>li>span {
        padding: 2px 10px;
    }

    #header .header-logo {
        margin: 0 !important;
    }

</style>

{{-- Awsome Front 4 icon link --}}
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

{{-- End Awsome Front 4 --}}
<header class="py-0" id="header"
    data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 130, 'stickySetTop': '-130px', 'stickyChangeLogo': true}">
    <div class="header-body border-color-primary header-middle-bg-custom border-top-0 box-shadow-none py-0">


        <div class="header-top header-top-borders- p-0 w3-small" style="border-bottom: 1px solid #bdb4b4;">
            <div class="container h-100 p-0">
                <div class="header-row h-100 p-0 px-3">
                    @if (isset($websiteParameter->welcome_page_msg))
                        <marquee class="" width="100%" direction="left" height="50%"
                            style="color: #fff; font-size: 18px;">
                            {{ $websiteParameter->welcome_page_msg }}
                        </marquee>
                    @endif
                    {{-- <div class="header-column justify-content-start p-0 w3-small">
                                    <div class="header-row p-0 w3-small">
                                        <nav class="header-nav-top p-0 w3-small">
                                            <ul class="nav nav-pills p-0 w3-small">
                                                <li class="nav-item nav-item-borders  d-none d-sm-inline-flex p-0 w3-small">
                                                    <span class="pl-0 w3-text-light-gray"><i class="far fa-dot-circle text-4 text-color-primary- w3-text-light-gray" style="top: 1px;"></i> 1234 Street Name, City Name</span>
                                                </li>
                                                <li class="nav-item nav-item-borders  p-0 w3-small w3-text-light-gray">
                                                    <a href="tel:123-456-7890" class="w3-text-light-gray"><i class="fab fa-whatsapp text-4 text-color-primary- w3-text-light-gray" style="top: 0;"></i> 123-456-7890</a>
                                                </li>
                                                <li class="nav-item nav-item-borders  d-none d-md-inline-flex p-0 w3-small w3-text-light-gray">
                                                    <a class="w3-text-light-gray" href="mailto:mail@domain.com"><i class="far fa-envelope text-4 text-color-primary- w3-text-light-gray" style="top: 1px;"></i> mail@domain.com</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div> --}}
                    {{-- <div class="header-column justify-content-end p-0 w3-small">
                                    <div class="header-row p-0 w3-small">
                                        <nav class="header-nav-top p-0 w3-small">
                                            <ul class="nav nav-pills">
                                                
                                                <li class="nav-item nav-item-borders  pr-0 dropdown p-0 w3-small">
                                                    
                                                    
                                                    @auth

                                                    <a class="nav-link w3-text-light-gray" href="{{route('user.dashboard')}}">
                                                        <i class="fa fa-user"></i>
                                                        {{auth()->user()->email}}

                                                    </a>

                                                    @else 

                                                    <a class="nav-link w3-text-light-gray" href="{{route('login')}}" >
                                                        <i class="fa fa-user"></i>
                                                        Login
                                                        
                                                    </a>

                                                    @endauth
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div> --}}
                </div>
            </div>
        </div>

        {{-- <div class="header-container container z-index-2  py-0" > --}}
        <div class="header-container z-index-2 py-0" style="background-color: #fff;">

            <div class="container">
                <div class="header-row py-0">
                    <div class="header-column py-0">
                        <div class="header-row py-0">
                            <div class="header-logo header-logo-sticky-change py-0">
                                <a class="py-0" href="/">
                                    {{-- <img class="header-logo-sticky opacity-0" alt="{{env('APP_NAME_BIG')}}"   height="100" data-sticky-height="55" data-sticky-top="100" src="{{asset('img/rcs.png')}}"> --}}
                                    {{-- <img class="header-logo-non-sticky opacity-0 py-0" alt="Porto"   height="100" src="{{asset('img/rc.png')}}"> --}}

                                    @isset($websiteParameter->logo_alt)
                                        {{-- <img class="header-logo-sticky opacity-0" alt="{{env('APP_NAME_BIG')}}"   height="100" data-sticky-height="55" data-sticky-top="100" src="{{asset('img/logo1.jpg')}}"> --}}
                                        <img class="header-logo-sticky opacity-0" alt="{{ env('APP_NAME_BIG') }}"
                                            height="100" data-sticky-height="55" data-sticky-top="100"
                                            src="{{ asset('storage/logo/' . $websiteParameter->logo_alt) }}">
                                    @endisset

                                    @isset($websiteParameter->logo)
                                        <img class="header-logo-non-sticky opacity-0 py-0" alt="Porto" height="100"
                                            src="{{ asset('storage/logo/' . $websiteParameter->logo_alt) }}">

                                    @endisset

                                    @if (!isset($websiteParameter->logo_alt) && !isset($websiteParameter->logo))
                                        <b>{{ env('APP_NAME') }}</b>
                                    @endif


                                    {{-- ROYAL COLLAGE OF MEDICAL SCIENCE --}}


                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="d-none d-sm-block">
        <div class="w3-card rounded">
        
        <img class="rounded" width="200" src="{{asset('img/newteam.png')}}" alt="">
        </div>
        </div> --}}
        <div class="header-column py-0 pt-4 pl-1 text-center">
            <h3 style="font-weight: 700;font-size:35px; line-height: 2rem; font-size: 2rem;">Soft Commerce </h3>
       </div>
                    <div class="header-column justify-content-end">
                        <div class="header-row h-100">
                            <ul class="header-extra-info d-flex h-100 align-items-center">
                                <li
                                    class="align-items-center h-100 py-4- header-border-right pr-4 d-none d-md-inline-flex">
                                    <div class="header-extra-info-text h-100 py-2">
                                        <div class="feature-box feature-box-style-2 align-items-center pt-4">
                                            <div class="feature-box-icon">
                                                <i class="far fa-envelope text-7 p-relative w3-text-white"></i>
                                            </div>
                                            <div class="feature-box-info pl-1">
                                                <label class="w3-text-white" style="color: gray !important;">SEND US AN
                                                    EMAIL</label>
                                                <strong><a class="w3-text-white" style="color: gray !important;"
                                                        href="mailto:{{ $websiteParameter->contact_email }}">{{ $websiteParameter->contact_email }}</a></strong>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="align-items-center h-100 py-4-">
                                    <div class="header-extra-info-text h-100 py-2 d-none d-md-block d-lg-block">
                                        <div class="feature-box feature-box-style-2 align-items-center pt-4">
                                            <div class="feature-box-icon">
                                                <i class="fab fa-whatsapp text-7 p-relative w3-text-white"></i>
                                            </div>
                                            <div class="feature-box-info pl-1" style="color: gray !important;">
                                                <label class="w3-text-gray">CALL US NOW</label>
                                                <strong><a class="w3-text-gray"
                                                        href="tel:{{ $websiteParameter->contact_mobile }}">{{ $websiteParameter->contact_mobile }}</a></strong>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-nav-bar bg-primary- header-bottom-bg-custom "
            data-sticky-header-style="{'minResolution': 991}"
            data-sticky-header-style-active="{'background-color': 'transparent'}"
            data-sticky-header-style-deactive="{'background-color': '#0088cc'}" style="border-top: 1px solid #333;">
            <div class="container">
                <div class="header-row">
                    <div class="header-column">
                        <div class="header-row">
                            <div class="header-colum order-2 order-lg-1">
                                <div class="header-row">
                                    <div class="header-nav header-nav-stripe header-nav-divisor header-nav-force-light-text justify-content-start"
                                        data-sticky-header-style="{'minResolution': 991}"
                                        data-sticky-header-style-active="{'margin-left': '110px'}"
                                        data-sticky-header-style-deactive="{'margin-left': '0'}">
                                        <div
                                            class="header-nav-main header-nav-main-square header-nav-main-effect-1 header-nav-main-sub-effect-1">
                                            <nav class="collapse">
                                                <ul class="nav nav-pills" id="mainNav">
                                                    <li class="dropdown dropdown-full-color dropdown-light">
                                                        <a class="  dropdown-item dropdown-toggle " href="/">
                                                            Home
                                                        </a>

                                                    </li>
                                                    @foreach ($menupages as $menu)
                                                        <li class="dropdown dropdown-full-color dropdown-light">
                                                            <a class="  dropdown-item dropdown-toggle "
                                                                href="{{ route('welcome.welcomePage', $menu) }}">
                                                                {{ $menu->page_title }}
                                                            </a>

                                                        </li>
                                                    @endforeach
                                                    <li class="dropdown dropdown-full-color dropdown-light">
                                                        <a class="  dropdown-item dropdown-toggle "
                                                            href="#">
                                                          Activities
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item w3-hover-blue"
                                                                    href="{{ route('welcome.blog', ['type' => 'blog']) }}">
                                                                  Blog
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item w3-hover-blue"
                                                                    href="{{ route('welcome.blog', ['type' => 'news']) }}">
                                                                   News
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item w3-hover-blue"
                                                                    href="{{ route('welcome.blog', ['type' => 'event']) }}">
                                                                   Events
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item w3-hover-blue"
                                                                    href="{{ route('welcome.addNewBlog') }}">
                                                                   Post A Blog
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item w3-hover-blue"
                                                                    href="{{ route('welcome.postNeed') }}">
                                                                  Post A Need
                                                                </a>
                                                            </li>


                                                        </ul>


                                                    </li>
                                                    <?php 
                                                        $socialFbGroups = \App\Models\SocialGroup::where('active', true)
                                                        ->where('type', 'facebook')
                                                        ->latest()
                                                        ->get(); 
                                                         $socialYtGroups = \App\Models\SocialGroup::where('active', true)
                                                        ->where('type', 'youtube')
                                                        ->latest()
                                                        ->get(); 
                                                    ?>
                                                    <li class="dropdown dropdown-full-color dropdown-light">
                                                        <a class="  dropdown-item dropdown-toggle "
                                                            href="#">
                                                         Social Media
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            @if (!count($socialFbGroups) < 1)
                                                                @foreach ($socialFbGroups as $sfb)
                                                                    <li>
                                                                        <a class="dropdown-item w3-hover-blue"
                                                                            href="{{ $sfb->link }}">
                                                                            <i class='fa fa-facebook-square'></i> {{ $sfb->title }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                            @if (!count($socialYtGroups) < 1)
                                                                @foreach ($socialYtGroups as $syt)
                                                                    <li>
                                                                        <a class="dropdown-item w3-hover-blue"
                                                                            href="{{ $syt->link }}">
                                                                            <i class='fa fa-youtube-play'></i> {{ $syt->title }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                           

                                                        </ul>


                                                    </li>








                                                    @if (Auth::guest())

                                                        <li class="dropdown dropdown-full-color dropdown-light">
                                                            <a class="dropdown-item dropdown-toggle"
                                                                data-target="#modal_register" data-toggle="modal"
                                                                href="#">
                                                                Sign In/Up
                                                            </a>

                                                        </li>


                                                    @else



                                                        <li class="dropdown dropdown-full-color dropdown-light">
                                                            <a title="{{ Auth::user()->name }}"
                                                                class="dropdown-item dropdown-toggle  " href="#">
                                                                <i class="fas fa-user-circle mr-2"></i>
                                                                {{ Str::limit(Auth::user()->email, 10) }}
                                                            </a>

                                                            <ul class="dropdown-menu">

                                                                @if (Auth::user()->isAdmin())

                                                                    <li>
                                                                        <a class="dropdown-item w3-hover-blue"
                                                                            href="{{ route('admin.dashboard') }}">
                                                                            <i
                                                                                class="fas fa-th mr-2 w3-text-deep-orange"></i>
                                                                            Admin Dashboard
                                                                        </a>
                                                                    </li>
                                                                @endif

                                                                <li>
                                                                    <a class="dropdown-item w3-hover-blue"
                                                                        href="{{ route('user.dashboard') }}">
                                                                        <i
                                                                            class="fas fa-user-tag mr-2 w3-text-blue"></i>
                                                                        My Dashboard
                                                                    </a>
                                                                </li>

                                                                <!--<li>-->
                                                                <!--<a class="dropdown-item w3-hover-blue" href="">-->
                                                                <!--<i class="fas fa-newspaper mr-2 w3-text-green"></i> Newsfeed-->
                                                                <!--</a>-->
                                                                <!--</li>-->




                                                                <li>
                                                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form-header').submit();" class="dropdown-item w3-hover-blue">
                                                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                                                        {{ __('logout') }}
                                                                        {{-- <span class="float-right text-muted text-sm"></span> --}}
                                                                    </a>
                                                                </li>

                                                                <form id="logout-form-header"
                                                                    action="{{ route('logout') }}" method="POST"
                                                                    style="display: none;">
                                                                    {{ csrf_field() }}
                                                                </form>

                                                            </ul>
                                                        </li>


                                                    @endif
                                                    @isset($about)
                                                        <li class="dropdown dropdown-full-color dropdown-light">
                                                            <a title="#" class="dropdown-item dropdown-toggle" href="#">
                                                                {{ $about->menu_title }} <i
                                                                    class="fa fa-angle-down pl-1"></i>
                                                            </a>

                                                            <ul class="dropdown-menu">
                                                                @foreach ($about->pages as $page)
                                                                    <li class="">
                                                                        <a class="dropdown-item w3-hover-blue"
                                                                            href="{{ route('welcome.page', [$page->id, $page->route_name]) }}">
                                                                            {{ $page->page_title }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endisset

                                                </ul>
                                            </nav>
                                        </div>
                                        <button class="btn header-btn-collapse-nav" data-toggle="collapse"
                                            data-target=".header-nav-main nav">
                                            <i class="fas fa-bars"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="header-column order-1 order-lg-2">
                                <div class="header-row justify-content-end">
                                    {{-- <div class="header-nav-features header-nav-features-no-border w-75 w-auto-mobile d-none d-sm-flex">
<form role="search" class="d-flex w-100" action="" method="get">
<div class="simple-search input-group w-100">
<input class="form-control rounded-left border-0" id="headerSearch" name="q" type="search" value="" placeholder="Search...">
<span class="input-group-append rounded-right bg-light border-0">
<button class="btn" type="submit">
<i class="fa fa-search header-nav-top-icon"></i>
</button>
</span>
</div>
</form>
</div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
