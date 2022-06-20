@extends('admin.layouts.adminMaster')

@push('css')
@endpush

@section('content')
    <section class="content">


        <style>
            tr.nowrap td {
                white-space: nowrap;
            }

            tr.nowrap th {
                white-space: nowrap;
            }

        </style>

        <br>


        <div class="row">

            <div class="col-sm-12">
                @include('alerts.alerts')

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                           Order Item History Of ({{ $order }})
                        </h3>
                        <div class="card-tools">
                            <form action="">

                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text"
                                        data-url="{{ route('admin.searchAjax', ['type' => 'subscriber', 'status' => isset($status) ? $status : null]) }}"
                                        class="form-control ajax-data-search" placeholder="Search Subscriber">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary w3-border">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive ajax-data-container">

                            {{ $order_history->render() }}

                            <table class="table table-hover table-bordered table-striped table-sm ">


                                <thead>
                                    <tr class="nowrap">
                                        <th>SL</th>
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>

                                <tbody>


                                    <?php $i = 1; ?>

                                    <?php $i = ($order_history->currentPage() - 1) * $order_history->perPage() + 1; ?>
                                    <?php $grand_total = 0; ?>
                                    @foreach ($order_history as $item)


                                        <tr class="nowrap">

                                            <td>{{ $i }}</td>
                                            <td>
                                               {{ $item->product->name }}
                                            </td> 
                                            <td><img src="{{ route('imagecache', [ 'template'=>'pfism','filename' => $item->product->fi() ]) }}" alt="" srcset=""></td>
                                            <td>
                                                {{ $item->quantity }}
                                            </td>
                                            <td>{{ $item->sale_price }}</td>
                                            <td>{{ $item->total_sale_price }}</td>
                                        </tr>
                                        <?php $grand_total += $item->total_sale_price; ?>
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8" class="text-right text-danger"><b>Total: {{ $grand_total }}
                                                SCB</b></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>

                            {{ $order_history->render() }}

                        </div>




                        {{-- @include('admin.subcribers.ajax.admin_subscriberAll') --}}



                    </div>
                </div>
            </div>
        </div>



    </section>
@endsection


@push('js')

@endpush
