@extends('admin.layouts.adminMaster')

@push('css')



@endpush

@section('content')
  <section class="content">

  	<br>
  	<div class="container-fluid">
        <!-- Info boxes -->
        @if (Auth::user()->roleItems()->count() < 1)
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
                <span class="info-box-text">Total PF</span>
                <span class="info-box-number">{{$totalPf}}</span>
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
              <a href="{{route('admin.dashboard.tenentinfobyadmin')}}">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-user"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">Tenant Info Change</span>
                      <span class="info-box-number">Link</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>

              </a>
            
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

        </div>
        @endif
        <!-- /.row -->

<div class="row">
      @if (Auth::user()->roleItems()->count() < 1)
      <div class="col-sm-12">
       
        <div class="card card-widget">
          <div class="card-body" style="min-height: 343px;">
            <div class="row">
              
              <div class="col-12 col-sm-6 col-md-3">
                
                <div class="card card-widget">
                  <div class="card-header">
                    <h3 class="card-title">Present <b>({{$present}})</b></h3>
                  </div>
                  <div class="card-body">
                    Tenant Wallet <a href="{{route('admin.dashboard.tenantwalletdetails')}}"><i class="far fa-clipboard"></i></a>
                    <br>
                    <span class="w3-large">{{$totalTenantWallet}}</span>
                    <hr>
                    Pf Balance <a href="{{route('admin.dashboard.pfbalancedetails')}}"><i class="far fa-clipboard"></i></a>
                    <br>
                    <span class="w3-large">{{$totalPfBalance}}</span>
                    <hr>
                     Ad Balance <a href="#"></a>
                    <br>
                    <span class="w3-large">{{$totalTenantAdbalance}}</span>
                    <hr>
                     Due Balance <a href="#"></a>
                    <br>
                    <span class="w3-large">{{$totalduebalance}}</span>
                    
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-3">
                
                <div class="card card-widget">
                  <div class="card-header">
                    <h3 class="card-title">Profile Info</h3>
                  </div>
                  <div class="card-body">
                     Paid Pf <a href="{{ route('admin.dashboard.tenentinformation', ['type' => 'paidpf']) }}"><i class="far fa-clipboard"></i></a>
                    <br>
                    <span class="w3-large">{{$paidtotalPf}}</span>
                    <hr>
                    Unpaid Pf <a href="{{ route('admin.dashboard.tenentinformation', ['type' => 'unpaidpf']) }}"><i class="far fa-clipboard"></i></a>
                   <br>
                   <span class="w3-large">{{$unpaidtotalpf}}</span>
                   <hr>
                     Paid Shop <a href="{{ route('admin.dashboard.tenentinformation', ['type' => 'paidshop']) }}"><i class="far fa-clipboard"></i></a>
                    <br>
                    <span class="w3-large">{{$totalpaidshop}}</span>
                    <hr>
                    Unpaid Shop <a href="{{ route('admin.dashboard.tenentinformation', ['type' => 'unpaidshop']) }}"><i class="far fa-clipboard"></i></a>
                   <br>
                   <span class="w3-large">{{$totalunpaidshop}}</span>
                 
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    @else 
    <div class="col-sm-9">
      <div class="card card-widget">
        <div class="card-body"></div>
      </div>
    </div>
    @endif
      
  	</div>
  

      </div><!-- /.container-fluid -->


  
  </section>
@endsection


@push('js')

 



@endpush

