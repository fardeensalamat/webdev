@extends('user.layouts.userMaster')
@push('css')

    <style>
        .Mydashbord {
            width: 100%;
        }

        .display img{
                width: 120px !important;
            }

        select {
            text-transform: none;
            padding: 5px;
            border-radius: 9%;
            border: 2px solid #007bff;
        }

        .click-button-saif {
            border-radius: 88%;
            padding: 10px 15px;
            border: 1px solid #ff5722;
            background-color: #ff5722;
        }

        .demo-saif {
            margin-left: 73px;
            margin-top: -27px;
            /* background: white; */
            padding: 3px 5px;
        }

        .textcontent1-saif {
            position: absolute;
            left: 35%;
            top: 28%;
            color: white;
        }

        .fa-universal-access:before {
            content: "\f29a";
            font-size: 35px;
            color: white
        }

        .fa-heart:before {
            content: "\f004";
            font-size: 35px;
            color: white
        }

        .fa-cart-arrow-down:before {
            content: "\f218";
            font-size: 35px;
            color: white
        }

        .textscontent-saif {

            width: 200px;
            height: 200px;
            background-color: #009688;
            border-radius: 70%;
            margin: 0px auto;
        }

        @media only screen and (max-width: 580px) {

            .logoText {
                font-size: 35px !important;
                /*text-align: right !important; */
                margin-top: 8px !important;
            }
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

            .textscontent-saif {
                width: 120px;
                height: 120px;
                background-color: #009688;
                border-radius: 70%;
                margin: 0px auto;
            }

            .textcontent1-saif {
                position: absolute;
                left: 28%;
                top: 28%;
                color: white;
            }

            .textcontent .fa-heart {
                margin-left: 10px;
            }


        }
        @media only screen and (max-width: 472px) {
            .logoText {
                font-size: 35px !important;
                /*text-align: right !important; */
                margin-top: 8px !important;
            }

            /*.display{*/
            /*    display:flex;*/
            /*    justify-content:between;*/
            /*}*/
        }


        @media only screen and (max-width: 376px) {
            .textscontent-saif {
                width: 100px;
                height: 100px;
                background-color: #009688;
                border-radius: 70%;
                margin: 0px auto;
            }
            .logoText {
                font-size: 30px !important;
                margin-top: 5px !important
            }

            .textcontent1-saif {
                position: absolute;
                left: 28%;
                top: 28%;
                color: white;
            }

            .fa-universal-access:before {
                content: "\f29a";
                font-size: 18px;
                color: white
            }

            .fa-heart:before {
                content: "\f004";
                font-size: 18px;
                color: white
            }

            .fa-cart-arrow-down:before {
                content: "\f218";
                font-size: 18px;
                color: white
            }

            .textscontent-saif h3 {
                font-size: 15px;
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
            <!-- /.row -->
            @include('alerts.alerts')
            

        </div>
    
        <div class="card">
            <div class="card-body w3-deep-orange ">
                <h4 class="card-title">{{ __('userpublishservice.publish_shop') }}</h4>
            </div>
        </div>

            @if ($shops and Auth::user()->subscriptions()->count())
                <div class="card">
                    <div class="card-body">
                        <div class="row" id="shop-data">
                            @include('user.services.shopAjax')
                        </div>
                        <div class="ajax-load text-center col-md-12" style="display:none">
                            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="150"
                                viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                <path fill="#007bff"
                                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                    <animateTransform attributeName="transform" attributeType="XML" type="rotate"
                                        dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

            @endif
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')

    {{-- <script type="text/javascript">
        var page = 1;
        //For PC / Computer
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                loadMoreData(page);
            }
        });
        //For Mobile / Tuch Device
        $(window).on('touchend', function() {
            if ($(window).scrollTop() + $(window).height() >= window.visualViewport.height) {
                page++;
                loadMoreData(page);

            }
        });

        function loadMoreData(page) {
            $.ajax({
                    url: 'page?page=' + page,
                    type: "get",
                    beforeSend: function() {
                        // $('.hideSho').fadeIn();
                        $('.ajax-load').fadeIn();
                    }
                })
                .done(function(data) {
                    // console.log(data);
                    if (data.html == "") {
                        var notFoundMsg= '<p class="text-danger text-center h4 font-weight-bolder">No more service found</p>'
                       $('.ajax-load').html(notFoundMsg);
                        // alert(a);
                        return;
                    }

                    $('.ajax-load').fadeOut();
                    // $('.hideSho').fadeOut();
                    $("#shop-data").append(data.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('server not responding...');
                });
        }
    </script> --}}

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

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        // $('.addTofavourite').on('click',function(e){
        //     e.stopImmediatePropagation();
        //     alert('Hello');
        //     var url= $(this).attr('data-url');
        //     alert(url);
        //     $.ajax({
        //        type:'POST',
        //        url:url,
        //        data:{'_token':{{ csrf_token() }}},
        //        success:function(data) {
        //         //    console.log(data);
        //         //   $("#msg").html(data.msg);
        //        }
        //     });
        // });
    </script>

@endpush
