@forelse ( $shops as  $cat )
<div class="col-md-3">
    <div class="card card-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header "
            style="background-image: url({{ route('imagecache', ['template' => 'pfism', 'filename' => $cat->ci()]) }}); background-size: cover; background-repeat: no-repeat;background-position: center center;">

            {{-- <h5 class="widget-user-desc">Founder & CEO</h5> --}}
        </div>
        <div class="widget-user-image">
            <a
                href="{{ route('welcome.profileShare', ['profile' => $cat->id, 'reffer' => $cat->ownerSubscription->subscription_code]) }}">
                <img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $cat->fi()]) }}" alt="..."
                    width="120" class="mb-2  elevation-2 img-circle">
            </a>
        </div>
        <div class="card-footer mt-0 pt-0" style="padding-top: 75px !important">
            <h4 class="widget-user-username"><a class="font-weight-bold"
                    href="{{ route('welcome.profileShare', ['profile' => $cat->id, 'reffer' => $cat->ownerSubscription->subscription_code]) }}">{{ custom_title(ucfirst($cat->name), 30) }}..</a>
            </h4>

            <div class="bg-light">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a class="addTofavourite"
                            href="{{ route('user.addTofavourite', ['typeid' => $cat->id, 'type' => 'service_profile']) }}">
                            <h5 class="font-weight-bold mb-0 d-block">
                                @if ($cat->isMyFavourite())
                                    <i class="fas fa-save w3-text-red"></i>
                                @else
                                    <i class="fas fa-save w3-text-gray color"></i>
                                @endif
                            </h5>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        @if ($cat->open)
                            <span class="text-success p-2"><i class="fas fa-check"></i> Open</span>
                        @else
                            <span class="text-danger p-2"><i class="fas fa-times"></i> Closed</span>
                        @endif
                    </li>
                    <li class="list-inline-item">
                        {{-- @if ($cat->package_status == 'regular')
                            <span class=""><img title="Regular"
                                    src="{{ asset('img/badge/regular.png') }}" width="30px" alt="" srcset=""></span>
                        @elseif ($cat->package_status == 'golden')
                            <span class=""><img title="Golden"
                                    src="{{ asset('img/badge/golden.png') }}" width="30px" alt="" srcset=""></span>
                        @elseif ($cat->package_status == 'merchant')
                            <span class=""><img title="Merchant"
                                    src="{{ asset('img/badge/merchant.png') }}" width="30px" alt="" srcset=""></span>
                        @else
                            <span class=""><img title="Free" src="{{ asset('img/badge/free.png') }}"
                                    width="30px" alt="" srcset=""></span>
                        @endif --}}
                        @if ($cat->paystatus == true)
                            <span class=""><img title="Regular"
                                    src="{{ asset('img/badge/paid.png') }}" width="30px" alt="" srcset=""></span>
                        @else
                        <span class=""><img title="Free" src="{{ asset('img/badge/free.png') }}"
                            width="30px" alt="" srcset=""></span>

                        @endif

                    </li>

                </ul>
            </div>
            <div class=" pt-2">
                <p class="small mb-0"> <strong>Total Item:
                </strong>{{ $cat->activeServiceCount() }}
            </p>
                <p class="small mb-0"> <strong>SS:
                    </strong>{{ $cat->workstation ? $cat->workstation->title : '' }}
                </p>
                <p class="small mb-4 mt-0"> <strong>Cat:
                    </strong>{{ $cat->category->name }}</p>

                @if ($cat->distance)
                    <p class="small mb-4 mt-0">
                        <strong>Distance: </strong>{{ number_format($cat->distance, 3, '.', '') }} KM
                    </p>
                @endif
            </div>
            <!-- /.row -->
        </div>
    </div>
</div>
{{-- <div class="col-md-3">
    <div class="card">
        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 cover"
                style="background-image: url({{ route('imagecache', ['template' => 'pfism', 'filename' => $cat->ci()]) }}); background-size: cover; background-repeat: no-repeat;background-position: center center;">
                <div class="media align-items-end profile-head" style=" transform: translateY(5rem);">
                    <div class=" mr-3">
                        <a
                            href="{{ route('welcome.profileShare', ['profile' => $cat->id, 'reffer' => $cat->ownerSubscription->subscription_code]) }}">

                            <img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $cat->fi()]) }}"
                                alt="..." width="130" class="mb-2 img-thumbnail" @if (!$cat->category->sp_order) style="border-radius: 50% !important" @endif>
                        </a>

                        <a href="{{ route('welcome.profileShare', ['profile' => $cat->id, 'reffer' => $cat->ownerSubscription->subscription_code]) }}"
                            class="btn w3-purple btn-sm btn-block">{{ custom_title(ucfirst($cat->name), 15) }}</a> 
                    </div>


                </div>
            </div>
            <div class="bg-light p-2 d-flex justify-content-end text-center">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">
                            {{ count($cat->products->where('status', 'approved')->where('active', true)) }}
                        </h5>
                        <small class="text-muted"> <i class="fas fa-image mr-1"></i>Products</small>
                    </li>
                </ul>
            </div>
            <div class="bg-light px-3">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a class="addTofavourite"
                            href="{{ route('user.addTofavourite', ['typeid' => $cat->id, 'type' => 'service_profile']) }}">
                            <h5 class="font-weight-bold mb-0 d-block">
                                @if ($cat->isMyFavourite())
                                    <i class="fas fa-save w3-text-red"></i>
                                @else
                                    <i class="fas fa-save w3-text-gray color"></i>
                                @endif
                            </h5>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        @if ($cat->open)
                            <span class="text-success p-2"><i class="fas fa-check"></i> Open</span>
                        @else
                            <span class="text-danger p-2"><i class="fas fa-times"></i> Closed</span>
                        @endif
                    </li>
                    <li class="list-inline-item">
                        @if ($cat->package_status == 'regular')
                            <span class=""><img title="Regular"
                                    src="{{ asset('img/badge/regular.png') }}" width="30px" alt="" srcset=""></span>
                        @elseif ($cat->package_status == 'golden')
                            <span class=""><img title="Golden"
                                    src="{{ asset('img/badge/golden.png') }}" width="30px" alt="" srcset=""></span>
                        @elseif ($cat->package_status == 'merchant')
                            <span class=""><img title="Merchant"
                                    src="{{ asset('img/badge/merchant.png') }}" width="30px" alt=""
                                    srcset=""></span>
                        @else
                            <span class=""><img title="Free" src="{{ asset('img/badge/free.png') }}"
                                    width="30px" alt="" srcset=""></span>
                        @endif
                    </li>

                </ul>
            </div>
            <div class="px-4 py-3">
                <div class="mb-3">
                    @if ($cat->online_sale)
                        <li class="list-inline-item">
                            <span><span class="text-success"><i class="fas fa-check"></i></span> Online Sale</span>
                        </li>
                    @endif

                    @if ($cat->offline_sale)
                        <li class="list-inline-item">
                            <span><span class="text-success"><i class="fas fa-check"></i></span> Offline
                                Sale</span>
                        </li>
                    @endif
                    @if ($cat->home_delivery)
                        <li class="list-inline-item">
                            <span><span class="text-success"><i class="fas fa-check"></i></span> Home
                                Delivery</span>
                        </li>
                    @endif
                </div>
                <p class="small mb-0"> <strong>SS:
                    </strong>{{ $cat->workstation ? $cat->workstation->title : '' }}
                </p>
                <p class="small mb-4 mt-0"> <strong>Cat:
                    </strong>{{ $cat->category->name }}</p>

                @if ($cat->distance)
                    <p class="small mb-4 mt-0">
                        <strong>Distance: </strong>{{ number_format($cat->distance, 3, '.', '') }} KM
                    </p>
                @endif


            </div>
        </div>
    </div>
</div> --}}

    {{-- <div class="col-md-3">
        <div class="card">
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover"
                    style="background-image: url({{ route('imagecache', ['template' => 'pfism', 'filename' => $cat->ci()]) }}); background-size: cover; background-repeat: no-repeat;background-position: center center;">
                    <div class="media align-items-end profile-head"
                        style=" transform: translateY(5rem); border-redius:50%;">
                        <div class="profile mr-3">
                            <a
                                href="{{ route('welcome.profileShare', ['profile' => $cat->id, 'reffer' => $cat->ownerSubscription->subscription_code]) }}">

                                <img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $cat->fi()]) }}"
                                    alt="..." width="130" class="mb-2 img-thumbnail"
                                    style="border-radius: 50% !important">
                            </a>

                            <a href="{{ route('welcome.profileShare', ['profile' => $cat->id, 'reffer' => $cat->ownerSubscription->subscription_code]) }}"
                                class="btn w3-purple btn-sm btn-block">{{ custom_title(ucfirst($cat->name), 15) }}</a>
                        </div>


                    </div>
                </div>
                <div class="bg-light p-2 d-flex justify-content-end text-center">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">
                                {{ $cat->activeServiceCount() }}
                            </h5>
                            <small class="text-muted"> <i class="fas fa-image mr-1"></i>Items</small>
                        </li>
                    </ul>
                </div>
                <div class="bg-light px-3">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a class="addTofavourite"
                                href="{{ route('user.addTofavourite', ['typeid' => $cat->id, 'type' => 'service_profile']) }}">
                                <h5 class="font-weight-bold mb-0 d-block">
                                    @if ($cat->isMyFavourite())
                                        <i class="fas fa-save w3-text-red"></i>
                                    @else
                                        <i class="fas fa-save w3-text-gray color"></i>
                                    @endif
                                </h5>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            @if ($cat->open)
                                <span class="text-success p-2"><i class="fas fa-check"></i> Open</span>
                            @else
                                <span class="text-danger p-2"><i class="fas fa-times"></i> Closed</span>
                            @endif
                        </li>
                        <li class="list-inline-item">
                            @if ($cat->package_status == 'regular')
                                <span class=""><img title="Regular"
                                        src="{{ asset('img/badge/regular.png') }}" width="30px" alt=""
                                        srcset=""></span>
                            @elseif ($cat->package_status == 'golden')
                                <span class=""><img title="Golden"
                                        src="{{ asset('img/badge/golden.png') }}" width="30px" alt=""
                                        srcset=""></span>
                            @elseif ($cat->package_status == 'merchant')
                                <span class=""><img title="Merchant"
                                        src="{{ asset('img/badge/merchant.png') }}" width="30px" alt=""
                                        srcset=""></span>
                            @else
                                <span class=""><img title="Free"
                                        src="{{ asset('img/badge/free.png') }}" width="30px" alt="" srcset=""></span>
                            @endif
                        </li>

                    </ul>
                </div>
                <div class="px-4 py-3">

                    <p class="small mb-0"> <strong>SS:
                        </strong>{{ $cat->workstation ? $cat->workstation->title : '' }}
                    </p>
                    <p class="small mb-4 mt-0"> <strong>Cat:
                        </strong>{{ $cat->category->name }}</p>

                    @if ($cat->distance)
                        <p class="small mb-4 mt-0">
                            <strong>Distance: </strong>{{ number_format($cat->distance, 3, '.', '') }} KM
                        </p>
                    @endif


                </div>
            </div>
        </div>
    </div> --}}

@empty
    <h3 class="text-danger text-center">No Service Found</h3>
@endforelse

{{ $shops->render() }}
