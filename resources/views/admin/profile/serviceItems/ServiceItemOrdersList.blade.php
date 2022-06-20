@extends('admin.layouts.adminMaster')
@push('css')

@endpush

@section('content')
    <br>
    <section class="content">
     <div class="card">
         <div class="card-header">
             <div class="card-title">
                 Service Item Orders
             </div>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-striped" style="white-space: nowrap">
                     <thead>
                         <tr>
                             <th>#SL</th>
                             <th>Action</th>
                             <th>Item Image</th>
                             <th>Item Name</th>
                             <th>Item Price</th>
                             <th>Order Price</th>
                             <th>Order Confirm Balance</th>
                             <th>Order Status</th>
                             <th>Payment Status</th>
                             <th>Service Station</th>
                             <th>Category</th>
                             <th>Service Profile</th>
                             <th>User</th>
                             <th>Created At</th>
                         </tr>
                     </thead>
                     <tbody>
                         @forelse ($serviceItemOrders as $order)
                         <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                <div class="btn-group btn-sm">
                                    <a href="{{ route('admin.serviceItemOrdersDetails',['order'=>$order->id]) }}" class="btn btn-info btn-xs">Details</a>
                                </div>
                            </td>
                            <td><img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $order->serviceitem->fi() ]) }}" alt="" srcset=""></td>
                            <td>{{ $order->serviceitem->title }}</td>
                            <td>{{ $order->serviceitem->price }}</td>
                            <td>{{ $order->final_price }}</td>
                            <td>{{ $order->order_confirmed_balance }}</td>
                            <td>{{ $order->order_status }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->workStation->title }}</td>
                            <td>{{ $order->category->name }}</td>
                            <td>{{ $order->serviceProfile->name }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->created_at }}</td>
                            
                        </tr>
                         @empty
                             
                         @endforelse
                        
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
    </section>
@endsection
@push('js')
  
@endpush