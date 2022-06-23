<form class="form-inline" method="post" action="{{route('admin.mediaUploadPost')}}" enctype="multipart/form-data"> {{csrf_field()}}

  <div class="row">  
    
    
                  <div class="col-md-3">
                    <div class="form-group mb-3">
                        <select name="workstation" id="workstation"
                            class="form-control select2"
                            data-url={{ route('user.searchCategoryAjax') }}>
                            <option value="">Select Workstation</option>
                            @foreach ($allWorkStation as $wt)
                                <option value="{{ $wt->id }}">
                                    {{ $wt->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <select name="category" id="category" class="form-control">
                            <option value="">Select Workstation</option>

                        </select>
                    </div>
                </div>
                
                  <div class="col-md-4">
                  <div class="form-group {{ $errors->has('files') ? ' has-error' : '' }}">
                    <label for="files">Upload One or Multiple Image:</label>
                    <input type="file" name="files[]" value="{{old('files')}}" placeholder="File" class="form-control" id="files" style="padding-bottom: 32px;" multiple>
                    @if ($errors->has('files'))
                    <span class="help-block">
                      <strong>{{ $errors->first('files') }}</strong>
                    </span>
                    @endif
                  </div>
  
                  </div>
                  <div class="col-md-1">
                  <label for="files" style="color: white;">.</label>
                   <div class="form-group">
                   <button type="submit" class="w3-btn w3-blue w3-round w3-border w3-border-white">Submit</button>
  
                   </div>
  
                  </div>
                                                  
      </div>
                
                              
        {{--     
            
            <div class="row">
             <div class="col-12">
             <div class="form-group {{ $errors->has('files') ? ' has-error' : '' }}">
                    <label for="files">Upload One or Multiple Image:</label>
                    <input type="file" name="files[]" value="{{old('files')}}" placeholder="File" class="form-control" id="files" style="padding-bottom: 32px;" multiple>
                    @if ($errors->has('files'))
                    <span class="help-block">
                      <strong>{{ $errors->first('files') }}</strong>
                    </span>
                    @endif
                  </div>
             </div>
            </div>
  
        
      <div class="row">
        <div class="col-12">
        <button type="submit" class="w3-btn w3-blue w3-round w3-border w3-border-white">Submit</button>
  
        </div>
      </div>
      --}}
      </form>