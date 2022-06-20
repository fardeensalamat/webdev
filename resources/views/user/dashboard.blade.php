@extends('user.layouts.userMaster')
@push('css')

    <style>
        .Mydashbord {
            width: 100%;
        }

        .display img{
                width: 120px !important;
            }

        select {
            text-transform: none;
            padding: 5px;
            border-radius: 9%;
            border: 2px solid #007bff;
        }

        .click-button-saif {
            border-radius: 88%;
            padding: 10px 15px;
            border: 1px solid #ff5722;
            background-color: #ff5722;
        }

        .demo-saif {
            margin-left: 73px;
            margin-top: -27px;
            /* background: white; */
            padding: 3px 5px;
        }

        .textcontent1-saif {
            position: absolute;
            left: 35%;
            top: 28%;
            color: white;
        }

        .fa-universal-access:before {
            content: "\f29a";
            font-size: 35px;
            color: white
        }

        .fa-heart:before {
            content: "\f004";
            font-size: 35px;
            color: white
        }

        .fa-cart-arrow-down:before {
            content: "\f218";
            font-size: 35px;
            color: white
        }

        .textscontent-saif {

            width: 200px;
            height: 200px;
            background-color: #009688;
            border-radius: 70%;
            margin: 0px auto;
        }

        @media only screen and (max-width: 580px) {

            .logoText {
                font-size: 35px !important;
                /*text-align: right !important; */
                margin-top: 8px !important;
            }
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

            .textscontent-saif {
                width: 120px;
                height: 120px;
                background-color: #009688;
                border-radius: 70%;
                margin: 0px auto;
            }

            .textcontent1-saif {
                position: absolute;
                left: 28%;
                top: 28%;
                color: white;
            }

            .textcontent .fa-heart {
                margin-left: 10px;
            }


        }
        @media only screen and (max-width: 472px) {
            .logoText {
                font-size: 35px !important;
                /*text-align: right !important; */
                margin-top: 8px !important;
            }

            /*.display{*/
            /*    display:flex;*/
            /*    justify-content:between;*/
            /*}*/
        }


        @media only screen and (max-width: 376px) {
            .textscontent-saif {
                width: 100px;
                height: 100px;
                background-color: #009688;
                border-radius: 70%;
                margin: 0px auto;
            }
            .logoText {
                font-size: 30px !important;
                margin-top: 5px !important
            }

            .textcontent1-saif {
                position: absolute;
                left: 28%;
                top: 28%;
                color: white;
            }

            .fa-universal-access:before {
                content: "\f29a";
                font-size: 18px;
                color: white
            }

            .fa-heart:before {
                content: "\f004";
                font-size: 18px;
                color: white
            }

            .fa-cart-arrow-down:before {
                content: "\f218";
                font-size: 18px;
                color: white
            }

            .textscontent-saif h3 {
                font-size: 15px;
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
            <!-- /.row -->
            @include('alerts.alerts')
            <div class="row display">
                <div class="col-4">
                    <a class="py-0" href="/">
                        <img class="img-fluid" alt="{{ env('APP_NAME_BIG') }}" height="100" data-sticky-height="55"
                            data-sticky-top="100" src="{{ asset('storage/logo/' . $websiteParameter->logo_alt) }}">
                    </a>
                </div>
                <div class="col-5">
                    <h1 class="mt-4 logoText"
                        style="font-size: 40px; font-weight: bolder; margin-bottom:5px; text-align:center">{{__('userdashboard.soft_commerce_ltd')}}</h1>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-1">

                            <div class="row ">
                                <div class="col-9 col-xs-10 col-sm-10 col-md-10">
                                    <div class="card-tools">
                                        <form action="" class="ml-2 mt-2 mb-2">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" placeholder="{{__('userdashboard.placeholder')}}">
                                                    </div>
                                                    <div id="product_list"></div>
                                                </div>
                                                <div class="col-lg-3"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $('#name').on('keyup',function () {
                                            var query = $(this).val();
                                            $.ajax({
                                                url:'{{ route('search') }}',
                                                type:'GET',
                                                data:{'name':query},
                                                success:function (data) {
                                                    $('#product_list').html(data);
                                                }
                                            })
                                        });
                                        $(document).on('click', 'li', function(){
                                              
                                                var value = $(this).text();
                                                $('#name').val(value);
                                                $('#product_list').html("");
                                        });
                                    });
                                </script>   
                                <div class="col-2 col-xs-2 col-sm-2 col-md-2">
                                    <div class="card-tools mt-2">
                                     
                                            <!-- Left navbar links -->
                                            <ul class="navbar-nav">
                                                <li class="nav-item">
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
                                                </li>
                                            </ul>
                                       
    
                                    </div>
                                    <!-- /.card-tools -->


                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- /.card -->
                </div>

            </div>

            <div class="extra">
                <div id="accordion">
                    <p class="mb-3">
                        <a href="{{ route('user.whatDoYouWant') }}" class="btn btn-default w3-deep-orange">{{__('userdashboard.what_do_you_want')}}</a>
                        <a href="{{ route('welcome.ModelShopList') }}" class="btn btn-default w3-deep-orange">{{__('userdashboard.model_shop')}}</a>
                        @if($profilecount>0)
                            <a href="{{ route('user.SoftcomJobCandidateApprovedList') }}" class="btn btn-default w3-deep-orange">{{__('userdashboard.hire_worker')}}</a>
                        @endif
                        <a href="" class="btn btn-default w3-deep-orange" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">{{__('userdashboard.freelancing')}}</a>

                        <button class="btn w3-deep-orange w3-circle" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="true" aria-controls="collapseTwo"> <i class="fas fa-plus"></i>
                        </button>
                        
                        
                    </p>

                    <div id="collapseOne" class="collapse" aria-labelledby="collapseOne" data-parent="#accordion">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if ($subscriber)
                                        <a class="btn btn-app w3-green w3-round-large" title="Special Work"
                                                data-toggle="tooltip"
                                                href="{{ route('subscriber.subscriptionSpecialPostJob', $subscriber->subscription_code ?? '') }}">
                                                {{-- <span class="badge bg-danger"></span> --}}
                                                <i class="fas fa-play w3-text-white"></i>{{__('userdashboard.special_work')}}
                                            </a>
                                            <a class="btn btn-app w3-deep-orange w3-round-large" title="Find Work"
                                                data-toggle="tooltip"
                                                href="{{ route('subscriber.subscriptionFindJob', $subscriber->subscription_code ?? '') }}">
                                                {{-- <span class="badge bg-danger"></span> --}}
                                                <i class="fas fa-search w3-text-white"></i>{{__('userdashboard.find_work')}}
                                            </a>

                                            <a class="btn btn-app w3-green w3-round-large" title="Post Work"
                                                data-toggle="tooltip"
                                                href="{{ route('subscriber.subscriptionPostJob', $subscriber->subscription_code ?? '') }}">
                                                {{-- <span class="badge bg-danger"></span> --}}
                                                <i class="fas fa-plus-square w3-text-white"></i>{{__('userdashboard.post_work')}}
                                            </a>

                                            <a class="btn btn-app w3-teal w3-round-large" title="Posted Works"
                                                data-toggle="tooltip"
                                                href="{{ route('subscriber.subscriptionPostedJob', $subscriber->subscription_code ?? '') }}">
                                                {{-- <span class="badge bg-danger"></span> --}}
                                                <i class="fas fa-tasks w3-text-white"></i>{{__('userdashboard.posted_works')}}
                                            </a>
                                            <a class="btn btn-app w3-teal w3-round-large" title="Freelanching Dashboard"
                                            data-toggle="tooltip" href="{{ route('user.softcodeFreelanching') }}">
                                            {{-- <span class="badge bg-danger"></span> --}}
                                            <i class="fas fa-tachometer-alt"></i> {{__('userdashboard.dashboard')}}
                                        </a>
                                            <a class="btn btn-app w3-teal w3-round-large" title="My Works"
                                                data-toggle="tooltip"
                                                href="{{ route('subscriber.subscriptionMyJobWork', $subscriber->subscription_code) }}">
                                                {{-- <span class="badge bg-danger"></span> --}}
                                                <i class="fas fa-tasks w3-text-white"></i> {{__('userdashboard.my_works')}}
                                            </a>
                                            @if(Auth::user()->is_employee==true)
                                            <a class="btn btn-app w3-teal w3-round-large" title="Soft Commerce Works"
                                                data-toggle="tooltip"
                                                href="{{route('subscriber.subscriptionFindJobsoftcommerce',$subscriber->subscription_code)}}">
                                                {{-- <span class="badge bg-danger"></span> --}}
                                                <i class="fas fa-folder-plus w3-text-white"></i> Soft Commerce
                                            </a>
                                            @endif
                                            @if(Auth::user()->is_freelancer==true)
                                            <a class="btn btn-app w3-teal w3-round-large" title="Varified Freelancer Work"
                                                data-toggle="tooltip"
                                                href="{{route('subscriber.subscriptionFindJobsoftcommerceFreelancer',$subscriber->subscription_code)}}">
                                                {{-- <span class="badge bg-danger"></span> --}}
                                                <i class="fas fa-folder-plus w3-text-white"></i> Varified Freelancer
                                            </a>
                                            @endif

                                            @if(Auth::user()->is_vendor==true)
                                            <a class="btn btn-app w3-teal w3-round-large" title="Vendor Work"
                                                data-toggle="tooltip"
                                                href="{{route('subscriber.subscriptionFindJobsoftcommerceVendor',$subscriber->subscription_code)}}">
                                                {{-- <span class="badge bg-danger"></span> --}}
                                                <i class="fas fa-folder-plus w3-text-white"></i>Vendor Work
                                            </a>
                                            @endif
                                        @else
                                            <div class="card card-widget">
                                                <div class="card-body">
                                                    You need to subscribe, then you will get access.
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="collapseTwo" data-parent="#accordion">
                        <div class="card">
                            <div class="card-body">
                                <a class="btn btn-app"
                                    onclick="return confirm('are you sure? you want to create Postpaid Account in all Category?');"
                                    title="Create Postpaid Account in All Categories" data-toggle="tooltip"
                                    href="{{ route('user.createPostpaidAccountInAllCat') }}">
                                    <span
                                        class="badge bg-danger">{{ \App\Models\Category::where('active', 1)->count() }}</span>
                                    <i class="fas fa-plus-square"></i> {{__('userdashboard.create_all')}}
                                </a>
                                <a class="btn btn-app" href="{{ route('user.allOpinions') }}"> <i
                                        class="fas fa-bullhorn"></i> {{__('userdashboard.opinions')}}</a>
                                <a class="btn btn-app" href=""> <i class="fas fa-cogs"></i> {{__('userdashboard.set_interest')}}</a>
                                @if (Auth::user()->referral)
                                    <a class="btn btn-app" href="{{ route('user.reffer') }}"> <i
                                            class="fas fa-user-plus"></i> {{__('userdashboard.reffer_sales_history')}}</a>
                                @endif
                                <a class="btn btn-app" href="{{ route('user.suggesions') }}"> <i
                                    class="fas fa-bullhorn"></i> {{__('userdashboard.complains')}}</a>
                                <a class="btn btn-app" href="{{ route('subscriber.WishlistServiceProfileProduct') }}"> <i
                                    class="fas fa-igloo"></i> {{__('userdashboard.wishlist')}}</a>
                                <a class="btn btn-app" href="{{ route('user.favourite') }}"> <i
                                    class="fas fa-snowflake"></i> {{__('userdashboard.favourite')}}</a>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div id="accordion">

                </div>
                <div class="col-12">
                    <p>
                        <a class="btn btn-default w3-deep-orange" href="">
                            What do you want?...
                        </a>
                        <a class="btn btn-default w3-deep-orange" data-toggle="collapse" href="#freelanchingExample-mas"
                            role="button" aria-expanded="true" data-accordion="true"
                            aria-controls="freelanchingExample-mas">Freelancing</a>

                        <a class="btn w3-deep-orange w3-circle" data-toggle="collapse" href="#collapseExample-mas"
                            role="button" aria-expanded="true" data-accordion="true" aria-controls="collapseExample-mas"><i
                                class="fas fa-plus"></i></a>


                    </p>
                    <div class="collapse" id="freelanchingExample-mas">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if ($subscriber)
                                            <a class="btn btn-app w3-deep-orange w3-round-large" title="Find a job"
                                                data-toggle="tooltip"
                                                href="{{ route('subscriber.subscriptionFindJob', $subscriber->subscription_code) }}">
                                                <i class="fas fa-search w3-text-white"></i> Find a Job
                                            </a>

                                            <a class="btn btn-app w3-green w3-round-large" title="Post a Job"
                                                data-toggle="tooltip"
                                                href="{{ route('subscriber.subscriptionPostJob', $subscriber->subscription_code) }}">
                                                <i class="fas fa-plus-square w3-text-white"></i> Post a Job
                                            </a>

                                            <a class="btn btn-app w3-teal w3-round-large" title="My Posted Jobs"
                                                data-toggle="tooltip"
                                                href="{{ route('subscriber.subscriptionPostedJob', $subscriber->subscription_code) }}">
                                                <i class="fas fa-tasks w3-text-white"></i> Posted Jobs
                                            </a>

                                            <a class="btn btn-app w3-teal w3-round-large" title="My Job-Works"
                                                data-toggle="tooltip"
                                                href="{{ route('subscriber.subscriptionMyJobWork', $subscriber->subscription_code) }}">
                                                <i class="fas fa-tasks w3-text-white"></i> My Works
                                            </a>
                                        @else
                                            <div class="card card-widget">
                                                <div class="card-body">
                                                    You need to subscribe, then you will get access.
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="collapse" id="collapseExample-mas">
                        <div class="card">
                            <div class="card-body">
                                <a class="btn btn-app" title="Create Postpaid Account in All Categories"
                                    data-toggle="tooltip" href="{{ route('user.createPostpaidAccountInAllCat') }}">
                                    <span
                                        class="badge bg-danger">{{ \App\Models\Category::where('active', 1)->count() }}</span>
                                    <i class="fas fa-plus-square"></i> Create All..
                                </a>
                                <a class="btn btn-app" href="{{ route('user.allOpinions') }}"> <i
                                        class="fas fa-bullhorn"></i> Opininons</a>

                                <a class="btn btn-app" href=""> <i class="fas fa-cogs"></i> Set Interest</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
        <div class="row my-3">
            <div class="col-4 col-xs-4 col-sm-4 col-md-4">
                <a class="text-white" href="{{ route('user.serviceProducts') }}">
                    <div class="card text-center w3-teal  w3-hover-shadow py-3">
                        <div class="card-body custom-design">
                            <i class="fas fa-shopping-cart" aria-hidden="true" style="font-size:24px;"></i>
                            <h3>{{__('userdashboard.products')}}</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-md-offset-1">
                <a class="text-white" href="{{ route('user.userService') }}">
                    <div class="card text-center w3-teal  w3-hover-shadow py-3">
                        <div class="card-body custom-design">
                            <i class="fas fa-people-carry" aria-hidden="true" style="font-size:24px;"></i>
                            <h3>{{__('userdashboard.services')}}</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 col-xs-4 col-sm-4 col-md-4">
                <a class="text-white" href="{{ route('user.softmarket') }}">
                    <div class="card text-center w3-teal  w3-hover-shadow py-3">
                        <div class="card-body custom-design">
                            <i class="fas fa-bullseye" aria-hidden="true" style="font-size:24px;"></i>
                            <h3>{{__('userdashboard.soft_market')}}</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-4 col-xs-6 col-sm-4 col-md-4">
                <a class="text-white" href="{{ route('user.softcommerce') }}">
                    <div class="card text-center bg-warning  w3-hover-shadow py-3">
                        <div class="card-body custom-design">
                            <i class="fas fa-funnel-dollar" aria-hidden="true" style="font-size:24px;"></i>
                            <h3>{{__('userdashboard.my_soft_commerce')}}</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 col-xs-6 col-sm-4 col-md-4">
                <a class="" href="{{ route('user.connectingfriends') }}">
                    <div class="card text-center bg-warning  w3-hover-shadow py-3">
                        <div class="card-body custom-design">
                            <i class="fa fa-plug" aria-hidden="true" style="font-size:24px;"></i>
                            <h3>{{__('userdashboard.connecting_friends')}}</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 col-xs-6 col-sm-4 col-md-4">
                <a class="" href="{{route('user.Courseitem')}}">
                    <div class="card text-center bg-warning  w3-hover-shadow py-3">
                        <div class="card-body custom-design">
                            <i class="fas fa-podcast" aria-hidden="true" style="font-size:24px;"></i>
                            <h3>{{__('userdashboard.course')}}</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-4 col-xs-4 col-sm-4 col-md-4">
                <a class="text-white" href="{{ route('user.SoftcomJobApplyList') }}">
                    <div class="card text-center w3-purple  w3-hover-shadow py-3">
                        <div class="card-body custom-design">
                            <i class="fa fa-briefcase" aria-hidden="true" style="font-size:24px;"></i>
                            <h3>{{__('userdashboard.apply')}}</h3>
                           
                        </div>
                    </div>
                </a>
            </div>
            @if($speciallink)
            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-md-offset-1">
                <a class="text-white" href="{{$speciallink->link}}">
                    <div class="card text-center w3-purple  w3-hover-shadow py-3">
                        <div class="card-body custom-design">
                            <i class="fas fa-bullhorn" aria-hidden="true" style="font-size:24px;"></i>
                            <h3>{{$speciallink->title ?? ''}}</h3>
                        </div>
                    </div>
                </a>
            </div>
            @endif
            <div class="col-4 col-xs-4 col-sm-4 col-md-4">
                <a class="text-white" href="{{ route('subscriber.cartsServiceProfileProduct') }}">
                    <div class="card text-center w3-purple  w3-hover-shadow py-3">
                        <div class="card-body custom-design">
                            <i class="fa fa-shopping-cart"  aria-hidden="true" style="font-size:24px;"></i>
                            <h3>{{__('userdashboard.carts')}}</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- <div class="row my-3">
            <div class="col-4 col-xs-6 col-sm-4 col-md-4">
                <a class="" href="{{ route('user.purchase') }}">
                    <div class="textscontent-saif">
                        <div class="textcontent1-saif" style="margin-left: 9%;">
                          <i class="fa fa-universal-access" aria-hidden="true"></i>
                            <h5 style="margin-right: 5%;">Purchase</h5>
                        </div>
                    </div>
                </a>
            </div>
            @if($speciallink)
            <div class="col-4 col-xs-6 col-sm-6 col-md-4">
                <a class="" href="{{$speciallink->link}}">
                    <div class="textscontent-saif">
                        <div class="textcontent1-saif" style="margin-left: 9%;">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                            <h5 style="margin-right: 5%;">{{$speciallink->title ?? ''}}</h5>
                        </div>
                        
                    </div>
                </a>
            </div>
            @endif
 
            <div class="col-4 col-xs-6 col-sm-6 col-md-4">
                <a class="text-white" href="{{ route('subscriber.cartsServiceProfileProduct') }}">
                    <div class="textscontent-saif">
                        <div class="textcontent1-saif" style="margin-left: 9%;">
                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                            <h5 style="margin-right: 5%;">Carts</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div> --}}
        <!-- Info boxes -->
        {{-- <div class="row">
            @if (isset($websiteParameter->notice_one))
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        {!! $websiteParameter->notice_one !!}
                    </div>
                </div>
            @endif

      

          
            <div class="clearfix hidden-md-up"></div>
            @if (isset($websiteParameter->notice_two))
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        {!! $websiteParameter->notice_two !!}


                      
                    </div>
                 
                </div>
            @endif
          
            @if (isset($websiteParameter->notice_three))

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">

                        {!! $websiteParameter->notice_three !!}


                        
                    </div>
                  
                </div>
            @endif
         

        </div> --}}
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="card card-outline mb-2">
                    <div class="card-header w3-deep-orange p-1">
                        <h4 class="card-title w-100">
                            <marquee class="w3-text-white" width="100%" direction="left">
                                {{ $websiteParameter->user_page_msg }}
                            </marquee>
                        </h4>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <a href="http://softcodeltd.com/" class="">
            <div class="card m-0 p-0">
                <div class="card-body w3-teal ">
                    <h4 class="card-title">Go to SoftCode</h4>
                </div>
            </div>
        </a> --}}
        {{-- <a href="http://softcodeltd.com/" class="btn btn-block  w3-green">
            <h4>Go to SoftCode</h4>
        </a> --}}
          <!-- ----------------------------------------------------------------------------------------------------->
{{--         
          <div class="card">
            <div class="py-2 w3-deep-orange ">
                <h4 class="card-title ml-3">Valued Customer</h4>
            </div>
        </div>

    <div class="row my-3">
        @foreach ($customerList as $key=>$data)
            <div class="col-4 col-xs-4 col-sm-4 col-md-3 bg-white w3-hover-shadow my-2">
            <img class="col-md-8 rounded mx-auto d-block" src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $data->vc()]) }}">
                <a class="text-white" href="{{ $data->link}}">
                    <div class="text-center w3-teal  w3-hover-shadow">
                        <div class="custom-design">  
                            <h3>{{ $data->name}}</h3>
                        </div>
                    </div>
                </a>
            </div>
   
        @endforeach
   
        </div>
       --}}
       @if($profilecount>0)
            <div class="card">
                <div class="py-2 w3-deep-orange ">
                    <h4 class="card-title ml-3">My Shop</h4>
                </div>
            </div>
            <div class="row my-3">
                @foreach ($myprofile  as $key=>$profiles)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="bg-white shadow rounded overflow-hidden">
                                <div class="px-4 pt-0 pb-4 cover"
                                    style="background-image: url({{ route('imagecache', ['template' => 'cplg', 'filename' => $profiles->ci()]) }}); background-size: cover; background-repeat: no-repeat;background-position: center center;">
                                    <div class="media align-items-end profile-head" style=" transform: translateY(5rem);">
                                        <div class="profile mr-3">
                                        @if($profiles->website_link)
                                                <a href="{{$profiles->website_link}}" target="_blank">
                
                                                    <img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profiles->fi()]) }}"
                                                        width="130" class="rounded mb-2 img-thumbnail" @if ($profiles->category->business_type == 'service')
                                                    style="border-radius: 50% !important"
                                                @endif>
                                                </a>
                                                
                                            <a href="{{$profiles->website_link}}"
                                                class="btn w3-purple btn-sm btn-block" target="_blank">{{ custom_title(ucfirst($profiles->name), 15) }}</a>
                                            @else
                                                <a href="{{ route('welcome.profileShare', ['profile' => $profiles->id, 'reffer' => $subscriber->subscription_code]) }}">
                
                                                    <img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profiles->fi()]) }}"
                                                        width="130" class="rounded mb-2 img-thumbnail" @if ($profiles->category->business_type == 'service')
                                                    style="border-radius: 50% !important"
                                                @endif>
                                            </a>
                                            
                                            <a href="{{ route('welcome.profileShare', ['profile' => $profiles->id, 'reffer' => $subscriber->subscription_code]) }}"
                                                class="btn w3-purple btn-sm btn-block">{{ custom_title(ucfirst($profiles->name), 15) }}</a>
                
                                            @endif
                                        
                
                                            </div>
                
                                            </div>
                                            </div>
                
                                            <div class="bg-light p-2 d-flex justify-content-end text-center">
                                                <ul class="list-inline mb-0">
                                                    @if($profiles->website_link)
                                                    <br><br><br>
                                                        
                                                    @else
                                                    @if ($profiles->category->business_type == 'service')
                                                            <li class="list-inline-item">
                                                                <h5 class="font-weight-bold mb-0 d-block">
                                                                    {{ $profiles->totalServiceItems() }}
                                                                </h5>
                                                                <small class="text-muted"> <i class="fas fa-image mr-1"></i>Item</small>
                                                            </li>
                                                            @else
                                                            <li class="list-inline-item">
                                                                <h5 class="font-weight-bold mb-0 d-block">
                                                                    {{ count($profiles->products->where('status', 'approved')->where('active', true)) }}
                                                                </h5>
                                                                <small class="text-muted"> <i class="fas fa-image mr-1"></i>Products</small>
                                                            </li>
                                                        @endif
                                                
                                                    
                
                                                    @endif
                                                    
                                                    
                
                                                </ul>
                                            </div>
                                            <div class="bg-light px-3">
                                                <ul class="list-inline mb-0">
                                                    <li title="Add To Favourite" class="list-inline-item">
                                                        <a class="addTofavourite"
                                                            href="{{ route('user.addTofavourite', ['typeid' => $profiles->id, 'type' => 'service_profile']) }}">
                                                            <h5 class="font-weight-bold mb-0 d-block">
                                                                @if ($profiles->isMyFavourite())
                                                                    <i class="fas fa-save w3-text-red"></i>
                                                                @else
                                                                    <i class="fas fa-save w3-text-gray color"></i>
                                                                @endif
                                                            </h5>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        @if ($profiles->open)
                                                            <span title="Shop/Service Open" class="text-success p-2"><i class="fas fa-check rounded-circle"></i>
                                                                Open</span>
                                                        @else
                                                            <span title="Shop/Service Closed" class="text-danger p-2"><i class="fas fa-times"></i>
                                                                Closed</span>
                                                        @endif
                                                    </li>
                                                    <li class="list-inline-item">
                                                        {{-- {{ $cat->package_status }} --}}
                                                        {{-- @if ($cat->package_status == 'regular')
                                                            <span class=""><img title="Regular" src="{{ asset('img/badge/regular.png') }}"
                                                                    width="30px" alt="" srcset=""></span>
                                                        @elseif ($cat->package_status == 'golden')
                                                            <span class=""><img title="Golden" src="{{ asset('img/badge/golden.png') }}"
                                                                    width="30px" alt="" srcset=""></span>
                                                        @elseif ($cat->package_status == 'merchant')
                                                            <span class=""><img title="Merchant" src="{{ asset('img/badge/merchant.png') }}"
                                                                    width="30px" alt="" srcset=""></span>
                                                        @else
                                                            <span class=""><img title="Free" src="{{ asset('img/badge/free.png') }}" width="30px"
                                                                    alt="" srcset=""></span>
                                                        @endif --}}
                                                        @if ($profiles->paystatus == true)
                                                            <span class=""><img title="Paid" src="{{ asset('img/badge/paid.png') }}"
                                                                width="30px" alt="" srcset=""></span>
                
                                                        @else
                                                            <span class=""><img title="Trial" src="{{ asset('img/badge/free.png') }}"
                                                                width="30px" alt="" srcset=""></span>
                
                
                                                        @endif
                
                                                    </li>
                
                                                </ul>
                                            </div>
                                            <div class="px-4 py-3">
                                                <p class="small mb-0"> <strong>Location:
                                                    </strong>{{ $profiles->address }}
                                                </p>
                
                                                {{-- <p class="small mb-4 mt-0"> <strong>Cat:
                                                    </strong>{{ $cat->category->name }}</p> --}}
                                                @if ($profiles->distance)
                                                    <p class="small mb-4 mt-0"> <strong>Distance:
                                                        </strong>{{ number_format($profiles->distance, 3, '.', '') }} KM</p>
                                                @endif
                                            </div>
                
                            </div>
                        </div>
                    </div>
            

                @endforeach
            </div>
        @endif

        <div class="card">
            <div class="py-2 w3-deep-orange ">
                <h4 class="card-title ml-3">{{__('userdashboard.top_priority')}}</h4>
            </div>
        </div>
        <div class="row my-3">
            @foreach ($priorityList  as $key=>$data)
                <div class="col-4 col-xs-4 col-sm-4 col-md-3 bg-white w3-hover-shadow my-2">
                <img class="col-md-8 rounded mx-auto d-block" src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $data->tp()]) }}">
                    <a class="text-white" href="{{ $data->link}}">
                        <div class="text-center w3-teal  w3-hover-shadow">
                            <div class="custom-design">  
                                <h3>{{ $data->name}}</h3>
                            </div>
                        </div>
                    </a>
                </div>
    
            @endforeach
        </div>

        {{-- <div class="card">
            <div class="py-2 w3-deep-orange ">
                <h4 class="card-title ml-3">Our Partners</h4>
            </div>
        </div>
        <div class="row my-3">
            @foreach ($partners as $key=>$data)
                <div class="col-4 col-xs-4 col-sm-4 col-md-3 bg-white w3-hover-shadow my-2">
                <img class="col-md-8 rounded mx-auto d-block" src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $data->vc()]) }}" width="350" height="100" alt="Image not available" >
                
                    <a class="text-white" href="{{ $data->link}}">
                        <div class="text-center w3-teal  w3-hover-shadow">
                            <div class="custom-design">  
                                <h3>{{ $data->name}}</h3>
                            </div>
                        </div>
                    </a>
                </div>
    
            @endforeach
   
        </div> --}}

     <!------------------------------------------------------------------->
     <div class="card">
            <div class="py-2 w3-deep-orange ">
                <h4 class="card-title ml-3">{{__('userdashboard.recent_service')}}</h4>
            </div>
        </div>

        {{-- <div class="row">
                    @forelse ($biz_profiles as $profile)
                        <div class="col-sm-6 col-md-4 col-12  mt-3 mb-2 mb-md-0">
                            <!-- Box Comment -->
                            <div class="card card-widget p-0">
                                <div class="card-header ">
                                    <div class="user-block">
                                        <a
                                            href="{{ route('subscriber.findProfileDetails', ['subscription' => $subscriber->subscription_code, 'profile' => $profile]) }}">
                                            <img class=" img-circle"
                                                src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->img_name]) }}"
                                                alt="sans" /></a>
                                        <span class="username text-dark">
                                            <a href="{{ route('subscriber.findProfileDetails', ['subscription' => $subscriber->subscription_code, 'profile' => $profile]) }}">{{ custom_name($profile->name, 20)  }}</a>
                                        </span>
                                        <span class="description ">{{ ucfirst(custom_name($profile->category->name, 12)) }}
                                            ,{{ ucfirst(custom_name($profile->workstation->title, 12)) }} </span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="card-tools">
                                        <button  type="button" class="btn btn-tool" data-toggle="tooltip"
                                            title="Mark as read">
                                            <i class="far fa-circle"></i></button>
                                        <button  type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body ">
                                    <p class="mb-0">{{ ucfirst(custom_name($profile->short_bio, 120)) }}</p>
                                    @if ($profile->freeValues())
                                        @foreach ($profile->freeValues()->where('profile_card_display', true) as $value)
                                            @if ($value->field_type == 'string')
                                                <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}</p>

                                            @elseif($value->field_type == 'text')

                                                <p class="my-0"><b>{{ $value->profile_info_key }}</b>:</p>
                                                {!! $value->profile_info_value !!}

                                            @elseif($value->field_type == 'integer')

                                                <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}</p>

                                            @elseif($value->field_type == 'float')

                                                <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}</p>

                                            @elseif($value->field_type == 'image')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                            alt="sans" width="100" /></div>
                                                </div>
                                                <br>


                                            @elseif($value->field_type == 'doc')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/word.png') }}" alt="msword" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                            download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                    </div>
                                                </div>

                                                <br>

                                            @elseif($value->field_type == 'pdf')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                    </div>

                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <!-- /.card-body -->
                                <!-- /.card-footer -->
                                <div class="card-footer text-center"
                                    style="background-color: #f8f9fa">
                                    <p>© Copyright {{ date('Y') }} | {{ $_SERVER['SERVER_NAME'] }}</p>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                    @empty

                    @endforelse
                </div>
                <div class="col-12">
                    {{ $biz_profiles->render() }}
                </div> --}}

            @if ($shops and Auth::user()->subscriptions()->count())
                <div class="card">
                    <div class="card-body">
                        <div class="row" id="shop-data">
                            @include('user.shopAjax')
                        </div>
                        <div class="ajax-load text-center col-md-12" style="display:none">
                            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="150"
                                viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                <path fill="#007bff"
                                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                    <animateTransform attributeName="transform" attributeType="XML" type="rotate"
                                        dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

            @endif
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')

    <script type="text/javascript">
        var page = 1;
        //For PC / Computer
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                loadMoreData(page);
            }
        });
        //For Mobile / Tuch Device
        $(window).on('touchend', function() {
            if ($(window).scrollTop() + $(window).height() >= window.visualViewport.height) {
                page++;
                loadMoreData(page);

            }
        });

        function loadMoreData(page) {
            $.ajax({
                    url: 'page?page=' + page,
                    type: "get",
                    beforeSend: function() {
                        // $('.hideSho').fadeIn();
                        $('.ajax-load').fadeIn();
                    }
                })
                .done(function(data) {
                    // console.log(data);
                    if (data.html == "") {
                        var notFoundMsg= '<p class="text-danger text-center h4 font-weight-bolder">No more service found</p>'
                       $('.ajax-load').html(notFoundMsg);
                        // alert(a);
                        return;
                    }

                    $('.ajax-load').fadeOut();
                    // $('.hideSho').fadeOut();
                    $("#shop-data").append(data.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    //alert('server not responding...');
                });
        }
    </script>

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

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        // $('.addTofavourite').on('click',function(e){
        //     e.stopImmediatePropagation();
        //     alert('Hello');
        //     var url= $(this).attr('data-url');
        //     alert(url);
        //     $.ajax({
        //        type:'POST',
        //        url:url,
        //        data:{'_token':{{ csrf_token() }}},
        //        success:function(data) {
        //         //    console.log(data);
        //         //   $("#msg").html(data.msg);
        //        }
        //     });
        // });
    </script>

@endpush
