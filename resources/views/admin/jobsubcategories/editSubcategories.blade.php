@extends('admin.layouts.adminMaster')

@push('css')
<link rel="stylesheet" href="{{asset('cp/plugins/summernote/summernote-bs4.css')}}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />    
@endpush

@section('content')
<br>
<section class="content">
  @include('alerts.alerts')
    <div class="card card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">
                Manage Subcategories
            </h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header with-border">
                                    <h3 class="card-title">
                                        Subcategories Details
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal" method="post" action="{{route('admin.jobsubcategoryUpdatePost',$cat)}}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                                            <label for="name" class="col-sm-12 control-label">Category</label>
                                            <div class="col-sm-12">
                                              <select name="category" class="form-control" id="">
                                                <option value="{{$cat->category_id}}">{{$cat->categoryname->title}}</option>
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                                    
                                                @endforeach
                                              </select>
                                            </div>
                                          </div>
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
                                          
                                          
                                          <div class="form-group {{ $errors->has('job_post_price') ? ' has-error' : '' }}">
                                            <label for="job_post_price" class="col-sm-12 control-label">Job Post Price</label>
                                            <div class="col-sm-12">
                                              <input type="text" name="job_post_price" 
                                              value="{{$cat->job_post_price}}" class="form-control"  id="job_post_price" placeholder="Job Post Price" autocomplete="off">
                                              @if ($errors->has('job_post_price'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('job_post_price') }}</strong>
                                                  </span>
                                              @endif
                                            </div>
                                          </div>

                                          <div class="form-group {{ $errors->has('job_work_price') ? ' has-error' : '' }}">
                                            <label for="job_work_price" class="col-sm-12 control-label">Job Work Price</label>
                                            <div class="col-sm-12">
                                              <input type="text" name="job_work_price" 
                                              value="{{$cat->job_work_price}}" class="form-control"  id="job_work_price" placeholder="Job Work Price" autocomplete="off">
                                              @if ($errors->has('job_work_price'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('job_work_price') }}</strong>
                                                  </span>
                                              @endif
                                            </div>
                                          </div>

                                          <div class="form-group {{ $errors->has('job_work_price') ? ' has-error' : '' }}">
                                            <label for="job_work_price" class="col-sm-12 control-label">How Many Screenshot</label>
                                            <div class="col-sm-12">
                                              
                                              <select name="screenshot" class="form-control">
                                                <option value="{{$cat->screenshot}}">{{$cat->screenshot}}</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                              </select>
                                              
                                            </div>
                                          </div>
                                          
                                          <div class="form-group {{ $errors->has('instraction') ? ' has-error' : '' }}">
                                            <label for="instraction" class="col-sm-12 control-label">Instraction</label>
                                            <div class="col-sm-12">
                                              <textarea type="text" name="instraction" 
                                               class="form-control textarea"  id="instraction" placeholder="Instraction">{!!$cat->instraction!!}</textarea>
                                              @if ($errors->has('instraction'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('instraction') }}</strong>
                                                  </span>
                                              @endif
                                            </div>
                                          </div>

                                           

                                          <div class="form-check mb-2 {{ $errors->has('admin_approve') ? ' has-error' : '' }}">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="admin_approve" id="admin_approve" {{$cat->admin_approve == true ? "checked" : ''}} >
                                              Job Post Admin Approve
                                            </label>
                                          </div>
                                          
                                          <div class="form-check {{ $errors->has('work_link') ? ' has-error' : '' }}">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="work_link" id="work_link" {{$cat->work_link == true ? "checked" : ''}} >
                                              Job-Work Link Mandatory (During work submit)
                                            </label>
                                          </div>

                                          <br>
                                          
                            
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
<script src="{{asset('cp/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
@endpush