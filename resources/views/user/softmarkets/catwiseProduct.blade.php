@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
            <div class="card card-primary">
                {{-- <div class="card-header w3-teal">
                    <h3 class="text-center">{{$category->name}} Products</h3>
                  
                        <a class="btn btn-default text-dark btn-sm" href="{{ route('user.catwiseShop', ['cat' => $category->id]) }}" >
                           {{$category->name}} Shops</a>
                 
                </div> --}}
                <div class="card-header">
                    <h3 class="card-title">
                        {{$category->name}} Products
                    </h3>
                    <div class="card-tools">
                        <a class="btn btn-warning text-dark btn-sm" href="{{ route('user.catwiseShop', ['cat' => $category->id]) }}" >
                            {{$category->name}} Shops</a>
                    </div>
                </div>
                
            </div>
            <form action="" class="py-3">
                <div class="input-group input-group-md" style="border-radius: 10px" >
                    <input type="text" data-url="{{ route('user.ServiceProductSearchAjax') }}"
                        class="form-control ajax-data-search" placeholder="Search Product">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary w3-border px-2">
                            <i class="fas fa-search "></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-body">
                    <div class="row" id="shop-data">
                        @include('user.allServiceProducts.serviceProductallAjax')
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
            {{-- <div class="row" id="showProduct">
                @include('user.allServiceProducts.serviceProductAjaxl')
            </div> --}}
            {{-- @forelse ($service_product->chunk(4)  as $item4)
                <div class="row">
                    @foreach ($item4 as $item)
                        <div class="col-md-3 col-6">
                            <div class="card p-0">
                                <div class="card-body p-0 text-center">
                                    <a class="w3-small"
                                    href="{{ route('welcome.productShare', ['profile' => $item->service_profile_id, 'product' => $item->id, 'reffer' => $item->subscription->subscription_code]) }}">
                                    <img src=" {{ route('imagecache', ['template' => 'pnism', 'filename' => $item->fi()]) }}"
                                    class="card-image img-fluid rounded-top w-100" alt="" srcset="">    
                                </a>
                                    
                                </div>
                                <div class="card-footer py-1 px-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a class="w3-small"
                                                href="{{ route('welcome.productShare', ['profile' => $item->service_profile_id, 'product' => $item->id, 'reffer' => $item->subscription->subscription_code]) }}">{{ Str::limit($item->name, 20, '..') }}</a>
                                        </div>
                                        <div class="col-md-12 ">
                                            <img width="20"
                                                src=" {{ route('imagecache', ['template' => 'ppsm', 'filename' => $item->fi()]) }}"
                                                class="card-image img-circle border  img-fluid" alt="" srcset="">
                                            @if ($item->sale_price)
                                                <span class="w3-small w3-text-deep-orange">BDT
                                                    {{ $item->sale_price }}</span>

                                                @if ($item->deleted_price) <span class="w3-tiny w3-text-gray"> <del>{{ $item->deleted_price }}</del></span>@endif
                                            @endif
                                        </div>

                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between mt-1">
                                                @if ($item->user_id != Auth::id())
                                                    @if ($item->sale_price)
                                                        <p class="m-0"><a id="toggle"
                                                                href="{{ route('user.serviceProductsCheckForAddToCart', ['profile' => $item->service_profile_id, 'product' => $item->id, 'type' => 'carttostore']) }}"><i
                                                                    class="fas fa-shopping-cart w3-text-gray"></i></a>
                                                        </p>
                                                    @endif
                                                    <p class="m-0">
                                                        <a
                                                            href="{{ route('subscriber.addWishlistServiceProfileProduct', ['product' => $item->id]) }}">

                                                            @if ($item->isMyWishlisted())
                                                                <i class="fas fa-heart w3-text-red"></i>
                                                            @else
                                                                <i class="fas fa-heart w3-text-gray"></i>
                                                            @endif


                                                        </a>
                                                    </p>
                                                    <p class="m-0">
                                                        <a
                                                            href="{{ route('user.addTofavourite', ['typeid' => $item->id,'type'=>'service_product']) }}">
    
                                                            @if ($item->isMyFavourite())
                                                                <i class="fas fa-save w3-text-red"></i>
                                                            @else
                                                                <i class="fas fa-save w3-text-gray"></i>
                                                            @endif
    
    
                                                        </a>
                                                    </p>
                                                @endif
                                                

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
              
            @empty
        
            @endforelse --}}

            {{-- {{ $service_product->render() }} --}}

        </div><!-- /.container-fluid -->



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
    <script>
        $(function() {

            var delay = (function() {
                var timer = 0;
                return function(callback, ms) {
                    clearTimeout(timer);
                    timer = setTimeout(callback, ms);
                };
            })();


            //////////////////////
            $(document).on('keypress', '.ajax-data-search', function(e) {
                if (e.which == 13) {
                    e.preventDefault();
                }
            });
            //////////////////////
            $(document).on("keyup", ".ajax-data-search", function(e) {
                e.preventDefault();
                var that = $(this);
                var q = e.target.value;
                var url = that.attr("data-url");
                var urls = url + '?q=' + q;
               delay(function(){
                $.ajax({
                    url:urls,
                    type:'GET',
                    success:function(r){
                        $('#showProduct').html(r.page);
                       // console.log(r.page);
                    }
                });
               },500);
                // $.ajax({
                //     url: urls,
                //     type: 'GET',
                //     // cache: false,
                //     // dataType: 'json',
                //     success: function(response) {
                //         alert(response.q);
                //         alert("JHELLO");
                //     },
                //     error: function() {}


                // });
                // delay(function() {
                //     $.ajax({
                //         url: urls,
                //         type: 'GET',
                //         cache: false,
                //         dataType: 'json',
                //         success: (function(res) {
                //                 alert("dsafasdf");
                //             }

                //         }));

                // }, 400);



            });
            ////////////////////admin search end //////////////////
            $(document).on('click', '.ajax-pagination-area .pagination li a', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');

                $.ajax({
                    url: url,
                    type: 'GET',
                    cache: false,
                    dataType: 'json',
                    success: function(response) {
                        $(".ajax-data-container").empty().append(response.page);
                    },
                    error: function() {}
                });

            });

        });
    </script>
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
                        var notFoundMsg= '<p class="text-danger text-center h4 font-weight-bolder">No more product found</p>'
                       $('.ajax-load').html(notFoundMsg);
                        // alert(a);
                        return;
                    }

                    $('.ajax-load').fadeOut();
                    // $('.hideSho').fadeOut();
                    $("#shop-data").append(data.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                   // alert('server not responding...');
                });
        }
    </script>

@endpush
