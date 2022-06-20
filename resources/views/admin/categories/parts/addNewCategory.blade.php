<br>

<section class="content">
  <div class="row">
      <div class="col-md-12">
        @include('alerts.alerts')
        <div class="card card-primary">
            <div class="card-header with-border">
                <h3 class="card-title">
                    <i class="fa fa-plus"></i>
                    Add Category of WorkStation <span class="badge badge-default"> ID: {{$workstation->id}},
                        {{$workstation->title}}</span>
                </h3>
            </div>
            <div class="card-body">
                <div class="card card-widget mb-0">
                    <div class="card-body w3-gray p-2">
                        <div class="card card-widget mb-0">
                            <div class="card-body">

                                <form action="{{route('admin.addNewCategoryPost',$workstation)}}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                      <div class="col-md-3">
                                          <b>Category Name</b>
                                          <input type="text" name="name" value="{{old('name')}}"
                                              class="form-control" placeholder="Category name">
                                      </div>
                                      <div class="col-md-4">
                                          <b>Description</b>
                                          <textarea rows="1" placeholder="Description" class="form-control"
                                              name="description">{{old('description')}}</textarea>
                                      </div>
                                      <div class="col-md-3">
                                          <b>Category Image</b>
                                          <input type="file" name="image" class="form-control">
                                      </div>
                                      <div class="col-md-3">
                                        <b>Banner Image</b>
                                        <input type="file" name="banner" class="form-control">
                                      </div>

                                      <div class="checkbox">
                                        <label for="">Active</label>
                                            <input type="checkbox" name="active" class="form-control" style="height: 32px; width:15px;">
                                        
                                      </div>

                                      <div class="checkbox ml-3">
                                        <label for="">Featured</label>
                                            <input type="checkbox" name="featured" class="form-control" style="height: 32px; width:15px;">
                                        
                                      </div>
                                      

                                        <div class="col-md-2">
                                            <b>&nbsp;</b>
                                            <button style="margin-top: 20px;" type="submit"
                                                class="btn  btn-primary ">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="card card-widget">
          <div class="card-header with-border">
              <h3 class="card-title">
                  <i class="fa fa-th"></i>
                  All Categories of workstation <span class="badge badge-default">{{ $workstation->title}}</span></h3>
          </div>
          @if($categories->count() > 0)
          <div class="card-body w3-gray p-1">


              @foreach($categories as $category)
              <div class="card card-widget form-outer-area  collapsed-card mb-3">
                  <div class="card-header">
                      <h3 class="card-title">
                          <b>{{$loop->iteration}}. Category Title</b>: {{$category->name}}
                          <small><b>Business Profile: {{ $category->sp_active == 1 ? 'Active' : 'Inactive' }}</b></small>
                          <small><b>Personal Profile: {{ $category->pp_active == 1 ? 'Active' : 'Inactive' }}</b></small>

                          
                      </h3>
                      
                      <div class="card-tools">
                        
                        {{-- <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#exampleModal1" onclick="subscribeId('{{route('admin.categoryUpdatePost',$category->id)}}')"><i class="fas fa-edit"></i></button> --}}
                        <a href="{{route('admin.categoryEdit',$category)}}" class="btn btn-tool"><i class="fas fa-edit"></i></a>
                            <a title="Delete" class="w3-btn p-1 px-2 w3-small   w3-border"
                              onclick="return confirm('Do you really want to delete this category?');"
                              href="{{ route('admin.categoryDelete', [$category->id])}}"><i class="fa fa-times w3-text-red"></i>
                            </a>

                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                  class="fas fa-plus"></i>
                          </button>
                      </div>
                      {{-- modal starts --}}
                      <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form id="subscribeForm" action="" method="post">
                                  @csrf
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Category Title:</label>
                                  <input type="text" name="name" value="{{$category->name}}" class="form-control" id="recipient-name">
                                </div>
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Description:</label>
                                  <textarea class="form-control" value="{{$category->description}}" name="description" id="message-text"></textarea>
                                </div>
                              
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                          </div>
                        </div>
                      </div>
                      {{-- ./modals ends --}}


                  </div>

                  <div class="card-body p-1">

                      <div class="px-3 py-1">

                          Category Description: {!! $category->description !!}
                          <br>                         

                          @if($category->img_name)
                            Category Image:
                          <a href="{{asset('storage/media/category/image/'.$category->img_name)}}" download><i
                                  class="fa fa-download" aria-hidden="true"></i> Download File</a>
                          @endif
                            <br>
                          @if($category->banner_name)
                          Category Banner Image:

                          <a href="{{asset('storage/media/category/banner/'.$category->banner_name)}}" download><i
                                  class="fa fa-download" aria-hidden="true"></i> Download File</a>
                          @endif


                      </div>



                      <div class="card card-widget mb-0 ">
                          <div class="card-body w3-light-gray p-1">

                              <div class="card card-widget mb-0 ">
                                  <div class="card-header">
                                      <form class="form-add-item"
                                          action="{{route('admin.addsubcategoryPost',['workstation'=>$workstation,'category'=>$category])}}" method="post">

                                          @csrf

                                          <div class="row">
                                              <div class="col-md-4">
                                                  <label>New SubCategory</label>
                                                  <input type="text" name="name" {{old('title')}}
                                                      class="form-control" placeholder="Add New SubCategory">
                                              </div>
                                              <div class="col-md-5">
                                                <label>SubCategory Description</label>
                                                <input type="text" name="description" {{old('description')}}
                                                    class="form-control" placeholder="SubCategory Description">
                                            </div>
                                              
                                              <div class="col-md-1">
                                                  <div class="form-group">
                                                      <br>
                                                      <div class="form-check" style="margin-top: 10px;">
                                                          <input name="active" class="form-check-input"
                                                              type="checkbox" checked>
                                                          <label class="form-check-label">Active</label>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-md-1">

                                                  <button type="submit" style="margin-top: 23px;"
                                                      class="btn btn-sm btn-primary"><i
                                                          class="fa fa-plus"></i></button>
                                              </div>

                                          </div>


                                      </form>
                                  </div>
                                  <div class="all-data-area question-area card-body  p-1">

                                    @include('admin.categories.ajax.subcatTable')
                                    
                                  </div>
                              </div>
                          </div>
                      </div>



                  </div>


              </div>



              {{-- modal starts --}}
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			  <div class="modal-content">
				<div class="modal-header">
				  <h5 class="modal-title" id="exampleModalLabel">Edit Subategory</h5>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">
				  <form id="subcatForm" action="" method="post">
					  @csrf
					<div class="form-group">
					  <label for="recipient-name" class="col-form-label">Subcategory Title:</label>
					  <input type="text" name="name" value="" class="form-control" id="recipient-name">
					</div>
					<div class="form-group">
					  <label for="message-text" class="col-form-label">Description:</label>
					  <textarea class="form-control" value="" name="description" id="message-text"></textarea>
					</div>
				  
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  <button type="submit" class="btn btn-success">Update</button>
				</div>
			</form>
			  </div>
			</div>
		  </div>
		  {{-- ./modals ends --}}


              @endforeach



          </div>
          @else
          <h3 class="w3-center w3-text-red">No Category Yet</h3>
          @endif
        </div>
      </div>
  </div>
</section>