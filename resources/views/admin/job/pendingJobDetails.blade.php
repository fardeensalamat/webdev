@extends('admin.layouts.adminMaster')

@push('css')
@endpush

@section('content')
  

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
                                  <p class="nav-link" style="font-size: 13px;"> <i class="fas fa-clock"></i> Duration to Complete Date: {{$job->expired_day}}</p>
                                </li>

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
                          
                          <img width="100%" src="{{ route('imagecache', [ 'template'=>'pfilg','filename' => $job->fiName() ]) }}" alt="">
                          
                        </div>

                        <div class="col-md-12">
                          <h4>Job ID: {{ $job->id}}</h4>

                        </div>

                        <div class="col-md-12">
                          <h4>Category: {{ $job->category ? $job->category->title : ''}}</h4>

                        </div>

                        <div class="col-md-12">
                          <h4>Subcategory: {{ $job->subcategory ? $job->subcategory->title : '' }}</h4>

                        </div>

                        <div class="col-md-12">
                          <h4>
                              Total Workers: {{ $job->total_worker }}
                              
                          </h4>

                        </div>
                        @if ($job->admin_given_workers > 0)
                        <div class="col-md-12">
                          <h4>
                             Job Type: <span class="badge badge-success">Admin Modified Job</span>
                            
                        </h4>
                          <h4>
                              Admin Given Worker: <span class="badge badge-success">{{ $job->admin_given_workers }}</span>
                              
                          </h4>

                        </div>
                        @endif

                        @if ($job->admin_custom_job_status != null)
                        <div class="col-md-12">
                          <h4>
                            Job Type: <span class="badge badge-success">Custom Job</span>
                            
                        </h4>
                          <h4>
                              Custom Job Status: <span class="badge badge-warning">{{ ucfirst($job->admin_custom_job_status) }}</span>
                              
                          </h4>

                        </div>
                        @endif
                        

                        <div class="col-md-12">
                          <h4>
                              Admin Selection Total Workers: {{ $job->admin_given_workers }}
                              <a href="" class="btn btn-default btn-edit-admin-given-workers"><i class="fa fa-edit"></i></a>
                          </h4>

                        </div>

                        <div class="col-md-12">
                          
                          {{-- <div class="worker-edit-container" style="display: none;">

                            <br>
                            <form method="post" action="{{route('admin.editJobPostWorkerNum',$job)}}" >
                          
                              @csrf 

                              <div class="form-group ">
                                  <input  name="admin_given_workers" 
                                  min="5" step="1" max="{{ (int) $job->admin_given_workers < $job->total_worker ? (int) $job->total_worker : 6 }}"
                                   class="form-control"  onkeyup="check(); return false;"
                                  id="admin_given_workers" placeholder="admin given workers" value="{!! old('admin_given_workers') ?: $job->admin_given_workers  !!}">
                              </div>

                              <span id="message"></span>
                              <br>
                              <button class="btn btn-primary" type="submit">Update</button>

                            </form>
                          </div> --}}
                          <div class="worker-edit-container" style="display: none;">
                            <div class="row">
                              {{-- worker --}}
                              <div class="col-md-6">
                                <div class="form-group">
                                  <div class="card-deck">
                                    <div class="card w3-deep-orange">
                                      <div class="card-title w3-center">
                                        <h5 class="card-text ">
                                          Modify Number of Workers
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <form method="post" action="{{route('admin.editJobPostWorkerNum',$job)}}" >
                                
                                          @csrf 
            
                                          <div class="form-group">
                                            <label for="">Workers Need</label>
                                              <input  name="admin_given_workers" 
                                              min="1" step="1" max="{{ (int) $job->admin_given_workers < $job->total_worker ? (int) $job->total_worker : 1 }}"
                                               class="form-control"  onkeyup="check(); return false;"
                                              id="admin_given_workers" placeholder="admin given workers" value="{!! old('admin_given_workers') ?: $job->admin_given_workers  !!}" type="number">
                                          </div>
            
                                          <span id="message"></span>
                                          <br>
                                          
                                          <div class="form-group">
                                            <input type="checkbox" name="full_complete" id="full_complete" {{$job->status == 'completed' ? 'checked' : ''}}> Full Completed
                                          </div>
                                          <br>
                                          <button class="btn btn-primary" type="submit">Update</button>
            
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              {{-- ./worker end --}}

                              {{-- remote --}}
                              <div class="col-md-6">
                                <div class="form-group">
                                  <div class="card-deck " style="min-height: 197px;">
                                    <div class="card w3-purple">
                                      <div class="card-title w3-center">
                                        <h5 class="card-text ">
                                          Custom Work
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <form action="{{route('admin.makeJobRemote',$job)}}"  method="post">
                                            @csrf
                                            
                                              <label for="">Selete Status</label>
                                              <select name="remote_status" class="form-control" id="">
                                                <option selected>Selece One</option>
                                                <option value="ongoing">Ongoing</option>
                                                <option value="completed">Completed</option>
                                              </select>
                                            <br>
                                            
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              {{-- ./remote end --}}
                            </div>
                          </div>
                          
                        </div>

                        @if ($job->link)
                        <div class="col-md-12">
                          <h4>Link: <a href="{{$job->link}}" target="_blank">{{$job->link}}</a></h4>

                        </div>
                        @endif
                          
                          <div class="col-md-12">
                              <h4>
                                  Description <a href="" class="btn btn-default btn-edit-description"><i class="fa fa-edit"></i></a>
                              </h4>
                          </div>
                          <div class="col-md-12">
                            <div class="description-container" style="white-space: pre-line;">
                              {!! $job->description!!}

                            </div>
                            <div class="description-edit-container" style="display: none;">

                              <br>
                              <form method="post" action="{{ route('admin.pendingJobDescriptionUpdate', $job) }}" >
                            
                                @csrf 

                                <div class="form-group ">
                                    <textarea  name="description" class="form-control" rows="6" id="description" placeholder="Description">{!! old('description') ?: $job->description  !!}</textarea>
                                </div>

                                <button class="btn btn-primary" type="submit">Update</button>

                              </form>
                            </div>
                          </div>
                      </div>
                      <!-- /.row -->
                    </div>
                      
                  </div>
                    
              </div>
              @if(isset($job->user->name))
              <div class="col-sm-3">
                  <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-gay">
                    <h3 class="widget-user-username">{{$job->user->name}}</h3>
                    
                  </div>
    
                  <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => $job->user->fi() ]) }}" alt="User Avatar">
                  </div>
                  <div class="card-footer" style="min-height: 207px;">
                    <div class="row">
                      <div class="col-sm-2 border-right">
                        
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-8 border-right">
                        <p>Since {{$job->user->created_at->format('Y-m-d')}}</p>
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
            @endif
          </div>
          </div>
          
      </div>
      
      
  </div>


</section>

@endsection


@push('js')

<script>
  $(function(){

    $(document).on('click', '.btn-edit-description', function(e){

      e.preventDefault();

      $(".description-container").toggle();
      $(".description-edit-container").toggle();

    });
  });


  $(function(){

      $(document).on('click', '.btn-edit-admin-given-workers', function(e){

        e.preventDefault();

        $(".worker-container").toggle();
        $(".worker-edit-container").toggle();

      });
      
    });


    function check()
    {
      var worker = document.getElementById('admin_given_workers'); 
      var message = document.getElementById('message');

       var goodColor = "#fff";
        var badColor = "#FF9B37";
        // console.log(worker.value);
        if(worker.value < 1)
        {        
            var len = worker.value;
            worker.style.backgroundColor = badColor;
            message.style.color = badColor;
            message.innerHTML = `Please enter value more then 1`;
        }
        else
        {
            message.style.color = goodColor;
            worker.style.backgroundColor = goodColor;
            message.innerHTML = "";
        }

    }



    

  
</script>

@endpush