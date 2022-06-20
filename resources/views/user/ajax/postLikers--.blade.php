<div class="likersLastPage" data-lastpage="{{$likes->lastPage()}}" 
  {{-- data-url="{{route('likesForPostAuto',['post'=>$post->id])}}"  --}}
  ></div>
@foreach($likes as $like)
  <?php $u = $like->likedBy ?>
   <li class="item" style="border-bottom: 1px solid #f4f4f4;padding-bottom: 10px">
    <div class="product-img">
      <img class="img-rounded" src="{{route('imagecache', [ 'template'=>'ppxs','filename' => $u->fi() ])}}" alt="User Image">
    </div>


    <div class="product-info">
      <a href="" class="product-title">
      {{$u->name}}
        <span class="pull-right">
  
        <i class="fa fa-heart text-red"></i>
         
        </span>
      </a>



       
    </div>
 
     
 
</li><!-- /.item -->
@endforeach