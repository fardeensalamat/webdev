<?php

namespace App\Http\Controllers\Admin\Brand;


use DB;
use Auth;
use Str;
use Cache;
use Cookie;
use Validator;
use GuzzleHttp\Client;
use App\Models\Media;
use App\Models\ProductBrand;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use Intervention\Image\ImageManagerStatic as Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBrandController extends Controller
{
    public function addNewBrand(Request $request)
    {
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'product','lsbsm'=>'newBrand']);
        $brands = ProductBrand::latest()->paginate(100);
        return view('admin.brands.brandAddNew',[
            'brands' => $brands
        ]);
    }

    public function brandRearrange()
    {
        $brands = ProductBrand::orderBy('drag_id')->get();
        return view('admin.brands.brandRearrange',compact('brands'));
    }

    public function brandSort(Request $request)
    {
 
        foreach($request->sorted_data as $key => $value)
        {
            $brand = ProductBrand::where('id', $value)->first();
            $brand->drag_id = $key;
            $brand->editedby_id = Auth::id();
            $brand->save();
        }
            

        if($request->ajax())
        {
            return Response()->json([
            'success'=>true,
            ]);
        }
        return back();
    }

    public function brandPost(Request $request)
    {

        $validation = Validator::make($request->all(),
        [ 
            'title' => ['required', 'string', 'max:255','min:3'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'active' => ['nullable'],
            'featured' => ['nullable'],
            'image' => ['nullable'],
        ]);


        if($validation->fails())
        {
            if($request->ajax())
            {
                return Response()->json(array(
                    'success' => false,
                    'errors' => $validation->errors()->toArray(),
                    'sessionMessage' => 'Please, fillup the form correctly and try again.'
                ));
            }

            return back()
            ->withInput()
            ->withErrors($validation);
        }




        $brand = new ProductBrand;
 
        $brand->title = $request->title;
        $brand->meta_title = $request->meta_title ?: null;
        $brand->description = $request->description ?: null;
        $brand->active = $request->active ? 1 : 0;
        $brand->featured = $request->featured ? 1 : 0;

        $brand->addedby_id = Auth::id();

        $brand->save();

 

        if($cp = $request->image)
        {

            $f = 'media/brand/image/'.$brand->img_name;
            if(Storage::disk('public')->exists($f))
            {
                Storage::disk('public')->delete($f);
                $brand->media()->where('collection_name', 'brand_image')->delete();
            }  

            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $brand->id.'_img_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            list($width,$height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size =$cp->getSize();                    
            
            $originalName = strtolower($cp->getClientOriginalName());

            Storage::disk('public')->put('media/brand/image/'.$randomFileName, File::get($cp));
        
            $brand->img_name = $randomFileName;

            $file_new_url = 'storage/media/brand/image/'.$randomFileName;
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
            $media->collection_name  = 'brand_image';
            // dd($brand);
            $brand->media()->save($media);

        } 

        $brand->save();
        return back()->with('success', 'Product brand successfully created');
    }

    public function brandEdit($brand){
        $brand =ProductBrand::find($brand);
        if(!$brand){
        Session()->flash('error','Brand Are Not found');
        return redirect()->route('admin.sliderAll');
        }
        return view('admin.brands.brandEdit',compact('brand'));
    }

    public function brandUpdate(Request $request,$brand)
    {
        $brand =ProductBrand::find($brand);
        if(!$brand){
        Session()->flash('error','Brand Are Not found');
        return redirect()->route('admin.sliderAll');
        }
        
        $validation = Validator::make($request->all(),
        [ 
            'title' => ['required', 'string', 'max:255','min:3'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'active' => ['nullable'],
            'featured' => ['nullable'],
            'image' => ['nullable'],
        ]);



        if($validation->fails())
        {
            if($request->ajax())
            {
                return Response()->json(array(
                    'success' => false,
                    'errors' => $validation->errors()->toArray(),
                    'sessionMessage' => 'Please, fillup the form correctly and try again.'
                ));
            }

            return back()
            ->withInput()
            ->withErrors($validation);
        }
        $brand->title = $request->title;
        $brand->meta_title = $request->meta_title ?: null;
        $brand->description = $request->description ?: null;
        $brand->active = $request->active ? 1 : 0;
        $brand->featured = $request->featured ? 1 : 0;

        $brand->addedby_id = Auth::id();

        $brand->save();

 

        if($cp = $request->image)
        {

            list($width,$height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size =$cp->getSize();                    
            
            $originalName = strtolower($cp->getClientOriginalName());

             $extension = strtolower($cp->getClientOriginalExtension());
             $randomFileName = $brand->id.'_img_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('upload')->put('media/brand/image/'.$randomFileName, File::get($cp));
            
            $f = 'media/brand/image/'.$brand->img_name;
            
            if(Storage::disk('upload')->exists($f))
            {
                Storage::disk('upload')->delete($f);
                $brand->media()->where('collection_name', 'brand_image')->delete();
            }

            $brand->img_name = $randomFileName;


            $file_new_url = 'storage/media/brand/image/'.$randomFileName;
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
            $media->collection_name  = 'brand_image';
            // dd($brand);
            $brand->media()->save($media);
        } 
        $brand->save();
        return back()->with('success', 'Product brand successfully Updated');
    }

    public function brandDelete($brand)
    {
        $brand =ProductBrand::find($brand);

        if(!$brand){
        Session()->flash('error','Brand Are Not found');
        return redirect()->route('admin.sliderAll');
        }
        
        $f = 'media/brand/image/'.$brand->img_name;
        if(Storage::disk('public')->exists($f))
        {
            Storage::disk('public')->delete($f);
        }

        // DB::table('products')->where('brand_id', $brand->id)->update(['brand_id'=> null]);
        // DB::table('product_skus')->where('brand_id', $brand->id)->update(['brand_id'=> null]);

        $brand->delete();
       return back()->with('success', 'Product brand successfully Deleted'); 
        
    }
}
