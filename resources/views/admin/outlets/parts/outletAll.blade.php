<br>
<section class="content">
    <div class="card card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">
                Outlets 
            </h3>
        </div>
        <div class="card-body">
            @include('alerts.alerts')
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            Add New Outlet Informations
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.outletPost')}}" method="post" class="form-data-submit">
                                @csrf
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3">
                                                <select class=" w-100 form-control div-select load_division" name="load_division" style="width: 140px;border-radius: 4px;" required="">
                                                    <option value="">Division</option>
                                    
                                                    @foreach($divisions as $division)
                                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                    @endforeach
                                    
                                                </select>
                                            </div>
                                            <br>
                                
                                            <div class="col-sm-12 col-md-3">
                                                <select class="form-control  w-100 mt-2 mt-md-0  dist-select load_district"  name="load_district" style="width: 140px;border-radius: 4px;"><option value="">District</option>
                                                </select>
                                            </div>
                                            
                                            <br>
                                            <div class="col-sm-12 col-md-3">
                                                <select class="form-control w-100 mt-2 mt-md-0  thana-select load_thana" name="load_thana" style="width: 140px;border-radius: 4px;">
                                                    <option value="">Thana</option>
                                                </select>
                                            </div>
                                            <br>
                                            <div class="col-sm-12 col-md-3">
                                                @if ($errors->has('zip'))
                                                    <p style="color: red;margin: 0;">{{ $errors->first('zip') }}</p>
                                                @endif
                                                <input type="text" name="zip" class="form-control" placeholder="Zip Code">
                                            </div>
                                            <div class="col-sm-12 col-md-3 mt-3">
                                                @if ($errors->has('name'))
                                                    <p style="color: red;margin: 0;">{{ $errors->first('name') }}</p>
                                                @endif
                                                <input type="text" name="name" class="form-control" placeholder="Outlet Name">
                                            </div>
                                            <div class="col-sm-12 col-md-3 mt-3">
                                                @if ($errors->has('mobile'))
                                                    <p style="color: red;margin: 0;">{{ $errors->first('mobile') }}</p>
                                                @endif
                                                <input type="text" name="mobile" class="form-control" placeholder="Mobile ">
                                            </div>
                                            <div class="col-sm-12 col-md-3 mt-3">
                                                @if ($errors->has('address'))
                                                    <p style="color: red;margin: 0;">{{ $errors->first('address') }}</p>
                                                @endif
                                                <input type="text" name="address" class="form-control" placeholder="Address ">
                                            </div>
                                            <div class="col-sm-12 col-md-3 mt-3">
                                                @if ($errors->has('code'))
                                                    <p style="color: red;margin: 0;">{{ $errors->first('code') }}</p>
                                                @endif
                                                <input type="text" name="code" class="form-control" placeholder="Code ">
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        All Brands
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @foreach($brands->chunk(4) as $brand2)
                                                              @foreach($brand2 as $brand)
                                                              <div class="col-sm-2">
                                              
                                                                  <div class="checkbox">
                                                                      <label><input type="checkbox" name="brands[]" value="{{$brand->id}}">
                                                                          {{$brand->title}}</label>
                                                                  </div>
                                                              </div>
                                                              @endforeach
                                                              @endforeach
                                              
                                                          </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 mt-3">
                                                <button class=" mt-2 mt-md-0 form-control btn btn-success btn-sm" type="submit">Create</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            All Outlets
                        </div>
                        <div class="card-body">

                            <div class="table-responsive data-ajax-container">
                                @include('admin.outlets.includes.outletsList')
                             </div>
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>