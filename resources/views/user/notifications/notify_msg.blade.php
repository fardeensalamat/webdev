@foreach ($chatto as $chatable)

@if($chatable->user())
<?php $user = $chatable->chatBy; ?>
<li>
<a href="{{route('userMessage',['user'=>$user])}}">
  <div class="pull-left">
    <img class="img-rounded" src="{{ route( 'imagecache', ['template'=>'ppmd', 'filename' => $user->userProfilePic ]) }}" alt="User Image">
  </div>

  <h4>
        <span data-url="{{route('userProfile', [$user->username])}}">
        {{$user->selectedName()}}
        </span>

  </h4>

  <p>
  <span class="single-slim">{{$chatable->latestMsgByMe() ? 'Me:' : ''}} {{$chatable->latestMessage()}}</span> 
      
  </p>

  <span class="help-block w3-tiny">{{$chatable->updated_at->diffForHumans()}} <span class="pull-right">{{$chatable->unseenCount() ? $chatable->unseenCount() . ' New' : ''}}</span></span>
  
    
  </a>
</li>

@elseif($chatable->shop())

<?php $shop = $chatable->chatBy; ?>
<li>
<a href="{{route('shopMessage',['shop'=>$shop])}}">

  <div class="pull-left">
    <img class="img-rounded" src="{{ route( 'imagecache', ['template'=>'ppmd', 'filename' => $shop->coverPic ]) }}" alt="User Image">
  </div>


  <h4>
        <span data-url="{{route('userProfile', [$shop->username])}}">
        {{$shop->title}}
        </span>

  </h4>


  <p>
  <span class="single-slim">{!! $chatable->latestMsgByMe() ? 'Me:' : '' !!} {{$chatable->latestMessage()}}</span> 
      
  </p>

  <span class="help-block w3-tiny">{{$chatable->updated_at->diffForHumans()}} <span class="pull-right">{{$chatable->unseenCount() ? $chatable->unseenCount() . ' New' : ''}}</span></span>

    </a>
    
</li><!-- /.item -->


@elseif($chatable->bazar())

@endif
@endforeach