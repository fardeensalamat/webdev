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
                       Total PF Balance List
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
                
                                    <?php $i = (($pfbalancedetails->currentPage() - 1) * $pfbalancedetails->perPage() + 1); ?>
                
                                    @foreach($pfbalancedetails as $details)        
                
                
                                    <tr>
                        
                                        <td>{{ $i }}</td>                                       
                                        <td>{{$details->user_id ? $details->user->name : ''}}</td>
                                        <td>{{$details->name}}</td>
                                        <td>{{$details->balance}}</td>                      
                                    </tr>
                
                                    <?php $i++; ?>
                
                                    @endforeach 
                            </tbody>
                          
                            <tfoot>
                                <tr>
                                    <td colspan="3">Total </td>
                                    <td>{{$totalPfBalance}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td colspan="3">Grand Total </td>
                                    <td>{{$grandtotalPfBalance}}</td>
                                    <td></td>

                                </tr>
                             

                            </tfoot>
              
                        </table>
                        {{ $pfbalancedetails->render() }}
              
                       
              
                      </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('js')

 



@endpush

