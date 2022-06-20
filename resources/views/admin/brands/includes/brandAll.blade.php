<table class="table table-striped table-bordered table-hover" >
    <thead>
        <tr>
            <th width="10%">SL </th>
            <th>Brand Name</th>
            <th>Status</th>
            <th width="25%">Image</th>
            <th width="25%">Action</th>
        </tr>
    </thead>
    @if ($brands)
        
    
    <tbody>
    
    <?php $i = (($brands->currentPage() - 1) * $brands->perPage() + 1); ?>


    @foreach($brands as $brand)

        <tr>
            <td>
                ID: {{ $brand->id }} <br>
                <input class="checkbox" type="checkbox" name="checkid[]" value="{{ $brand->id }}">
            </td>
            <td>
            <span>{{ $brand->title }}</span><br>
            </td>

            <td>
                Status: {{ $brand->active ? 'Active' : 'Inactive' }} <br>
                Feature: {{ $brand->featured ? 'Featured' : 'Not featured' }}
            </td>
            <td>
             @if($brand->img_name)
 

            <img src="{{ route('imagecache', [ 'template'=>'cpsm','filename' => $brand->img_name ]) }}" class="img-fluid" style="width: 100%;" alt="{{$brand->title}}">

                @endif
            </td>

            <td class="center">
            {{-- @if(Auth::user()->hasPermission('brand_edit')) --}}
            <a href="{{route('admin.brandEdit',$brand->id)}}" class="btn btn-sm btn-info">Edit</a>
            {{-- @endif --}}
            {{-- @if(Auth::user()->hasPermission('brand_delete')) --}}
            <a href="#deleteModal{{$brand->id}}" class="btn btn-sm btn-danger" data-toggle="modal">Delete</a>
            <div class="modal fade" id="deleteModal{{$brand->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <form action="{{route('admin.brandDelete',$brand->id)}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-info">Yes Delete</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              {{-- @endif --}}
            </td>

            <?php $i++; ?>
        </tr>
    @endforeach
    </tbody>
    @endif
    <tfoot>
        <tr>
            <th width="10%">SL </th>
            <th>Brand Name</th>
            <th>Status</th>
            <th width="25%">Image</th>
            <th width="25%">Action</th>
        </tr>
    </tfoot>
</table>

<div>
    {{$brands->render()}}
</div>