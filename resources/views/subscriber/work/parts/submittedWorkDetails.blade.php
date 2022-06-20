<section class="content">
    
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.alerts')
        </div>
        <div class="card-body">                    
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-9">
                        <h3 >{{ucfirst($freelancejobWork->title)}}</h3>

                          </div>
                          <div class="col-md-3 mt-2">
                            <a href="{{route('subscriber.subscriptionSubmittedWorkStatus',[$freelancejobWork,'status'=>'approved','subscription' => $subscription->subscription_code])}}" ><button class="btn btn-success">Approved</button></a>
                            <a href="{{route('subscriber.subscriptionSubmittedWorkStatus',[$freelancejobWork,'status'=>'claimed','subscription' => $subscription->subscription_code])}}" ><button class="btn btn-danger">Claim</button></a>
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
                            <img src="{{asset('storage/work/image/'.$freelancejobWork->img2)}}" width="100%"  alt="">
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