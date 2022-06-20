@extends('user.layouts.userMaster')
@push('css')


@endpush

@section('content')
    <section class="content">

        <br>
        <div class="container-fluid">
            <!-- /.row -->
            @include('alerts.alerts')

            <div class="row">
                <div class="col-md-8 col-12 m-auto">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4>{{ $bid->need ? $bid->need->title : null }} </h4>
                                </div>
                                <div class="card-body">
                                    <p><b>Description: </b>{{ $bid->need ? $bid->need->description : null }}</p>
                                    <b>Cat: </b> {{ $bid->category ? $bid->category->name : null }}
                                    <b>SS: </b> {{ $bid->workstation ? $bid->workstation->title : null }}
                                    {{-- {{ Auth::user()->havBizProfile($item->ws_cat_id, $item->workstation_id) }} --}}
                                </div>
                                <div class="card-footer">
                                    <div>
                                        <p><b>Bidded Details: </b>{{ $bid->description }}</p>
                                        <p><b>Bidded Status: </b>{{ $bid->status }}</p>
                                        <p><b>Bidded Price: </b>{{ $bid->price }}</p>
                                        <p><b>Bidded Profile: </b>{{ $bid->serviceProfile->name }}</p>
                                        @if ($bid->need->order_status == 'delivered')
                                        <p><b>Order Status: </b>{{ $bid->need->order_status }}</p>
                                        @endif
                                    </div>
                                    @if ($bid->status == 'approved' )
                                       @if ($bid->need->order_status != 'delivered')
                                       <div class="card">
                                        <div class="card-body">
                                            <form action="{{ route('user.updateBidStatus') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="bid_id" value="{{ $bid->id }}">
                                                <input type="hidden" name="need_id" value="{{ $bid->need->id }}">
    
                                                <div class="form-group">
                                                    <select name="order_status" id="order_status" class="form-control"> 
                                                        <option value="">Select Status</option>
                                                        <option value="delivered">Delivered</option>
                                                    </select>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <input class="btn btn-info" type="submit" name="Deliver Now">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                       @endif
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div><!-- /.container-fluid -->

    </section>
@endsection

@push('js')

@endpush
