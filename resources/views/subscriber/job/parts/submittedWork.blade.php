<section class="content">
    <br>
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.alerts')
            <div class="card card-primary">
                <div class="card-header">
                    Submitted Works of Job: (ID: {{ $freelanceJob->id }}) {{ $freelanceJob->title }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            {{-- <a href="{{ route('subscriber.actionChange',['freelanceJob'=>$freelanceJob->id,'subscription' => $subscription->subscription_code]) }}" onclick="return confirm('Do you want to approved all?')"><button class="btn btn-success btn-sm mb-2">Approve All</button></a>  --}}

                            <button type="button" class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#exampleModalCenter{{$freelanceJob->id}}">
                                Approve All
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="exampleModalCenter{{$freelanceJob->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Approve All With Opinion</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form action="{{ route('subscriber.actionChange',['freelanceJob'=>$freelanceJob->id,'subscription' => $subscription->subscription_code]) }}" class="form-group" method="get">

                                        <div class="card">
                                            <div class="card-body">
                                                <input type="hidden" name="freelanceJob" value="{{$freelanceJob->id}}">
                                                <label for="">Opinion</label>
                                                <textarea name="comment" class="form-control" id="" cols="8" rows="2"></textarea>
                                                <br>
                                                <button class="btn btn-success btn-sm">Approve</button>

                                            </div>
                                        </div>

                                      </form>
                                    </div>

                                  </div>
                                </div>
                              </div>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                <th>SL</th>



                                <th >Images</th>
                                <th>Submitted By</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Work Link</th>
                                </tr>
                            </thead>

                            <tbody>


                                <?php $i = 1; ?>

                                    <?php $i = (($works->currentPage() - 1) * $works->perPage() + 1); ?>
                                @foreach($works as $work)

                                <tr>
                                    <td>{{$i}}</td>


                                    <td>
                                        @if ($work->img or $work->img2)


                                        <img height="60" width="60" src="{{asset('storage/work/image/'.$work->img)}}" alt="">
                                        @if ($work->img2)
                                        <img height="60" width="60" src="{{asset('storage/work/image/'.$work->img2)}}" alt="">

                                        @endif
                                        @endif
                                    </td>
                                    <td>{{$work->user ? $work->user->name : ''}}</td>
                                    <td>{{ $work->status }}</td>

                                    <td>
                                        @if ($work->status != 'locked')
                                        <div class="btn-group btn-group-xs w3-hover-shadow">

                                            <a class="btn btn-primary btn-xs" href="{{ route('subscriber.subscriptionSubmittedWorkDetails', [$work, 'subscription' => $subscription->subscription_code]) }}" target="_blank">Details</a>

                                            <a class="btn btn-primary btn-xs btn-success" href="{{route('subscriber.subscriptionSubmittedWorkStatus',[$work,'status'=>'approved','subscription' => $subscription->subscription_code])}}" >Approved</a>
                                            <a class="btn btn-primary btn-xs btn-danger" href="{{route('subscriber.subscriptionSubmittedWorkStatus',[$work,'status'=>'claimed','subscription' => $subscription->subscription_code])}}" >Claim</a>

                                            {{-- <div class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">

                                              </button>
                                              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">



                                                <a href=""><button type="button" class="dropdown-item btn btn-success btn-xs">Approve</button></a>

                                                <a href=""><button type="button" class="dropdown-item btn btn-primary btn-xs">Reject</button></a>

                                              </div>
                                            </div>                             --}}

                                        </div>
                                        @elseif($work->status == 'locked')
                                        <button class="btn btn-warning btn-sm">Locked</button>
                                        @endif
                                    </td>
                                    <td>{{ $work->workDoneLink ? $work->workDoneLink->link : '' }}</td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                        {{$works->render()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
