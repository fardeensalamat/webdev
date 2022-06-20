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
                                    <div class="card-header">{{ __(' Information') }}</div>
                    
                                    <div class="card-body">
                                        <form method="POST" action="{{route('admin.addHonorariumPost')}}">
                                            @csrf
                    
                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="title"
                                                value="{{old('title')}}">
                                                 
                                              </div>
                                            </div>
                    
                                            <div class="form-group row">
                                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                    
                                                <div class="col-md-6">
                                                    <textarea class="form-control"
                                                    name="description" value="{{old('description')}}" type="text"></textarea>
                    
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
                                                        <option value="">Select workstation</option>
                                                        @foreach ($workstations as $workstation)
                                                            @if(isset($station))
                                                            <option value="{{$workstation->id}}" {{$station == $workstation->id ? 'selected' : ''}} >{{$workstation->title}}</option>
                                                            @else
                                                            <option value="{{$workstation->id}}">{{$workstation->title}}</option>
                                                            @endif
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
                                                    <select name="system_type" id="typeOfGlass" class="form-control">
                                                      <option value="">Select Type</option>
                                                      <option value="Joining">Rent/Rented</option> 
                                                      <option value="Working">Beneficiary</option> 
                                                      <option value="Transfer">Wallet</option>
                                                    </select>                                      
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="earning_type" class="col-md-4 col-form-label text-md-right">{{ __('Earning Type') }}</label>
                    
                                                <div class="col-md-6">
                                                    <select name="earning_type" id="glassWidth" class="form-control">
                                                        <option value="">Select type</option>
                                                        
                                                    </select>
                    
                                                    @error('earning_type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- work order --}}
                                            <div class="form-group row hideme">
                                                <label for="workorder_upto_amount" class="col-md-4 col-form-label text-md-right">{{ __('Work Order Upto Amount') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="workorder_upto_amount" placeholder = "Work Order Amount Upto" value="{{old('workorder_upto_amount')}}">
                                                    
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
                                                    <input type="text" class="form-control" name="commission" value="{{old('commission')}}">
                    
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
                                                    <input type="text" class="form-control" name="payment_duration" value="{{old('payment_duration')}}" placeholder="Example: 10 days">
                    
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
                                                    <input id="active" type="checkbox" checked class=" mt-2 @error('active') is-invalid @enderror" name="active"
                                                    
                                                    {{-- {{$workstation->active==1 ? 'checked': ''}} --}}
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