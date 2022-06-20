<?php

namespace App\Http\Controllers\Newsfeed;

use Auth;
Use Alert;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Post;
use App\Models\PostFile;
use App\Models\Subscriber;
use App\Models\Category;
use App\Models\WorkStation;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class NewsfeedController extends Controller
{
    public function newsfeed()
    {
        menuSubmenu('newsfeed','newsfeed');

        $workstations = WorkStation::all();
        
        $me = Auth::user();
        $mysubscribe = Subscriber::where('user_id',$me->id)->groupBy('work_station_id')->get();

        $post = Auth::user()->posts()->where('publish_status', 'temp')->first();
        if(!$post)
        {
            $post = new post;
            $post->addedby_id = Auth::id();
            $post->postable_id = Auth::id();
            $post->postable_type = User::class;
            $post->save();
        }

        $allPosts = Post::where('publish_status','published')->latest()->simplePaginate(12);

        return view('newsfeed.home',[
            'workstations' => $workstations,
            'post' => $post,
            'allPosts' => $allPosts,
            'mysubscribe' => $mysubscribe
        ]);
    }

    public function detailsPost(Post $post)
    {
        $workstations = WorkStation::all();

        if($post->wscat)
        {
            menuSubmenu("ws{$post->workstation_id}", "cat{$post->ws_cat_id}");
        }
        elseif($post->workstation)
        {
            menuSubmenu("ws{$post->workstaion_id}", "allnews");
        }
        
        return view('newsfeed.detailsPost', [
            'post'=> $post,
            'workstations' => $workstations
        ]);
    }

    public function getCategoryByWorkstation(WorkStation $workstaion)
    {
        $cat = $workstaion->categories()->whereIn('id', Auth::user()->myWsCatIds($workstaion))->get();

        return $cat;
    }

    public function allnews(WorkStation $workstation)
    {
        $workstations = WorkStation::all();
        $post = Post::where('publish_status','temp')->latest()->first();
        
        $me = Auth::user();
        $mysubscribe = Subscriber::where('user_id',$me->id)
        ->where('work_station_id',$workstation->id)
        ->groupBy('work_station_id')
        ->get();
        // dd($mysubscribe);
        if(!$post)
        {
            $post = new post;
            $post->addedby_id = Auth::id();
            $post->save();
        }
        $allPosts = Post::where('publish_status','published')
        ->where('workstation_id',$workstation->id)
        ->latest()->simplePaginate(12);

        menuSubmenu("ws{$workstation->id}", "allnews");


        return view('newsfeed.workstation.home',[
            'workstations' => $workstations,
            'post' => $post,
            'workstation' => $workstation,
            'allPosts' => $allPosts,
            'mysubscribe' => $mysubscribe
        ]);
    }

    public function workstationCategoryNews(WorkStation $workstation, Category $cat)
    {
        $workstations = WorkStation::all();
        
        $me = Auth::user();
        $mysubscribe = Subscriber::where('user_id',$me->id)
        ->where('work_station_id',$workstation->id)
        ->groupBy('work_station_id')
        ->get();

        $post = Post::where('publish_status','temp')->latest()->first();
        if(!$post)
        {
            $post = new post;
            $post->addedby_id = Auth::id();
            $post->save();
        }
        $allPosts = Post::where('publish_status','published')
        ->where('workstation_id',$workstation->id)->where('ws_cat_id',$cat->id)
        ->latest()->simplePaginate(12);
        
         menuSubmenu("ws{$workstation->id}", "cat{$cat->id}");

        return view('newsfeed.category.home',[
            'workstations' => $workstations,
            'post' => $post,
            'workstation' => $workstation,
            'allPosts' => $allPosts,
            'category' => $cat,
            'mysubscribe' => $mysubscribe
 
        ]);
    }

    public function updatePost(Post $post, Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
            'description' => 'required',
            'workstation' => 'required',
            'category' => 'required'
        ]);

        if($validation->fails())
        {
            Alert::error('Error', 'Description or workstation or category can not be empty.');
            return back()->withInput();
        }
        $post->postable_id = Auth::id();
        
        $post->postable_type = User::class;
        $post->addedby_id = Auth::id();
        $post->title = $request->title ?: null;
        $post->excerpt = $request->excerpt ?: null;
        $post->description = $request->description ? ltrim($request->description) : null;
        $post->publish_status = 'draft';
        $post->workstation_id = $request->workstation;
        $post->ws_cat_id = $request->category;

        $post->save();
     
        if($request->hasFile('images'))
        {
            foreach($request->file('images') as $ffile)
            {
                $fimgExt = strtolower($ffile->getClientOriginalExtension());
                $fimgOriginalName = $ffile->getClientOriginalName();
                $fimgMime = $ffile->getClientMimeType();   
                
                $fimgsize = $ffile->getSize();                
                $fimageNewName = 'oti_'.Str::random(8).time().'.'.$fimgExt;
                

                Storage::disk('public')->put('post/'.$fimageNewName, File::get($ffile));

                
                
                $pf = new PostFile;
                $pf->post_id = $post->id;
                $pf->file_name = $fimageNewName;
                $pf->original_name = $fimgOriginalName;
                $pf->file_mime  = $fimgMime;
                $pf->file_size = $fimgsize;
                $pf->file_ext = $fimgExt;

                $ft = '';
                if(($fimgExt == 'gif') or 
                    ($fimgExt == 'jpeg') or 
                    ($fimgExt == 'jpg') or 
                    ($fimgExt == 'png') or 
                    ($fimgExt == 'bmp') or 
                    ($fimgExt == 'webp'))
                {
                    $ft = 'image';
                }

                if(($fimgExt == 'doc') or 
                    ($fimgExt == 'docx'))
                {
                    $ft = 'doc';
                }

                if(($fimgExt == 'mp4') or 
                    ($fimgMime == 'video/mpeg') or
                    ($fimgExt == 'avi') or
                    ($fimgExt == 'ogg'))
                {
                    $ft = 'video';
                }

                 
                if($fimgMime == 'application/pdf')
                {
                    $ft = 'pdf';
                }

                 

                if(($fimgMime == 'audio/mpeg') or 
                    ($fimgExt == 'mp3') or 
                    ($fimgMime == 'audio/wav'))
                {
                    $ft = 'audio';
                }

                $pf->file_type = $ft;

                $pf->save(); 
            }
            // $ffile = $request->image;
                       
        }

        $post->publish_status = 'published';
        $post->created_at = now();
        $post->addedby_id = Auth::id();
        $post->save();
        Alert::success('Posted', 'Your status successfully posted.');
        return back();
    }

    public function updateWorkStationPost(WorkStation $workstation, Post $post)
    {
        
        $request = request();
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
            'description' => 'required',
            'category' => 'required',
        ]);

        if($validation->fails())
        {
            Alert::error('Error', 'Description or Category can not be empty.');
            return back()->withInput();
        }
        $post->postable_id = Auth::id();
        
        $post->postable_type = User::class;
        $post->addedby_id = Auth::id();
        $post->title = $request->title ?: null;
        $post->excerpt = $request->excerpt ?: null;
        $post->description = $request->description ? ltrim($request->description) : null;
        $post->publish_status = 'draft';
        $post->workstation_id = $workstation->id;
        $post->ws_cat_id = $request->category;
        
        $post->save();
     
        if($request->hasFile('images'))
        {
            foreach($request->file('images') as $ffile)
            {
                $fimgExt = strtolower($ffile->getClientOriginalExtension());
                $fimgOriginalName = $ffile->getClientOriginalName();
                $fimgMime = $ffile->getClientMimeType();   
                
                $fimgsize = $ffile->getSize();
                
                $fimageNewName = 'oti_'.Str::random(8).time().'.'.$fimgExt;
                

                Storage::disk('public')->put('post/'.$fimageNewName, File::get($ffile));
                
                $pf = new PostFile;
                $pf->post_id = $post->id;
                $pf->file_name = $fimageNewName;
                $pf->original_name = $fimgOriginalName;
                $pf->file_mime  = $fimgMime;
                $pf->file_size = $fimgsize;
                $pf->file_ext = $fimgExt;

                // if($fimgMime == 'image/gif' or $fimgMime == 'image/png' or $fimgMime == 'image/jpeg' or $fimgMime == 'image/bmp')
                // {
                //     $pf->file_type = 'image';
                // }
                // if($fimgExt == 'docx')
                // {
                //     $pf->file_type = 'docx';
                // }
                // if($fimgMime == 'application/octet-stream' or  $fimgExt = 'mp4')
                // {
                //     $pf->file_type = 'video';
                // }

                // if($fimgMime == 'application/pdf')
                // {
                //     $pf->file_type = 'pdf';
                // }

                // if($fimgMime == 'audio/mpeg')
                // {
                //     $pf->file_type = 'audio';
                // }

                // $pf->save(); 
                // 
                $ft = '';
                if(($fimgExt == 'gif') or 
                    ($fimgExt == 'jpeg') or 
                    ($fimgExt == 'jpg') or 
                    ($fimgExt == 'png') or 
                    ($fimgExt == 'bmp') or 
                    ($fimgExt == 'webp'))
                {
                    $ft = 'image';
                }

                if(($fimgExt == 'doc') or 
                    ($fimgExt == 'docx'))
                {
                    $ft = 'doc';
                }

                if(($fimgExt == 'mp4') or 
                    ($fimgMime == 'video/mpeg') or
                    ($fimgExt == 'avi') or
                    ($fimgExt == 'ogg'))
                {
                    $ft = 'video';
                }

                 
                if($fimgMime == 'application/pdf')
                {
                    $ft = 'pdf';
                }

                 

                if(($fimgMime == 'audio/mpeg') or 
                    ($fimgExt == 'mp3') or 
                    ($fimgMime == 'audio/wav'))
                {
                    $ft = 'audio';
                }

                $pf->file_type = $ft;

                $pf->save(); 
            }
            // $ffile = $request->image;
                       
        }

        $post->publish_status = 'published';
        $post->created_at = now();

        $post->save();
        Alert::success('Posted', 'Your status successfully posted.');
        return back();
    }

    public function updateWorkStationCategory(WorkStation $workstation,Category $cat,Post $post)
    {
        $request = request();
        
        $validation = Validator::make($request->all(),
        [
            'description' => 'required',
        ]);

        if($validation->fails())
        {
            Alert::error('Error', 'Description can not be empty.');

            return back()->withInput();
        }
        $post->postable_id = Auth::id();
        
        $post->postable_type = User::class;
        $post->addedby_id = Auth::id();
        $post->title = $request->title ?: null;
        $post->excerpt = $request->excerpt ?: null;
        $post->description = $request->description ? ltrim($request->description) : null;
        $post->publish_status = 'draft';
        $post->workstation_id = $workstation->id;
        $post->ws_cat_id = $cat->id;
        $post->save();
     
        if($request->hasFile('images'))
        {
            foreach($request->file('images') as $ffile)
            {
                $fimgExt = strtolower($ffile->getClientOriginalExtension());
                $fimgOriginalName = $ffile->getClientOriginalName();
                $fimgMime = $ffile->getClientMimeType();   
                
                $fimgsize = $ffile->getSize();
                
                $fimageNewName = 'oti_'.Str::random(8).time().'.'.$fimgExt;
                

                Storage::disk('public')->put('post/'.$fimageNewName, File::get($ffile));
                
                $pf = new PostFile;
                $pf->post_id = $post->id;
                $pf->file_name = $fimageNewName;
                $pf->original_name = $fimgOriginalName;
                $pf->file_mime  = $fimgMime;
                $pf->file_size = $fimgsize;
                $pf->file_ext = $fimgExt;

                // if($fimgMime == 'image/gif' or $fimgMime == 'image/png' or $fimgMime == 'image/jpeg' or $fimgMime == 'image/bmp')
                // {
                //     $pf->file_type = 'image';
                // }
                // if($fimgExt == 'docx')
                // {
                //     $pf->file_type = 'docx';
                // }
                // if($fimgMime == 'application/octet-stream' or  $fimgExt = 'mp4')
                // {
                //     $pf->file_type = 'video';
                // }

                // if($fimgMime == 'audio/mpeg')
                // {
                //     $pf->file_type = 'audio';
                // }

                // if($fimgMime == 'application/pdf')
                // {
                //     $pf->file_type = 'pdf';
                // }

                // $pf->save(); 
            
            $ft = '';
                if(($fimgExt == 'gif') or 
                    ($fimgExt == 'jpeg') or 
                    ($fimgExt == 'jpg') or 
                    ($fimgExt == 'png') or 
                    ($fimgExt == 'bmp') or 
                    ($fimgExt == 'webp'))
                {
                    $ft = 'image';
                }

                if(($fimgExt == 'doc') or 
                    ($fimgExt == 'docx'))
                {
                    $ft = 'doc';
                }

                if(($fimgExt == 'mp4') or 
                    ($fimgMime == 'video/mpeg') or
                    ($fimgExt == 'avi') or
                    ($fimgExt == 'ogg'))
                {
                    $ft = 'video';
                }

                 
                if($fimgMime == 'application/pdf')
                {
                    $ft = 'pdf';
                }

                 

                if(($fimgMime == 'audio/mpeg') or 
                    ($fimgExt == 'mp3') or 
                    ($fimgMime == 'audio/wav'))
                {
                    $ft = 'audio';
                }

                $pf->file_type = $ft;

                $pf->save(); 

            }
            // $ffile = $request->image;
                       
        }

        $post->publish_status = 'published';
        $post->created_at = now();

        $post->save();
        Alert::success('Posted', 'Your status successfully posted.');
        return back();
    }

    public function delete(Post $post, Request $request)
    {
       if($post->hasDeletePermission())
       {
            $postFile = PostFile::where('post_id',$post->id)->get();

            
            foreach($postFile as $file)
            {
                $f = 'post/'.$file->file_name;
                if(Storage::disk('public')->exists($f))
                {
                    Storage::disk('public')->delete($f);
                }
                $file->delete();
            }

            $post->comments()->delete();
            $post->views()->delete();
            
            $post->delete();

            Alert::success('Posted', 'Post Successfully Deleted.');

            return back();
       }
       else
       {
            Alert::error('Error', 'Someting went to wrong.');
            return back();
       }

       
    }
}
