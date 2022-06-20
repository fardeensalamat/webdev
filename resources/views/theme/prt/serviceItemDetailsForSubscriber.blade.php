@extends('subscriber.layouts.userMaster')

@section('title')
    {{ env('APP_NAME_BIG') }}
@endsection
@section('meta')
@endsection


@section('content')
    @include('alerts.alerts')
    <section class="content">


        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body bg-info">
                            <h3>{{ $service_item->title }}</h3>
                        </div>
                        <div class="card-body">
                            {!! $service_item->description !!}
                            <b>Categories: </b> <span class="badge badge-info">{{ $service_item->category->name }}</span>
                            <b>WorkStation: </b> <span
                                class="badge badge-info">{{ $service_item->workstation->title }}</span>
                            <p><b>Price: </b> {{ $service_item->price }}</p>
                        </div>

                        <div class="card-footer">
                            @if ($service_item->user_id != Auth::id())
                                @if ($service_item->hasOrder())
                                    <form
                                        action="{{ route('welcome.serviceItemPayment', ['item' => $service_item->id]) }}"
                                        method="POST"> @csrf
                                        <input type="submit" class="btn btn-info" value="Reorder Now">
                                    </form>
                                @else
                                    <form
                                        action="{{ route('welcome.serviceItemPayment', ['item' => $service_item->id]) }}"
                                        method="POST"> @csrf
                                        <input type="submit" class="btn btn-info" value="Pay Now">
                                    </form>
                                @endif

                            @endif
                            {{-- @auth
                                    @if ($service_item->negotiations)
                                        @if ($service_item->user_id != Auth::id())
                                            @if (!count($service_item->negotiationByCustomer()))
                                                <a href="#" id="negotiation" class="btn btn-success">Negotiations</a>
                                            @else

                                            @endif
                                        @endif

                                    @endif
                                @endauth --}}
                        </div>

                    </div>
                </div>
                @if ($service_item->user_id == Auth::id())
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($service_item->negotiationsUserGroup() as $item)
                                        <div class="col-md-6">
                                            <div class="card direct-chat direct-chat-primary collapsed-card"
                                                style="position: relative; left: 0px; top: 0px;">

                                                <div class="card-header ui-sortable-handle" style="cursor: move;">
                                                    <h3 class="card-title">
                                                        {{ $item->customer ? $item->customer->name : null }}</h3>
                                                    @if ($order = $service_item->paymentByUser($item->customer->id))
                                                        <b>Order:</b> <span
                                                            class="badge badge-info">{{ $order->order_status }}</span>
                                                        <b>Payment:</b> <span
                                                            class="badge badge-danger">{{ $order->payment_status }}</span>

                                                    @endif
                                                    <div class="card-tools">
                                                        <span title="3 New Messages" class="badge badge-primary">3</span>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body" style="display: none;">
                                                    <div class="direct-chat-messages">
                                                        @foreach ($item->CustomerNegotiationsAll($item->user_id, $item->item_id) as $ng)
                                                            @if ($ng->addedby_id == $ng->owner_id)
                                                                <div class="direct-chat-msg right">
                                                                    <div class="direct-chat-infos clearfix">
                                                                        <span
                                                                            class="direct-chat-name float-left">{{ $ng->owner->name }}</span>
                                                                        <span
                                                                            class="direct-chat-timestamp float-right">{{ \Carbon\Carbon::parse($ng->created_at)->format('d M, Y') }}</span>
                                                                    </div>
                                                                    <!-- /.direct-chat-infos -->

                                                                    <img class="direct-chat-img"
                                                                        src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $ng->owner->fi()]) }}"
                                                                        alt="message user image">
                                                                    <!-- /.direct-chat-img -->
                                                                    <div class="direct-chat-text">
                                                                        {{ $ng->price }} SCB

                                                                    </div>
                                                                    <!-- /.direct-chat-text -->
                                                                </div>
                                                            @else
                                                                <div class="direct-chat-msg">
                                                                    <div class="direct-chat-infos clearfix">
                                                                        <span
                                                                            class="direct-chat-name float-left">{{ $ng->customer->name }}</span>
                                                                        <span
                                                                            class="direct-chat-timestamp float-right">{{ \Carbon\Carbon::parse($ng->created_at)->format('d M, Y') }}</span>
                                                                    </div>
                                                                    <!-- /.direct-chat-infos -->

                                                                    <img class="direct-chat-img"
                                                                        src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $ng->customer->fi()]) }}"
                                                                        alt="message user image">
                                                                    <!-- /.direct-chat-img -->
                                                                    <div class="direct-chat-text">
                                                                        {{ $ng->price }} SCB
                                                                        @if (!$ng->approvedNg($ng->customer->id, $service_item->id))
                                                                            <a href="{{ route('welcome.updateNegotiationByOwner', ['customer' => $ng->customer->id, 'item' => $ng->id]) }}"
                                                                                class="badge badge-dark">Approve</a>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            @endif

                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="card-footer" style="display: none;">
                                                    @if ($item->approvedNg($item->customer->id, $service_item->id))
                                                        <h4><b>Approved Price:
                                                                {{ $item->approvedNg($item->customer->id, $service_item->id)->price }}</b>
                                                            SCB
                                                        </h4>
                                                        @if ($service_item->paymentByUser($item->customer->id))
                                                            <?php $payment = $service_item->paymentByUser($item->customer->id); ?>
                                                            <b>Payment Status:</b> <span
                                                                class="badge badge-success">{{ $payment->payment_status }}</span>
                                                            <b>Order Status: </b> <span
                                                                class="badge badge-info">{{ $payment->order_status }}</span>
                                                        @endif
                                                    @else
                                                        <form
                                                            action="{{ route('welcome.addNegotiationByOwner', ['item' => $service_item->id, 'customer' => $item->user_id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="input-group">
                                                                <input type="number" name="price"
                                                                    placeholder="Type price ..." class="form-control">
                                                                <span class="input-group-append">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Send</button>
                                                                </span>
                                                            </div>
                                                        </form>
                                                    @endif

                                                </div>
                                                <!-- /.card-footer-->
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-10 m-auto">
                        <div class="card">
                            @if ($service_item->negotiations)
                                <div class="card-body">
                                    @if ($service_item->negotiationByCustomer())
                                        <div class="col-md-12">
                                            <div class="card direct-chat direct-chat-primary collapsed-card"
                                                style="position: relative; left: 0px; top: 0px;">

                                                <div class="card-header ui-sortable-handle" style="cursor: move;">
                                                    <h3 class="card-title">
                                                        Negotiation</h3>
                                                    <div class="card-tools">
                                                        <span title="3 New Messages" class="badge badge-primary">3</span>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body" style="display: block;">
                                                    <div class="direct-chat-messages">
                                                        @foreach ($service_item->negotiationByCustomer() as $item)
                                                            @if ($item->addedby_id != $item->owner_id)
                                                                <div class="direct-chat-msg right">
                                                                    <div class="direct-chat-infos clearfix">
                                                                        <span
                                                                            class="direct-chat-name float-left">{{ $item->customer->name }}</span>
                                                                        <span
                                                                            class="direct-chat-timestamp float-right">{{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}</span>
                                                                    </div>
                                                                    <!-- /.direct-chat-infos -->

                                                                    <img class="direct-chat-img"
                                                                        src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $item->customer->fi()]) }}"
                                                                        alt="message user image">
                                                                    <!-- /.direct-chat-img -->
                                                                    <div class="direct-chat-text">
                                                                        {{ $item->price }} SCB


                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="direct-chat-msg left">
                                                                    <div class="direct-chat-infos clearfix">
                                                                        <span
                                                                            class="direct-chat-name float-left">{{ $item->owner->name }}</span>
                                                                        <span
                                                                            class="direct-chat-timestamp float-right">{{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}</span>
                                                                    </div>
                                                                    <!-- /.direct-chat-infos -->

                                                                    <img class="direct-chat-img"
                                                                        src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $item->owner->fi()]) }}"
                                                                        alt="message user image">
                                                                    <!-- /.direct-chat-img -->
                                                                    <div class="direct-chat-text">
                                                                        {{ $item->price }} SCB
                                                                        @if (!$item->approvedNg($item->customer->id, $service_item->id))
                                                                            <a href="{{ route('welcome.updateNegotiationByOwner', ['customer' => $item->customer->id, 'item' => $item->id]) }}"
                                                                                class="badge badge-dark">Approve</a>
                                                                        @endif
                                                                    </div>
                                                                    <!-- /.direct-chat-text -->
                                                                </div>

                                                            @endif

                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="card-footer" style="display: block;">
                                                    {{-- {{ $service_item->id }} --}}
                                                    @if ($service_item->approvedNegotiationByCustomer())
                                                        <h4><b>Approved Price:
                                                                {{ $service_item->approvedNegotiationByCustomer()->price }}</b>
                                                            SCB
                                                            @if (!$service_item->paymentByUser(Auth::id()))
                                                                <form
                                                                    action="{{ route('welcome.serviceItemPayment', ['item' => $service_item->id]) }}"
                                                                    method="POST"> @csrf
                                                                    <input type="submit" class="btn btn-info"
                                                                        value="Pay Now">
                                                                </form>
                                                            @endif
                                                        </h4>
                                                        @if ($service_item->paymentByUser(Auth::id()))
                                                            <?php $order = $service_item->paymentByUser(Auth::id()); ?>
                                                            <b>Payment Status:</b> <span
                                                                class="badge badge-success">{{ $order->payment_status }}</span>
                                                            <b>Order Status: </b> <span
                                                                class="badge badge-info">{{ $order->order_status }}</span>

                                                            @if ($order->order_status == 'delivered')
                                                                <form
                                                                    action="{{ route('welcome.orderStatusUpdate', ['payment' => $order->id]) }}"
                                                                    method="POST"> @csrf
                                                                    <div class="form-group">
                                                                        <select name="order_status" id=""
                                                                            class="form-control">
                                                                            <option value="satisfied">sutisfied</option>
                                                                            <option value="un_satisfied">unsutisfied
                                                                            </option>
                                                                        </select>
                                                                    </div>

                                                                    <input type="submit" class="btn btn-info">
                                                                </form>
                                                            @endif
                                                        @endif
                                                    @else

                                                        <form
                                                            action="{{ route('welcome.addNegotiation', ['item' => $service_item->id, 'type' => 'customer']) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="input-group">
                                                                <input type="number" name="price"
                                                                    placeholder="Type price ..." class="form-control">
                                                                <span class="input-group-append">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Send</button>
                                                                </span>
                                                            </div>
                                                        </form>
                                                    @endif

                                                </div>
                                                <!-- /.card-footer-->
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            @else
                                @if ($service_item->paymentByUser(Auth::id()))
                                    <div class="card-body">
                                        <?php $order = $service_item->paymentByUser(Auth::id()); ?>
                                        <b>Payment Status:</b> {{ $order->payment_status }}
                                        <b>Order Status: </b> {{ $order->order_status }}
                                        @if ($order->order_status == 'delivered')
                                            <form
                                                action="{{ route('welcome.orderStatusUpdate', ['payment' => $order->id]) }}"
                                                method="POST"> @csrf
                                                <div class="form-group">
                                                    <select name="order_status" id="" class="form-control">
                                                        <option value="satisfied">sutisfied</option>
                                                        <option value="un_satisfied">unsutisfied
                                                        </option>
                                                    </select>
                                                </div>

                                                <input type="submit" class="btn btn-info">
                                            </form>
                                        @endif
                                    @else
                                        <form
                                            action="{{ route('welcome.serviceItemPayment', ['item' => $service_item->id]) }}"
                                            method="POST"> @csrf
                                            <input type="submit" class="btn btn-info" value="Pay Now">
                                        </form>
                                    </div>
                                @endif
                            @endif


                        </div>
                    </div>

                @endif

            </div>
    </section>
@endsection

@push('js')
    <script>
        // $('#negotiation').click(function(e){
        //   e.preventDefault();
        //   var showNegotiation= 
        // });
        $(function() {
            $(document).on('keydown', ".comment-input-ajax", function(e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    var that = $(this);
                    var form = that.closest('form');
                    // console.log(form);
                    var url = form.attr('action');
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: form.serialize(), // serializes the form's elements.
                        success: function(data) {
                            that.closest('.card').find('.card-comments').append(data.view);
                            that.val('');
                        }
                    });
                    // $.get(route, function(data, status){
                    //     console.log(data);
                    //     if(data.success == true)
                    //     {
                    //         that.closest('.card').find('.card-comments').append(data.view);
                    //     }
                    // });               
                }
            });
        });
    </script>
@endpush
