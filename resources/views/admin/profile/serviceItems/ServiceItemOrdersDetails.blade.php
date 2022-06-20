@extends('admin.layouts.adminMaster')
@push('css')

@endpush

@section('content')
    <br>
    <section class="content">
     <div class="card">
         <div class="card-header">
             <div class="card-title">
                Order Details of {{ $order->serviceitem? $order->serviceitem->title :null }} ({{ $order->id }})
             </div>
         </div>
         <div class="card-body">
            <p><b>Service Item Owner: </b>{{ $order->serviceitem? $order->serviceitem->user->name : null }}</p>
            <p><b>Service Item Price: </b>{{ $order->serviceitem? $order->serviceitem->price: null }}</p>
            <p><b>Order Status: </b><span class="badge badge-success">{{ $order->order_status }}</span></p>
            <p><b>Payment Status: </b><span class="badge badge-info">{{ $order->payment_status }}</span></p>
            <form action="{{ route('welcome.orderStatusUpdate', ['payment' => $order->id]) }}" method="POST"> @csrf
                <div class="form-group">
                    <select name="order_status" id="" class="form-control">
                        <option value="satisfied">sutisfied</option>
                        <option value="un_satisfied">unsutisfied
                        </option>
                    </select>
                </div>
                <input type="submit" class="btn btn-info">
            </form>
         </div>
     </div>
    </section>
@endsection
@push('js')
  
@endpush