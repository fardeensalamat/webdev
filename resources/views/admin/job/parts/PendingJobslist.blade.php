<section class="content">
    <br>
    <div class="row">

<style>
  tr.nowrap td {
       white-space:nowrap;
   }

   tr.nowrap th {
       white-space:nowrap;
   }
</style>

      
        <div class="col-sm-12">
          @include('alerts.alerts')
  
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        All Pending Job List
                    </h3>
                </div>
    
                <div class="card-body">
                    <div class="table-responsive">
          

                        <table class="table table-hover table-sm">
              
              
                            <thead>
                                <tr class="nowrap">
                                <th>SL</th>
                                <th>ID</th>
                                <th>Action</th>

                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Job Title</th>
                                <th>Status</th>
                                <th>Total Cost (BDT)</th>
                                <th>Required Workers</th>
                                <th>Date</th>
                                <th>Posted By</th>                  
                                {{-- <th>Description</th> --}}
                                {{-- <th>Work Station</th> --}}
                                {{-- <th>Completed Works</th> --}}
                                </tr>
                            </thead>
              
                            <tbody> 
                
                                <?php $i = 1; ?>
                
                                    <?php $i = (($jobs->currentPage() - 1) * $jobs->perPage() + 1); ?>
                
                                    @foreach($jobs as $job)        
                
                
                                    <tr class="nowrap">
                        
                                        <td>{{ $i }}</td>
                                        <th><a href="{{ route('admin.allWorksOfJob', ['job'=>$job, 'status'=> 'pending']) }}">{{ $job->id }}</a></th>

                                        <td>
                                            <div class="btn-group btn-group-xs w3-hover-shadow">

                                                <a class="btn btn-primary btn-xs" href="{{route('admin.pendingJobDetails',$job)}}">Details</a>

                                                <a class="btn btn-success btn-xs" href="{{route('admin.approvedJob',$job)}}" onclick="return confirm('Are you sure want to approve this job?')">Approved</a>
                                
                                                <a class="btn btn-danger btn-xs" href="{{route('admin.suspendJob',$job)}}" onclick="return confirm('Are you sure want to suspend this job?')">Suspend</a>                        
                                
                                            </div>
                                        </td> 

                                        <td>{{ $job->category ? $job->category->title : '' }}</td>
                                        <td>{{ $job->subcategory ? $job->subcategory->title : '' }}</td>



                                        
                                        <td>{{$job->title}}</td>
                                        <td>{{ $job->status }}</td>
                                        <td>{{$job->total_job_post_cost}} </td>      
                                        <td>{{ $job->total_worker }}</td>

                                        <td>{{ $job->created_at->toDateString() }}</td>
                                        
                                        {{-- <td>{{$job->description}}</td> --}}
                                        {{-- <td>{{$job->workstation ? $job->workstation->title : ''}}</td>  --}}
                                        {{-- <td>{{ $job->work_done }}</td> --}}
                                        
                                        <td>{{$job->user ? $job->user->name : ''}}({{$job->subscribe->subscription_code}})</td>  
                                                         
                                    </tr>
                
                                    <?php $i++; ?>
                
                                    @endforeach 
                            </tbody>
              
                        </table>
              
                        {{ $jobs->render() }}
              
                      </div>
                </div>
            </div>
        </div>
    </div>
</section>