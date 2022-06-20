<li ><!-- start message -->
    <a href="{{route('postSlug',['publish'=>$publish->id, 'slug'=>$post->post_slug])}}">
      <div class="pull-left">
      <i class=" fa fa-share-alt fa-2x "></i>
      </div>

      <h4>
        <span data-url="#">
        <?php $text = $spread->opinion ? $spread->opinion : $post->post_body; ?>
        {{custom_name($text, 42)}}
        </span>
      </h4>
      <p>
      Your Spread has {{$spread->likes->count()}} {{str_plural('like', $spread->likes->count())}}, <br/>{{$spread->comments->count()}} {{str_plural('opinion', $spread->comments->count())}}.
      </p>
    </a>
</li><!-- end message -->