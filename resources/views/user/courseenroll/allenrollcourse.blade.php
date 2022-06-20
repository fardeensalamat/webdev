@extends('user.layouts.userMaster')

@push('css')
    {{-- <style>
    @media only screen and (max-width: 600px) {
        center {
    text-align: center;
        }
} --}}
    {{-- </style> --}}


@endpush
@section('content')
    <br>

    <section class="content">
        <div class="card">
            @include('alerts.alerts')
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3>   {{__('orderdashboard.enrolled_courses')}}</h3>
                    
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="white-space: nowrap">
                        <div class="thead">
                            <tr>
                                <th>{{__('orderdashboard.sl_no')}}</th>
                                <th>{{__('orderdashboard.order_no')}}</th>
                                <th>{{__('orderdashboard.course_name')}}</th>
                                <th>{{__('orderdashboard.course_instructor')}}</th>
                                <th>{{__('orderdashboard.profile')}}</th>
                                <th>{{__('orderdashboard.mobile')}}</th>
                                <th>{{__('orderdashboard.confirmed_price')}}</th>
                                <th>{{__('orderdashboard.date')}}</th>
                                <th>{{__('orderdashboard.action')}}</th>
                            </tr>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->course->title }}</td>
                                        <td>{{ $order->course->ins_name }}</td>
                                        <td>{{ $order->course->serviceProfile->name }}</td>
                                        <td>{{ $order->course->serviceProfile->mobile }}</td>
                                        <td>{{ $order->order_confirmed_price }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td><a href="{{ route('user.EnrollCourseDetails',['order'=>$order->id]) }}" class="btn btn-info btn-xs">Details</a></td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-danger">No Enroll Course Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </div>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('js')

@endpush
