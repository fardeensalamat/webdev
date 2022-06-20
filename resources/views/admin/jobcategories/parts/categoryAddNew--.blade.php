    {{-- <section class="content-header">
      <h1>
        New Category
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-plus"></i> New Category</a></li>
        <li class="active">create</li>
      </ol>
    </section> --}}
      <br>
     <section class="content">

     <div class="card card-primary">
     	<div class="card-header with-border">
     		<h3 class="card-title">
     			New Category 
     		</h3>
     	</div>
     	
              <div class="card-body">
              <div class="row">
              	<div class="col-md-5">
                <form class="form-horizontal" method="post" action="{{route('admin.categoryAddNewPost')}}" enctype="multipart/form-data">

								@include('alerts.alerts')

              	{{csrf_field()}}

              	



                
                <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                  <label for="category" class="col-sm-3 control-label">Category</label>
                  <div class="col-sm-9">
                    <input type="text" name="category" class="form-control" value="{{old('category')}}" id="category" placeholder="Category" autocomplete="off">
                    @if ($errors->has('category'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('category') }}</strong>
	                    </span>
	                @endif
                  </div>
                </div>

                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                  <label for="description" class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <input type="text" name="description" class="form-control" value="{{old('description')}}" id="description" placeholder="Description" autocomplete="off">
                    @if ($errors->has('description'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('description') }}</strong>
	                    </span>
	                @endif
                  </div>
                </div>
                
                
                <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Catagory Image</label>
                    <div class="col-sm-9">
                    @if ($errors->has('image'))
                      <p style="color: red;margin: 0;">{{ $errors->first('image') }}</p>
                    @endif
                    <input type="file" name="image" class="form-control" >
                  </div>
                </div>
                <div class="form-group {{ $errors->has('banner') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Catagory Banner</label>
                  <div class="col-sm-9">
                    @if ($errors->has('banner'))
                    <p style="color: red;margin: 0;">{{ $errors->first('banner') }}</p>
                  @endif
                  <input type="file" name="banner" class="form-control" >
                  </div>
                </div>
                {{-- <div class="row">
                      <div class="form-group col-lg-6">
                          <label>Catagory Status</label>
                        <div class="i-checks"><label style="cursor: pointer;"> <input name="active"  type="checkbox" > <i></i> Active</label></div>
                      </div>
                      <div class="form-group col-lg-6">
                          <label>Catagory Fetured</label>
                        <div class="i-checks"><label style="cursor: pointer;"> <input name="featured"  type="checkbox" > <i></i> Active</label></div>
                      </div>
                </div> --}}
                <div class="form-group col-lg-9">
                  <label>Catagory Fetured</label>
                <div class="i-checks"><label style="cursor: pointer;"> <input name="featured"  type="checkbox" > <i></i> Active</label></div>
              </div>

                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">
                    <button type="reset" class="btn btn-default">Cancel</button>

                	<button type="submit" class="btn btn-primary pull-right">Create</button>

                  </div>
                </div> 

                
                </form> 		
              	</div>
              	{{-- <div class="col-md-5">

                </div> --}}

                <div class="col-lg-7">
                  <div class="ibox ">
                  <div class="ibox-title">
                      <h5>Categories All</h5>
                  </div>
                  <div class="ibox-content">
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
          
                              <div class="table-responsive ajax-data-container">
                             @include('admin.categories.includes.categoryAll')
          
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

