@extends('theme.prt.layouts.prtMaster')

@section('title')
    {{ env('APP_NAME_BIG') }}
@endsection
@section('meta')
@endsection

<meta property="fb:app_id" content="1024960768094549" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{ $product->name }}" />
<meta property="og:description" content="{{$product->description}}" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:image" content="{{ route('imagecache', ['template' => 'pfimd', 'filename' => $product->fi()]) }}" />
<meta property="og:url" content="https://www.sc-bd.com/" />

@push('css')
    <link rel="stylesheet" href="{{ asset('css/lightslider.css') }}">
    <style>
        li.custom-design .active {
            background-color: #ff5722 !important;
            color: #fff !important;
        }

    </style>
@endpush

@section('contents')
    {{-- @include('alerts.alerts') --}}
    <br>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-solid">
                        @include('alerts.alerts')
                        <div class="container-fluid mt-2 mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-5 pr-2">
                                    <div class="card">
                                        <div class="demo">
                                            <ul id="lightSlider">
                                                <li
                                                    data-thumb="{{ route('imagecache', ['template' => 'pfimd', 'filename' => $product->fi()]) }}">
                                                    <img
                                                        src="{{ route('imagecache', ['template' => 'pfimd', 'filename' => $product->fi()]) }}" />
                                                </li>
                                                @if ($product->galary_image)
                                                    @foreach ($product->galary_image as $key => $galary_image)
            
                                                        <li
                                                            data-thumb="{{ route('imagecache', ['template' => 'pfimd', 'filename' => $galary_image->img_name]) }}">
                                                            <img
                                                                src="{{ route('imagecache', ['template' => 'pfimd', 'filename' => $galary_image->img_name]) }}" />
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
                                            <span class="font-weight-bold h2">{{ $product->title }} </span><br>
                                            <h4 class="font-weight-bold">{{ $product->subtitle }}</h4>
            
                                            @if ($product->price)
                                                <h4 class="font-weight-bold">Course Fee: {{ $product->price }} SCB </h4>
                                                <del class="text-danger">{{ $product->deleted_price }}</del>
                                            @endif
            
                                        </div>
            
                                        <div class="product-description">
                                            <div><span class="font-weight-bold h4">Instructor: {{ $product->ins_name }}</span>
                                            </div>
                                            <div><span class="font-weight-bold">{{ $product->ins_designation }}</span>
                                            </div>
                                            <div><span class="font-weight-bold">Profile: </span><span><a
                                                        href="{{ route('welcome.profileShare', ['reffer' => $subscription->subscription_code, 'profile' => $product->service_profile_id]) }}">{{ $product->serviceProfile->name }}</a></span>
                                            </div>
                                            
                                            <div class="d-flex flex-row align-items-center"><img
                                                    src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $product->serviceProfile->img_name]) }}"
                                                    class="rounded-circle store-image shadow">
                                                <div class="d-flex flex-column ml-1 comment-profile">
                                                    <div class="comment-ratings"> {{ $product->category->name }} </div> <span
                                                        class="username font-weigth-bold"> <a class="font-weigth-bold"
                                                            href="{{ route('welcome.profileShare', ['reffer' => $subscription->subscription_code, 'profile' => $product->service_profile_id]) }}">{{ $product->serviceProfile->name }}</a>
                                                    </span> <span class="">{{ $product->workstation->title }}</span>
                                                </div>
                                            </div>
            
                                        </div>
                                        @if ($product->user_id != Auth::id())
                                            <div class="mt-3">
                                                @if ($product->price)
                                                        @if (Auth::guest())
                                                            <a class="btn btn-outline-success btn-long "
                                                                data-target="#modal_register" data-toggle="modal"
                                                                href="#">
                                                               Enroll Now
                                                            </a>
                                                        @else
                                                                <a class="btn btn-outline-success btn-long "
                                                                href="{{ route('subscriber.addToCartCourse', ['profile' => $product->serviceProfile, 'product' => $product->id, 'subscription' => $subscription->subscription_code,'buynow' => 'b']) }}">Enroll Now</a>
                                                        
                                                        @endif
                                                @endif
                                             
                                            </div>
                                        @endif
                                        <hr>
                                        <div>
                                              <button class="copyboard btn btn-primary btn-xs" data-text="www.sc-bd.com/course/{{$product->id}}/details/subscription/{{$subscription->subscription_code}}/profile/{{$product->service_profile_id}}">Copy Course Link</button>
                                              @if($product->user_id == Auth::id())
                                                <a class="btn btn-primary btn-xs" href="{{ route('subscriber.subscriptionPostJob', $subscriber->subscription_code) }}">Course Promotion</a>
                                              @endif
                                        </div>
                                        <hr>
                                        
                                        <div class="addthis_inline_share_toolbox"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row no-gutters">
                                
                                <div class="tab-pane fade show active" id="syllabus-desc" role="tabpanel" aria-labelledby="syllabus-desc-tab"><span class="font-weight-bold h2">What you will learn from this course:</span><br> {!! html_entity_decode($product->whatlearn) !!} </div>
                                <div class="tab-pane fade show active" id="syllabus-desc" role="tabpanel" aria-labelledby="syllabus-desc-tab"><span class="font-weight-bold h2">About Course:</span><br> {!! html_entity_decode($product->aboutcourse) !!} </div>
                                <div class="tab-pane fade show active" id="syllabus-desc" role="tabpanel" aria-labelledby="syllabus-desc-tab"><span class="font-weight-bold h2">Course Syllabus:</span><br> {!! html_entity_decode($product->coursesyllabus) !!} </div>
                            </div>
                        </div>
            
                        <div class="">
                           
                            @if($product->serviceProfile->paystatus==1)          
                                @if (count($related_product) > 0)
                                    <div class="card mt-2"> <span class="h4">Similar items:</span>
                                        <div class="similar-products mt-2 d-flex flex-row">
                                            @foreach ($related_product->take(4) as $item)
                                                <div class="card border p-1" style="width: 9rem;margin-right: 3px;">
                                                    <a
                                                        href="{{ route('welcome.productShare', ['product' => $item->id, 'reffer' => $subscription->subscription_code, 'profile' => $profile->id]) }}"><img
                                                            src="{{ route('imagecache', ['template' => 'pnism', 'filename' => $item->fi()]) }}"
                                                            class="card-img-top" alt="..."></a>
                
                                                    <div class="card-body p-0">
                                                        <a
                                                            href="{{ route('welcome.productShare', ['product' => $item->id, 'reffer' => $subscription->subscription_code, 'profile' => $profile->id]) }} "><b
                                                                class="">{{ $item->name }}</b>
                                                    </div>
                                                </div>
                                            @endforeach
                
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('js/lightslider.js') }}"></script>
    <script src="https://www.okler.net/previews/porto/8.0.0/js/theme.js"></script>
    <script src="https://www.okler.net/previews/porto/8.0.0/js/theme.init.js"></script>
    <script src="http://softcode.test/prt/css/theme-shop.css"></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6187671346fae48e"></script>
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

<script>

	$(function(){

$(document).on('click', '.copyboard', function(e) {
  e.preventDefault();


  $(".copyboard").text('Copy to Clipboard');

  $(this).text('Coppied!');
  var copyText = $(this).attr('data-text');

  var textarea = document.createElement("textarea");
  textarea.textContent = copyText;
  textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
  document.body.appendChild(textarea);
  textarea.select();
  document.execCommand("copy");

  document.body.removeChild(textarea);
});

	});
</script>
@endpush
