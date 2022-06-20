@if($product->imageFirst())
<div class="card card-widget">
	<div class="card-body">
		<div class="d-flex p-1  justify-content-center">
		  @foreach($product->images() as $img)
			<div class="p1 text-center">
				<img width="60" height="60" class="m-1 img-rounded" src="{{asset($img->file_url)}}" alt="Image"> <br>
				<a class="product-extra-img-delete" href="{{ route('admin.productExtraImageDelete',['media'=>$img]) }}"><i class="fa fa-trash"></i></a>
			</div>
		  @endforeach
		</div>
	</div>
</div>
@endif