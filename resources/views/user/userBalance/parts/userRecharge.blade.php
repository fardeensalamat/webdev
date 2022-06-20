<section class="content">
    <br>
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.alerts')
            <div class="card card-primary">
                <div class="card-header">
                    Balance Add
                </div>
                <div class="card-body">                    
                    <div class="card card-widget">
                        <div class="card-header">
                            Recharge Amount to Wallet
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="usercontent mt-3">
                                    <div class="myrecentorder" style="min-height: 340px;">
                                        
                                        <div class="row" style="margin:0;">
                                            <div class="col-md-6" style="padding:10px;">
                                                <div class="mybalanetotal">
                                                    <p>New Recharg Amount (BDT)</p>
                                                    <span>{{ $order->paid_amount }}</span>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding:10px;">
                                                <div class="myaddbalanetotal">
                                                    <p>Online Payment</p>
                                                    <br>
                                                <div class="row">
                                                    {{-- <div class="col-md-6">
                                                        <button class="btn btn-primary mb-3" id="sslczPayBtn"
                                                    token="{{ $order->id }}"
                                                    postdata=""
                                                    order="{{ $order->id }}"
                                                    endpoint="/pay-via-ajax"> Pay Using sslcommerz
                                                    </button>
                                                    </div> --}}

                                                    <div class="col-md-3">
                                                        <button onclick="subscribeId('{{route('user.balaceRechargeRequest',$order->id)}}')" class="
                                                        btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Pay</button>
                                                    </div>

                                                    <div class="col-md-3">
                                                      <a href="{{ route('addNagAddMoney',['amount'=>$order->paid_amount]) }}" class="btn btn-info">Pay Nagad Online</a>
                                                    </div>
                                                </div>               
                                                
                    
                                          
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New message</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                    <form id="subscribeForm" action="" method="post">
                        @csrf

                        <div class="form-group">
                          <label for="" class="col-form-label">Amount</label>
                          <input type="text" class="form-control" value="{{$order->paid_amount}}" readonly id="">
                        </div>

                        <div class="form-group">
                          <label for="" class="col-form-label">Transection</label>
                          <input type="text" class="form-control" name="transection" placeholder="Transection ID" id="">
                        </div>

                        <div class="form-group">
                          <label for="" class="col-form-label">Sender No</label>
                          <input type="text" class="form-control" name="sender" placeholder="Sender No" id="">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-body w3-indigo">
                          <div class="form-group">
                            {{-- <h5 class="text-center p-3">Bkash</h5> --}}
                            <h5 class="text-center">bKash / Nagad / Upay / Rocket</h5>
                            <hr>
                              {{-- <p>Our Bkash Merchant : 01821952907</p> --}}
									            {{-- <p>Please Send Money To : {{$websiteParameter->payment_no}} (personal) <br>bKash / Nagad / Upay / Rocket</p> --}}
                              <p>{!!$websiteParameter->payment_no!!}</p>
                              {{-- <p>
                                Go to bKash Menu by dialing *247#
                                <br>
                                Choose 'Payment' option
                                <br>
                                Enter our Merchant wallet number : 01821952907.
                                <br>
                                Enter BDT {{ $order->paid_amount }}
                                <br>
    
                                Enter a reference : joining
                                <br>
                                Enter the counter number : 1.
                                <br>
                                Now enter your PIN to confirm: xxxx.
                                <br>
                                Done and wait untill approve!
                              </p> --}}
                          </div>
                        </div>
                      </div>
                </div>
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
          </div>
        
        </div>
      </div>
    
</section>