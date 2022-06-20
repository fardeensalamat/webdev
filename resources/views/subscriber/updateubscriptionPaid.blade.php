@extends('subscriber.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <?php $user = Auth::user();?>
        <br>
        <div class="container-fluid">

            @include('alerts.alerts')


            <div class="row">

                <div class="col-md-12">


                     <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Enter Information <small>({{ $cat->workstation->title }} >> {{ $cat->name }})</small></h5>

                                </div>
                                <form  action="{{route('subscriber.updateSubscriptionOldAccount',['subscription'=>$subscription->subscription_code,'cat'=>$cat->id])}}" method="post">
                                  @csrf
                                <div class="modal-body">

                                  <div class="row">
                                    <div class="col-md-6">

                                        @php
                                            $fee = 100 - $subscription->balance;
                                        @endphp


                                      <div class="form-group">
                                        <label for="" class="col-form-label">Subscription Fee</label>
                                        <input type="text"
                                         value="{{$fee}}"
                                          readonly class="form-control"
                                           name="amount" placeholder="Enter Amount"
                                             id="">
                                        <div class="text-muted"> {{$fee}} SCB will be deducted from your tenant wallet.</div>
                                      </div>



                                      {{-- <div class="form-group">
                                        <label for="" class="col-form-label">Refferal ID (PF)</label>
                                        <input type="text"  class="form-control" name="reffer"  value="{{ isset($refferCode) ? $refferCode : "" }}" placeholder="Enter refferal ID (PF)" id="">
                                      </div> --}}

                                      {{-- <input type="hidden" value="{{$cat->id}}" name="cat"> --}}





                                      <button type="submit" class="btn btn-primary">Upgrade</button>

                                      <br> <br>
                                    </div>


                                    <div class="col-md-6">


                                      <div class="card card-primary">
                                        <div class="card-body w3-indigo">




                                          <p>Wallet Balance: {{ Auth::user()->balance }} SCB</p>
                                          <p>Subscription Balance: {{$subscription->balance}} SCB</p>
                                          <p>Subscription Fee: 100 SCB</p>
                                          <p>New Wallet Balance: {{Auth::user()->balance - $fee}} SCB</p>
                                          {{-- <p> New Subscription Fee: BDT 100 </p> --}}
                                          {{-- <p> New Balance Will Be: BDT <span class="badge badge-light w3-large">{{ Auth::user()->balance - 100 }}</span>   </p> --}}





                                        </div>
                                      </div>


                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                </div>
                              </form>
                              </div>


                              <br>

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
        $(document).ready(function() {
            $('select').change(function() {
                if ($(this).val() === "new")
                    $('.hideme').show();
                else
                    $('.hideme').hide();
            }).change();
        });
    </script>

@endpush
