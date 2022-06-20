<table class="table table-striped table-bordered table-hover" >
    <thead>
        <tr>
            <th>SL</th>
            <th>Full Name</th>
            <th>Mobile</th>
            <th>Work Station</th>
            <th>Amount</th>
            <th>District</th>
            <th>Transection Id</th>
            <th>Sender No</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>

              <?php $i = (($payments->currentPage() - 1) * $payments->perPage() + 1); ?>
    @foreach($payments as $payment)
        @php 
        $user = $payment->user;
        @endphp
        
        
        <tr>
            <td>{{ $i }}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->mobile}}</td>
            <td>{{ $payment->workStation ? $payment->workStation->title: ''  }}</td>
            <td>{{$payment->amount}}</td>
            <td>{{ $payment->district ? $payment->district->name : ''}}</td>
            <td>{{ $payment->transaction_no	 }}</td>
            <td>{{	$payment->sender_no}}</td>
            <td>{{$payment->status}}</td>
            <td>
                <div class="btn-group btn-group-xs">
  
    @if ($payment->status=='pending')
        <a class="btn btn-success btn-xs" href="{{ route('admin.paymentApproved', $payment) }}" onclick="return confirm('Do you want to approve?')">Approved</a>
        <a class="btn btn-danger btn-xs" href="{{ route('admin.paymentDelete', $payment) }}" onclick="return confirm('Do you want to delete?')">Delete</a>
    @else
        <a class="btn btn-default btn-xs" disabled>Paid</a>
    @endif
    
  


</div>
            </td>
            
        </tr>
        <?php $i++; ?>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL</th>
            <th>Full Name</th>
            <th>Mobile</th>
            <th>Work Station</th>
            <th>Amount</th>
            <th>District</th>
            <th>Transection Id</th>
            <th>Sender No</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

<div class="ajax-pagination-area">    
{{ $payments->appends([
    'q' => isset($q) ? $q : null
    ])->render() }}    
</div>