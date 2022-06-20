@extends('theme.prt.layouts.prtMaster')

@section('title')
    {{ env('APP_NAME_BIG') }}
@endsection
@section('meta')
@endsection

@push('css')
    <style>
        li.custom-design .active {
            background-color: #ff5722 !important;
            color: #fff !important;
        }

        #textDecoration a {
            list-style: none;
            text-decoration: none
        }

    </style>
@endpush

@section('contents')
    @include('alerts.alerts')
    <br>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="bg-white shadow rounded overflow-hidden">
                                <div class="px-4 pt-0 pb-4 cover"
                                    style="background-image: url({{ route('imagecache', ['template' => 'spci', 'filename' => $profile->ci()]) }}); background-size: cover; background-repeat: no-repeat;background-position: center center;">
                                    <div class="media align-items-end profile-head" style=" transform: translateY(5rem);">
                                        <div class="profile mr-3"><img
                                                src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->fi()]) }}"
                                                alt="..." width="130" class="rounded mb-2 img-thumbnail"><a
                                                href="javascript:void(0)"
                                                class="btn w3-deep-orange btn-sm btn-block">{{ ucfirst($profile->name) }}</a>
                                        </div>
                                        <div class="media-body mb-5 text-white">
                                            <h4 class="mt-0 mb-0">{{ ucfirst($profile->name) }}</h4>
                                            <p class="small mb-0"> <strong>SS:
                                                </strong></i>{{ $profile->workstation->title }}</p>
                                            <p class="small mb-4 mt-0"> <strong>Cat:
                                                </strong></i>{{ $profile->category->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-light p-4 d-flex justify-content-end text-center">
                                    @if ($business_type == 'shop')
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <h5 class="font-weight-bold mb-0 d-block">
                                                    {{ count($profile->products->where('status', 'approved')->where('active', true)) }}
                                                </h5>
                                                <small class="text-muted"> <i
                                                        class="fas fa-image mr-1"></i>Products</small>
                                            </li>
                                            @if (Auth::check() and $profile->user_id != Auth::id())

                                                <li class="list-inline-item">
                                                    <a
                                                        href=" {{ route('subscriber.allCartProducts', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }} ">
                                                        <h5 class="font-weight-bold mb-0 d-block"> {{ $cart ?? 0 }}</h5>
                                                        <small class="text-muted"> <i
                                                                class="fas fa-shopping-cart"></i>Cart</small>
                                                    </a>
                                                </li>

                                                @if ($my_orders->count() > 0)
                                                    <li class="list-inline-item">
                                                        <a
                                                            href="{{ route('subscriber.allOrdersOfServieProfileProducts', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }}">
                                                            <h5 class="font-weight-bold mb-0 d-block">
                                                                {{ $my_orders->count() }}</h5>
                                                            <small class="text-muted"> <i
                                                                    class="fas fa-user mr-1"></i>My
                                                                Orders</small>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endif
                                        </ul>
                                    @endif
                                </div>

                                <div class="px-4 py-3">
                                    @if ($business_type == 'shop')
                                        <div class="mb-3">
                                            @if ($profile->online_sale)
                                                <li class="list-inline-item">
                                                    <span><span class="text-success"><i class="fas fa-check"></i></span>
                                                        Online
                                                        Sale/Service</span>
                                                </li>
                                            @endif

                                            @if ($profile->offline_sale)
                                                <li class="list-inline-item">
                                                    <span><span class="text-success"><i class="fas fa-check"></i></span>
                                                        Offline
                                                        Sale/Service</span>
                                                </li>
                                            @endif
                                            @if ($profile->home_delivery)
                                                <li class="list-inline-item">
                                                    <span><span class="text-success"><i class="fas fa-truck"></i></span>
                                                        Home
                                                        Delivery Available</span>
                                                </li>
                                            @endif
                                        </div>
                                    @endif
                                    {{-- <h5 class="mb-2"><b>About</b></h5> --}}
                                    <div class="card">
                                        <div class="card-body">
                                            <p>{{ $profile->short_bio }}</p>
                                        </div>
                                    </div>
                                    <div class="addthis_inline_share_toolbox"></div>
                                </div>

                            </div>
                        </div>

                        <div class="card ">
                            <div class="card-body" style="background-color: #ccc">
                                @if ($business_type == 'shop')
                                @if (count($service_product) > 0)
                                    <div class="col-12">
                                        <div class="card card-widget">
                                            <div class="card-header"><b>Recent Products</b></div>
                                            <div class="card-body w3-light-gray">
                                                @forelse ($service_product->chunk(4)  as $item4)
                                                    <div class="row">
                                                        @foreach ($item4 as $item)
                                                            <div class="col-md-3 col-6">
                                                                <div class="card p-0">
                                                                    <div class="card-body p-0 text-center">
                                                                        <a class="w3-small"
                                                                            href="{{ route('welcome.productShare', ['product' => $item->id, 'reffer' => $subscription->subscription_code, 'profile' => $profile->id]) }}">
                
                                                                            <img src=" {{ route('imagecache', ['template' => 'pnism', 'filename' => $item->fi()]) }}"
                                                                                class="card-image img-fluid rounded-top w-100" alt=""
                                                                                srcset="">
                                                                        </a>
                                                                    </div>
                                                                    <div class="card-footer py-1 px-2">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <a class="w3-small"
                                                                                    href="{{ route('welcome.productShare', ['product' => $item->id, 'reffer' => $subscription->subscription_code, 'profile' => $profile->id]) }}">{{ Str::limit($item->name, 20, '..') }}</a>
                                                                            </div>
                                                                            <div class="col-md-12 ">
                                                                                <img width="20"
                                                                                    src=" {{ route('imagecache', ['template' => 'ppsm', 'filename' => $profile->fi()]) }}"
                                                                                    class="card-image img-circle border  img-fluid" alt=""
                                                                                    srcset="">
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
                                                                                                    href="{{ route('subscriber.addToCartProduct', ['profile' => $profile->id, 'product' => $item->id, 'subscription' => $subscription->subscription_code]) }}"><i
                                                                                                        class="fas fa-shopping-cart w3-text-gray"></i></a>
                                                                                            </p>
                                                                                        @endif
                
                                                                                        <p class="m-0">
                                                                                            <a
                                                                                                href="{{ route('subscriber.addWishlistServiceProfileProduct', ['product' => $item->id]) }}">
                
                                                                                                @if ($item->isMyWishlisted())
                                                                                                    <i class="fas fa-heart w3-text-red"></i>
                                                                                                @else
                                                                                                    <i
                                                                                                        class="fas fa-heart w3-text-gray"></i>
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
                                                    {{ $service_product->render() }}
                                                @empty
                                                @endforelse
                
                
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @elseif ($business_type== 'service')
                
                                <div class="row">
                                    @foreach ($service_items as $item)
                                        <div class="card mt-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <a
                                                            href="{{ route('welcome.serviceItemShare', ['profile' => $profile->id, 'reffer' => $subscription->subscription_code, 'item' => $item->id]) }}">
                                                            <img class="img-fluid"
                                                                src=" {{ route('imagecache', ['template' => 'pplg', 'filename' => $item->fi()]) }}"
                                                                alt="">
                                                        </a>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <h4 class="m-0 p-0 font-weight-bolder bb-2">
                                                            <a
                                                                href="{{ route('welcome.serviceItemShare', ['profile' => $profile->id, 'reffer' => $subscription->subscription_code, 'item' => $item->id]) }}">
                                                                {{ $item->title }}
                                                        </h4>
                                                        
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
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{ $service_items->render() }}
                            @endif
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
            

        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6187671346fae48e"></script>
@endpush
