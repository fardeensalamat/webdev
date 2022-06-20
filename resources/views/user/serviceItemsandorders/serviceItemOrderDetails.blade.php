@extends('user.layouts.userMaster')
@push('css')


@endpush

@section('content')
    <section class="content">
        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
            <div class="card">
                <div class="card-body bg-info">
                    <h3>{{ $order->serviceitem->title }}</h3>
                </div>
                <div class="card-body">
                    {!! $order->serviceitem->description !!}
                    <b>Categories: </b> <span class="badge badge-info">{{ $order->category->name }}</span>
                    <b>WorkStation: </b> <span class="badge badge-info">{{ $order->workstation->title }}</span>
                    <p><b>Price: </b> {{ $order->final_price }}</p>
                    <p><b>Payment Status:</b> <span class="badge badge-info">{{ $order->payment_status }}</span></p>
                    <p><b>Order Status:</b> <span class="badge badge-success">{{ $order->order_status }}</span></p>
                </div>
                <div class="card-footer">

                    @if (($order->order_status != 'delivered') or ($order->order_status != 'satisfied'))
                        <form action="{{ route('welcome.orderStatusUpdate', ['payment' => $order->id]) }}" method="POST">
                            @csrf
                            {{-- @if ($order->user_id == Auth::id())
                                @if (!$order->order_status == 'delivered' or !$order->order_status == 'satisfied')
                                    ddd
                                @endif
                            @endif --}}
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <select name="order_status" id="" class="form-control">
                                            @if ($order->order_status == 'pending')
                                                <option value="confirmed">Confirmed
                                                </option>
                                                <option value="canceled">Canceled
                                                </option>
                                            @elseif ($order->order_status ==
                                                'confirmed')
                                                <option value="delivered">Delivered
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <input type="submit" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')

@endpush
