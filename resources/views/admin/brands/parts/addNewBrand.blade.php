<br>
<section class="content">
    <div class="card card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">
                Manage Product Brands 
            </h3>
        </div>
        <div class="card-body">
            @include('alerts.alerts')
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header with-border">
                            New Brand Add
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.brandPost')}}" method="post" enctype="multipart/form-data">
                                @csrf
                              
                                <div class="form-group">
                                  <label>Brand Name*</label>
                                  @if ($errors->has('title'))
                                    <p style="color: red;margin: 0;">{{ $errors->first('title') }}</p>
                                  @endif
                                  <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="Enter Brand Name">
                                </div>
      
                                <div class="form-group">
                                  <label>Brand Meta Title (Optinal)</label>
                                  @if ($errors->has('slug'))
                                    <p style="color: red;margin: 0;">{{ $errors->first('slug') }}</p>
                                  @endif
                                  <input type="text" name="meta_title" value="{{old('meta_title')}}" class="form-control" placeholder="Enter  Brand Meta Title">
                                </div>
      
                                <div class="form-group">
                                  <label>Brand Description (Optional)</label>
                                  @if ($errors->has('description'))
                                    <p style="color: red;margin: 0;">{{ $errors->first('description') }}</p>
                                  @endif
                                  <textarea name="description" rows="3" class="form-control" placeholder="Write Description">{!!old('description')!!}</textarea>
                                </div>
      
                              
                              <div class="form-group">
                                  <label>Brand Image</label>
                                  @if ($errors->has('image'))
                                    <p style="color: red;margin: 0;">{{ $errors->first('image') }}</p>
                                  @endif
                                  <input type="file" name="image" class="form-control" >
                                </div>
      
                              <div class="row">
                                      <div class="form-group col-lg-6">
                                          <label>Brand Status</label>
                                        <div class="i-checks"><label style="cursor: pointer;"> <input name="active"  type="checkbox" > <i></i> Active</label></div>
                                      </div>
                                      <div class="form-group col-lg-6">
                                          <label>Brand Fetured</label>
                                        <div class="i-checks"><label style="cursor: pointer;"> <input name="featured"  type="checkbox" > <i></i> Active</label></div>
                                      </div>
                                </div>
                              <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                              </div>
                              </form>
                        </div>
                    </div>
                </div> 
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            ALL BRANDS
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
                                            <label style="cursor: pointer;">
                                            <input class="checkbox" type="checkbox" name="checkall" id="checkall" style="display: inline-block;"> All Select
                
                                            <span class="succ badge badge-success" style="display:none;">Success</span>
                
                                            </label>
                                            <a href="{{route('admin.brandRearrange')}}" class="btn btn-success btn-sm">Brand Rearrange</a>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="input-group mb-3">
                                                <input data-url="" type="text" class="form-control form-control-sm ajax-data-search" placeholder="Search by Brand Id, title">
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary" type="button">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="table-responsive">
                                   @include('admin.brands.includes.brandAll')
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