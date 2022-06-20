@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="card-body bg-info">
            <h3 class="">Received Products Orders</h3>
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
                
                        <?php //$i = (($orders->currentPage() - 1) * $orders->perPage() + 1); ?>
    
                        @forelse ($orders as $data)
                            <tr>
                                <td>{{ $i }}</td>
                                <td><a href="{{ route('user.myProfileOrderDetails',['order'=>$data->id,'profile'=>$data->service_profile_id]) }}" class="btn btn-info btn-xs">Details</a></td>
                                <td>
                                    @if ($data->order_status != 'satisfied' && $data->order_status != 'unsatisfied')
                                        <form class="form-inline" method="post"
                                            action="{{ route('subscriber.orderStatusUpdateOfServiceProducts') }}">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $data->id }}">
                                            {{-- <input type="hidden" name="item_id" value="{{ $item->id }}"> --}}
                                            {{-- <input type="checkbox" name="allItem" id="allItem"> <label
                                                for="allItem">With All items</label> &nbsp; --}}
                                            <div class="input-group mb-3 input-group-sm">

                                                <select class="form-control" name="order_status"
                                                    id="order_status">
                                                    @if ($data->order_status == 'pending')
                                                                    <option
                                                                        {{ $data->order_status == 'pending' ? 'selected' : '' }}
                                                                        value="pending">Pending</option>
                                                                    <option
                                                                        {{ $data->order_status == 'confirmed' ? 'selected' : '' }}
                                                                        value="confirmed">Confirmed</option>
                                                                    <option
                                                                        {{ $data->order_status == 'cancelled' ? 'selected' : '' }}
                                                                        value="cancelled">Cancelled</option>
                                                                @elseif($data->order_status=='confirmed')
                                                                    <option
                                                                        {{ $data->order_status == 'confirmed' ? 'selected' : '' }}
                                                                        value="confirmed">Confirmed</option>
                
                                                                    <option
                                                                        {{ $data->order_status == 'processing' ? 'selected' : '' }}
                                                                        value="processing">Processing</option>
                                                                    <option
                                                                        {{ $data->order_status == 'ready_to_ship' ? 'selected' : '' }}
                                                                        value="ready_to_ship">Ready To Ship</option>
                                                                    <option
                                                                        {{ $data->order_status == 'shipped' ? 'selected' : '' }}
                                                                        value="shipped">Shipped</option>
                                                                        <option
                                                                        {{ $data->order_status == 'delivered' ? 'selected' : '' }}
                                                                        value="delivered">Delivered</option>
                                                                    <option
                                                                        {{ $data->order_status == 'undelivered' ? 'selected' : '' }}
                                                                        value="undelivered">Undelivered</option>   

                                                                    <option
                                                                        {{ $data->order_status == 'cancelled' ? 'selected' : '' }}
                                                                        value="cancelled">Cancelled</option>
                                                                    <option
                                                                        {{ $data->order_status == 'returned' ? 'selected' : '' }}
                                                                        value="returned">Returned</option>
                                                                        @elseif($data->order_status=='delivered')
                                                                        <option
                                                                            {{ $data->order_status == 'delivered' ? 'selected' : '' }}
                                                                            value="delivered">Delivered</option>
                                                                    @elseif($data->order_status=='undelivered')
                                                                        <option
                                                                            {{ $data->order_status == 'undelivered' ? 'selected' : '' }}
                                                                            value="undelivered">Undelivered</option>
                                                                    @elseif($data->order_status=='cancelled')
                                                                        <option
                                                                            {{ $data->order_status == 'cancelled' ? 'selected' : '' }}
                                                                            value="cancelled">Cancelled</option>
                                                                    @else
                                                                            <option
                                                                                {{ $order->order_status == 'processing' ? 'selected' : '' }}
                                                                                value="processing">Processing</option>
                                                                            <option
                                                                                {{ $order->order_status == 'ready_to_ship' ? 'selected' : '' }}
                                                                                value="ready_to_ship">Ready To Ship</option>
                                                                            <option
                                                                                {{ $order->order_status == 'shipped' ? 'selected' : '' }}
                                                                                value="shipped">Shipped</option>
                                                                                <option
                                                                                {{ $order->order_status == 'delivered' ? 'selected' : '' }}
                                                                                value="delivered">Delivered</option>
                                                                            <option
                                                                                {{ $order->order_status == 'undelivered' ? 'selected' : '' }}
                                                                                value="undelivered">Undelivered</option>   
    
                                                                            <option
                                                                                {{ $order->order_status == 'cancelled' ? 'selected' : '' }}
                                                                                value="cancelled">Cancelled</option>
                                                                            <option>
                                                                     @endif

                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-success w3-indigo"
                                                        type="submit">Update</button>
                                                </div>
                                            </div>

                                        </form>
                                    @elseif( $data->order_status=='satisfied'||$data->order_status=='unsatisfied')
                                     Order Done
                                    @else

                                    @endif

                                </td>

                                 {{-- <td>{{ $order->workStation->title }}</td>
                                <td>{{ $order->category->name }}</td> --}}
                                <td>
                                    {{ $data->order_status == 'pending' ? 'Pending' : '' }}
                                    {{ $data->order_status == 'confirmed' ? 'Confirmed' : '' }}
                                    {{ $data->order_status == 'cancelled' ? 'Cancelled' : '' }}
                                    {{ $data->order_status == 'ready_to_ship' ? 'Processing' : '' }}
                                    {{ $data->order_status == 'processing' ? 'Processing' : '' }}
                                    {{ $data->order_status == 'shipped' ? 'Shipped' : '' }}
                                    {{ $data->order_status == 'delivered' ? 'Delivered' : '' }}
                                    {{ $data->order_status == 'undelivered' ? 'Undelivered' : '' }}
                                    {{ $data->order_status == 'returned' ? 'Returned' : '' }}
                                    {{ $data->order_status == 'satisfied' ? 'Satisfied' : '' }}
                                    {{ $data->order_status == 'unsatisfied' ? 'Unsatisfied' : '' }}
                                </td>
                                <td>{{ $data->total_sale_price }}</td>
                                <td>{{ $data->serviceProfile->name }}</td>
                                {{-- <td>{{ $order->total_quantity }}</td> --}}
                             
                                <td>
                                  
                                    {{ $data->payment_status == 'advanced' ? 'Advanced' : '' }}
                                    {{ $data->payment_status == 'paid' ? 'Paid' : '' }}
                                    {{ $data->payment_status == 'cashon' ? 'Cash On' : '' }}
                                
                                </td>
                            
                                <td>{{ date("d-m-Y", strtotime($data[$data->order_status."_at"]))}}</td>
                                
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
            {{-- {{ $orders->render() }} --}}
           </div>
       </div>
       <div class="card">
        <div class="card-header">
            <div class="card-title">Received Service Orders</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" style="white-space: nowrap">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Action</th>
                        <th>Image</th>
                        <th>Title</th>
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
                   @forelse ( $orders2 as $data)
                   <tr>
                    <td>{{ $data->id }}</td>
                    <td>
                        <div class="btn-group btn-sm">
                          <a href="{{ route('user.ServieItemOrderDetails',['order'=>$data->id,'type'=>'owner']) }}" class="btn btn-success">Details</a>
                        </div>
                    </td>
                    <td><img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $data->serviceitem->fi() ]) }}" alt=""></td>
                    <td>{{ $data->serviceitem->title }}</td>
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
