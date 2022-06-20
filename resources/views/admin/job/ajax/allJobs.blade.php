<div class="table-responsive ajax-data-container">
          

                        <table class="table table-hover table-striped table-sm">
              
              
                            <thead>
                                <tr class="nowrap">
                                <th>SL</th>
                                <th>ID</th>
                                <th>Claimed</th>
                                <th>Action</th>

                                <th>Date</th>
                                <th>Job Title</th>
                                {{-- <th>Description</th> --}}
                                {{-- <th>Work Station</th> --}}
                                <th>Total Cost (BDT)</th>
                                <th>Required Workers</th>
                                <th>Completed Works</th>
                                <th>Status</th>
                                <th>Posted By</th>
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
                                            @if($clCount = $job->worksClaimedCount())
                                            <span class="badge badge-danger">
                                                <a href="{{ route('admin.allWorksOfJob', ['job'=>$job, 'status'=> 'claimed']) }}">
                                            {{ $clCount }}
                                                    
                                                </a>
                                            </span>
                                            @else
                                            0
                                            @endif
                                            
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-xs w3-hover-shadow">
                                                {{-- <a class="btn btn-success btn-xs" href="{{route('admin.approvedJob',$job)}}" onclick="return confirm('Are you sure want to approve this job?')">Approved</a> --}}
                                                @if (($job->status == null) or ($job->status =='pending'))

                                                

                                                <a class="btn btn-primary btn-xs" href="{{route('admin.pendingJobDetails',$job)}}">Details</a>

                                                @if ($job->status == 'pending')
                                                    <a class="btn btn-success btn-xs" href="{{route('admin.approvedJob',$job)}}" onclick="return confirm('Are you sure want to approve this job?')">Approved</a>
                                                @endif
                                                
                                
                                                <a class="btn btn-danger btn-xs" href="{{route('admin.suspendJob',$job)}}" onclick="return confirm('Are you sure want to suspend this job?')">Suspend</a> 
                                                @endif
                                            </div>
                                        </td>

                                        <th>{{ $job->created_at->toDateString() }}</th>
                                        
                                        <td>{{$job->title}}</td>
                                        {{-- <td>{{$job->description}}</td> --}}
                                        {{-- <td>{{$job->workstation ? $job->workstation->title : ''}}</td>  --}}
                                        <td>{{$job->total_job_post_cost}} </td>      
                                        <td>{{ $job->total_worker }}</td>
                                        <td>{{ $job->work_done }}</td>
                                        
                                        <td>
                                            @if ($job->status == null)
                                            Approved
                                            @else
                                            {{ ucfirst($job->status) }}
                                            @endif
                                        </td>
                                        <td>{{$job->user ? $job->user->name : ''}}({{$job->subscribe->subscription_code}})</td>                    
                                    </tr>
                
                                    <?php $i++; ?>
                
                                    @endforeach 
                            </tbody>
              
                        </table>
              
                        {{ $jobs->render() }}
              
                      </div>