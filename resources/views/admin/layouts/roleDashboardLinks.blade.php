@auth

<li class="nav-item dropdown">


    <a class="nav-link"   href="#">

        <i class="fas fa-user-circle"></i> {{Auth::user()->name}}
    </a>



    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        {{-- <span class="dropdown-header">15 Notifications</span> --}}
        {{-- <div class="dropdown-divider"></div> --}}
        @if(Auth::user()->isAdmin())
        <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
            <i class="fas fa-th mr-2"></i> {{ __('Admin Dashboard') }}


        </a>

        @endif

        @if(Auth::user())
        <a class="dropdown-item" href="{{route('user.dashboard')}}">
            <i class="fas fa-user-tag mr-2"></i>
            Tenant Dashboard</a>
        @endif
{{--        <h3>heeelo</h3>--}}


        <!--<a class="dropdown-item" href="">-->
        <!--    <i class="fas fa-newspaper text-green mr-2"></i>-->
        <!--    Newsfeed</a>-->






        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt mr-2"></i>
            Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>



        <div class="dropdown-divider"></div>

        {{-- <a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> {{ __('logout') }}

        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form> --}}

</li>

@else


{{-- <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('login') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('register') }}</a></li> --}}

@endauth
