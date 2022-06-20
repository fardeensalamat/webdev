@extends('admin.layouts.adminMaster')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />    
@endpush

@section('content')
<br>
<section class="content">
  @include('alerts.alerts')
    <div class="card card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">
                Manage Categories
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
                                        Categories Details
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal" method="post" action="{{route('admin.jobcategoryUpdatePost',$cat)}}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class="col-sm-12 control-label">Name</label>
                                            <div class="col-sm-12">
                                              <input type="text" name="name" 
                                              value="{{$cat->title}}" class="form-control"  id="name" placeholder="name" autocomplete="off">
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
                                              <input type="text" name="description"  class="form-control" id="description" placeholder="Description" 
                                              value="{{$cat->description}}"
                                              autocomplete="off">
                                              @if ($errors->has('description'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('description') }}</strong>
                                                  </span>
                                              @endif
                                            </div>
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
            </div>
        </div>
    </div>
</section>
@endsection


@push('js')

@endpush