@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="card-body bg-info">
            <h3 class="">{{__('orderdashboard.received_products_orders')}}</h3>
        </div>
       <div class="card">
           <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-white" style="white-space: nowrap">
                    <thead>
                        <tr>
                            <th>  {{__('orderdashboard.sl_no')}}</th>
                            <th>  {{__('orderdashboard.action')}}</th>
                            {{-- <th>WorkStation</th>
                            <th>Category</th> --}}
                            <th>  {{__('orderdashboard.change_status')}}</th>
                            <th>  {{__('orderdashboard.order_status')}}</th>
                            <th>  {{__('orderdashboard.delivery_man')}}</th>
                            <th>  {{__('orderdashboard.courier')}}</th>
                            <th>  {{__('orderdashboard.price')}}</th>
                            <th>  {{__('orderdashboard.service_profile')}}</th>
                            {{-- <th>Quantityx</th> --}}
                         
                            <th>  {{__('orderdashboard.payment_status')}}</th>
                            <th>  {{__('orderdashboard.date')}}</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                
                        <?php $i = (($orders->currentPage() - 1) * $orders->perPage() + 1); ?>
    
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $i }}</td>
                                <td><a href="{{ route('user.myProfileOrderDetails',['order'=>$order->id,'profile'=>$order->service_profile_id]) }}" class="btn btn-info btn-xs">Details</a></td>
                                <td>
                                    @if ($order->order_status != 'satisfied' && $order->order_status != 'unsatisfied')
                                        <form class="form-inline" method="post"
                                            action="{{ route('subscriber.orderStatusUpdateOfServiceProducts') }}">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            {{-- <input type="hidden" name="item_id" value="{{ $item->id }}"> --}}
                                            {{-- <input type="checkbox" name="allItem" id="allItem"> <label
                                                for="allItem">With All items</label> &nbsp; --}}
                                            <div class="input-group mb-3 input-group-sm">

                                                <select class="form-control" name="order_status"
                                                    id="order_status">
                                                    @if ($order->order_status == 'pending')
                                                                    <option
                                                                        {{ $order->order_status == 'pending' ? 'selected' : '' }}
                                                                        value="pending">Pending</option>
                                                                    <option
                                                                        {{ $order->order_status == 'confirmed' ? 'selected' : '' }}
                                                                        value="confirmed">Confirmed</option>
                                                                    <option
                                                                        {{ $order->order_status == 'cancelled' ? 'selected' : '' }}
                                                                        value="cancelled">Cancelled</option>
                                                                @elseif($order->order_status=='confirmed')
                                                                    <option
                                                                        {{ $order->order_status == 'confirmed' ? 'selected' : '' }}
                                                                        value="confirmed">Confirmed</option>
                
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
                                                                    <option
                                                                        {{ $order->order_status == 'returned' ? 'selected' : '' }}
                                                                        value="returned">Returned</option>
                                                                        @elseif($order->order_status=='delivered')
                                                                        <option
                                                                            {{ $order->order_status == 'delivered' ? 'selected' : '' }}
                                                                            value="delivered">Delivered</option>
                                                                    @elseif($order->order_status=='undelivered')
                                                                        <option
                                                                            {{ $order->order_status == 'undelivered' ? 'selected' : '' }}
                                                                            value="undelivered">Undelivered</option>
                                                                    @elseif($order->order_status=='cancelled')
                                                                        <option
                                                                            {{ $order->order_status == 'cancelled' ? 'selected' : '' }}
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
                                    @elseif( $order->order_status=='satisfied'||$order->order_status=='unsatisfied')
                                     Order Done
                                    @else

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
                                <td>
                                    @if ($order->order_status == 'confirmed' || $order->order_status == 'delivered')
                                    <form class="form-inline" method="post"
                                            action="{{ route('subscriber.orderSelectDeliveryman') }}">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <div class="input-group mb-3 input-group-sm">
                                          
                                                <select class="form-control" name="deliveryman_id"
                                                    id="deliveryman_id">
                                                    <option value="">Choose</option>
                                                    @foreach ($deliveryman as $data)
                                                    <option value="{{$data->id}}" @if($order->deliveryman_id==$data->id) Selected @endif>{{$data->name}}</option>   
                                                    @endforeach
                                                    <optgroup label="Cycling">
                                                    @foreach ($cycling as $c)
                                                    <option value="{{$c->id}}">{{$c->name}}</option>   
                                                    @endforeach
                                                    <optgroup label="Rider">
                                                    @foreach ($rider as $r)
                                                    <option value="{{$r->id}}">{{$r->name}}</option>   
                                                    @endforeach
                                                    <optgroup label="Walking">
                                                    @foreach ($walking as $w)
                                                    <option value="{{$w->id}}">{{$w->name}}</option>   
                                                    @endforeach
                                                    
                                                    
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-success w3-indigo"
                                                        type="submit">Select</button>
                                                </div>
                                            </div>

                                        </form>
                                    @else
                                     {{$order->deliveryman->name ?? ''}}
                                    @endif
                                </td>
                                <td><a href="{{ route('user.getCourier') }}" class="btn btn-warning btn-xs">Get Courier</a></td>
                                <td>{{ $order->total_sale_price }}</td>
                                <td>{{ $order->serviceProfile->name ?? '' }}</td>
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
            {{ $orders->render() }}
           </div>
       </div>

        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')


@endpush
