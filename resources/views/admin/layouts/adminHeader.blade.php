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
        <a href="#" class="nav-link"> Admin Dashboard</a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.adminnotificationslist')}}" class="notification">
          <i class="fas fa-bell"></i>
          @php 
            $notification=\App\Models\OrderNotifications::where('type','admin')->where('status','1')->count();
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
      
      @include('admin.layouts.roleDashboardLinks')
       
    </ul>
  </nav>
  <!-- /.navbar -->