<?php

namespace App\Http\Controllers\User\Comment;

use Auth;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Notifications\Commented;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{


    public function commentCreate(Request $request)
    {
    	$type = $request->type;
    	$id = $request->id;

    	if($type == 'post')
    	{
    		$post = Post::findOrFail($id);
    		$trimBody = trim($request->comment_body);
	        $commentBody = $trimBody ?: 'Hi, I have joined just now.';
	        $comment = new Comment;
	        $comment->addedby_id = Auth::id();
	        // $comment->addedBy()->associate(Auth::user()->id);
	        $comment->description = $commentBody;

	        $post->comments()->save($comment);

	        // $comment->save();
	        // dd($comment);

        	$post->postable->notify(new Commented($comment));

        	if ($request->ajax())
	        {
	            return Response()->json([
	                'commentData' => View('user.ajax.comment.commentSingle', array('comment'=>$comment))->render(),
	                'comments' => $post->comments->count()
	            ]);
	        }
    	}

        
 
            return back();
 
    }
}
