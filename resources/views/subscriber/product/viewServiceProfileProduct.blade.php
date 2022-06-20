@extends('subscriber.layouts.userMaster')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/lightslider/lightslider.css') }}">
    <style>
        .card {
            background-color: #fff;
            padding: 14px;
            border: none
        }

        .demo {
            width: 100%
        }

        img {
            display: block;
            height: auto;
            width: 100%
        }

        hr {
            color: #d4d4d4
        }

        .badge {
            padding: 5px !important;
            padding-bottom: 6px !important
        }

        .badge i {
            font-size: 10px
        }

        .profile-image {
            width: 35px
        }

        .comment-ratings i {
            font-size: 13px
        }

        .username {
            font-size: 12px
        }

        .comment-profile {
            line-height: 17px
        }

        .store-image {
            width: 42px
        }

        .dot {
            height: 10px;
            width: 10px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px
        }

        .bullet-text {
            font-size: 12px
        }

        .my-color {
            margin-top: 10px;
            margin-bottom: 10px
        }

        label.radio {
            cursor: pointer
        }

        label.radio input {
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
            pointer-events: none
        }

        label.radio span {
            border: 2px solid #8f37aa;
            display: inline-block;
            color: #8f37aa;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-transform: uppercase;
            transition: 0.5s all
        }

        label.radio .red {
            background-color: red;
            border-color: red
        }

        label.radio .blue {
            background-color: blue;
            border-color: blue
        }

        label.radio .green {
            background-color: green;
            border-color: green
        }

        label.radio .orange {
            background-color: orange;
            border-color: orange
        }

        label.radio input:checked+span {
            color: #fff;
            position: relative
        }

        label.radio input:checked+span::before {
            opacity: 1;
            content: '\2713';
            position: absolute;
            font-size: 13px;
            font-weight: bold;
            left: 4px
        }

        .card-body {
            padding: 0.3rem 0.3rem 0.2rem
        }

    </style>

@endpush

@section('content')
    <br>
    <section class="content">
        <div class="card card-solid">
            @include('alerts.alerts')
            <div class="container-fluid mt-2 mb-3">
                <div class="row no-gutters">
                    <div class="col-md-5 pr-2">
                        <div class="card">
                            <div class="demo">
                                <ul id="lightSlider">
                                    <li
                                        data-thumb="{{ route('imagecache', ['template' => 'pplg', 'filename' => $product->fi()]) }}">
                                        <img
                                            src="{{ route('imagecache', ['template' => 'pplg', 'filename' => $product->fi()]) }}" />
                                    </li>
                                    @if ($product->galary_image)
                                        @foreach ($product->galary_image as $key => $galary_image)

                                            <li
                                                data-thumb="{{ route('imagecache', ['template' => 'pplg', 'filename' => $galary_image->img_name]) }}">
                                                <img
                                                    src="{{ route('imagecache', ['template' => 'pplg', 'filename' => $galary_image->img_name]) }}" />
                                            </li>


                                        @endforeach

                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="about">
                                <span class="font-weight-bold h2">{{ $product->name }} </span>

                                @if ($product->sale_price)
                                    <h4 class="font-weight-bold">{{ $product->sale_price }} TK </h4>
                                    <del class="text-danger">{{ $product->deleted_price }}</del>
                                @endif

                            </div>

                            <div class="product-description">
                                <div><span class="font-weight-bold">Seller:</span><span><a
                                            href="{{ route('subscriber.findProfileDetails', ['subscription' => $subscription->subscription_code, 'profile' => $product->service_profile_id]) }}">{{ $product->serviceProfile->name }}</a></span>
                                </div>
                                @if ($product->max_delivery_days)
                                    <label for="" class="bg-info p-1 rounded my-1"><i class="fa fa-calendar-check-o"></i>
                                        Delivery Maximum in
                                        {{ $product->max_delivery_days }} Days</label>
                                @endif
                                @if ($product->replace_guaranty)
                                    <label for="" class="w3-deep-orange p-1 price"> <i class="fas fa-check-circle"></i>
                                        Replacement Guaranteed</label>
                                @endif
                                <div class="mt-2">
                                    <p>{!! Str::substr(html_entity_decode($product->description), 0, 400) !!}
                                    </p>
                                </div>
                                <div class="d-flex flex-row align-items-center"><img
                                        src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $product->serviceProfile->img_name]) }}"
                                        class="rounded-circle store-image shadow">
                                    <div class="d-flex flex-column ml-1 comment-profile">
                                        <div class="comment-ratings"> {{ $product->category->name }} </div> <span
                                            class="username font-weigth-bold"> <a class="font-weigth-bold"
                                                href="{{ route('subscriber.findProfileDetails', ['subscription' => $subscription->subscription_code, 'profile' => $product->service_profile_id]) }}">{{ $product->serviceProfile->name }}</a>
                                        </span> <span class="">{{ $product->workstation->title }}</span>
                                    </div>
                                </div>

                            </div>
                            @if ($product->user_id != Auth::id())

                                <div class="mt-3">
                                    @if ($product->sale_price)
                                        <a class="btn btn-outline-warning btn-long "
                                            href="{{ route('subscriber.addToCartProduct', ['profile' => $product->serviceProfile, 'product' => $product->id, 'subscription' => $subscription->subscription_code]) }}">Add
                                            to Cart</a>
                                    @endif
                                    <a href="{{ route('subscriber.addWishlistServiceProfileProduct', ['product' => $product->id]) }}"
                                        class="btn btn-warning btn-long buy">

                                        @if ($product->isMyWishlisted())
                                            <i class="fas text-danger fa-heart fa-lg mr-2"></i>
                                        @else
                                            <i class="fas fa-heart fa-lg mr-2"></i>
                                        @endif
                                        Add to Wishlist
                                    </a>
                                </div>
                            @endif
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <div class="row mt-4">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc"
                                role="tab" aria-controls="product-desc" aria-selected="true">Description</a>

                        </div>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="product-desc" role="tabpanel"
                            aria-labelledby="product-desc-tab"> {!! html_entity_decode($product->description) !!} </div>

                    </div>
                </div>

                @if (count($related_product) > 0)
                    <div class="card mt-2"> <span class="h4">Similar items:</span>
                        <div class="similar-products mt-2 d-flex flex-row">
                            @foreach ($related_product->take(4) as $item)
                                <div class="card border p-1" style="width: 9rem;margin-right: 3px;">
                                    <a
                                        href="{{ route('subscriber.viewServiceProfileProduct', ['product' => $item->id, 'subscription' => $subscription->subscription_code, 'profile' => $item->serviceProfile->id]) }}"><img
                                            src="{{ route('imagecache', ['template' => 'pnism', 'filename' => $item->fi()]) }}"
                                            class="card-img-top" alt="..."></a>

                                    <div class="card-body p-0">
                                        <a
                                            href="{{ route('subscriber.viewServiceProfileProduct', ['product' => $item->id, 'subscription' => $subscription->subscription_code, 'profile' => $item->serviceProfile->id]) }}"><b
                                                class="">{{ $item->name }}</b>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/lightslider/lightslider.js') }}"></script>
    <script>
        $('.product-image-thumb').on('click', function() {

            $('.product-image-thumb').removeClass('active');
            var d = $(this).addClass('active');
            var img = $(this).attr('src');
            $('.product-image').attr('src', img);

        });
        $('#lightSlider').lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            slideMargin: 0,
            thumbItem: 9
        });
    </script>
@endpush
