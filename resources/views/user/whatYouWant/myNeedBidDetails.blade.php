@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header w3-teal">
                    <h3>Need</h3>
                </div>
                <div class="card-body">
                    <p><b>Title: </b>{{ $need->title }}</p>
                    <p><b>Desciption: </b>{{ $need->description }}</p>
                    <p><b>Cat: </b>{{ $need->category ? $need->category->name : null }}</p>
                    <p><b>SS: </b>{{ $need->workstation ? $need->workstation->title : null }}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-center">
                    <h3>Bidded By {{ $bid->user ? $bid->user->name : null }}</h3>
                </div>
                <div class="card-body">
                    <p><b>Bid Details: </b>{{ $bid->description }}</p>
                    <p><b>Price: </b><span class="badge badge-success">{{ $bid->price }} SCB</span></p>
                    <p><b>Status: </b>
                        @if ($bid->status == 'approved')
                            <span class="badge badge-success">Approved</span>
                        @elseif ($bid->status == 'closed')
                            <span class="badge badge-warning">Closed</span>
                        @else
                            <span class="badge badge-warning">Pending</span>
                        @endif
                    </p>
                    @if ($bid->status != 'approved')
                        <form action="{{ route('user.myNeedBidUpdate') }}" method="POST">
                            @csrf
                            {{-- <input type="hidden" name="approved" value="approved"> --}}
                            <input type="hidden" name="need_id" value="{{ $need->id }}">
                            <input type="hidden" name="bid_id" value="{{ $bid->id }}">
                            <select name="status" id="status" class="form-control">
                                <option value="approved" {{ $bid->status == 'approved' ? 'selected' : null }}>Approved
                                </option>
                                <option value="rejected" {{ $bid->status == 'rejected' ? 'selected' : null }}>Rejected
                                </option>
                                <option value="pending" {{ $bid->status == 'pending' ? 'selected' : null }}>Pending
                                </option>
                            </select>
                            <input class="btn btn-success"
                                onclick="return confirm('are you sure? you want to change this status')" type="submit"
                                value="Submit">
                        </form>
                    @endif
                    
                    <?php if (!($bid->need->order_status == 'delivered') and !($bid->need->order_status == 'satisfied') ) { ?>
                        <form action="{{ route('user.updateBidStatus') }}" method="POST">
                            @csrf
                            {{-- <input type="hidden" name="approved" value="approved"> --}}
                            <input type="hidden" name="need_id" value="{{ $need->id }}">
                            <input type="hidden" name="bid_id" value="{{ $bid->id }}">
                            <select name="order_status" id="status" class="form-control">
                                <option value="satisfied">Satisfied</option>
                                <option value="unsatisfied"> Unsatisfied </option>
                            </select>
                            <input class="btn btn-success"
                                onclick="return confirm('are you sure? you want to change this status')" type="submit"
                                value="Submit">
                        </form>
                        <?php } else{?>
                            <b>Order Status: </b> {{ $bid->need->order_status }}
                            <b>Payment Status: </b> {{ $bid->need->payment_status }}
                            <?php }?>
                  

                </div>
            </div>
        </div>

        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')

    <script>
        function subscribeId(actionUrl) {
            $("#subscribeForm").attr("action", actionUrl);
        }
        $(document).ready(function() {
            $('select').change(function() {
                if ($(this).val() === "new")
                    $('.hideme').show();
                else
                    $('.hideme').hide();
            }).change();
        });
    </script>

@endpush
