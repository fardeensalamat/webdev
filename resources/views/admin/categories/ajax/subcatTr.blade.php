	<tr>
		<td   style="width: 100px;">  {{ $loop->iteration }}</td>
		<td > {{$subcat->title}}</td>

		<td>
			{{$subcat->description}}
		</td>
		<td>
			{{$subcat->job_post_price}}
		</td>
		<td>
			{{$subcat->job_work_price}}
		</td>
		<td>
			{{$subcat->screenshot}}
		</td>
		<td>{{$subcat->admin_approve == true ? 'active' : 'inactive'}}</td>
		<td>{{$subcat->work_link == true ? 'active' : 'inactive'}}</td>
		<td>
			{{$subcat->instraction}}
			{{-- {!!$subcat->instraction!!} --}}
		</td>
		<td style=""> 

			<div class="btn-group ">
				<a href="{{route('admin.jobsubcategoryEdit',$subcat)}}" class="btn btn-light"><i class="fa fa-edit"></i></a>

				<div class="btn-group">
				  <button type="button" class="btn btn-primary dropdown-toggle dropdown-menu-right" data-toggle="dropdown">
					 <i class="fa fa-times"></i>
				  </button>
				  <div class="dropdown-menu">
 
					<a class="dropdown-item" href="{{route('admin.jobsubcategoryDelete',$subcat)}}">Confirm</a>
				  </div>
				</div>
			  </div>
		
		 

		</td>
	</tr>
