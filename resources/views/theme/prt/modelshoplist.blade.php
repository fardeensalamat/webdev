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
            <h1><span>Model Shop</span></h1>
          </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-solid">
                        @include('alerts.alerts')
                         
                                    <div class="card mt-2"> 
                                        <div class="similar-products mt-2 d-flex flex-row">
                                            @foreach ($datas as $data)
                                                <div class="card border p-1" style="width: 9rem;margin-right: 3px;">
                                                    <a
                                                        href="{{$data->link }}"><img
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $data->vc()]) }}"
                                                            class="card-img-top" alt="..."></a>
                
                                                    <div class="card-body p-0">
                                                        <a
                                                            href="{{$data->link}}"><b
                                                                class="">{{ $data->name }}</b>
                                                    </div>
                                                </div>
                                            @endforeach
                
                                        </div>
                                    </div>
                            
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
