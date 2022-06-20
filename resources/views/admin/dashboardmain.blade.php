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
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Balance</span>
                <span class="info-box-number">{{$softBalance}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
         

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Rewards Balance</span>
                <span class="info-box-number">{{$rewards}}</span>
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
            <div class="info-box mb-3">
              <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Remaining Balance</span>
                <span class="info-box-number">{{$todaysoftBalance}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

        </div>
        @endif
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
  		
      
      
      @if (Auth::user()->roleItems()->count() < 1)
      <div class="col-sm-12">
       
        <div class="card card-widget">
          <div class="card-body" style="min-height: 343px;">
            <div class="row">
              <div class="col-12 col-sm-6 col-md-4">
                <div class="card card-default">
                  <div class="card-header">
                    <h4 class="card-title">
                      Today Total Cashin   <a href="{{route('admin.dashboard.todaytotalcashindetails')}}"><i class="far fa-clipboard"></i></a>
                    </h4>
                  </div>
                  <div class="card-body">
                    <h5><b>{{$todayIn}}</b></h5>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-4">
                <div class="card card-default">
                  <div class="card-header">
                    <h4 class="card-title">
                      Today Total Cashout <a href="{{route('admin.dashboard.todaytotalwitdrawdetails')}}"><i class="far fa-clipboard"></i></a>
                    </h4>
                  </div>
                  <div class="card-body">
                    <h5><b>{{$todaytotalwitdraw}}</b></h5>
                  </div>
                </div>
              </div>
              
              <div class="col-12 col-sm-6 col-md-4">
                <div class="card card-default">
                  <div class="card-header">
                    <h4 class="card-title">
                      Today Remaining Balance 
                    </h4>
                  </div>
                  <div class="card-body">
                    @if($todaysoftBalance > 0)
                    <h5><b>{{$todaysoftBalance}}</b></h5>
                    {{-- <h5><b>{{$todayIn -($todaysoftBalance + $todaytotalpfbalance)}}</b></h5> --}}

                    @else 
                    <h5><b>0</b></h5>
                    @endif
                  </div>
                </div>
              </div>
              
            </div>
            <div class="row">

              <div class="col-12 col-sm-6 col-md-3">
                <div class="card card-default">
                  <div class="card-header">
                    <h4 class="card-title">
                      Today Softcom In <a href="{{route('admin.dashboard.todaysoftcodeindetails')}}"><i class="far fa-clipboard"></i></a>
                    </h4>
                  </div>
                  <div class="card-body">
                    <h5><b>{{$todaySoftcodeGet}}</b></h5>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-3">
                <div class="card card-default">
                  <div class="card-header">
                    <h4 class="card-title">
                    Today Softcom Out<a href="{{route('admin.dashboard.todaysoftcodeoutdetails')}}"><i class="far fa-clipboard"></i></a>
                    </h4>
                  </div>
                  <div class="card-body">
                    <h5><b>{{$todaySoftcodeGive}}</b></h5>
                  </div>
                </div>
              </div>
              
              <div class="col-12 col-sm-6 col-md-3">
                <div class="card card-default">
                  <div class="card-header">
                    <h4 class="card-title">
                    Total Softcom In <a href="{{route('admin.dashboard.totalsoftcodeindetails')}}"><i class="far fa-clipboard"></i></a>
                    </h4>
                  </div>
                  <div class="card-body">
                    <h5><b>{{$totalSoftcodeget}}</b></h5>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-3">
                <div class="card card-default">
                  <div class="card-header">
                    <h4 class="card-title">
                      Total Softcom Out  <a href="{{route('admin.dashboard.totalsoftcodeoutdetails')}}"><i class="far fa-clipboard"></i></a>
                    </h4>
                  </div>
                  <div class="card-body">
                    <h5><b>{{$totalSoftcodeGive}}</b></h5>
                  </div>
                </div>
              </div>
              
             
              
            </div>
            <div class="row">
              
              <div class="col-12 col-sm-6 col-md-3">
                
                <div class="card card-widget">
                  <div class="card-header">
                    <h3 class="card-title">In <b>({{$in}})</b></h3>
                  </div>
                  <div class="card-body">
                    Rental <a href="{{route('admin.dashboard.rentaldetails')}}"><i class="far fa-clipboard"></i></a>
                    <br>
                    <span class="w3-large">{{$totalRental}}</span>
                    <hr>
                    Deposit <a href="{{route('admin.dashboard.depositdetails')}}"><i class="far fa-clipboard"></i></a>
                    <br>  
                    <span class="w3-large">{{$totalDeposit}}</span>
                    <hr>
                     By Admin <a href="{{route('admin.dashboard.depositdetails')}}"><i class="far fa-clipboard"></i></a>
                    <br>  
                    <span class="w3-large">{{$tenentbalanceaddbyadmin}} </span>
                    
                  </div>
                 
                </div>
              </div>

              <div class="col-12 col-sm-6 col-md-3">
                
                <div class="card card-widget">
                  <div class="card-header">
                    <h3 class="card-title">Out</h3>
                  </div>
                  <div class="card-body">
                    Withdraw <a href="{{route('admin.dashboard.totalwitdrawdetails')}}"><i class="far fa-clipboard"></i></a>
                    <br>
                    <span class="w3-large">{{$totalwitdraw}}</span>
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

