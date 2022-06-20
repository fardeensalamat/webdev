@extends('admin.layouts.adminMaster')

@push('css')



@endpush

@section('content')
    <section class="content">
        <div class="container-fluid">
            <br>
            @include('alerts.alerts')
            <div class="card-body bg-info">
                <h3 class="">All Service Profile Orders</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-white" style="white-space: nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Action</th>
                                    <th>Tenant</th>
                                    <th>WorkStation</th>
                                    <th>Category</th>
                                    <th>Service Profile</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>

                                <?php $i = ($orders->currentPage() - 1) * $orders->perPage() + 1; ?>

                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td><a href="{{ route('admin.serviceProductOrderDetails', ['order' => $order->id, 'profile' => $order->service_profile_id]) }}"
                                            class="btn btn-info btn-xs">Details</a></td>
                                        <td>@if ($order->user)
                                            <a class="btn btn-xs {{ $order->user->active ? '' : 'btn-danger' }} w3-round w3-border"
                                                href="{{ route('admin.usersAll', ['user' => $order->user]) }}">{{ $order->user_id }}</a>
                                        @endif</td>
                                        <td>{{ $order->workStation->title }}</td>
                                        <td>{{ $order->category->name }}</td>
                                        <td>{{ $order->serviceProfile->name }} ({{ $order->service_profile_id }})</td>
                                        <td>{{ $order->total_quantity }}</td>
                                        <td>{{ $order->total_sale_price }}</td>
                                        <td>{{ $order->payment_status }}</td>
                                        <td>{{ $order->order_status }}</td>
                                        <td>{{ $order[$order->order_status."_at"]}}</td>
                                        
                                    </tr>
                                    <?php $i++; ?>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-danger">No Order Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $orders->render() }}
                </div>
            </div>

        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')


@endpush
