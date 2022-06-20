@extends('subscriber.layouts.userMaster')

@push('css')
    <style>
        /* .profile-head {
                                                    transform: translateY(5rem)
                                                } */

        /* .cover {
                                                    background-image: url(https://images.unsplash.com/photo-1530305408560-82d13781b33a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80);
                                                    background-size: cover;
                                                    background-repeat: no-repeat
                                                } */


        /* body {
                                                    background: #654ea3;
                                                    background: linear-gradient(to right, #e96443, #904e95);
                                                    min-height: 100vh;
                                                    overflow-x: hidden
                                                } */
        li.custom-design .active {
            background-color: #ff5722 !important;
            color: #fff !important;
        }

    </style>


@endpush
@section('content')
    <br>
    <section class="content">
        <div class="row">

            @if ($profile->category->sp_order)
                <div class="col-md-10 m-auto">
                    @include('alerts.alerts')
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
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <h5 class="font-weight-bold mb-0 d-block">
                                            {{ count($profile->products->where('status', 'approved')->where('active', true)) }}
                                        </h5>
                                        <small class="text-muted"> <i class="fas fa-image mr-1"></i>Products</small>
                                    </li>
                                    {{-- <li class="list-inline-item">
                                        <a href="{{ route('user.addTofavourite', ['typeid' => $item->id,'type'=>'service_product']) }}">
                                            @if ($profile->isMyFavourite())
                                                <i class="fas fa-save w3-text-red"></i>
                                            @else
                                                <i class="fas fa-save w3-text-gray"></i>
                                            @endif
                                        </a>
                                    </li> --}}

                                    <li class="list-inline-item">
                                        <a
                                            href="{{ route('user.addTofavourite', ['typeid' => $profile->id, 'type' => 'service_profile']) }}">
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
                                            <a
                                                href=" {{ route('subscriber.allCartProducts', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }} ">
                                                <h5 class="font-weight-bold mb-0 d-block"> {{ $cart }}</h5><small
                                                    class="text-muted"> <i class="fas fa-shopping-cart"></i>Cart</small>
                                            </a>
                                        </li>
                                    @endif

                                    @if ($my_order_count > 0)
                                        <li class="list-inline-item">
                                            <a
                                                href="{{ route('subscriber.allOrdersOfServieProfileProducts', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }}">
                                                <h5 class="font-weight-bold mb-0 d-block">{{ $my_order_count }}</h5>
                                                <small class="text-muted"> <i class="fas fa-user mr-1"></i>My
                                                    Orders</small>
                                            </a>

                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="px-4 py-3">
                                <div class="mb-3">
                                    <li class="list-inline-item">
                                        @if ($profile->package_status == 'regular')
                                            <span class=""><img title="Regular"
                                                    src="{{ asset('img/badge/regular.png') }}" width="30px"
                                                    alt="" srcset=""></span>
                                        @elseif ($profile->package_status == 'golden')
                                            <span class=""><img title="Golden"
                                                    src="{{ asset('img/badge/golden.png') }}" width="30px"
                                                    alt="" srcset=""></span>
                                        @elseif ($profile->package_status == 'merchant')
                                            <span class=""><img title="Merchant"
                                                    src="{{ asset('img/badge/merchant.png') }}" width="30px"
                                                    alt="" srcset=""></span>
                                        @else
                                            <span class=""><img title="Free"
                                                    src="{{ asset('img/badge/free.png') }}" width="30px"
                                                    alt="" srcset=""></span>
                                        @endif
                                    </li>
                                    <li class="list-inline-item">
                                        @if ($profile->open)
                                           <span title="Shop/Service Open" class="text-success p-2"><i class="fas fa-check"></i> Open</span>
                                            @else
                                            <span title="Shop/Service Closed" class="text-danger p-2"><i class="fas fa-times"></i> Closed</span>
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
                                </div>
                                {{-- <h5 class="mb-2"><b>About</b></h5> --}}
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item custom-design">
                                        <a class="nav-link active" id="nav-contact-tab" data-toggle="tab"
                                            href="#nav-contact" role="tab" aria-controls="nav-contact "
                                            aria-selected="false">About</a>
                                    </li>
                                    <li class="nav-item custom-design">
                                        <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab"
                                            aria-controls="home" aria-selected="true">Legal Information</a>
                                    </li>
                                    <li class="nav-item custom-design">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                            role="tab" aria-controls="profile" aria-selected="false">Communication</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="nav-contact" role="tabpanel"
                                        aria-labelledby="nav-contact-tab">
                                        <div class="p-4 rounded shadow-sm bg-light">
                                            {{ $profile->short_bio }}
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                    <div class="addthis_inline_share_toolbox"></div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="card card-widget">
                        <div class="card-header"><b>Recent Products</b></div>
                        <div class="card-body w3-light-gray">
                            @if ($service_product)
                                @include('subscriber.includeProduct.productCard')

                            @endif

                        </div>
                    </div>
                </div>
            @else

                <div class="col-md-8 m-auto">
                    <div class="card card-default">
                        <div class="card-header"
                            style="background-color: {{ $profile->category ? $profile->category->sp_header_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->sp_header_text_color : '' }}">
                            <div class="d-flex justify-content-between">
                                <p class="m-0">{{ ucfirst($profile->name) }} ({{ $profile->id }}) Details
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

                                            <p><b>{{ $value->profile_info_key }}</b>: {{ $value->profile_info_value }}
                                            </p>

                                        @elseif($value->field_type == 'text')

                                            <p><b>{{ $value->profile_info_key }}</b>:</p>
                                            {!! $value->profile_info_value !!}

                                        @elseif($value->field_type == 'integer')

                                            <p><b>{{ $value->profile_info_key }}</b>: {{ $value->profile_info_value }}
                                            </p>

                                        @elseif($value->field_type == 'float')

                                            <p><b>{{ $value->profile_info_key }}</b>: {{ $value->profile_info_value }}
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
                                        </div>
                                    </div>
                                </div>
                            @endif


                        </div>


                    </div>
                    <div class="card-footer"
                        style="background-color: {{ $profile->category ? $profile->category->sp_footer_bg_color : '' }}!important;color: {{ $profile->category ? $profile->category->sp_footer_text_color : '' }}">
                        <p>© Copyright {{ date('Y') }} | {{ $_SERVER['SERVER_NAME'] }}</p>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
