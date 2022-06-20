<?php

namespace App\Http\Controllers\User\Like;

use Auth;
use Validator;
use App\Models\Like;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Notifications\Liked;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    // public function likeCreateForPost(Request $request, Post $post)
    // {
    //     $choice = $request->choice;
    //     $postOwner = $post->addedBy;

    //    $like = $post->likes()
    //     ->where('user_id', $request->user()->id)
    //     ->firstOrNew([]);

    //     $like->choice = $choice;
    //     $like->likedBy()->associate($request->user());
    //     if($like->id)
    //     {
    //         $like->delete();

    //         $ntfy = $post->notification()
    //         ->where([
    //             'notifyby_id' => $request->user()->id,
    //             'notifyby_type' => 'App\Model\User'
    //             ])->orderBy('id', 'desc')->first();
    //         if($ntfy)
    //         {
    //             if($ntfy->created_at == $ntfy->updated_at)
    //             {
    //                 $post->notification()
    //                 ->where([
    //                     'notifyby_id' => $request->user()->id,
    //                     'notifyby_type' => 'App\Model\User'
    //                     ])->orderBy('id', 'desc')->delete();
    //                 $postOwner->touchMainsDecrement();
    //             }
    //         }


    //         if($request->ajax())
    //         {
    //             return Response()->json([
    //                 'likeArea' => View('user.ajaxBlades.likeAreaPost', array('post' => $post))->render(),
    //                 'likes' => $post->likes->count()
    //             ]);
    //         }
    //         return back();
    //     }

    //     $like->save();


    //     $ntfy = $post->notification()
    //     ->where([
    //         'notifyto_id' => $postOwner->id,
    //         'notifyto_type' => 'App\Model\User'
    //         ])->first();
    //     if($ntfy)
    //     {
    //         $post->notification()
    //         ->where([
    //         'notifyto_id' => $postOwner->id,
    //         'notifyto_type' => 'App\Model\User'
    //         ])->update([]);
    //     }
    //     else
    //     {
    //         $ntfy = $post->notification()->create([]);
    //         $ntfy->description = 'created';
    //         $postOwner->notifyTo()->save($ntfy);
    //         $request->user()->notifyBy()->save($ntfy);
    //         $postOwner->touchMainsIncrement();
    //     }

    //     if($request->ajax())
    //     {
    //         return Response()->json([
    //                 'likeArea' => View('user.ajaxBlades.likeAreaPost', array('post' => $post))->render(),
    //                 'likes' => $post->likes->count()
    //             ]);
    //     }
    //     else
    //     {
    //         return back();
    //     }

    // }
    
    public function likeCreate(Request $request)
    {

        $type = $request->type;
        $id = $request->id;

        if($type == 'post')
        {
            $post = Post::findOrFail($id);

            if($l = $post->isLikedByMe())
            {
                $a = $post->postable->notifications()
                ->where('type', 'App\Notifications\Liked')
                ->whereJsonContains('data->like_id', $l->id)
                ->whereJsonContains('data->likeable_id', $post->id)
                ->delete();

                $l->delete();

                $post->postable->touchMainsDecrement();
                
            }
            else
            {

                $like = new Like;
                $like->likeable_id = $post->id;
                $like->likeable_type = Post::class;
                $like->user_id = Auth::id();
                $like->save();
                // dd($post->postable);
                $post->postable->notify(new Liked($like));



                //or
                //Notification::send($users, new PostLiked($like));
            }

            if ($request->ajax()) 
            {
                return Response()->json([
                   'likeArea' => View('user.ajax.like.postLikeArea', [
                'post'=>$post])->render(),
                ]);
            }

        }


        if($type == 'comment')
        {

            $comment = Comment::findOrFail($id);

            if($l = $comment->isLikedByMe())
            {
                $a = $comment->addedBy->notifications()
                ->where('type', 'App\Notifications\Liked')
                ->whereJsonContains('data->like_id', $l->id)
                ->whereJsonContains('data->likeable_id', $comment->id)
                ->delete();

                $l->delete();

                $comment->addedBy->touchMainsDecrement();
                
            }
            else
            {

                $like = new Like;
                $like->likeable_id = $comment->id;
                $like->likeable_type = Comment::class;
                $like->user_id = Auth::id();
                $like->save();
                // dd($post->postable);
                $comment->addedBy->notify(new Liked($like));



                //or
                //Notification::send($users, new PostLiked($like));
            }

            if ($request->ajax()) 
            {
                return Response()->json([
                   'likeArea' => View('user.ajax.like.likeAreaForComment', [
                'comment'=>$comment])->render(),
                ]);
            }

        }

        

        return back();
    }

    public function likers(Request $request)
    {
        $type = $request->type;
        $id = $request->id;

        if($request->ajax())
        {
            if($type == 'post')
            {
                return Response()->json(view('user.ajax.modals.myModalLikes',[
                'post'=> Post::findOrFail($id)
                ])->render());
            }
            
        }

        return back();
    }
}
