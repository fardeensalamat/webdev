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
                       Total Soft Code Out Balance List
                    </h3>
                </div>
    
                <div class="card-body">
                    <div class="row">
                        @php
                            $type='totalout'
                        @endphp
                       <div class="col-sm-12">
                           <form class="form-inline" method="get" action="{{route('admin.detailsGetByDateInterval',['type'=>$type])}}">
                             <div class="form-group form-group-sm">
                               <label for="date_from">From:</label>
                               <input type="date" name="date_from" class="form-control ml-1 mr-1" id="date_from">
                             </div>
                             <div class="form-group form-group-sm">
                               <label for="date_to">To:</label>
                               <input type="date" name="date_to" class="form-control ml-1 mr-2" id="date_to">
                             </div>
                             <button type="submit" class="btn btn-primary btn-sm ml-2">Submit</button>
                           </form>
               
               
                         </div>
                   </div>
                   <br>
                   <div class="row">
                       <div class="col-md-6">@if($start)Start Date: {{$start}} @endif</div>
                       <div class="col-md-6">@if($end) End Date: {{$end}} @endif</div>
                   </div>
                    <div class="table-responsive">
          

                        <table class="table table-hover table-sm">
              
              
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>User </th>
                                    <th>Subscriber</th>
                                    <th>Date</th>
                                    <th>To</th>
                                    <th>Transfer Bal.</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
              
                            <tbody> 
                
                                <?php $i = 1; ?>
                
                                    <?php $i = (($totalSoftcodegetdetails->currentPage() - 1) * $totalSoftcodegetdetails->perPage() + 1); ?>
                
                                    @foreach($totalSoftcodegetdetails as $details)        
                
                
                                    <tr>
                        
                                        <td>{{ $i }}</td>                                       
                                        <td>{{$details->user_id ? $details->user->name : ''}}</td>
                                        <td>{{$details->subscriber_id ? $details->subscriber->name : ''}}</td>
                                        <td>{{date_format($details->created_at,"d/m/Y")}}</td>                                        
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
                                    <td>{{$totalSoftcodeget}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td colspan="5">Grand Total </td>
                                    <td>{{$grandtotalSoftcodeget}}</td>
                                    <td></td>

                                </tr>
                             

                            </tfoot>
              
                        </table>
                        {{ $totalSoftcodegetdetails->render() }}
              
                       
              
                      </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('js')

 



@endpush

