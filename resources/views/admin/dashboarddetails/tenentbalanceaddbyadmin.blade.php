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
                       Tenant Add Balance By Admin 
                    </h3>
                </div>
               
    
                <div class="card-body">
                    <div class="row">
                        @php
                            $type='addedbalance';
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
                            <div class="col-md-4">Added Balance:{{$useraddbalance}} </div>
                            <div class="col-md-4">Reduce Balance:{{ $usersubtractbalance}}  </div>
                            <div class="col-md-4">Total Added Balance:{{$tenentbalanceaddbyadmin}}  </div>
                    </div>
                   <br>
                   <div class="row">
                       <div class="col-md-6">@if($start)Start Date: {{$start}} @endif</div>
                       <div class="col-md-6">@if($end) End Date: {{$end}} @endif</div>
                   </div>
                   <br>
                    <div class="table-responsive">
          

                        <table class="table table-hover table-sm">

                            <thead>
                                <tr>
                                    <th>Updated By</th>
                                    <th>Previous Balance</th>
                                    <th>Changed Balance</th>
                                    <th>New Balance</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                
                                <?php $i = (($balancedetails->currentPage() - 1) * $balancedetails->perPage() + 1); ?>
                                @foreach ($balancedetails as $ube)
                                    <tr>
                                        <th>{{ $ube->user ? $ube->user->name : '-' }}</th>
                                        <th>{{ $ube->previous_balance }}</th>
                                        <th>{{ $ube->changed_balance }}</th>
                                        <th>{{ $ube->new_balance }}</th>
                                        <th>{{date_format($ube->created_at,"d-m-Y")}}</th>    
                                        <th>{{ $ube->type }}</th>
                                    </tr>
                                @endforeach
                            </tbody>

              
                        </table>
                        {{ $balancedetails->render() }}
              
                       
              
                      </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('js')

 



@endpush

