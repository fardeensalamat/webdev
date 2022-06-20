@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
            <div class="card w3-deep-orange">
                <div class="card-body">
                    <h4> {{__('myservices.all_service_station')}}</h4>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <div class="card card-widget">
                    <div class="card-body">
                        <div class="row">


                            <?php $i = 1; ?>

                            <?php $i = ($catwise_servie_station->currentPage() - 1) * $catwise_servie_station->perPage() + 1; ?>
                            @foreach ($catwise_servie_station as $cat)
                                <div class="col-sm-4 col-md-3 col-12">
                                    <div class="card" style="min-height: 250px !important">
                                        <img class="rounded-top img-fluid"
                                            src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $cat->imageName()]) }}">
                                            
                                        <div class="p-2">
                                            <h6>{{ $i }}. SS: {{ $cat->workstation ? $cat->workstation->title : '' }}</h6>
                                            <p>Cat:{{ $cat->name }}</p>
                                            <p class="text-center">
                                                @if ($cat->active)
                                                    <button type="button" class="btn btn-primary btn-sm infoU"
                                                        style="color: white;" data-toggle="modal"
                                                        data-target="#exampleModalCenter{{ $cat->id }}">Subscribe</button>

                                                    <br> <br>

                                                    {{-- @foreach ($me->WsCatSubscriptions($cat) as $subscribe)
                                        <a href="{{route('user.subscriptionDashboard',$subscribe->subscription_code)}}" class="btn btn-default mt-2 btn-sm">Dashboard {{$loop->iteration}} </a>
                                        
                                        
                                    
                                    @endforeach --}}

                                                    <!-- Modal -->

                                                    <div class="modal fade" id="exampleModalCenter{{ $cat->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header w3-deep-orange">
                                                                    <h5 class="modal-title w3-text-white"
                                                                        id="exampleModalLongTitle">Add New
                                                                        Subscription
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>


                                                                <div class="modal-body text-center py-5">
                                                                    <div class="w3-card">
                                                                        <div class="card">
                                                                            <div class="card-body p-5">

                                                                                <a class="btn btn-primary btn-lg mb-2"
                                                                                    href="{{ route('user.newsubscriptionPaid', $cat) }}"><i
                                                                                        class="fa fa-plus"></i> Prepaid
                                                                                    Subscription</a>
                                                                                @if (!$cat->subscription->where('user_id', Auth::id())->first())
                                                                                    <a class="btn btn-secondary btn-lg mb-2"
                                                                                        onclick="return confirm('100 Tk will be deducted from your new account balance. Do you want to create postpaid subscription?');"
                                                                                        href="{{ route('user.newsubscriptionFree', $cat) }}"><i
                                                                                            class="fa fa-plus"></i>
                                                                                        Postpaid
                                                                                        Subscription
                                                                                    </a>
                                                                                @endif
                                                                                {{-- @if (!$haveCate)
                                                                                    <a class="btn btn-secondary btn-lg mb-2"
                                                                                        onclick="return confirm('100 Tk will be deducted from your new account balance. Do you want to create postpaid subscription?');"
                                                                                        href="{{ route('user.newsubscriptionFree', $cat) }}"><i
                                                                                            class="fa fa-plus"></i>
                                                                                        Postpaid
                                                                                        Subscription
                                                                                    </a>
                                                                                @endif --}}


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="exampleModalCenter{{ $cat->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        Enter Information</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form
                                                                    action="{{ route('user.newsubscription', $cat->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <div class="modal-body">

                                                                        <div class="row">
                                                                            <div class="col-md-6">




                                                                                <div class="form-group">
                                                                                    <label for=""
                                                                                        class="col-form-label">Subscription
                                                                                        Fee</label>
                                                                                    <input type="text"
                                                                                        class="form-control" name="amount"
                                                                                        placeholder="Enter Amount"
                                                                                        value="100" readonly id="">
                                                                                </div>



                                                                                <div class="form-group">
                                                                                    <label for=""
                                                                                        class="col-form-label">Refferal ID
                                                                                        (PF)</label>
                                                                                    <input type="text"
                                                                                        class="form-control" name="reffer"
                                                                                        value="{{ isset($refferCode) ? $refferCode : '' }}"
                                                                                        placeholder="Enter refferal ID (PF)"
                                                                                        id="">
                                                                                </div>

                                                                                {{-- <input type="hidden" value="{{$cat->id}}" name="cat"> --}}


                                                                                <div class="form-group">
                                                                                    <label for=""
                                                                                        class="col-form-label">Subscribe
                                                                                        for</label>
                                                                                    <select class="form-control"
                                                                                        name="for_user" id="typeOfGlass">
                                                                                        <option value="own">For Me</option>
                                                                                        <option value="new">For New Tenant
                                                                                        </option>

                                                                                    </select>
                                                                                </div>

                                                                                <div class="hideme">
                                                                                    <div class="form-group">
                                                                                        <label for=""
                                                                                            class="col-form-label">Name</label>
                                                                                        <input type="text" name="username"
                                                                                            class="form-control"
                                                                                            placeholder="Tenant Name">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for=""
                                                                                            class="col-form-label">Mobile</label>
                                                                                        <input type="text" name="mobile"
                                                                                            class="form-control"
                                                                                            placeholder="Mobile">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for=""
                                                                                            class="col-form-label">Password</label>
                                                                                        <input type="password"
                                                                                            name="password"
                                                                                            class="form-control"
                                                                                            placeholder="password">
                                                                                    </div>
                                                                                </div>






                                                                                @if (Auth::user()->balance > 99)

                                                                                @else

                                                                                    <div class="form-group">
                                                                                        <label for=""
                                                                                            class="col-form-label">Transection</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="transection"
                                                                                            placeholder="Transection ID"
                                                                                            id="">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for=""
                                                                                            class="col-form-label">Sender
                                                                                            No</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="sender"
                                                                                            placeholder="Sender No" id="">
                                                                                    </div>

                                                                                @endif


                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Submit</button>

                                                                            </div>


                                                                            <div class="col-md-6">


                                                                                <div class="card card-primary">
                                                                                    <div class="card-body w3-indigo">


                                                                                        @if (Auth::user()->balance > 99)

                                                                                            <p>Your Current Balance: BDT
                                                                                                {{ Auth::user()->balance }}
                                                                                            </p>

                                                                                            <p> New Subscription Fee: BDT
                                                                                                100 </p>
                                                                                            <p> New Balance Will Be: BDT
                                                                                                <span
                                                                                                    class="badge badge-light w3-large">{{ Auth::user()->balance - 100 }}</span>
                                                                                            </p>

                                                                                        @else

                                                                                            <div class="form-group">
                                                                                                <h5 class="text-center p-3">
                                                                                                    bKash / Nagad / Upay /
                                                                                                    Rocket</h5>
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
                                                                                                <p>{!! $websiteParameter->payment_no !!}
                                                                                                </p>
                                                                                            </div>

                                                                                        @endif



                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @else
                                                    <a class="btn btn-primary btn-sm disabled"
                                                        style="color: white;">Subscribe</a>
                                                @endif

                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            {{ $catwise_servie_station->render() }}
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
