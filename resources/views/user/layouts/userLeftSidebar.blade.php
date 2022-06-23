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

            @php 
                $profile=\App\Models\ServiceProfile::where('user_id',Auth::user()->id)->count();
                $vendor=\App\Models\ServiceProductOrder::where('user_id',Auth::user()->id)->count();
                $profilworker=\App\Models\ServiceProfileWorker::where('owner_id',Auth::user()->id)->count();
                $workedprofile=\App\Models\ServiceProfileWorker::where('worker_user_id',Auth::user()->id)->count();
            @endphp

                <!-- Dashboard -->
                <li class="nav-item has-treeview {{ session('lsbm') == 'dashboard' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('usersidebar.dashboard') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item ">
                            <a href="{{ route('user.dashboard') }}"
                                class="nav-link {{ session('lsbsm') == 'dashboard' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.dashboard') }}</p>
                            </a>
                        </li>
                      <li class="nav-item ">
                          <a href="{{ route('user.makeServiceProfile') }}"
                              class="nav-link {{ session('lsbsm') == 'services' ? ' active ' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>{{ __('usersidebar.create_service_profile') }}</p>
                          </a>
                      </li>
                      @if($profile>=1)
                            <li class="nav-item ">
                                <a href="{{ route('user.userpublishservice') }}"
                                    class="nav-link {{ session('lsbsm') == 'publishservice' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('usersidebar.published_shop') }}</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('user.userunpublishservice') }}"
                                    class="nav-link {{ session('lsbsm') == 'unpublishservice' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('usersidebar.unpublished_shop') }}</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('user.usertrialservice') }}"
                                    class="nav-link {{ session('lsbsm') == 'trialservice' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('usersidebar.trial_shop') }}</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('user.myServicesDashboard') }}"
                                    class="nav-link {{ session('lsbsm') == 'services' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('usersidebar.my_services') }}</p>
                                </a>
                            </li>
                        @endif
                        @if($vendor>=1)
                        <li class="nav-item ">
                            <a href="{{ route('user.uservendorlist') }}"
                                class="nav-link {{ session('lsbsm') == 'vendor' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.vendorlist') }}</p>
                            </a>
                        </li>
                        @endif
                        @if($profilworker>=1)
                            <li class="nav-item ">
                                <a href="{{ route('user.MyProfileworkerlist') }}"
                                    class="nav-link {{ session('lsbsm') == 'myprofileworker' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('usersidebar.profile_worker') }}</p>
                                </a>
                            </li>
                        @endif
                        @if($workedprofile>=1)
                            <li class="nav-item ">
                                <a href="{{ route('user.MyworkedProfilelist') }}"
                                    class="nav-link {{ session('lsbsm') == 'myworkedprofile' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('usersidebar.worked_profile') }}</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item ">
                            <a href="{{ route('user.servicesSearchDashboard') }}"
                                class="nav-link {{ session('lsbsm') == 'search' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.services_search') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('user.postPaidOrFullPaidDashboard', ['type' => 'full_paid']) }}"
                                class="nav-link {{ session('lsbsm') == 'full_paid' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.paid_accounts') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('user.postPaidOrFullPaidDashboard', ['type' => 'post_paid']) }}"
                                class="nav-link {{ session('lsbsm') == 'post_paid' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.unpaid_accounts') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('user.allSubscribersStation') }}"
                                class="nav-link {{ session('lsbsm') == 'station' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.service_stations') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- ./Dashboard --}}

              

                {{-- Orders --}}
                <li class="nav-item has-treeview {{ session('lsbm') == 'orders' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            {{ __('usersidebar.orders') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if($profile>=1)
                        <li class="nav-item ">
                            <a href="{{ route('user.myServieProfileOrders') }}"
                                class="nav-link {{ session('lsbsm') == 'serviceProfileOrders' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.received_products') }}</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item ">
                            <a href="{{ route('user.myOrders') }}"
                                class="nav-link {{ session('lsbsm') == 'myorders' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.given_products') }}</p>
                            </a>
                        </li>
                        @if($profile>=1)
                        <li class="nav-item">
                            <a href="{{ route('user.ServieItemOrders') }}"
                                class="nav-link {{ session('lsbsm') == 'ServieItemOrders' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.received_services') }}</p>
                            </a>
                        </li>
                        @endif
                      <li class="nav-item">
                          <a href="{{ route('user.getServieItemOrders') }}"
                              class="nav-link {{ session('lsbsm') == 'getServieItemOrders' ? ' active ' : '' }}">
                              <i class="far fa-hourglass nav-icon"></i>
                              <p>{{ __('usersidebar.given_services') }}</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('user.EnrollCourse') }}"
                              class="nav-link {{ session('lsbsm') == 'enrollcourse' ? ' active ' : '' }}">
                              <i class="far fa-hourglass nav-icon"></i>
                              <p>{{ __('usersidebar.enrolled_course') }}</p>
                          </a>
                      </li>
                    </ul>

                </li>
                @if($profile>=1)
                <li class="nav-item">
                    <a href="{{ route('user.myServieProfileProducts') }}"
                        class="nav-link {{ session('lsbsm') == 'product' ? ' active ' : '' }}">
                        <i class=" fas fa-shopping-bag nav-icon"></i>
                        <p>{{ __('usersidebar.product_list') }}</p>
                    </a>
                </li>
              
                <li class="nav-item">
                  <a href="{{ route('user.ServieItems') }}"
                      class="nav-link {{ session('lsbsm') == 'ServieItems' ? ' active ' : '' }}">
                      <i class="fas fa-shopping-basket nav-icon"></i>
                      <p>{{ __('usersidebar.service_list') }}</p>
                  </a>
              </li>
                {{-- Images --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('user.mediaAll') }}"
                        class="nav-link {{ session('lsbsm') == 'product' ? ' active ' : '' }}">
                        <i class="nav-icon fas fa-images nav-icon"></i>
                        <p>Images</p>
                    </a>
                </li> --}}
              @endif
                 <!-- Opinion -->
                 <li class="nav-item has-treeview {{ session('lsbm') == 'opinion' ? ' menu-open ' : '' }}">
                  <a href="#" class="nav-link ">
                      <i class="nav-icon far fa-comments"></i>
                      <p>
                          {{ __('usersidebar.opinions') }}
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">

                      <li class="nav-item ">
                          <a href="{{ route('user.allOpinions') }}"
                              class="nav-link {{ session('lsbsm') == 'allopinions' ? ' active ' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>{{ __('usersidebar.all_opinions') }}</p>
                          </a>
                      </li>
                      <li class="nav-item ">
                          <a href="{{ route('user.myOpinions') }}"
                              class="nav-link {{ session('lsbsm') == 'myopinions' ? ' active ' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>{{ __('usersidebar.my_opinions') }}</p>
                          </a>
                      </li>
                      <li class="nav-item ">
                          <a href="{{ route('user.addOpinions') }}"
                              class="nav-link {{ session('lsbsm') == 'addopinions' ? ' active ' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>{{ __('usersidebar.add_opinions') }}</p>
                          </a>
                      </li>
                  </ul>

              </li>
              {{-- ./Opinion --}}
             

              
                {{-- Need --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('user.myBlog') }}"
                        class="nav-link {{ session('lsbsm') == 'blog' ? ' active ' : '' }}">
                        <i class="fas fa-bold nav-icon"></i>
                        <p>{{ __('usersidebar.blogs') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.myNeeds') }}"
                        class="nav-link {{ session('lsbsm') == 'myNeeds' ? ' active ' : '' }}">
                        <i class="fas fa-hand-holding-heart nav-icon"></i>
                        <p>{{ __('usersidebar.needs') }}</p>
                    </a>
                </li> --}}
                @if($profile>=1)
                <li class="nav-item">
                  <a href="{{ route('user.listdeliveryman') }}"
                      class="nav-link {{ session('lsbsm') == 'delivery' ? ' active ' : '' }}">
                      <i class="fa fa-truck nav-icon"></i>
                      <p>{{ __('usersidebar.delivery_man') }}</p>
                  </a>
                 </li>
                 @endif
                @if (Auth::user()->referral)
                    <li class="nav-item">
                        <a href="{{ route('user.reffer') }}"
                            class="nav-link {{ session('lsbsm') == 'reffer' ? ' active ' : '' }}">
                            <i class="fas fa-atlas nav-icon"></i>
                            <p>{{ __('usersidebar.reffer_sales_history') }}</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->is_employee)
                  <li class="nav-item">
                      <a href="{{ route('user.employecreateprofilelist') }}"
                          class="nav-link {{ session('lsbsm') == 'employee' ? ' active ' : '' }}">
                          <i class="fa fa-address-book nav-icon"></i>
                          <p>{{ __('usersidebar.create_profile_list') }}</p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('user.employeeReport') }}"
                        class="nav-link {{ session('lsbsm') == 'employee_report' ? ' active ' : '' }}">
                        <i class="fa fa-address-book nav-icon"></i>
                        <p>{{ __('usersidebar.employee_report') }}</p>
                    </a>
                </li>
                  <li class="nav-item">
                      <a href="{{ route('user.categorycommissioncheck') }}"
                          class="nav-link {{ session('lsbsm') == 'categories' ? ' active ' : '' }}">
                          <i class="fas fa-arrows-alt nav-icon"></i>
                          <p>{{ __('usersidebar.category_commission_check') }}</p>
                      </a>
                  </li>
                  @if (Auth::user()->is_tso)

                    <li class="nav-item">
                        <a href="{{ route('user.myteam') }}"
                            class="nav-link {{ session('lsbsm') == 'myteam' ? ' active ' : '' }}">
                            <i class="fas fa-arrows-alt nav-icon"></i>
                            <p>My Team</p>
                        </a>
                    </li>
                  @endif
                 @endif


                {{-- ./Need --}}
                {{-- bids --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('user.myBids') }}"
                        class="nav-link {{ session('lsbsm') == 'myBids' ? ' active ' : '' }}">
                        <i class="fas fa-coins nav-icon"></i>
                        <p>{{ __('My Bids') }}</p>
                    </a>
                </li> --}}
                <li class="nav-item has-treeview {{ session('lsbm') == 'myBids' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-pen-nib nav-icon"></i>
                        <p>
                            {{ __('usersidebar.bids') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('user.myBids', ['status' => 'approved']) }}"
                                class="nav-link {{ session('lsbsm') == 'approvedBids' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.approved_bids') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('user.myBids', ['status' => 'pending']) }}"
                                class="nav-link {{ session('lsbsm') == 'pendingBids' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.pending_bids') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('user.myBids', ['status' => 'rejected']) }}"
                                class="nav-link {{ session('lsbsm') == 'rejectedBids' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.rejected_bids') }}</p>
                            </a>
                        </li>


                    </ul>
                </li>
                {{-- ./bids --}}
                {{-- Balance --}}
                <li class="nav-item">
                    <a href="{{ route('user.userBalance') }}"
                        class="nav-link {{ session('lsbsm') == 'balance' ? ' active ' : '' }}">
                        <i class="fab fa-btc nav-icon"></i>
                        <p>{{ __('usersidebar.balance') }}</p>
                    </a>
                </li>
                {{-- ./Balance --}}

                {{-- Newsfeed --}}
                <!--<li class="nav-item">-->
                <!--    <a href=""-->
                <!--        class="nav-link {{ session('lsbsm') == 'newsfeed' ? ' active ' : '' }}">-->
                <!--        <i class="fas fa-newspaper w3-text-green nav-icon"></i>-->
                <!--        <p>{{ __('Newsfeed') }}</p>-->
                <!--    </a>-->
                <!--</li>-->
                {{-- ./Newsfeed --}}

                {{-- role --}}
                <li class="nav-item has-treeview {{ session('lsbm') == 'user' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tools nav-icon"></i>
                        <p>
                            {{ __('usersidebar.tenant_settings') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('user.userEdit') }}"
                                class="nav-link {{ session('lsbsm') == 'userEdit' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.edit_profile') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('user.userPasswordChange') }}"
                                class="nav-link {{ session('lsbsm') == 'userPasswordChange' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.password_change') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('user.userPinChange') }}"
                                class="nav-link {{ session('lsbsm') == 'userPinChange' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('usersidebar.pin_change') }}</p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('user.withdrawalaccountlist') }}"
                                class="nav-link {{ session('lsbsm') == 'withdrawalaccount' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Withdrawal Account') }}</p>
                            </a>
                        </li>


                    </ul>
                </li>
                {{-- ./role --}}

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
