<li class="dropdown messages-menu">
          <a href="#" class="ntfy" data-url="{{route('deleteNtfyMsg')}}" class="dropdown-toggle" data-toggle="dropdown">
            <i class="ion-android-chat"></i>
            @if($auth->touchMsg())
              <span class="label label-danger">
                {{$auth->touchMsg()}}
              </span>
            @endif
          </a>
          <ul class="dropdown-menu w3-card-2">
            <li class="header">
              @if($auth->touchMsg())
              You have
              <span class="">
              {{$auth->touchMsg()}} New
              </span>
              message
              @else
              You have no new message.
              @endif
            </li>
            
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu ntf-msg-auto">
                <?php $chatto = $auth->chattoAll; ?>
                <div class="msgNotifyLastPage" data-lastpage="{{$chatto->lastPage()}}" data-url="{{route('chatNotifyParticipantsAuto')}}"></div>
                @include('user.notifications.notify_msg')
              </ul>
              <div class="loading-nty-msg text-center" style="display: none;">
              <span class='load-nty-msg fa fa-refresh fa-spin text-green'></span> Loading...
              </div>

            <div class="fallback nty-msg-fallback" style="display: none;">
              {!! $chatto->render() !!}
            </div>
            </li>

            <li class="footer"><a href="{{route('userMessageDashboard')}}">See All Messages</a></li>
          </ul>
        </li>