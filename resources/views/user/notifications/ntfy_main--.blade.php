<li class="dropdown messages-menu">
          <a class="ntfy" data-url="{{route('deleteMainNoti')}}" href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-wifi"></i>
            @if($auth->touchMains())
            <span class="label label-danger">
            {{$auth->touchMains()}}
            </span>
            @endif
          </a>
          <ul class="dropdown-menu w3-card-2">
            <li class="header">
            @if($auth->touchMains())
            You have
            <span class="">
            {{$auth->touchMains()}} New
            </span>
            Notifications
            @else
            You have no new notification.
            @endif
            </li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu ntf-main-auto">
              <?php $mainNtf = $auth->notifications; ?>
              <div class="mainNotifyLastPage" data-lastpage="{{$mainNtf->lastPage()}}" data-url="{{route('myLatestNotif')}}"></div>
              @include('user.notifications.notify_main')
              </ul>
              <div class="loading-nty-main text-center" style="display: none;">
              <span class='load-nty-main fa fa-refresh fa-spin text-green'></span> Loading...
              </div>

            <div class="fallback nty-main-fallback" style="display: none;">
              {!! $auth->notifications->render() !!}
            </div>
            </li>
            <li class="footer"><a href="#">See All Notifications</a></li>
          </ul>
        </li>