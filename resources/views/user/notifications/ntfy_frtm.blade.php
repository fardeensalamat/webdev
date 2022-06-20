<li class="dropdown messages-menu">
          <a class="ntfy" data-url="{{route('deleteNtfyFrtm')}}" href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fi-torsos-male-female"></i>
            @if($auth->touchFrtm())
            <span class="label label-danger">
            {{$auth->touchFrtm()}}
            </span>
            @endif
          </a>
          <ul class="dropdown-menu w3-card-2">
            <li class="header">
            @if($auth->touchFrtm())
            You have
            <span class="totalFrtm">
            {{$auth->touchFrtm()}} New
            </span>
            Friend Requests
            @else
            You have Total
            <span class="totalFrtm">
            {{$auth->friendRequests()->count()}}
            </span> Friend Requests
            @endif
            </li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu ntf-frtm-auto">
                <?php $frtmNtf = $auth->notifyFrtm; ?>
                <div class="frtmNotifyLastPage" data-lastpage="{{$frtmNtf->lastPage()}}" data-url="{{route('myFrNtfy')}}"></div>
                @include('user.notifications.notify_frtm')
              </ul>
              <div class="loading-nty-frtm text-center" style="display: none;">
              <span class='load-nty-frtm fa fa-refresh fa-spin text-green'></span> Loading...
              </div>

            <div class="fallback nty-frtm-fallback" style="display: none;">
              {!! $auth->notifyFrtm->render() !!}
            </div>
            </li>
            <li class="footer"><a href="{{route('friendRequestToMe')}}">See All Requests</a></li>
          </ul>
        </li>