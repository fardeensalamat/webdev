    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
        <h1>
          Menu
          <small>Add New</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Add New</a></li>
          <li class="active">Menu</li>
        </ol>
      </section> --}}
      <br> 
      <!-- Main content -->
      <section class="content" style="min-height: 700px;">
  
  
  
  
  <!-- Info cardes -->
        <div class="row">
          <div class="col-sm-12">
  
              @include('alerts.alerts')
              
  
              <div class="card card-primary">
              <div class="card-header with-border">
                <h3 class="card-title"><i class="fa fa-edit"></i> Add New Menu</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{route('admin.newMenuPost')}}">
              {{csrf_field()}}
                <div class="card-body">
  
  
                  <div class="form-group{{ $errors->has('menu_title') ? ' has-error' : '' }}">
                    <label for="menu_title" class="col-sm-2 control-label">Menu Title</label>
  
                    <div class="col-sm-10">
                      <input type="text" name="menu_title" class="form-control" value="{{ old('menu_title') }}" id="menu_title" placeholder="Menu Title" required autofocus>
  
                      @if ($errors->has('menu_title'))
                          <span class="help-block">
                              <strong>{{ $errors->first('menu_title') }}</strong>
                          </span>
                      @endif
  
                    </div>
                  </div>
  
   
  
                  <div class="form-group{{ $errors->has('menu_type') ? ' has-error' : '' }}">
                    <label for="menu_type" class="col-sm-2 control-label">Menu Type</label>
  
                    <div class="col-sm-10">
                      <select name="menu_type" id="menu_type" class="form-control">
  
                        <option>Full </option>
                        <option>Tab</option>
                      </select>
  
                      @if ($errors->has('menu_type'))
                          <span class="help-block">
                              <strong>{{ $errors->first('menu_type') }}</strong>
                          </span>
                      @endif
  
                    </div>
                  </div>
  
   
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
  
                      <button type="reset" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-primary pull-right">Submit</button>
                      
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
  
  
          </div>
        </div>
        <!-- /.row -->
  
     
  
         
        
  
      </section>
      <!-- /.content -->