<form class="form-inline"  method="post" action="{{ route('admin.pageEditPost', $page) }}">
  
  @csrf
  

  <div class="form-group{{ $errors->has('page_title') ? ' has-error' : '' }}">
    <label for="page_title">Page Title:</label>
    <input type="text" class="form-control" placeholder="Page Title" id="page_title" name="page_title" value="{{ old('page_title') ?: $page->page_title }}">
  </div>

  <div class="form-group{{ $errors->has('route_name') ? ' has-error' : '' }}">
    <label for="route_name">Route Name:</label>
    <input type="text" placeholder="Route Name" class="form-control" id="route_name" name="route_name" value="{{ old('route_name') ?: $page->route_name }}">
  </div>


  <div class="checkbox">
    <label><input type="checkbox" name="title_hide" {{$page->title_hide ? 'checked' : ''}}> Title Hide </label>
  </div>

  <div class="checkbox">
    <label><input type="checkbox" {{$page->active ? 'checked' : ''}} name="active"> Active</label>
  </div>

  <div class="checkbox">
    <label><input type="checkbox" {{$page->list_in_menu ? 'checked' : ''}} name="list_in_menu"> List In Menu</label>
  </div>

  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card card-widget">
        <div class="card-header with-border">
            <h5 class="card-title">Update Menu</h5>
        </div>
        <div class="card-body " style="padding-top: 0 !important;">
            <div class="form-group ">
                <label for="extra_file" class="control-label"></label>
    
                
                <div class="row">
                  @foreach($menus->chunk(4) as $menu2)
                    @foreach($menu2 as $menu)
                    <div class="col-sm-3">
    
                        <div class="checkbox">
                            <label><input type="checkbox" name="menus[]" value="{{$menu->id}}"
                                    {{$menu->hasPage($page) ? 'checked' : ''}}> {{$menu->menu_title}}</label>
                        </div>
    
                    </div>
    
                    @endforeach
    
                    @endforeach
                </div>
                
    
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
  <button type="submit" class="btn btn-primary">Submit</button>

    </div>
  </div>

</form>