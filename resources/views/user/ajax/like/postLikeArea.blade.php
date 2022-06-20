<!---------------------Impressed Area------------------------>
@if(Auth::check())
	<a class="btn btn-xs btn-default w3-white no-border likeCreate" title="Like" data-url="{{ route('user.likeCreate', ['type'=> 'post', 'id'=>$post]) }}" href="">
		@if($post->isLikedByMe())
			<i class="fas like-icon fa-heart text-danger"></i>
		@else
			<i class="far like-icon fa-heart text-danger"></i>
		@endif
	</a>
@else
	<a class="btn btn-xs btn-default w3-white no-border" data-toggle="modal" data-target="#signinModal" href="javascript::void();">
	</a>
@endif
<a class="{{ Auth::check() ? 'likers-modal' : '' }}" href="#" data-url="
{{ route('user.likers', ['type'=> 'post', 'id'=>$post]) }}
">
	<span class="w3-text-gray likeCounter ml-1">{{ $post->likes->count() }}</span>  {{ Str::plural('Like', $post->likes->count()) }}
</a>