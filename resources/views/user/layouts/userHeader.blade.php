<style>

  .notification {
    color: white;
    text-decoration: none;
    padding: 5px 10px;
    position: relative;
    display: inline-block;
  }
  .notification .badge {
    position: absolute;
    top: -5px;
    right: -5px;
    padding: 3px 6px;
    border-radius: 50%;
    background-color: red;
    color: white;
  }
  </style>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark border-bottom-0" >
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" ><p style="font-size: 12px;">Tenant Dashboard</p> </a>
      </li>
      <li class="nav-item">
        
        <a href="{{ route('user.userBalance') }}" class="nav-link"><p style="font-size: 12px;">SW {{ Auth::user()->totalBalance()}} SCB</p></a>
      </li>
      <li class="nav-item">
        <a href="{{route('user.notificationslist')}}" class="notification">
          <i class="fas fa-bell"></i>
          @php 
            $notification=\App\Models\OrderNotifications::where('user_id',Auth::user()->id)->where('status','1')->count();
          @endphp
          @if($notification!=0)
          <span class="badge">{{ $notification }}</span>
          @else
          
          @endif
        </a>
      </li>

    

      {{-- <li class="nav-item">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Config::get('languages')[App::getLocale()] }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        @foreach (Config::get('languages') as $lang => $language)
            @if ($lang != App::getLocale())
                    <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
            @endif
        @endforeach
        </div>
    </li> --}}

    </ul>
    {{-- <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
    
            {{ Config::get('languages')[App::getLocale()] }}
        </a>
        <div class="dropdown-menu dropdown-menu-left">
            @foreach (Config::get('languages') as $lang => $language)
              @if ($lang != App::getLocale())
                      <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
              @endif
            @endforeach
        </div>
      </li>
    </ul> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     @if (Cookie::get('adminCookie'))
     <li class="nav-item">
      <a href="{{ route('user.loginAsAdmin',['user'=>Cookie::get('adminCookie')]) }}" class="nav-link ">Login as Admin</a>
    </li>
     @endif
      @include('admin.layouts.roleDashboardLinks')
       
    </ul>
  </nav>
  <!-- /.navbar -->