<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Notifications\Commented;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    	public function itemDelete(Request $request)
	{
		$type = $request->type;
		$id = $request->id;

		if($type == 'comment')
		{
			$comment = Comment::findOrFail($request->id);

			// dd($comment);

			if($comment)
			{

				$commentable = $comment->commentable; //post or spread or ..
		        if($comment->hasDeletePermission())
		        {

		        	if($comment->isOfPost())
			        {
			       
			            $comment->commentable->postable->notifications()
			            ->where('type', 'App\Notifications\Commented')
		                ->whereJsonContains('data->comment_id', $comment->id)
		                ->whereJsonContains('data->commentable_id', $comment->commentable_id)
		                ->delete();
			            $comment->commentable->postable->touchMainsDecrement();

			            $comment->likes()->delete();
			        }

 
		            $comment->delete();

		             

		            if ($request->ajax())
		            {
		                return Response()->json([
		                    // 'commentArea' => View('user.ajaxBlades.commentAreaPost', array('post' => $post))->render(),
		                    'success' => true,
		                    'comments' => $commentable->comments->count()
		                ]);
		            }
		            return back();
		        }
		        else
		        {
		            if ($request->ajax())
		            {
		                return Response()->json([
		                    // 'commentArea' => View('user.ajaxBlades.commentAreaPost', array('post' => $post))->render(),
		                    'success' => false,
		                    'comments' => $commentable->comments->count()
		                ]);
		            }
		            return back();
		        }

			}

		}
		

		return back();
	}
}
