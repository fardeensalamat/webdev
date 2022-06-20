@extends('user.layouts.userMaster')

@push('css')

    <style>


        @media only screen and (max-width: 540px) {
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
            <div class="row">
                <div class="col-sm-6 m-auto">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-primary">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <h3 class="widget-user-username">{{ ucfirst($user->name) }}</h3>
                                </div>
                                <div class="col-md-4"><a href="{{ route('user.userEdit') }}" class="btn btn-info">Edit</a></div>
                            </div>
                            {{-- <h5 class="widget-user-desc">Admin Setting Area</h5> --}}
                        </div>
                        <div class="widget-user-image">
                            @if ($user->img_name)


                                {{-- {{ asset('storage/user/image/'.$user->img_name) }} --}}
                                <img class="img-circle elevation-2"
                                    src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $user->fi()]) }}"
                                    alt="User Avatar">
                            @else
                                <img class="img-circle elevation-2" src="{{ asset('img/ppm.jpg') }}" alt="User Avatar">
                            @endif

                        </div>
                        <div class="card-footer" style="min-height: 207px;">
                            <div class="row">

                                <!-- /.col -->
                                {{-- pf number --}}
                                <div class="col-sm-10 ">
                                    <div class="description-block">
                                        <h5 class="description-header p-b-2">Name: {{ ucfirst($user->name) }}</h5>
                                        <span class="description-text ">
                                            {{ ucfirst($user->mobile) }}
                                        </span> <br>
                                        <span class="description-text ">
                                            {{ $user->email }}
                                        </span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>

                        <div class="card-footer p-0">
                            <ul class="nav flex-column">



                            </ul>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
            </div>
        </div>

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

@endpush
