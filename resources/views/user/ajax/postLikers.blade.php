
  <ul class="products-list product-list-in-card py-0 my-0 pl-2 pr-2">
@foreach($likes as $like)
  <?php $u = $like->likedBy; ?>
                  <li class="item py-0 my-0">
                    <div class="product-img">
                      <img class="img-rounded" src="{{route('imagecache', [ 'template'=>'ppsm','filename' => $u->fi() ])}}" alt="User Image">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">{{$u->name}}
                        <span class="badge badge-default float-right"><i class="fa fa-heart text-red"></i></span></a>
                      <span class="product-description">
                        {{-- Samsung 32" 1080p 60Hz LED Smart HDTV. --}}
                      </span>
                    </div>
                  </li>


                  <!-- /.item -->
@endforeach
                </ul>