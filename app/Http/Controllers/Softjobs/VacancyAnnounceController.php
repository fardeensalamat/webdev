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
use App\Models\JobCompany;
use App\Models\JobAnnouncer;



class VacancyAnnounceController extends Controller
{
    public function createjobcompanyprofile()
    {
        $user = Auth::user();
        $jobannouncer=JobAnnouncer::where('user_id',$user->id)->count();
        if($jobannouncer>0){
            $jobannouncer=JobAnnouncer::where('user_id',$user->id)->first();
            return redirect()->route('vacancyannounce.dashboard',compact('jobannouncer'));
        }
        
        return view('softjobs.vacancyannounce.createjobcompanyprofile');
        
    }

    public function dashboard()
    {
        $user = Auth::user();
        $jobannouncer=JobAnnouncer::where('user_id',$user->id)->first();
        return view('softjobs.vacancyannounce.dashboard',compact('user','jobannouncer'));
        
    }

    public function jobannouncerprimaryinfostore(Request $request)
    {
        //dd($request->all());

        $user = Auth::user();
        $validation = Validator::make(
            $request->all(),
            [
                'user_name' => ['required', 'string', 'max:255', 'min:3'],
                'contact_person_email' => ['required', 'string', 'email','max:255','unique:job_announcers'],
                'contact_person_mobile' => ['required','unique:job_announcers'],
                'license_no' => ['required','unique:job_announcers'],
                'company_name' => ['required', 'string','max:255'],
                'address' => ['required', 'string','max:255'],
                'is_agree' => ['required']

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $jobannouncer=JobAnnouncer::where('user_id',$user->id)->count();
        if($jobannouncer>0){
            $jobannouncer=JobAnnouncer::where('user_id',$user->id)->first();
            return redirect()->route('vacanceyannounce.dashboard',compact('jobannouncer'))->with('warning', 'You Have Alreaduy A Account');
        }

        $ja = new JobAnnouncer;
        $ja->user_id = $user->id;
        $ja->user_name = $request->user_name;
        $ja->company_name = $request->company_name;
        $ja->company_bnname = $request->company_bnname;
        $ja->is_entrepreneur = $request->is_entrepreneur;
        $ja->year_of_est = $request->year_of_est;
        $ja->company_size = $request->company_size;
        $ja->country = $request->country;
        $ja->distric = $request->distric;
        $ja->thana = $request->thana;
        $ja->address = $request->address;
        $ja->bn_address = $request->bn_address;
        $ja->industry_type = $request->industry_type;
        $ja->industry_category = $request->industry_category;
        $ja->business_description = $request->business_description;

        $ja->license_no = $request->license_no;
        $ja->rl_no = $request->rl_no;
        $ja->web_url = $request->web_url;
        $ja->contact_person_name = $request->contact_person_name;
        $ja->contact_person_designation = $request->contact_person_designation;
        $ja->contact_person_email = $request->contact_person_email;
        $ja->contact_person_mobile = $request->contact_person_mobile;
        $ja->is_agree = $request->is_agree;
        
        $ja->save();
        return redirect()->route('vacanceyannounce.dashboard')->with('success', 'Successfully Create Your Job Account');
        //return view('softjobs.dropcv.createcvprofile');
        
    }

   //For Vacancy Announce Job Post


    public function createvacancyannouncejobpost()
    {
        
        
        return view('softjobs.vacancyannounce.createvacancyannouncejobpost');
        
    }
}
