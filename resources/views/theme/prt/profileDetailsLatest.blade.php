@extends('layouts.app_view')

@push('css')

    <style>

        /* Rating Star Widgets Style */

        .nav-pills .nav-link{
            color: #CC6600;
        }

        .nav-pills .nav-link.active{
            background: #ff5722 !important;
        }
        .rating-stars ul {
            list-style-type:none;
            padding:0;

            -moz-user-select:none;
            -webkit-user-select:none;
        }
        .rating-stars ul > li.star {
            display:inline-block;

        }

        /* Idle State of the stars */
        .rating-stars ul > li.star > i.fa {
            font-size:2.5em; /* Change the size of the stars */
            color:#ccc; /* Color on idle state */
        }

        /* Hover state of the stars */
        .rating-stars ul > li.star.hover > i.fa {
            color:#FFCC36 !important;
        }

        /* Selected state of the stars */
        .rating-stars ul > li.star.selected > i.fa {
            color:#FF912C !important;
        }


    </style>


    <style>

        .right-ul-test ul li a{
            text-decoration: none;
            color: #000000;
        }

        #one
        {
            display: flex;
            align-items: flex-end;
            height: 40vh;
            margin: auto;
            margin-top: 1vw;
            background-image: url("{{ route('imagecache', ['template' => 'spci', 'filename' => $profile->ci()]) }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .profile
        {
            padding: 5px;
            margin-left: 1vw;
            background-color: transparent;
            text-align: center;
            /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/
            /* border: 1px solid green; */
            z-index: 1000;
        }

        .profile .media-body{
            float: left;
            color: white;
            margin-top: 23px;
        }

        .profile .media-body:last-child{
            margin-left: 5px;

        }

        .profile .media-body .profile_image_section{
            margin-bottom: -3vw;
        }

        .profile .media-body .profile_image_section h4{
            margin-bottom: -4.5vw;
            margin-top: 23px;
            padding: 4px;
            color: #ffffff;
            background-color: #ff5722!important;
            border-radius: 5px;
            font-weight: 300;
            font-size: 18px;


        }

        .profile .media-body img{
            margin-bottom: -1vw;
        }



        .profile .media-body h4{
            font-weight: 600;
        }

        .profile .media-body p{
            font-weight: 400;
        }

        .text span
        {
            color: grey;
        }

        .product
        {
            margin-bottom: 5vw;
        }

        .product h5
        {
            color: rgb(204, 102,0);
        }
        .text-header
        {
            color: rgb(0, 115, 149);
            margin-left: 1vw;
        }


        .card-text
        {
            color: rgb(0, 115, 149)
        }

        ul
        {
            list-style: none;
        }
        #delivery
        {
            color: red;
            font-size: 15px;
        }
        .btn
        {
            margin-right: 3px;
            margin-bottom: 3px;
        }

        button{
            outline: none !important;

        }

        button:focus, button:active{
            outline: none !important;
            border: none !important;
        }

        /* .nav-link.active{
          background: ;
        } */

        .ratting_post_button{
            background: #ff5722;
            color: #ffffff;
        }

    </style>


@endpush

@section('content')

 <div class="container">

     <div class="card" style="margin-top: 5px;">
         <div class="row" style="padding:10px; margin-top:30px;">
             <div class="col-2">
                 <a href="{{url('/')}}">
                     <img width="40" style="coursor:pointer;" height="40" src="/vueimage/sc.png" alt="">
                 </a>
             </div>
             <div class="col-10">
                 <div class="input-group mb-3">
                     <input type="text" class="search_field_style form-control" placeholder="Search" id="user_name_product" >
                     <div class="input-group-append">
                         <button class="btn btn-success" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                     </div>

                 </div>
                 <div id="product_list_user_singles" style="position: absolute; width: 80%; text-align: center;"></div>

             </div>
         </div>
     </div>


     <script type="text/javascript">
         $(document).ready(function(){
             $('#user_name_product').on('keyup',function (e) {
                 e.preventDefault();
                 e.stopPropagation();
                 var query = $(this).val();
                 var _token = $('input[name="_token"]').val();
                 $.ajax({
                     url:'{{ route('search.user.product') }}',
                     type:'post',
                     data:{'name':query, _token:_token},
                     // dataType: "html",
                     // contentType:"application/json; charset=utf-8",
                     // dataType:"json",
                     success:function (data) {
                         // console.log(data);
                         $('#product_list_user_singles').html(data);
                     }
                 })
             });



             $(document).on('click', '.list-group-item', function () {
                 var _token = $('input[name="_token"]').val();
                 var value = $(this).text();
                 $('#user_name_product').val("");
                 var url = $(this).data('url');
                 $('#product_list_user_single').html("");

                 {{--$.ajax({--}}
                 {{--    url: '{{ route('search.user.short.cart') }}',--}}
                 {{--    type: 'post',--}}
                 {{--    data: {'name': value, url: url, _token: _token},--}}
                 {{--    success: function (data) {--}}
                 {{--        $('#user_name_mobile').css('margin-top',0);--}}
                 {{--        console.log('ok');--}}
                 {{--    }--}}
                 {{--})--}}


             });
             // }

         });
     </script>


 @if ($business_type == 'shop')
         @include('alerts.alerts')
        <div id="one">
            <div class="profile">

                <div class="media-body">
                    <div class="profile_image_section">
                        <img width="130" height="130" src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->fi()]) }}" alt="">
                        <h4>{{ ucfirst($profile->name) }}</h4>
                    </div>
                </div>

                <div class="media-body" style="margin-top: 46px;">
                    <h4 class="mt-0 mb-0" style="margin-left: -7px;">{{ ucfirst($profile->name) }}</h4>
                    <p class="small mb-0"> <strong>SS:
                        </strong>{{ $profile->workstation->title }}</p>
                    <p class="small mt-0"> <strong>Cat:
                        </strong>{{ $profile->category->name }}</p>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-12">
                <div class="bg-light p-4 d-flex justify-content-end text-center right-ul-test">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">  {{ count($profile->products->where('status', 'approved')->where('active', true)) }}</h5>
                            <small class="text-muted"> <i class="fas fa-image mr-1"></i>Products</small>
                        </li>

                        <li class="list-inline-item">
                            <a href="{{ route('user.addTofavourite', ['typeid' => $profile->id, 'type' => 'service_profile']) }}">
                                <h5 class="font-weight-bold mb-0 d-block">
                                    @if ($profile->isMyFavourite())
                                        <i class="fas fa-save w3-text-red"></i>
                                    @else
                                        <i class="fas fa-save w3-text-gray"></i>
                                    @endif
                                </h5>
                                <small class="text-muted">Add To Fv</small>
                            </a>
                        </li>
                        @if ($profile->user_id != Auth::id())
                        <li class="list-inline-item">
                            <a href="{{ route('subscriber.allCartProducts', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }}">
                                <h5 class="font-weight-bold mb-0 d-block">{{ $cart }}</h5>
                                <small class="text-muted"> <i class="fas fa-shopping-cart"></i>Cart</small>
                            </a>
                        </li>
                        @endif
                        <li class="list-inline-item">
                            <a  href="{{ route('subscriber.allOrdersOfServieProfileProducts', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }}">
                                <h5 class="font-weight-bold mb-0 d-block">{{ $my_order_count }}</h5>
                                <small class="text-muted"> <i class="fas fa-user mr-1"></i>My Orders</small>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12">
                <div class="px-4 py-3">
                    <div class="mb-3">

                        <li class="list-inline-item">
                            @if ($profile->paystatus == true)
                                <span class=""><img title="Paid" src="{{ asset('img/badge/paid.png') }}"
                                                    width="30px" alt="" srcset=""></span>

                            @else
                                <span class=""><img title="Trial" src="{{ asset('img/badge/free.png') }}"
                                                    width="30px" alt="" srcset=""></span>
                            @endif
                        </li>



                        <li class="list-inline-item">
                            @if ($profile->open)
                                <span title="Shop/Service Open" class="text-success p-2"><i
                                        class="fas fa-check"></i> Open</span>
                            @else
                                <span title="Shop/Service Closed" class="text-danger p-2"><i
                                        class="fas fa-times"></i> Closed</span>
                            @endif
                        </li>

                        @if ($profile->online_sale)
                            <li class="list-inline-item">
                                        <span><span class="text-success"><i class="fas fa-check"></i></span> Online
                                            Sale/Service</span>
                            </li>
                        @endif

                        @if ($profile->offline_sale)
                            <li class="list-inline-item">
                                        <span><span class="text-success"><i class="fas fa-check"></i></span> Offline
                                            Sale/Service</span>
                            </li>
                        @endif
                        @if ($profile->home_delivery)
                            <li class="list-inline-item">
                                        <span><span class="text-success"><i class="fas fa-truck"></i></span> Home
                                            Delivery Available</span>
                            </li>
                        @endif
                        <li class="list-inline-item">
                            <span> <a href="{{ route('user.SoftcomJobCandidateApprovedList') }}" class="btn btn-default w3-deep-orange"><i class="fas fa-briefcase"></i> Hire Shop Worker </a></span>
                        </li>

                    </div>

                    <div class="addthis_inline_share_toolbox"></div>
                </div>
            </div>
        </div>

         <div class="row">
             <div class="col-12">
                 <div class="text">
                     <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                         <li class="nav-item">
                             <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">About</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Legal Informaion</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Communication</a>
                         </li>
                     </ul>
                     <div class="tab-content" id="pills-tabContent">
                         <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                             <div class="p-4 rounded shadow-sm bg-light">
                                 {{ $profile->short_bio }}
                             </div>
                         </div>
                         <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                             <div class="p-4 rounded shadow-sm bg-light">
                                 @if (isset($visitor))
                                     @if ($visitor and $visitor->short_paid == 1 or $profile->user_id == Auth::id())
                                         <div class="card">
                                             <div class="card-body">
                                                 @foreach ($profile->shortValues() as $value)
                                                     @if ($value->field_type == 'string')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'text')

                                                         <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                         {!! $value->profile_info_value !!}

                                                     @elseif($value->field_type == 'integer')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'float')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'image')
                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img
                                                                     class="rounded w3-border"
                                                                     src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                                     alt="sans" width="100" /></div>
                                                         </div>

                                                         <br>

                                                     @elseif($value->field_type == 'doc')

                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img
                                                                     class="rounded w3-border"
                                                                     src="{{ asset('img/word.png') }}"
                                                                     alt="msword" width="100" />
                                                                 <a class="btn btn-xs btn-primary"
                                                                    href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                                    download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                             </div>
                                                         </div>

                                                         <br>

                                                     @elseif($value->field_type == 'pdf')

                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img
                                                                     class="rounded w3-border"
                                                                     src="{{ asset('img/pdf.png') }}"
                                                                     alt="pdf" width="100" />
                                                                 <a class="btn btn-xs btn-primary"
                                                                    href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                             </div>

                                                             @endif
                                                             @endforeach
                                                         </div>
                                             </div>
                                             @else
                                                 <div class="card">
                                                     <div class="row">
                                                         <div class="col-sm-12 py-4 text-center">
                                                             @php
                                                                 $sp = $profile->category->sp_short_price;
                                                             @endphp
                                                             <a class="btn btn-info"
                                                                onclick="return confirm('{{ $sp }} taka will be deducted from your account. Do you agree?');"
                                                                href="{{ route('subscriber.profilePaidPortionView', ['subscription' => $subscription->subscription_code, 'profile' => $profile, 'paid_type' => 'short_paid']) }}">{{ $profile->category->sp_short_p_view_btn_txt ? ucwords($profile->category->sp_short_p_view_btn_txt) : 'View' }}</a>

                                                         </div>
                                                     </div>
                                                 </div>
                                             @endif
                                             @endif
                                         </div>
                             </div>
                             <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                 <div class="p-4 rounded shadow-sm bg-light">

                                     @if ($visitor and $visitor->full_paid == 1 or $profile->user_id == Auth::id() or $my_orders_price >= $profile->category->sp_full_price)
                                         <div class="card">
                                             <div class="card-body">
                                                 @foreach ($profile->fullValues() as $value)

                                                     @if ($value->field_type == 'string')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'text')

                                                         <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                         {!! $value->profile_info_value !!}

                                                     @elseif($value->field_type == 'integer')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'float')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'image')
                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img
                                                                     class="rounded w3-border"
                                                                     src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                                     alt="sans" width="100" /></div>
                                                         </div>

                                                         <br>

                                                     @elseif($value->field_type == 'doc')

                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img
                                                                     class="rounded w3-border"
                                                                     src="{{ asset('img/word.png') }}"
                                                                     alt="msword" width="100" />
                                                                 <a class="btn btn-xs btn-primary"
                                                                    href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                                    download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                             </div>
                                                         </div>

                                                         <br>

                                                     @elseif($value->field_type == 'pdf')

                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img
                                                                     class="rounded w3-border"
                                                                     src="{{ asset('img/pdf.png') }}" alt="pdf"
                                                                     width="100" />
                                                                 <a class="btn btn-xs btn-primary"
                                                                    href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                             </div>
                                                             @endif
                                                             @endforeach
                                                         </div>
                                             </div>
                                             {{-- @elseif ($my_orders >= $profile->category->sp_full_price)
                                         Hello --}}
                                             @else
                                                 <div class="card">
                                                     <div class="row">
                                                         <div class="col-sm-12 py-4 text-center">
                                                             @php
                                                                 $spf = $profile->category->sp_full_price;
                                                             @endphp
                                                             <a class="btn btn-info"
                                                                onclick="return confirm('{{ $spf }} taka will be deducted from your account. Do you agree?');"
                                                                href="{{ route('subscriber.profilePaidPortionView', ['subscription' => $subscription->subscription_code, 'profile' => $profile, 'paid_type' => 'full_paid']) }}">
                                                                 {{ $profile->category->sp_full_p_view_btn_txt ? ucwords($profile->category->sp_full_p_view_btn_txt) : 'View' }}
                                                             </a>
                                                             {{-- @if ($visitor->short_paid == 1)
                                                             @php
                                                                 $spf = $profile->category->sp_full_price;
                                                             @endphp
                                                             <a class="btn btn-info"
                                                                 onclick="return confirm('{{ $spf }} taka will be deducted from your account. Do you agree?');"
                                                                 href="{{ route('subscriber.profilePaidPortionView', ['subscription' => $subscription->subscription_code, 'profile' => $profile, 'paid_type' => 'full_paid']) }}">
                                                                 {{ $profile->category->sp_full_p_view_btn_txt ? ucwords($profile->category->sp_full_p_view_btn_txt) : 'View' }}
                                                             </a>
                                                         @else
                                                             <button disabled class="btn btn-primary">
                                                                 {{ $profile->category->sp_full_p_view_btn_txt ? ucwords($profile->category->sp_full_p_view_btn_txt) : 'View' }}

                                                             </button>
                                                         @endif --}}
                                                         </div>
                                                     </div>
                                                 </div>
                                             @endif
                                         </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="product">
                        <h5>Exclusive items from our shop</h5>

                        @if ($service_product)
                            @forelse ($service_product->chunk(4)  as $item4)
                                <div class="row my-3">
                                    @foreach ($item4 as $item)
                                        <div class="col-6 col-xs-6 col-sm-6 col-md-3 bg-white" style="margin-top: 20px;">

                                            <a class="w3-small"
                                               href="{{ route('welcome.productShare', ['profile' => $profile->id, 'product' => $item->id, 'reffer' => $subscription->subscription_code]) }}">
                                                <img src=" {{ route('imagecache', ['template' => 'pnism', 'filename' => $item->fi()]) }}"
                                                     class="card-image img-fluid rounded-top w-100" height="200px" style="height:200px !important;" alt="" srcset="">
                                            </a>
                                            <p class="text-header"><a class="w3-small"
                                                                      href="{{ route('welcome.productShare', ['profile' => $profile->id, 'product' => $item->id, 'reffer' => $subscription->subscription_code]) }}">{{ Str::limit($item->name, 20, '..') }}</a></p>

{{--                                            <span style="padding-left:16px;">TK 4500</span>--}}

                                            @if ($item->sale_price)
                                                <span class="w3-small w3-text-deep-orange">SCB
                                    {{ $item->sale_price }}</span>

                                                @if ($item->deleted_price) <span class="w3-tiny w3-text-gray"> <del>{{ $item->deleted_price }}</del></span>@endif
                                            @endif

                                            <div class="col-md-12">
                                                <div class="d-flex justify-content-between mt-1">

                                                    @if ($item->user_id != Auth::id())
                                                        {{-- @if ($item->sale_price)
                                                            <p class="m-0"><a id="toggle"
                                                                    href="{{ route('subscriber.addToCartProduct', ['profile' => $profile->id, 'product' => $item->id, 'subscription' => $subscription->subscription_code]) }}"><i
                                                                        class="fas fa-shopping-cart w3-text-gray"></i></a>
                                                            </p>
                                                        @endif --}}

                                                        @if($item->stock>0)

                                                            @if ($item->sale_price)
                                                                <p class="m-0"><a id="toggle" data-toggle="tooltip" title="Add To Cart"
                                                                                  href="{{ route('subscriber.addToCartProduct', ['profile' => $profile->id, 'product' => $item->id, 'subscription' => $subscription->subscription_code,'buynow' => 'c']) }}"><i
                                                                            class="fas fa-shopping-cart w3-text-gray" style='font-size:24px'></i></a>
                                                                </p>
                                                            @endif
                                                            @if ($item->sale_price)
                                                                <p class="m-0"><a id="toggle"  data-toggle="tooltip" title="Buy Now" class="btn btn-outline-dark btn-long "
                                                                                  href="{{ route('subscriber.addToCartProduct', ['profile' => $profile->id, 'product' => $item->id, 'subscription' => $subscription->subscription_code,'buynow' => 'b']) }}">
                                                                        Buy Now</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                        {{-- <p>
                                                            <a
                                                                href="{{ route('user.addTofavourite', ['typeid' => $item->id, 'type' => 'service_product']) }}">
                                                                @if ($item->isMyFavourite())
                                                                        <i class="fas fa-save w3-text-red"></i>
                                                                    @else
                                                                        <i class="fas fa-save w3-text-gray"></i>
                                                                    @endif
                                                            </a>
                                                        </p> --}}

                                                        <p class="m-0">
                                                            <a data-toggle="tooltip" title="Add To Wishlist"
                                                               href="{{ route('subscriber.addWishlistServiceProfileProduct', ['product' => $item->id]) }}">

                                                                @if ($item->isMyWishlisted())
                                                                    <i class="fas fa-heart w3-text-red" style='font-size:24px'></i>
                                                                @else
                                                                    <i class="fas fa-heart w3-text-gray" style='font-size:24px'></i>
                                                                @endif


                                                            </a>
                                                        </p>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                                @endforeach
                                @endif

                    </div>
                </div>
            </div>
        </div>


     @elseif ($business_type == 'service')

       @include('alerts.alerts')

       <div id="one">
             <div class="profile">

                 <div class="media-body">
                     <div class="profile_image_section">
                         <img
                             src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->fi()]) }}"
                             alt="..." width="130" class="rounded mb-2 img-thumbnail">
                         <h4>{{ ucfirst($profile->name) }}</h4>
                     </div>
                 </div>

                 <div class="media-body" style="margin-top: 46px;">
                     <h4 class="mt-0 mb-0" style="margin-left: -7px;">{{ ucfirst($profile->name) }}</h4>
                     <p class="small mb-0"> <strong>SS:
                         </strong>{{ $profile->workstation->title }}</p>
                     <p class="small mt-0"> <strong>Cat:
                         </strong>{{ $profile->category->name }}</p>
                 </div>
             </div>
         </div>


        <div class="row">
           <div class="col-12">
                 <div class="bg-light p-4 d-flex justify-content-end text-center right-ul-test">
                     <ul class="list-inline mb-0">
                         <li class="list-inline-item">
                             <h5 class="font-weight-bold mb-0 d-block">   {{ count($profile->serviceItems->where('status', 'approved')->where('active', true)) }}</h5>
                             <small class="text-muted"> <i class="fas fa-image mr-1"></i>Items</small>
                         </li>

                         <li class="list-inline-item">
                             <a href="{{ route('user.addTofavourite', ['typeid' => $profile->id, 'type' => 'service_profile']) }}">
                                 <h5 class="font-weight-bold mb-0 d-block">
                                     @if ($profile->isMyFavourite())
                                         <i class="fas fa-save w3-text-red"></i>
                                     @else
                                         <i class="fas fa-save w3-text-gray"></i>
                                     @endif
                                 </h5>
                                 <small class="text-muted">Add To Fv</small>
                             </a>
                         </li>

                     </ul>
                 </div>
             </div>

             <div class="col-12">
                 <div class="px-4 py-3">
                     <div class="mb-3">
                         <li class="list-inline-item">
                             @if ($profile->package_status == 'regular')
                                 <span class=""><img title="Regular"
                                                     src="{{ asset('img/badge/regular.png') }}" width="30px" alt=""
                                                     srcset=""></span>
                             @elseif ($profile->package_status == 'golden')
                                 <span class=""><img title="Golden"
                                                     src="{{ asset('img/badge/golden.png') }}" width="30px" alt=""
                                                     srcset=""></span>
                             @elseif ($profile->package_status == 'merchant')
                                 <span class=""><img title="Merchant"
                                                     src="{{ asset('img/badge/merchant.png') }}" width="30px" alt=""
                                                     srcset=""></span>
                             @else
                                 <span class=""><img title="Free"
                                                     src="{{ asset('img/badge/free.png') }}" width="30px" alt=""
                                                     srcset=""></span>
                             @endif
                         </li>

                         <li class="list-inline-item">
                             @if ($profile->open)
                                 <span title="Shop/Service Open" class="text-success p-2"><i
                                         class="fas fa-check"></i> Open</span>
                             @else
                                 <span title="Shop/Service Closed" class="text-danger p-2"><i
                                         class="fas fa-times"></i> Closed</span>
                             @endif
                         </li>

                         @if ($profile->online_sale)
                             <li class="list-inline-item">
                                            <span><span class="text-success"><i class="fas fa-check"></i></span> Online
                                                Sale/Service</span>
                             </li>
                         @endif

                         @if ($profile->offline_sale)
                             <li class="list-inline-item">
                                            <span><span class="text-success"><i class="fas fa-check"></i></span> Offline
                                                Sale/Service</span>
                             </li>
                         @endif
                         @if ($profile->home_delivery)
                             <li class="list-inline-item">
                                            <span><span class="text-success"><i class="fas fa-truck"></i></span> Home
                                                Delivery Available</span>
                             </li>
                         @endif
                         <li class="list-inline-item">
                             <span> <a href="{{ route('user.SoftcomJobCandidateApprovedList') }}" class="btn btn-default w3-deep-orange"><i class="fas fa-briefcase"></i> Hire Shop Worker </a></span>
                         </li>

                     </div>

                     <div class="addthis_inline_share_toolbox"></div>
                 </div>
             </div>
         </div>


         <div class="row">

             <div class="col-12">
                 <div class="text">
                     <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                         <li class="nav-item">
                             <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">About</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Legal Informaion</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Communication</a>
                         </li>
                     </ul>
                     <div class="tab-content" id="pills-tabContent">
                         <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                             <div class="p-4 rounded shadow-sm bg-light">
                                 {{ $profile->short_bio }}
                             </div>
                         </div>
                         <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                             <div class="p-4 rounded shadow-sm bg-light">
                                 @if (isset($visitor))
                                     @if ($visitor and $visitor->short_paid == 1 or $profile->user_id == Auth::id())
                                         <div class="card">
                                             <div class="card-body">
                                                 @foreach ($profile->shortValues() as $value)
                                                     @if ($value->field_type == 'string')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'text')

                                                         <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                         {!! $value->profile_info_value !!}

                                                     @elseif($value->field_type == 'integer')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'float')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'image')
                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img
                                                                     class="rounded w3-border"
                                                                     src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                                     alt="sans" width="100" /></div>
                                                         </div>

                                                         <br>

                                                     @elseif($value->field_type == 'doc')

                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img
                                                                     class="rounded w3-border"
                                                                     src="{{ asset('img/word.png') }}"
                                                                     alt="msword" width="100" />
                                                                 <a class="btn btn-xs btn-primary"
                                                                    href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                                    download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                             </div>
                                                         </div>

                                                         <br>

                                                     @elseif($value->field_type == 'pdf')

                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img
                                                                     class="rounded w3-border"
                                                                     src="{{ asset('img/pdf.png') }}"
                                                                     alt="pdf" width="100" />
                                                                 <a class="btn btn-xs btn-primary"
                                                                    href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                             </div>

                                                             @endif
                                                             @endforeach
                                                         </div>
                                             </div>
                                             @else
                                                 <div class="card">
                                                     <div class="row">
                                                         <div class="col-sm-12 py-4 text-center">
                                                             @php
                                                                 $sp = $profile->category->sp_short_price;
                                                             @endphp
                                                             <a class="btn btn-info"
                                                                onclick="return confirm('{{ $sp }} taka will be deducted from your account. Do you agree?');"
                                                                href="{{ route('subscriber.profilePaidPortionView', ['subscription' => $subscription->subscription_code, 'profile' => $profile, 'paid_type' => 'short_paid']) }}">{{ $profile->category->sp_short_p_view_btn_txt ? ucwords($profile->category->sp_short_p_view_btn_txt) : 'View' }}</a>

                                                         </div>
                                                     </div>
                                                 </div>
                                             @endif
                                             @endif
                                         </div>
                             </div>
                             <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                 <div class="p-4 rounded shadow-sm bg-light">

                                     @if ($visitor and $visitor->full_paid == 1 or $profile->user_id == Auth::id() or $my_orders_price >= $profile->category->sp_full_price)
                                         <div class="card">
                                             <div class="card-body">
                                                 @foreach ($profile->fullValues() as $value)

                                                     @if ($value->field_type == 'string')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'text')

                                                         <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                         {!! $value->profile_info_value !!}

                                                     @elseif($value->field_type == 'integer')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'float')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'image')
                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img
                                                                     class="rounded w3-border"
                                                                     src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                                     alt="sans" width="100" /></div>
                                                         </div>

                                                         <br>

                                                     @elseif($value->field_type == 'doc')

                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img
                                                                     class="rounded w3-border"
                                                                     src="{{ asset('img/word.png') }}"
                                                                     alt="msword" width="100" />
                                                                 <a class="btn btn-xs btn-primary"
                                                                    href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                                    download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                             </div>
                                                         </div>

                                                         <br>

                                                     @elseif($value->field_type == 'pdf')

                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img
                                                                     class="rounded w3-border"
                                                                     src="{{ asset('img/pdf.png') }}" alt="pdf"
                                                                     width="100" />
                                                                 <a class="btn btn-xs btn-primary"
                                                                    href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                             </div>
                                                             @endif
                                                             @endforeach
                                                         </div>
                                             </div>
                                             {{-- @elseif ($my_orders >= $profile->category->sp_full_price)
                                         Hello --}}
                                             @else
                                                 <div class="card">
                                                     <div class="row">
                                                         <div class="col-sm-12 py-4 text-center">
                                                             @php
                                                                 $spf = $profile->category->sp_full_price;
                                                             @endphp
                                                             <a class="btn btn-info"
                                                                onclick="return confirm('{{ $spf }} taka will be deducted from your account. Do you agree?');"
                                                                href="{{ route('subscriber.profilePaidPortionView', ['subscription' => $subscription->subscription_code, 'profile' => $profile, 'paid_type' => 'full_paid']) }}">
                                                                 {{ $profile->category->sp_full_p_view_btn_txt ? ucwords($profile->category->sp_full_p_view_btn_txt) : 'View' }}
                                                             </a>
                                                             {{-- @if ($visitor->short_paid == 1)
                                                             @php
                                                                 $spf = $profile->category->sp_full_price;
                                                             @endphp
                                                             <a class="btn btn-info"
                                                                 onclick="return confirm('{{ $spf }} taka will be deducted from your account. Do you agree?');"
                                                                 href="{{ route('subscriber.profilePaidPortionView', ['subscription' => $subscription->subscription_code, 'profile' => $profile, 'paid_type' => 'full_paid']) }}">
                                                                 {{ $profile->category->sp_full_p_view_btn_txt ? ucwords($profile->category->sp_full_p_view_btn_txt) : 'View' }}
                                                             </a>
                                                         @else
                                                             <button disabled class="btn btn-primary">
                                                                 {{ $profile->category->sp_full_p_view_btn_txt ? ucwords($profile->category->sp_full_p_view_btn_txt) : 'View' }}

                                                             </button>
                                                         @endif --}}
                                                         </div>
                                                     </div>
                                                 </div>
                                             @endif
                                         </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </div>
        <div class="container">
         <div class="row">
             <div class="col-12">
                 <div class="product">
                     <h5><b>Recent Items</b></h5>
                     @if ($service_product)
                         @foreach ($service_product as $item)
                         <div class="row">
                             <div class="col-md-3">
                                 <a href="{{ route('welcome.serviceItemShare', ['profile' => $profile->id, 'reffer' => $subscription->subscription_code, 'item' => $item->id]) }}">
                                     <img class="img-fluid"
                                          src=" {{ route('imagecache', ['template' => 'pplg', 'filename' => $item->fi()]) }}" alt="">
                                 </a>
                             </div>
                             <div class="col-md-9">
                                 <h4 class="m-0 p-0 font-weight-bolder bb-2">
                                     <a href="{{ route('welcome.serviceItemShare', ['profile' => $profile->id, 'reffer' => $subscription->subscription_code, 'item' => $item->id]) }}">
                                     {{ $item->title }}</h4>
                                 </a>
                                 <p class="m-0 p-0">{{ $item->excerpt }}</p>
                                 @if (Auth::check())
                                     @if ($item->user_id != Auth::id())
                                         @if ($item->negotiations)
                                             <a href="" class="btn btn-success btn-sm">Negotiable</a>
                                         @else
                                             <a href="" class="btn btn-info btn-sm">Pay Now</a>
                                         @endif
                                     @endif

                                 @endif
                             </div>
                         </div>
                         @endforeach
                     @endif
                 </div>
             </div>
         </div>
        </div>

     @else
        <div class="row">
         <div class="col-md-12 m-auto">
             <div class="card card-default">
                 <div class="card-header"
                      style="background-color: {{ $profile->category ? $profile->category->sp_header_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->sp_header_text_color : '' }}">
                     <div class="d-flex justify-content-between">
                         <p class="m-0">{{ ucfirst($profile->name) }} ({{ $profile->id }})
                             Details
                         </p>

                     </div>
                 </div>
                 <div class="card-body"
                      style="background-color: {{ $profile->category ? $profile->category->sp_body_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->sp_body_text_color : '' }}">
                     <div class="row center">
                         <div class="col-md-3">
                             <div class="card">
                                 <div class="card-body" style="min-height: 175px;">
                                     <img class=" w3-circle"
                                          src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->img_name]) }}"
                                          alt="sans" />

                                 </div>
                             </div>
                         </div>
                         <div class="col-md-9">
                             <div class="card">
                                 <div class="card-body" style="min-height: 175px;">
                                     <p>
                                         <b>Name: {{ Str::ucfirst($profile->name) }}</b>
                                     </p>

                                     <p>
                                         <b>Bio:</b> {{ $profile->short_bio }}
                                     </p>

                                 </div>
                             </div>
                         </div>

                     </div>
                     <hr>

                     <div class="card">
                         <div class="card-body">
                             @foreach ($profile->freeValues() as $value)
                                 @if ($value->field_type == 'string')

                                     <p><b>{{ $value->profile_info_key }}</b>:
                                         {{ $value->profile_info_value }}
                                     </p>

                                 @elseif($value->field_type == 'text')

                                     <p><b>{{ $value->profile_info_key }}</b>:</p>
                                     {!! $value->profile_info_value !!}

                                 @elseif($value->field_type == 'integer')

                                     <p><b>{{ $value->profile_info_key }}</b>:
                                         {{ $value->profile_info_value }}
                                     </p>

                                 @elseif($value->field_type == 'float')

                                     <p><b>{{ $value->profile_info_key }}</b>:
                                         {{ $value->profile_info_value }}
                                     </p>

                                 @elseif($value->field_type == 'image')

                                     <div class="row">
                                         <div class="col-sm-6">
                                             <p><b>{{ $value->profile_info_key }}</b>:</p>
                                         </div>
                                         <div class="col-sm-6"><img class="rounded w3-border"
                                                                    src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                                    alt="sans" width="100" /></div>
                                     </div>
                                     <br>


                                 @elseif($value->field_type == 'doc')

                                     <div class="row">
                                         <div class="col-sm-6">
                                             <p><b>{{ $value->profile_info_key }}</b>:</p>
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
                                             <p><b>{{ $value->profile_info_key }}</b>:</p>
                                         </div>
                                         <div class="col-sm-6"><img class="rounded w3-border"
                                                                    src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                             <a class="btn btn-xs btn-primary"
                                                href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                         </div>

                                         @endif

                                         @endforeach
                                     </div>
                         </div>

                         <hr>
                         @if (isset($visitor))

                             @if ($visitor and $visitor->short_paid == 1 or $profile->user_id == Auth::id())

                                 <div class="card">
                                     <div class="card-body">
                                         @foreach ($profile->shortValues() as $value)
                                             @if ($value->field_type == 'string')

                                                 <p><b>{{ $value->profile_info_key }}</b>:
                                                     {{ $value->profile_info_value }}
                                                 </p>

                                             @elseif($value->field_type == 'text')

                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                 {!! $value->profile_info_value !!}

                                             @elseif($value->field_type == 'integer')

                                                 <p><b>{{ $value->profile_info_key }}</b>:
                                                     {{ $value->profile_info_value }}
                                                 </p>

                                             @elseif($value->field_type == 'float')

                                                 <p><b>{{ $value->profile_info_key }}</b>:
                                                     {{ $value->profile_info_value }}
                                                 </p>

                                             @elseif($value->field_type == 'image')
                                                 <div class="row">
                                                     <div class="col-sm-6">
                                                         <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                     </div>
                                                     <div class="col-sm-6"><img class="rounded w3-border"
                                                                                src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                                                alt="sans" width="100" /></div>
                                                 </div>

                                                 <br>

                                             @elseif($value->field_type == 'doc')

                                                 <div class="row">
                                                     <div class="col-sm-6">
                                                         <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                     </div>
                                                     <div class="col-sm-6"><img class="rounded w3-border"
                                                                                src="{{ asset('img/word.png') }}" alt="msword"
                                                                                width="100" />
                                                         <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                            download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                     </div>
                                                 </div>

                                                 <br>

                                             @elseif($value->field_type == 'pdf')

                                                 <div class="row">
                                                     <div class="col-sm-6">
                                                         <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                     </div>
                                                     <div class="col-sm-6"><img class="rounded w3-border"
                                                                                src="{{ asset('img/pdf.png') }}" alt="pdf"
                                                                                width="100" />
                                                         <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                     </div>

                                                     @endif
                                                     @endforeach
                                                 </div>
                                     </div>
                                     @else
                                         <div class="card">
                                             <div class="row">
                                                 <div class="col-sm-12 py-4 text-center">
                                                     @php
                                                         $sp = $profile->category->sp_short_price;
                                                     @endphp
                                                     <a class="btn btn-info"
                                                        onclick="return confirm('{{ $sp }} taka will be deducted from your account. Do you agree?');"
                                                        href="{{ route('subscriber.profilePaidPortionView', ['subscription' => $subscription->subscription_code, 'profile' => $profile, 'paid_type' => 'short_paid']) }}">{{ $profile->category->sp_short_p_view_btn_txt ? ucwords($profile->category->sp_short_p_view_btn_txt) : 'View' }}</a>

                                                 </div>
                                             </div>
                                         </div>
                                     @endif
                                     @endif
                                     <hr>
                                     @if ($visitor and $visitor->full_paid == 1 or $profile->user_id == Auth::id())
                                         <div class="card">
                                             <div class="card-body">
                                                 @foreach ($profile->fullValues() as $value)

                                                     @if ($value->field_type == 'string')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'text')

                                                         <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                         {!! $value->profile_info_value !!}

                                                     @elseif($value->field_type == 'integer')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'float')

                                                         <p><b>{{ $value->profile_info_key }}</b>:
                                                             {{ $value->profile_info_value }}
                                                         </p>

                                                     @elseif($value->field_type == 'image')
                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img class="rounded w3-border"
                                                                                        src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                                                        alt="sans" width="100" /></div>
                                                         </div>

                                                         <br>

                                                     @elseif($value->field_type == 'doc')

                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img class="rounded w3-border"
                                                                                        src="{{ asset('img/word.png') }}" alt="msword"
                                                                                        width="100" />
                                                                 <a class="btn btn-xs btn-primary"
                                                                    href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                                    download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                                             </div>
                                                         </div>

                                                         <br>

                                                     @elseif($value->field_type == 'pdf')

                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <p><b>{{ $value->profile_info_key }}</b>:</p>
                                                             </div>
                                                             <div class="col-sm-6"><img class="rounded w3-border"
                                                                                        src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                                 <a class="btn btn-xs btn-primary"
                                                                    href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                             </div>

                                                             @endif
                                                             @endforeach
                                                         </div>
                                             </div>
                                             @else
                                                 <div class="card">
                                                     <div class="row">
                                                         <div class="col-sm-12 py-4 text-center">
                                                             @if($visitor)
                                                                 @if ($visitor->short_paid == 1)
                                                                     @php
                                                                         $spf = $profile->category->sp_full_price;
                                                                     @endphp
                                                                     <a class="btn btn-info"
                                                                        onclick="return confirm('{{ $spf }} taka will be deducted from your account. Do you agree?');"
                                                                        href="{{ route('subscriber.profilePaidPortionView', ['subscription' => $subscription->subscription_code, 'profile' => $profile, 'paid_type' => 'full_paid']) }}">
                                                                         {{ $profile->category->sp_full_p_view_btn_txt ? ucwords($profile->category->sp_full_p_view_btn_txt) : 'View' }}
                                                                     </a>
                                                                 @else
                                                                     <button disabled class="btn btn-primary">
                                                                         {{ $profile->category->sp_full_p_view_btn_txt ? ucwords($profile->category->sp_full_p_view_btn_txt) : 'View' }}

                                                                     </button>
                                                                 @endif
                                                             @endif
                                                         </div>
                                                     </div>
                                                 </div>
                                             @endif
                                         </div>
                                 </div>

                                 {{-- <div class="card-footer"
                                     style="background-color: {{ $profile->category ? $profile->category->sp_footer_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->sp_footer_text_color : '' }}">
                                     <p>© Copyright {{ date('Y') }} | {{ $_SERVER['SERVER_NAME'] }}</p>
                                 </div> --}}
                     </div>

                 </div>
             </div>
         </div>
        </div>
     @endif
     <div class="container">
         @if(\Illuminate\Support\Facades\Auth::check())
         <div class="row">
             <div class="col-12">
                 <h3>Review And Rating</h3>
                 <form action="{{ route('user.ratingstore') }}" method="POST">@csrf
                     <div class="form-group">
                         <label for="ratting">Ratting</label>
                         <!-- <input type="text" name="ratting" id="ratting" class="form-control"> -->

                         <section class='rating-widget'>

                             <!-- Rating Stars Box -->
                             <div class='rating-stars'>
                                 <ul id='stars'>
                                     <li class='star' title='Poor' data-value='1'>
                                         <i class='fa fa-star fa-fw'></i>
                                     </li>
                                     <li class='star' title='Fair' data-value='2'>
                                         <i class='fa fa-star fa-fw'></i>
                                     </li>
                                     <li class='star' title='Good' data-value='3'>
                                         <i class='fa fa-star fa-fw'></i>
                                     </li>
                                     <li class='star' title='Excellent' data-value='4'>
                                         <i class='fa fa-star fa-fw'></i>
                                     </li>
                                     <li class='star' title='WOW!!!' data-value='5'>
                                         <i class='fa fa-star fa-fw'></i>
                                     </li>
                                 </ul>
                             </div>

                             <input type="hidden" name="rating" id="ratting_value" value="0">


                         </section>


                     </div>
                     <div class="form-group">
                         <label for="comments">Comments</label>
                         <textarea name="comments" id="comments" cols="30" rows="6" class="form-control"></textarea>
                     </div>

                     <div class="form-group">
                         <button type="submit" class="btn btn-sm ratting_post_button">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
         @endif

         @if(count($rating))

         <div class="row">
             <div class="col-12">
                 <h6>Ratings & Reviews of {{ ucfirst($profile->name) }} </h6>
             </div>
             <div class="col-12">
                 <div class="row review_ratting_main_section">
                     <div class="col-6 col-md-6">
                         <div class="ratting-total total-ratting-title" style="padding-left:20px"><span class="span-ratting-title">4.7</span>/ <span>5</span></div>
                         <div class="ratting-total">
                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                         </div>
                         <div >
                             <p class="text-muted">{{count($rating)}} rattings</p>
                         </div>
                     </div>


                     <div class="col-6 col-md-6">
                         <div class="row">
                             <div class="col-12">

                                 <div class="row ratting-progress-stystem">
                                     <div class="col-6">
                                         <p style="right:0; position:absolute;">
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                         </p>
                                     </div>


                                     <div class="col-2 ratting-count-section">
                                         <span>@php echo App\Models\Rating::where('profile_id',$profile->id)->where('rating', 5)->count(); @endphp</span>
                                     </div>
                                 </div>

                                 <div class="row ratting-progress-stystem">
                                     <div class="col-6">
                                         <p style="right:0; position:absolute;">
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                         </p>
                                     </div>


                                     <div class="col-2 ratting-count-section">
                                         <span>@php echo App\Models\Rating::where('profile_id',$profile->id)->where('rating', 4)->count(); @endphp</span>
                                     </div>
                                 </div>

                                 <div class="row ratting-progress-stystem">
                                     <div class="col-6">
                                         <p style="right:0; position:absolute;">
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                         </p>
                                     </div>


                                     <div class="col-2 ratting-count-section">
                                         <span>@php echo App\Models\Rating::where('profile_id',$profile->id)->where('rating', 3)->count(); @endphp</span>
                                     </div>
                                 </div>

                                 <div class="row ratting-progress-stystem">
                                     <div class="col-6">
                                         <p style="right:0; position:absolute;">
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                         </p>
                                     </div>



                                     <div class="col-2 ratting-count-section">
                                         <span>@php echo App\Models\Rating::where('profile_id',$profile->id)->where('rating', 2)->count(); @endphp</span>
                                     </div>
                                 </div>


                                 <div class="row ratting-progress-stystem">
                                     <div class="col-6">
                                         <p style="right:0; position:absolute;">
                                             <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                         </p>
                                     </div>

                                     <div class="col-2 ratting-count-section">
                                         <span>@php echo App\Models\Rating::where('profile_id',$profile->id)->where('rating', 1)->count(); @endphp</span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </div>


          <div class="row product_review_section">
                 <div class="col-12">
                     <p class="product_review_title">Service Ratting Reviews List</p>
                 </div>


                @foreach($rating as $rat)
                 <div class="col-12">
                     <div class="row product_review_section">
                         <div class="col-7 product_review_section_second" >
                             <p>
                                 @for($i = 0; $i < $rat->rating; $i++)
                                 <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>

                                 @endfor
                             </p><br>

                             <p style="margin-top:-20px; color:green;" >by {{$rat->user->name}}</p>


                         </div>

                         <div class="col-5 product_review_section_second">
                             <p class="right">{{$rat->created_at->format('d-M-Y')}}</p>
                         </div>


                         <div class="col-12">
                             <p>{{$rat->comments}}</p>
                         </div>
                     </div>
                 </div>
              @endforeach






             </div>


          @endif


     </div>

     </div>



@endsection

@push('js')
    <script>
        $('#stars li').on('mouseover', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
            // console.log(onStar);

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e){
                if (e < onStar) {
                    $(this).addClass('hover');

                }
                else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function(){
            $(this).parent().children('li.star').each(function(e){
                $(this).removeClass('hover');
            });
        });


        /* 2. Action to perform on click */
        $('#stars li').on('click', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            document.getElementById('ratting_value').value = onStar;
            // console.log(onStar);
            var stars = $(this).parent().children('li.star');

            for (var i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (var i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var msg = "";
            if (ratingValue > 1) {
                msg = "Thanks! You rated this " + ratingValue + " stars.";
            }
            else {
                msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
            }
            // this.responseMessage(msg);

        });


    </script>
@endpush
