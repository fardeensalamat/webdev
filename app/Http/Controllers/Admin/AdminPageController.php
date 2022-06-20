<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Page;
use App\Models\MenuPage;
use App\Models\Media;
use App\Models\Menu;
use App\Models\PageItem;
use App\Models\Slider;
use GuzzleHttp\Client; 
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\WebsiteParameter;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

class AdminPageController extends Controller
{
     
//pages
    
    public function pageAddNewPost(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
            'page_title' => 'required|max:50|string',
            'route_name' => 'required|max:50|string',
        ]);
        if($validation->fails())
        {
            return back()->withErrors($validation)
            ->withInput()
            ->with('error', 'Something went wrong.');
        }

 
        $page = new Page;
        $page->page_title = $request->page_title;
        $page->title_hide = $request->title_hide ? 1 : 0;
        $page->active = $request->active ? 1 : 0;
        $page->list_in_menu = $request->list_in_menu ? 1 : 0;
        $page->route_name = $request->route_name ? Str::of($request->route_name)->snake()  : null;
        // $page->addedby_id = Auth::id();
        $page->addedby_id = 1;
        // dd($request->menus);
        
        $page->save();
        if(isset($request->menus))
        {
            foreach($request->menus as $menu)
            {
                $c = MenuPage::where('menu_id',$menu)
                ->where('page_id',$page->id)
                ->first();
                if(!$c)
                {
                   $c = new MenuPage;
                   $c->menu_id = $menu;
                   $c->page_id = $page->id;
                   $c->addedby_id = Auth::id();
                // $c->addedby_id = 1;
                   $c->save();
                }
            }
        }

        return back()->with('success', 'New Page Created Successfully!');
    }

    public function webParams()
    {
        
        menuSubmenu('dashboard','webparameter');

        $post = WebsiteParameter::latest()->first();
        return view('admin.websiteParameters',[
            'post'=> $post,
        ]);
    }

    public function webParamsSave(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [ 

            'meta_keyword' => 'max:255',

        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Worng!');
        }
        $request = request();
        $post = WebsiteParameter::firstOrCreate([]);


        $post->recharge_permission= $request->recharge_permission?'online':'manual';

        $post->title = $request->title;
        $post->payment_no = $request->payment_no;  //got Errror. because there are no payment_no colunmn in website_parameter table
        $post->short_title = $request->short_title;
        $post->h1 = $request->h1;
        $post->welcome_page_msg = $request->welcome_page_msg;
        $post->user_page_msg = $request->user_page_msg;
        $post->freelancer_msg = $request->freelancer_msg;
        $post->google_analytics_code = $request->google_analytics_code;
        $post->facebook_pixel_code = $request->facebook_pixel_code;
        $post->meta_author = $request->meta_author;
        $post->meta_keyword = $request->meta_keyword;
        $post->meta_description = $request->meta_description;
        $post->slogan = $request->slogan;
        $post->footer_address = $request->footer_address;
        $post->footer_copyright = $request->footer_copyright;
        $post->addthis_url = $request->addthis_url;
        $post->fb_page_link = $request->fb_url;

        $post->youtube_url = $request->youtube_url;
        
        $post->notice_one = $request->notice_one;
        $post->notice_two = $request->notice_two;
        $post->notice_three = $request->notice_three;
        $post->connecting_friends_notice = $request->connecting_friends_notice;
        // dd($post);
        $post->job_post_instraction = $request->job_post_instraction;
        $post->contact_mobile = $request->contact_mobile;
        $post->contact_email = $request->contact_email;
        // $post->linkedin_url = $request->linkedin_url;
        $post->twitter_url = $request->twitter_url;
        // $post->pinterest_url = $request->pinterest_url;
        // $post->youtube_url = $request->youtube_url;
        // $post->google_plus_url = $request->google_plus_url;
        // $post->google_map_code = $request->google_map_code;
        // $post->main_color = $request->main_color ?: 'default';
        // $post->sub_color = $request->sub_color ?: 'default';
        // $post->header_bg_color = $request->header_bg_color ?: 'default';
        // $post->header_text_color = $request->header_text_color ?: 'default';
        // $post->footer_bg_color = $request->footer_bg_color ?: 'default';
        // $post->footer_text_color = $request->footer_text_color ?: 'default';

        if($request->favicon)
        {
            $file = $request->favicon;
            Storage::disk('upload')->delete('favicon/'.$post->favicon);

            $originalName = $file->getClientOriginalName();
            Storage::disk('upload')->put('favicon/'.$originalName, File::get($file));
            $post->favicon = $originalName;
        }

        if($request->logo)
        {
            $file = $request->logo;
            Storage::disk('upload')->delete('logo/'.$post->logo);

            $originalName = $file->getClientOriginalName();
            Storage::disk('upload')->put('logo/'.$originalName, File::get($file));
            $post->logo = $originalName;
        }
        if($request->logo_alt)
        {
            $file = $request->logo_alt;
            Storage::disk('upload')->delete('logo/'.$post->logo_alt);

            $originalName = $file->getClientOriginalName();
            Storage::disk('upload')->put('logo/'.$originalName, File::get($file));
            $post->logo_alt = $originalName;
        }

        // if($request->android_apk)
        // {
        //     $apk = $request->android_apk;
        //     Storage::disk('upload')->delete('apk/'.$post->android_apk);

        //     $on = $apk->getClientOriginalName();
        //     Storage::disk('upload')->put('apk/'.$on, File::get($apk));
        //     $post->android_apk = $on;
        // }

        $post->save();

        Cache::forget('websiteParameter');

        return back()->with('success', 'Website Parameter Successfully Updated.');
    }

    public function pagesAll(Request $request)
    {
        // $request->session()->forget(['lsbm','lsbsm']);
        // $request->session()->put(['lsbm'=>'page','lsbsm'=>'pagesAll']);
        menuSubmenu('page','pagesAll');
        $pages = Page::orderBy('drag_id')->paginate(50);
        $menus = Menu::orderBy('menu_title')->get();

        return view('admin.pages.pagesAll', [
            'pages'=> $pages,
            'menus'=> $menus,
        
        ]);
    }

    public function newMenu(Request $request)
    {
        if(!Auth::user()->hasPermission('page'))
        {
            abort(401);
        }
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'page','lsbsm'=>'newMenu']);
        return view('admin.pages.newMenu');
    }

    public function newMenuPost(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'menu_title' => 'required|max:250|string',
            'menu_type' => 'required|max:50|string',
        ]);
        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something went wrong.');
        }

        $menu = new Menu;
        $menu->menu_title = $request->menu_title;
        $menu->menu_type = $request->menu_type;
        $menu->addedby_id = $request->user()->id;
        $menu->save();


        // Cache::forget('key');
        Cache::flush();

        return back()->with('success', 'New menu successfully created.');
    }

    public function allMenus()
    {
        if(!Auth::user()->hasPermission('page'))
        {
            abort(401);
        }
        $request = request();
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'page','lsbsm'=>'allMenus']);
        $menus = Menu::orderby('id','desc')->get();
        // dd($menus);
        return view('admin.pages.allMenus',['menus'=>$menus]);
    }

    public function menuDelete(Menu $menu, Request $request)
    {
        if(!Auth::user()->hasPermission('page'))
        {
            abort(401);
        }
        $menu->delete();

        Cache::flush();

        return back()->with('success', 'Menu successfully deleted.');
    }

    public function pageSort(Request $request)
    {
        foreach($request->sorted_data as $key => $value)
        {
            $cat = Page::where('id', $value)->first();
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

    public function pageEdit(Request $request, Page $page)
    {
        if(!Auth::user()->hasPermission('page'))
        {
            abort(401);
        }
        $menus = Menu::orderBy('menu_title')->get();
        

        return view('admin.pages.pageEdit', ['page'=> $page,
        'menus'=> $menus,]);
    }

    public function pageEditPost(Request $request, Page $page)
    {
        $validation = Validator::make($request->all(),
        [
            'page_title' => 'required|max:50|string',
            'route_name' => 'required|max:50|string',
        ]);
        if($validation->fails())
        {
            return back()->withErrors($validation)
            ->withInput()
            ->with('error', 'Something went wrong.');
        }

        $page->page_title = $request->page_title;
        $page->title_hide = $request->title_hide ? 1 : 0;
        $page->active = $request->active ? 1 : 0;
        $page->list_in_menu = $request->list_in_menu ? 1 : 0;
        $page->route_name = $request->route_name ? Str::of($request->route_name)->snake()  : null;
        $page->editedby_id = Auth::id();
        $page->save();
        $page->menus()->detach();
        if(isset($request->menus))
        {
            foreach($request->menus as $menu)
            {
                $c = MenuPage::where('menu_id',$menu)->where('page_id',$page->id)->first();
                if(!$c)
                {
                   $c = new MenuPage;
                   $c->menu_id = $menu;
                   $c->page_id = $page->id;
                   $c->addedby_id = Auth::id();
                   $c->save();
                }
            }
        }

        return back()->with('success', 'Page Updated Successfully!');
    }

    public function pageDelete(Request $request, Page $page)
    {
        $page->items()->delete();
        $page->delete();

        return back()->with('success', 'Page Deleted Successfully');
    }

    public function pageItems(Request $request, Page $page)
    {
        $mediaAll = Media::latest()->paginate(200);
        return view('admin.pages.pageItems', [
            'page'=> $page,
            'mediaAll' => $mediaAll
        ]);
    }

    public function pageItemAddPost(Request $request, Page $page)
    {
        $validation = Validator::make($request->all(),
        [
            'title' => 'required|max:50|string',
            'description' => 'required|max:60000|string',
        ]);
        if($validation->fails())
        {
            return back()->withErrors($validation)
            ->withInput()
            ->with('error', 'Something went wrong.');
        }

        $item = new PageItem;
        $item->page_id = $page->id;
        $item->title = $request->title ?: null;
        $item->content = $request->description ?: null;
        $item->editor = $request->editor ? 1 : 0;
        $item->active = $request->active ? 1 : 0;
        $item->addedby_id = Auth::id();
        $item->save();
 

        return back()->with('success', 'Page Item Created Successfully!');
    }

    public function pageItemDelete(Request $request, PageItem $item)
    {
        $item->delete();

        return back()->with('success', 'Part of the Page Deleted Successfully');
    }

    public function pageItemEditEditor(Request $request, PageItem $item)
    {
        if($item->editor)
        {
            $item->editor = false;
        }
        else
        {
            $item->editor = true;
        }
        $item->save();

        return back();
    }

    public function pageItemEdit(Request $request, PageItem $item)
    {
        $mediaAll = Media::latest()->paginate(200);

        return view('admin.pages.pageItemEdit', [
            'it'=> $item,
            'page' => $item->page,
            'mediaAll' => $mediaAll
        ]);
    }

    public function pageItemUpdate(Request $request, PageItem $item)
    {
        $validation = Validator::make($request->all(),
        [
            'title' => 'required|max:50|string',
            'description' => 'required|max:60000|string',
        ]);
        if($validation->fails())
        {
            return back()->withErrors($validation)
            ->withInput()
            ->with('error', 'Something went wrong.');
        }

        $item->title = $request->title ?: null;
        $item->content = $request->description ?: null;
        $item->editor = $request->editor ? 1 : 0;
        $item->active = $request->active ? 1 : 0;
        $item->editedby_id = Auth::id();
        $item->save();
 

        return back()->with('success', 'Page Item Updated Successfully!');
    }


//pages


//media
    public function mediaAll(Request $request)
    {
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'media','lsbsm'=>'mediaAll']);
        $mediaAll = Media::latest()->paginate(50);
        return view('admin.media.mediaAll',['mediaAll'=>$mediaAll]);
    }

    public function mediaUploadPost(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [ 
            'files.*' => 'image'
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }

        if($request->hasFile('files'))
            {
                foreach($request->file('files') as $file)
                {
                    $originalName = $file->getClientOriginalName();
                    $ext = $file->getClientOriginalExtension();
                    $mime = $file->getClientMimeType();
                    $size =$file->getSize();
                    $fileNewName = str_random(4).date('ymds').'.'.$ext;
                    // $fileNewName = str_random(6).time().'.'.$ext;
                    // $fileNewName = Auth::id().'_'.date('ymdhis').'_'.rand(11,99).'.'.$ext;
                    list($width,$height) = getimagesize($file);                    

                    Storage::disk('upload')
                    ->put('media/image/'.$fileNewName, File::get($file));

                    $file_new_url = 'storage/media/image/'.$fileNewName;

                    $media = new Media;                    
                    $media->file_name = $fileNewName;
                    $media->file_original_name = $originalName;
                    $media->file_mime = $mime;
                    $media->file_ext = $ext;
                    $media->file_size = $size;
                    
                    $media->width = $width;
                    $media->height = $height;
                    $media->file_url = $file_new_url;
                    $media->addedby_id = Auth::id();
                    if($mime == 'image/gif' or $mime == 'image/png' or $mime == 'image/jpeg' or $mime == 'image/bmp')
                    {
                        $media->file_type = 'image';
                    }
                    //image/gif, image/png, image/jpeg, image/bmp, image/webp

                    $media->save();

                }
            }
        

        return back();
    }

    public function mediaDelete(Media $media,Request $request)
    {
        if($media->file_type == 'image')
        {
            Storage::disk('upload')->delete('media/image/'.$media->file_name);
            $media->delete();
        }

        return back()->with('info','Media successfully deleted.');
        
    }
//media
public function createslider()
{
    menuSubmenu('dashboard', 'slider');
    return view('admin.slider.create');
}
public function storeslider(Request $request)
{
    $request->validate([
        'title' => 'required',
        'image' => 'required',
    ]);
    $user = Auth::user();
    $data = new Slider;
    $data->title = $request->title;
    $data->description = $request->description;
    $data->linktitle = $request->linktitle;
    $data->link = $request->link;
    $data->uid =$user->id;

    $data->save();
  
    if ($pi = $request->image) {
        $f = 'slider/' . $data->image;
        if (Storage::disk('public')->exists($f)) {
            Storage::disk('public')->delete($f);
        }
        $extension = strtolower($pi->getClientOriginalExtension());
        $randomFileName = $data->id. '_sliderimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

        list($width, $height) = getimagesize($pi);
        $mime = $pi->getClientOriginalExtension();
        $size = $pi->getSize();

        $originalName = strtolower($pi->getClientOriginalName());

        Storage::disk('public')->put('slider/' . $randomFileName, File::get($pi));

        $data->image = $randomFileName;
        $data->save();
    }
   
   
    return redirect()->route('admin.listslider')->with('success', 'Slider Added Successfully');
    
}

public function deleteslider($id)
{
    $data = Slider::where('id',$id)->first();
    $f = 'slider/' . $data->image;
    if (Storage::disk('public')->exists($f)) {
        Storage::disk('public')->delete($f);
    }
    $data->delete();
    return redirect()->route('admin.listslider')->with('success', 'Slider Delete Successfully');
    
}
public function listslider()
{
    menuSubmenu('dashboard', 'slider');
    $user = Auth::user();
    $datas = Slider::latest()->paginate(20);

    return view('admin.slider.index', [
        'datas' => $datas
    ]);
}

public function editslider($id)
{
    menuSubmenu('dashboard', 'slider');
    $data = Slider::find($id);
  
    return view('admin.slider.edit',compact('data')); 
}

public function updateslider(Request $request)
{
    $request->validate([
        'title' => 'required',
    ]);
    $data = Slider::where('id',$request->id)->first();
    $data->title = $request->title;
    $data->description = $request->description;
    $data->linktitle = $request->linktitle;
    $data->link = $request->link;

    $data->save();
  
    if ($pi = $request->image) {
        $f = 'slider/' . $data->image;
        if (Storage::disk('public')->exists($f)) {
            Storage::disk('public')->delete($f);
        }
        $extension = strtolower($pi->getClientOriginalExtension());
        $randomFileName = $data->id. '_sliderimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

        list($width, $height) = getimagesize($pi);
        $mime = $pi->getClientOriginalExtension();
        $size = $pi->getSize();

        $originalName = strtolower($pi->getClientOriginalName());

        Storage::disk('public')->put('slider/' . $randomFileName, File::get($pi));

        $data->image = $randomFileName;
        $data->save();
    }
   
   
    return redirect()->route('admin.listslider')->with('success', 'Slider Update Successfully');
}



}
