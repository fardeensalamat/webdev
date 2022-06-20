<li class="nav-item dropdown">
        <a class="nav-link ntfy" data-toggle="dropdown"  data-url="{{route('user.deleteMainNoti')}}" href="#">
          <i class="fa fa-wifi w3-text-white"></i>
          @if($me->touchMainValue())
          <span class="badge badge-danger navbar-badge">{{$me->touchMainValue()}}</span>
          @else

          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item ">
            <!-- Message Start -->
            <div class="media">
              {{-- <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> --}}
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  @if($me->touchMainValue())
            <i class="fa fa-bell w3-text-red"></i> You have
            <span class="">
            {{$me->touchMainValue()}} New
            </span>
            Notifications
            @else
            You have no new notification.
            @endif
                </h3>
                
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>

          @foreach($me->notificationSix() as $ntf)

          <div class="dropdown-item">
           @if($ntf->type == 'App\Notifications\Liked')
            <!-- Message Start -->
            <div class="media">
              {{-- <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> --}}
              <div class="media-body">
                <h3 class="dropdown-item-title">

                  <i class="fa fa-newspaper w3-text-deep-orange"></i>  

                  @if($ntf->data['likeable_type'] == 'App\Models\Post')
                  Your <a href="{{ route('newsfeed.detailsPost',$ntf->data['likeable_id']) }}">Post</a> has {{ $ntf->data['likes_count_of_item'] }} Likes
                  @endif

                  @if($ntf->data['likeable_type'] == 'App\Models\Comment')
                  Your Comment has {{ $ntf->data['likes_count_of_item'] }} Likes
                  @endif
             
                  <span class="float-right text-sm text-gray"><i class="fas fa-star"></i></span>
                </h3>
                {{-- <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p> --}}
              </div>
            </div>
            @endif


            @if($ntf->type == 'App\Notifications\Commented')
            <!-- Message Start -->
            <div class="media">
              {{-- <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> --}}
              <div class="media-body">
                <h3 class="dropdown-item-title">

                  <i class="fa fa-newspaper w3-text-deep-orange"></i>  

                  @if($ntf->data['commentable_type'] == 'App\Models\Post')
                  Your <a href="{{ route('newsfeed.detailsPost',$ntf->data['commentable_id']) }}">Post</a> has {{ $ntf->data['comments_count_of_item'] }} Comments
                  @endif

                   
             
                  <span class="float-right text-sm text-gray"><i class="fas fa-star"></i></span>
                </h3>
                {{-- <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p> --}}
              </div>
            </div>
            @endif

            <!-- Message End -->
          </div>
          <div class="dropdown-divider"></div>
          @endforeach
          
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
