@extends('subscriber.layouts.userMaster')

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
                    <h3>All Orders</h3>
                    <p><strong>Cat: </strong>{{ $profile->category->name }} <strong>SS:
                        </strong>{{ $profile->workstation->title }}</p>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="white-space: nowrap">
                        <div class="thead">
                            <tr>
                                <th>#SN</th>
                                <th>Transaction No</th>
                                <th>Quantity</th>
                                <th>Sale Price</th>
                                <th>Purchase Price</th>
                                <th>confirmed Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                <?php $i = 1; ?>
                
                                <?php $i = (($my_orders->currentPage() - 1) * $my_orders->perPage() + 1); ?>
                                @forelse ($my_orders as $order)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $order->transection_id }}</td>
                                        <td>{{ $order->total_quantity }}</td>
                                        <td>{{ $order->total_sale_price }}</td>
                                        <td>{{ $order->total_purchase_price }}</td>
                                        <td>{{ $order->order_confirmed_price }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->order_status }}</td>
                                        <td><a href="{{ route('subscriber.OrdersOfServieProfileProducts',['order'=>$order->id,'profile'=>$profile->id,'subscription'=>$subscription->subscription_code]) }}" class="btn btn-info btn-xs">Details</a></td>
                                    </tr>
                                    <?php $i++; ?>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-danger">No Order Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </div>
                    </table>
                </div>
                {{ $my_orders->render() }}
            </div>

        </div>
    </section>
@endsection
@push('js')

@endpush
