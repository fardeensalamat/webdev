@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="card-body bg-info">
            <h3 class="">Given Product Orders</h3>
        </div>
       <div class="card">
           <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-white" style="white-space: nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Action</th>
                            {{-- <th>WorkStation</th>
                            <th>Category</th> --}}
                            <th>Change Status</th>
                            <th>Order Status</th>
                            <th>Price</th>
                            <th>Service Profile</th>
                            {{-- <th>Quantity</th> --}}
                         
                            <th>Payment Status</th>
                            <th>Date</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>

                        <?php $i = (($my_orders->currentPage() - 1) * $my_orders->perPage() + 1); ?>
                        @forelse ($my_orders as $order)
                            <tr>
                                <th>{{ $i }}</th>
                                <td>
                                    <a href="{{ route('user.myOrderDetails',['order'=>$order->id]) }}" class="btn btn-info btn-xs">Details</a>
                                   
                                </td>
                                <td>
                                    @if ($order->order_status == 'delivered')
                                        <form class="form-inline" method="post"
                                            action="{{ route('user.myOrderDetailsUpdate') }}">
                                                    @csrf
                                                
                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                    <input type="hidden" name="cat_id" value="{{ $order->ws_cat_id }}">
                                                    <input type="hidden" name="order_status" value="satisfied">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success"
                                                            type="submit">Satisfied</button>
                                                    </div>
                                                
                                        </form>
                                     
                                        <form class="form-inline" method="post"
                                        action="{{ route('user.myOrderDetailsUpdate') }}">
                                        @csrf
                                    
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <input type="hidden" name="cat_id" value="{{ $order->ws_cat_id }}">
                                        <input type="hidden" name="order_status" value="unsatisfied">
                                        <div class="input-group-append">
                                            <button class="btn btn-warning"
                                                type="submit">Unsatisfied</button>
                                        </div>
                                        </form>
                                    @elseif($order->order_status == 'satisfied'|| $order->order_status == 'unsatisfied')
                                      Order Done
                                    @endif
                                </td>
                                {{-- <td>{{ $order->workStation->title }}</td>
                                <td>{{ $order->category->name }}</td> --}}
                                <td>
                                    {{ $order->order_status == 'pending' ? 'Pending' : '' }}
                                    {{ $order->order_status == 'confirmed' ? 'Confirmed' : '' }}
                                    {{ $order->order_status == 'cancelled' ? 'Cancelled' : '' }}
                                    {{ $order->order_status == 'ready_to_ship' ? 'Processing' : '' }}
                                    {{ $order->order_status == 'processing' ? 'Processing' : '' }}
                                    {{ $order->order_status == 'shipped' ? 'Shipped' : '' }}
                                    {{ $order->order_status == 'delivered' ? 'Delivered' : '' }}
                                    {{ $order->order_status == 'undelivered' ? 'Undelivered' : '' }}
                                    {{ $order->order_status == 'returned' ? 'Returned' : '' }}
                                    {{ $order->order_status == 'satisfied' ? 'Satisfied' : '' }}
                                    {{ $order->order_status == 'unsatisfied' ? 'Unsatisfied' : '' }}
                                </td>
                                <td>{{ $order->total_sale_price }}</td>
                                <td>{{ $order->serviceProfile->name }}</td>
                                {{-- <td>{{ $order->total_quantity }}</td> --}}
                             
                                <td>
                                  
                                    {{ $order->payment_status == 'advanced' ? 'Advanced' : '' }}
                                    {{ $order->payment_status == 'paid' ? 'Paid' : '' }}
                                    {{ $order->payment_status == 'cashon' ? 'Cash On' : '' }}
                                
                                </td>
                            
                                <td>{{ date("d-m-Y", strtotime($order[$order->order_status."_at"]))}}</td>
                                
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
            {{ $my_orders->render() }}
           </div>
       </div>
       <div class="card">
        <div class="card-header">
            <div class="card-title">Given Service Orders</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" style="white-space: nowrap">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Action</th>
                        {{-- <th>Image</th> --}}
                        {{-- <th>Title</th> --}}
                        <th>Price</th>
                        <th>Service Profile</th>
                        <th>Category</th>
                        <th>Workstation</th>
                        <th>Date</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody>
                   @forelse ( $orders as $data)
                   <tr>
                    <td>{{ $data->id }}</td>
                    <td>
                        <div class="btn-group btn-sm">
                          <a href="{{ route('user.ServieItemOrderDetails',['order'=>$data->id,'type'=>'user']) }}" class="btn btn-success">Details</a>
                        </div>
                    </td>
                    {{-- <td><img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $order->serviceitem->fi() ]) }}" alt=""></td> --}}
                    {{-- <td>{{ $data->serviceitem->title }}</td> --}}
                    <td>{{ $data->final_price }}</td>
                    <td>{{ $data->serviceProfile ? $data->serviceProfile->name : null }}</td>
                    <td>{{ $data->category ? $data->category->name : null }}</td>
                    <td>{{ $data->workstation ? $data->workstation->title: null }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                    <td>{{ $data->payment_status }}</td> 
                    <td>{{ $data->order_status }}</td> 
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
