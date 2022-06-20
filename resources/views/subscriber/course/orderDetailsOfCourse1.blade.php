@extends('subscriber.layouts.userMaster')

@push('css')

@endpush
@section('content')
    <br>

    <section class="content">
        <div class="card">
            @include('alerts.alerts')
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
                            <p><span class="badge badge-success">{{ $profile->category->name }}</span> <span
                                    class="badge badge-success">{{ $profile->workstation->title }}</span></p>
                        </div>
                        <h5>From:</h5>
                        <address>
                            <strong>{{ $profile->name }}.</strong><br>
                            {{ $profile->address . ' ' . $profile->city . ' ' . $profile->country . '-' . $profile->zip_code }}
                            <br>
                            <abbr title="Phone">Mobile:</abbr> {{ $profile->mobile ?? 'Not Available' }}<br>
                        </address>
                        <p><strong>Payment: </strong><span class="btn btn-info btn-xs">{{ $order->payment_status }}</span></p>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h4>Rransection No.</h4>
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
                                                <th>Course Name</th>
                                                <th>Instructor</th>
                                                <th>Enroll Date</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <td>
                                                        <div><strong>{{ $order->course->title }}</strong></div>
                                                    </td>
                                                    <td>{{ $order->course->ins_name }}</td>
                                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                                    <td>BDT: {{ $order->order_confirmed_price }}
                                                    </td>
                                                </tr>


                                        </tbody>
                                    </table>
                                </div><!-- /table-responsive -->


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
