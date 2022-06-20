@extends('user.layouts.userMaster')
@push('css')

    <style>
        .Mydashbord {
            width: 100%;
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

        @media only screen and (max-width: 376px) {
            .textscontent-saif {
                width: 100px;
                height: 100px;
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4>My Leader (Who refered me)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive ajax-data-container">
                    <table class="table table-hover table-bordered table-striped table-sm }}"
                        style="white-space: nowrap">
                        <thead>
                            <tr class="nowrap">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>PF No.</th>
                                <th>Referer</th>
                            </tr>
                        </thead>
                        @if ($myLeader)
                            <tbody>
                                <tr class="nowrap">
                                    <td>{{ $myLeader->id }}</td>
                                    <td>{{ $myLeader->user ? $myLeader->user->name : '' }}
                                    </td>
                                    <td>{{ $myLeader->user ? $myLeader->user->mobile : '' }}
                                    </td>
                                    <td>{{ $myLeader->subscription_code }}</td>
                                    
                                    <td>{{ $myLeader->referrer ? $myLeader->referrer->subscription_code : '' }}
                                    </td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                <tr>
                                    <td colspan="12" class="text-center text-danger h4">No
                                        Leader Found</td>
                                </tr>
                            </tbody>
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4>My Reffer (Who I have referred)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive ajax-data-container">
                    <table class="table table-hover table-bordered table-striped table-sm }}"
                        style="white-space: nowrap">


                        <thead>
                            <tr class="nowrap">
                                <th>SL</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>PF No.</th>
                                <th>Referer</th>
                            </tr>
                        </thead>
                        @if ($myReffer)
                            <tbody>
                                <?php $i = 1; ?>
                                <?php $i = ($myReffer->currentPage() - 1) * $myReffer->perPage() + 1; ?>
                                @foreach ($myReffer as $sc)
                                    <tr class="nowrap">
                                        <td>{{ $i }}</td>
                                        <td>{{ $sc->user ? $sc->user->name : '' }}</td>
                                        <td>{{ $sc->user ? $sc->user->mobile : '' }}</td>
                                        <td>{{ $sc->subscription_code }}</td>
                                    
                                        <td>{{ $sc->referrer ? $sc->referrer->subscription_code : '' }}
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        @endif

                    </table>
                    {{ $myReffer->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')
    <!-- Select2 -->
    <script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>
    {{-- <script>
        //     $(document).ready(function() {
        //         //    var mobile= $('#user').val();
        //         //    if (mobile.lenght < 14) {
        //         //        $("select#workstation").attr('disabled');
        //         //    }
        //         $('.select5').select2({
        //             theme: 'bootstrap4',
        //             containerCssClass: ".select5",
        //         });

        //         $('.select5').select2({
        //             theme: 'bootstrap4',
        //             // containerCssClass: ".search",
        //             // minimumInputLength: 1,
        //             ajax: {
        //                 data: function(params) {
        //                     return {
        //                         q: params.term, // search term
        //                         page: params.page
        //                     };
        //                 },
        //                 processResults: function(data, params) {
        //                     params.page = params.page || 1;
        //                     // alert(data[0].s);
        //                     var data = $.map(data, function(obj) {
        //                         obj.id = obj.id || obj.id;
        //                         return obj;
        //                     });
        //                     var data = $.map(data, function(obj) {
        //                         obj.text = obj.name + " (" + obj.subscription_code + ") (" + obj
        //                             .id + ")";
        //                         return obj;
        //                     });
        //                     return {
        //                         results: data,
        //                         pagination: {
        //                             more: (params.page * 30) < data.total_count
        //                         }
        //                     };
        //                 }
        //             },
        //         });
        //     });
        //     $('#newUser').click(function(e) {
        //         e.preventDefault();

        //         $("#hideShow").toggle();
        //     });
        // 
    </script>

    <script>
        $(function() {
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

        });
    </script>

    <script>
        $(document).ready(function() {



            $('.select2').select2({
                theme: 'bootstrap4'
            });

            $('.step2-select').select2({
                theme: 'bootstrap4',
                // minimumInputLength: 1,
                ajax: {
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        // alert(data[0].s);
                        var data = $.map(data, function(obj) {
                            obj.id = obj.mobile || obj.mobile;
                            return obj;
                        });
                        var data = $.map(data, function(obj) {
                            obj.text = obj.mobile;
                            return obj;
                        });
                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    }
                },
            });


        });
    </script> --}}
    <script>
        $(document).ready(function() {

            // $('.select2').select2({
            //     theme: 'bootstrap4'
            // });

            $('.step2-select').select2({
                theme: 'bootstrap4',

                // minimumInputLength: 1,
                ajax: {
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        // alert(data[0].s);
                        var data = $.map(data, function(obj) {
                            obj.id = obj.id || obj.id;
                            return obj;
                        });
                        var data = $.map(data, function(obj) {
                            obj.text = obj.mobile;
                            return obj;
                        });
                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    }
                },
            });

            //// To


        });
    </script>
    <script>
        $(document).ready(function() {
            // seleect5 search
            // $('.seleect5').select2({
            //     theme: 'bootstrap4'
            // });

            $('.addmeReffer').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#myModal')
                // minimumInputLength: 1,
                ajax: {
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        // alert(data[0].s);
                        var data = $.map(data, function(obj) {
                            obj.id = obj.id || obj.id;
                            return obj;
                        });
                        var data = $.map(data, function(obj) {
                            obj.text = obj.id + "- (" + obj.name + ")";
                            return obj;
                        });
                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    }
                },
            });

            //// To


        });
    </script>
    <script>
        $(document).ready(function() {
            // seleect5 search
            // $('.seleect5').select2({
            //     theme: 'bootstrap4'
            // });

            $('.search').select2({
                theme: 'bootstrap4',
                containerCssClass: ".search",
                // minimumInputLength: 1,
                ajax: {
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        // alert(data[0].s);
                        var data = $.map(data, function(obj) {
                            obj.id = obj.id || obj.id;
                            return obj;
                        });
                        var data = $.map(data, function(obj) {
                            obj.text = obj.id + "- (" + obj.name + ")";
                            return obj;
                        });
                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    }
                },
            });

            //// To


        });
    </script>

@endpush
