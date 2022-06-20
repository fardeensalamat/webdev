<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use Cache;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Model\Post;
use App\Models\Media;
use GuzzleHttp\Client;
use App\Model\Company;
use App\Model\Order;
use App\Model\UserRole;
use App\Models\Category;
use App\Model\Subcategory;
use App\Model\PostCategory;
use App\Model\PostSubcat;
use App\Model\TakenPackage;
use App\Model\OrderItem;
use App\Model\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Model\CreditTransaction;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;


class AdminPostController extends Controller
{

    public function categoriesAll(Request $request)
    {
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'news','lsbsm'=>'categoriesAll']);

        $cats = Category::orderBy('drag_id')->get();
        return view('admin.categories.categoriesAll',['cats'=>$cats]);
    }

    public function categoryAddNewPost(Request $request){
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
          'category'=> 'required|min:2|max:100'
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }

        $cat = new Category;
        
        $cat->name = $request->category;
        $cat->description = $request->description;

        $cat->featured = $request->featured ? 1 : 0;
        $cat->addedby_id = $request->user()->id;
        $cat->save();

        // $cat->drag_id = $cat->id;
        
        


        if($cp = $request->banner)
        {
             $extension = strtolower($cp->getClientOriginalExtension());
             $randomFileName = $cat->id.'_banner_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('public')->put('product/media/category/'.$randomFileName, File::get($cp));
        
        $cat->banner_name = $randomFileName;

        }

        if($cp = $request->image)
        {
             $extension = strtolower($cp->getClientOriginalExtension());
             $randomFileName = $cat->id.'_img_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('public')->put('product/media/category/'.$randomFileName, File::get($cp));
        
            $cat->img_name = $randomFileName;

        } 

        $cat->save();

        Cache::flush();

        return back()->withInput()->with('success', 'New Category Successfully Created.');
    }

    public function categoryEdit(Category $cat, Request $request)
    {
        if($request->ajax())
        {
            return Response()->json(View('admin.categories.ajax.catTbodyEdit',[
                'cat' => $cat,
            ])->render());
        }

        return view('admin.categories.categoryEdit',[
            'category' => $cat
        ]);
    }

    public function categoryUpdate(Category $cat, Request $request)
    {
        $validation = Validator::make($request->all(),
        [ 
            'name'=> 'required|min:2|max:100|unique:categories,title',
        ]);
        if($validation->fails())
        {
            return Response()->json(View('admin.categories.ajax.catTable',[
                'cat' => $cat,
            ])->render());
        }

        $name = $request->name;
        $cat_old_name = $cat->title;
        $cat->title = $name ?: $cat_old_name;
        $cat->editedby_id = Auth::id();
        $cat->save();

        Cache::flush();

        if($request->ajax())
        {
            return Response()->json(View('admin.categories.ajax.catTable',[
                'cat' => $cat,
            ])->render());
        }

        

        return back();
    }

    public function categoryDelete(Category $cat, Request $request)
    {
        $cat->posts()->detach();

        foreach ($cat->subcats as $subcat) 
        {
            $subcat->posts()->detach();    
        }
        $cat->subcats()->delete();
        $cat->delete();

        Cache::flush();

        if($request->ajax())
        {
            return Response()->json(['success'=>true]);
        }

        

        return back();
    }


    public function catSort(Request $request)
    {
        foreach($request->sorted_data as $key => $value)
        {
            $cat = Category::where('id', $value)->first();
            $cat->drag_id = $key;
            $cat->editedby_id = Auth::id();
            $cat->save();

        }
        if($request->ajax())
        {
            return Response()->json([
            'success'=>true,
            ]);
        }
        
        return back();
    }

    public function subcatAddNew(Category $cat, Request $request)
    {
        $validation = Validator::make($request->all(),
        [ 
            'name'=> 'required|min:2|max:100|unique:subcategories,title',
        ]);
        if($validation->fails())
        {
            return Response()->json(View('admin.categories.ajax.catTable',[
                'cat' => $cat,
            ])->render());
        }

        $subcat = new Subcategory;
        $subcat->category_id = $cat->id;
        $subcat->title = $request->name ?: null;
        $subcat->addedby_id = Auth::id();
        $subcat->editedby_id = Auth::id();
        $subcat->save();

        Cache::flush();

        if($request->ajax())
        {
            return Response()->json(View('admin.categories.ajax.subcatTable',[
                'cat' => $cat,
            ])->render());
        }

        

        return back();
    }

    public function subcatDelete(Subcategory $subcat, Request $request)
    {
        $subcat->posts()->detach();
        $subcat->delete();

        Cache::flush();

        if($request->ajax())
        {
            return Response()->json(['success'=>true]);
        }

        

        return back();
        
    }

//category and subcat end



//posts
    public function postAddNew(Request $request)
    {
        $type = $request->type;
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'news','lsbsm'=>'postAddNew']);

        $post = Post::where('publish_status', 'temp')->first();
        $cats = Category::all();
        $mediaAll = Media::latest()->paginate(200);
        if(!$post)
        {
            $post = new Post;
            $post->addedby_id = Auth::id();
            $post->save();
        }
        return view('admin.posts.postAddNew',[
            'post'=>$post,
            'cats'=>$cats,
            'mediaAll'=>$mediaAll,
            'type' => $type
        ]);
    }
}
