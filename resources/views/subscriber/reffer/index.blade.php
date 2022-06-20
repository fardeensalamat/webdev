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
                <div class="col-4 col-xs-4 col-sm-4 col-md-4">
                    <a class="text-white" href="javascript:void(0)">
                        <div class="card text-center w3-teal  w3-hover-shadow py-3">
                            <div class="card-body custom-design">
                                <i class="fab fa-btc"></i>
                                <h3>{{ Auth::user()->TotalSale() }} SCB</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-success">
                    Reffer History
                </div>
                <div class="card-body">
                    <div class="table-responsive ajax-data-container">
                        <table
                            class="table table-hover table-bordered table-striped table-sm {{ $iReffered->count() < 3 ? 'mb-5 mt-5' : '' }}">
        
        
                            <thead>
                                <tr class="nowrap">
                                    <th>SL</th>
                                    <th>Action</th>
                                    <th>ID</th>
                                    <th>Tenant</th>
                                    <th>Name</th>
                                    {{-- <th>Email</th> --}}
                                    <th>Mobile</th>
                                    <th>Balance</th>
                                    {{-- <th>Moved to Wallet</th> --}}
                                    <th>PF No.</th>
        
                                    {{-- <th>Position</th> --}}
                                    <th>Work Station</th>
                                    <th>Category</th>
                                    <th>District</th>
                                    <th>Referer</th>
                                    {{-- <th>Employees</th> --}}
                                    <th>Joining Date</th>
                                </tr>
                            </thead>
        
                            <tbody>
        
        
                                <?php $i = 1; ?>
        
                                <?php $i = ($iReffered->currentPage() - 1) * $iReffered->perPage() + 1; ?>
        
                                @foreach ($iReffered as $sc)
        
        
                                    <tr class="nowrap" style="white-space: nowrap">
        
                                        <td>{{ $i }}</td>
        
                                        <td>
        
        
                                            <div class="btn-group btn-group-xs w3-hover-shadow">
        
                                                <a class="btn btn-primary btn-xs"
                                                    href="{{ route('user.subscriberEdit', $sc->id) }}">Edit</a>
                                               
        
                                            </div>
        
        
                                        </td>
                                        <td>{{ $sc->id }}</td>
                                        <td>
                                            @if ($sc->user)
                                                <a class="btn btn-xs {{ $sc->user->active ? '' : 'btn-danger' }}  w3-round w3-border"
                                                    href="{{ route('user.reffersaleshistory', ['user' => $sc->user]) }}">{{ $sc->user_id }}</a>
                                            @else
                                                {{ $sc->user_id }}
                                            @endif
                                        </td>
                                        <td>{{ $sc->user ? $sc->user->name : '' }}</td>
                                        {{-- <td>{{ $sc->user ? $sc->user->email: '' }}</td> --}}
                                        <td>{{ $sc->user ? $sc->user->mobile : '' }}</td>
                                        {{-- <td>{{ $user->position }}</td> --}}
                                        <td>
                                            @if ($sc->balance > 0)
                                                <span class="badge badge-success">{{ $sc->balance }}</span>
                                            @else
                                                {{ $sc->balance }}
                                            @endif
        
                                        </td>
        
                                        {{-- <td>
                            @if ($sc->movedTotalToWallet() > 0)
                            <span class="badge badge-danger">{{ $sc->movedTotalToWallet() }}</span>
                            @else
                            {{ $sc->movedTotalToWallet() }}
                            @endif
                            
                          </td> --}}
        
                                        <td>{{ $sc->subscription_code }}</td>
                                        <td>{{ $sc->workStation ? $sc->workStation->title : '' }}</td>
                                        <td>{{ $sc->category ? $sc->category->name : '' }}</td>
        
                                        <td>
                                            @if ($sc->district)
                                                {{ $sc->district->name }} ({{ $sc->district_id }})
                                            @endif
                                        </td>
                                        <td>{{ $sc->referrer ? $sc->referrer->subscription_code : '' }}</td>
        
                                        {{-- <td>{{  $sc->referredTeam()->count() }} </td> --}}
        
                                        <th>{{ $sc->created_at }}</th>
        
        
                                    </tr>
        
                                    <?php $i++; ?>
        
        
        
                                @endforeach
                            </tbody>
        
        
        
                        </table>
        
                        {{ $iReffered->render() }}
        
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')
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
