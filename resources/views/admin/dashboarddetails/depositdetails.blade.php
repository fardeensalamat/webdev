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
                       Total Deposite Balance List
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
                                <th>Transfer Bal.</th>
                                </tr>
                            </thead>
              
                            <tbody> 
                
                                <?php $i = 1; ?>
                
                                    <?php $i = (($depositdetails->currentPage() - 1) * $depositdetails->perPage() + 1); ?>
                
                                    @foreach($depositdetails as $details)        
                
                
                                    <tr>
                        
                                        <td>{{ $i }}</td>                                       
                                        <td>{{ $details->user->name ?? ''}}</td>
                                        <td>{{$details->subscriber->name ?? $details->subscriber_id}}</td>
                                        <td>{{$details->paid_amount}}</td>                      
                                    </tr>
                
                                    <?php $i++; ?>
                
                                    @endforeach 
                            </tbody>
                          
                            <tfoot>
                                <tr>
                                    <td colspan="3">Total </td>
                                    <td>{{$totalDeposit}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td colspan="3">Grand Total </td>
                                    <td>{{$grandtotalDeposit}}</td>
                                    <td></td>

                                </tr>
                             

                            </tfoot>
              
                        </table>
                        {{ $depositdetails->render() }}
              
                       
              
                      </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('js')

 



@endpush

