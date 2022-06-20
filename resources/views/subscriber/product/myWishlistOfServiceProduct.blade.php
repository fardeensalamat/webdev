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
                    <h3 class="text-center">My Wishlists</h3>
                </div>
            </div>
            @if ($wishlists)
                @forelse ($wishlists->chunk(4)  as $item4)
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
                                                <a class="w3-small"
                                                    href="{{ route('user.serviceProductsCheckForAddToCart', ['product' => $item->product->id, 'profile' => $item->product->serviceProfile->id, 'type' => 'url']) }}">{{ Str::limit($item->product->name, 20, '..') }}</a>
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
                                                            <p class="m-0"><a id="toggle"
                                                                    href="{{ route('user.serviceProductsCheckForAddToCart', ['product' => $item->product->id, 'profile' => $item->product->serviceProfile->id, 'type' => 'cart']) }}"><i
                                                                        class="fas fa-shopping-cart w3-text-gray"></i></a>
                                                            </p>
                                                        @endif

                                                        <p class="m-0">
                                                            <a
                                                                href="{{ route('subscriber.addWishlistServiceProfileProduct', ['product' => $item->product->id]) }}">

                                                                @if ($item->product->isMyWishlisted())
                                                                    <i class="fas fa-heart w3-text-red"></i>
                                                                @else
                                                                    <i class="fas fa-heart w3-text-gray"></i>
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
                    {{ $wishlists->render() }}
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
