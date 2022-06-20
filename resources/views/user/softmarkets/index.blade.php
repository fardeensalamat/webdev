@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
           
            <div class="card">
                <div class="card-header w3-teal">
                    <h3 class="text-center">Soft Market</h3>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('user.servicesSearchFilterDashboard') }}" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="service_station" id="service_station" class="form-control"
                                    data-url="{{ route('user.searchCategoryAjax') }}">
                                    <option value="">Select Service Station</option>
                                    @foreach ($service_station as $st)
                                        <option value="{{ $st->id }}">{{ $st->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="workstation_cat" id="workstation_cat" class="form-control">
                                    <option value="">Select Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input class="btn btn-success" type="submit" value="Search">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <form action="" class="py-3">
                <div class="input-group input-group-md" style="border-radius: 10px" >
                    <input type="text" data-url="{{ route('user.ServiceCategorySearchAjax') }}"
                        class="form-control ajax-data-search" placeholder="Search Category">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary w3-border px-2">
                            <i class="fas fa-search "></i>
                        </button>
                    </div>
                </div>
            </form>
          @if($specialcategory)

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach($specialcategory as $data)
                        <div class="col-md-3 col-6">
                            <a href="{{ route('user.catwiseProduct', ['cat' => $data->categories->id]) }}">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $data->categories->ci()]) }}"
                                                                alt="..." width="130" class="mb-2 img-thumbnail img-fluid">
                                    </div>
                                    <div class="card-body">
                                        <p class="m-0"> <a
                                            href="{{ route('user.catwiseProduct', ['cat' => $data->categories->id]) }}"
                                            class="btn w3-purple btn-sm btn-block">{{ mb_substr($data->categories->name,0,16) }}..</a></p>
                                    </div>
                                
                                </div>
                            </a>
                        
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
            <div class="card">
                <div class="card-body">
                    <div class="row" id="softmarkets">
                        @include('user.softmarkets.includes.softmarketajax')
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

  

        </div><!-- /.container-fluid -->



    </section>
@endsection


@push('js')
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
        $(function() {

            var delay = (function() {
                var timer = 0;
                return function(callback, ms) {
                    clearTimeout(timer);
                    timer = setTimeout(callback, ms);
                };
            })();


            //////////////////////
            $(document).on('keypress', '.ajax-data-search', function(e) {
                if (e.which == 13) {
                    e.preventDefault();
                }
            });
            //////////////////////
            $(document).on("keyup", ".ajax-data-search", function(e) {
                e.preventDefault();
                var that = $(this);
                var q = e.target.value;
                var url = that.attr("data-url");
                var urls = url + '?q=' + q;
               delay(function(){
                $.ajax({
                    url:urls,
                    type:'GET',
                    success:function(r){
                        $('#softmarkets').html(r.page);
                       // console.log(r.page);
                    }
                });
               },500);
                // $.ajax({
                //     url: urls,
                //     type: 'GET',
                //     // cache: false,
                //     // dataType: 'json',
                //     success: function(response) {
                //         alert(response.q);
                //         alert("JHELLO");
                //     },
                //     error: function() {}


                // });
                // delay(function() {
                //     $.ajax({
                //         url: urls,
                //         type: 'GET',
                //         cache: false,
                //         dataType: 'json',
                //         success: (function(res) {
                //                 alert("dsafasdf");
                //             }

                //         }));

                // }, 400);



            });
            ////////////////////admin search end //////////////////
            $(document).on('click', '.ajax-pagination-area .pagination li a', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');

                $.ajax({
                    url: url,
                    type: 'GET',
                    cache: false,
                    dataType: 'json',
                    success: function(response) {
                        $(".ajax-data-container").empty().append(response.page);
                    },
                    error: function() {}
                });

            });

        });
    </script>
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
                        var notFoundMsg= '<p class="text-danger text-center h4 font-weight-bolder">No more product found</p>'
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

@endpush

@push('js')
    <script type="text/javascript" src="{{ asset('cp/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
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

            $(function() {
                $('.cat-content-div').slimScroll({
                    height: '500px',
                    size: '4px',
                });
            });

        });
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
            ///Extra

            $('select#service_station').on('hover', function() {
                alert($(this).val());
            });
            //Extra end

            $('select#service_station').on('change', function() {
                var st = $(this).val();
                var url = $(this).attr('data-url');
                $.ajax({
                    url: url,
                    method: 'post',
                    data: {
                        id: st,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        // console.log(data.subcategories)
                        $('#workstation_cat').empty();
                        $.each(data.categories, function(index, categories) {
                            $('select#workstation_cat').append('<option value="' +
                                categories.id + '">' + categories.name.en +
                                '</option>');
                            // console.log(categories.id);
                        })
                    }
                });
            });


        });
    </script>

@endpush
