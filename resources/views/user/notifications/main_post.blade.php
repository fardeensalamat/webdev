<li ><!-- start message -->
    <a href="{{route('postSlug',['publish'=>$publish->id, 'slug'=>$post->post_slug])}}">
      <div class="pull-left">
      <i class=" fa fa-share-alt fa-2x "></i>
      </div>

      <h4>
        <span data-url="#">
        {{custom_name($post->post_title, 30)}}
        </span>

      </h4>
      <p>
      Your Post has {{$post->spreads->count()}} {{str_plural('spread', $post->spreads->count())}},<br/> {{$post->likes->count()}} {{str_plural('like', $post->likes->count())}}, <br/>{{$post->comments->count()}} {{str_plural('opinion', $post->comments->count())}}.
      </p>
    </a>
  </li><!-- end message -->