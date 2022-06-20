@extends('subscriber.layouts.userMaster')

@push('css')

@endpush
@section('content')
    <br>

    <section class="content">
        <div class="card">
            @include('alerts.alerts')
            {{-- <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3>All Orders</h3>
                    <p><strong>Cat: </strong>{{ $profile->category->name }} <strong>SS:
                        </strong>{{ $profile->workstation->title }}</p>
                </div>
            </div> --}}
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
                                    src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->fi()]) }}"
                                    style="max-width: 150px;"></p>
                            <p><span class="badge badge-success">{{ $profile->category->name ?? ''}}</span> <span
                                    class="badge badge-success">{{ $profile->workstation->title ?? ''}}</span></p>
                        </div>
                        <h5>From:</h5>
                        <address>
                            <strong>{{ $profile->name }}.</strong><br>
                            {{ $profile->address . ' ' . $profile->city . ' ' . $profile->country . '-' . $profile->zip_code }}
                            <br>
                            <abbr title="Phone">Mobile:</abbr> {{ $profile->mobile ?? 'Not Available' }}<br>
                        </address>
                        <p><strong>Payment: </strong><span class="btn btn-info btn-xs">{{ $order->payment_status }}</span></p>
                        <p><strong>Order Status: </strong><span class="btn btn-danger btn-xs">{{ $order->order_status }}</span></p>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h4>Invoice No.</h4>
                        <h4 class="text-success">{{ $order->transection_id }}</h4>
                        <span>To:</span>
                        <address>
                            <strong>{{ $order->name }} </strong><br>
                            {{ $order->delivery_address }}
                            <br>
                            <abbr title="Phone">Mobile:</abbr> {{ $order->mobile }} <br>
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
                                                        <div><strong>{{ $item->product->name ?? ''}}</strong></div>
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
                                            <th style="min-width: 70px;">Delevery Date</th>
                                            <th style="min-width: 200px;">Item Order Status</th>

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
                                                    <div><strong>{{ $item->product->name ?? ''}}</strong></div>
                                                </td>
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
                                                    @if ($item->order_status == 'shipped')
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

                                                </td>

                                            </tr>
                                        @endforeach
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
    <script language="javascript">
        function printdiv(printpage) {
            var headstr = "<html><head><title></title></head><body>";
            var footstr = "</body>";
            var newstr = document.all.item(printpage).innerHTML;
            var oldstr = document.body.innerHTML;
            document.body.innerHTML = headstr + newstr + footstr;
            window.print();
            document.body.innerHTML = oldstr;
            return false;
        }
    </script>
@endpush
