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
                       Tenant Info Changed By Admin 
                    </h3>
                </div>
               
    
                <div class="card-body">
                    <div class="row">
                        @php
                            $type='tenantinfochanged';
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
                   <br>
                    <div class="table-responsive">
          

                        <table class="table table-hover table-sm">

                            <thead>
                                <tr>
                                    <th>Modified By</th>
                                    <th>Previous Name</th>
                                    <th>Changed Name</th>
                                    <th>Previous Mobile</th>
                                    <th>Changed Mobile</th>
                                    <th>Account Status</th>
                                    <th>date</th>
                                    <th>Description</th>

                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($user_update_informations as $ube)
                                    <tr>
                                        <th>{{ $ube->addedby_id ? $ube->updatedBy->name : '-' }}</th>
                                        <th>{{ $ube->previus_name }}</th>
                                        <th>{{ $ube->new_name }}</th>
                                        <th>{{ $ube->previus_mobile }}</th>
                                        <th>{{ $ube->new_mobile }}</th>
                                        <th>
                                            @if ($ube->active)
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Inactive</span>
                                            @endif
                                        </th>
                                        <th>
                                            {{ $ube->created_at }}
                                        </th>
                                        <th>{{ $ube->description }}</th>
                                    </tr>
                                @endforeach
                            </tbody>

              
                        </table>
                        {{ $user_update_informations->render() }}
              
                       
              
                      </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('js')

 



@endpush

