	<tr>
		<td   style="width: 100px;">  {{ $loop->iteration }}</td>
		<td >Subcategory Title: {{$subcat->title}}</td>
		<td   style="width: 100px;"> Description:</td>
		<td>
			{{$subcat->description}}
		</td>
		<td style=""> 
		
		<div class="btn-group btn-group-xs float-right" title="Delete Category">
			{{-- <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#exampleModal" onclick="subcatbeId('{{route('admin.subcategoryUpdatePost',$subcat->id)}}')"><i class="fas fa-edit"></i></button> --}}
			<a href="{{route('admin.subcategoryEdit',[$subcat, 'workstation' => $workstation->id])}}" class="btn btn-tool mt-1" ><i class="fas fa-edit"></i></a>

            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-trash"></i>
            </button>
            <ul class="dropdown-menu p-0" role="menu">
 

              <li class="p-0"><a class="w3-btn w3-red w3-small w3-round w3-hover-red btn-subcat-delete" href="{{route('admin.subcategoryDelete',$subcat)}}" data-url="">Confirm</a></li>
            </ul>
        </div>

		</td>
	</tr>
