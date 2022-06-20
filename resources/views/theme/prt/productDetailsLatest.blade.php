@extends('layouts.app_view')

@push('css')


    <meta property="fb:app_id" content="1024960768094549" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $product->name }}" />
    <meta property="og:description" content="{{$product->description}}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image" content="{{ route('imagecache', ['template' => 'pfimd', 'filename' => $product->fi()]) }}" />
    <meta property="og:url" content="https://www.sc-bd.com/" />

    <style>
        /*--------- start .product_description_description   -----------*/
        .product_descrition_description {
            height: 100%;
        }

        .product_descrition_description h6{
            padding: 15px !important;
        }

        .product_descrition_description p{
            padding: 15px !important;
        }

        .product_descrition_description .review_ratting_main_section{
            padding: 15px;
        }
        .product_descrition_description .review_ratting_main_section .ratting-total{
            padding-left: 15px;

        }

        .product_descrition_description .review_ratting_main_section .ratting-total i{
            font-size: 30px;
        }

        .product_descrition_description .review_ratting_main_section .ratting-total.total-ratting-title span{
            font-size: 12px;
        }

        .product_descrition_description .review_ratting_main_section .ratting-total.total-ratting-title span.span-ratting-title{
            font-size: 30px;
        }

        .product_descrition_description .review_ratting_main_section .ratting-progress-stystem{
            height: 31px;
        }
        .product_descrition_description .review_ratting_main_section .ratting-progress-stystem .progress{
            margin-top: 22px;
        }
        .product_descrition_description .review_ratting_main_section .ratting-progress-stystem .ratting-count-section{
            margin-top: 18px;
        }

        .product_descrition_description .review_ratting_main_section .product_review_section{
            margin-bottom: 30px;
        }

        .product_descrition_description .review_ratting_main_section .product_review_section .product_review_section_second p{
            font-size: 12px;
            overflow: hidden;
            word-break: break-word;
            color: #757575;
        }

        .product_descrition_description .review_ratting_main_section .product_review_section .product_review_section_second p.right{
            float: right !important;
        }

        /*--------- end .product_description_description   -----------*/


        /*--------- start .location  -----------*/
        .location h5{
            display: table-cell;
            font-size: 12px;
            color: #757575;
            font-weight: 500;
            font-family: Roboto-Medium;
            width: 300px;
            margin-bottom: 5px;
        }

        .location .address_location{
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .location .address_location i{
            color: #757575 !important;
        }
        .location .address_location p{
            display: table-cell;
            vertical-align: middle;
            color: #202020;
            padding-right: 5px;
        }


        .location .address_location  .content-text {
            font-size: 13px;
            background-color: #fff;
            padding: 8px;
            margin: 8px 0 0 5px;
            -webkit-box-shadow: 0 1px 1px 0 #dadada;
            box-shadow: 0 1px 1px 0 #dadada;
            border-radius: 2px;
        }



        .location .address_location  .content-text .content-text-single{
            word-break: break-word;
        }

        .location .address_location .cash-on-delivary {
            display: table-cell;
            vertical-align: middle;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .location .address_location .cash-on-delivary p{
            margin-top: 5px;
            line-height: 14px;
        }

        /*--------- end .location   -----------*/


        /*--------- start click_cart-button   -----------*/

        .click_cart_button {
            margin-bottom: 20px;
        }


        .click_cart_button  button {
            padding: 0;
            width: 145px;
            text-align: center;
            margin-right: 10px;
            height: 44px;
            background: #2abbe8;
        }


        .click_cart_button  a:hover{
            border-color: #26abd4;
            background: #26abd4;
        }

        .click_cart_button  a.add_cart_section_button_click {
            border: 1px solid #f57224 !important;
            background: #f57224 !important;
        }

        .click_cart_button  a.add_cart_section_button_click:hover{
            background: #d0611e;

        }

        /*--------- end click_cart-button   -----------*/


        /*--------- start .qunatity_section   -----------*/

        .qunatity_section{
            padding: 20px 0;
        }

        .qunatity_section ul li input{
            height: 30px;
            padding: 2px;
            color: #212121 !important;
            opacity: .7;
            text-align: center;
            width:165px;

        }

        .qunatity_section ul li i{
            padding: 5px;
            border-radius: 50%;
            cursor: pointer;
            color: #212121 !important;
            font-size: 20px;
            opacity: .7;
        }

        /*--------- end .qunatity_section   -----------*/

        .main_description h5{
            color: #212121;
            font-size: 22px;
            font-weight: 400;
            word-break: break-word;
            line-height: 26px;
        /*// word-wrap: break-word;*/
            overflow-wrap: break-word;
        }

        .main_description .ratting_scs{
            display:block;
            width: 100%;
        }
        .main_description .ratting_scs ul{
            list-style: none;
            display: block;
            width: 100%;
        }

        .main_description .ratting_scs ul li{
            color: #9e9e9e;
            font-size: 12px;
        }
        .main_description .ratting_scs ul li a{
            font-size: 12px;
        }

        .main_description .price_fixed{
            color: #f57224;
            font-size: 30px;
        }


        .search_field_style{
            padding: 8px;
            opacity: .8;
            border: 1px solid #ced4da;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;

        }

        .search_field_style:focus{
            outline: none;
            border: none;
        }



        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .product_description_now{
            height: 100%;
        }

        .main_image{
            padding: 5px;
        }

        .second_image{
            padding: 5px;
            margin-bottom: 20px;
        }


    </style>
@endpush

@section('content')
    <div class="container">

        <div class="card">
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
                    <div id="product_list_user_single" style="position: absolute; width: 80%; text-align: center;"></div>

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
                            $('#product_list_user_single').html(data);
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




        <div class="card product_description_now">

            <div class="row" style="padding:10px; margin-top:30px;">
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="main_image">
                        <img style="width:100%; height: 341px;" id="main_image" src="{{ route('imagecache', ['template' => 'pfimd', 'filename' => $product->fi()]) }}" alt="">
                    </div>
                    <div class="second_image">
                        <div class="row">

                            @if ($product->galary_image)
                                @foreach ($product->galary_image as $key => $galary_image)

                            <div class="col-3" >
                                <img style="width:100px; height:100px; cursor:pointer;" onclick="imageChange('{{ route("imagecache", ["template" => "pfimd", "filename" => $galary_image->img_name]) }}')"  src="{{ route('imagecache', ['template' => 'pfimd', 'filename' => $galary_image->img_name]) }}" alt="">
                            </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>



                <div class="col-12 col-sm-12 col-md-5">

                    <div class="main_description">
                        <h5>{{ $product->name }}</h5>
{{--                        <div class="row">--}}
{{--                            <div class="col-12 ratting_scs">--}}
{{--                                <ul>--}}
{{--                                    <li>--}}
{{--                                        <a href="#">--}}
{{--                                            <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                            <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                            <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                            <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                            <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                        </a> &nbsp;--}}
{{--                                        <a href="#">80 Ratings | </a>&nbsp;--}}
{{--                                        <a href="#">20 Answered Questions</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}

{{--                        </div>--}}
                        <div  class="row">
                            <div class="col-12  ratting_scs">
                                <ul>
                                    <li>Seller: <a
                                            href="{{ route('welcome.profileShare', ['reffer' => $subscription->subscription_code, 'profile' => $product->service_profile_id]) }}">{{ $product->serviceProfile->name }}</a> | <a class="font-weigth-bold"
                                                                                                                                                                                                                                href="{{ route('welcome.profileShare', ['reffer' => $subscription->subscription_code, 'profile' => $product->service_profile_id]) }}">More {{ $product->serviceProfile->name }}</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <hr>
                        @if ($product->sale_price)
                        <h5 class="price_fixed">{{ $product->sale_price }} SCB</h5>
                        <p><del class="text-muted">T{{ $product->deleted_price }}</del></p>
                            {{request()->get('quantity')}}
                        @endif

                        <div>
                            <div class="qunatity_section">

                                <ul style="list-style:none; display:inline;">
                                    <li> Available Stock: &nbsp; {{$product->stock}}

{{--                                        <i class="fa fa-minus" id="quantityDecrease" aria-hidden="true"></i> <input type="text" name="quantity" id="quanity" value="1"><i class="fa fa-plus" aria-hidden="true"  id="quantityIncrease"></i>--}}


                                    </li>
                                </ul>
                            </div>
                        </div>
                        @if ($product->user_id != Auth::id())
                            @if ($product->sale_price)
                        <div class="row">
                            @if (Auth::guest())
                                <div class="col-6 click_cart_button">
                                    <a href="{{url('/sc-bd-login')}}" class="btn btn-primary">Buy Now</a>
                                </div>

                                <div class="col-6 click_cart_button" >
                                    <a href="{{url('/sc-bd-login')}}" class="btn btn-primary add_cart_section_button_click">Add To Cart</a>
                                </div>
                            @else
                            <div class="col-6 click_cart_button">
                                <a href="{{ route('subscriber.addToCartProduct', ['profile' => $product->serviceProfile, 'product' => $product->id, 'subscription' => $subscription->subscription_code,'buynow' => 'b']) }}" class="btn btn-primary">Buy Now</a>
                            </div>

                            <div class="col-6 click_cart_button" >
                                <a href="{{ route('subscriber.addToCartProduct', ['profile' => $product->serviceProfile, 'product' => $product->id, 'subscription' => $subscription->subscription_code,'buynow' => 'c']) }}" class="btn btn-primary add_cart_section_button_click">Add To Cart</a>
                            </div>
                            @endif
                        </div>
                            @endif
                        @endif




                    </div>
                </div>


                <div class="col-12 col-sm-12 col-md-3">
                    <div class="location">
                        <h5>Delivery</h5>
                        <div class="row address_location">
                            <div class="col-1 col-sm-1 col-md-1">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </div>
                            <div class="col-11 col-sm-11 col-md-10">
                                <p>{{$product->serviceProfile->address}}</p>
                            </div>
                        </div>

                        <div class="row address_location">
                            <div class="col-1 col-sm-1 col-md-1">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                            </div>
                            <div class="col-11 col-sm-11 col-md-10">
                                <div class="row">
                                    <div class="col-8">
                                        <p>Home Delivery</p>
                                        <span class="text-muted">{{ $product->max_delivery_days }} day(s)</span>
                                    </div>
                                    <div class="col-4">
                                        <span>TK 55</span>
                                    </div>
                                    <div class="col-12 content-text">
                                        <div class="content-text-single">
                                            Enjoy free shipping promotion with minimum spend of ৳ 2,499 from {{$product->serviceProfile->name}} Online Shop.
                                        </div>

                                    </div>
                                </div>
                            </div>




                            <div class="col-1 col-md-1 cash-on-delivary">
                                <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                            </div>
                            <div class="col-11 col-md-10 cash-on-delivary" style="display: table-cell; vertical-align: middle;">
                                <p style="line-height: 14px;">Cash on Delivery Available	</p>
                            </div>



                        </div>

                        <div class="row address_location">
                            <div class="col-12">
                                <h5>Service</h5>
                            </div>

{{--                            <div class="col-1 col-md-1">--}}
{{--                                <i class="fa fa-stop" aria-hidden="true"></i>--}}
{{--                            </div>--}}

{{--                            <div class="col-11 col-md-10">--}}
{{--                                <p>7 Days Returns</p>--}}
{{--                                <span class="text-muted">Change of mind is not applicable</span>--}}
{{--                            </div>--}}

                            @if ($product->replace_guaranty)
                            <div class="col-1 col-md-1">
                                <i class="fa fa-shield" aria-hidden="true"></i>
                            </div>
                            <div class="col-11 col-md-10">
                                <p> @if ($product->replace_guaranty)
                                        <label for="" class="w3-deep-orange p-1 price">
                                            Replacement Guaranteed</label>
                                    @endif</p>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>


            </div>



        </div>

        <div class="card product_descrition_description">
            <div class="row">

                <div class="col-12">
                    <h6>Product details of {{ $product->name }}</h6>

                    <p>
                        {!! html_entity_decode($product->description) !!}
                    </p>
                </div>
            </div>

            <div class="row">
                @if($product->serviceProfile->paystatus==1)
                    @if (count($related_product) > 0)
                        <div class="col-12 col-sm-12 col-md-12 ml-3">
                        <div class="mt-2">
                            <span class="h4">Similar items:</span>
                            <div class=" mt-2 d-flex flex-row">
                                <div class="row">

                                @foreach ($related_product->take(4) as $item)
                                    <div class="col-6 col-sm-4 col-md-3">
{{--                                    <div class="card border p-1" style="width: 9rem;margin-right: 3px;">--}}
                                        <a
                                            href="{{ route('welcome.productShare', ['product' => $item->id, 'reffer' => $subscription->subscription_code, 'profile' => $profile->id]) }}"><img
                                                src="{{ route('imagecache', ['template' => 'pnism', 'filename' => $item->fi()]) }}"
                                                class="card-img-top" alt="..."></a>

                                        <div class="card-body p-0">
                                            <a
                                                href="{{ route('welcome.productShare', ['product' => $item->id, 'reffer' => $subscription->subscription_code, 'profile' => $profile->id]) }} "><b
                                                    class="">{{ $item->name }}</b></a>
                                        </div>
{{--                                    </div>--}}
                                    </div>
                                @endforeach
                                </div>

                            </div>
                        </div>
                        </div>
                    @endif
                @endif



            </div>

{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <h6>Ratings & Reviews of {{ $product->name }}</h6>--}}
{{--                </div>--}}
{{--                <div class="col-12">--}}
{{--                    <div class="row review_ratting_main_section">--}}
{{--                        <div class="col-12 col-md-6">--}}
{{--                            <div class="ratting-total total-ratting-title" style="padding-left:20px"><span class="span-ratting-title">4.7</span>/ <span>5</span></div>--}}
{{--                            <div class="ratting-total">--}}
{{--                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                            </div>--}}
{{--                            <div >--}}
{{--                                <p class="text-muted">38 rattings</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                        <div class="col-12 col-md-6">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-12">--}}

{{--                                    <div class="row ratting-progress-stystem">--}}
{{--                                        <div class="col-6">--}}
{{--                                            <p>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                            </p>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-4">--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"--}}
{{--                                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">--}}
{{--                                                    40% Complete (success)--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-2 ratting-count-section">--}}
{{--                                            <span>31</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row ratting-progress-stystem">--}}
{{--                                        <div class="col-6">--}}
{{--                                            <p>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                                            </p>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-4">--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"--}}
{{--                                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">--}}
{{--                                                    40% Complete (success)--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-2 ratting-count-section">--}}
{{--                                            <span>31</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row ratting-progress-stystem">--}}
{{--                                        <div class="col-6">--}}
{{--                                            <p>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                                            </p>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-4">--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"--}}
{{--                                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">--}}
{{--                                                    40% Complete (success)--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-2 ratting-count-section">--}}
{{--                                            <span>31</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row ratting-progress-stystem">--}}
{{--                                        <div class="col-6">--}}
{{--                                            <p>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                                            </p>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-4">--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"--}}
{{--                                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">--}}
{{--                                                    40% Complete (success)--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-2 ratting-count-section">--}}
{{--                                            <span>31</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


{{--                                    <div class="row ratting-progress-stystem">--}}
{{--                                        <div class="col-6">--}}
{{--                                            <p>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                                                <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                                            </p>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-4">--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"--}}
{{--                                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">--}}
{{--                                                    40% Complete (success)--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-2 ratting-count-section">--}}
{{--                                            <span>31</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}







{{--                    <div class="row product_review_section">--}}
{{--                        <div class="col-12">--}}
{{--                            <p class="product_review_title">Product Reviews</p>--}}
{{--                        </div>--}}

{{--                        <div class="col-12">--}}
{{--                            <div class="row product_review_section">--}}
{{--                                <div class="col-7 product_review_section_second" >--}}
{{--                                    <p>--}}
{{--                                        <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                        <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                        <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                        <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                        <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                    </p><br>--}}

{{--                                    <p style="margin-top:-38px; color:green;" >by ashraful</p>--}}


{{--                                </div>--}}

{{--                                <div class="col-5 product_review_section_second">--}}
{{--                                    <p class="right">27 Apr 2022</p>--}}
{{--                                </div>--}}


{{--                                <div class="col-12">--}}
{{--                                    <p style="margin-top: -38px;">caile apnaraw nite paren....product good</p>--}}
{{--                                </div>--}}

{{--                                <div class="col-12">--}}
{{--                                    <img style="width:94px; height: 94px;" src="/vueimage/image1.png" alt="">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}





{{--                        <div class="col-12">--}}
{{--                            <div class="row product_review_section">--}}
{{--                                <div class="col-6 product_review_section_second" >--}}
{{--                                    <p>--}}
{{--                                        <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                        <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                        <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                        <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                        <i class="fa fa-star" aria-hidden="true" style="color:yellow !important;"></i>--}}
{{--                                    </p>--}}

{{--                                    <p style="margin-top:-38px; color:green;" >by ashraful</p>--}}


{{--                                </div>--}}

{{--                                <div class="col-6 product_review_section_second">--}}
{{--                                    <p class="right">27 Apr 2022</p>--}}
{{--                                </div>--}}


{{--                                <div class="col-12">--}}
{{--                                    <p style="margin-top: -38px;">caile apnaraw nite paren....product good</p>--}}
{{--                                </div>--}}

{{--                                <div class="col-12">--}}
{{--                                    <img style="width:94px; height: 94px;" src="/vueimage/image1.png" alt="">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}


{{--                </div>--}}
{{--            </div>--}}




        </div>

    </div>
@endsection

@push('js')













    <script type="text/javascript">
         function  imageChange(image){
            // alert(image);
            $('#main_image').attr('src', image);
        }





        // var value = $('#quanity').val();
        //
        // $(document).ready(function() {
        //
        //     $("#quantityDecrease").click(function(){
        //         if(value <= 1){
        //             return;
        //         }else{
        //             value--;
        //         }
        //         $('#quanity').val(value);
        //     });
        //
        //
        //     $("#quantityIncrease").click(function(){
        //             value++;
        //         $('#quanity').val(value);
        //     });
        //
        // });

















    </script>

@endpush
