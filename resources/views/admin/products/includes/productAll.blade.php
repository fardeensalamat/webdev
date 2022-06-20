<table class="table table-striped table-bordered table-hover" >
    <thead>
        <tr>
            <th width="10%">SL </th>
            <th>Product Name</th>
            <th>Status</th>
            <th width="25%">Image</th>
            <th width="25%">Action</th>
        </tr>
    </thead>
    @if ($products)
        
    
    <tbody>
    
    <?php $i = (($products->currentPage() - 1) * $products->perPage() + 1); ?>
   
    @foreach($products as $product)

        <tr>
            <td>
                ID: {{ $product->id }} <br>
                <input class="checkbox" type="checkbox" name="checkid[]" value="{{ $product->id }}">
            </td>
            <td>
            <span>{{ json_decode($product->name)->en }}</span><br>
            <span><b>Price</b>: {{$product->sale_price}}</span> 
            <span><b>Brand</b>: {{ $product->brand ? $product->brand->title : ''}}</span>, <br>
            <span><b>PV</b>: {{ $product->pv}}</span>
            </td>

            <td>
                Status: {{ $product->status=='on' ? 'published' : 'Inactive' }} <br>
            </td>
            <td>
            
 

            <img src="{{ route('imagecache', [ 'template'=>'pfism','filename' => $product->usliveFi() ]) }}" class="img-fluid" style="width: 40px;" alt="{{$product->title}}">

            </td>

            <td class="center">
            
            <a href="{{route('admin.editProduct',$product)}}" class="btn btn-sm btn-info">Edit</a>
            
            <a href="#deleteModal{{$product->id}}" class="btn btn-sm btn-danger" data-toggle="modal">Delete</a>
            <div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <form action="{{route('admin.deleteProduct',$product)}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-info">Yes Delete</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              
            </td>

            <?php $i++; ?>
        </tr>
    @endforeach
    </tbody>
    @endif
    <tfoot>
        <tr>
            <th width="10%">SL </th>
            <th>Product Name</th>
            <th>Status</th>
            <th width="25%">Image</th>
            <th width="25%">Action</th>
        </tr>
    </tfoot>
</table>

<div>
    {{$products->render()}}
</div>