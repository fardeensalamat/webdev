@extends('admin.layouts.adminMaster')

@push('css')



@endpush

@section('content')
  <section class="content">

  	<br>
  	<div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
        	<div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Tenant</span>
                <span class="info-box-number">{{ $userCount }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          {{-- <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div> --}}
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-briefcase"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Companies</span>
                <span class="info-box-number">1</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          

          {{-- <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div> --}}

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
              
             
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->

<div class="row">
        <div class="col-md-12">
          <div class="card card-primary card-outline mb-2">
            <div class="card-header">
              <h3 class="card-title">Tenant Search</h3>

              <div class="card-tools">
              <form action="">
                  
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="q" class="form-control" placeholder="Search Tenant">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
                </form>
              </div>
              <!-- /.card-tools -->
            </div>

              </div>
          <!-- /.card -->
        </div>
      </div>



  	<div class="row">
  		<div class="col-sm-3">
  			<!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-primary">
                <h3 class="widget-user-username">Admin Dashboard</h3>
                <h5 class="widget-user-desc">Admin Setting Area</h5>
              </div>

              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => $user->fi() ]) }}" alt="User Avatar">
              </div>
              <div class="card-footer" style="min-height: 207px;">
                <div class="row">
                  <div class="col-sm-2 border-right">
                    {{-- <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block --> --}}
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Users</h5>
                      <span class="description-text">1</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-2">
                    {{-- <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div> --}}
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
      
      

      <div class="col-sm-9">
       
        <div class="card card-widget">
            {{-- <div id="map-canvas" style="width: 100%; height: 460px; border:0;border-radius: 5px;"></div> --}}
            <div class="card-body" style="width: 100%; height: 460px; border:0;border-radius: 5px;">
              {{-- <div class="container"> --}}
                {{-- <div class="row">
                  
                  <div class="col-md-3">
                    <div class="info-box">
                      
                      <div class="info-box-content">
                        {{-- Joining Amount --}}
                        <span class="info-box-text">Rental Balance</span>
                        {{-- <span class="info-box-number"> {{$joining->new_balance}} TK</span> --}}
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="info-box">
                      
                      <div class="info-box-content">
                        {{-- Joining Amount --}}
                        {{-- <span class="info-box-text">Softcode Balance</span> --}}
                        {{-- <span class="info-box-number">{{$softcodeBalance}} TK</span> --}}
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="info-box">
                      
                      {{-- <div class="info-box-content">
                        <span class="info-box-text">Reward Balance</span>
                        <span class="info-box-number">
                          {{$joiningReward->new_balance}} TK</span>
                      </div> --}}
                      <!-- /.info-box-content -->
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="info-box">
                      
                      {{-- <div class="info-box-content">
                        <span class="info-box-text">Tenant Deposit</span>
                        <span class="info-box-number">
                          {{$diposit ? $diposit->new_balance : "" }} TK</span>
                      </div> --}}
                      <!-- /.info-box-content -->
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="info-box">
                      
                      {{-- <div class="info-box-content">
                        <span class="info-box-text">Freelancer Payment</span>
                        <span class="info-box-number">
                          {{$wagesPayment->new_balance}} TK</span>
                      </div> --}}
                      <!-- /.info-box-content -->
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="info-box">
                      
                      {{-- <div class="info-box-content">
                        <span class="info-box-text">Total Withdraw</span>
                        <span class="info-box-number">
                          {{$withdrawSum}} TK</span>
                      </div> --}}
                      <!-- /.info-box-content -->
                    </div>
                  </div>
                  {{-- wagesPayment --}}
                  <div class="col-md-3">
                    <div class="info-box">
                      
                      {{-- <div class="info-box-content">
                        <span class="info-box-text">Work Order Amount</span>
                        <span class="info-box-number">
                          {{$order->new_balance}} TK</span>
                      </div> --}}
                      <!-- /.info-box-content -->
                    </div>
                  </div>
                  {{-- <div class="col-md-3">
                    <div class="info-box">
                      
                      <div class="info-box-content">
                        <span class="info-box-text">Withdrawal Amount</span>
                        <span class="info-box-number">
                          {{$withdraw->new_balance}} TK</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                  </div> --}}
                </div>  
              {{-- </div> --}}
            </div>
       </div>
    </div>
      
  	</div>
  

      </div><!-- /.container-fluid -->


  
  </section>
@endsection


@push('js')

 



@endpush

