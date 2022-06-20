<section class="content">
    <br>
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.alerts')
            <div class="card card-primary">
                <div class="card-header">
                    {{__('balance.balance')}}
                </div>
                <div class="card-body">                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-widget">
                                <div class="card-header text-center">
                                    {{__('balance.balance_total')}}
                                </div>
                                <div class="card-body">
                                    <div class="mybalanetotal">
                                        
                                        {{__('balance.balance')}}:<span> {{ Auth::user()->totalBalance() ?: 0.00 }}
                                        @if(Auth::user()->due_balance <= 0)
                                        <a href="{{route('user.commissionWithdraw')}}" class="w3-btn {{Auth::user()->wallet_lock ? 'w3-red' : 'w3-blue'}} btn btn-xs">{{__('balance.withdraw')}}</a>
                                        </span>
                                        @endif
                                        @if(Auth::user()->due_balance > 0)
                                        <br>
                                        Due:<span> {{ Auth::user()->due_balance ?: 0.00 }}
                                            <a href="{{route('user.userpaydue')}}" class="w3-btn  w3-red btn btn-xs">Pay Now</a>
                                        </span>
                                        @endif
                                        <br>

                                        @if($bkash)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" onchange="bkash()" type="radio" name="type" id="inlineRadio1" value="option1">
                                                <label class="form-check-label" for="inlineRadio1">Bkash</label>
                                            </div>
                                        @endif
                                        @if($nagad)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" onchange="nagad()" name="type" id="inlineRadio2" value="option2">
                                                <label class="form-check-label" for="inlineRadio2">Nagad</label>
                                            </div>
                                        @endif
                                        @if($rocket)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" onchange="rocket()" name="type" id="inlineRadio2" value="option2">
                                                <label class="form-check-label" for="inlineRadio2">Rocket</label>
                                            </div>
                                        @endif
                                        @if($upay)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" onchange="upay()" name="type" id="inlineRadio2" value="option2">
                                                <label class="form-check-label" for="inlineRadio2">Upay</label>
                                            </div>
                                        @endif
                                        <div id="bkash" style="display:none">
                                                <form method="post" action="{{ route('user.directwithdraw') }}">
                                                    @csrf
                                                    <div class="input-group input-group-sm mb-3">
                                                        <input type="number" required class="form-control" name="bkash_amount" placeholder="e.g: 5000">
                                                        <input type="hidden" required class="form-control" name="service_type" value='Bkash'>
                                                        <input type="text" required class="form-control" name="cashin_number" value="{{$bkash->number ?? ''}}" readonly>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="submit">Bkash</button>
                                                        </div>
                                                    </div>
                                                </form>

                                        </div>
                                        <div id="nagad" style="display:none">
                                                <form method="post" action="{{ route('user.directwithdraw') }}">
                                                    @csrf
                                                    <div class="input-group input-group-sm mb-3">
                                                        <input type="number" required class="form-control" name="bkash_amount" placeholder="e.g: 5000">
                                                        <input type="hidden" required class="form-control" name="service_type" value='Nagad'>
                                                        <input type="text" required class="form-control" name="cashin_number" value="{{$nagad->number ?? ''}}" readonly>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="submit">Nagad</button>
                                                        </div>
                                                    </div>
                                                </form>

                                        </div>
                                        <div id="rocket" style="display:none">
                                            <form method="post" action="{{ route('user.directwithdraw') }}">
                                                    @csrf
                                                    <div class="input-group input-group-sm mb-3">
                                                        <input type="number" required class="form-control" name="bkash_amount" placeholder="e.g: 5000">
                                                        <input type="hidden" required class="form-control" name="service_type" value='Rocket'>
                                                        <input type="text" required class="form-control" name="cashin_number" value="{{$rocket->number ?? ''}}" readonly>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="submit">Rocket</button>
                                                        </div>
                                                    </div>
                                                </form>

                                        </div>
                                        <div id="upay" style="display:none">
                                                <form method="post" action="{{ route('user.directwithdraw') }}">
                                                    @csrf
                                                    <div class="input-group input-group-sm mb-3">
                                                        <input type="number" required class="form-control" name="bkash_amount" placeholder="e.g: 5000">
                                                        <input type="hidden" required class="form-control" name="service_type" value='Upay'>
                                                        <input type="text" required class="form-control" name="cashin_number" value="{{$upay->number ?? ''}}" readonly>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="submit">Upay</button>
                                                        </div>
                                                    </div>
                                                </form>

                                        </div>

                                        <script type="text/javascript">
                                            function bkash(str){
                                                document.getElementById('bkash').style.display = 'block';
                                                document.getElementById('nagad').style.display = 'none';
                                                document.getElementById('rocket').style.display = 'none';
                                                document.getElementById('upay').style.display = 'none';
                                            }
                                            function nagad(str){
                                                document.getElementById('bkash').style.display = 'none';
                                                document.getElementById('nagad').style.display = 'block';
                                                document.getElementById('rocket').style.display = 'none';
                                                document.getElementById('upay').style.display = 'none';
                                            }
                                            function rocket(str){
                                                document.getElementById('bkash').style.display = 'none';
                                                document.getElementById('nagad').style.display = 'none';
                                                document.getElementById('rocket').style.display = 'block';
                                                document.getElementById('upay').style.display = 'none';
                                            }
                                            function upay(str){
                                                document.getElementById('bkash').style.display = 'none';
                                                document.getElementById('nagad').style.display = 'none';
                                                document.getElementById('rocket').style.display = 'none';
                                                document.getElementById('upay').style.display = 'block';
                                            }
                                           
                                    </script>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-widget">
                                <div class="card-header text-center">
                                    {{__('balance.add_balance')}}
                                </div>
                                <div class="card-body">
                                    <div class="myaddbalanetotal">
                                        
                                        <form method="post" action="{{ route('user.addBalanceToWallet') }}">
                                            @csrf
                                            <h5>{{__('balance.amount')}}</h5>
                                            <div class="input-group input-group-sm mb-3">
                                                <input type="number" required class="form-control" name="amount" placeholder="e.g: 5000">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"> {{__('balance.add_balance')}}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    Balance Add Tuitorial
                </div>
                <div class="card-body">
                    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
                    <div id="player"></div>

                    <script>
                    // 2. This code loads the IFrame Player API code asynchronously.
                    var tag = document.createElement('script');

                    tag.src = "https://www.youtube.com/iframe_api";
                    var firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                    // 3. This function creates an <iframe> (and YouTube player)
                    //    after the API code downloads.
                    var player;
                    function onYouTubeIframeAPIReady() {
                        player = new YT.Player('player', {
                        height: '300',
                        width: '60%',
                        videoId: 'Mb-4ScJ7ZKE',
                        playerVars: {
                            'playsinline': 1
                        },
                        events: {
                            'onReady': onPlayerReady,
                            'onStateChange': onPlayerStateChange
                        }
                        });
                    }

                    // 4. The API will call this function when the video player is ready.
                    function onPlayerReady(event) {
                        event.target.playVideo();
                    }

                    // 5. The API calls this function when the player's state changes.
                    //    The function indicates that when playing a video (state=1),
                    //    the player should play for six seconds and then stop.
                    var done = false;
                    function onPlayerStateChange(event) {
                        if (event.data == YT.PlayerState.PLAYING && !done) {
                        setTimeout(stopVideo, 120);
                        done = true;
                        }
                    }
                    function stopVideo() {
                        player.stopVideo();
                    }
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    {{__('balance.all_transaction')}}
                </div>
                <div class="card-body">
                    @if ($transactions->count() >0)
                    <table class="table table-bordered">
                        <tr>
                            <th>Date</th>
                            <th>Balance</th>

                            {{-- <th>Method</th> --}}
                            {{-- <th>Previous Balance</th> --}}
                            {{-- <th>New Balance</th> --}}
                            <th>Details</th>
                            <th>Status</th>
                        </tr>

                        @foreach($transactions as $tr)
                        <tr>
                            <td>{{ $tr->created_at }}</td>
                            <td>
                                {{ $tr->moved_balance }}
                            </td>
                            {{-- <td>
                                {{ $tr->type }}
                            </td> --}}
                            {{-- <td>
                                {{ $tr->previous_balance }}
                            </td> --}}

                            

                            {{-- <td>
                                {{ $tr->new_balance }}
                            </td> --}}
                            <td>{{$tr->details}}</td>
                            <td>
                                {{-- {{ $tr->order->first() }} --}}
                                <span class="badge badge-success">Success</span>
                            </td>
                        </tr>

                        @endforeach
                    </table> 
                    @else
                    <p class="text-center">{{__('balance.no_transaction_yet')}}</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    
</section>