<section class="content">



    <div class="row">
        <div class="col-sm-12">
            @include('alerts.alerts')
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
    @include('alerts.alerts')

                    <div class="card card-primary">
                        <div class="card-header">
                            {{ucfirst($status)}} Work
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 offset-3">
                                    <div class="card card-widget">
                                        <div class="card-header">
                                            Opinion
                                        </div>
                                        {{-- [$freelancejobWork,'status'=>$status,'subscription' => $subscription->subscription_code] --}}
                                        <form action="{{route('subscriber.subscriptionSubmittedWorkApprove',[$freelancejobWork,'status'=>$status,'subscription' => $subscription->subscription_code])}}" method="post">
                                            @csrf
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Opinion</label>
                                                    <textarea class="form-control" rows="3" name="comment" placeholder="Enter your comment about rejection (claim)" required></textarea>
                                                </div>
                                                @if ($freelancejobWork->ratting == null)
                                                <div class="form-group">
                                                    <label>Rating (out of 5)</label>
                                                    <input class="form-control" type="number" name="ratting" placeholder="rate this work" value="5">
                                                </div>
                                                @endif
                                            </div>

                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">{{ucfirst($status)}}</button>
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
    </div>
</section>
