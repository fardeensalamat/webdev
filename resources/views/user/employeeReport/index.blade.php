@extends('user.layouts.userMaster')

@section('content')
    <section class="content">

        <br>
        <div class="row">

            <div class="col-sm-12">

                @include('alerts.alerts')

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                           {{__('employeeReport.employeereport')}}
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-default text-dark btn-sm" href="{{route('user.employeeReportAdd')}}" >
                                <i class="fa fa-plus"></i>{{__('employeeReport.add_report')}}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">


                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>{{__('employeeReport.sl')}}</th>
                                        <th>{{__('employeeReport.type')}}</th>
                                        <th>{{__('employeeReport.date')}}</th>
                                        <th>{{__('employeeReport.note')}}</th>
                                        <th>{{__('employeeReport.specialnote')}}</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>

                                <tbody>

                                <?php $i = 1; ?>



                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $data->type }}</td>
                                        <td>{{ $data->date }}</td>
                                        <td>{{ $data->note }}</td>
                                        <td>{{ $data->special_note }}</td>
                                        <td>{{$data->created_at->format('g:i:s A')}}</td>
                                        @if($data->status != 'start')
                                        <td>{{$data->updated_at->format('g:i:s A')}}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td  >

                                            @if($data->status == 'start')
                                                <a class="btn btn-success btn-sm" href="{{route('user.employeeReport.edit', $data->id)}}">Edit</a>

                                            @else
                                            <span>Done</span>
                                            @endif
                                        </td>

                                    </tr>

                                    <?php $i++; ?>

                                @endforeach

                                </tbody>

                            </table>



                        </div>



                    </div>
                </div>
            </div>
        </div>


        <style>
            .report_close{
                display: none;
            }
        </style>
    </section>
@endsection


@push('js')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHDmzYhDx3eLGS-WFobnapHpUA8JfTAoA&sensor=false"></script>
    <script>
        var geocoder;
        function initializes() {

            geocoder = new google.maps.Geocoder();
        }

        function codeLatLngs(lat , lng) {
            var latlng = new google.maps.LatLng(lat, lng);

            geocoder.geocode({
                'latLng': latlng
            }, function(results, status) {
                console.log(results);
                var lets =  results[0].formatted_address.split(',');
                // console.log(let[1] , let[2])
                // document.getElementById("test").innerHTML = '' + (results[0].formatted_address); + '';

                document.getElementById("last_location").value = lets[1]+ lets[2];




            });
        }



        // var x = document.getElementById("demo");
        function getLocationse() {

                if (navigator.geolocation) {
                    navigator.geolocation.watchPosition(showPositionse);
                } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }


        }
        function showPositionse(position) {
            // document.getElementById("lat").innerHTML = position.coords.latitude;
            // document.getElementById("lod").innerHTML = position.coords.longitude;
            initializes();

            codeLatLngs(position.coords.latitude, position.coords.longitude);
            $('.get_location').css('display', 'none');
            $('.report_close').css('display', 'block');


            {{--var id = $('.report_close').data("id");--}}

            {{--var lets =  document.getElementById("last_location").value;--}}

            {{--$.ajax({--}}
            {{--    url:"{{route('user.employeeReport.Status')}}",--}}
            {{--    method:'post',--}}
            {{--    data:{'value':lets, 'id':id},--}}
            {{--    success:function (data){--}}
            {{--        console.log(data);--}}
            {{--    }--}}
            {{--});--}}


        }


    </script>



@endpush

