<div class="table-responsive">
          

          <table class="table table-hover table-sm">


            <thead>
              <tr class="nowrap">
                <th>SL</th>
                <th>Tenant</th>
                <th>Full Name</th>
                <th>Mobile</th>
                <th>Work Station</th>
                <th>Amount</th>
                <th>Transection Id</th>
                <th>Sender No</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody> 

              <?php $i = 1; ?>

              <?php $i = (($orders->currentPage() - 1) * $orders->perPage() + 1); ?>

            @foreach($orders as $order)        


            <tr class="nowrap">

            	<td>{{ $i }}</td>
              <td>
                @if($order->user)
                <a class="btn btn-xs {{ $order->user->active ? '' : 'btn-danger' }} w3-round w3-border" href="{{ route('admin.usersAll', ['user' => $order->user]) }}">{{ $order->user_id}}</a>
                @endif
              </td>

            	<td>{{ $order->user ?  $order->user->name : ''}}</td>
            	<td>{{ $order->user ? $order->user->mobile : '' }}</td>
            	<td>{{  $order->work_station_id ? $order->workStation->title: ''  }}</td>
            	<td>{{ $order->paid_amount }}</td>  
              <td>{{$order->orderPayment ? $order->orderPayment->note : ''}}</td> 
              <td>{{$order->orderPayment ? $order->orderPayment->sender : ''}}</td>    
              <td>{{ $order->created_at->toDateString() }}</td>         
              <td>{{$order->order_status}}</td>
            	<td>

            		

            	<div class="btn-group btn-group-xs">
  
  {{-- <a class="btn  btn-xs w3-blue mx-1" href="{{ route('admin.message', $order) }}"> <i class="fas fa-comments"></i> </a> --}}
  
    @if ($order->order_status =='pending')
        <a class="btn btn-success btn-xs" href="{{ route('admin.balanceApprovedOrder', $order) }}" onclick="return confirm('Do you want to approve?')">Approved</a>
        <a class="btn btn-danger btn-xs" href="{{ route('admin.balanceOrderDelete', $order) }}" onclick="return confirm('Do you want to delete?')">Delete</a>
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
