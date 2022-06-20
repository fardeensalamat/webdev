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
                       Today Total CashIn Balance List
                    </h3>
                </div>
    
                <div class="card-body">
                    <div class="table-responsive">
          

                        <table class="table table-hover table-sm">
              
              
                            <thead>
                                <tr>
                                <th>SL</th>
                                <th>User </th>
                                <th>Workstation</th>
                                <th>Form</th>
                                <th>To</th>
                                <th>Transfer Bal.</th>
                                <th>Type/Transaction</th>
                                </tr>
                            </thead>
              
                            <tbody> 
                
                                <?php $i = 1; ?>
                
                                    @foreach($todaytotalRentaldetails as $details)        
                
                
                                    <tr>
                        
                                        <td>{{ $i++ }}</td>                                       
                                        <td>{{$details->user_id ? $details->user->name : ''}}</td>
                                        <td>{{$details->work_station_id ? $details->workstation->name : ''}}</td>
                                        <td>{{$details->sender_no}}</td>                                      
                                        <td>{{$details->receiver_no}}</td>
                                        <td>{{$details->amount}}</td>    
                                        <td>{{$details->transaction_no}}</td>                     
                                    </tr>
                                    @endforeach 
                                    <?php $z = 1; ?>
                
                                    @foreach($todayTotalDepositdetails as $ddetails)        
                
                
                                    <tr>
                        
                                        <td>{{ $z++ }}</td>                                       
                                        <td>{{$ddetails->user_id ? $ddetails->user->name : ''}}</td>
                                        <td>{{$ddetails->work_station_id ? $ddetails->workstation->name : ''}}</td>
                                        <td>{{$ddetails->from}}</td>                                      
                                        <td>{{$ddetails->to}}</td>
                                        <td>{{$ddetails->paid_amount}}</td>    
                                        <td>{{$ddetails->type}}</td>                     
                                    </tr>
                                    @endforeach 
                            </tbody>
                          
                            <tfoot>
                                <tr>
                                    <td colspan="5">Grand Total </td>
                                    <td>{{$todayIn}} Tk</td>
                                    <td></td>

                                </tr>
                             

                            </tfoot>
              
                        </table>
              
                       
              
                      </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('js')

 



@endpush


