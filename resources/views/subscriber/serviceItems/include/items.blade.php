@foreach ($service_product as $item)
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                   <a href="{{ route('welcome.serviceItemShare', ['profile' => $profile->id, 'reffer' => $subscription->subscription_code, 'item' => $item->id]) }}">
                    <img class="img-fluid"
                    src=" {{ route('imagecache', ['template' => 'pplg', 'filename' => $item->fi()]) }}" alt="">
                   </a>
                </div>
                <div class="col-md-9">
                    <h4 class="m-0 p-0 font-weight-bolder bb-2">
                        <a href="{{ route('welcome.serviceItemShare', ['profile' => $profile->id, 'reffer' => $subscription->subscription_code, 'item' => $item->id]) }}">
                            {{ $item->title }}</h4>
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

{{ $service_product->render() }}
