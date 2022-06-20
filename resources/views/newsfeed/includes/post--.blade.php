{{$post->viewIncrease()}}
<div class="card gedf-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mr-2">
                                <img class="rounded-circle" width="45" src="{{route('imagecache', [ 'template'=>'ppsm','filename' => $post->addedBy->fi() ])}}" alt="">
                            </div>
                            <div class="ml-2">
                                <div class="h5 m-0">@ {{$post->addedBy->name}}</div>
                                <div class="h7 text-muted">{{Str::limit($post->addedBy->mobile,7,'....')}}, <b>WS: </b>{{ $post->workstation ? $post->workstation->title : '' }}, <b>Cat: </b>{{ $post->wscat ? $post->wscat->name : '' }}, <i class="far fa-clock"></i> {{$post->created_at->diffForHumans()}}</div>
                            </div>
                        </div>
                        <div>
                          
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-h"></i>
                            </button>
                            @if (($post->postable_id == Auth::id() and $post->postable_type == 'App\Models\User') or (Auth::user()->isAdmin()))
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                    <a class="dropdown-item" href="{{ route('newsfeed.detailsPost', $post) }}">Details</a>
                                    {{-- <div class="h6 dropdown-header">Option</div> --}}
                                    {{-- <a class="dropdown-item" href="#">Save</a> --}}
                                    <a onclick="return confirm('Do you want to delete this post?');" class="dropdown-item" href="{{route('newsfeed.delete',$post)}}" 
                                    onclick="return confirm('Do you want to delete your post?')">Delete</a>
                                </div>
                            @endif
                        </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                      
                    <p class="card-text">
                        {{ucfirst($post->description)}}
                    </p>
                    <div class="row">
                      @foreach ($post->postfiles as $file)
                        

                        @if($file->file_type == 'image')
                            
                            <div class="col-md-12 mb-2">
                                <img width="100%" class="w3-border" src="{{route('imagecache', [ 'template'=>'cpsm','filename' => $file->fimage() ])}}" alt="">
                            </div>
                            
                        
                        
                        @elseif( $file->file_type == 'docx')
                        <a href="{{asset('storage/post/'.$file->file_name)}}" download="{{asset('storage/post/'.$file->file_name)}}"><i class="fa fa-download"></i> doc file</a> 
                        @elseif( $file->file_type == 'pdf')
                        {{-- <a href="{{asset('storage/post/'.$file->file_name)}}" download="{{asset('storage/post/'.$file->file_name)}}"><i class="fa fa-download"></i> pdf file</a>  --}}

                        <iframe src="{{asset('storage/post/'.$file->file_name)}}" style="width:100%; height:400px;" frameborder="0" id="pdfReport"></iframe>
                        {{-- <object width="100%" height="400" data="{{asset('storage/post/'.$file->file_name)}}"></object> --}}
                        @elseif( $file->file_type == 'audio')
                        <audio controls>
                            <source width="100%" src="{{asset('storage/post/'.$file->file_name)}}" type="audio/ogg">
                            <source width="100%" src="{{asset('storage/post/'.$file->file_name)}}" type="audio/mpeg">                          
                        </audio>

                        @elseif($file->file_type == 'video')
                        {{-- desktop view --}}
                        <video width="100%" controls class=" d-none d-sm-none d-md-block">
                            <source src="{{asset('storage/post/'.$file->file_name)}}" type="video/mp4">
                            <source src="{{asset('storage/post/'.$file->file_name)}}" type="video/ogg">
                            
                        </video>
                        {{-- mobile version --}}
                        <video width="100%" controls class="d-block d-sm-block d-md-none">
                            <source src="{{asset('storage/post/'.$file->file_name)}}" type="video/mp4">
                            <source src="{{asset('storage/post/'.$file->file_name)}}" type="video/ogg">
                            
                        </video>
                        @endif
                        
                      @endforeach
                    </div>
                      
                </div>
                <div class="card-footer bg-white w3-border-top w3-border-light-gray">

           
                        <span class="likeArea">
                            @includeIf('newsfeed.ajax.postLikeArea')
                        </span>
        

                    {{-- <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a> --}}

                    {{-- <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a> --}}
                    <a href="#" class="card-link float-right"><i class="fa fa-mail-forward"></i> Share</a>

                </div>

                <div class="commentArea">
                @if($post->comments->count())
                <div class='card-footer card-comments'>
                <span class="previousComment">
                  <div class="loadingPrevCom pull-right" style="display: none; padding-right: 80px;"><span class='fa fa-refresh fa-spin text-green'></span> Loading...</div>
                  <?php $takeNumber = 4; ?>
                  @if($post->comments->count() > $post->selectedComments($takeNumber)->count())
                  <a class="pull-right previousDiscusses" href="{{route('seePreviousComForPost', ['post'=>$post->id])}}">
                  <i class="fa fa-comments-o" aria-hidden="true"></i>
                  View Previous {{$post->comments->count() - $takeNumber}} {{str_plural('Opinion', ($post->comments->count() - $takeNumber))}}</a><br/>
                  @endif
                </span>
                  @foreach($post->selectedComments($takeNumber) as $comment)
                    @include('user.ajaxBlades.commentSingle')
                  @endforeach
                  <span class="newComment"></span>
                </div><!-- /.box-footer -->
                @endif
              </div>



              <div class="loadingNewComment" style="display: none; padding-left: 40px;"><span class='loadNewComment fa fa-refresh fa-spin text-green'></span> Loading...</div>

   <div class="box-footer">
    <form action="{{route('commentNewCreate',['post' =>$post->id])}}" method="post">
    {{csrf_field()}}
      <img class="img-responsive img-circle img-sm" src="{{ route( 'imagecache', ['template'=>'ppmd', 'filename' => Auth::user()->userProfilePic ]) }}" alt="alt text">
      <!-- .img-push is used to add margin to elements next to floating images -->
      <div class="img-push">
      <!-- <input type="text" name="comment_body" class="form-control input-sm" placeholder="Press enter to post comment"> -->

      <textarea class="form-control comment_box comment-box" name="comment_body" rows="1" placeholder="Type Your Opinion and Press Enter" data-url="{{route('commentNewCreate',['post' =>$post->id])}}"></textarea>

      </div>
      <button class="btn btn-xs comment_submit" type="submit" style="display: none;">submit your opinion</button>
    </form>
  </div><!-- /.box-footer -->
</div><!-- /.box -->
     