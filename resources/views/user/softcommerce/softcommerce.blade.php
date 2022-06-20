@extends('user.layouts.userMaster')

@push('css')

    <style>
        @media only screen and (max-width: 540px) {
            h3 {
                font-size: 17px;
            }

            .custom-design {
                padding: 0;
            }

            .center {
                text-align: center;
            }

            .details {
                margin: 5px 0px;
            }

        }

        @media only screen and (max-width: 786px) {
            .center {
                text-align: center;
            }

            .details {
                margin: 5px 0px;
            }

        }

    </style>

@endpush

@section('content')
    <section class="content">

        <br>
        <div class="container-fluid">
            @include('alerts.alerts')
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card card-widget">
                       
                        <div class="card-header">
                            <div class="info-box">
                                <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-wallet"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"></span>
                                    <span class="info-box-number">
                                         {{__('mysoftcom.my_soft_wallet')}}
                                    </span>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                           <b>{{__('mysoftcom.soft_wallet')}}</b>
                          <br>
                          <span class="w3-large"> {{ $user->totalBalance() }} <small>SCB</small></span>
                          <hr>
                          @if($profile_count>=1)
                          <b>Welcome Balance</b>
                          <br>
                          <span class="w3-large"> {{ $user->welcome_balance }} <small>SCB</small></span>
                          <hr>
                          @endif
                          @if($user->is_employee==true)
                            <b>Employee Balance</b>
                            <br>
                            <span class="w3-large"> {{ $user->employee_balance }} <small>SCB</small></span>
                            <hr>
                          @endif
                          <a href="{{ route('user.userBalance') }}"> <b> {{__('mysoftcom.deposite_balance')}} </b> <i class="far fa-clipboard"></i></a>
                          <br>
                          <a href="{{ route('user.userBalance') }}"> <span class="w3-large"> <small>Link</small></span></a>
                          <hr>
                           <b>{{__('mysoftcom.pf_balance')}}</b>
                          <br>
                          <span class="w3-large"> {{ $totalPfbalance }} <small>SCB</small></span>
                          @if($profile_count>=1)
                          <hr>
                            <b>{{__('mysoftcom.advertise_balance')}}</b>
                          <br>
                          <span class="w3-large"> {{ $user->ad_balance }} <small>SCB</small></span>
                          @endif
                          <hr>
                            <b>{{__('mysoftcom.due_balance')}}</b> 
                          <br>
                          <span class="w3-large"> {{ $user->due_balance }} <small>SCB</small></span>
                            @if(Auth::user()->due_balance > 0)
                             <a href="{{route('user.userpaydue')}}" class="w3-btn  w3-red btn btn-xs"> Pay Now</a>
                            @endif
                          <hr>
                            <a href="{{route('user.userdepositdetails')}}"><b>{{__('mysoftcom.total_deposite')}}</b> <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large">  {{ $totalDeposit }} <small>SCB</small></span>
                          <hr>
                           <a href="{{route('user.userwithdrawdetails')}}"><b>{{__('mysoftcom.total_withdraw')}}</b> <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large">  {{ $totalWithdrow }} <small>SCB</small></span>
                          {{-- <hr>
                            <a href="{{ route('user.myServieProfileOrders') }}"><b> Total Sales</b > <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large"> {{$sales_total}} <small>SCB</small></span>
                          <hr>
                           <a href="{{ route('user.myOrders') }}"><b>Total Purchase</b> <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large">{{$purchase_total}}<small>SCB</small> </span> --}}

                        </div>
                      </div>
                    {{-- <a href="{{ route('user.userBalance') }}">
                        <div class="info-box">
                            <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-wallet"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Soft Wallet Balance </span>
                                <span class="info-box-number">
                                    {{ $user->totalBalance() }}
                                    <small>TK</small>
                                </span>
                            </div>
                        </div>
                    </a> --}}
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card card-widget">
                       
                        <div class="card-header">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"></span>
                                    <span class="info-box-number">
                                       {{__('mysoftcom.dashboard')}}
                                    </span>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                             <a href="{{ route('user.postPaidOrFullPaidDashboard', ['type' => 'full_paid'])}}"><b>{{__('mysoftcom.paid_pf')}}</b> <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large"> {{ $prepaid }}</span>
                          <hr>
                            <a href="{{ route('user.postPaidOrFullPaidDashboard', ['type' => 'post_paid'])}}"><b>{{__('mysoftcom.unpaid_pf')}}</b> <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large">  {{ $postpaid }}</span>
                          @if($profile_count>=1)
                          <hr>
                            <a href="{{ route('user.userpublishservice') }}"> <b> {{__('mysoftcom.publish_shop')}}</b><i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large"> {{ $paidshop??0 }} </span>
                          <hr>
                           <a href="{{ route('user.userunpublishservice') }}"><b>  {{__('mysoftcom.unpublish_shop')}}</b> <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large">{{ $unpaidshop??0 }}</span>
                          @endif
                          <hr>
                           <b>{{__('mysoftcom.paid_introducer')}}</b>
                          <br>
                          <span class="w3-large"> {{ $prepaid_reffer??0 }} </span>
                          <hr>
                          <b>{{__('mysoftcom.unpaid_introducer')}}</b>
                          <br>
                          <span class="w3-large">{{ $postpaid_reffer??0 }}</span>
                         
                          

                        </div>
                      </div>
                    {{-- <a href="{{ route('user.softcommerce') }}">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wrench"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Service Provide </span>
                                <span class="info-box-number">
                                    {{ $user->balanceTransactions()->where('purpose', 'job_post')->sum('moved_balance') }}
                                    <small>TK</small>
                                </span>
                            </div>
                        </div>
                    </a> --}}
                </div>

                
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card card-widget">
                       
                        <div class="card-header">
                            <div class="info-box">
                                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-wrench"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"></span>
                                    <span class="info-box-number">
                                     {{__('mysoftcom.settings')}}
                                    </span>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('user.myProfile') }}"> <b>{{__('mysoftcom.profile')}}</b> <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large"> <small>Link</small></span>
                          <hr>
                          <a href="{{ route('user.userPasswordChange') }}"> <b>{{__('mysoftcom.password_change')}} </b> <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large"> <small>Link</small></span>
                          <hr>
                            <a href="{{ route('user.userPinChange') }}"> <b>{{__('mysoftcom.pin_change')}}</b> <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large"><small>Link</small></span>
                          <hr>
                          {{-- <a href="{{ route('user.myServicesDashboard') }}"><b>Business Profile</b>  <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large"> {{ count($biz_profiles) }}</span>
                          <hr> --}}
                          <a class="btn btn-app"
                                    onclick="return confirm('Are you sure? You want to create unpaid account in all category?');"
                                    title="Create unpaid account in all categories" data-toggle="tooltip"
                                    href="{{ route('user.createPostpaidAccountInAllCat') }}">
                                    <span
                                        class="badge bg-danger">{{ \App\Models\Category::where('active', 1)->count() }}</span>
                                    <i class="fas fa-plus-square"></i> Create All Service Profile
                                </a>
                          <br>
                          

                        </div>
                      </div>
                    {{-- <a href="{{ route('user.myProfile') }}">
                        <div class="info-box">
                            <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Personal Profile</span>
                                <span class="info-box-number">
                                    link
                                   
                                </span>
                            </div>
                        </div>
                    </a> --}}
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card card-widget">
                       
                        <div class="card-header">
                            <div class="info-box">
                                <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-handshake"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"></span>
                                    <span class="info-box-number">
                                    {{__('mysoftcom.orders')}}
                                    </span>
                                    
                      
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        @if($profile_count>=1)
                  
                          <a href="{{ route('user.myServieProfileProducts') }}"> <b>{{__('mysoftcom.my_service/product')}}</b> <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large"> <small>Link</small></span>
                          <hr>
                           <a href="{{route('user.orderpendingbalancedetails')}}"><b>{{__('mysoftcom.order_pending_balance')}}</b> <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large">  {{ $pending_balance }} <small>SCB</small></span>
                          <hr>
                           <a href="{{ route('user.myServieProfileOrders') }}"> <b>{{__('mysoftcom.sales_product/service')}}</b> <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large">{{$sales_count}} - {{$sales_total}} SCB</span>
                          <hr>
                        @endif
                          
                            <a href="{{ route('user.myOrders') }}"> <b>{{__('mysoftcom.purchase_product/service')}}</b> <i class="far fa-clipboard"></i></a>
                          <br>
                          <span class="w3-large">{{$purchase_count}} - {{$purchase_total}} SCB</span>
                          
                          

                        </div>
                      </div>

                        {{-- <a href="{{ route('user.myServicesDashboard') }}">
                        <div class="info-box">
                            <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-briefcase"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Business Profiles</span>
                                <span class="info-box-number">
                                    {{ count($biz_profiles) }}
                                   
                                </span>
                            </div>
                        </div>
                    </a> --}}
                </div>
                {{-- <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('user.postPaidOrFullPaidDashboard', ['type' => 'post_paid'])}}">
                        <div class="info-box">
                            <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-mail-bulk"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Postpaid PF</span>
                                <span class="info-box-number">
                                    {{ $postpaid }}
                                   
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('user.postPaidOrFullPaidDashboard', ['type' => 'full_paid'])}}">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-hand-holding-usd"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Paid PF</span>
                                <span class="info-box-number">
                                    {{ $prepaid }}
                                  
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                   
                        <div class="info-box">
                            <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-lira-sign"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total PF-Balance</span>
                                <span class="info-box-number">
                                    {{ $totalPfbalance }}
                                    <small>TK</small>
                                </span>
                            </div>
                        </div>
                  
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-user-friends"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Pospaid Refer</span>
                                <span class="info-box-number">
                                    {{ $postpaid_reffer??0 }}
                                    
                                </span>
                            </div>
                        </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-handshake"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Introduced</span>
                                <span class="info-box-number">
                                    {{ $prepaid_reffer??0 }}
                                </span>
                            </div>
                        </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('user.userSettings') }}">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Settings</span>
                                <span class="info-box-number">
                                    Link
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-chart-line"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Withdraw</span>
                                <span class="info-box-number">
                                    ({{ $totalWithdrow }})
                                    <span>TK</span>
                                </span>
                            </div>
                        </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-donate"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Deposit</span>
                                <span class="info-box-number">
                                    ({{ $totalDeposit }})
                                    <span>TK</span>
                                </span>
                            </div>
                        </div>
                </div>
             
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('user.postPaidOrFullPaidDashboard', ['type' => 'full_paid']) }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-box"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Standard Dashboards</span>
                        </div>
                    </div>
                  </a>
                 </div>

                 <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('user.postPaidOrFullPaidDashboard', ['type' => 'post_paid']) }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-hard-hat"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Postpaid Dashboards</span>
                        </div>
                    </div>
                  </a>
                 </div>
                 <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('user.allSubscribersStation') }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-luggage-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Service Stations</span>
                        </div>
                    </div>
                  </a>
                 </div>

                 <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('user.myOrders') }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-boxes"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">My Orders</span>
                        </div>
                    </div>
                  </a>
                 </div>
                 <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('user.myServieProfileOrders') }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-dolly"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Get Orders</span>
                        </div>
                    </div>
                  </a>
                 </div>
                 <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('user.myServieProfileProducts') }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-warehouse"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">My Services & Products</span>
                        </div>
                    </div>
                  </a>
                 </div> --}}

     {{-- ss --}}



            </div>
        </div>
    </section>
@endsection


@push('js')

    <script>
        function subscribeId(actionUrl) {
            $("#subscribeForm").attr("action", actionUrl);
        }
        $(document).ready(function() {
            $('select').change(function() {
                if ($(this).val() === "new")
                    $('.hideme').show();
                else
                    $('.hideme').hide();
            }).change();
        });
    </script>

@endpush
