<table class="table table-striped table-bordered table-hover" >
  <thead>
      <tr>
          <th width="10%">ID</th>
          <th>Category Name</th>
          <th width="130">Status</th>
          <th width="30">Image</th>
          <th width="30">Banner</th>
          <th width="25%">Action</th>
      </tr>
  </thead>
  <tbody>

<?php $i = (($categories->currentPage() - 1) * $categories->perPage() + 1); ?>

@foreach($categories as $cat)
      <tr>
          <td>
          <strong>ID:</strong>{{ $cat->id }}<br>
          <input class="checkbox" type="checkbox" name="checkid[]" value="{{ $cat->id }}">
          </td>
          <td>

          {{ $cat->name }}
          </td>

          <td>
              Status: {{ $cat->active ? 'Active' : 'Inactive' }} <br>
              Feature: {{ $cat->featured ? 'Featured' : 'Not featured' }}
          </td>
          <td>
              @if($cat->img_name)


          <img src="{{asset('storage/media/category/image/'.$cat->img_name)}}" class="img-fluid" style="width: 30px;" alt="{{$cat->title}}">

              @endif
          </td>

          <td>
              @if($cat->banner_name)
 

              <img src="{{asset('storage/media/category/banner/'.$cat->banner_name)}}" class="img-fluid" style="width: 40px;" alt="{{$cat->title}}" height="40" width="40">

              @endif
          </td>

          <td class="center">
          <a href="{{route('admin.categoryEdit',$cat)}}" class="btn btn-sm btn-info">Edit</a>

          <a href="#deleteModal{{$cat->id}}" class="btn btn-sm btn-danger" data-toggle="modal">Delete</a>
          <div class="modal fade" id="deleteModal{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confermation</h5>
                  </div>
                  <div class="modal-body">
                    Are Your Want To Delete
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{route('admin.categoryDelete',$cat->id)}}" method="post">
                      @csrf
                      <button type="submit" class="btn btn-info">Yes Delete</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </td>
      </tr>

      <?php $i++; ?>

@endforeach

  </tbody>
  <tfoot>
      <tr>
          <th width="10%">ID</th>
          <th>Category Name</th>
          <th width="130">Status</th>
          <th width="30">Image</th>
          <th width="30">Banner</th>
          <th width="25%">Action</th>
      </tr>
  </tfoot>
</table>

<div class="ajax-pagination-area">

  
{{ $categories->appends([


  'q' => isset($q) ? $q : null,
  'status' => isset($status) ? $status : null
  ])->render() }}
  
</div>