
 <!---------------------Impressed Area------------------------>
@if(Auth::check())
	<span class="w3-small likeCreate" style="padding-left: 40px;cursor: pointer;" title="Like" data-url="{{ route('user.likeCreate', ['type'=> 'comment', 'id'=>$comment->id]) }}" >
		@if($comment->isLikedByMe())
			<i class="fas like-icon fa-heart text-danger"></i>
		@else
			<i class="far like-icon fa-heart text-danger"></i>
		@endif
	</span>
@else
	<span class="w3-small" data-toggle="modal"  style="padding-left: 40px;cursor: pointer;" data-target="#signinModal" href="javascript::void();">
	</span>
@endif

&nbsp; &nbsp;
<a class="{{ Auth::check() ? 'likers-modal' : '' }}" href="#" data-url="
{{ route('user.likers', ['type'=> 'comment', 'id'=>$comment]) }}
">
	<span class="w3-text-gray likeCounter ml-1">{{ $comment->likes->count() }}</span>  {{ Str::plural('Like', $comment->likes->count()) }}
</a>
 
 

