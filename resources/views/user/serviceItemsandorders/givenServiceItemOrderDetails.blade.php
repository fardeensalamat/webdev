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
                @if ($order->order_status == 'delivered')
                    <div class="card-footer">
                        <form action="{{ route('welcome.orderStatusUpdate', ['payment' => $order->id]) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <select name="order_status" id="" class="form-control">
                                            <option value="satisfied">Satisfied
                                            </option>
                                            <option value="un_satisfied">Un Satisfied
                                            </option>
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <input type="submit" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')

@endpush
