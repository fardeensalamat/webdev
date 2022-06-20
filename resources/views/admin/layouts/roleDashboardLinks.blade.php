@auth

{{--<li class="nav-item dropdown">--}}


{{--    <a class="nav-link"   href="#">--}}

{{--        <i class="fas fa-user-circle"></i> {{Auth::user()->name}}--}}
{{--    </a>--}}



{{--    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
{{--        --}}{{-- <span class="dropdown-header">15 Notifications</span> --}}
{{--        --}}{{-- <div class="dropdown-divider"></div> --}}
{{--        @if(Auth::user()->isAdmin())--}}
{{--        <a href="{{ route('admin.dashboard') }}" class="dropdown-item">--}}
{{--            <i class="fas fa-th mr-2"></i> {{ __('Admin Dashboard') }}--}}


{{--        </a>--}}

{{--        @endif--}}

{{--        @if(Auth::user())--}}
{{--        <a class="dropdown-item" href="{{route('user.dashboard')}}">--}}
{{--            <i class="fas fa-user-tag mr-2"></i>--}}
{{--            Tenant Dashboard</a>--}}
{{--        @endif--}}
{{--        <h3>heeelo</h3>--}}


{{--        <!--<a class="dropdown-item" href="">-->--}}
{{--        <!--    <i class="fas fa-newspaper text-green mr-2"></i>-->--}}
{{--        <!--    Newsfeed</a>-->--}}






{{--        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();--}}
{{--        document.getElementById('logout-form').submit();">--}}
{{--            <i class="fas fa-sign-out-alt mr-2"></i>--}}
{{--            Logout</a>--}}
{{--            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                @csrf--}}
{{--            </form>--}}



{{--        <div class="dropdown-divider"></div>--}}

{{--        --}}{{-- <a href="{{ route('logout') }}" onclick="event.preventDefault();--}}
{{--                  document.getElementById('logout-form').submit();" class="dropdown-item">--}}
{{--            <i class="fas fa-sign-out-alt mr-2"></i> {{ __('logout') }}--}}

{{--        </a>--}}

{{--        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--            {{ csrf_field() }}--}}
{{--        </form> --}}

{{--</li>--}}



<div class="dropdown">
    <button onclick="myFunction()" class="dropbtn"> <i class="fas fa-user-circle"></i> {{Auth::user()->name}}</button>
    <div id="myDropdown" class="dropdown-content" style="margin-left: -79px; margin-top: 7px;">
        @if(Auth::user()->isAdmin())
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-th mr-2"></i> {{ __('Admin Dashboard') }}</a>
        @endif
            @if(Auth::user())
        <a href="{{route('user.dashboard')}}"> <i class="fas fa-user-tag mr-2"></i>
            Tenant Dashboard</a>
            @endif
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt mr-2"></i>
                Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
    </div>
</div>

<style>
    .dropbtn {
        background-color: transparent;
        color: white;
        padding: 5px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        outline: none !important;
        border:none !important;

    }

    .dropbtn:hover, .dropbtn:focus {
        background-color: transparent;
        border:none !important;

    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 200px;
        overflow: auto;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown a:hover {background-color: #ddd;}

    .show {display: block;}
</style>

<script>
    /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>



@else


{{-- <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('login') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('register') }}</a></li> --}}

@endauth
