@extends('user.layouts.userMaster')
@push('css')


@endpush

@section('content')
    <section class="content">
        <br>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">  {{__('orderdashboard.received_service_orders')}}</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="white-space: nowrap">
                        <thead>
                            <tr>
                                <th>{{__('orderdashboard.sl_no')}}</th>
                                <th>{{__('orderdashboard.action')}}</th>
                                <th>{{__('orderdashboard.image')}}</th>
                                <th>{{__('orderdashboard.title')}}</th>
                                <th>{{__('orderdashboard.price')}}</th>
                                <th>{{__('orderdashboard.service_profile')}}</th>
                                <th>{{__('orderdashboard.category')}}</th>
                                <th>{{__('orderdashboard.workstation')}}</th>
                                <th>{{__('orderdashboard.date')}}</th>
                                <th>{{__('orderdashboard.payment_status')}}</th>
                                <th>{{__('orderdashboard.order_status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ( $orders as $order)
                           <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                <div class="btn-group btn-sm">
                                  <a href="{{ route('user.ServieItemOrderDetails',['order'=>$order->id,'type'=>'owner']) }}" class="btn btn-success">Details</a>
                                </div>
                            </td>
                            <td><img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $order->serviceitem->fi() ]) }}" alt=""></td>
                            <td>{{ $order->serviceitem->title }}</td>
                            <td>{{ $order->final_price }}</td>
                            <td>{{ $order->serviceProfile ? $order->serviceProfile->name : null }}</td>
                            <td>{{ $order->category ? $order->category->name : null }}</td>
                            <td>{{ $order->workstation ? $order->workstation->title: null }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                            <td>{{ $order->payment_status }}</td> 
                            <td>{{ $order->order_status }}</td> 
                        </tr>
                           @empty
                               <tr>
                                   <td colspan="">No Item Found</td>
                               </tr>
                           @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')

@endpush
