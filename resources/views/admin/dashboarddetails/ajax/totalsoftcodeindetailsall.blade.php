<div class="table-responsive ajax-data-container">

    {{ $payments->render() }}

    <table
        class="table table-hover table-bordered table-striped table-sm {{ $payments->count() < 3 ? 'mb-5 mt-5' : '' }}">





        <thead>
            <tr class="nowrap">
                <th>SL</th>
                <th>Tenant</th>
                <th>Paid By</th>
                <th>Full Name</th>
                <th>Mobile</th>
                <th>Work Station</th>
                <th>Amount</th>
                <th>District</th>
                <th>Transection Id</th>
                <th>Sender No</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <?php $i = 1; ?>

            <?php $i = ($payments->currentPage() - 1) * $payments->perPage() + 1; ?>

            @foreach ($payments as $payment)


                <tr class="nowrap">

                    <td>{{ $i }}</td>
                    <td>
                        @if ($payment->user)
                            <a class="btn btn-xs {{ $payment->user->active ? '' : 'btn-danger' }} w3-round w3-border"
                                href="{{ route('admin.usersAll', ['user' => $payment->user]) }}">{{ $payment->user_id }}</a>
                        @endif
                    </td>
                    <td>
                        @if ($payment->paidBy)
                            <a class="btn btn-xs {{ $payment->paidBy->active ? '' : 'btn-danger' }}  w3-round  w3-border"
                                href="{{ route('admin.usersAll', ['user' => $payment->paidby_id]) }}">{{ $payment->paidby_id }}</a>
                        @endif
                    </td>
                    <td>{{ $payment->user ? $payment->user->name : '' }}</td>
                    <td>{{ $payment->user ? $payment->user->mobile : '' }}</td>
                    <td>{{ $payment->workStation ? $payment->workStation->title : '' }}</td>
                    <td>{{ $payment->amount }}</td>

                    <td>{{ $payment->district ? $payment->district->name : '' }}</td>
                    <td>{{ $payment->transaction_no }}</td>
                    <td>{{ $payment->sender_no }}</td>
                    <td>{{ $payment->created_at->toDateString() }}</td>
                    <td>{{ $payment->status }}</td>
                    <td>



                        <div class="btn-group btn-group-xs">

                            {{-- <a class="btn  btn-xs w3-blue mx-1" href="{{ route('admin.message', $payment) }}"> <i class="fas fa-comments"></i> </a> --}}
                            @if ($payment->status == 'pending')
                                <a class="btn btn-success btn-xs"
                                    href="{{ route('admin.paymentApproved', $payment) }}"
                                    onclick="return confirm('Do you want to approve?')">Approved</a>

                                <a class="btn btn-warning btn-xs"
                                    href="{{ route('admin.paymentApprovedWithMigrate', $payment) }}"
                                    onclick="return confirm('Do you want to migrate to standard account?')"
                                    title="migrate to to standard account">Migrate</a>

                                <a class="btn btn-danger btn-xs" href="{{ route('admin.paymentDelete', $payment) }}"
                                    onclick="return confirm('Do you want to delete?')">Delete</a>
                                    <a href="{{ route('admin.subscriptionAllPostpaidAccount',['user'=>$payment->user->id,'payment'=>$payment->id]) }}" class="btn btn-info btn-xs">Postpaid To All Cat</a>
                            @else
                                <a class="btn btn-default btn-xs" disabled>Paid</a>
                            @endif
                            
                        </div>


                    </td>

                </tr>

                <?php $i++; ?>

            @endforeach
        </tbody>

    </table>

    {{ $payments->render() }}

</div>
