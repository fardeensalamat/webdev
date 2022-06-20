<section class="content">
    
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.alerts')
        </div>
        <div class="card-body">                    
            <div class="row">
                <div class="col-12 col-md-9">
                    <div class="card">
                      <div class="card-header">
                        <h3 >{{ucfirst($freelanceJob->title)}}</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <nav class="navbar navbar-expand navbar-light">
                                <!-- Left navbar links -->
                                <ul class="navbar-nav">
                                  {{-- <li class="nav-item">
                                    <p class="nav-link" style="font-size: 13px;"> <i class="fas fa-clock"></i> Posted: {{$freelanceJob->created_at->diffForHumans()}}</p>
                                  </li> --}}
                                  {{-- <li class="nav-item d-none d-sm-inline-block">
                                    <p class="nav-link" style="font-size: 13px;"> <i class="fas fa-calendar-alt"></i> Expired: {{$freelanceJob->jobPostRemainingDays()}} {{Str::plural('day', $freelanceJob->jobPostRemainingDays())}}</p>

                                  </li> --}}
                                  {{-- <li class="nav-item d-none d-sm-inline-block">
                                    <p class="nav-link" style="font-size: 13px;">Job #{{$freelanceJob->id}}</p>
                                  </li> --}}
                                  <li class="nav-item d-none d-sm-inline-block">
                                    <p class="nav-link" style="font-size: 13px;"><i class="fas fa-coins"></i> Price: BDT {{$freelanceJob->job_work_price}}</p>

                                  </li>
                                </ul>
                              </nav>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            {{-- {{asset('storage/media/job/'.$freelanceJob->img_name)}} --}}
                            <img width="100%" src="{{ route('imagecache', [ 'template'=>'pnilg','filename' => $freelanceJob->fiName() ]) }}" alt="">
                            
                          </div>
                          @if ($freelanceJob->link)
                          <div class="col-md-12">
                            <div style="white-space: pre-line;">
                            <h6><a class="btn btn-primary" href="{{$freelanceJob->link}}" target="_blank">Work Link</a></h6>
                            </div>
                          </div>
                          @endif
                            
                            <div class="col-md-12">
                                <h4>
                                    Description
                                </h4>
                            </div>
                            <div class="col-md-12">
                              <div style="white-space: pre-line;">
                                
                                {!! $freelanceJob->description!!}
                              </div>
                            </div>
                        </div>
                        <!-- /.row -->
                      </div>
                      <!-- ./card-body -->
                      {{-- <div class="card-footer">
                        <div class="row">
                          <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                              <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                              <h5 class="description-header">$35,210.43</h5>
                              <span class="description-text">TOTAL REVENUE</span>
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                              <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                              <h5 class="description-header">$10,390.90</h5>
                              <span class="description-text">TOTAL COST</span>
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                              <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                              <h5 class="description-header">$24,813.53</h5>
                              <span class="description-text">TOTAL PROFIT</span>
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-3 col-6">
                            <div class="description-block">
                              <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                              <h5 class="description-header">1200</h5>
                              <span class="description-text">GOAL COMPLETIONS</span>
                            </div>
                            <!-- /.description-block -->
                          </div>
                        </div>
                        <!-- /.row -->
                      </div> --}}
                      <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-12 col-sm-3">
                    <!-- Widget: user widget style 1 -->
                  <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-gay">
                      <h3 class="widget-user-username">{{$freelanceJob->user->name}}</h3>
                      
                    </div>
      
                    <div class="widget-user-image">
                      <img class="img-circle elevation-2" src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => $freelanceJob->user->fi() ]) }}" alt="User Avatar">
                    </div>
                    <div class="card-footer" style="min-height: 207px;">
                      <div class="row">
                        <div class="col-sm-2 border-right">
                          
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-8 border-right">
                          <p>Since {{$freelanceJob->user->created_at->format('Y-m-d')}}</p>
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
        @if ($subscription->id == $freelanceJob->subscriber_id)
        
        @else 
        <div class="col-md-4 ml-4 w3-center">
          <div class="w3-card">
            <div class="card-body w3-purple">
              <div class="container w3-center">
                @if ($worklock)
                      <button  class="btn btn-success btn-sm">Locked</button>
                      <p class="pt-4">Please submit your work within 15 miniutes.</p>
                          @else   
                          <a href="{{route('subscriber.freelanceWorkLock',[$freelanceJob,'subscription'=>$subscription->subscription_code])}}" class="btn btn-success btn-sm">Lock This Job For Work</a>
                          <p class="pt-4">Please lock this job first and submit your work then within 15 miniutes.</p>
                      @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card-body">
            <div class="row">
              <div class="col-md-9">
                <div class="card">
                  <div class="card-header">
                    Submit Your Work Prove
                  </div>
                  <div class="card-body">
                    @if (!$workDone)
                      <div class="row">
                        <div class="col-md-12">
                          <form action="{{route('subscriber.freelanceWorkSubmit',[$freelanceJob,'subscription'=>$subscription->subscription_code])}}" method="post" enctype="multipart/form-data">
                            @csrf
  
                              @if($freelanceJob->subcategory->work_link)
                              <div class="form-group">
                                <label for="">Work Link (View/Like/Subscription/Channel link, যেখান থেকে স্ক্রিনশট নিয়েছেন, সেই চ্যানেল লিঙ্ক)</label>
                                <input type="text"
                                  class="form-control" name="work_link" id="work_link" aria-describedby="helpId" placeholder="Screenshot taken link" required>
                              </div>
                              @endif
  
                              <div class="row">
  
                                
                                
                                @if ($freelanceJob->subcategory->screenshot == 1)
                                
                                  <div class="col-md-6">
  
                                    <div class="form-group">
                                      <label for="image1">Upload Screenshot Prove 1:</label>
                                      <input type="file" class="form-control" id="image1" name="image1" style="padding-bottom:35px;">
                                    </div>
  
                                    
                                  </div> 
                                  @if ($worklock)
                                    <div class="col-md-2 mt-4">
                                  
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                      </div>
                                    </div>
                                    @endif
                                  @else 
                                  <div class="col-md-6">
  
                                    <div class="form-group">
                                      <label for="image1">Upload Screenshot Prove 1:</label>
                                      <input type="file" class="form-control" id="image1" name="image1" style="padding-bottom:35px;">
                                    </div>
    
                                    
                                  </div>
                                  <div class="col-md-6">
    
                                    <div class="form-group">
                                      <label for="image2">Upload Screenshot Prove 2:</label>
                                      <input type="file" class="form-control" id="image2" name="image2" style="padding-bottom:35px;">
                                    </div>
    
                                    {{-- <label>Upload Screenshot Prove</label>
                                    <div class="form-group">
                                      <!-- <label for="customFile">Custom File</label> -->
                  
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="image2">
                                        <label class="custom-file-label" for="customFile">Upload Screenshot</label>
                                      </div>
                                    </div> --}}
                                  </div>
                                  
                                      <div class="col-md-2">
                                  @if ($worklock)
                                      
                                        <div class="form-group">
                                          <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                      </div>
                                      @endif
  
                                @endif
                                
                                
                              </div>
                          </form>
                        </div>
                      </div> 
                      @else 
                      <div class="row">
  
                        <div class="col-md-12">
                          <p>Previously you have submitted work for this job. Thanks</p></div>
                      </div>
                    @endif                 
  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        
    </div>


</section>