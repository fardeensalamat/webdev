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
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-center">My All Carts</h3>
                </div>
            </div>
            @if ($carts)
                @forelse ($carts->chunk(4)  as $item4)
                    <div class="row">
                        @foreach ($item4 as $item)
                            <div class="col-md-3 col-6">
                                <div class="card p-0">
                                    <div class="card-body p-0 text-center">
                                        <a href="{{ route('user.serviceProductsCheckForAddToCart', ['product' => $item->product->id, 'profile' => $item->product->serviceProfile->id, 'type' => 'url']) }}">
                                            <img src=" {{ route('imagecache', ['template' => 'pnism', 'filename' => $item->product->fi()]) }}"
                                            class="card-image img-fluid rounded-top w-100" alt="" srcset="">
                                        </a>
                                    </div>
                                    <div class="card-footer py-1 px-2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{-- <a class="w3-small"
                                                    href="{{ route('user.serviceProductsCheckForAddToCart', ['product' => $item->product->id, 'profile' => $item->product->serviceProfile->id, 'type' => 'url']) }}">{{ Str::limit($item->product->name, 20, '..') }}</a> --}}
                                                    <a class="w3-small"
                                                    href="{{ route('user.serviceProductsCheckForAddToCart', ['product' => $item->product->id, 'profile' => $item->product->serviceProfile->id, 'type' => 'cart']) }}">{{ Str::limit($item->product->name, 20, '..') }}</a>

                                                    
                                            </div>
                                            <div class="col-md-12 ">
                                                <img width="20"
                                                    src=" {{ route('imagecache', ['template' => 'ppsm', 'filename' => $item->product->fi()]) }}"
                                                    class="card-image img-circle border  img-fluid" alt="" srcset="">
                                                @if ($item->product->sale_price)
                                                    <span class="w3-small w3-text-deep-orange">BDT
                                                        {{ $item->sale_price }}</span>

                                                    @if ($item->product->deleted_price) <span class="w3-tiny w3-text-gray"> <del>{{ $item->product->deleted_price }}</del></span>@endif
                                                @endif

                                            </div>

                                            <div class="col-md-12">
                                                <div class="d-flex justify-content-between mt-1">
                                                    @if ($item->product->user_id != Auth::id())
                                                        @if ($item->product->sale_price)
                                                            <p class="m-0"><a id="toggle"  data-toggle="tooltip" title="View Shop" class="btn btn-outline-info btn-long "
                                                                    href="{{ route('user.serviceProductsCheckForAddToCart', ['product' => $item->product->id, 'profile' => $item->product->serviceProfile->id, 'type' => 'carttostore']) }}">Shop</a>
                                                            </p>
                                                        @endif
                                                        @if ($item->product->sale_price)
                                                            <p class="m-0">
                                                                <a id="toggle" data-toggle="tooltip" title="Checkout" class="btn btn-outline-success btn-long "
                                                                    href="{{ route('subscriber.addToCartProduct', ['profile' => $item->product->serviceProfile->id, 'product' => $item->product->id, 'subscription' =>$item->product->subscription->subscription_code,'buynow' => 'b']) }}">
                                                                    Checkout
                                                                </a>
                                                            </p>
                                                         @endif

                                                        <p class="m-0">
                                                            <a data-toggle="tooltip" title="Delete" class="btn btn-outline-danger btn-long " onclick="return confirm('Are you sure? You want to delete this product from your cart?')" href="{{ route('subscriber.deleteCartProduct',['cart'=>$item->id,'profile'=>$item->product->serviceProfile->id,'subscription'=>$item->product->subscription->subscription_code]) }}">Delete</a>
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
                    {{ $carts->render() }}
                @empty
                <h1 class="text-danger text-center">No Wishlist Found</h1>
                @endforelse

            @endif
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

@endpush
