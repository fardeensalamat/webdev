<div class="row">
    @include('alerts.alerts')
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header with-border">
                <h3 class="card-title">
                    Categories Details
                </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal form-data-submit" method="post" action="{{route('admin.categoryUpdatePost',$cat)}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                          <input type="text" name="name" value="{{$cat->name}}" class="form-control" value="{{old('name')}}" id="name" placeholder="name" autocomplete="off">
                          @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
        
                      <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                          <input type="text" name="description" value="{{$cat->description}}" class="form-control" value="{{old('description')}}" id="description" placeholder="Description" autocomplete="off">
                          @if ($errors->has('description'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('description') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>                      
                      
                      <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Catagory Image</label>
                          
                        <div class="row">
                          <div class="col-sm-6">
                            @if ($errors->has('image'))
                              <p style="color: red;margin: 0;">{{ $errors->first('image') }}</p>
                            @endif
                            <input type="file" name="image" class="form-control" >
                          </div>
                          @if ($cat->img_name)
                          <div class="col-sm-3">
                            <img src="{{ route('imagecache', [ 'template'=>'pfimd','filename' => $cat->img_name ]) }}" alt="{{$cat->title}}" width="40px;">
                          </div>
                          @endif
                          
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('banner') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Catagory Banner</label>
                        <div class="row">
                          <div class="col-sm-6">
                            @if ($errors->has('banner'))
                            <p style="color: red;margin: 0;">{{ $errors->first('banner') }}</p>
                          @endif
                          <input type="file" name="banner" class="form-control" >
                          </div>
                          @if ($cat->banner_name)
                          <div class="col-sm-3">
                            <img src="{{ route('imagecache', [ 'template'=>'pfimd','filename' => $cat->banner_name ]) }}" alt="{{$cat->title}}" width="40px;">
                          </div> 
                          @endif
                          
                        </div>
                      </div>
                      
                      <div class="form-group col-lg-9">
                        <label>Catagory Active</label>
                      <div class="i-checks"><label style="cursor: pointer;"> <input name="active"  type="checkbox" {{$cat->active == 1 ? "checked" : "" }}> <i></i> Active</label></div>
                    </div>

                    <div class="form-group col-lg-9">
                      <label>Catagory Fetured</label>
                    <div class="i-checks"><label style="cursor: pointer;"> <input name="featured"   type="checkbox" {{$cat->featured == 1 ? "checked" : "" }}> <i></i> Featured</label></div>
                  </div>
        
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                          <button type="reset" class="btn btn-default">Cancel</button>
        
                          <button type="submit" class="btn btn-primary pull-right">Update</button>
        
                        </div>
                      </div> 
                </form>
            </div>
        </div>
    </div>
</div>