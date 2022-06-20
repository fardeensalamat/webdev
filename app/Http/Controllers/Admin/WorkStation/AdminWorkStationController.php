<?php

namespace App\Http\Controllers\Admin\WorkStation;

use Auth;
use Session;
use Validator;
use GuzzleHttp\Client;
use App\Models\WorkStation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;

class AdminWorkStationController extends Controller
{
    public function workStationList(Request $request)
    {
        if(!Auth::user()->hasPermission('workstation'))
        {
            abort(401);
        }
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'workstation','lsbsm'=>'workstation']);

        $workStations = WorkStation::latest()->paginate(50);

        return view('admin.workStations.workStations',[
            'workStations' => $workStations
        ]);
    }

    public function workStationEdit(WorkStation $workstation, Request $request)
    {
        if(!Auth::user()->hasPermission('workstation'))
        {
            abort(401);
        }
        
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'workstation','lsbsm'=>'workstation']);
        return view('admin.workStations.workStationsEdit',[
            'workstation' => $workstation
        ]);
    }

    public function workStationUpdate(WorkStation $workstation, Request $request)
    {
        
        $validation = Validator::make($request->all(),
        [
            'title' => ['required','string', 'max:255','min:2'],
            'active'=> ['nullable']

        ]);
        
        if($validation->fails())
        {

            return back()
            ->withInput()
            ->withErrors($validation);
        }
        // dd($request->all());

        $workstation->title = $request->title;
        $workstation->description = $request->description;
        $workstation->user_page_msg = $request->user_page_msg ?: null; 
        $workstation->active = $request->active ? true : false;

        $workstation->addedby_id = Auth::id();
        $workstation->save();



        if($cp = $request->image)
        {
            $f = 'workStation/image/'.$workstation->img_name;
            if(Storage::disk('public')->exists($f))
            {
                Storage::disk('public')->delete($f);
            }  

            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $workstation->id.'_img_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            list($width,$height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size =$cp->getSize();                    
            
            $originalName = strtolower($cp->getClientOriginalName());

            Storage::disk('public')->put('workStation/image/'.$randomFileName, File::get($cp));
        
            $workstation->feature_img = $randomFileName;

            $workstation->save();

        } 

       	return back()->with('success', 'User successfully Updated');
    }
}
