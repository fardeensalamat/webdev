@forelse ($service_product->chunk(4)  as $item4)
    <div class="row">
        @foreach ($item4 as $item)
            <div class="col-md-3 col-6">
                <div class="card p-0">
                    <div class="card-body p-0 text-center">
                        <a class="w3-small"
                        
                            {{-- href="{{ route('subscriber.viewServiceProfileProduct', ['product' => $item->id, 'subscription' => $subscription->subscription_code, 'profile' => $profile->id]) }}"> --}}
                                    href="{{ route('welcome.productShare', ['profile' => $profile->id, 'product' => $item->id, 'reffer' => $subscription->subscription_code]) }}">
                            <img src=" {{ route('imagecache', ['template' => 'pnism', 'filename' => $item->fi()]) }}"
                                class="card-image img-fluid rounded-top w-100" alt="" srcset="">
                        </a>
                    </div>
                    <div class="card-footer py-1 px-2">
                        <div class="row">
                            <div class="col-md-12">
                                <a class="w3-small"
                                    href="{{ route('welcome.productShare', ['profile' => $profile->id, 'product' => $item->id, 'reffer' => $subscription->subscription_code]) }}">{{ Str::limit($item->name, 20, '..') }}</a>
                            </div>
                            <div class="col-md-12 ">
                                <img width="20"
                                    src=" {{ route('imagecache', ['template' => 'ppsm', 'filename' => $profile->fi()]) }}"
                                    class="card-image img-circle border  img-fluid" alt="" srcset="">
                                @if ($item->sale_price)
                                    <span class="w3-small w3-text-deep-orange">SCB
                                        {{ $item->sale_price }}</span>

                                    @if ($item->deleted_price) <span class="w3-tiny w3-text-gray"> <del>{{ $item->deleted_price }}</del></span>@endif
                                @endif

                            </div>

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
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $service_product->render() }}
@empty
@endforelse
