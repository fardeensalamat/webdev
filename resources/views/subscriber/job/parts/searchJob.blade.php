<section class="content">
    <br>
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.alerts')
            <div class="card card-primary">
                <div class="card-header">
                    Find A Job
                </div>
                <div class="card-body">                    
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('subscriber.subscriptionJobSearch',['subscription' => $subscription->subscription_code])}}">
                                <div class="row">
                                    
                                    <div class="col-sm-3 m-b-xs">
                                        <div class="input-group mb-3">
                                            <label for="">Category</label>
                                            <div class="input-group">
                                                <select name="category" id="category" class="form-control">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->title}}</option>
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
                                        <label for="">Search</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control form-control" name="q" placeholder="Search category, subcategory">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for=""></label>
                                        <div class="input-group-append mt-2">
                                            <button class="btn btn-sm btn-primary" type="submit">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
        
                            <div class="table-responsive">        
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if ($jobs)
                            @foreach ($jobs as $freelanceJob)
                                {{-- <div class="col-md-12">
                                    <a href="{{route('subscriber.freelanceJobDetails',[ 'freelanceJob'=> $freelanceJob,'subscription' => $subscription->subscription_code])}}">
                                        <div class="info-box bg-default w3-hover w3-white w3-hover-opacity">
                                            <div class="info-box-content">
                                                <h4 class="info-box-text p-0 m-0">{{$freelanceJob->title}}</h4>
                                                <h5 class="info-box-number">BDT {{$freelanceJob->per_worker_cost}} <span style="font-size: 12px;"> <i class="fas fa-clock"></i> Posted : {{$freelanceJob->created_at->diffForHumans()}}</span></h5>
                                
                                                <div class="progress">
                                                <div class="progress-bar bg-success" style="width: 10%"></div>
                                                </div>
                                                <span class="progress-description">
                                                Need More 10 workers out of {{$freelanceJob->total_worker}} 
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div> --}}
                                <div class="col-md-12">
                                    <a href="{{route('subscriber.freelanceJobDetails',[ 'freelanceJob'=> $freelanceJob,'subscription' => $subscription->subscription_code])}}">
                                        <div class="info-box bg-default w3-hover w3-white w3-hover-deep-orange">
                                            <div class="info-box-content">
                                                <h4 class="info-box-text p-0 m-0">{{$freelanceJob->title}} </h4>
                                                <h5 class="info-box-number">BDT {{$freelanceJob->job_work_price}} <span style="font-size: 12px;"> <i class="fas fa-clock"></i> Posted : {{$freelanceJob->created_at->diffForHumans()}}</span></h5>
                                
                                                
                                                <div class="progress">
                                                    <div class="progress-bar bg-success"
                                                    @if ($freelanceJob->worksCountWithoutReject() > 0)
                                                    style="width: {{($freelanceJob->worksCountWithoutReject()/$freelanceJob->total_worker)*100}}%"
                                                    @else 
                                                    style="width: 0%"
                                                    @endif ></div>
                                                </div>
                                                {{-- <span class="progress-description">
                                                @if ($freelanceJob->total_worker > $freelanceJob->worksCountWithoutReject()) 
                                                Need More
                                                {{$freelanceJob->total_worker - $freelanceJob->worksCountWithoutReject()}}  workers out of {{$freelanceJob->total_worker}}
                                                @else
                                                    Completed
                                                @endif
                                                
                                                </span> --}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach 
                        @endif
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>





