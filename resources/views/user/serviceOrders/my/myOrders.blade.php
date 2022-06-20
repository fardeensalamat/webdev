@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="card-body bg-info">
            <h3 class=""> {{__('orderdashboard.given_product_orders')}}</h3>
        </div>
       <div class="card">
           <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-white" style="white-space: nowrap">
                    <thead>
                        <tr>
                            <th>{{__('orderdashboard.sl_no')}}</th>
                            <th>{{__('orderdashboard.action')}}</th>
                            {{-- <th>WorkStation</th>
                            <th>Category</th> --}}
                            <th>{{__('orderdashboard.change_status')}}</th>
                            <th>{{__('orderdashboard.order_status')}}</th>
                            <th>{{__('orderdashboard.price')}}</th>
                            <th>{{__('orderdashboard.service_profile')}}</th>
                            {{-- <th>Quantity</th> --}}
                         
                            <th>{{__('orderdashboard.payment_status')}}</th>
                            <th>{{__('orderdashboard.date')}}</th>
                            
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
                                <td>{{ $order->serviceProfile->name ?? ''}}</td>
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

        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')


@endpush
