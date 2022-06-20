@extends('admin.layouts.adminMaster')

@push('css')
@endpush

@section('content')
  <section class="content">

  	<br>


  	<div class="row">
      
      <div class="col-sm-12">
        @include('alerts.alerts')

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              All Orders 
            </h3>
          </div>

          <div class="card-body">




<div class="table-responsive">
          

          <table class="table table-hover table-sm">


            <thead>
              <tr>
                <th>SL</th>
                <th>Job Title</th>
                <th>Full Name</th>
                <th>Mobile</th>
                <th>Work Station</th>
                <th>Amount</th>
                
                <th>Status</th>
              </tr>
            </thead>

            <tbody> 

              <?php $i = 1; ?>

              <?php $i = (($orders->currentPage() - 1) * $orders->perPage() + 1); ?>

            @foreach($orders as $order)        


            <tr>

            	<td>{{ $i }}</td>
              <td>{{$order->job ? $order->job->title : '-'}}</td>
            	<td>{{ $order->user ?  $order->user->name : ''}}</td>
            	<td>{{ $order->user ? $order->user->mobile : '' }}</td>
            	<td>{{  $order->work_station_id ? $order->workStation->title: ''  }}</td>
            	<td>{{ $order->paid_amount }}</td>
                
                
                <td>{{$order->order_status}}</td>
            	
              
            </tr>

            <?php $i++; ?>

            @endforeach 
            </tbody>

          </table>

          {{ $orders->render() }}

        </div>



</div>
</div>
</div>
</div>


  
  </section>
@endsection


@push('js')

@endpush

