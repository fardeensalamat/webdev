<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\WorkStation;
use App\Models\Category;
// use App\Model\Page;
use App\Models\Media;
use GuzzleHttp\Client;  
// use App\Model\PageItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;

class AdminMediaController extends Controller
{     
 
//media
    public function mediaAll(Request $request)
    {
        if(!Auth::user()->hasPermission('page'))
        {
            abort(401);
        }
        
        $allWorkStation = WorkStation::get();
        $allCategory = Category::get();        
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'media','lsbsm'=>'mediaAll']);
        $mediaAll = Media::latest()->paginate(50);
        return view('admin.media.mediaAll',['mediaAll'=>$mediaAll,'allWorkStation'=>$allWorkStation,'allCategory'=>$allCategory]);
    }

    public function mediaUploadPost(Request $request)
    {
        
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

        $media = new Media;
        $media->category = $request->category;
        $media->workstation = $request->workstation;
        $media->save();
        
       

        if($request->hasFile('files'))
            {
                foreach($request->file('files') as $file)
                {
                    $originalName = $file->getClientOriginalName();
                    $ext = $file->getClientOriginalExtension();
                    $mime = $file->getClientMimeType();
                    $size =$file->getSize();
                    $fileNewName = Str::random(4).date('ymds').'.'.$ext;
                    // $fileNewName = str_random(6).time().'.'.$ext;
                    // $fileNewName = Auth::id().'_'.date('ymdhis').'_'.rand(11,99).'.'.$ext;
                    list($width,$height) = getimagesize($file);                    

                    Storage::disk('public')
                    ->put('media/image/'.$fileNewName, File::get($file));

                    $file_new_url = 'storage/media/image/'.$fileNewName;

                    // $media = new Media;                    
                    $media->file_name = $fileNewName;
                    $media->file_original_name = $originalName;
                    $media->file_mime = $mime;
                    $media->file_ext = $ext;
                    $media->file_size = $size;
                    
                    $media->width = $width;
                    $media->height = $height;
                    $media->file_url = $file_new_url;
                    // $media->model_id = $request->model ? 1 : 0;
                    $media->collection_name = $request->collection_name ? 1: 0;

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
        $f = 'media/image/'.$media->file_name;
        $e = 'media/category/image/'.$media->file_name;
        $g = 'media/category/banner/'.$media->file_name;
        $h = 'media/brand/image/'.$media->file_name;
        $i = 'product/fi/'.$media->file_name;
        
        
        if(Storage::disk('public')->exists($f))
        {
            Storage::disk('public')->delete($f);
            // Storage::disk('public')->delete('media/image/'.$media->file_name);
            $media->delete();            
        }
        elseif(Storage::disk('public')->exists($e))
        {
            Storage::disk('public')->delete($f);
            
            $media->delete();   
        }
        elseif(Storage::disk('public')->exists($g))
        {
            Storage::disk('public')->delete($g);
            
            $media->delete();   
        }
        elseif(Storage::disk('public')->exists($h))
        {
            Storage::disk('public')->delete($h);
            
            $media->delete();   
        }
        elseif(Storage::disk('public')->exists($i))
        {
            Storage::disk('public')->delete($i);
            
            $media->delete();   
        }

        return back()->with('info','Media successfully deleted.');
        
    }
//media


}
