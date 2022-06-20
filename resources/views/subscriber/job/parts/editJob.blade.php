<section class="content">
    <br>
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.alerts')
            <div class="card card-primary">
                <div class="card-header">
                   Edit Posted Job
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">{{ __('Edit Job') }} ({{ $subscription->work_station_id }})</div>
                    
                                    <div class="card-body">
                                        <form method="post" action="{{route('subscriber.subscriptionUpdateJobpost',[$freelanceJob,'subscription'=> $subscription->id,'worksation' => $subscription->work_station_id])}} " enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Job category') }}</label>
                    
                                                <div class="col-md-6">


                                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{$freelanceJob->category->title}}" autocomplete="title" readonly autofocus>
                                                    
                                                    {{-- <select name="category" class="form-control" id="category">
                                                        <option value="{{$freelanceJob->category_id}}">{{$freelanceJob->category->title}}</option>

                                                        @foreach ($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                                        @endforeach
                                                    </select> --}}
                    
                                                    @error('category')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="subcategory" class="col-md-4 col-form-label text-md-right">{{ __('Job subcategory') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{$freelanceJob->subcategory->title}}"  readonly>
                                                    {{-- <select name="subcategory" class="form-control" id="subcategory">
                                                        <option value="{{$freelanceJob->subcategory_id}}" id="p">{{$freelanceJob->subcategory->title}}</option>

                                                        
                                                    </select> --}}
                    
                                                    @error('subcategory')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                    
                    
                                            <div class="form-group row">
                                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Job Title') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Title(exmp: Video Edit)" value="{{$freelanceJob->title}}"  required autocomplete="title" autofocus>
                    
                                                    @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                    
                                            
                                            <div class="form-group row">
                                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                    
                                                <div class="col-md-6">
                                                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" placeholder="Description(exmp: Video editing job)" >{!!$freelanceJob->description!!}</textarea>
                    
                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="Link" class="col-md-4 col-form-label text-md-right">{{ __('Link (if available)') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input id="link" type="text" class="form-control @error('Link') is-invalid @enderror" name="link" value="{{$freelanceJob->link}}" placeholder="Link (exmp: https://www.youtube.com/) " >
                    
                                                    @error('Link')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="img" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image"  autocomplete="image" >
                    
                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="form-group row">
                                                <label for="total_worker" class="col-md-4 col-form-label text-md-right">Total Worker's Need</label>
                    
                                                <div class="col-md-6">
                                                    <input id="total_worker" type="number"  class="form-control @error('total_worker') is-invalid @enderror" name="total_worker" 
                                                    min="{{ $freelanceJob->total_worker }}" 
                                                    placeholder="Minimum One worker required" value="{{$freelanceJob->total_worker}}"  autocomplete="total_worker" autofocus>
                    
                                                    @error('total_worker')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>


                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="total_worker" class="col-md-4 col-form-label text-md-right">Cost Per Worker</label>
                    
                                                <div class="col-md-6">
                                                    <input id="cost_per_worker" type="text" class="form-control @error('cost_per_worker') is-invalid @enderror" name="cost_per_worker" placeholder="Cost Per Worker" value="{{$freelanceJob->job_post_price}}" readonly autocomplete="cost_per_worker" autofocus>
                    
                                                    @error('cost_per_worker')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                
                                            </div>

                                            <div class="form-group row">
                                                <label for="total_worker" class="col-md-4 col-form-label text-md-right">Estimated Day To End</label>
                    
                                                <div class="col-md-6">
                                                    <input  id="estimate_day" type="date" class="form-control @error('estimate_day') is-invalid @enderror" name="estimate_day" value="{{$freelanceJob->expired_day ?$freelanceJob->expired_day->format('Y-m-d') : '' }}"  required autocomplete="estimate_day" autofocus>
                    
                                                    @error('estimate_day')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="total_worker" class="col-md-4 col-form-label text-md-right">Estimated Cost</label>
                    
                                                <div class="col-md-6">
                                                    <input id="total_cost" type="text" class="form-control @error('estimate_cost') is-invalid @enderror" value="{{$freelanceJob->total_job_post_cost}}" name="estimate_cost"  autocomplete="estimate_cost" autofocus readonly value="BDT 10">
                    
                                                    @error('estimate_cost')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                    
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Update') }}
                                                    </button>
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
    </div>
    
</section>





