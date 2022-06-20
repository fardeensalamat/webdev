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
                            History Of {{ $user->name }} ({{ $user->id }})
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

                            {{ $salesHistory->render() }}

                            <table class="table table-hover table-bordered table-striped table-sm ">


                                <thead>
                                    <tr class="nowrap">
                                        <th>SL</th>
                                        <th>Items</th>
                                        <th>Order ID</th>
                                        <th>Service Station</th>
                                        <th>Category</th>
                                        <th>Service Profile</th>
                                        {{-- <th>Product Name</th> --}}
                                        <th>Total Quantity</th>
                                        <th>Total Price</th>
                                        <th>Sales Date</th>
                                    </tr>
                                </thead>

                                <tbody>


                                    <?php $i = 1; ?>

                                    <?php $i = ($salesHistory->currentPage() - 1) * $salesHistory->perPage() + 1; ?>
                                    <?php $grand_total = 0; ?>
                                    @forelse ($salesHistory as $sh)


                                        <tr class="nowrap">

                                            <td>{{ $i }}</td>

                                            <td>
                                                <a class="btn btn-success btn-xs" href="{{ route('admin.orderItemHistoryInfo',['user'=>$user->id,'order'=>$sh->id]) }}"> Items</a>
                                            </td>
                                            <td>{{ $sh->id }}</td>
                                            <td>
                                                {{ $sh->workStation->title }}
                                            </td>
                                            <td>{{ $sh->category->name }}</td>
                                            <td>{{ $sh->serviceProfile->name }}</td>
                                            {{-- <td>
                                                {{ $sh->orderItems }}
                                            </td> --}}
                                            <td>{{ $sh->total_quantity }}</td>
                                            <td>{{ $sh->total_sale_price }}</td>
                                            <td>
                                                {{ $sh->satisfied_at }}
                                            </td>

                                        </tr>
                                        <?php $grand_total += $sh->total_sale_price; ?>
                                        <?php $i++; ?>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-danger text-center h4">NO Order Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if ($grand_total)
                                <tfoot>
                                    <tr>
                                        <td colspan="8" class="text-right text-danger"><b>Total: {{ $grand_total }}
                                                SCB</b></td>
                                        <td></td>
                                    </tr>
                                </tfoot>  
                                @endif
                                
                            </table>

                            {{ $salesHistory->render() }}

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
