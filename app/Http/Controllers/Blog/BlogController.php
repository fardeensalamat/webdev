<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Validator;

use function PHPSTORM_META\type;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->type == 'blog') {
            $blogs = Blog::where('type', 'blog')
                ->where('publish_status', 'published')
                ->orderBy('id', 'DESC')
                ->paginate(6);
            $categories = BlogCategory::all();
            $tags = BlogTag::latest();
            return view('blog.blog', compact('blogs', 'categories', 'tags'));
        } elseif ($request->type == 'event') {
            $events = Blog::where('type', 'event')
                ->where('publish_status', 'published')
                ->orderBy('id', 'DESC')
                ->paginate(9);
            return view('blog.event', compact('events'));
        } elseif ($request->type == 'news') {
            $news = Blog::where('type', 'news')
                ->where('publish_status', 'published');
            $cats = BlogCategory::whereHas('posts', function ($q) {
                $q->where('publish_status', 'published');
                $q->where('type', 'news');
            })->get();
            $tags= BlogTag::orderBy('id','DESC')->take(10)->get();
            // return $tags;
            return view('blog.news', compact('news', 'cats','tags'));
        } else {
            return back();
        }
    }
    public function blogDetails(Request $request)
    {
        $blog = Blog::find($request->blog);
        if (!$blog) {
            return back();
        }
        return view('blog.blogDetails', compact('blog'));
    }
    public function eventDetails(Request $request)
    {
        $event = Blog::where('id', $request->event)->where('type', 'event')->first();
        if (!$event) {
            return back();
        }
        return view('blog.eventDetails', compact('event'));
    }

    public function newsDetails(Request $request)
    {
        $news = Blog::where('id', $request->news)->where('type', 'news')->first();
        if (!$news) {
            return back();
        }
        return view('blog.newsDetails', compact('news'));
    }
    public function catWiseNews(Request $request)
    {
        $cat = BlogCategory::where('id', $request->cat)->first();
        if (!$cat) {
            return back();
        }
        $categories = BlogCategory::whereHas('posts', function ($q) {
            $q->where('publish_status', 'published');
            $q->where('type', 'news');
        })->get();
        return view('blog.catWiseNews', compact('cat', 'categories'));
    }
    public function catWiseBlog(Request $request)
    {
        $cat = BlogCategory::where('id', $request->cat)->first();
        if (!$cat) {
            return back();
        }

        $categories = BlogCategory::whereHas('posts', function ($q) {
            $q->where('publish_status', 'published');
            $q->where('type', 'blog');
        })->get();

        $data = BlogCategory::whereHas('posts', function ($q) {
            $q->where('publish_status', 'published');
            $q->where('type', 'blog');
        })->get();
        return view('blog.catWiseBlog', compact('cat', 'categories'));
    }

    /// For User 
    public function selectTagsOrAddNew(Request $request)
    {
        $tags = BlogTag::where('name', 'like', '%' . $request->q . '%')
            ->select(['name'])->take(30)->get();
        if ($tags->count()) {
            if ($request->ajax()) {
                return $tags;
            }
        } else {
            if ($request->ajax()) {
                return $tags;
            }
        }
    }

    public function addNewBlog(Request $request)
    {
        $tags = BlogTag::latest();
        $cats = BlogCategory::all();
        return view('blog.addNewBlog', compact('tags', 'cats'));
    }
    public function storeNewBlogFromUser(Request $request)
    {

        if (!Auth::check()) {
            $validation = Validator::make(
                $request->all(),
                [
                    'name' => ['required', 'string', 'max:255', 'min:3'],
                    'email' => ['required', 'string', 'email', 'unique:users', 'max:255'],
                    'mobile' => ['required', 'string'],
                    'password' => ['required', 'string', 'min:6', 'confirmed'],
                    'active' => ['nullable'],
                    'type' => ['required'],
                    'title' => ['required'],
                    'description' => ['required'],
                    'excerpt' => ['required'],
                    'tags' => ['required'],
                    'categories' => ['required'],
                    'feature_image' => ['required']

                ]
            );

            if ($validation->fails()) {

                return back()
                    ->withInput()
                    ->withErrors($validation);
            }
            if (($request->except) and (strlen($request->excerpt)  > 240)) {
                return redirect()->back()->with('error', 'Excerpt must be less then 240 character');
            }
            if ($request->hasFile('feature_image')) {
                $os = array("png", "jpg", "jpeg", "gif");
                $ffile = $request->feature_image;
                $fimgExt = strtolower($ffile->getClientOriginalExtension());
                if (!in_array($fimgExt, $os)) {
                    return back()->with('error', 'Sorry, you did not upload image file in image field/. Please upload png, jpg, jpeg or gift File');
                }
            }

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = bdMobileWithCode($request->mobile);
            $user->password_temp = $request->password;
            $user->password = $request->password ? Hash::make($request->password) : $user->password;
            $user->active = $request->active ? true : false;
            $user->addedby_id = Auth::id()??null;
            $user->save();
            if ($request->tags) {
                foreach ($request->tags as $tag) {
                    $t = BlogTag::where('name', $tag)->first();
                    if (!$t) {
                        $t = new BlogTag;
                        $t->name = $tag;
                        $t->save();
                    }
                }
            }
            $blog = new Blog;
            $blog->title = $request->title ?: null;
            $blog->description = $request->description ?: null;
            $blog->excerpt = $request->excerpt ?: null;
            $blog->publish_status = 'pending';
            $blog->type = $request->type;
            $blog->user_id = $user->id;
            $blog->addedby_id = $user->id;
            if ($request->tags) {
                $blog->tags = implode(', ', $request->tags);
            } else {
                $blog->tags = null;
            }
            if ($request->hasFile('feature_image')) {
                $f = 'blog/' . $blog->feature_image;
                if (Storage::disk('public')->exists($f)) {
                    Storage::disk('public')->delete($f);
                }
                $ffile = $request->feature_image;
                $fimgExt = strtolower($ffile->getClientOriginalExtension());
                $fimageNewName = time() . '.' . $fimgExt;
                $originalName = $ffile->getClientOriginalName();
                Storage::disk('public')->put('blog/' . $fimageNewName, File::get($ffile));
                $blog->feature_img_name = $fimageNewName;
            }
            $blog->save();
            $blog->blogCategories()->detach();
            if ($request->categories) {
                foreach ($request->categories as $cat) {
                    $c = PostCategory::where('category_id', $cat)->where('post_id', $blog->id)->first();
                    if (!$c) {
                        $c = new PostCategory;
                        $c->category_id = $cat;
                        $c->post_id = $blog->id;
                        $c->addedby_id = $user->id;
                        $c->save();
                    }
                }
            }
            return redirect()->back()->with('success', 'Your blog is Pending. Please Wait for Approved or Contact with Admin');
        }


        $me = Auth::user();
        $validation = Validator::make(
            $request->all(),
            [
                'type' => ['required'],
                'title' => ['required'],
                'description' => ['required'],
                'excerpt' => ['required'],
                'tags' => ['required'],
                'categories' => ['required'],
                'feature_image' => ['required']

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }
        if (($request->except) and (strlen($request->excerpt)  > 240)) {
            return redirect()->back()->with('error', 'Excerpt must be less then 240 character');
        }
        if ($request->hasFile('feature_image')) {
            $os = array("png", "jpg", "jpeg", "gif");
            $ffile = $request->feature_image;
            $fimgExt = strtolower($ffile->getClientOriginalExtension());
            if (!in_array($fimgExt, $os)) {
                return back()->with('error', 'Sorry, you did not upload image file in image field/. Please upload png, jpg, jpeg or gift File');
            }
        }
        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $t = BlogTag::where('name', $tag)->first();
                if (!$t) {
                    $t = new BlogTag;
                    $t->name = $tag;
                    $t->save();
                }
            }
        }
        $blog = new Blog;
        $blog->title = $request->title ?: null;
        $blog->description = $request->description ?: null;
        $blog->excerpt = $request->excerpt ?: null;
        $blog->publish_status = 'pending';
        $blog->type = $request->type;
        $blog->user_id = $me->id;
        $blog->addedby_id = $me->id;
        if ($request->tags) {
            $blog->tags = implode(', ', $request->tags);
        } else {
            $blog->tags = null;
        }
        if ($request->hasFile('feature_image')) {
            $f = 'blog/' . $blog->feature_image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $ffile = $request->feature_image;
            $fimgExt = strtolower($ffile->getClientOriginalExtension());
            $fimageNewName = time() . '.' . $fimgExt;
            $originalName = $ffile->getClientOriginalName();
            Storage::disk('public')->put('blog/' . $fimageNewName, File::get($ffile));
            $blog->feature_img_name = $fimageNewName;
        }
        $blog->save();
        $blog->blogCategories()->detach();
        if ($request->categories) {
            foreach ($request->categories as $cat) {
                $c = PostCategory::where('category_id', $cat)->where('post_id', $blog->id)->first();
                if (!$c) {
                    $c = new PostCategory;
                    $c->category_id = $cat;
                    $c->post_id = $blog->id;
                    $c->addedby_id = Auth::id();
                    $c->save();
                }
            }
        }
        return redirect()->back()->with('success', 'Your blog is Pending. Please Wait for Approved or Contact with Admin. Login Now with your phone number and password');
    }
    public function tagWisePost(Request $request)
    {
  
        $type= $request->type;
        $tags= BlogTag::orderBy('id','DESC')->take(20)->get();
        $tag= $request->title;
        if ($type== 'news') {
            // return "Hewllo";
            $posts= Blog::where('tags','like','%' . $request->title . '%')
            ->where('type','news')
            ->where('publish_status','published')
            ->paginate(10);
            
        }if ($type== 'blog') {
            $posts= Blog::where('tags','like','%' . $request->title . '%')
            ->where('type','blog')
            ->where('publish_status','published')
            ->paginate(10);
            // return "OK";
        }
        if ($type== 'event') {
            $posts= Blog::where('tags','like','%' . $request->title . '%')
            ->where('type','event')
            ->where('publish_status','published')
            ->paginate(10);
           
        }

        return view('blog.part.tagwisePost',compact('type','tags','posts','tag'));
    }
    public function blogSearch(Request $request)
    {
       if ($request->type == 'blog') {
           $data= Blog::where('title','like','%'.$request->q.'%')
           ->orWhere('tags','like','%' . $request->q . '%')
           ->where('type','blog')
           ->where('publish_status','published')
           ->orWhereHas('blogCategories',function($q) use ($request){
               $q->where('name','like','%' . $request->q . '%');
           })
           ->latest()
           ->paginate();
           $type = "Blog";
           $search= $request->q;
       }
       if ($request->type == 'news') {
        $data= Blog::where('title','like','%'.$request->q.'%')
        ->orWhere('tags','like','%' . $request->q . '%')
        ->where('type','news')
        ->where('publish_status','published')
        ->orWhereHas('blogCategories',function($q) use ($request){
            $q->where('name','like','%' . $request->q . '%');
        })
        ->latest()
        ->paginate();
        $type = "News";
        $search= $request->q;
    }
    if ($request->type == 'event') {
        // return "EVENT";
        $data= Blog::where('title','like','%'.$request->q.'%')
        ->where('type','event')
        ->orWhere('tags','like','%' . $request->q . '%')
        ->orWhere('description','like','%' . $request->q . '%')
        ->where('publish_status','published')
        // ->orWhereHas('blogCategories',function($q) use ($request){
        //     $q->where('name','like','%' . $request->q . '%');
        // })
        ->latest()
        ->paginate();
        $type = "Event";
        $search= $request->q;
    }
       return view('blog.search',compact('data','type','search'));
    }
    
}
