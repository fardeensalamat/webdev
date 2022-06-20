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
                        All Honoraria of ({{ucfirst($workstation->title)}})
                    </h3>
                    <a class="btn btn-sm btn-default ml-2 w3-text-black" href="{{route('admin.addhonorarium',[ 'ws'=>$workstation])}}">ADD HONORIUM</a>
                </div>
    
                <div class="card-body">
                    <div class="table-responsive">
          

                        <table class="table table-hover table-sm">
              
              
                            <thead>
                                <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Work Station</th>
                                <th>System Type</th>
                                <th>Earning Type</th>
                                <th>Benifit (%)</th>
                                <th>Payment duration</th>
                                <th>Status</th>
                                
                                <th>Action</th>
                                </tr>
                            </thead>
              
                            <tbody> 
                
                                <?php $i = 1; ?>
                
                                    <?php $i = (($honoraria->currentPage() - 1) * $honoraria->perPage() + 1); ?>
                
                                    @foreach($honoraria as $honorarium)        
                
                
                                    <tr>
                        
                                        <td>{{ $i }}</td>
                                        
                                        <td>{{$honorarium->title}}</td>
                                        <td>{{$honorarium->description}}</td>
                                        <td>{{$honorarium->workstation ? $honorarium->workstation->title : ''}}</td>
                                        {{-- <td>{{$honorarium->system_type}}</td>
                                        <td>{{$honorarium->earning_type}}</td> --}}

                                        @if ($honorarium->system_type == "Joining")
                                        <td>Rent/Rented</td>
                                        @else
                                        <td>Beneficiary</td> 
                                        @endif

                                        @if ($honorarium->earning_type == 'Pair')
                                        <td>Incentive</td>
                                        @elseif($honorarium->earning_type == 'Refferal')
                                        <td>Introducer</td>
                                        @else 
                                        <td>{{$honorarium->earning_type}}</td>

                                        @endif


                                        <td>{{$honorarium->commission}}</td>    
                                        <td>{{$honorarium->payment_duration}} Days</td> 
                                        <td>
                                            {{$honorarium->active ? 'Active' : 'Inactive'}} 
                                        </td> 
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                 
                                                <a class="btn btn-success btn-xs" href="{{route('admin.honorariumEdit',$honorarium)}}" >Edit</a>

                                                <a class="btn btn-danger btn-xs" href="{{route('admin.honorariumDelete',$honorarium)}}" onclick="return confirm('Do you want to delete?')">Delete</a>
                                                  
                                                  
                                                
                                              
                                              
                                              </div>
                                        </td>                              
                                    </tr>
                
                                    <?php $i++; ?>
                
                                    @endforeach 
                            </tbody>
              
                        </table>
              
                        {{ $honoraria->render() }}
              
                      </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('js')

@endpush
