<br>
<section class="content">
  @include('alerts.alerts')
    <div class="card card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">
                Manage Product Subcategories
            </h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header with-border">
                                    <h3 class="card-title">
                                        Subcategories Details
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal" method="post" action="{{route('admin.addsubcategoryPost')}}" enctype="multipart/form-data">
                                        {{csrf_field()}}

                                        <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                                          <label for="name" class="col-sm-12 control-label">Select Category</label>
                                          <div class="col-sm-12">
                                            <select name="category" class="form-control" id="">
                                              <option value="">Select Category</option>
                                              @foreach ($categories as $category)
                                              <option value="{{$category->id}}">{{$category->name}}</option>
                                                  
                                              @endforeach
                                            </select>
                                          </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class="col-sm-12 control-label">Name</label>
                                            <div class="col-sm-12">
                                              <input type="text" name="name"  class="form-control"  id="name" placeholder="name" autocomplete="off">
                                              @if ($errors->has('name'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('name') }}</strong>
                                                  </span>
                                              @endif
                                            </div>
                                          </div>
                            
                                          <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                            <label for="description" class="col-sm-12 control-label">Description</label>
                                            <div class="col-sm-12">
                                              <input type="text" name="description"  class="form-control" value="{{old('description')}}" id="description" placeholder="Description" autocomplete="off">
                                              @if ($errors->has('description'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('description') }}</strong>
                                                  </span>
                                              @endif
                                            </div>
                                          </div>                      
                                          
                                          <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                            <label class="col-sm-12 control-label">Catagory Image</label>
                                              
                                            <div class="row">
                                              <div class="col-sm-12">
                                                @if ($errors->has('image'))
                                                  <p style="color: red;margin: 0;">{{ $errors->first('image') }}</p>
                                                @endif
                                                <input type="file" name="image" class="form-control" >
                                              </div>
                                              {{-- @if ($cat->img_name)
                                              <div class="col-sm-3">
                                                <img src="{{ route('imagecache', [ 'template'=>'pfimd','filename' => $cat->img_name ]) }}" alt="{{$cat->title}}" width="40px;">
                                              </div>
                                              @endif --}}
                                              
                                            </div>
                                          </div>
                                          <div class="form-group {{ $errors->has('banner') ? ' has-error' : '' }}">
                                            <label class="col-sm-12 control-label">Catagory Banner</label>
                                            <div class="row">
                                              <div class="col-sm-12">
                                                @if ($errors->has('banner'))
                                                <p style="color: red;margin: 0;">{{ $errors->first('banner') }}</p>
                                              @endif
                                              <input type="file" name="banner" class="form-control" >
                                              </div>
                                              {{-- @if ($cat->banner_name)
                                              <div class="col-sm-3">
                                                <img src="{{ route('imagecache', [ 'template'=>'pfimd','filename' => $cat->banner_name ]) }}" alt="{{$cat->title}}" width="40px;">
                                              </div> 
                                              @endif --}}
                                              
                                            </div>
                                          </div>
                                          
                                          <div class="form-group col-lg-12">
                                            <label>Catagory Active</label>
                                          <div class="i-checks"><label style="cursor: pointer;"> <input name="active"  type="checkbox" > <i></i> Active</label></div>
                                          
                                        </div>
                    
                                        <div class="form-group col-lg-12">
                                          <label>Catagory Fetured</label>
                                        <div class="i-checks"><label style="cursor: pointer;"> <input name="featured"   type="checkbox" > <i></i> Featured</label></div>
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

                    
                </div>

                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5>Subcategories All</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-sm-5 m-b-xs">
                                             <form class="action-form" action="">
                                            <div class="input-group mb-3">
                                            <select class="form-control" name="action">
                                                <option value="">Select Option</option>
                                                <option value="active">Status Active</option>
                                                <option value="inactive">Status Inactive</option>
                                                <option value="featured">Status Featured</option>
                                                <option value="unfeatured">Status Un-featured</option>
                                                <option value="delete">Delete</option>
                                            </select>
                                            <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary filter-btn" type="submit">Action</button>
                                                </div>
                                            </div>
                                        </form>
                                            <label>
                                            <input class="checkbox" type="checkbox" name="checkall" id="checkall" style="display: inline-block;"> All Select
                
                                            <span class="succ badge badge-success" style="display:none;">Success</span>
                
                                            </label>
                                            <a href="" class="btn btn-success btn-sm"> Rearrange Category</a>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="input-group mb-3">
                                                <input data-url="" type="text" class="form-control form-control-sm ajax-data-search" placeholder="Search by Category Id, title">
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary" type="button">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="table-responsive">
                                   @include('admin.subcategories.subcategoriesAll')
                
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