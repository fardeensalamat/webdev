  <div class='card-comment'>
    <!-- User image -->



    <img class='img-circle img-sm' src="{{ route( 'imagecache', ['template'=>'ppmd', 'filename' => $comment->addedBy->fi() ]) }}" alt='user image'>
    <div class='comment-text' style="word-wrap: break-word; text-align: justify;">
      <span class="username">
      <a 
      {{-- href="{{route('userProfile',[$comment->addedBy->username])}}" --}}
      >{{$comment->addedBy->name}}</a>
      <span class='text-muted'>{{$comment->created_at->diffForHumans()}} </span>

  <span class="dropdown pull-right">
  <a href="#"  class="dropdown-toggle text-muted"  id="menu1" data-toggle="dropdown">
  <span class="caret"></span>
  </a>

  <ul class="dropdown-menu w3-card-2 w3-animate-zoom" role="menu" aria-labelledby="menu1">

    @if($comment->hasDeletePermission())

    <li role="presentation">
    <a class="deleteComment pl-2" role="menuitem" tabindex="-1" href="{{route('user.itemDelete', ['type'=>'comment', 'id'=>$comment->id])}}"><i class="fa fa-trash text-red"></i> delete</a>
    </li>

    @endif

  </ul>
</span>
      </span><!-- /.username -->
      <div class=""  style="white-space:pre-wrap;" >{{$comment->description}}</div>
    </div><!-- /.comment-text -->

    <div class="likeArea">
      
    @include('user.ajax.like.likeAreaForComment')
    </div>
    {{-- @include('user.ajaxBlades.likeAreaForCommentSecondPart') --}}
    {{-- <div class="replyArea">
      @include('user.ajaxBlades.replyFormForComment')
      <div class="previousReply">
        <div class="loadingSeeReplies pull-left" style="display: none; padding-left: 40px;"><span class='fa fa-refresh fa-spin text-green'></span> Loading...</div>
          @if($comment->replies->count())
            <a class="seeReplies" style="padding-left: 40px;" href="{{route('seeRepliesForComment', ['comment'=>$comment])}}"><i class="ion-arrow-return-right fa fa-flip-vertical"></i> See Replies</a>
          @endif
      </div>
      <div class="newReply"></div>
    </div> --}}
  </div>
