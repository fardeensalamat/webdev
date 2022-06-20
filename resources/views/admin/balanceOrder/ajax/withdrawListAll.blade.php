<div class="table-responsive">


    <table class="table table-hover table-sm table-bordered">


        <thead>
            <tr class="nowrap">
                <th>SL</th>
                <th>Tenant</th>
                <th>Full Name</th>
                {{-- <th>Mobile</th> --}}
                <th>Withdraw Number</th>
                <th>Amount</th>
                {{-- <th>W.Charge</th> --}}
                {{-- <th>S.  Type</th> --}}
                {{-- <th>Work Station</th> --}}
                <th>Details </th>
                {{-- <th>Account No</th>
                <th>Account Holder</th>
                <th>Bank Name</th>
                <th>Branch</th>
                <th>Details</th>
                <th>Transection Id</th>
                <th>Sender No</th>
                <th>Paid Type</th> --}}
                <th>Date</th>
                {{-- <th>Updated</th> --}}
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <?php $i = 1; ?>

            <?php $i = ($orders->currentPage() - 1) * $orders->perPage() + 1; ?>

            @foreach ($orders as $order)
                <tr class="nowrap">
                    <td>{{ $i }}</td>
                    <td>
                        @if ($order->user)
                            <a class="btn btn-xs {{ $order->user->active ? '' : 'btn-danger' }} w3-round w3-border"
                                href="{{ route('admin.usersAll', ['user' => $order->user]) }}">{{ $order->user_id }}</a>
                        @endif
                    </td>
                    <td>
                        <b>Name: </b> {{ $order->user ? $order->user->name : '' }}<br>
                        <b>Number: </b> {{ $order->user ? $order->user->mobile : '' }}<br> 
                    </td>
                    <td>{{ $order->mobile_number }}</td>
                    {{-- <td>{{ $order->mobile_number }}</td> --}}
                    <td>{{ $order->amount }}</td>
                    {{-- <td>{{ $order->withdraw_charge }}</td>
                    <td>{{ $order->service_type }}</td> --}}
                    {{-- <td>{{  $order->work_station_id ? $order->workStation->title: ''  }}</td> --}}

                    <td>
                       <b>Withdraw Charge: </b> {{ $order->withdraw_charge }}<br>
                       <b>Service Type: </b> {{ $order->service_type }}<br>
                       <b>Withdraw Type: </b> {{ $order->withdraw_type }}<br>
                       <b>Account No:</b> {{ $order->account_number }}<br>
                       <b>Account Holder:</b> {{ $order->account_holder_name }}<br>
                       <b>Bank Name:</b> {{ $order->bank_name }}<br>
                       <b>Branch:</b> {{ $order->branch_name }}<br>
                       <b>Details:</b> {{ $order->details }}<br>
                       <b>Transection Id:</b> {{ $order->transaction_id }}<br>
                       <b>Sender No:</b> {{ $order->paid_from_number }}<br>
                       <b>Paid Type:</b> {{ $order->paid_type }}<br>
                    
                    </td>
                    {{-- <td>{{ $order->account_number }}</td>
                    <td>{{ $order->account_holder_name }}</td>
                    <th>{{ $order->bank_name }}</th>
                    <td>{{ $order->branch_name }}</td>
                    <td>{{ $order->details }}</td>
                    <td>{{ $order->transaction_id }}</td>
                    <td>{{ $order->paid_from_number }}</td>
                    <td>{{ $order->paid_type }}</td> --}}
                    <td>{{ $order->created_at->toDateString() }}</td>
                    {{-- <td>{{ $order->updated_at }}</td> --}}
                    <td>
                        @if ($order->status == 'paid')
                            <span class="text-success fw-bolder">{{ $order->status }}</span>
                        @else
                            <span class="text-danger fw-bolder">{{ $order->status }}</span>
                        @endif

                    </td>
                    <td>
                        <div class="btn-group btn-group-xs">
                            <a href="{{ route('admin.LastWithdrawlastbalancetransactionDetails',['id' => $order->user_id,'amount' => $order->amount]) }}" class="btn btn-warning btn-xs" >Details</a>
                            @if ($order->status != 'paid')
                                @if ($order->status != 'declined')
                                    <a href="#" class="btn btn-danger btn-xs" class="btn btn-primary" data-toggle="modal"
                                        data-target="#decline{{ $order->id }}">Decline</a>
                                @endif
                                @if ($order->withdraw_type != 'bank_account' and $order->status != 'paid')
                                    <a href="#" class="btn btn-info btn-xs" data-toggle="modal"
                                        data-target="#manual{{ $order->id }}">Manual</a>
                                @else
                                    <a href="#" class="btn btn-info btn-xs" data-toggle="modal"
                                        data-target="#manualBank{{ $order->id }}">Manual</a>
                                @endif
                                @if ($order->withdraw_type != 'online_banking' and $order->withdraw_type != 'bank_account')
                                    <form action="{{ route('admin.withdrawListpost') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="withdraw_id" value="{{ $order->id }}">
                                        <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                        <input type="hidden" name="paid_type" value="online">
                                        <button onclick="return confirm('Are you sure?');" type="submit"
                                            class="btn btn-primary btn-xs">Online</button>
                                    </form>
                                @endif

                            @endif
                            {{-- decline Modal --}}
                            <div class="modal fade" id="decline{{ $order->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="decline" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Decline</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @if ($order->user)
                                            <form
                                                action="{{ route('admin.withdrawDecline', ['user' => $order->user->id, 'withdraw' => $order->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <label for="details">Details</label>
                                                    <textarea name="details" id="details" cols="30" rows="4"
                                                        class="form-control"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" value="Decline" class="btn btn-primary">
                                                </div>
                                            </form>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            {{-- Manual Modal STAERT --}}
                            <div class="modal fade" id="manual{{ $order->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Manual Payment</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.withdrawListpost') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="hidden" name="withdraw_id"
                                                        value="{{ $order->id }}">
                                                    <input type="hidden" name="user_id"
                                                        value="{{ $order->user_id }}">
                                                    <input type="hidden" name="paid_type" value="manual">
                                                    <label for="paid_from_number">Paid From Number</label>
                                                    <input type="text" name="paid_from_number" id="paid_from_number"
                                                        required placeholder="Paid From Number" class="form-control">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Paid</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @if ($order->withdraw_type = 'bank_account')
                                <div class="modal fade" id="manualBank{{ $order->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Manual Payment For
                                                    Bank</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.withdrawListpost') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="withdraw_id" value="{{ $order->id }}">
                                                <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                                <input type="hidden" name="paid_type" value="manualBank">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="paid_from_number">Paid From Account Number</label>
                                                        <input type="text" name="paid_from_number" id="paid_from_number"
                                                            required placeholder="Paid From Number"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Paid</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- Manual Modal STAERT --}}


                            {{-- <a class="btn  btn-xs w3-blue mx-1" href="{{ route('admin.message', $order) }}"> <i class="fas fa-comments"></i> </a> --}}

                            @if ($order->order_status == 'pending')
                                <a class="btn btn-success btn-xs"
                                    href="{{ route('admin.balanceApprovedOrder', $order) }}"
                                    onclick="return confirm('Do you want to approve?')">Approved</a>
                                <a class="btn btn-danger btn-xs"
                                    href="{{ route('admin.balanceOrderDelete', $order) }}"
                                    onclick="return confirm('Do you want to delete?')">Delete</a>

                            @elseif($order->order_status =='delivered')
                                <a class="btn btn-default btn-xs" disabled>Paid</a>
                            @endif


                        </div>


                    </td>

                </tr>

                <?php $i++; ?>

            @endforeach
        </tbody>

    </table>

    {{ $orders->render() }}

</div>
