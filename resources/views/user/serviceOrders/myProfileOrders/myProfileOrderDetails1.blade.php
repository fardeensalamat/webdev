@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="card">
            <div class="card-body">
                <span style="cursor: pointer;padding: 0 10px; font-size: large;" class=""
                    onClick="printdiv('div_print');" value=" Print "><i class="fa fa-print"></i></span> <span
                    class="btn btn-info btn-xs">Custom Order</span>
                <br>
                <br>

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <p style="margin: 0;"><img
                                    src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $order->serviceProfile->fi()]) }}"
                                    style="max-width: 150px;"></p>
                            <p><span class="badge badge-success">{{ $order->category->name }}</span> <span
                                    class="badge badge-success">{{ $order->workstation->title }}</span></p>
                        </div>
                        <h5>From:</h5>
                        <address>
                            <strong>{{ $order->serviceProfile->name }}.</strong><br>
                            {{ $order->serviceProfile->address . ' ' . $order->serviceProfile->city . ' ' . $order->serviceProfile->country . '-' . $order->serviceProfile->zip_code }}
                            <br>
                            <abbr title="Phone">Mobile:</abbr>
                            {{ $order->serviceProfile->mobile ?? 'Not Available' }}<br>
                        </address>
                        <p><strong>Payment: </strong><span class="btn btn-info btn-xs">{{ $order->payment_status }}</span>
                        </p>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h4>Invoice No.</h4>
                        <h4 class="text-success">{{ $order->transection_id }}</h4>
                        <span>To:</span>
                        <address>
                            <strong>{{ $order->name }} </strong><br>
                            {{ $order->delivery_address }}
                            <br>
                            <abbr title="Phone">Mobile:</abbr> {{ $order->phone }} <br>
                            {{-- <abbr title="Email">Email:</abbr>
                            {{ $order->email }} --}}
                        </address>
                        <p>
                            <span><strong>Invoice Date:</strong>
                                {{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</span><br />
                            <span><strong>{{ ucfirst($order->order_status) }} Date:</strong>
                                @if ($orderS = $order->order_status)
                                    {{ \Carbon\Carbon::parse($order[$orderS . '_at'])->format('Y-m-d') }}
                                @endif
                            </span>
                        </p>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive" style="padding-top:15px;background: white;">
                                    <table class="table invoice-table table-sm table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Item List</th>
                                                <th>Quantity</th>
                                                <th>Sale Price</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total_price = 0; ?>
                                            @foreach ($order->orderItems as $item)
                                                <tr>
                                                    <td>
                                                        <div><strong>{{ $item->product->name }}</strong></div>
                                                    </td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>BDT: {{ $item->sale_price }}</td>
                                                    <td>BDT: {{ $item->total_sale_price }}
                                                    </td>
                                                </tr>
                                                <?php $total_price += $item->total_sale_price; ?>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div><!-- /table-responsive -->


                            </div>
                            <div class="col-md-3 ml-auto">
                                <table class="table invoice-total">
                                    <tbody>
                                        <tr>
                                            <td><strong>Sub Total :</strong></td>
                                            <td>BDT: {{ $total_price }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>TOTAL :</strong></td>
                                            <td> BDT: {{ $total_price }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <div class="table table-striped">
                    <div class="card">
                        <div class="card-header bg-info">
                            Manage Products
                        </div>
                        <div class="card-body">
                            <div class="table-responsive m-t">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 50px;">SL</th>
                                            <th style="min-width: 70px;">Image</th>
                                            <th style="min-width: 300px;">Items</th>
                                            <th style="min-width: 300px;">Dalivery Date</th>
                                            <th style="min-width: 200px;">Order Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td>{{ 2 }}</td>
                                                <td>
                                                    <img src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $item->product->fi()]) }}"
                                                        alt="{{ $item->product->name }}">
                                                </td>
                                                <td>
                                                    <div><strong>{{ $item->product->name }}</strong></div>
                                                </td>
                                                {{-- <td>
                                                    @if ($item->order_status == 'delivered')
                                                    <form class="form-inline" method="post"
                                                    action="{{ route('subscriber.orderItemStatusUpdateOfServiceProducts') }}">
                                                    @csrf
                                                 
                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                    <div class="input-group mb-3 input-group-sm">
                                                        <select class="form-control" name="order_status" id="order_status">
                                                            <option {{ $item->order_status =="satisfied"?'selected':'' }} value="satisfied">Satisfied</option>
                                                            <option {{ $item->order_status =="unsatisfied"?'selected':'' }} value="unsatisfied">unsatisfied</option>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-success w3-indigo"
                                                                type="submit">Update</button>
                                                        </div>
                                                    </div>
                                                    
                                                </form>
                                                    @endif
                                                    
                                                    <span class="badge badge-success w3-indigo">{{ $item->order_status }} </span>

                                                </td> --}}
                                                <td>
                                                    <?php
                                                    $v = \Carbon\Carbon::now()->diffInDays($item->delivery_date, false);
                                                    ?>
                                                    @if ($item->delivery_date)
                                                        @if ($v < 0)
                                                            <span class="text-danger">{{ abs($v) }} Day
                                                                Late</span>

                                                        @else
                                                            <span class="text-success">{{ $v }} Day
                                                                Left</span>
                                                        @endif
                                                    @endif


                                                </td>
                                                <td>
                                                    {{-- @if ($item->order_status != 'satisfied')
                                                        <form class="form-inline" method="post"
                                                            action="{{ route('subscriber.orderItemStatusUpdateOfServiceProducts') }}">
                                                            @csrf

                                                            <input type="hidden" name="order_id"
                                                                value="{{ $order->id }}">
                                                            <input type="hidden" name="item_id"
                                                                value="{{ $item->id }}">
                                                            <div class="input-group mb-3 input-group-sm">
                                                                <select class="form-control" name="order_status"
                                                                    id="order_status">
                                                                    @if ($item->order_status == 'pending')
                                                                        <option
                                                                            {{ $item->order_status == 'pending' ? 'selected' : '' }}
                                                                            value="pending">Pending</option>
                                                                        <option
                                                                            {{ $item->order_status == 'confirmed' ? 'selected' : '' }}
                                                                            value="confirmed">Confirmed</option>
                                                                        <option
                                                                            {{ $item->order_status == 'cancelled' ? 'selected' : '' }}
                                                                            value="cancelled">Cancelled</option>
                                                                    @elseif($item->order_status=='confirmed')
                                                                        <option
                                                                            {{ $item->order_status == 'confirmed' ? 'selected' : '' }}
                                                                            value="confirmed">Confirmed</option>
                                                                        <option
                                                                            {{ $item->order_status == 'ready_to_ship' ? 'selected' : '' }}
                                                                            value="processing">Processing</option>
                                                                        <option
                                                                            {{ $item->order_status == 'cancelled' ? 'selected' : '' }}
                                                                            value="cancelled">cancelled</option>
                                                                    @elseif($item->order_status=='processing')
                                                                        <option
                                                                            {{ $item->order_status == 'processing' ? 'selected' : '' }}
                                                                            value="confirmed">Confirmed</option>
                                                                        <option
                                                                            {{ $item->order_status == 'ready_to_ship' ? 'selected' : '' }}
                                                                            value="ready_to_ship">Ready To Ship</option>
                                                                        <option
                                                                            {{ $item->order_status == 'cancelled' ? 'selected' : '' }}
                                                                            value="cancelled">cancelled</option>
                                                                    @elseif($item->order_status=='ready_to_ship')
                                                                        <option
                                                                            {{ $item->order_status == 'ready_to_ship' ? 'selected' : '' }}
                                                                            value="ready_to_ship">Ready To Ship</option>
                                                                        <option
                                                                            {{ $item->order_status == 'shipped' ? 'selected' : '' }}
                                                                            value="shipped">Shipped</option>
                                                                        <option
                                                                            {{ $item->order_status == 'cancelled' ? 'selected' : '' }}
                                                                            value="cancelled">Cancelled</option>
                                                                    @elseif($item->order_status=='shipped')
                                                                        <option
                                                                            {{ $item->order_status == 'shipped' ? 'selected' : '' }}
                                                                            value="shipped">Shipped</option>
                                                                        <option
                                                                            {{ $item->order_status == 'delivered' ? 'selected' : '' }}
                                                                            value="delivered">Delivered</option>
                                                                        <option
                                                                            {{ $item->order_status == 'undelivered' ? 'selected' : '' }}
                                                                            value="undelivered">Undelivered</option>
                                                                        <option
                                                                            {{ $item->order_status == 'cancelled' ? 'selected' : '' }}
                                                                            value="cancelled">Cancelled</option>
                                                                    @elseif($item->order_status=='delivered')
                                                                        <option
                                                                            {{ $item->order_status == 'delivered' ? 'selected' : '' }}
                                                                            value="delivered">Delivered</option>
                                                                    @elseif($item->order_status=='undelivered')
                                                                        <option
                                                                            {{ $item->order_status == 'undelivered' ? 'selected' : '' }}
                                                                            value="undelivered">Undelivered</option>
                                                                    @elseif($item->order_status=='cancelled')
                                                                        <option
                                                                            {{ $item->order_status == 'cancelled' ? 'selected' : '' }}
                                                                            value="cancelled">cancelled</option>
                                                                    @elseif($item->order_status=='returned')
                                                                        <option
                                                                            {{ $item->order_status == 'returned' ? 'selected' : '' }}
                                                                            value="returned">Returned</option>
                                                                    @endif

                                                                </select>
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-success w3-indigo"
                                                                        type="submit">Update</button>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    @endif --}}
                                                    <span class="badge badge-success w3-indigo">{{ $item->order_status }}
                                                    </span>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td>
                                                @if ($order->order_status != 'satisfied')
                                                    <form class="form-inline" method="post"
                                                        action="{{ route('subscriber.orderStatusUpdateOfServiceProducts') }}">
                                                        @csrf
                                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
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
                                                                    {{-- <option {{ $order->order_status == 'shipped' ? 'selected' : '' }} value="shipped">Shipped</option> --}}
                                                                    <option
                                                                        {{ $order->order_status == 'processing' ? 'selected' : '' }}
                                                                        value="processing">Processing</option>

                                                                    <option
                                                                        {{ $order->order_status == 'cancelled' ? 'selected' : '' }}
                                                                        value="cancelled">Cancelled</option>
                                                                @elseif($order->order_status=='processing')
                                                                    <option
                                                                        {{ $order->order_status == 'processing' ? 'selected' : '' }}
                                                                        value="processing">Processing</option>
                                                                    <option
                                                                        {{ $order->order_status == 'ready_to_ship' ? 'selected' : '' }}
                                                                        value="ready_to_ship">Ready To Ship</option>
                                                                    <option
                                                                        {{ $order->order_status == 'cancelled' ? 'selected' : '' }}
                                                                        value="cancelled">Cancelled</option>
                                                                @elseif($order->order_status=='ready_to_ship')
                                                                    <option
                                                                        {{ $order->order_status == 'ready_to_ship' ? 'selected' : '' }}
                                                                        value="ready_to_ship">Ready To Ship</option>
                                                                    <option
                                                                        {{ $order->order_status == 'shipped' ? 'selected' : '' }}
                                                                        value="shipped">Shipped</option>
                                                                    <option
                                                                        {{ $order->order_status == 'cancelled' ? 'selected' : '' }}
                                                                        value="cancelled">Cancelled</option>
                                                                @elseif($order->order_status=='delivered')


                                                                @elseif($order->order_status=='shipped')
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
                                                                @elseif($order->order_status=='returned')
                                                                    <option
                                                                        {{ $order->order_status == 'returned' ? 'selected' : '' }}
                                                                        value="returned">Returned</option>
                                                                @endif

                                                            </select>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-success w3-indigo"
                                                                    type="submit">Update</button>
                                                            </div>
                                                        </div>

                                                    </form>
                                                @else
                                                  Order Done
                                                @endif

                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection


@push('js')


@endpush
