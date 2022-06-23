@extends('admin.layouts.adminMaster')

@section('content')
    <section class="content">
        <div class="row">

            <div class="col-sm-12">

                @include('alerts.alerts')

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Admin Panel:  {{__('employeeReport.employeereport')}}
                        </h3>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="row">
                            <div class="col-12 col-sm-12 col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Name: {{$employeDetails->user->name}}</li>
                                    <li class="list-group-item">Start Location: {{$employeDetails->start_location}}</li>
                                    <li class="list-group-item">End Location {{$employeDetails->end_location}}</li>
                                    <li class="list-group-item">Note: {{$employeDetails->note}}</li>
                                    <li class="list-group-item">Special Note: {{$employeDetails->special_note}}</li>
                                </ul>

                            </div>

                            <div class="col-12 col-sm-12 col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Start Lat: {{$employeDetails->start_lat}}</li>
                                    <li class="list-group-item">Start Lng: {{$employeDetails->start_lng}}</li>
                                    <li class="list-group-item">End Lat: {{$employeDetails->end_lat}}</li>
                                    <li class="list-group-item">End Lng: {{$employeDetails->end_lng}}</li>
                                    <li class="list-group-item">Record Status: Paid: {{count($paidService)}} | Unpaid: {{count($unpaidService)}} | Trial: {{count($trilService)}}</li>
                                </ul>
                            </div>

                            </div>

                            @if(count($paidService))

                            <table class="table table-hover" style="margin-top: 20px">

                                <h4 >
                                   Paid History
                                </h4>
                                <thead>
                                <tr>
                                    <th>SL/N</th>
{{--                                    <th>Image</th>--}}
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Profile Type</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>

                                    @foreach($paidService as $paid)
                                        <tr>
                                            <td>{{$i}}</td>
{{--                                            <td><img src="" alt=""></td>--}}
                                            <td>{{$paid->name}}</td>
                                            <td>{{$paid->mobile}}</td>
                                            <td>{{$paid->location}}</td>
                                            <td>@if($paid->status == 1) Active @else Inactive @endif</td>
                                            <td>{{$paid->profile_type}}</td>
                                            <td>{{$paid->created_at->format('d-M-Y')}}</td>
                                            <td>Action</td>
                                        </tr>
                                    @endforeach



                                </tbody>

                            </table>

                            @endif


                            @if(count($unpaidService))
                            <table class="table table-hover" style="margin-top: 20px">

                                <h4 >
                                    Unpaid History
                                </h4>
                                <thead>
                                <tr>
                                    <th>SL/N</th>
                                    {{--                                    <th>Image</th>--}}
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Profile Type</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>
                                </thead>

                                <tbody>
                                <?php $i = 1; ?>

                                @foreach($unpaidService as $paid)
                                    <tr>
                                        <td>{{$i}}</td>
                                        {{--                                            <td><img src="" alt=""></td>--}}
                                        <td>{{$paid->name}}</td>
                                        <td>{{$paid->mobile}}</td>
                                        <td>{{$paid->location}}</td>
                                        <td>@if($paid->status == 1) Active @else Inactive @endif</td>
                                        <td>{{$paid->profile_type}}</td>
                                        <td>{{$paid->created_at->format('d-M-Y')}}</td>
                                        <td>Action</td>
                                    </tr>
                                @endforeach



                                </tbody>

                            </table>

                            @endif




                            @if(count($trilService))
                                <table class="table table-hover" style="margin-top: 20px">

                                    <h4 >
                                        Trail History
                                    </h4>
                                    <thead>
                                    <tr>
                                        <th>SL/N</th>
                                        {{--                                    <th>Image</th>--}}
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Profile Type</th>
                                        <th>Date</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php $i = 1; ?>

                                    @foreach($trilService as $paid)
                                        <tr>
                                            <td>{{$i}}</td>
                                            {{--                                            <td><img src="" alt=""></td>--}}
                                            <td>{{$paid->name}}</td>
                                            <td>{{$paid->mobile}}</td>
                                            <td>{{$paid->location}}</td>
                                            <td>@if($paid->status == 1) Active @else Inactive @endif</td>
                                            <td>{{$paid->profile_type}}</td>
                                            <td>{{$paid->created_at->format('d-M-Y')}}</td>
                                            <td>Action</td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>

                            @endif



                        </div>



                    </div>
                </div>
            </div>
        </div>




    </section>
@endsection


@push('js')




@endpush

