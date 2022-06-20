<?php
namespace App\Http\Controllers\Admin\Product;

use Auth;
use Mail;
use Hash;
use Event;
use Cookie;
use Validator;
use App\Models\Product;
use App\Models\Agent;
use App\Models\Media;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class AdminProductImageController extends Controller
{
    public function __construct() 
    {
        // $this->middleware(['auth']); //middleware
    }
    public function productFeatureImageChange(Request $request,Product $product)
    {

        
        $validation = Validator::make($request->all(),
            ['profile_picture' => 'required|image|mimes:jpeg,bmp,png,gif,jpg'
        ]);
        
        if($validation->fails())
        {
            
            if($request->ajax())
            {
              return Response()->json([
                'page' => View('admin.products.ajax.productFeatureImg', ['product' => $product])
                                ->render(),
                'success' =>false,
                'errors' => $validation->getMessageBag()->toArray()
                ]);
            }
            return redirect()->back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'image must be at least 640px width and 640px height');
        }
        
        if($request->hasFile('profile_picture'))
        {
            
            $cp = $request->file('profile_picture');
            $cw= (int) $request->change_width;
            $ch = (int) $request->change_height;
            // dd($request->off_x);
            $x = $request->off_x > 0 ? (int) $request->off_x : 0;
            $y = $request->off_y > 0 ? (int) $request->off_y : 0;
            
            $extension = strtolower($cp->getClientOriginalExtension());
            
            $mime = $cp->getClientMimeType();
            // $size =$cp->getSize();
            $originalName = strtolower($cp->getClientOriginalName());
            $randomFileName = $product->id.'_lfi_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;
            
                $p = storage_path('/app/public/product/fi/'.$randomFileName);
                
                $image = Image::make($cp)
                ->crop($cw, $ch, $x, $y)
                ->resize(640, 640)
                ->save($p, 100);
                // dd($request->all());
                $size = $image->filesize();
                $width = $image->width();
                $height = $image->height();
               # $watermark = Image::make(public_path('/img/msbd3.png'));
               # $image->insert($watermark);
                // $image->insert($watermark, 'bottom-right', 10, 10);
                // $image->mask($watermark, true);
                // $image->fill($watermark, 0, 0);
                // $image->save(public_path().'/storage/users/pp/'.$randomFileName, 90);
                // $image->save();
                // dd($image);
                // $image = Image::make($image)
                // ->crop($cw, $ch, $x, $y)
                // ->resize(640, 640)
                // ->save($p, 100);
                // $originalWidth = $image->width();
                // $originalHeight = $image->height();
                // $image->destroy();
            // }
            #update old rows of profilepic
            // $oldRows = $user->userPictures()
            // ->whereImageType('profilepic')
            // ->whereAutoload(true)
            // ->update([
            //     'autoload'=>false, 
            //     'editedby_id' => Auth::id()
            // ]);
            #delete old rows of profilepic
            
            if($product->feature_img)
            {
                $f = 'product/fi/'.$product->feature_img;
                if(Storage::disk('public')->exists($f))
                {
                    $product->media()->where('file_name', $product->feature_img)->delete();
                    Storage::disk('public')->delete($f);
                }
            }
            
            $product->feature_img = $randomFileName;
            $product->save();
            
            $file_new_url = 'storage/product/fi/'.$randomFileName;
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
            $media->collection_name  = 'product_feature_image';
            // $media->disk  = 'public';
            $product->media()->save($media);            
            if($request->ajax())
            {
              return Response()->json([
                'page'=>View('admin.products.ajax.productFeatureImg', ['product' => $product,])->render(),
                'success' => true
            ]);
          }
      }
      return back();
    }
    public function productFeatureImageDelete(Request $request, Product $product)
    {
        if($product->feature_img)
        {
            $f = 'product/fi/'.$product->feature_img;
            if(Storage::disk('public')->exists($f))
            {
                $product->media()->where('file_name', $product->feature_img)->delete();
                Storage::disk('public')->delete($f);
            }
        }
        $product->feature_img = null;
        $product->save();
        if($request->ajax())
            {
              return Response()->json([
                'page'=>View('admin.products.ajax.productFeatureImg', ['product' => $product,])->render(),
                'success' => true
            ]);
            return back();
        }
    }
    public function productExtraImageChangeModalOpen(Request $request, Product $product)
    {
        // dd($product);
        if($request->ajax())
        {
          return Response()->json(View('admin.products.includes.modals.productExtraImageModal', [
            'product' => $product,
            ])->render());
        }
        return back();
    }
    public function productExtraImageChangePost(Request $request, Product $product)
    {
        // dd($request->all());
        foreach ($request->file as $f) 
        {
            $cp =  $f;
            $extension = strtolower($cp->getClientOriginalExtension());
            $mime = $cp->getClientMimeType();
            $size =$cp->getSize();
            $originalName = strtolower($cp->getClientOriginalName());
            list($width,$height) = getimagesize($cp);
            $randomFileName = $product->id.'_lei_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;
            Storage::disk('public')->put('product/ei/'.$randomFileName, File::get($cp));
            $file_new_url = 'storage/product/ei/'.$randomFileName;
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
            $media->collection_name  = 'product_extra_image';
            // $media->disk  = 'public';
            $product->media()->save($media);
        }
        if($request->ajax())
        {
          return Response()->json([
                'success' =>true,
                'view' =>  View('admin.products.ajax.productExtraImages', [
                'product' => $product,
                ])->render()
            ]);
        }
        return back();
    }
    public function productExtraImageDelete(Request $request, Media $media)
    {
        $product = $media->model;
        if($request->ajax())
        {
            if($media->file_name and ($media->file_type == 'image'))
            {
                $f = 'product/ei/'.$media->file_name;
                if(Storage::disk('public')->exists($f))
                {
                    Storage::disk('public')->delete($f);
                    $media->delete();
                }
            }            
          return Response()->json([
                'success' =>true,
                'view' =>  View('admin.products.ajax.productExtraImages', [
                'product' => $product,
                ])->render()
            ]);
        }
        return back();
    }
}
