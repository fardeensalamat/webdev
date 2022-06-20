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
        <a href="#" class="nav-link">Job Announce Dashboard</a>
      </li>
      <li class="nav-item">
        
        <a href="{{ route('user.userBalance') }}" class="nav-link">Soft Wallet {{ Auth::user()->totalBalance()}} SCB</a>
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
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     <li class="nav-item dropdown">
      @php 
      $jobannounce=\App\Models\JobAnnouncer::where('user_id',Auth::user()->id)->first();
     @endphp
      <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-user-circle"></i>  {{$jobannounce->user_name}}</a>
   

    </li>
   
       
    </ul>
  </nav>
  <!-- /.navbar -->