@extends('theme.prt.layouts.prtMaster')

@section('title')
    {{ env('APP_NAME_BIG') }}
@endsection
@section('meta')
@endsection

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
                  <div class="card">
                      <div class="card-body bg-info">
                        <h3>{{ $service_item->title }}</h3>
                      </div>
                      <div class="card-body">
                          {!! $service_item->description !!}
                          <b>Categories: </b> <span class="badge badge-info">{{ $service_item->category->name }}</span>
                          <b>WorkStation: </b> <span class="badge badge-info">{{ $service_item->workstation->title }}</span>
                        
                      </div>
                      @auth
                      <div class="card-footer">
                         @if ($service_item->negotiations)
                         <a href="" class="btn btn-success">Negotiations</a>
                         @else
                         <a href="" class="btn btn-success">Pay Now</a>
                         
                     @endif
                      </div>
                   @endauth
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
@endpush
