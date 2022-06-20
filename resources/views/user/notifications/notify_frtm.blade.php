
@foreach($frtmNtf as $friend)
  <li><!-- start message -->
    <a href="{{route('userProfile',['username'=>$friend->username])}}">
      <div class="pull-left">
      <img class="img-rounded" src="{{ route( 'imagecache', ['template'=>'ppmd', 'filename' => $friend->userProfilePic ]) }}" alt="User Avatar">
    </div>




      <h4>
        <span data-url="{{route('userProfile', [$friend->username])}}">
        @if(strlen($friend->selectedName()) > 25)
        {{str_pad(substr($friend->selectedName(), 0, 23), 26,'.')}}
        @else
        {{$friend->selectedName()}}
        @endif
        </span>
        <div class="btn-group btn-group-xs pull-right">
          <button type="button" class="btn btn-primary btn-ntfy-frtm-accept" data-url="{{route('acceptFriendRequest',['frtm'=>$friend->id])}}">Accept</button>
          <button type="button" class="btn btn-default btn-ntfy-frtm-cancel" data-url="{{route('notAcceptFriendRequest',['frtm'=>$friend->id])}}">Cancel</button>
        </div>
      </h4>
      <p>
        @if($friend->hasLocation())
        <i class="fa fa-home fa-fw"></i> {{$friend->presentLocation()}}<br/>
        @endif
        @if($friend->hasHomeTown())
        <i class="fa fa-map-marker fa-fw"></i> {{$friend->homeTown()}}
        @endif
      </p>
    </a>
  </li><!-- end message -->
@endforeach