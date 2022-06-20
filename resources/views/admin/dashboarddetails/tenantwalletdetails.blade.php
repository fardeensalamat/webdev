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
                       Total Tenant Wallet Balance List
                    </h3>
                </div>
    
                <div class="card-body">
                    <div class="table-responsive">
          

                        <table class="table table-hover table-sm">
              
              
                            <thead>
                                <tr>
                                <th>SL</th>
                                <th>User </th>
                                <th>Phone</th>
                                <th>Balance</th>
                                </tr>
                            </thead>
              
                            <tbody> 
                
                                <?php $i = 1; ?>
                
                                    <?php $i = (($tenantwalletdetails->currentPage() - 1) * $tenantwalletdetails->perPage() + 1); ?>
                
                                    @foreach($tenantwalletdetails as $details)        
                
                
                                    <tr>
                        
                                        <td>{{ $i }}</td>                                       
                                        <td>{{$details->name}}</td>
                                        <td>{{$details->mobile}}</td>
                                        <td>{{$details->balance}}</td>                      
                                    </tr>
                
                                    <?php $i++; ?>
                
                                    @endforeach 
                            </tbody>
                          
                            <tfoot>
                                <tr>
                                    <td colspan="3">Total </td>
                                    <td>{{$totalTenantWallet}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td colspan="3">Grand Total </td>
                                    <td>{{$grandtotalTenantWallet}}</td>
                                    <td></td>

                                </tr>
                             

                            </tfoot>
              
                        </table>
                        {{ $tenantwalletdetails->render() }}
              
                       
              
                      </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('js')

 



@endpush

