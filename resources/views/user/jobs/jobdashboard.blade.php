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
            <div class="row display">
                <div class="col-12 text-center">
                    <h1 class="mt-4 logoText"
                        style="font-size: 40px; font-weight: bolder; margin-bottom:5px; text-align:center">Jobs</h1>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-1">

                            <div class="row ">
                                <div class="col-12 col-xs-12 col-sm-12 col-md-12">
                                    <div class="card-tools">
                                        <form action="" class="ml-2 mt-2 mb-2">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" placeholder="Search Here What You Want.........">
                                                    </div>
                                                    <div id="product_list"></div>
                                                </div>
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $('#name').on('keyup',function () {
                                            var query = $(this).val();
                                            $.ajax({
                                                url:'{{ route('search') }}',
                                                type:'GET',
                                                data:{'name':query},
                                                success:function (data) {
                                                    $('#product_list').html(data);
                                                }
                                            })
                                        });
                                        $(document).on('click', 'li', function(){
                                              
                                                var value = $(this).text();
                                                $('#name').val(value);
                                                $('#product_list').html("");
                                        });
                                    });
                                </script>   
                               
                            </div>

                        </div>
                    </div>


                    <!-- /.card -->
                </div>

            </div>

            

        </div>
        <div class="row my-3">
            <div class="col-4 col-xs-4 col-sm-4 col-md-4">
                <a class="text-white" href="#">
                    <div class="card text-center w3-teal  w3-hover-shadow py-3">
                        <div class="card-body custom-design">
                            <i class="fa fa-search" aria-hidden="true" style="font-size:24px;"></i>
                            <h3>Find Employee</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-md-offset-1">
                <a class="text-white" href="{{route('dropcv.createcvprofile')}}">
                    <div class="card text-center w3-teal  w3-hover-shadow py-3">
                        <div class="card-body custom-design">
                            <i class="fas fa-upload" aria-hidden="true" style="font-size:24px;"></i>
                            <h3>Drop CV</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 col-xs-4 col-sm-4 col-md-4">
                <a class="text-white" href="{{route('vacancyannounce.createjobcompanyprofile')}}">
                    <div class="card text-center w3-teal  w3-hover-shadow py-3">
                        <div class="card-body custom-design">
                            <i class="fas fa-podcast" aria-hidden="true" style="font-size:24px;"></i>
                            <h3>Vacancy Announce</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        

        <!-- Info boxes -->
        <div class="row">
            @if (isset($websiteParameter->notice_one))
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        {!! $websiteParameter->notice_one !!}
                    </div>
                </div>
            @endif

            <!-- /.col -->

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline mb-2">
                    <div class="card-header w3-deep-orange p-1">
                        <h4 class="card-title w-100">
                            <marquee class="w3-text-white" width="100%" direction="left">
                                {{ $websiteParameter->user_page_msg }}
                            </marquee>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        {{-- <a href="http://softcodeltd.com/" class="">
            <div class="card m-0 p-0">
                <div class="card-body w3-teal ">
                    <h4 class="card-title">Go to SoftCode</h4>
                </div>
            </div>
        </a> --}}
        {{-- <a href="http://softcodeltd.com/" class="btn btn-block  w3-green">
            <h4>Go to SoftCode</h4>
        </a> --}}
        <div class="card">
            <div class="card-body w3-deep-orange ">
                <h4 class="card-title">Recent Jobs Post</h4>
            </div>
        </div>

        {{-- <div class="row">
                    @forelse ($biz_profiles as $profile)
                        <div class="col-sm-6 col-md-4 col-12  mt-3 mb-2 mb-md-0">
                            <!-- Box Comment -->
                            <div class="card card-widget p-0">
                                <div class="card-header ">
                                    <div class="user-block">
                                        <a
                                            href="{{ route('subscriber.findProfileDetails', ['subscription' => $subscriber->subscription_code, 'profile' => $profile]) }}">
                                            <img class=" img-circle"
                                                src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->img_name]) }}"
                                                alt="sans" /></a>
                                        <span class="username text-dark">
                                            <a href="{{ route('subscriber.findProfileDetails', ['subscription' => $subscriber->subscription_code, 'profile' => $profile]) }}">{{ custom_name($profile->name, 20)  }}</a>
                                        </span>
                                        <span class="description ">{{ ucfirst(custom_name($profile->category->name, 12)) }}
                                            ,{{ ucfirst(custom_name($profile->workstation->title, 12)) }} </span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="card-tools">
                                        <button  type="button" class="btn btn-tool" data-toggle="tooltip"
                                            title="Mark as read">
                                            <i class="far fa-circle"></i></button>
                                        <button  type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body ">
                                    <p class="mb-0">{{ ucfirst(custom_name($profile->short_bio, 120)) }}</p>
                                    @if ($profile->freeValues())
                                        @foreach ($profile->freeValues()->where('profile_card_display', true) as $value)
                                            @if ($value->field_type == 'string')
                                                <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}</p>

                                            @elseif($value->field_type == 'text')

                                                <p class="my-0"><b>{{ $value->profile_info_key }}</b>:</p>
                                                {!! $value->profile_info_value !!}

                                            @elseif($value->field_type == 'integer')

                                                <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}</p>

                                            @elseif($value->field_type == 'float')

                                                <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                    {{ $value->profile_info_value }}</p>

                                            @elseif($value->field_type == 'image')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                            alt="sans" width="100" /></div>
                                                </div>
                                                <br>


                                            @elseif($value->field_type == 'doc')

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                        </p>
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
                                                        <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-6"><img class="rounded w3-border"
                                                            src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                                    </div>

                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <!-- /.card-body -->
                                <!-- /.card-footer -->
                                <div class="card-footer text-center"
                                    style="background-color: #f8f9fa">
                                    <p>© Copyright {{ date('Y') }} | {{ $_SERVER['SERVER_NAME'] }}</p>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                    @empty

                    @endforelse
                </div>
                <div class="col-12">
                    {{ $biz_profiles->render() }}
                </div> --}}

            @if ($shops and Auth::user()->subscriptions()->count())
                <div class="card">
                    <div class="card-body">
                        <div class="row" id="shop-data">
                            @include('user.shopAjax')
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

    <script type="text/javascript">
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
                   // alert('server not responding...');
                });
        }
    </script>

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
