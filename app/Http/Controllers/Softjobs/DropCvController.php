<?php

namespace App\Http\Controllers\Softjobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Session;
use Validator;
use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Jobseeker;

class DropCvController extends Controller
{
    public function createjobprofile()
    {
        $user = Auth::user();
        $jobseeker=Jobseeker::where('user_id',$user->id)->count();
        if($jobseeker>0){
            $jobseeker=Jobseeker::where('user_id',$user->id)->first();
            return redirect()->route('dropcv.dashboard',compact('jobseeker'));
        }
        
        return view('softjobs.dropcv.createcvprofile');
        
    }

    public function storejobseekerprimaryinfo(Request $request)
    {

        $user = Auth::user();
        $validation = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255', 'min:3'],
                'email' => ['required', 'string', 'email','max:255','unique:job_seekers'],
                'mobile' => ['required','unique:job_seekers'],
                'skill' => ['required', 'string','max:255'],
                'agree' => ['required']

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $jobseeker=Jobseeker::where('user_id',$user->id)->count();
        if($jobseeker>0){
            $jobseeker=Jobseeker::where('user_id',$user->id)->first();
            return redirect()->route('dropcv.dashboard',compact('jobseeker'))->with('warning', 'You Have Alreaduy A Account');
        }

        $js = new Jobseeker;
        $js->user_id = $user->id;
        $js->name = $request->name;
        $js->gender = $request->gender;
        $js->skill = $request->skill;
        $js->email = $request->email;
        $js->mobile = $request->mobile;
        $js->is_user = $request->is_user;
        $js->agree = $request->agree;
        $js->save();
        return redirect()->route('dropcv.dashboard')->with('success', 'Successfully Create Your Job Account');
        //return view('softjobs.dropcv.createcvprofile');
        
    }
    public function dashboard()
    {
        return view('softjobs.dropcv.dashboard');
        
    }
}
