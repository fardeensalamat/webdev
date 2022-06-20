@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
  <section class="content">

  	<br>
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          @if (isset($websiteParameter->notice_one))
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-3">
                {!! $websiteParameter->notice_one !!}
              </div>
            </div>
          @endif
        	
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
          @if (isset($websiteParameter->notice_two))
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              {!! $websiteParameter->notice_two !!}

              
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          @endif
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
          @if (isset($websiteParameter->notice_three))

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              
              {!! $websiteParameter->notice_three !!}

             
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          @endif
          <!-- /.col -->

        </div>
        <!-- /.row -->
        @include('alerts.alerts')
<div class="row">

        
        
        <div class="col-md-12">
          <div class="card card-outline mb-2">
            <div class="card-header w3-deep-orange p-1">
              <h4 class="card-title w-100">
                <marquee class="w3-text-white" width="100%" direction="left">
                  {{$websiteParameter->user_page_msg}}
                </marquee>
              </h4>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card card-widget card-outline mb-2">
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
                <h3 class="widget-user-username">User Dashboard</h3>
                {{-- <h5 class="widget-user-desc">Admin Setting Area</h5> --}}
              </div>
              <div class="widget-user-image">
                @if ($user->img_name)
                

                {{-- {{ asset('storage/user/image/'.$user->img_name) }} --}}
                <img class="img-circle elevation-2" src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => $user->fi() ]) }}" alt="User Avatar">
                @else
                <img class="img-circle elevation-2" src="{{asset('img/ppm.jpg')}}" alt="User Avatar">
                @endif
                
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
                  {{-- pf number --}}
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header"></h5>
                      <span class="description-text"></span>
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
      
        @php
            $me = Auth::user();
        @endphp

      <div class="col-sm-9">
       
        <div class="card card-widget">
            <div class="card-body">
              <div class="row">
                @foreach ($wsCats as $cat)
                <div class="col-sm-3">
                  <div class="card" style="min-height: 250px !important">
                      <img class="rounded-top img-fluid" src="{{ route('imagecache', [ 'template'=>'cpmd','filename' => $cat->imageName() ]) }}">
                      <div class="p-2">
                          <h6>WS: {{ $cat->workstation ? $cat->workstation->title : ""}}</h6>
                          <h5>{{$cat->title}}</h5>
                          <p>{{$cat->description}}</p>
                          <p class="text-center">
                            @if ($cat->active)
                            
                            
                            <button type="button" class="btn btn-primary btn-sm infoU" style="color: white;" data-toggle="modal" data-target="#exampleModalCenter{{$cat->id}}">Subscribe</button>

                            <br> <br>
                            
                            @foreach($me->WsCatSubscriptions($cat) as $subscribe)
                                <a href="{{route('user.subscriptionDashboard',$subscribe->subscription_code)}}" class="btn btn-default mt-2 btn-sm">Dashboard {{$loop->iteration}} </a>
                                
                                
                            
                            @endforeach

                            <!-- Modal -->
                          <div class="modal fade" id="exampleModalCenter{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Enter Information</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form  action="{{route('user.newsubscription',$cat->id)}}" method="post">
                                  @csrf
                                <div class="modal-body">
                                  
                                  <div class="row">
                                    <div class="col-md-6">

                                      


                                      <div class="form-group">
                                        <label for="" class="col-form-label">Subscription Fee</label>
                                        <input type="text"  class="form-control" name="amount" placeholder="Enter Amount" value="100" readonly id="">
                                      </div>



                                      <div class="form-group">
                                        <label for="" class="col-form-label">Refferal ID (PF)</label>
                                        <input type="text"  class="form-control" name="reffer"  value="{{ isset($refferCode) ? $refferCode : "" }}" placeholder="Enter refferal ID (PF)" id="">
                                      </div>

                                      {{-- <input type="hidden" value="{{$cat->id}}" name="cat"> --}}


                                      <div class="form-group">
                                        <label for="" class="col-form-label">Subscribe for</label>
                                        <select class="form-control" name="for_user" id="typeOfGlass"> 
                                          <option value="own">For Me</option>
                                          <option value="new">For New Tenant</option>

                                        </select>
                                      </div>

                                      <div class="hideme">
                                        <div class="form-group">
                                          <label for="" class="col-form-label">Name</label>
                                          <input type="text" name="username" class="form-control" placeholder="Tenant Name">
                                        </div>
  
                                        <div class="form-group">
                                          <label for="" class="col-form-label">Mobile</label>
                                          <input type="text" name="mobile" class="form-control" placeholder="Mobile">
                                        </div>
  
                                        <div class="form-group">
                                          <label for="" class="col-form-label">Password</label>
                                          <input type="password" name="password" class="form-control" placeholder="password">
                                        </div>
                                      </div>

                                      

                                      


                                      @if(Auth::user()->balance > 99)

                                      @else

                                      <div class="form-group">
                                        <label for="" class="col-form-label">Transection</label>
                                        <input type="text" class="form-control" name="transection" placeholder="Transection ID" id="">
                                      </div>
                                      <div class="form-group">
                                        <label for="" class="col-form-label">Sender No</label>
                                        <input type="text" class="form-control" name="sender" placeholder="Sender No" id="">
                                      </div>

                                      @endif

                                      
                                      <button type="submit" class="btn btn-primary">Submit</button>

                                    </div>

                                    
                                    <div class="col-md-6">


                                      <div class="card card-primary">
                                        <div class="card-body w3-indigo">


                                          @if(Auth::user()->balance > 99)

                                          <p>Your Current Balance: BDT {{ Auth::user()->balance }}</p>

                                          <p> New Subscription Fee: BDT 100 </p>
                                          <p> New Balance Will Be: BDT <span class="badge badge-light w3-large">{{ Auth::user()->balance - 100 }}</span>   </p>

                                          @else

                                          <div class="form-group">
                                            <h5 class="text-center p-3">bKash / Nagad / Upay / Rocket</h5>
                                            <hr>
                                              {{-- <p>Our Bkash Merchant : 01821952907</p>
                                              
                                              <p>
                                                Go to bKash Menu by dialing *247#
                                                <br>
                                                Choose 'Payment' option
                                                <br>
                                                Enter our Merchant wallet number : 01821952907.
                                                <br>
                                                Enter BDT 100
                                                <br>

                                                Enter a reference : joining
                                                <br>
                                                Enter the counter number : 1.
                                                <br>
                                                Now enter your PIN to confirm: xxxx.
                                                <br>
                                                Done and wait untill approve!
                                              </p> --}}
                                              <p>{!!$websiteParameter->payment_no!!}</p>
                                          </div>

                                          @endif


                                          
                                        </div>
                                      </div>
                                      
                                    
                                    </div>  
                                  </div>             
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>
                            </div>
                          </div>
                            
                            @else
                            <a  class="btn btn-primary btn-sm disabled" style="color: white;">Subscribe</a>
                            @endif
                              
                          </p>
                      </div>
                  </div>
                </div>
                @endforeach
                
              </div>
            </div>
       </div>
    </div>
      
  	</div>
  

      </div><!-- /.container-fluid -->
  
  </section>
@endsection


@push('js')

<script>
  function subscribeId(actionUrl) {
    $("#subscribeForm").attr("action", actionUrl);
  }
$(document).ready(function(){
  $('select').change(function(){
    if($(this).val()==="new")
        $('.hideme').show();
        else
            $('.hideme').hide();
  }).change();
});
</script>

@endpush
