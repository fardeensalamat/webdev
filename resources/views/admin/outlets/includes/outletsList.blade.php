<table class="table table-striped table-bordered table-hover" >
    <thead>
        <tr >
            <th>SL</th>
            <th>Code</th>
            <th>Outlet Name</th>
            <th>Mobile</th>
            <th>Address</th>
            <th width="25%">Division</th>
            <th width="25%">District</th>
            <th width="25%">Thana</th>
            <th width="25%">Action</th>
            <th>Brands/Companies</th>
        </tr>
    </thead>
    @if ($outlets)
        
    
    <tbody>
    
    <?php $i = (($outlets->currentPage() - 1) * $outlets->perPage() + 1); ?>


    @foreach($outlets as $outlet)

        <tr class="nowrap">
            
            <td>{{$i}}</td>
            <td><span>{{ $outlet->code }}</span></td>
            <td><span>{{ $outlet->name }}</span></td>
            <td><span>{{ $outlet->mobile }}</span></td>
            <td><span>{{ $outlet->address }}</span></td>
            <td>{{ $outlet->division->name }}</td>
            <td>{{ $outlet->district->name  }}</td>
            <td>{{ $outlet->thana->name }}</td>

            

            <td class="center">
            
            <a href="{{route('admin.outletEdit',$outlet->id)}}" target="_blank" class="btn btn-sm btn-info">Edit</a>
            
           
            <a href="#deleteModal{{$outlet->id}}" class="btn btn-sm btn-danger" data-toggle="modal">Delete</a>
            <div class="modal fade" id="deleteModal{{$outlet->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <form action="{{route('admin.outletDelete',$outlet->id)}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-info">Yes Delete</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              
            </td>
            <td>
              @foreach ($outlet->brands as $brand)
              {{$brand->title}},
              @endforeach
              
            </td>

            <?php $i++; ?>
        </tr>
    @endforeach
    </tbody>
    @endif
    <tfoot>
        <tr>
            <th>SL</th>
            <th>Code</th>
            <th>Brand Name</th>
            <th>Mobile</th>
            <th>Address</th>
            <th width="25%">Division</th>
            <th width="25%">District</th>
            <th width="25%">Thana</th>
            <th width="25%">Action</th>
            <th>Brands/Companies</th>
        </tr>
    </tfoot>
</table>

<div>
    {{$outlets->render()}}
</div>