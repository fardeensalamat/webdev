<section class="content">
    
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.alerts')
        </div>
        <div class="card-body">                    
            <div class="row">
                <div class="col-md-9">

                  <h3>Work Details</h3>

                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-9">
                            <h3 >{{ucfirst($freelancejobWork->title)}}</h3>
                            <span>Category: {{$freelancejobWork->jobcategory ? $freelancejobWork->jobcategory->title : ''}} Subcategory: {{$freelancejobWork->jobsubcategory ? $freelancejobWork->jobsubcategory->title : ''}}</span>
                          </div>
                          <div class="col-md-3 mt-2">
                            @if(!$freelancejobWork->bt)
                            <a href="{{ route('admin.jobWorkStatusUpdate',['work'=> $freelancejobWork,'status'=> 'approved']) }}" ><button class="btn btn-success btn-sm">Approved</button></a>
                            <a href="{{ route('admin.jobWorkStatusUpdate',['work'=> $freelancejobWork,'status'=> 'rejected']) }}" ><button class="btn btn-danger btn-sm">Reject</button></a>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        
                        <br>
                        <div class="row">
                          <div class="col-md-6">
                            {{-- {{asset('storage/media/job/'.$freelanceJob->img_name)}} --}}
                            {{-- <img src="{{ route('imagecache', [ 'template'=>'pfilg','filename' => $freelancejobWork->fiName() ]) }}" class="w-100 w3-border" alt=""> --}}
                            <img src="{{asset('storage/work/image/'.$freelancejobWork->img)}}" width="100%" alt="">
                            
                          </div>

                          <div class="col-md-6">
                            {{-- {{asset('storage/media/job/'.$freelanceJob->img_name)}} --}}
                            {{-- <img class="w-100 w3-border" src="{{ route('imagecache', [ 'template'=>'pfilg','filename' => $freelancejobWork->fiName2() ]) }}" alt=""> --}}
                            @if($freelancejobWork->img2)
                            <img src="{{asset('storage/work/image/'.$freelancejobWork->img2)}}" width="300" height="500" alt="">
                            @endif
                          </div>
                            {{-- <div class="col-md-12">
                                <h4>
                                    Description
                                </h4>
                            </div>
                            
                            <div class="col-md-12">
                              <div style="font-size: 15px;">
                                {!! $freelancejobWork->require_details!!}
                              </div>
                            </div> --}}
                        </div>
                        <!-- /.row -->

                        @if($lnk = $freelancejobWork->workDoneLink)

                        <div class="card">
                          <div class="card-header p-1">
                            <h4 class="card-title">
                              Submitted work link
                            </h4>
                          </div>
                          <div class="card-body p-1">
                            {{ $lnk->link }}
                          </div>
                        </div>
                          
          
                        @endif
                      </div>
                    </div>
                    <!-- /.card -->



                    <br>
                    <h3>Job Details</h3>


                    @php $job = $freelancejobWork->job; @endphp

                    <div class="card">
                      <div class="card-header">
                        <h3 >{{ucfirst($job->title)}}
                            
                        </h3>
                        @if(($job->status =='pending'))
                        <div class="float-right">
                            <div class="btn-group btn-group-xs w3-hover-shadow">

                                

                                <a class="btn btn-success btn-xs" href="{{route('admin.approvedJob',$job)}}" onclick="return confirm('Are you sure want to approve this job?')">Approved</a>
                
                                <a class="btn btn-danger btn-xs" href="{{route('admin.suspendJob',$job)}}" onclick="return confirm('Are you sure want to suspend this job?')">Suspend</a>                        
                
                            </div>
                        </div>
                        @endif
                      </div>
                      
                      <!-- /.card-header -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <nav class="navbar navbar-expand navbar-light">
                                <!-- Left navbar links -->
                                <ul class="navbar-nav">
                                  <li class="nav-item">
                                    <p class="nav-link" style="font-size: 13px;"> <i class="fas fa-clock"></i> Posted: {{$job->created_at->diffForHumans()}}</p>
                                  </li>
                                  
                                  <li class="nav-item d-none d-sm-inline-block">
                                    <p class="nav-link" style="font-size: 13px;"><i class="fas fa-coins"></i> Price: BDT {{$job->job_work_price}}</p>

                                  </li>
                                </ul>
                              </nav>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            
                            <img src="{{ route('imagecache', [ 'template'=>'pfilg','filename' => $job->fiName() ]) }}" width="100%" alt="">
                            
                          </div>

                          <div class="col-md-12">
                            <h4>Job ID: {{ $job->id}}</h4>

                          </div>

                          <div class="col-md-12">
                            <h4>Category: {{ $job->category->title }}</h4>

                          </div>

                          <div class="col-md-12">
                            <h4>Subcategory: {{ $job->subcategory->title }}</h4>

                          </div>

                          @if ($job->link)
                          <div class="col-md-12">
                            <h4>Link: <a href="{{$job->link}}" target="_blank">{{$job->link}}</a></h4>

                          </div>
                          @endif
                            
                            <div class="col-md-12">
                                <h4>
                                    Description
                                </h4>
                            </div>
                            <div class="col-md-12">
                                {!! $job->description!!}
                            </div>
                        </div>
                        <!-- /.row -->
                      </div>
                        
                    </div>




                </div>
                <div class="col-sm-3">
                    <!-- Widget: user widget style 1 -->
                  <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-gay">
                      <h3 class="widget-user-username">{{$freelancejobWork->user->name}}</h3>
                      
                    </div>
      
                    <div class="widget-user-image">
                      <img class="img-circle elevation-2" src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => $freelancejobWork->user->fi() ]) }}" alt="User Avatar">
                    </div>
                    
                    <div class="card-footer" style="min-height: 207px;">
                      <div class="row">
                        <div class="col-sm-2 border-right">
                          
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-8 border-right">
                          <p>Since {{$freelancejobWork->user->created_at->format('Y-m-d')}}</p>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2">
                          
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
      
                    <div class="card-footer p-0">
                      <ul class="nav flex-column">
      
      
                      
                      </ul>
                    </div>
                  </div>
                  <!-- /.widget-user -->
                </div>
            </div>
            
        </div>
    </div>
</section>