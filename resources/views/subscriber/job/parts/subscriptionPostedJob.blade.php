<section class="content">
    <br>
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.alerts')
            <div class="card card-primary">
                <div class="card-header">
                    My Posted Jobs (Subscription Code:{{$subscription->subscription_code}})
                </div>
                <div class="card-body">                    
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('subscriber.subscriptionJobSearch',['subscription' => $subscription->subscription_code])}}">
                                <div class="row">
                                    
                                    <div class="col-sm-3 m-b-xs">
                                        <div class="input-group mb-3">
                                            <label for="">Category</label>
                                            <div class="input-group">
                                                <select name="category" id="category" class="form-control">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group mb-3">
                                            <label for="">Subcategoy</label>
                                            <div class="input-group ">
                                                <select name="subcategory" class="form-control" id="subcategory">
                                                    <option value="">Select subcategory</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="">Search</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control form-control" name="q" placeholder="Search category, subcategory">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for=""></label>
                                        <div class="input-group-append mt-2">
                                            <button class="btn btn-sm btn-primary" type="submit">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
        
                            <div class="table-responsive">        
                                
                            </div>
                        </div>
                    </div> --}}

                    @if ($myPostedJobs->count() > 0)
                        {{-- <div class="row">
                            @foreach ($myPostedJobs as $freelanceJob)
                            <div class="col-md-12">
                                <a href="{{route('subscriber.freelanceJobDetails',[ 'freelanceJob'=> $freelanceJob,'subscription' => $subscription->subscription_code])}}">
                                    <div class="info-box bg-default w3-hover w3-white w3-hover-deep-orange">
                                        <div class="info-box-content">
                                            <h4 class="info-box-text p-0 m-0">{{$freelanceJob->title}}</h4>
                                            <h5 class="info-box-number">BDT {{$freelanceJob->per_worker_cost}} <span style="font-size: 12px;"> <i class="fas fa-clock"></i> Posted : {{$freelanceJob->created_at->diffForHumans()}}</span></h5>
                            
                                            <div class="progress">
                                            <div class="progress-bar bg-success" style="width: 10%"></div>
                                            </div>
                                            <span class="progress-description">
                                            Need More 10 workers out of {{$freelanceJob->total_worker}} 
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach                            
                        </div> --}}
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                    <th>SL</th>
                                    <th>Action</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Job Title</th>
                                    <th>Description</th>
                                    <th>Workers needed</th>
                                    <th>Duration to Compete Date</th>
                                    <th>Status (Works Submitted)</th>
                                    {{-- <th>Works Submitted</th> --}}
                                    </tr>
                                </thead>
                  
                                <tbody>
                                    <?php $i = 1; ?>
                    
                                    <?php $i = (($myPostedJobs->currentPage() - 1) * $myPostedJobs->perPage() + 1); ?>
                                    @foreach($myPostedJobs as $job) 
                                    <tr>
                                        <td>{{$i}}</td>

                                        <td>
                                            
                                            @if($job->status == 'cancel')
                                                <button disabled class="btn btn-danger btn-xs">Suspended</button>

                                            @elseif($job->status == 'pending')
                                                <button disabled class="btn btn-warning btn-xs">Pending</button>
                                            
                                            {{-- @elseif($job->status == 'completed')
                                            <button  class="btn btn-success btn-sm">Complete</button> --}}
                                           {{--  @elseif($job->status == 'full_paid')
                                            <button  class="btn btn-success btn-sm">Complete</button> --}}
                                            @else
                                                <div class="btn-group btn-group-xs w3-hover-shadow">

                                                    <a class="btn btn-primary btn-xs" href="{{route('subscriber.subscriptionEditJob',[$job,'subscription'=>$subscription->subscription_code])}}" target="_blank">Edit</a>

                                                    @if ($job->status == 'pending')
                                                        <a class="btn btn-warning btn-xs" href="" disabled>Pending</a>  
                                                    @else


                                    
                                                    <a class="btn btn-success btn-xs" href="{{route('subscriber.subscriptionWorksList',[$job,'subscription'=>$subscription->subscription_code])}}" target="_blank">{{ ucwords($job->status ?: 'Works') }}</a> 

                                                    @endif                       
                                    
                                                </div>
                                            @endif
                                            
                                        </td>

                                        <td>{{$job->category ? $job->category->title : ''}}</td>
                                        <td>{{$job->subcategory ? $job->subcategory->title : ''}}</td>
                                        <td>{{$job->title}}</td>
                                        <td>{{$job->description}}</td>
                                        <td>{{$job->total_worker}}</td>
                                        <td>{{$job->expired_day}}</td>
                                        @if ($job->admin_custom_job_status or $job->admin_given_workers > 0)
                                          @if ($job->admin_custom_job_status)
                                              
                                          <td>{{ucfirst($job->admin_custom_job_status)}}</td>
                                          @else   
                                            @if ($job->status == null)
                                            <td>Ongoing</td>
                                                @else    
                                                <td>Completed</td>
                                            @endif
                                          @endif  
                                        @else    
                                        @if ($job->status == null)
                                        <td>Ongoing ({{$job->works()->where('status','<>','rejected')->count()}})</td>
                                        @elseif($job->status == 'completed')
                                        <td>{{ucfirst($job->status)}}</td>
                                        @endif
                                        @endif
                                        {{-- <td>{{$job->works()->where('status','<>','rejected')->count()}}</td> --}}
                                        
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            {{$myPostedJobs->render()}}
                        </div>
                    @else
                        <div class="row">
                            <p>No Job Posted From Your Subscription Account.</p>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    
</section>