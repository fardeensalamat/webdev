<section class="content">
    <br>
    <div class="row">
      
        <div class="col-sm-12">
          @include('alerts.alerts')
  
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">
                    Add New Honorarium 
                </h3>
                </div>
    
                <div class="card-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">{{ __('Information') }}</div>
                    
                                    <div class="card-body">
                                        <form method="POST" action="{{route('admin.honorariumUpdate',$honorarium)}}">
                                            @csrf
                    
                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="title"
                                                value="{{$honorarium->title}}">
                                                 
                                              </div>
                                            </div>
                    
                                            <div class="form-group row">
                                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                    
                                                <div class="col-md-6">
                                                    <textarea class="form-control"
                                                    name="description" type="text">{{$honorarium->description}}</textarea>
                    
                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                    
                    
                                            <div class="form-group row">
                                                <label for="workstaion" class="col-md-4 col-form-label text-md-right">{{ __('Work Station') }}</label>
                    
                                                <div class="col-md-6">
                                                    <select name="workstaion" id="" class="form-control">
                                                        <option value="{{$honorarium->workstation ?$honorarium->workstation->id : ''}}">{{ $honorarium->workstation ?$honorarium->workstation->title : ''}}</option>
                                                        @foreach ($workstations as $workstation)
                                                            <option value="{{$workstation->id}}">{{$workstation->title}}</option>
                                                        @endforeach
                                                    </select>
                    
                                                    @error('workstaion')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="form-group row">
                                                <label for="subscription_code" class="col-md-4 col-form-label text-md-right">{{ __('System Type') }}</label>
                                                <div class="col-sm-6 col-md-6">
                                                    <select name="system_type" id="typeOfGlass" class="form-control select">
                                                        @if ($honorarium->system_type == "Joining")
                                                        <option selected value="{{$honorarium->system_type}}">Rent / Rented
                                                        </option>
                                                        @else 
                                                        <option selected value="{{$honorarium->system_type}}">Beneficiary
                                                        </option>
                                                        @endif
                                                        
                                                        <option value="Joining">Rent / Rented
                                                        </option> 
                                                        <option value="Working">Beneficiary</option> 
                                                    </select>                                      
                                                        
                                                    </select>
                                                </div>
                                            </div>

                                            
                                            <div class="form-group row">
                                                <label for="earning_type" class="col-md-4 col-form-label text-md-right">{{ __('Earning Type') }} <br><small> ({{$honorarium->earning_type}} selected)</small></label>

                    
                                                <div class="col-md-6">
                                                    
                                                    <select name="earning_type" id="glassWidth" class="form-control">
                                                        <option value="{{$honorarium->earning_type}}">{{$honorarium->earning_type}}</option>
                                                        
                                                    </select>
                    
                                                    @error('earning_type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row hideme">
                                                <label for="workorder_upto_amount" class="col-md-4 col-form-label text-md-right">{{ __('Work Order Upto Amount') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="workorder_upto_amount" placeholder = "Work Order Amount Upto" value="{{$honorarium->workorder_upto_amount}}">
                                                    
                                                    @error('workorder_upto_amount')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                    
                    
                                            <div class="form-group row">
                                                <label for="work_station_id" class="col-md-4 col-form-label text-md-right">{{ __('Benifit (%)') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="commission" value="{{$honorarium->commission}}">
                    
                                                    @error('commission')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="work_station_id" class="col-md-4 col-form-label text-md-right">{{ __('Payment Duration') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="payment_duration" value="{{$honorarium->payment_duration}}" placeholder="Example: 10 days">
                    
                                                    @error('payment_duration')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="active" class="col-md-4 col-form-label text-md-right">{{ __('Active') }}</label>
                                                <div class="col-md-6">
                                                    <input id="active" type="checkbox" class=" mt-2 @error('active') is-invalid @enderror" name="active"
                                                    
                                                    {{$honorarium->active==1 ? 'checked': ''}}
                                                    >
                    
                                                    @error('active')
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