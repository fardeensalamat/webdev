@forelse ($service_product as $item)
<div class="col-md-3 col-6">
    <div class="card p-0">
        <div class="card-body p-0 text-center">
            <a class="w3-small"
            {{-- href="{{ route('user.serviceProductsCheckForAddToCart', ['profile' => $item->service_profile_id, 'product' => $item->id, 'type' => 'url']) }}"> --}}
            href="{{ route('welcome.profileShare', ['profile' =>$item->service_profile_id, 'reffer' =>  $item->subscription->subscription_code]) }}"
            {{-- href="{{ route('welcome.productShare', ['profile' => $item->service_profile_id, 'product' => $item->id, 'reffer' => $item->subscription->subscription_code]) }}" --}}
            >
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
                            {{-- @if ($item->sale_price)
                                <p class="m-0"><a id="toggle" data-toggle="tooltip" title="Add To Cart"
                                        href="{{ route('user.serviceProductsCheckForAddToCart', ['profile' => $item->service_profile_id, 'product' => $item->id, 'type' => 'carttostore']) }}"><i
                                            class="fas fa-shopping-cart w3-text-gray"></i></a>
                                </p>
                            @endif --}}
                            @if ($item->sale_price)
                                @if ($item->stock>0)
                                    <p class="m-0"><a id="toggle" data-toggle="tooltip" title="Add To Cart"
                                            href="{{ route('subscriber.addToCartProduct', ['profile' => $item->service_profile_id, 'product' => $item->id, 'subscription' =>$item->subscription->subscription_code,'buynow' => 'c']) }}"><i
                                                class="fas fa-shopping-cart w3-text-gray" style='font-size:18px'></i></a>
                                    </p>
                                @endif
                            @endif
                            @if ($item->sale_price)
                            @if ($item->stock>0)
                                <p class="m-0">
                                    <a id="toggle" data-toggle="tooltip" title="Buy Now" class="btn btn-outline-dark btn-sm "
                                        href="{{ route('subscriber.addToCartProduct', ['profile' => $item->service_profile_id, 'product' => $item->id, 'subscription' =>$item->subscription->subscription_code,'buynow' => 'b']) }}">
                                        Buy Now
                                    </a>
                                </p>
                            @endif
                            @endif
                            <p class="m-0">
                                <a data-toggle="tooltip" title="Add To Wishlist"
                                    href="{{ route('subscriber.addWishlistServiceProfileProduct', ['product' => $item->id]) }}">

                                    @if ($item->isMyWishlisted())
                                        <i class="fas fa-heart w3-text-red" style='font-size:18px'></i>
                                    @else
                                        <i class="fas fa-heart w3-text-gray" style='font-size:18px'></i>
                                    @endif


                                </a>
                            </p>
                            {{-- <p class="m-0">
                                <a data-toggle="tooltip" title="Add To Favourite"
                                    href="{{ route('user.addTofavourite', ['typeid' => $item->id,'type'=>'service_product']) }}">

                                    @if ($item->isMyFavourite())
                                        <i class="fas fa-save w3-text-red"></i>
                                    @else
                                        <i class="fas fa-save w3-text-gray"></i>
                                    @endif


                                </a>
                            </p> --}}
                        @endif
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-md-12 m-auto ">
<h1 class="text-danger text-center">No Product Found</h1>
</div>
@endforelse