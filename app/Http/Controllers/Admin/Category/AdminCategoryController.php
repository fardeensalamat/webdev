<?php

namespace App\Http\Controllers\Admin\Category;

use DB;
use Auth;
use Cache;

use Validator;
use App\Models\ServiceProfileInfo;
use Carbon\Carbon;
use App\Models\User;
use App\Model\Post;
use App\Models\Media;
use App\Models\Category;
use App\Models\WorkStation;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;

class AdminCategoryController extends Controller
{
    public function addNewCategory(WorkStation $workstation)
    {
        if(!Auth::user()->hasPermission('workstation'))
        {
            abort(401);
        }
        menuSubmenu('category','category');

        $categories=Category::where('work_station_id',$workstation->id)->latest()->paginate(300);

        return view('admin.categories.addNewCategory',[
            'categories' => $categories,
            'workstation' => $workstation
        ]);
    }

    public function addNewCategoryPost(WorkStation $workstation,Request $request)
    {

        $validation = Validator::make($request->all(),
        [
            'name'=> 'required|min:2|max:100',
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }
        $cat = new Category;
        $cat->name = $request->name;
        $cat->description = $request->description;
        $cat->work_station_id = $workstation->id;
        $cat->active = $request->active ? 1 : 0;
        $cat->featured = $request->featured ? 1 : 0;
        $cat->editedby_id = Auth::id();

        $cat->save();

        if($cp = $request->banner)
        {
            $f = 'media/category/banner/'.$cat->banner_name;
            if(Storage::disk('public')->exists($f))
            {
                Storage::disk('public')->delete($f);
                $cat->media()->where('collection_name', 'category_banner')->delete();
            }

            list($width,$height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size =$cp->getSize();

             $extension = strtolower($cp->getClientOriginalExtension());
             $originalName = strtolower($cp->getClientOriginalName());
             $randomFileName = $cat->id.'_banner_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('public')->put('media/category/banner/'.$randomFileName, File::get($cp));

            $file_new_url = 'storage/media/category/banner/'.$randomFileName;
            $media = new Media;
            $media->file_name  = $randomFileName;
            $media->file_original_name  = $originalName;
            $media->file_mime  = $mime;
            $media->file_ext  = $extension;
            $media->file_size  = $size;
            $media->file_type  = 'image';
            $media->width  = $width;
            $media->height  = $height;
            $media->file_url  = $file_new_url;
            $media->addedby_id  = Auth::id();
            $media->editedby_id  = null;
            $media->collection_name  = 'category_banner';
            // $media->disk  = 'public';
            $cat->media()->save($media);

            $cat->banner_name = $randomFileName;

        }

        if($cp = $request->image)
        {
            $f = 'media/category/image/'.$cat->img_name;
            if(Storage::disk('public')->exists($f))
            {
                Storage::disk('public')->delete($f);
                $cat->media()->where('collection_name', 'category_image')->delete();
            }
            list($width,$height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size =$cp->getSize();

            $extension = strtolower($cp->getClientOriginalExtension());
            $originalName = strtolower($cp->getClientOriginalName());
            $randomFileName = $cat->id.'_img_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('public')->put('media/category/image/'.$randomFileName, File::get($cp));

            $file_new_url = 'storage/media/category/image/'.$randomFileName;

            $media = new Media;
            $media->file_name  = $randomFileName;
            $media->file_original_name  = $originalName;
            $media->file_mime  = $mime;
            $media->file_ext  = $extension;
            $media->file_size  = $size;
            $media->file_type  = 'image';
            $media->width  = $width;
            $media->height  = $height;
            $media->file_url  = $file_new_url;
            $media->addedby_id  = Auth::id();
            $media->editedby_id  = null;
            $media->collection_name  = 'category_image';
            // $media->disk  = 'public';
            $cat->media()->save($media);

            $cat->img_name = $randomFileName;

        }

        $cat->save();

        Cache::flush();

        if($request->ajax())
        {
            return Response()->json([
                'success' => true,
                'page'=> View('admin.categories.includes.forms.categorySingleForm',[
                    'cat' => $cat,
                ])->render()
            ]);
        }


        return back()->with('success','Category Successfully Added.');
    }

    public function categoryEdit(Category $cat)
    {
        menuSubmenu('category','category');
        $serviceProfileInfos = ServiceProfileInfo::where('type','business')
        ->where('category_id', $cat->id)
        ->orderBy('id','desc')->get();
        $profileProfileInfos = ServiceProfileInfo::where('type','personal')->orderBy('id','desc')
        ->where('category_id', $cat->id)
        ->get();

        return view('admin.categories.editCategories',[
            'cat' => $cat,
            'serviceProfileInfos' => $serviceProfileInfos,
            'profileProfileInfos' => $profileProfileInfos
        ]);
    }

    public function categoryUpdatePost(Category $cat, Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
            'name'=> 'required|min:2|max:100',
            'service_product_commission'=> 'min:1|max:100|numeric'
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }

        $cat->name = $request->name;
        $cat->work_station_id = $cat->work_station_id;
        $cat->description = $request->description;
        $cat->service_product_commission = $request->service_product_commission;
        $cat->active = $request->active ? 1 : 0;
        $cat->featured = $request->featured ? 1 : 0;

        // $cat->sp_title = $request->sp_title;
        // $cat->sp_description = $request->sp_description;
        // $cat->sp_header_bg_color = $request->sp_header_bg_color;
        // $cat->sp_header_text_color = $request->sp_header_text_color;
        // $cat->sp_footer_bg_color = $request->sp_footer_bg_color;
        // $cat->sp_footer_text_color = $request->sp_footer_text_color;
        // $cat->sp_body_bg_color = $request->sp_body_bg_color;
        // $cat->sp_body_text_color = $request->sp_body_text_color;
        // $cat->sp_full_price = $request->sp_full_price;
        // $cat->sp_short_price =  $request->sp_short_price;
        // $cat->sp_active = $request->sp_active ? 1 : 0;
        // $cat->sp_create_charge = $request->sp_create_charge? : 0;
        // $cat->sp_chat = $request->sp_chat ? 1 : 0;
        // $cat->sp_review = $request->sp_review ? 1 : 0;
        // $cat->sp_featured = $request->sp_featured ? 1 : 0;
        // $cat->sp_location = $request->sp_location ? 1 : 0;

        $cat->editedby_id = Auth::id();
        $cat->save();

        if($cp = $request->banner)
        {
            $f = 'media/category/banner/'.$cat->banner_name;
            if(Storage::disk('public')->exists($f))
            {
                Storage::disk('public')->delete($f);
                $cat->media()->where('collection_name', 'category_banner')->delete();
            }

            list($width,$height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size =$cp->getSize();

             $extension = strtolower($cp->getClientOriginalExtension());
             $originalName = strtolower($cp->getClientOriginalName());
             $randomFileName = $cat->id.'_banner_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('public')->put('media/category/banner/'.$randomFileName, File::get($cp));

            $file_new_url = 'storage/media/category/banner/'.$randomFileName;
            $media = new Media;
            $media->file_name  = $randomFileName;
            $media->file_original_name  = $originalName;
            $media->file_mime  = $mime;
            $media->file_ext  = $extension;
            $media->file_size  = $size;
            $media->file_type  = 'image';
            $media->width  = $width;
            $media->height  = $height;
            $media->file_url  = $file_new_url;
            $media->addedby_id  = Auth::id();
            $media->editedby_id  = null;
            $media->collection_name  = 'category_banner';
            // $media->disk  = 'public';
            $cat->media()->save($media);

            $cat->banner_name = $randomFileName;

        }

        if($cp = $request->image)
        {
            $f = 'media/category/image/'.$cat->img_name;
            if(Storage::disk('public')->exists($f))
            {
                Storage::disk('public')->delete($f);
                $cat->media()->where('collection_name', 'category_image')->delete();
            }
            list($width,$height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size =$cp->getSize();

            $extension = strtolower($cp->getClientOriginalExtension());
            $originalName = strtolower($cp->getClientOriginalName());
            $randomFileName = $cat->id.'_img_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('public')->put('media/category/image/'.$randomFileName, File::get($cp));

            $file_new_url = 'storage/media/category/image/'.$randomFileName;

            $media = new Media;
            $media->file_name  = $randomFileName;
            $media->file_original_name  = $originalName;
            $media->file_mime  = $mime;
            $media->file_ext  = $extension;
            $media->file_size  = $size;
            $media->file_type  = 'image';
            $media->width  = $width;
            $media->height  = $height;
            $media->file_url  = $file_new_url;
            $media->addedby_id  = Auth::id();
            $media->editedby_id  = null;
            $media->collection_name  = 'category_image';
            // $media->disk  = 'public';
            $cat->media()->save($media);

            $cat->img_name = $randomFileName;

        }

        $cat->save();

        Cache::flush();

        if($request->ajax())
        {
            return Response()->json([
                'success' => true,
                'page'=> View('admin.categories.includes.forms.categorySingleForm',[
                    'cat' => $cat,
                ])->render()
            ]);
        }


        return back()->with('success','Category Update Successfully.');
    }

    public function updatePersonalProfilePost(Category $cat, Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'pp_title'=> 'required|min:2|max:100',
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }

        $cat->pp_title = $request->pp_title;
        $cat->pp_description = $request->pp_description;
        $cat->pp_header_bg_color = $request->pp_header_bg_color;
        $cat->pp_header_text_color = $request->pp_header_text_color;
        $cat->pp_footer_bg_color = $request->pp_footer_bg_color;
        $cat->pp_footer_text_color = $request->pp_footer_text_color;
        $cat->pp_body_bg_color = $request->pp_body_bg_color;
        $cat->pp_body_text_color = $request->pp_body_text_color;
        // $cat->pp_full_price = $request->sp_full_price;
        // $cat->pp_short_price =  $request->sp_short_price;
        $cat->pp_active = $request->pp_active ? 1 : 0;
        // $cat->pp_create_charge = $request->sp_create_charge? : 0;
        $cat->pp_chat = $request->pp_chat ? 1 : 0;
        $cat->pp_review = $request->pp_review ? 1 : 0;
        $cat->pp_featured = $request->pp_featured ? 1 : 0;
        $cat->pp_location = $request->pp_location ? 1 : 0;

        $cat->editedby_id = Auth::id();
        $cat->save();
        return back()->with('success','Category Update Successfully.');
    }

    public function categoryBusinessProfileUpdatePost(Category $cat, Request $request)
    {
        // dd($request->sp_short_p_view_btn_txt);
        $validation = Validator::make($request->all(),
        [
            'sp_title'=> 'required|min:2|max:100',
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }
        
        $cat->sp_title = $request->sp_title;
        $cat->sp_description = $request->sp_description;
        $cat->sp_header_bg_color = $request->sp_header_bg_color;
        $cat->sp_header_text_color = $request->sp_header_text_color;
        $cat->sp_footer_bg_color = $request->sp_footer_bg_color;
        $cat->sp_footer_text_color = $request->sp_footer_text_color;
        $cat->sp_body_bg_color = $request->sp_body_bg_color;
        $cat->sp_body_text_color = $request->sp_body_text_color;
        $cat->sp_full_price = $request->sp_full_price;
        $cat->sp_short_price =  $request->sp_short_price;
        $cat->sp_full_price_owner_com =  $request->sp_full_price_owner_com??0;
        $cat->sp_short_price_owner_com =  $request->sp_short_price_owner_com??0;
        $cat->sp_short_p_view_btn_txt =  $request->sp_short_p_view_btn_txt;
        $cat->sp_full_p_view_btn_txt =  $request->sp_full_p_view_btn_txt;
        $cat->sp_active = $request->sp_active ? 1 : 0;
        $cat->sp_create_charge = $request->sp_create_charge? : 0;
        $cat->sp_adtopup_bonus= $request->sp_adtopup_bonus? : 0;
        $cat->sp_chat = $request->sp_chat ? 1 : 0;
        $cat->sp_review = $request->sp_review ? 1 : 0;
        $cat->sp_featured = $request->sp_featured ? 1 : 0;
        $cat->sp_location = $request->sp_location ? 1 : 0;
        $cat->sp_bidding = $request->sp_bidding ? 1 : 0;
        $cat->sp_order = $request->sp_order ? 1 : 0;
        $cat->business_type = $request->business_type;

        $cat->editedby_id = Auth::id();
        $cat->save();
        return back()->with('success','Category Update Successfully.');

    }

    public function serviceProfileInfo(Category $cat, Request $request)
    {
        // dd($request->all());
        // dd($cat);
        $validation = Validator::make($request->all(),
        [
            'profile_key_info'=> 'required',
            'access_type' => 'required',
            'field_type' => 'required'
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }
        $workstation_id = $cat->workstation;
        // dd($workstation_id->id);
        $serviceProfileInfo = new ServiceProfileInfo;
        $serviceProfileInfo->type = 'business';
        $serviceProfileInfo->work_station_id = $workstation_id->id;
        $serviceProfileInfo->category_id = $cat->id;
        $serviceProfileInfo->profile_info_key = $request->profile_key_info;
        $serviceProfileInfo->field_type = $request->field_type;
        $serviceProfileInfo->access_type = $request->access_type;
        $serviceProfileInfo->active = $request->active_sp_info ? 1 : 0 ;
        $serviceProfileInfo->profile_card_display = $request->profile_card_display ? 1 : 0;
        // dd($serviceProfileInfo);
        $serviceProfileInfo->save();

        return back()->with('success','Service Profile Information Added Successfully.');
    }

    public function personalProfileInfo(Category $cat, Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'profile_key_info'=> 'required',
            'access_type' => 'required',
            'field_type' => 'required'
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }
        $workstation_id = $cat->workstation;
        // dd($workstation_id->id);
        $serviceProfileInfo = new ServiceProfileInfo;
        $serviceProfileInfo->type = 'personal';
        $serviceProfileInfo->work_station_id = $workstation_id->id;
        $serviceProfileInfo->category_id = $cat->id;
        $serviceProfileInfo->profile_info_key = $request->profile_key_info;
        $serviceProfileInfo->field_type = $request->field_type;
        $serviceProfileInfo->access_type = $request->access_type;
        $serviceProfileInfo->active = $request->active_sp_info ? 1 : 0 ;
        $serviceProfileInfo->profile_card_display = $request->profile_card_display ? 1 : 0;
        // dd($serviceProfileInfo);
        $serviceProfileInfo->save();

        return back()->with('success','Service Profile Information Added Successfully.');
    }

    public function serviceProfileInfosEdit(ServiceProfileInfo $serviceProfileInfo,Request $request)
    {
        // dd($serviceProfileInfo);

        return view('admin.categories.serviceProfileInfosEdit',[
            'serviceProfileInfo' => $serviceProfileInfo
        ]);
    }
    public function serviceProfileInfoUpdate(ServiceProfileInfo $serviceProfileInfo,Request $request)
    {

        $serviceProfileInfo->profile_info_key = $request->profile_key_info;

        if(($request->field_type == 'string') or ($request->field_type == 'text') or ($request->field_type == 'integer') or ($request->field_type == 'float') )
        {
            $serviceProfileInfo->field_type = $request->field_type;
        }

        $serviceProfileInfo->access_type = $request->access_type;
        $serviceProfileInfo->active = $request->active_sp_info ? 1 : 0 ;
        $serviceProfileInfo->profile_card_display = $request->profile_card_display ? 1 : 0;
        // dd($serviceProfileInfo);
        $serviceProfileInfo->save();

        return back()->with('success','Service Profile Information Added Successfully.');
    }

    public function serviceProfileInfosDelete(ServiceProfileInfo $serviceProfileInfo)
    {
        $serviceProfileInfo->infoValues()->delete();
        $serviceProfileInfo->delete();

        return back()->with('warning','Service Profile Information Deleted Successfully.');

    }

    public function categoryDelete($catagory){

        $cat =Category::find($catagory);
        if(!$cat){
        Session()->flash('error','Category Are Not found');
        return redirect()->route('admin.categoryAll');
        }

        $f = 'media/category/banner/'.$cat->banner_name;

        if(Storage::disk('upload')->exists($f))
        {
            Storage::disk('upload')->delete($f);
            $cat->media()->where('collection_name', 'category_banner')->delete();
        }

        $g = 'media/category/image/'.$cat->img_name;
        if(Storage::disk('upload')->exists($g))
        {
            Storage::disk('upload')->delete($g);
            $cat->media()->where('collection_name', 'category_image')->delete();

        }

        $cat->delete();

        return back()->with('success', 'Category successfully Deleted');

    }

    public function addNewSubategory()
    {
        menuSubmenu('subcategory','subcategory');

        $categories=Category::where('active',true)->latest()->paginate(30);
        $subcategories=Subcategory::latest()->paginate(30);

        return view('admin.subcategories.addNewsubategory',[
            'categories' => $categories,
            'subcategories' => $subcategories
        ]);
    }

    public function addsubcategoryPost(WorkStation $workstation)
    {

        $request = request();
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
            'name'=> 'required|min:2|max:100',
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }
        $category = Category::find($request->category);
        $subcategory = new Subcategory;

        $subcategory->title = $request->name;
        $subcategory->category_id = $request->category;
        $subcategory->work_station_id = $workstation->id;
        $subcategory->description = $request->description;
        $subcategory->active = $request->active ? 1 : 0;
        // $subcategory->featured = $request->featured ? 1 : 0;
        $subcategory->addedby_id = Auth::id();

        $subcategory->save();

        // if($cp = $request->banner)
        // {
        //     $f = 'media/subcategory/banner/'.$subcategory->banner_name;
        //     if(Storage::disk('public')->exists($f))
        //     {
        //         Storage::disk('public')->delete($f);
        //         $subcategory->media()->where('collection_name', 'category_banner')->delete();
        //     }

        //     list($width,$height) = getimagesize($cp);
        //     $mime = $cp->getClientOriginalExtension();
        //     $size =$cp->getSize();

        //      $extension = strtolower($cp->getClientOriginalExtension());
        //      $originalName = strtolower($cp->getClientOriginalName());
        //      $randomFileName = $subcategory->id.'_banner_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

        //     Storage::disk('public')->put('media/subcategory/banner/'.$randomFileName, File::get($cp));

        //     $file_new_url = 'storage/media/subcategory/banner/'.$randomFileName;
        //     $media = new Media;
        //     $media->file_name  = $randomFileName;
        //     $media->file_original_name  = $originalName;
        //     $media->file_mime  = $mime;
        //     $media->file_ext  = $extension;
        //     $media->file_size  = $size;
        //     $media->file_type  = 'image';
        //     $media->width  = $width;
        //     $media->height  = $height;
        //     $media->file_url  = $file_new_url;
        //     $media->addedby_id  = Auth::id();
        //     $media->editedby_id  = null;
        //     $media->collection_name  = 'subcategory_banner';
        //     // $media->disk  = 'public';
        //     $subcategory->media()->save($media);

        //     $subcategory->banner_name = $randomFileName;

        // }

        // if($cp = $request->image)
        // {
        //     $f = 'media/subcategory/image/'.$subcategory->img_name;
        //     if(Storage::disk('public')->exists($f))
        //     {
        //         Storage::disk('public')->delete($f);
        //         $subcategory->media()->where('collection_name', 'category_image')->delete();
        //     }
        //     list($width,$height) = getimagesize($cp);
        //     $mime = $cp->getClientOriginalExtension();
        //     $size =$cp->getSize();

        //     $extension = strtolower($cp->getClientOriginalExtension());
        //     $originalName = strtolower($cp->getClientOriginalName());
        //     $randomFileName = $subcategory->id.'_img_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

        //     Storage::disk('public')->put('media/subcategory/image/'.$randomFileName, File::get($cp));

        //     $file_new_url = 'storage/media/subcategory/image/'.$randomFileName;

        //     $media = new Media;
        //     $media->file_name  = $randomFileName;
        //     $media->file_original_name  = $originalName;
        //     $media->file_mime  = $mime;
        //     $media->file_ext  = $extension;
        //     $media->file_size  = $size;
        //     $media->file_type  = 'image';
        //     $media->width  = $width;
        //     $media->height  = $height;
        //     $media->file_url  = $file_new_url;
        //     $media->addedby_id  = Auth::id();
        //     $media->editedby_id  = null;
        //     $media->collection_name  = 'subcategory_image';
        //     // $media->disk  = 'public';
        //     $subcategory->media()->save($media);

        //     $subcategory->img_name = $randomFileName;

        // }

        // $subcategory->save();

        Cache::flush();
        if($request->ajax())
        {
          return Response()->json([
            'success' => true,
            'page'=>View('admin.categories.ajax.subcatTable',[
                'workstation' => $workstation,
                'category' => $category
            ])->render(),
          ]);


        }
        return back()->with('success','Subcategory Successfully Added.');
    }

    public function subcategoryEdit(Subcategory $subcat, Request $request)
    {

        $categories=Category::all();
        // dd($categories);
        return view('admin.subcategories.editSubcategories',[
            'cat' => $subcat,
            'categories' => $categories
        ]);
    }

    public function subcategoryUpdatePost(Subcategory $subcat, Request $request)
    {


        $validation = Validator::make($request->all(),
        [
            'name'=> 'required|min:2|max:100',
        ]);

        if($validation->fails())
        {

            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }

        $subcat->title = $request->name;
        $subcat->work_station_id = $subcat->work_station_id;

        $subcat->category_id = $request->category;
        $subcat->description = $request->description;
        $subcat->active = $request->active ? 1 : 0;
        $subcat->featured = $request->featured ? 1 : 0;
        $subcat->editedby_id = Auth::id();

        $subcat->save();

        if($cp = $request->banner)
        {
            $f = 'media/subcategory/banner/'.$subcat->banner_name;
            if(Storage::disk('public')->exists($f))
            {
                Storage::disk('public')->delete($f);
                $subcat->media()->where('collection_name', 'subcategory_banner')->delete();
            }

            list($width,$height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size =$cp->getSize();

             $extension = strtolower($cp->getClientOriginalExtension());
             $originalName = strtolower($cp->getClientOriginalName());
             $randomFileName = $subcat->id.'_banner_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('public')->put('media/subcategory/banner/'.$randomFileName, File::get($cp));

            $file_new_url = 'storage/media/subcategory/banner/'.$randomFileName;
            $media = new Media;
            $media->file_name  = $randomFileName;
            $media->file_original_name  = $originalName;
            $media->file_mime  = $mime;
            $media->file_ext  = $extension;
            $media->file_size  = $size;
            $media->file_type  = 'image';
            $media->width  = $width;
            $media->height  = $height;
            $media->file_url  = $file_new_url;
            $media->addedby_id  = Auth::id();
            $media->editedby_id  = null;
            $media->collection_name  = 'subcategory_banner';
            // $media->disk  = 'public';
            $subcat->media()->save($media);

            $subcat->banner_name = $randomFileName;

        }

        if($cp = $request->image)
        {
            $f = 'media/subcategory/image/'.$subcat->img_name;
            if(Storage::disk('public')->exists($f))
            {
                Storage::disk('public')->delete($f);
                $subcat->media()->where('collection_name', 'subcategory_image')->delete();
            }
            list($width,$height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size =$cp->getSize();

            $extension = strtolower($cp->getClientOriginalExtension());
            $originalName = strtolower($cp->getClientOriginalName());
            $randomFileName = $subcat->id.'_img_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('public')->put('media/subcategory/image/'.$randomFileName, File::get($cp));

            $file_new_url = 'storage/media/subcategory/image/'.$randomFileName;

            $media = new Media;
            $media->file_name  = $randomFileName;
            $media->file_original_name  = $originalName;
            $media->file_mime  = $mime;
            $media->file_ext  = $extension;
            $media->file_size  = $size;
            $media->file_type  = 'image';
            $media->width  = $width;
            $media->height  = $height;
            $media->file_url  = $file_new_url;
            $media->addedby_id  = Auth::id();
            $media->editedby_id  = null;
            $media->collection_name  = 'subcategory_image';
            // $media->disk  = 'public';
            $subcat->media()->save($media);

            $subcat->img_name = $randomFileName;

        }

        $subcat->save();

        Cache::flush();

        return back()->with('success','Subcategory Update Successfully.');
    }


    public function subcategoryDelete($subcatagory)
    {
        $cat =Subcategory::find($subcatagory);
        if(!$cat){
        Session()->flash('error','Subcategory Are Not found');
        return redirect()->route('admin.categoryAll');
        }

        $f = 'media/subcategory/banner/'.$cat->banner_name;

        if(Storage::disk('upload')->exists($f))
        {
            Storage::disk('upload')->delete($f);
            $cat->media()->where('collection_name', 'subcategory_banner')->delete();
        }

        $g = 'media/subcategory/image/'.$cat->img_name;
        if(Storage::disk('upload')->exists($g))
        {
            Storage::disk('upload')->delete($g);
            $cat->media()->where('collection_name', 'subcategory_image')->delete();

        }

        $cat->delete();

        return back()->with('success', 'Subcategory successfully Deleted');

    }
}
