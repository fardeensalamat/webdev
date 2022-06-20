  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-2">
      <!-- Brand Logo -->
      <a href="{{ url('/') }}" class="brand-link bg-primary">
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
              <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-compact" data-widget="treeview" role="menu"
                  data-accordion="true">
                  <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

                  <!-- Dashboard -->
                  <li class="nav-item has-treeview {{ session('lsbm') == 'dashboard' ? ' menu-open ' : '' }}">
                      <a href="#" class="nav-link ">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              {{ __('Employers Panel') }}
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a> 

                      <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="#"
                                class="nav-link {{ session('lsbsm') == '' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Search CV Bank') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('vacancyannounce.createvacancyannouncejobpost') }}"
                                class="nav-link {{ session('lsbsm') == '' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Post a New Job') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                          <a href=""
                              class="nav-link {{ session('lsbsm') == '' ? ' active ' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>{{ __('Posted Jobs') }}</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href=""
                              class="nav-link {{ session('lsbsm') == '' ? ' active ' : '' }}">
                              <i class="far fa-hourglass nav-icon"></i>
                              <p>{{ __('Draft Jobs') }}</p>
                          </a>
                      </li>
                      <li class="nav-item">
                        <a href=""
                            class="nav-link {{ session('lsbsm') == '' ? ' active ' : '' }}">
                            <i class="far fa-hourglass nav-icon"></i>
                            <p>{{ __('Archive Jobs') }}</p>
                        </a>
                    </li>
                    </ul>
                  </li>
                  {{-- ./Dashboard --}}

                
                  <li class="nav-item has-treeview {{ session('lsbm') == '' ? ' menu-open ' : '' }}">
                      <a href="#" class="nav-link ">
                          <i class="nav-icon fas fa-file"></i>
                          <p>
                              {{ __('CV Bank') }}
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                     
                  </li>
                  <li class="nav-item">
                      <a href=""
                          class="nav-link {{ session('lsbsm') == '' ? ' active ' : '' }}">
                          <i class="far fa-comments nav-icon"></i>
                          <p>{{ __('Candidate Communication') }}</p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href=""
                        class="nav-link {{ session('lsbsm') == '' ? ' active ' : '' }}">
                        <i class="fas fa-user-check nav-icon"></i>
                        <p>{{ __('Services For Employers') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=""
                        class="nav-link {{ session('lsbsm') == '' ? ' active ' : '' }}">
                        <i class="fas fa-sync-alt nav-icon"></i>
                        <p>{{ __('Analytics') }}</p>
                    </a>
                </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
