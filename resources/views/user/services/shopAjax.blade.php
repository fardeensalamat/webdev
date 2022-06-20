@forelse ($shops as $cat)
    <div class="col-md-3">
        <div class="card">
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover"
                    style="background-image: url({{ route('imagecache', ['template' => 'pfism', 'filename' => $cat->ci()]) }}); background-size: cover; background-repeat: no-repeat;background-position: center center;">
                    <div class="media align-items-end profile-head" style=" transform: translateY(5rem);">
                        <div class="profile mr-3">

                            <a
                                href="{{ route('welcome.profileShare', ['profile' => $cat->id, 'reffer' => $subscriber->subscription_code]) }}">
                                <img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $cat->fi()]) }}"
                                    alt="..." width="130" class="rounded mb-2 img-thumbnail" @if ($cat->category->business_type == 'service')
                                style="border-radius: 50% !important"
                            @endif>
                            </a>

                            <a href="{{ route('welcome.profileShare', ['profile' => $cat->id, 'reffer' => $subscriber->subscription_code]) }}"
                                class="btn w3-purple btn-sm btn-block">{{ custom_title(ucfirst($cat->name), 15) }}</a>
                            </div>

                            </div>
                            </div>

                            <div class="bg-light p-2 d-flex justify-content-end text-center">
                                <ul class="list-inline mb-0">
                                    @if ($cat->category->business_type == 'service')
                                        <li class="list-inline-item">
                                            <h5 class="font-weight-bold mb-0 d-block">
                                                {{ $cat->totalServiceItems() }}
                                            </h5>
                                            <small class="text-muted"> <i class="fas fa-image mr-1"></i>Item</small>
                                        </li>
                                        @else
                                        <li class="list-inline-item">
                                            <h5 class="font-weight-bold mb-0 d-block">
                                                {{ count($cat->products->where('status', 'approved')->where('active', true)) }}
                                            </h5>
                                            <small class="text-muted"> <i class="fas fa-image mr-1"></i>{{__('userunpublishservice.products')}}</small>
                                        </li>
                                    @endif
                                    

                                </ul>
                            </div>
                <div class="bg-light px-3">
                    <ul class="list-inline mb-0">
                        <li title="Add To Favourite" class="list-inline-item">
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
                                <span title="Shop/Service Open" class="text-success p-2"><i class="fas fa-check rounded-circle"></i>
                                    {{__('userunpublishservice.open')}}</span>
                            @else
                                <span title="Shop/Service Closed" class="text-danger p-2"><i class="fas fa-times"></i>
                                    {{__('userunpublishservice.closed')}}</span>
                            @endif
                        </li>
                        <li class="list-inline-item">
                            {{-- {{ $cat->package_status }} --}}
                            @if ($cat->package_status == 'regular')
                                <span class=""><img title="Regular" src="{{ asset('img/badge/regular.png') }}"
                                        width="30px" alt="" srcset=""></span>
                            @elseif ($cat->package_status == 'golden')
                                <span class=""><img title="Golden" src="{{ asset('img/badge/golden.png') }}"
                                        width="30px" alt="" srcset=""></span>
                            @elseif ($cat->package_status == 'merchant')
                                <span class=""><img title="Merchant" src="{{ asset('img/badge/merchant.png') }}"
                                        width="30px" alt="" srcset=""></span>
                            @else
                                <span class=""><img title="Free" src="{{ asset('img/badge/free.png') }}" width="30px"
                                        alt="" srcset=""></span>
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
            <p class="small mb-4 mt-0"> <strong> {{__('userunpublishservice.distance')}}:
                </strong>{{ number_format($cat->distance, 3, '.', '') }} {{__('userunpublishservice.km')}}</p>
        @endif
        @if ($cat->paystatus==0)
        <a class="btn btn-danger btn-xs" href="{{ route('user.myServicesprofileUpdate', ['profile' => $cat->id,'open'=>"pay"]) }}">{{__('userunpublishservice.published')}}</a>
        @endif
    </div>

    </div>
    </div>
    </div>
    @empty
    @endforelse
