     <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-success elevation-2">
      <!-- Brand Logo -->
      <a href="{{ url('/') }}" class="brand-link bg-success">
          {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> --}}
          <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('cp/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-compact" data-widget="treeview"
                  role="menu" data-accordion="true">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                  <!-- Dashboard -->
                  <li class="nav-item has-treeview {{ session('lsbm') == 'newsfeed' ? ' menu-open ' : '' }}">
                      <a href="#" class="nav-link ">
                          <i class="nav-icon fas fa-newspaper"></i>
                          <p>
                              {{ __('Newsfeed') }}
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">

                          <li class="nav-item ">
                              <a href="{{route('welcome.newsfeed')}}"
                                  class="nav-link {{ session('lsbsm') == 'newsfeed' ? ' active ' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('All Newsfeed') }}</p>
                              </a>
                          </li>

         

                      </ul>
                  </li>
                  {{-- ./Dashboard --}}

                  @foreach ($workstations as $ws)

                  <li class="nav-item has-treeview {{ session('lsbm') == "ws{$ws->id}" ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon far fa-circle nav-icon"></i>
                        <p>
                            {{ __($ws->title) }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item ">
                        <a href="{{route('welcome.allnews',['workstation' => $ws])}}" 
                            class="nav-link {{ session('lsbsm') == 'allnews' ? ' active ' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All {{ ucfirst($ws->title) }}</p>
                        </a>
                      </li>
                      @if ($ws->categories()->count() > 0)
                          @foreach ($ws->categories as $wscat)
                            <li class="nav-item ">
                              <a href="{{route('welcome.workstationCategoryNews',[ $ws, 'cat' => $wscat])}}" 
                                  class="nav-link {{ session('lsbsm') == "cat{$wscat->id}" ? ' active ' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ $wscat->name }}</p>
                              </a>
                            </li>
                          @endforeach
                      @endif

                        {{-- <li class="nav-item ">
                          <a href="{{route('admin.allMenus') }}"
                              class="nav-link {{ session('lsbsm') == 'allMenus' ? ' active ' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>{{ __('All Menus') }}</p>
                          </a>
                        </li> --}}
                         
                      
                    </ul>
                  </li>

                  @endforeach
                  
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
