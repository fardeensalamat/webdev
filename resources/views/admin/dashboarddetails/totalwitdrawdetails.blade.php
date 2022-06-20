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
                       Total Cashout Balance List
                    </h3>
                </div>
    
                <div class="card-body">
                    <div class="table-responsive">
          

                        <table class="table table-hover table-sm">
              
              
                            <thead>
                                <tr>
                                <th>SL</th>
                                <th>User </th>
                                <th>Subscriber</th>
                                <th>Form</th>
                                <th>To</th>
                                <th>Transfer Bal.</th>
                                <th>Type</th>
                                </tr>
                            </thead>
              
                            <tbody> 
                
                                <?php $i = 1; ?>
                
                                    <?php $i = (($totalwitdrawdetails->currentPage() - 1) * $totalwitdrawdetails->perPage() + 1); ?>
                
                                    @foreach($totalwitdrawdetails as $details)        
                
                
                                    <tr>
                        
                                        <td>{{ $i }}</td>                                       
                                        <td>{{$details->user_id ? $details->user->name : ''}}</td>
                                        <td>{{$details->subscriber_id ? $details->subscriber->name : ''}}</td>
                                        <td>{{$details->from}}</td>                                      
                                        <td>{{$details->to}}</td>
                                        <td>{{$details->moved_balance}}</td>    
                                        <td>{{$details->type}}</td>                     
                                    </tr>
                
                                    <?php $i++; ?>
                
                                    @endforeach 
                            </tbody>
                          
                            <tfoot>
                                <tr>
                                    <td colspan="5">Total </td>
                                    <td>{{$totalwitdraw}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td colspan="5">Grand Total </td>
                                    <td>{{$grandtotalwitdraw}}</td>
                                    <td></td>

                                </tr>
                             

                            </tfoot>
              
                        </table>
                        {{ $totalwitdrawdetails->render() }}
              
                       
              
                      </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('js')

 



@endpush

