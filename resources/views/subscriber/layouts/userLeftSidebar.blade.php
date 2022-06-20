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
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-compact" data-widget="treeview"
                role="menu" data-accordion="true">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

                <!-- Dashboard -->
                <li class="nav-item has-treeview {{ session('lsbm') == 'dashboard' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Dashboard') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item ">
                            <a href="{{ route('user.dashboard') }}"
                                class="nav-link {{ session('lsbsm') == 'dashboard' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Tenant Dashboard') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- ./Dashboard --}}


                @if (isset($subscription))

                <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ $subscription->workStation->title }} ({{substr($subscription->subscription_code, -7)}})
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                 
                        @php
                            if(isset($profile)){
                                $worker= App\Models\ServiceProfileWorker::where('profile_id', $profile->id)->where('worker_user_id', Auth::id())->first();

                            }
                         
                            
                        @endphp


                    <ul class="nav nav-treeview">
                        @if (isset($profile))
                            @if ($subscription->category->business_type == 'shop')

                                    @if($worker)
                                        @if($worker->add==1)
                                            <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                                <a href="{{ route('subscriber.newProfileProduct', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}"
                                                    class="nav-link {{ session('lsbsm') == 'newProfileProduct' ? ' active ' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Add Product</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if($worker->list==1)
                                            <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                                <a href="{{ route('subscriber.myAllServiceProfileProducts', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }}"
                                                    class="nav-link {{ session('lsbsm') == 'myAllServiceProfileProducts' ? ' active ' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>All Product</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if($worker->order==1)
                                            <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                                <a href="{{ route('subscriber.allordersOfServiceProducts', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}"
                                                    class="nav-link {{ session('lsbsm') == 'job' ? ' active ' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>All Order</p>
                                                </a>
                                            </li>
                                        @endif
                                        <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                            <a href="{{ route('subscriber.ShopQrcode', ['subscription' => $subscription->subscription_code, 'profile' =>$profile->id]) }}"
                                                class="nav-link {{ session('lsbsm') == 'qrcode' ? ' active ' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>QR Code</p>
                                            </a>
                                        </li>
                                        @if($worker->customer_list==1)
                                            <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                                <a href="{{ route('subscriber.CustomerList', ['subscription' => $subscription->subscription_code, 'profile' =>$profile->id]) }}"
                                                    class="nav-link {{ session('lsbsm') == 'customerlist' ? ' active ' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Customer List</p>
                                                </a>
                                            </li>
                                        @endif
                                    @else 

                                    <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                        <a href="{{ route('subscriber.newProfileProduct', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}"
                                            class="nav-link {{ session('lsbsm') == 'newProfileProduct' ? ' active ' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Product</p>
                                        </a>
                                    </li>

                                    <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                        <a href="{{ route('subscriber.myAllServiceProfileProducts', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }}"
                                            class="nav-link {{ session('lsbsm') == 'myAllServiceProfileProducts' ? ' active ' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>All Product</p>
                                        </a>
                                    </li>


                                    <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                        <a href="{{ route('subscriber.allordersOfServiceProducts', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}"
                                            class="nav-link {{ session('lsbsm') == 'job' ? ' active ' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>All Order</p>
                                        </a>
                                    </li>

                                    <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                        <a href="{{ route('subscriber.ShopQrcode', ['subscription' => $subscription->subscription_code, 'profile' =>$profile->id]) }}"
                                            class="nav-link {{ session('lsbsm') == 'qrcode' ? ' active ' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>QR Code</p>
                                        </a>
                                    </li>

                                    <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                        <a href="{{ route('subscriber.CustomerList', ['subscription' => $subscription->subscription_code, 'profile' =>$profile->id]) }}"
                                            class="nav-link {{ session('lsbsm') == 'customerlist' ? ' active ' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Customer List</p>
                                        </a>
                                    </li>


                                    @endif
                            @endif
                        @endif
                        @if (isset($profile))
                            @if ($subscription->category->business_type == 'service')
                                <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                    <a href="{{ route('subscriber.newServiceItem', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}"
                                        class="nav-link {{ session('lsbsm') == 'newServiceItem' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Service</p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                    <a href="{{ route('subscriber.allServiceItems', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }}"
                                        class="nav-link {{ session('lsbsm') == 'allServiceItems' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Service</p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                    <a href="{{ route('subscriber.allordersOfServiceProducts', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}"
                                        class="nav-link {{ session('lsbsm') == 'allordersOfServiceProducts' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Order</p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                    <a href="{{ route('subscriber.ShopQrcode', ['subscription' => $subscription->subscription_code, 'profile' =>$profile->id]) }}"
                                        class="nav-link {{ session('lsbsm') == 'job' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>QR Code</p>
                                    </a>
                                </li>
                            @endif
                        @endif

                        @if (isset($profile))
                        @if ($subscription->category->business_type == 'course')
                            <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                <a href="{{ route('subscriber.newCourse', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}"
                                    class="nav-link {{ session('lsbsm') == 'newCourse' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Course</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                <a href="{{ route('subscriber.allcourseitems', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }}"
                                    class="nav-link {{ session('lsbsm') == 'allCourseItems' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Course</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                <a href="{{ route('subscriber.allordersOfCourse', ['subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}"
                                    class="nav-link {{ session('lsbsm') == 'allordersOfCourse' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Order</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                <a href="{{ route('subscriber.ShopQrcode', ['subscription' => $subscription->subscription_code, 'profile' =>$profile->id]) }}"
                                    class="nav-link {{ session('lsbsm') == 'job' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>QR Code</p>
                                </a>
                            </li>
                        @endif
                    @endif



                        @if ($subscription->category_id == 1)
                            <li class="nav-item has-treeview {{ session('lsbm') == 'job' ? ' menu-open ' : '' }}">
                                <a href="{{route('subscriber.subscriptionFindJob',$subscription->subscription_code)}}"
                                    class="nav-link {{ session('lsbsm') == 'job' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Find a Job') }}</p>
                                </a>
                            </li>


                            <li class="nav-item ">
                                <a href="{{route('subscriber.subscriptionPostJob',$subscription->subscription_code)}}"
                                    class="nav-link {{ session('lsbsm') == 'postjob' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Post a Job') }}</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{route('subscriber.subscriptionPostedJob',$subscription->subscription_code)}}"
                                    class="nav-link {{ session('lsbsm') == 'mypostedjob' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('My Posted Job') }}</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{route('subscriber.subscriptionMyJobWork',$subscription->subscription_code)}}"
                                    class="nav-link {{ session('lsbsm') == 'myjobwork' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('My Job Works') }}</p>
                                </a>
                            </li>

                        @endif
                        @if($subscription->category->business_type != 'course')
                            @if ( $value = $subscription->category)
                                @if (($value->sp_active == true) && ($value->pp_active == true))

                                <li class="nav-item ">
                                    <a href="{{route('subscriber.subscriptionPostBusinessProfile',$subscription->subscription_code)}}"
                                        class="nav-link {{ session('lsbsm') == 'postBusinessProfile' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Post a {{ $subscription->category ? $subscription->category->sp_title : ''}} </p>
                                    </a>
                                </li>

                                <li class="nav-item ">

                                    <a href="{{route('subscriber.subscriptionPostPersonalProfile',$subscription->subscription_code)}}"
                                        class="nav-link {{ session('lsbsm') == 'postPersonalProfile' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Post a {{ $subscription->category ? $subscription->category->pp_title : ''}} </p>
                                    </a>
                                </li>

                                <li class="nav-item ">
                                    <a href="{{ route('subscriber.subscriptionfindProfile',$subscription->subscription_code) }}"
                                        class="nav-link {{ session('lsbsm') == 'findProfile' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Find a {{ $subscription->category ? $subscription->category->sp_title : ''}} </p>
                                    </a>
                                </li>

                                
                                <li class="nav-item ">
                                    <a href="{{route('subscriber.myProfileDetails',[$subscription->subscription_code,'business'])}}"
                                        class="nav-link {{ session('lsbsm') == 'myProfileDetailsbusiness' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>My {{ $subscription->category ? $subscription->category->sp_title : ''}} </p>
                                    </a>
                                </li>

                                <li class="nav-item ">
                                    <a href="{{route('subscriber.myProfileDetails',[$subscription->subscription_code, 'personal'])}}"
                                        class="nav-link {{ session('lsbsm') == 'myProfileDetailspersonal' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>My {{ $subscription->category ? $subscription->category->pp_title : ''}} </p>
                                    </a>
                                </li>

                                @endif
                            @endif
                        @endif


                    </ul>
                </li>

                @if ($subscription->category_id == 1)


                <li class="nav-item has-treeview {{ session('lsbm') == 'myjob' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            My Jobs / Works
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                            <li class="nav-item ">
                                <a href="{{route('subscriber.subscriptionPostedJob',$subscription->subscription_code)}}"
                                    class="nav-link {{ session('lsbsm') == 'mypostedjob' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('My Posted Job') }}</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{route('subscriber.subscriptionSubmittedWork',$subscription->subscription_code)}}"
                                    class="nav-link {{ session('lsbsm') == 'submittedWork' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Submitted Work') }}</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{route('subscriber.subscriptionMyJobWork',$subscription->subscription_code)}}"
                                    class="nav-link {{ session('lsbsm') == 'myjobwork' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('My Job Works') }}</p>
                                </a>
                            </li>





                        </ul>
                    </li>
                    @endif

                @endif




                {{-- Newsfeed {{route('welcome.allnews',['workstation' => $subscription->work_station_id])}} --}}
                <!--<li class="nav-item">-->
                <!--    <a href=""-->
                <!--        class="nav-link {{ session('lsbsm') == 'allnews' ? ' active ' : '' }}">-->
                <!--        <i class="fas fa-newspaper w3-text-green nav-icon"></i>-->
                <!--        <p>{{ __('Newsfeed') }}</p>-->
                <!--    </a>-->
                <!--</li>-->
                {{-- ./Newsfeed --}}

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
