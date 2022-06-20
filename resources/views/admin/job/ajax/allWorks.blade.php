<div class="table-responsive">
          

                        <table class="table table-hover table-striped table-sm table-bordered">
              
              
                            <thead>
                                <tr class="nowrap">
                                <th>SL</th>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Date</th>
                                {{-- <th>Work Link</th> --}}
                                <th>Image</th>
                                {{-- <th>Description</th> --}}
                                {{-- <th>Work Station</th> --}}
                                {{-- <th>Total Cost (BDT)</th> --}}
                                {{-- <th>Required Workers</th> --}}
                                {{-- <th>Completed Works</th> --}}
                                <th>Job Image</th>
                                <th>Note (By Job Poster)</th>
               
                                {{-- <th>Worked By</th> --}}
                                <th>Job Title</th>
                                <th>Required Details</th>
                                {{-- <th>BT</th> --}}
                                </tr>
                            </thead>
              
                            <tbody> 
                
                                <?php $i = 1; ?>
                
                                    <?php $i = (($works->currentPage() - 1) * $works->perPage() + 1); ?>
                
                                    @foreach($works as $work)        
                
                
                                    <tr class="nowrap">
                        
                                        <td>{{ $i }}</td>

                                        <td>{{ $work->id }}</td>
                                        <td>{{ $work->status }} <br> ({{ $work[$work->status.'_at'] }})</td>

                                        <td>
                                            @if ($work->status != 'locked')
                                            <div class="btn-group btn-group-xs w3-hover-shadow">
      
                                                <a class="btn btn-primary btn-xs" href="{{route('admin.jobWorkDetails',$work)}}">Details</a>
                                                @if(!$work->distributed_at)
                                                <a class="btn btn-success btn-xs" href="{{ route('admin.jobWorkStatusUpdate',['work'=> $work,'status'=> 'approved']) }}">Approve</a>                        
                                                <a class="btn btn-danger btn-xs" href="{{ route('admin.jobWorkStatusUpdate',['work'=> $work,'status'=> 'rejected']) }}">Reject</a>           
                                                @endif             
                                
                                            </div>
                                            @elseif($work->status == 'locked')
                                                <button class="btn btn-warning btn-sm">Locked</button>
                                            @endif
                                        </td> 
                                        <td>{{ $work->created_at->toDateString() }}</td>
                                        {{-- <td>{{ $work->workDoneLink ? $work->workDoneLink->link : '' }}</td> --}}
                                        
                                        {{-- <td>{{$work->title}}</td> --}}
                                        {{-- <td>{{$work->description}}</td> --}}
                                        {{-- <td>{{$work->workstation ? $work->workstation->title : ''}}</td>  --}}

                                        <td>
                                         
                                        @if ($work->img or $work->img2)
                                        <a href="{{asset('storage/work/image/'.$work->img)}}" alt="Image description" target="_blank" style="display: inline-block; width: 50px; height; 50px; background-image: url({{asset('storage/work/image/'.$work->img)}});">

                                            @if ($work->img)
                                            <img width="60" src="{{ route('imagecache', [ 'template'=>'ppsm','filename' => $work->img ]) }}" alt="">
                                                
                                            @endif
                                            
                                            
                                        </a>

                                        @if ($work->img2)

                                        <a href="{{asset('storage/work/image/'.$work->img2)}}" alt="Image description" target="_blank" style="display: inline-block; width: 50px; height; 50px; background-image: url({{asset('storage/work/image/'.$work->img2)}});">

                                            @if ($work->img2)
                                                
                                            <img width="60" src="{{ route('imagecache', [ 'template'=>'ppsm','filename' => $work->img2 ]) }}" alt="">
                                            @endif
                                             
                                        </a>
                                            
                                        @endif
                                        @endif
                                        
                                    </td>

                                    <td>
                                        

                                        <a href="{{asset('storage/media/job/'.$work->job->fiName())}}" alt="Image description" target="_blank" style="display: inline-block; width: 50px; height; 50px; background-image: url({{asset('storage/media/job/'.$work->job->fiName())}});">
                                            
                                            @if ($work->job->fiName())
                                                
                                            <img width="60" src="{{ route('imagecache', [ 'template'=>'ppsm','filename' => $work->job->fiName() ]) }}" alt="">
                                            @endif
                                        </a>
                                    </td>
                                         <td>{{ $work->job_owner_note }}</td>
                                        {{-- <td>{{$work->user ? $work->user->name : ''}}({{$work->subscriber ? $work->subscriber->subscription_code : ''}})</td> --}}

                                    <td>{{ $work->title }}</td>

                                    <td>{{ $work->require_details }}</td>
                                    
                                    {{-- <td>
                                        @if($bt = $work->bt)
                                        Payment Status: Paid, Prev Balance: {{ $bt->previous_balance }}, Earned: {{ $bt->moved_balance }}, New Balance: {{ $bt->new_balance }}, ({{ $work->distributed_at }})
                                        @endif
                                    </td> --}}
                                                          
                                    </tr>
                
                                    <?php $i++; ?>
                
                                    @endforeach 
                            </tbody>
              
                        </table>
              
                        {{ $works->render() }}
              
                      </div>