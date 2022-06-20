@extends('layouts.app_view')
@push('css')


    <style >

        /*.user_profile_main{*/
        /*    display: block;*/
        /*    width: 300px;*/
        /*    .user_profile_image{*/
        /*        width: 100%;*/
        /*        display: block;*/
        /*        text-align: center;*/
        /*        span{*/
        /*            width: 60px;*/
        /*            height: 60px;*/
        /*            display: block;*/
        /*            border-radius: 50%;*/
        /*            background: blue;*/
        /*            line-height: 60px;*/
        /*            margin: 0 auto;*/
        /*            color: white;*/

        /*        }*/
        /*    }*/

        /*    h3{*/
        /*        text-align: center;*/
        /*        padding: 5px;*/
        /*    }*/

        /*    p{*/
        /*        text-align: center;*/
        /*    }*/

        /*}*/


        .user_profile_main{
            display: block;
            width: 300px;
        }

        .user_profile_main h3{
            text-align: center;
            padding: 5px;
        }

        .user_profile_main p{
            text-align: center;
        }

        .user_profile_main  .user_profile_image{
            width: 100%;
            display: block;
            text-align: center;
        }


        .user_profile_main  .user_profile_image span{
            width: 60px;
            height: 60px;
            display: block;
            border-radius: 50%;
            background: blue;
            line-height: 60px;
            margin: 0 auto;
            color: white;
        }



        .footer_part{
            border-top: 1px solid #000000;
        }

        .footer_part p{
            text-align: center;
            cursor: pointer;
        }






        .mobile{

            padding: 10px 0px;

            margin-top: 10px;

        }

        .mobile_s{
            padding: 0 !important;

        }
        .server_service{
        // height: 60px !important;
            width: 70% !important;
        }

        .mobile_main{
            width: 90% !important;
        }
        .logo_server{
        // padding-left: -40px !important;
            font-size: 20px;

        }


        *{
            padding: 0;
            margin: 0;
        }


        .main_wrapper_index_page {
            overflow: hidden;
            width: 100%;
            background-color: #0a94e7;
            height: 100vh;
        }

        .main_wrapper_index_page .navbar-main-wrapper-index{
            width: 55% !important;
            height: 78px;
            float: left;
            padding-top: 5px;
        }

        .main_wrapper_index_page .navbar-main-wrapper-index ul{
            list-style: none;
            width: 100%;
            padding: 0;
            margin: 0;
        }

        .main_wrapper_index_page .navbar-main-wrapper-index ul li{
            float: left;
            width: 70px;
        }

        .main_wrapper_index_page .navbar-main-wrapper-index ul li a{
            text-decoration: none;
            color: white;
        }


        .main_wrapper_index_page .navbar-main-wrapper-index ul li a span{
            background: #b106a3;
            width: 40px;
            height: 40px;
            display: block;
            border-radius: 50%;
            line-height: 40px;
            text-align: center;
        }

        /*.main_wrapper_index_page .navbar-main-wrapper-index p a span{*/
        /*    background: #b106a3;*/
        /*    width: 40px;*/
        /*    height: 40px;*/
        /*    display: block;*/
        /*    border-radius: 50%;*/
        /*    line-height: 40px;*/
        /*    text-align: center;*/
        /*}*/


        .main_wrapper_index_page .navbar-main-wrapper-index ul li a svg{
            color: white;
        }



        .right-navbar-wrapper{
            width: 45% !important;
            float: right;
            padding:5px;
        }
        .right-navbar-wrapper ul{
            list-style: none;
            float: right;
        }

        .right-navbar-wrapper ul li{
            color: white;
            font-size: 20px;
        }

        .right-navbar-wrapper ul li a{
            text-decoration: none;
            color: white;
        }

        .bar{
            background: white;
        }

        .middle{
            display: block;
            align-items: center;
        // justify-content: center;
            margin: 0 auto;
            width: 600px;
            margin-top: -5vh;
            padding: 20px;
        }
        .middle h1{
            color: white;
            display: inline;
        }


        .buttons1 {
            margin-top: 3vh;
            width: 500px;
            display: block;
            text-align: center;
            margin: 0 auto;

        }
        .buttons1 ul {
            list-style: none;
            text-align: center;
        }

        .buttons1 ul li {
            width: 80px;
            float: left;
            padding: 15px;
        }

        .buttons1 ul li a {
            text-decoration: none;
            color:black !important;

        }
        .buttons1 ul li a span {
            width: 40px;
            height: 40px;
            display: block;
            background: #5453f9;
            border-radius: 50%;
            line-height: 40px;
            color: white;
        }

        /*.buttons1 p{*/
        /*    flex*/
        /*}*/
        /*.buttons1 p  a .icon-sccp {*/
        /*    width: 40px;*/
        /*    height: 40px;*/
        /*    display: block;*/
        /*    background: #5453f9;*/
        /*    border-radius: 50%;*/
        /*    line-height: 40px;*/
        /*    color: white;*/
        /*}*/




    </style>




    <style>

        .bar{
            margin:0 auto;
            width:525px;
            border-radius: 20px;

        }

        .searchbar{
            height:35px;
            border:none;
            width:450px;
            font-size:16px;
            border: 0;
            box-shadow: none;


        }
        .searchbar:focus{
            border: 0 !important;
            box-shadow: none;

        }
        .search{
            height:25px;
            position:relative;
            top:1px;
            left:10px;
        }
        #product_list_user{
            width:550px
        }


        @media only screen and (max-width: 600px) {
            .middle{
                width: 100% !important;
            }

            .middle img{
                width: 75% !important;
                float:left;
            }

            .middle h1{
                width: 80% !important;
                float:left;
                font-size: 30px !important;
                margin-top:51px !important;
            }
            .bar{
                width:340px !important;

            }
            .bar input{
                width: 260px !important;
            }
            #product_list_user{
                width:100%
            }
        }


    </style>


@endpush
@section('content')
    <div class="containter main_wrapper_index_page" style="overflow:hidden">


        <div class="row">

            <div class="col-12" style="padding-top:20px;  padding-left: 21px;">
                <div class="navbar-main-wrapper-index"  :class="{'mobile':mobile}">

                    <ul style="font-size:larger;" class="col-12" :class="{'nav_section_now':mobile}">



                        <li style="width:50px; padding-left:15px" >
                            <div class="btn-group">
                                <!-- <button type="button" style="padding:0; margin:0; border-radius:50%;margin-top:5px; background:transparent; border:none;" class="btn btn-light" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"> -->

                                <img data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" style="width:30px; height:30px;max-width:100%; color:black; cursor:pointer; margin-top:10px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAtZJREFUWEftl0FWGkEQhr/CuCc3wF0iLvAEkRNEThA5gTBmH9nHCZ4g5gTKCeQGzkJMdvEGYR+h8rp7ZtLTzDDB93xmYa14dPc/1dV//VUleKa7dGjQ5IF7+cG9v1b2W/c4MP/LLdPavW9o8YoWS+ZyR5LtF/NDzeIWX8EBpjZlm54kzENw3eUI4QvQTNfmKEO542Jlb4cmv7lcwV7QN5d0DrS5ATolt5jKjG4hSm85pGEBV21JT75zVdjf5jr4eLacyIx9SW9jbl9uyr4fsjXOmvMWNAOyTyr2clXYfdE9TlE+VW4SRnLLaQ7aRte9t8ywUbWR/Rfs2k1BWLXNL+/tQ1/mMuO1FwHDlerowlBSAv6suNWcbXZ8ImrbAh5V7L+QGf3cAUdAg52RtXhswY4joWP1qqdKP2S2OlBDrJC0Cdt0w6ypw/bf6wDlfQqcsOB8nRZY4IbdD0smZSmYR8Kl+XGOLUwy7cgdWEesp1x7cSDM2Q9AC2wdOJcZ47Lw68DWDKMdh+n6FUtGMv6r8f45jRiA5UCG/U1ipy2ZFFel1lhmDAtg7uMmC8LUmrOkGzqhka0ZxoHQLiTGKqFhvwEsN5OrXmXUyNaB7ObhmSuJ6eXsH9CiYXWg3Bp066XYqJX3FBrVSHHsSbELvYlAlY3+Cwee9wmsFFfr+9OTMCeMK53Pk4ZPKbV12C9S/Phy7HL8XRriicSrHXEgSMeo7RETGkzks2vlN29IBjTZ4tqC+WaAF1aKC228RrZ7KmvL+sbpzVuyqKYli72WzDjrpLi8JVuyI9qukcugLdOopimNvab0hEO0YoZw0RvWS3HYlm9WC0zJrW75YbT5YHLCzcr7Z1wQEjnzBhNXuqsHE+hvPpqtC6vQk7NgNBtyjRRmTudu6uzjhlPH7OJwat6zJBXVEFG4LDihTDHcGqfDaZ6vm47nH9PxPM3pdbKrpjkx4/kDc79r+gPb/2m/TXJfXQAAAABJRU5ErkJggg==" alt="Icon-1">
                                <!-- </button> -->
                                <div class="dropdown-menu dropdown-menu-left" style="border-radius: 15px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                                    <!-- 1st row -->
                                    <div style="display:flex;">

                                        @if(\Illuminate\Support\Facades\Auth::check())


                                        <button type="button" class="btn btn-outline-primary btn-lg m-2" style="border-radius: 50px;">
                                            <a href="{{url('/mypanel/dashboard/products')}}"><img src="/vueimage/product.png" width="80px" height="60px" alt=""></a>

                                        </button>

                                        <button type="button" class="btn btn-outline-primary btn-lg m-2" style="border-radius: 50px;">
                                            <a href="{{url('/mypanel/dashboard/service')}}"><img src="/vueimage/service.png" alt=""  width="80px" height="80px"></a>
                                        </button>

                                        @else
                                            <button type="button" class="btn btn-outline-primary btn-lg m-2" style="border-radius: 50px;">
                                                <a href="{{url('/sc-bd-login')}}"><img src="/vueimage/product.png" width=80px" height="60px" alt=""></a>

                                            </button>

                                            <button type="button" class="btn btn-outline-primary btn-lg m-2" style="border-radius: 50px;">
                                                <a href="{{url('/sc-bd-login')}}"><img src="/vueimage/service.png" alt=""  width="80px" height="80px"></a>
                                            </button>

                                        @endif

                                    </div>

                                    <!-- 2nd row -->


                                </div>

                            </div>
                        </li>


{{--                        <li :class="{'f_padding':mobile}">--}}
{{--                            <a class="nav-link" aria-current="page" href="/mypanel/dashboard">Dashboard</a>--}}
{{--                        </li>--}}
                        @if(Auth::check())
                            <li  :class="{'f_padding':mobile}" style="cursor: pointer;">
                                <a class="nav-link" href="/mypanel/dashboard">Dashboard</a>

                            </li>
                        @else

                        <li  :class="{'f_padding':mobile}" style="cursor: pointer;">
                            <a class="nav-link" href="/sc-bd-login">Login</a>

                        </li>
                        @endif

                        <!-- <li :class="{'f_padding':mobile}">
                          <a class="nav-link" aria-current="page" href="#">About</a>
                        </li> -->
                    </ul>




                </div>
                @if(Auth::check())
                <div class="right-navbar-wrapper">
                    <ul>
                        <li v-if="auth">
                            <div class="btn-group">

                                <a data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" class="nav-link" aria-current="page" href="#">
                                    Hi, {{ Str::substr(Auth::user()->name,0, 5) }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-left" style="border-radius: 15px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                                    <!-- 1st row -->
                                    <div >
                                        <div class="user_profile_main">
                                            <div class="user_profile_image">
                                                <span>{{Str::substr(Auth::user()->name,0, 1)}}</span>
                                            </div>

                                            <h3>{{Auth::user()->name}}</h3>
                                            <p>{{Auth::user()->mobile}}</p>
                                            <p>{{Auth::user()->email}}</p>
                                        </div>
                                        <div class="footer_part" style="height:40px">

                                            <form action="{{ route('logout') }}" method="POST" style="text-align:center;">@csrf
                                                <button type="submit" style="color:#000b16;">Sign out</button>
                                            </form>
{{--                                            <p>Sign out</p>--}}
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </li>

                    </ul>
                </div>
                @endif

            </div>



            <div class="col-12" style="padding-top:50px;">
                <p class="middle">
                    <div class="row">
                    <div class="col-1 col-md-4"></div>
                    <div class="col-9 col-md-6">
                        <img alt="search" class="mt-5 mb-5" style="float:left; width:500px"  src="/vueimage/soft.png">

                    </div>
                    <div class="col-2 col-md-2"></div>
                </div>
{{--                    <h1  style="margin-top:80px; margin-left:10px; float:left;">SOFT COMMERCE</h1>--}}
                </p>
            </div>


            <!-- search -->

            <div class="col-12" style="margin-top: -33px;">
                <center>
                    <div class="bar"  style="position:relative;">
                        <input class="searchbar" type="text" style="color:black !important;" id="user_name" name="user_name"   autocomplete="off">
                        <a href="#" style="position:absolute; margin-top: 4px;"> <img class="search" src="/vueimage/icon.svg" title="Search"></a>
                        <div id="product_list_user" style="position: absolute;"></div>
                    </div>
                </center>
            </div>

            <script type="text/javascript">
                $(document).ready(function(){


                    {{--$('#name').keyup(function(){--}}
                    {{--    var query = $(this).val();--}}
                    {{--    if(query != '')--}}
                    {{--    {--}}
                    {{--        var _token = $('input[name="_token"]').val();--}}
                    {{--        $.ajax({--}}
                    {{--            url:"{{ route('search.user') }}",--}}
                    {{--            method:"get",--}}
                    {{--            data:{query:query, _token:_token},--}}
                    {{--            success:function(data){--}}
                    {{--                $('#product_list').fadeIn();--}}
                    {{--                $('#product_list').html(data);--}}
                    {{--            }--}}
                    {{--        });--}}
                    {{--    }--}}
                    {{--});--}}

                    {{--$(document).on('click', 'li', function(){--}}
                    {{--    $('#name').val($(this).text());--}}
                    {{--    $('#product_list').fadeOut();--}}
                    {{--});--}}


                    $('#user_name').on('keyup',function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        var query = $(this).val();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url:'{{ route('search.user') }}',
                            type:'post',
                            data:{'name':query, _token:_token},
                            // dataType: "html",
                            // contentType:"application/json; charset=utf-8",
                            // dataType:"json",
                            success:function (data) {
                                console.log(data);
                                $('#product_list_user').html(data);
                            }
                        })
                    });
                    $(document).on('click', 'li', function(){
                        var _token = $('input[name="_token"]').val();
                        var value = $(this).text();
                        $('#user_name').val("");
                        var url = $(this).data('url');
                        $('#product_list_user').html("");

                        $.ajax({
                            url:'{{ route('search.user.short.cart') }}',
                            type:'post',
                            data:{'name':value, url: url, _token:_token},
                            success:function (data) {
                               console.log('ok');
                            }
                        })


                    });
                });
            </script>


            <!-- buttons -->
            <div class="col-12" style="padding-top:30px;">
                <div class="buttons1">
{{--                    @if(count($homeShortCart))--}}
                    <ul>


                        @foreach($homeShortCart as $cart)
                        <li style="color:#000b16 !important; margin-left:2vw;"><a target="_blank" href="{{$cart->url}}" ><span>{{Str::substr($cart->title,0, 1)}}</span></a>{{Str::substr($cart->title,0, 5)}} </li>

                        @endforeach
                            <li style="color:#000b16 !important; margin-left:2vw;"><a href="#" style="color:black;" data-toggle="modal" data-target="#staticBackdrop"><span><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a> Add</li>

                    </ul>
{{--                    @else--}}
{{--                        <p><a href="#" style="color:black;" data-toggle="modal" data-target="#staticBackdrop"><span class="icon-sccp"> <i class="fa fa-plus-circle" aria-hidden="true"></i></span><br> <span>Add</span> </a>--}}
{{--                        </p>--}}
{{--                    @endif--}}

                </div>
            </div>




            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="left:5%">
                    <div class="modal-content" style="height: 345px;">
                        <form action="{{route('search.user.short.cart.favorite')}}" method="post">@csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add shortcut</h5>
                            <span type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </span>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
                            </div>

                            <div class="form-group">
                                <label for="url">Url</label>
                                <input type="text" name="url" id="url" class="form-control" placeholder="www.sc-bd.com" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm  btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>

    </div>


@endsection

