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
                            {{ __('adminsidebar.dashboard') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item ">
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link {{ session('lsbsm') == 'dashboard' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('adminsidebar.dashboard') }}</p>
                            </a>
                        </li>
                        @if (Auth::user()->hasPermission('webparameters'))

                            <li class="nav-item ">
                                <a href="{{ route('admin.websiteParameters') }}"
                                    class="nav-link {{ session('lsbsm') == 'webparameter' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('adminsidebar.web_parameters') }}</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                              <a href="{{ route('admin.listslider') }}"
                                  class="nav-link {{ session('lsbsm') == 'slider' ? ' active ' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('adminsidebar.slider') }}</p>
                              </a>
                          </li>
                        @endif
                    </ul>
                </li>


                {{-- ./news event --}}

                @if (Auth::user()->hasPermission('page'))
                    <li class="nav-item has-treeview {{ session('lsbm') == 'page' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-list-alt nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.menu_pages') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="{{ route('admin.newMenu') }}"
                                    class="nav-link {{ session('lsbsm') == 'newMenu' ? ' active ' : '' }}">
                                    <i class="far fa-file nav-icon"></i>
                                    <p>{{ __('adminsidebar.new_menu') }}</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('admin.allMenus') }}"
                                    class="nav-link {{ session('lsbsm') == 'allMenus' ? ' active ' : '' }}">
                                    <i class="far fa-file nav-icon"></i>
                                    <p>{{ __('adminsidebar.all_menu') }}</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('admin.pagesAll') }}"
                                    class="nav-link {{ session('lsbsm') == 'pagesAll' ? ' active ' : '' }}">
                                    <i class="far fa-file nav-icon"></i>
                                    <p>{{ __('adminsidebar.pages') }}</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- media --}}
                    <li class="nav-item has-treeview {{ session('lsbm') == 'media' ? ' menu-open ' : '' }}">
                        <a href="{{ route('admin.mediaAll') }}" class="nav-link ">
                            <i class="nav-icon fas fa-images nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.media') }}
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>
                    </li>

                    {{-- ./media --}}
                @endif

                {{-- ./pages --}}

                  <!-- ---------------------fardeen code-------------------- -->
             @if (Auth::user()->hasPermission('valuedcustomer'))
             <li class="nav-item has-treeview {{ session('lsbm') == 'valuedcustomer' ? ' menu-open ' : '' }}">
                 <a href="#" class="nav-link ">
                     <i class="nav-icon fas fa-user nav-icon"></i>
                     <p>
                         {{ __('adminsidebar.valued_customer') }}
                         <i class="right fas fa-angle-left"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item ">
                         <a href="{{ route('admin.addValuedCustomer') }}"
                             class="nav-link {{ session('lsbsm') == 'valuedcustomercreate' ? ' active ' : '' }}">
                             <i class="far fa-file nav-icon"></i>
                             <p>{{ __('adminsidebar.add_valued_customer') }}</p>
                         </a>
                     </li>
                     <li class="nav-item ">
                         <a href=" {{ route('admin.valuedCustomerList') }}"
                             class="nav-link {{ session('lsbsm') == 'valuedcustomerlist' ? ' active ' : '' }}">
                             <i class="far fa-file nav-icon"></i>
                             {{-- <p>{{ __('adminsidebar.valued_customer_list') }}</p> --}}
                             <p>Valued Customer List</p>
                         </a>
                     </li>
               

                 </ul>
             </li>
         @endif
         @if (Auth::user()->hasPermission('toppriority'))
           <!-- ---------------------top priority------------------- -->
             <li class="nav-item has-treeview {{ session('lsbm') == 'toppriority' ? ' menu-open ' : '' }}">
                 <a href="#" class="nav-link ">
                     <i class="nav-icon fas fa-arrow-circle-up  nav-icon"></i>
                     <p>
                         {{ __('adminsidebar.top_priority') }}
                         <i class="right fas fa-angle-left"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item ">
                         <a href="{{ route('admin.addTopPriority') }}"
                             class="nav-link {{ session('lsbsm') == 'topprioritycreate' ? ' active ' : '' }}">
                             <i class="far fa-file nav-icon"></i>
                             <p>{{ __('adminsidebar.add_top_priority') }}</p>
                         </a>
                     </li>
                     <li class="nav-item ">
                         <a href="{{ route('admin.topPriorityList') }}"
                             class="nav-link {{ session('lsbsm') == 'topprioritylist' ? ' active ' : '' }}">
                             <i class="far fa-file nav-icon"></i>
                             <p>{{ __('adminsidebar.top_priority_list') }}</p>
                         </a>
                     </li>
                     

                 </ul>
             </li>
        @endif
    

       <!-- ----------------------------------------- -->
         

         {{-- ./pages --}}








                {{-- subscribers --}}
                @if (Auth::user()->hasPermission('subscriber'))
                    <li class="nav-item has-treeview {{ session('lsbm') == 'subscribers' ? ' menu-open ' : '' }}">
                        <a href="{{ route('admin.subscribersList') }}" class="nav-link ">
                            <i class="nav-icon fas fa-rss nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.subscribers') }}

                            </p>
                        </a>

                    </li>
                @endif

                {{-- ./subscribers --}}

                {{-- orders --}}
                @if (Auth::user()->hasPermission('subscription'))

                    <li class="nav-item has-treeview {{ session('lsbm') == 'order' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">

                            <i class="nav-icon far fa-address-book"></i>
                            <p>
                                {{ __('adminsidebar.subscription_order') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">


                            <li class="nav-item ">
                                <a href="{{ route('admin.orders', ['type' => 'all']) }}"
                                    class="nav-link {{ session('lsbsm') == 'orderall' ? ' active ' : '' }}">
                                    <i class="nav-icon fas fa-address-book nav-icon"></i>
                                    <p>
                                        {{ __('adminsidebar.all_order') }}

                                    </p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('admin.orders', ['type' => 'pending']) }}"
                                    class="nav-link {{ session('lsbsm') == 'orderpending' ? ' active ' : '' }}">
                                    <i class="nav-icon fas fa-address-book nav-icon"></i>
                                    <p>
                                        {{ __('adminsidebar.all_pending_order') }}

                                    </p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('admin.orders', ['type' => 'paid']) }}"
                                    class="nav-link {{ session('lsbsm') == 'orderpaid' ? ' active ' : '' }}">
                                    <i class="nav-icon fas fa-address-book nav-icon"></i>
                                    <p>
                                        {{ __('adminsidebar.all_paid_order') }}

                                    </p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif
                {{-- ./orders --}}
                @if (Auth::user()->hasPermission('balance'))

                    <li class="nav-item has-treeview {{ session('lsbm') == 'balance' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">


                            <i class="fab fa-first-order nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.balance_order') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item ">
                                <a href="{{ route('admin.balanceOrdersAll') }}"
                                    class="nav-link {{ session('lsbsm') == 'pendingOrder' ? ' active ' : '' }}">
                                    <i class="nav-icon far fa-circle nav-icon"></i>
                                    <p>
                                        {{ __('adminsidebar.all_order') }}

                                    </p>
                                </a>
                            </li>
                        </ul>

                       
                    </li>

                @endif
               
                <li class="nav-item ">
                    <a href="{{route('admin.LogActivityList')}}" class="nav-link {{ session('lsbsm') == 'LogActivity' ? ' active ' : '' }}">
                        <i class="nav-icon fas fa-list nav-icon"></i>
                        <p>
                            Admin Activity Log
                            
                        </p>
                    </a>
                </li>
                @if (Auth::user()->hasPermission('withdraw'))
                    <li class="nav-item ">
                        <a href="{{ route('admin.withdrawListAll') }}"
                            class="nav-link {{ session('lsbsm') == 'withdrowList' ? ' active ' : '' }}">
                            <i class="nav-icon fas fa-share-square nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.withdraw_list') }}

                            </p>
                        </a>
                    </li>
                @endif
                {{-- work Station --}}
                @if (Auth::user()->hasPermission('workstation'))

                    <li class="nav-item has-treeview {{ session('lsbm') == 'workstation' ? ' menu-open ' : '' }}">
                        <a href="{{ route('admin.workStationList') }}" class="nav-link ">
                            <i class="nav-icon fas fa-tools nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.service_stations') }}

                            </p>
                        </a>

                    </li>
                @endif
                {{-- ./work station --}}

                {{-- All posted job --}}
                @if (Auth::user()->hasPermission('jobs_work'))

                    <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-briefcase nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.job_work') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->hasPermission('all_pending_jobs'))
                                <li class="nav-item ">
                                    <a href="{{ route('admin.pendingJobs') }}"
                                        class="nav-link {{ session('lsbsm') == 'pendingJobs' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>  {{ __('adminsidebar.all_pending_jobs') }}</p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->hasPermission('all_posted_jobs'))
                                <li class="nav-item ">
                                    <a href="{{ route('admin.allPostedJob') }}"
                                        class="nav-link {{ session('lsbsm') == 'allPostedJob' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>  {{ __('adminsidebar.all_posted_jobs') }}</p>
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->hasPermission('jobs_work'))
                                <li class="nav-item ">
                                    <a href="{{ route('admin.allPostedlatestJob') }}"
                                        class="nav-link {{ session('lsbsm') == 'allPostedlatestJob' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>  {{ __('adminsidebar.all_posted_latest_jobs') }}</p>
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->hasPermission('all_admin_modified_jobs'))

                                <li class="nav-item ">
                                    <a href="{{ route('admin.allPostedJobModifiedByAdmin') }}"
                                        class="nav-link {{ session('lsbsm') == 'allPostedJobModifiedByAdmin' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>  {{ __('adminsidebar.all_admin_modify_jobs') }}</p>
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->hasPermission('all_admin_custom_jobs'))

                                <li class="nav-item ">
                                    <a href="{{ route('admin.allPostedCustomJobModifiedByAdmin') }}"
                                        class="nav-link {{ session('lsbsm') == 'allPostedCustomJobModifiedByAdmin' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>  {{ __('adminsidebar.all_admin_customs_jobs') }}</p>
                                    </a>
                                </li>
                            @endif

                            {{-- <li class="nav-item ">
                          <a href="{{route('admin.allMenus') }}"
                              class="nav-link {{ session('lsbsm') == 'allMenus' ? ' active ' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>{{ __('All Menus') }}</p>
                          </a>
                          </li> --}}

                            {{-- <li class="nav-item ">
                          <a href="{{route('admin.allMenus') }}"
                              class="nav-link {{ session('lsbsm') == 'allMenus' ? ' active ' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>{{ __('All Menus') }}</p>
                          </a>
                          </li>
                          <li class="nav-item ">
                          <a href="{{route('admin.pagesAll') }}"
                              class="nav-link {{ session('lsbsm') == 'pagesAll' ? ' active ' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>{{ __('Pages') }}</p>
                          </a>
                      </li> --}}

                        </ul>
                    </li>
                @endif



                {{-- ./all posted job --}}

                {{-- subscribe honorarium --}}
                @if (Auth::user()->hasPermission('subscriber_honorarium'))

                    <li class="nav-item has-treeview {{ session('lsbm') == 'honorarium' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">

                            {{-- <i class="nav-icon fab fa-product-hunt"></i> --}}
                            <i class="nav-icon fas fa-leaf"></i>
                            <p>
                                {{ __('adminsidebar.subscriber_honoraria') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item ">
                                <a href="{{ route('admin.honorarialist') }}"
                                    class="nav-link {{ session('lsbsm') == 'honorarialist' ? ' active ' : '' }}">
                                    <i class="nav-icon far fa-circle nav-icon"></i>
                                    <p>
                                        {{ __('adminsidebar.honoraria_list') }}

                                    </p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{ route('admin.addhonorarium') }}"
                                    class="nav-link {{ session('lsbsm') == 'addhonorarium' ? ' active ' : '' }}">
                                    <i class="nav-icon far fa-circle nav-icon"></i>
                                    <p>
                                        {{ __('adminsidebar.add_honoraria') }}

                                    </p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif
                {{-- ./subscribe honorarium --}}


                {{-- obsb --}}
                @if (Auth::user()->hasPermission('obsb_setting'))

                    <li class="nav-item has-treeview {{ session('lsbm') == 'obsb' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">

                            {{-- <i class="nav-icon fab fa-product-hunt"></i> --}}
                            <i class="nav-icon fas fa-laptop-code"></i>
                            <p>
                                {{ __('adminsidebar.freelancer_setting') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item ">
                                <a href="{{ route('admin.jobcategory') }}"
                                    class="nav-link {{ session('lsbsm') == 'jobcategory' ? ' active ' : '' }}">
                                    <i class="nav-icon far fa-circle nav-icon"></i>
                                    <p>
                                        {{ __('adminsidebar.category') }}

                                    </p>
                                </a>
                            </li>



                        </ul>
                    </li>
                @endif
                {{-- ./obsb --}}

                {{-- User --}}
                @if (Auth::user()->hasPermission('tenant'))
                    <li class="nav-item has-treeview {{ session('lsbm') == 'user' ? ' menu-open ' : '' }}">
                        <a href="{{ route('admin.usersAll') }}" class="nav-link ">
                            <i class="nav-icon far fa-id-badge nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.tenants') }}
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>

                    </li>
                @endif

                @if (Auth::user()->hasPermission('employee'))
                <li class="nav-item has-treeview {{ session('lsbm') == 'employee' ? ' menu-open ' : '' }}">
                    <a href="{{ route('admin.employeeAll') }}" class="nav-link ">
                        <i class="nav-icon fas fa-user-check nav-icon"></i>
                        <p>
                            {{ __('adminsidebar.employee') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item ">
                          <a href="{{ route('admin.employeeAll') }}"
                              class="nav-link {{ session('lsbsm') == 'employeeAll' ? ' active ' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>  {{ __('adminsidebar.employee_list') }}</p>
                          </a>
                      </li>
                      <li class="nav-item ">
                          <a href="{{ route('admin.employeserviceProfilelist') }}"
                              class="nav-link {{ session('lsbsm') == 'profilelist' ? ' active ' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p> {{ __('adminsidebar.all_service_profile') }}</p>
                          </a>
                      </li>
                      <li class="nav-item has-treeview {{ session('lsbm') == 'employeeReport' ? ' menu-open ' : '' }}">
                        <a href="{{ route('admin.employeeReport') }}" class="nav-link ">
                            <i class="nav-icon fa fa-address-book nav-icon"></i>
                            <p>
                                Employee Report
    
                            </p>
                        </a>
                    </li>
                    </ul>

                </li>
            @endif
            @if (Auth::user()->hasPermission('freelancer'))
                <li class="nav-item has-treeview {{ session('lsbm') == 'freelancer' ? ' menu-open ' : '' }}">
                    <a href="{{ route('admin.freelancerAll') }}" class="nav-link ">
                        <i class="nav-icon fas fa-cloud-upload-alt nav-icon"></i>
                        <p>
                            {{ __('adminsidebar.freelancer') }}
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item ">
                          <a href="{{ route('admin.freelancerAll') }}"
                              class="nav-link {{ session('lsbsm') == 'freelancerAll' ? ' active ' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>   {{ __('adminsidebar.freelancer_list') }}</p>
                          </a>
                      </li>
                      <li class="nav-item ">
                          <a href="{{route('admin.freelancerworklist')}}"
                              class="nav-link {{ session('lsbsm') == 'worklist' ? ' active ' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>   {{ __('adminsidebar.freelancer_work_list') }}</p>
                          </a>
                      </li>
                    </ul>

                </li>
            @endif

                @if (Auth::user()->hasPermission('opinions'))
                    <li class="nav-item has-treeview {{ session('lsbm') == 'opinions' ? ' menu-open ' : '' }}">
                        <a href="{{ route('admin.opinions') }}" class="nav-link ">
                            <i class="nav-icon far fa-comments nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.opinions') }}
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>
                    </li>

                @endif

                
                  <li class="nav-item has-treeview {{ session('lsbm') == 'ratinglist' ? ' menu-open ' : '' }}">
                      <a href="{{ route('admin.ratinglist') }}" class="nav-link ">
                          <i class="nav-icon fa fa-star nav-icon"></i>
                          <p>
                            {{ __('adminsidebar.review_ratings') }}
                          </p>
                      </a>
                  </li>

                  <li class="nav-item has-treeview {{ session('lsbm') == 'softcomapplication' ? ' menu-open ' : '' }}">
                    <a href="{{ route('admin.applicationlist') }}" class="nav-link ">
                        <i class="nav-icon fa fa-star nav-icon"></i>
                        <p>
                          Applications
                          <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('admin.applicationlist') }}"
                                class="nav-link {{ session('lsbsm') == 'softcomapplicationlist' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('adminsidebar.applicationlist') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.listapplicantcategory') }}"
                                class="nav-link {{ session('lsbsm') == 'softcomapplicantcategory' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Applicant Category</p>
                            </a>
                        </li>
                       
                    </ul>
                </li>

                <!-- ---------------------fardeen code-------------------- -->
                    <li class="nav-item has-treeview {{ session('lsbm') == 'qrlist' ? ' menu-open ' : '' }}">
                        <a href="{{route('admin.serviceProfileQR')}}" class="nav-link ">
                            <i class="nav-icon fas fa-qrcode nav-icon"></i>
                            <p>
                              
                                {{ __('adminsidebar.service_profile_qr') }}

                            </p>
                        </a>
                    </li>
                <!-- ---------------------end of fardeen code-------------------- -->

                @if (Auth::user()->hasPermission('service_profile'))
                    <li class="nav-item has-treeview {{ session('lsbm') == 'profilelist' ? ' menu-open ' : '' }}">
                        <a href="{{ route('admin.serviceProfilelist') }}" class="nav-link ">
                            <i class="nav-icon fas fa-id-card nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.service_profile') }}

                            </p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasPermission('service_profile_orders'))
                    <li
                        class="nav-item has-treeview {{ session('lsbm') == 'serviceOrders' ? ' menu-open ' : '' }}">
                        <a href="{{ route('admin.serviceProductOrderList') }}" class="nav-link ">
                            <i class="nav-icon fas fa-file-alt nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.service_products_order') }}

                            </p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasPermission('service_products'))
                    <li
                        class="nav-item has-treeview {{ session('lsbm') == 'serviceProducts' ? ' menu-open ' : '' }}">
                        <a href="{{ route('admin.serviceProductslist') }}" class="nav-link ">
                            <i class="nav-icon fas fa-shopping-bag nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.service_products') }}

                            </p>
                        </a>

                    </li>
                @endif
                @if (Auth::user()->hasPermission('service_items'))
                    <li
                        class="nav-item has-treeview {{ session('lsbm') == 'serviceItems' ? ' menu-open ' : '' }}">
                        <a href="{{ route('admin.serviceItems') }}" class="nav-link ">
                            <i class="nav-icon fas fa-shopping-basket nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.service_items') }}

                            </p>
                        </a>

                    </li>
                @endif
                @if (Auth::user()->hasPermission('service_items_order'))
                    <li
                        class="nav-item has-treeview {{ session('lsbm') == 'serviceItemOrders' ? ' menu-open ' : '' }}">
                        <a href="{{ route('admin.serviceItemOrders') }}" class="nav-link ">
                            <i class="nav-icon far fa-hourglass nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.service_item_order') }}

                            </p>
                        </a>

                    </li>
                @endif
                @if (Auth::user()->hasPermission('course_items'))
                      <li
                          class="nav-item has-treeview {{ session('lsbm') == 'courseItems' ? ' menu-open ' : '' }}">
                          <a href="{{ route('admin.courseItems') }}" class="nav-link ">
                              <i class="nav-icon fas fa-chalkboard nav-icon"></i>
                              <p>
                                {{ __('adminsidebar.course_items') }}

                              </p>
                          </a>

                      </li>
                  @endif
                  @if (Auth::user()->hasPermission('course_orders'))
                      <li
                          class="nav-item has-treeview {{ session('lsbm') == 'courseItemOrders' ? ' menu-open ' : '' }}">
                          <a href="{{ route('admin.courseItemOrders') }}" class="nav-link ">
                              <i class="nav-icon fas fa-book-open nav-icon"></i>
                              <p>
                                {{ __('adminsidebar.course_item_order') }}

                              </p>
                          </a>

                      </li>
                  @endif
                @if (Auth::user()->hasPermission('categorylist'))
                    <li
                        class="nav-item has-treeview {{ session('lsbm') == 'categories' ? ' menu-open ' : '' }}">
                        <a href="{{ route('admin.servicecategory') }}" class="nav-link ">
                            <i class="nav-icon far fa-hourglass nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.category_list') }}

                            </p>
                        </a>

                    </li>
                  @endif
              
                @if (Auth::user()->hasPermission('suggessionAll'))
                <li
                    class="nav-item has-treeview {{ session('lsbm') == 'suggessionAll' ? ' menu-open ' : '' }}">
                    <a href="{{ route('admin.suggessionAll') }}" class="nav-link ">
                        <i class="nav-icon fas fa-comment-dots nav-icon"></i>
                        <p>
                            {{ __('adminsidebar.sug_com') }}

                        </p>
                    </a>

                </li>
            @endif
              
                @if (Auth::user()->hasPermission('addwebsitelink'))
                    <li
                        class="nav-item has-treeview {{ session('lsbm') == 'create_service_profile' ? ' menu-open ' : '' }}">
                        <a href="{{ route('admin.createServiceProfile') }}" class="nav-link ">
                            <i class="nav-icon fas fa-user-plus nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.create_service_profile') }}

                            </p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasPermission('needs'))
                    <li class="nav-item has-treeview {{ session('lsbm') == 'needs' ? ' menu-open ' : '' }}">
                        <a href="{{ route('admin.needs') }}" class="nav-link ">
                            <i class="nav-icon fas fa-hand-holding-heart nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.needs') }}


                            </p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasPermission('socialgroup'))
                <li class="nav-item has-treeview {{ session('lsbm') == 'socialGroups' ? ' menu-open ' : '' }}">
                    <a href="{{ route('admin.socialGroups') }}" class="nav-link ">
                        <i class="nav-icon fas fa-bell nav-icon"></i>
                        <p>
                            {{ __('adminsidebar.social_group') }}

                        </p>
                    </a>
                </li>
            @endif
            @if (Auth::user()->hasPermission('smssend'))
              <li class="nav-item has-treeview {{ session('lsbm') == 'usersmssend' ? ' menu-open ' : '' }}">
                  <a href="{{ route('admin.usersmssendpage') }}" class="nav-link ">
                      <i class="nav-icon fas fa-sms nav-icon"></i>
                      <p>
                        {{ __('adminsidebar.send_sms') }}

                      </p>
                  </a>
              </li>
           @endif
              @if (Auth::user()->hasPermission('notificationsend'))
                  <li class="nav-item has-treeview {{ session('lsbm') == 'usernotificatioonsend' ? ' menu-open ' : '' }}">
                      <a href="{{ route('admin.usernotificatioonsendpage') }}" class="nav-link ">
                          <i class="nav-icon 	fas fa-bell nav-icon"></i>
                          <p>
                            {{ __('adminsidebar.send_notification') }}

                          </p>
                      </a>
                  </li>
              @endif
               <!-- ---------------------------------------------------->
               

           <!-- ---------------------------------------------------->
                @if (Auth::user()->hasPermission('blog'))
                    <li class="nav-item has-treeview {{ session('lsbm') == 'allBlogs' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">
                            <i class="fas fa-bold nav-icon nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.blogs') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="{{ route('admin.allBlogs') }}"
                                    class="nav-link {{ session('lsbsm') == 'allBlogs' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('adminsidebar.all_blogs') }}</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview {{ session('lsbsm') == 'addNewBlog' ? ' menu-open ' : '' }}">
                              <a href="{{ route('admin.addNewBlog') }}" class="nav-link ">
                                  <i class="nav-icon far fa-circle nav-icon"></i>
                                  <p>
                                    {{ __('adminsidebar.add_new_post') }}
    
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item has-treeview {{ session('lsbsm') == 'categories' ? ' menu-open ' : '' }}">
                              <a href="{{ route('admin.categories') }}" class="nav-link ">
                                  <i class="nav-icon far fa-circle nav-icon"></i>
                                  <p>
                                    {{ __('adminsidebar.blogs_categories') }}
    
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item has-treeview {{ session('lsbsm') == 'tags' ? ' menu-open ' : '' }}">
                            <a href="{{ route('admin.tags') }}" class="nav-link ">
                                <i class="nav-icon far fa-circle nav-icon"></i>
                                <p>
                                    {{ __('adminsidebar.blogs_tags') }}
    
                                </p>
                            </a>
                        </li>
                        </ul>

                    </li>
                @endif

                @if (Auth::user()->hasPermission('report'))
                    <li class="nav-item has-treeview {{ session('lsbm') == 'report' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">
                            <i class="fas fa-chart-area nav-icon nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.reports') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item ">
                                <a href="{{ route('admin.report', ['type' => 'Tenant']) }}"
                                    class="nav-link {{ session('lsbsm') == 'reportTenant' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>  {{ __('adminsidebar.tenant_reports') }}</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{ route('admin.report', ['type' => 'PF']) }}"
                                    class="nav-link {{ session('lsbsm') == 'reportPF' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>  {{ __('adminsidebar.pf_reports') }}</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{ route('admin.report', ['type' => 'Jobs']) }}"
                                    class="nav-link {{ session('lsbsm') == 'reportJobs' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>  {{ __('adminsidebar.jobs_reports') }}</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{ route('admin.report', ['type' => 'Works']) }}"
                                    class="nav-link {{ session('lsbsm') == 'reportWorks' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>  {{ __('adminsidebar.work_reports') }}</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{ route('admin.report', ['type' => 'Withdraw']) }}"
                                    class="nav-link {{ session('lsbsm') == 'reportWithdraw' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>  {{ __('adminsidebar.withdraw_reports') }}</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{ route('admin.report', ['type' => 'Deposit']) }}"
                                    class="nav-link {{ session('lsbsm') == 'reportDeposit' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>  {{ __('adminsidebar.deposite_reports') }}</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{ route('admin.report', ['type' => 'Honorarium']) }}"
                                    class="nav-link {{ session('lsbsm') == 'reportHonorarium' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>  {{ __('adminsidebar.honorarium_reports') }}</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{ route('admin.report', ['type' => 'MoveWallet']) }}"
                                    class="nav-link {{ session('lsbsm') == 'reportMoveWallet' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>  {{ __('adminsidebar.move_wallet_report') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                {{-- ./ reports --}}

                {{-- role --}}
                @if (Auth::user()->roleItems()->count() < 1)
                    <li class="nav-item has-treeview {{ session('lsbm') == 'role' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-user-cog nav-icon"></i>
                            <p>
                                {{ __('adminsidebar.role') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">


                            <li class="nav-item ">
                                <a href="{{ route('admin.adminsAll') }}"
                                    class="nav-link {{ session('lsbsm') == 'adminsAll' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> {{ __('adminsidebar.all_admins') }}</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{ route('admin.addNewRole') }}"
                                    class="nav-link {{ session('lsbsm') == 'addNewRole' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> {{ __('adminsidebar.add_new_role') }}</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{ route('admin.allRoleUser') }}"
                                    class="nav-link {{ session('lsbsm') == 'allRoleUser' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> {{ __('adminsidebar.all_roles') }}</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif

                {{-- ./role --}}


                {{-- Set up Mangement --}}
                @if (Auth::user()->hasPermission('setupmanagement'))
                  <li class="nav-item has-treeview {{ session('lsbm') == 'variations' ? ' menu-open ' : '' }}">
                      <a href="#" class="nav-link ">
                          <i class="nav-icon fas fa-user-cog nav-icon"></i>
                          <p>
                            {{ __('adminsidebar.setup_management') }}
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">


                          <li class="nav-item ">
                              <a href="{{ route('admin.listunit') }}"
                                  class="nav-link {{ session('lsbsm') == 'units' ? ' active ' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('adminsidebar.units') }}</p>
                              </a>
                          </li>

                          <li class="nav-item ">
                              <a href="{{ route('admin.listcolor') }}"
                                  class="nav-link {{ session('lsbsm') == 'colors' ? ' active ' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('adminsidebar.colors') }}</p>
                              </a>
                          </li>

                          <li class="nav-item ">
                              <a href="{{ route('admin.listdistrict') }}"
                                  class="nav-link {{ session('lsbsm') == 'districts' ? ' active ' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  {{-- <p>{{ __('adminsidebar.distrtict') }}</p> --}}
                                  <p>Districts</p>
                              </a>
                          </li>
                          <li class="nav-item ">
                              <a href="{{ route('admin.listthana') }}"
                                  class="nav-link {{ session('lsbsm') == 'thanas' ? ' active ' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('adminsidebar.thana') }}</p>
                              </a>
                          </li>
                          <li class="nav-item ">
                              <a href="{{ route('admin.listpostoffice') }}"
                                  class="nav-link {{ session('lsbsm') == 'postoffices' ? ' active ' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('adminsidebar.post_office') }}</p>
                              </a>
                          </li>

                          <li class="nav-item ">
                              <a href="{{ route('admin.listspeciallink') }}"
                                  class="nav-link {{ session('lsbsm') == 'speciallinks' ? ' active ' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('adminsidebar.speical_link') }}</p>
                              </a>
                          </li>
                          <li class="nav-item ">
                              <a href="{{ route('admin.listspecialcategory') }}"
                                  class="nav-link {{ session('lsbsm') == 'specialcategories' ? ' active ' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('adminsidebar.speical_category') }}</p>
                              </a>
                          </li>
                          <li class="nav-item has-treeview {{ session('lsbm') == 'delivery' ? ' menu-open ' : '' }}">
                            <a href="{{ route('admin.listdeliveryman') }}" class="nav-link ">
                                <i class="nav-icon fas fa fa-male nav-icon"></i>
                                <p>
                                    Delivery Man
                                    {{-- <i class="right fas fa-angle-left"></i> --}}
                                </p>
                            </a>
                        </li>


                      </ul>
                  </li>
              @endif


                {{-- End setup management --}}

                {{-- messages --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.messages') }}"
                        class="nav-link {{ session('Messages') == 'Messages' ? ' active ' : '' }}">
                        <i class="far fa-comments nav-icon"></i>
                        <p>{{ __('Messages') }}</p>
                    </a>
                </li> --}}
                {{-- ./messages --}}



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
