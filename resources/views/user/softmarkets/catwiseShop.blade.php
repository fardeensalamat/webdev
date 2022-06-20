@extends('user.layouts.userMaster')

@push('css')


@endpush
@section('content')

    <section class="content">

        <br>

        <div class="row">
            <div class="col-md-12 ">
                <div class="card card-primary card-outline">
                    <div class="card-body p-2">
                        <h3 class="card-title ">{{ $category->name }}</h3>
                    </div>
                </div>
                <form action="" class="py-3">
                    <div class="input-group input-group-md" style="border-radius: 10px" >
                        <input type="text" data-url="{{ route('user.ServiceProfileCatSearchAjax',['cat' => $category->id]) }}"
                            class="form-control ajax-data-search" placeholder="Search Shops">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary w3-border px-2">
                                <i class="fas fa-search "></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row" id="showProfile">
                    @include('user.softmarkets.includes.shopCardSmall')
                   
                </div>
            </div>
        </div>
    </section>
    @endsection
   

    @push('js')
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
                        $('#showProfile').html(r.page);
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

    @endpush
