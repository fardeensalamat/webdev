@forelse ($courseall as $item)
<div class="col-md-3 col-6">
    <div class="card p-0">
        <div class="card-body p-0 text-center">
            <a class="w3-small"
            href="{{ route('welcome.courseShare', ['profile' => $item->service_profile_id, 'product' => $item->id, 'reffer' => $item->subscriber->subscription_code]) }}">
            <img src=" {{ route('imagecache', ['template' => 'pnism', 'filename' => $item->fi()]) }}"
            class="card-image img-fluid rounded-top w-100" alt="" srcset="">    
        </a>
            
        </div>
        <div class="card-footer py-1 px-2">
            <div class="row">
                <div class="col-md-12">
                    <a class="w3-small"
                        href="{{ route('welcome.courseShare', ['profile' => $item->service_profile_id, 'product' => $item->id, 'reffer' => $item->subscriber->subscription_code]) }}">{{ Str::limit($item->title, 20, '..') }}</a>
                </div>
                <div class="col-md-12 ">
                    <img width="20"
                        src=" {{ route('imagecache', ['template' => 'ppsm', 'filename' => $item->fi()]) }}"
                        class="card-image img-circle border  img-fluid" alt="" srcset="">
                    @if ($item->price)
                        <span class="w3-small w3-text-deep-orange">BDT
                            {{ $item->price }}</span>
                    @endif
                </div>

                <div class="col-md-12">
                    <div class="d-flex justify-content-between mt-1">
                        @if ($item->user_id != Auth::id())
                            @if ($item->price)
                                <p class="m-0">
                                    <a id="toggle" data-toggle="tooltip" title="Enroll Now" class="btn btn-outline-success btn-long " href="{{ route('welcome.courseShare', ['profile' => $item->service_profile_id, 'product' => $item->id, 'reffer' => $item->subscriber->subscription_code]) }}">
                                       Enroll Now
                                    </a>
                                </p>
                            @endif
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