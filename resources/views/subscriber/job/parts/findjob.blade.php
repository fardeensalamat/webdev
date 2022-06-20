<section class="content">
    <br>
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.alerts')
            <div class="card card-primary">
                <div class="card-header">
                    Find Work
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form
                                action="{{ route('subscriber.subscriptionJobSearch', ['subscription' => $subscription->subscription_code]) }}">
                                <div class="row">

                                    <div class="col-sm-3 m-b-xs">
                                        <div class="input-group mb-3">
                                            <label for="">Category</label>
                                            <div class="input-group">
                                                <select name="category" id="category" class="form-control">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group mb-3">
                                            <label for="">Subcategoy</label>
                                            <div class="input-group ">
                                                <select name="subcategory" class="form-control" id="subcategory">
                                                    <option value="">Select subcategory</option>

                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">

                                            <label for="">Search</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control form-control" name="q"
                                                    placeholder="Search category, subcategory">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">

                                            <label class="" for=""></label>
                                            <div class="input-group-append mt-2">
                                                <button class="btn btn-sm btn-primary" type="submit">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($jobs as $freelanceJob)
                                {{-- @php
                                $totalSubmittedJob = App\Models\FreelanceJobWork::where('work_station_id',$freelanceJob->work_station_id)->where('freelancer_job_id',$freelanceJob->id)->count();
                            @endphp --}}

                                {{-- @if ($freelanceJob->worksCountWithoutReject() < $freelanceJob->total_worker) --}}

                                <a
                                    href="{{ route('subscriber.freelanceJobDetails', ['freelanceJob' => $freelanceJob, 'subscription' => $subscription->subscription_code]) }}">
                                    <div class="w3-card">

                                        <div class="info-box bg-default w3-hover w3-white w3-hover-deep-orange">
                                            <div class="info-box-content">
                                                <span
                                                    class="info-box-text- p-0 m-0">{{ Str::limit($freelanceJob->title, 100) }}
                                                </span>
                                                <span class="info-box-number">BDT {{ $freelanceJob->job_work_price }}
                                                    {{-- <span style="font-size: 12px;"> <i class="fas fa-clock"></i> Posted
                                                        : {{ $freelanceJob->created_at->diffForHumans() }}</span>
                                                    @if (Auth::user()->isAdmin())
                                                        <span style="font-size: 12px;">ID:
                                                            {{ $freelanceJob->id }}</span>
                                                    @endif

                                                </span> --}}


                                                <div class="progress">
                                                    <div class="progress-bar bg-success" @if ($freelanceJob->worksCountWithoutReject() > 0) style="width: {{ ($freelanceJob->worksCountWithoutReject() / $freelanceJob->total_worker) * 100 }}%"
                                                @else
                                                    style="width: 0%" @endif></div>
                                                </div>
                                                <span class="progress-description">
                                                    @if ($freelanceJob->total_worker > $freelanceJob->worksCountWithoutReject())
                                                        {{-- Need More
                                                        {{ $freelanceJob->total_worker - $freelanceJob->worksCountWithoutReject() }}
                                                        workers out of {{ $freelanceJob->total_worker }} --}}

                                                        Available work


                                                    @else
                                                        Completed
                                                    @endif

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                {{-- @endif --}}
                            @endforeach
                            {{ $jobs->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
