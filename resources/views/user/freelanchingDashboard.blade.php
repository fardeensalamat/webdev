@extends('user.layouts.userMaster')

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
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Share your Reffarel Link</span>
                <span class="info-box-number">
                  <small style="max-width:140px !important;"><b>
                    {{ url('/reffer') }} <br>
                    {{ '/'.$subscription->subscription_code }}
                  </b>

                  </small>

                  <br>
                  <button class="copyboard btn btn-primary btn-xs" data-text="{{route('welcome.pf',['reffer'=> $subscription->subscription_code])}}">Copy to Clipboard</button>
                </span>




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
                <span class="info-box-text">Balance </span>
                <span class="info-box-number">{{$subscription->balance}} TK

                    @if(($subscription->free_account == 1) and (Auth::user()->balance > (100 - $subscription->balance)))

                    <a href="{{route('subscription.updateubscriptionPaid',['subscription'=>$subscription->subscription_code,'cat'=>$subscription->category_id])}}" class="btn btn-sm btn-warning">Upgrade Account</a>


                    @elseif ($subscription->balance > 1)

                    @if($subscription->free_account == 1)


                    @else

                    <a href="{{route('subscriber.moveBalanceToWallet',$subscription->subscription_code)}}" class="btn btn-sm btn-default" onclick="return confirm('Do you want to move balance to your cashout wallet?')">Move to wallet</a>

                    @endif
                  @endif
                </span>

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


              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-th"></i></span>



              <div class="info-box-content">
                <span class="info-box-text">My Employees</span>
                <span class="info-box-number">
                  {{ $subscription->referredTeam()->count() }}
                  {{-- <small>%</small> --}}
                </span>
              </div>



              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->
        @include('alerts.alerts')
<div class="row">


        {{-- <div class="col-md-12">
          <div class="card card-outline mb-2">
            <div class="card-header w3-deep-orange p-1">
              <h4 class="card-title w-100">
                <marquee class="w3-text-white" width="100%" direction="left">
                  {{$websiteParameter->user_page_msg}}
                </marquee>
              </h4>
            </div>
          </div>
        </div> --}}
        @if (isset($workstation->user_page_msg))
        <div class="col-md-12">
          <div class="card card-outline mb-2">
            <div class="card-header w3-red p-1">
              <h4 class="card-title w-100">
                <marquee class="w3-text-white" width="100%" direction="left">
                  {{$workstation->user_page_msg}}
                </marquee>
              </h4>
            </div>
          </div>
        </div>
        @endif

        <div class="col-md-12">
          <div class="card card-primary card-outline mb-2">
            <div class="card-header">
              <h3 class="card-title">Job Search</h3>

              <div class="card-tools">
              <form action="">

                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="q" class="form-control" placeholder="Search Job">
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
                <h3 class="widget-user-username">Subscriber Dashboard</h3>
                {{-- <h5 class="widget-user-desc">Admin Setting Area</h5> --}}
              </div>
              <div class="widget-user-image">
                @if ($user->img_name)
                <img class="img-circle elevation-2" src="{{ asset('storage/user/image/'.$user->img_name) }}" alt="User Avatar">
                @else
                <img class="img-circle elevation-2" src="{{asset('img/ppm.jpg')}}" alt="User Avatar">
                @endif

              </div>
              <div class="card-footer" style="min-height: 207px;">
                <div class="row">
                  <div class="col-sm-1 border-right">
                    {{-- <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block --> --}}
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-10 border-right">

                    <div class="description-block">
                      <h5 class="description-header">Name</h5>
                      <span class="description-text">{{ucfirst($user->name)}}</span>
                      <h5 class="description-header">Contact</h5>
                      <span class="description-text">{{$user->mobile}}</span>
                    </div>


                    <div class="description-block">
                      <h5 class="description-header">PF NUMBER</h5>
                      <span class="description-text">{{$subscription->subscription_code}}</span>
                      <h5 class="description-header">Work Station</h5>
                      <span class="description-text">{{$workstation->title}}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-1">

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

        @php
            $me = Auth::user();
        @endphp

      <div class="col-sm-9">

        <div class="card card-widget">
            <div class="card-body">

            </div>
       </div>
    </div>

  	</div>


      </div><!-- /.container-fluid -->



  </section>
@endsection


@push('js')


<script>

	$(function(){

$(document).on('click', '.copyboard', function(e) {
  e.preventDefault();


  $(".copyboard").text('Copy to Clipboard');

  $(this).text('Coppied!');
  var copyText = $(this).attr('data-text');

  var textarea = document.createElement("textarea");
  textarea.textContent = copyText;
  textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
  document.body.appendChild(textarea);
  textarea.select();
  document.execCommand("copy");

  document.body.removeChild(textarea);
});

	});
</script>

@endpush

