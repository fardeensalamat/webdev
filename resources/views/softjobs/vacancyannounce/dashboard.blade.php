@extends('softjobs.vacancyannounce.layouts.vacancyannounceMaster')

@section('content')
  <section class="content">

  	<br>
  	<div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
        	<div class="col-12 col-sm-6 col-md-3">
            <a href="{{route('admin.dashboardmain')}}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">CV Bank</span>
                  <span class="info-box-number">Link</span>
                </div>
                <!-- /.info-box-content -->
              </div>

            </a>
            
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{route('admin.dashboardtenantinfo')}}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="far fa-comments"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Candidate Communication</span>
                  <span class="info-box-number">Link</span>
                </div>
                <!-- /.info-box-content -->
              </div>

            </a>
             
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          

          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{route('admin.dashboardsalesinfo')}}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-sync-alt"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Analytics</span>
                  <span class="info-box-number">Link</span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{route('admin.dashboardsalesinfo')}}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-user-check"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Service For Employers</span>
                  <span class="info-box-number">Link</span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-sm-3">
            <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-primary">
                    <h3 class="widget-user-username">{{$jobannouncer->user_name}}</h3>
                    <h5 class="widget-user-desc">{{$jobannouncer->company_name}}</h5>
                  </div>
    
                  <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => $user->fi() ]) }}" alt="User Avatar">
                  </div>
                  <div class="card-footer" style="min-height: 207px;">
                    <div class="row">
                      {{-- <div class="col-sm-2 border-right">
                        <div class="description-block">
                          <h5 class="description-header">3,200</h5>
                          <span class="description-text">SALES</span>
                        </div>
                        <!-- /.description-block -->
                      </div> --}}
                      <!-- /.col -->
                      <div class="col-sm-12 border-right">
                        <div class="description-block">
                          <h5 class="description-header">Description</h5>
                          <span class="description-text">{{$jobannouncer->business_description}}</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      {{-- <div class="col-sm-2">
                        <div class="description-block">
                          <h5 class="description-header">35</h5>
                          <span class="description-text">PRODUCTS</span>
                        </div>
                        <!-- /.description-block -->
                      </div> --}}
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



      
     


  
  </section>
@endsection