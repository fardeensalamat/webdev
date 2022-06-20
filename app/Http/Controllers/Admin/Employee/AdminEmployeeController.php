<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Auth;
use Hash;
use DB;
use Session;
use Validator;
use App\Models\Sms;
use App\Models\SendSms;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Upazila;
use App\Models\Division;
use App\Models\District;
use App\Models\AdminBalance;
use App\Models\UserRole;
use App\Models\Subscriber;
use App\Models\ServiceProfile;

use App\Models\SubcriberPayment;
use App\Models\UserBalanceEdit;
use App\Models\BalanceTransaction;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ServiceItemRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\FreelancerJob;
use App\Models\Category;
use App\Models\Need;
use App\Models\FreelanceJobWork;
use App\Models\Opinion;
use App\Models\PostCategory;
use App\Models\Serviceitem;
use App\Models\ServicePayment;
use App\Models\ServiceProductOrder;
use App\Models\ServiceProfileInfo;
use App\Models\ServiceProfileInfoValue;
use App\Models\ServiceProfileProduct;
use App\Models\ServiceProfileVisitor;
use App\Models\SocialGroup;
use App\Models\Suggestion;
use App\Models\UserUpdateInformation;
use App\Models\WorkStation;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use DateTime;
class AdminEmployeeController extends Controller
{
    public function EmployeeHistoryInfo(Request $request)
    {

        $type = $request->type;
        $user = User::withoutGlobalScopes()
            ->where('id', $request->user)
            ->firstOrFail();

    


        if ($type == 'all_create_profile') {
            menuSubmenu('employee', 'employeeAll');

            if (!Auth::user()->hasPermission('employee')) {
                abort(401);
            }
            $profiles =ServiceProfile::where('addedby_id',$user->id)
                ->latest()
                ->paginate(50);
            $total=$profiles->count();

            $start=Carbon::now();
            $end=Carbon::now();
            $date='';
            $paystatus='';

            return view('admin.employee.createdserviceprofile', [
                'user' => $user,
                'profiles' => $profiles,
                'type' => $type,
                'start' => $start,
                'end' => $end,
                'total'=>$total,
                'date'=>$date,
                'paystatus'=>$paystatus
            ]);
        }
        if ($type == 'all_create_profile_date') {
            menuSubmenu('employee', 'employeeAll');
            if (!Auth::user()->hasPermission('employee')) {
                abort(401);
            }
            
            $start = $request->date_from;
            $end = $request->date_to;
            $paystatus=$request->paystatus;
            $date = $request->date;

            //dd($paystatus);

            if($request->paystatus==2){
                $profiles =ServiceProfile::where('addedby_id',$user->id)->where('is_trial',$request->paystatus)
                    ->whereBetween('created_at',[$start,$end])
                    ->latest()->paginate(50);

          
                if($date == 'today')
                {
                       $profiles = ServiceProfile::where('addedby_id',$user->id)->where('is_trial',$request->paystatus)->whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->latest()->paginate(50);                
                   
                }
                elseif($date == 'yesterday')
                {
                    $profiles = ServiceProfile::where('addedby_id',$user->id)->where('is_trial',$request->paystatus)->whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')->latest()->paginate(50);
            
                }
                elseif($date == 7)
                {
                    $end = Carbon::now()->toDateString();
                    $start = Carbon::now()->subDays(6)->toDateString();
                    
                    $profiles = ServiceProfile::where('addedby_id',$user->id)->where('is_trial',$request->paystatus)->whereBetween('created_at',[$start,$end])->latest()->paginate(50);
                }
        
                elseif($date == 30)
                {
                    $end = Carbon::now()->toDateString();
                    $start = Carbon::now()->subDays(29)->toDateString();
                    $profiles = ServiceProfile::where('addedby_id',$user->id)->where('is_trial',$request->paystatus)->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->latest()->paginate(50);
                   
                }
                elseif($date == 'this_month')
                {
                   
                    $profiles = ServiceProfile::where('addedby_id',$user->id)->where('is_trial',$request->paystatus)->whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')
                    ->latest()->paginate(50);   
                   
        
        
                }
                elseif($date == 'last_month')
                {
                    $previous =  Carbon::now()->subMonth(); 
                    $lastMonthYear =  $previous->format('Y'); 
                    $lastMonth =  $previous->format('m'); 
                    $profiles = ServiceProfile::where('addedby_id',$user->id)->where('is_trial',$request->paystatus)->whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->latest()->paginate(50);                
                }else{
                    $profiles = ServiceProfile::where('addedby_id',$user->id)->where('is_trial',$request->paystatus)->orderBy('id','desc')->latest()->paginate(50);                

                }
        

            }else{
                $profiles =ServiceProfile::where('addedby_id',$user->id)->where('paystatus',$request->paystatus)
                    ->whereBetween('created_at',[$start,$end])
                    ->latest()->paginate(50);

          
                if($date == 'today')
                {
                       $profiles = ServiceProfile::where('addedby_id',$user->id)->where('paystatus',$request->paystatus)->whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->latest()->paginate(50);                
                   
                }
                elseif($date == 'yesterday')
                {
                    $profiles = ServiceProfile::where('addedby_id',$user->id)->where('paystatus',$request->paystatus)->whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')->latest()->paginate(50);
            
                }
                elseif($date == 7)
                {
                    $end = Carbon::now()->toDateString();
                    $start = Carbon::now()->subDays(6)->toDateString();
                    
                    $profiles = ServiceProfile::where('addedby_id',$user->id)->where('paystatus',$request->paystatus)->whereBetween('created_at',[$start,$end])->latest()->paginate(50);
                }
        
                elseif($date == 30)
                {
                    $end = Carbon::now()->toDateString();
                    $start = Carbon::now()->subDays(29)->toDateString();
                    $profiles = ServiceProfile::where('addedby_id',$user->id)->where('paystatus',$request->paystatus)->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->latest()->paginate(50);
                   
                }
                elseif($date == 'this_month')
                {
                   
                    $profiles = ServiceProfile::where('addedby_id',$user->id)->where('paystatus',$request->paystatus)->whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')
                    ->latest()->paginate(50);   
                   
        
        
                }
                elseif($date == 'last_month')
                {
                    $previous =  Carbon::now()->subMonth(); 
                    $lastMonthYear =  $previous->format('Y'); 
                    $lastMonth =  $previous->format('m'); 
                    $profiles = ServiceProfile::where('addedby_id',$user->id)->where('paystatus',$request->paystatus)->whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->latest()->paginate(50);                
                }else{
                    $profiles = ServiceProfile::where('addedby_id',$user->id)->where('paystatus',$request->paystatus)->orderBy('id','desc')->latest()->paginate(50);                

                }
        
            }
                




                $total=$profiles->count();

            
           $start=new DateTime($start);
           $end=new DateTime($end);

            return view('admin.employee.createdserviceprofile', [
                'user' => $user,
                'profiles' => $profiles,
                'type' => $type,
                'start' => $start,
                'end' => $end,
                'total'=>$total,
                'date'=>$date,
                'paystatus'=>$paystatus
            ]);
        }

        return back();
    }


    public function employeeserviceprofilefixeddatefilter(Request $request){
        $date = $request->date;
        $type = $request->type;

        if($date == 'today')
        {
            if($type == 'serviceprofile')
            {
               $profiles = ServiceProfile::whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->latest()->paginate(50);                
            }elseif($type == 'freelancerworklist'){
                $works = FreelanceJobWork::where('category_id','22')->whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->latest()->paginate(50); 
            }else{

            }
           
        }
        elseif($date == 'yesterday')
        {
            if($type == 'serviceprofile')
            {
               $profiles = ServiceProfile::whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')->latest()->paginate(50);
            }elseif($type == 'freelancerworklist'){
                $works = FreelanceJobWork::where('category_id','22')->whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')->latest()->paginate(50);
            }else{

            }
    
        }
        elseif($date == 7)
        {
            $end = Carbon::now()->toDateString();
            $start = Carbon::now()->subDays(6)->toDateString();
            
            if($type == 'serviceprofile')
            {
               $profiles = ServiceProfile::whereBetween('created_at',[$start,$end])->latest()->paginate(50);
            }elseif($type == 'freelancerworklist'){
                $works = FreelanceJobWork::where('category_id','22')->whereBetween('created_at',[$start,$end])->latest()->paginate(50);
            }else{

            }
        }

        elseif($date == 30)
        {
            $end = Carbon::now()->toDateString();
            $start = Carbon::now()->subDays(29)->toDateString();
            if($type == 'serviceprofile')
            {
               $profiles = ServiceProfile::whereBetween('created_at',[$start,$end])->orderBy('id','desc')->latest()->paginate(50);
                
            }elseif($type == 'freelancerworklist'){
                $works = FreelanceJobWork::where('category_id','22')->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->latest()->paginate(50);
            }else{

            }
           
        }
        elseif($date == 'this_month')
        {
           
            if($type == 'serviceprofile')
            {
               $profiles = ServiceProfile::whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')
                 ->latest()->paginate(50);                
            }elseif($type == 'freelancerworklist'){
                $works = FreelanceJobWork::where('category_id','22')->whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')
                ->latest()->paginate(50);  
            }else{

            }
           


        }
        elseif($date == 'last_month')
        {
            $previous =  Carbon::now()->subMonth(); 
            $lastMonthYear =  $previous->format('Y'); 
            $lastMonth =  $previous->format('m'); 
            
            if($type == 'serviceprofile')
            {

               $profiles = ServiceProfile::whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->latest()->paginate(50);                
            }elseif($type == 'freelancerworklist'){
                $works = FreelanceJobWork::where('category_id','22')->whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->latest()->paginate(50);                  
            }else{

            }
        }else{
            if($type == 'serviceprofile')
            {
                $profiles = ServiceProfile::orderBy('id','desc')->latest()->paginate(50);   
            }elseif($type == 'freelancerworklist'){
                $works = FreelanceJobWork::where('category_id','22')->orderBy('id','desc')->latest()->paginate(50);                     
            }else{

            }
                       

        }

        if($type == 'serviceprofile')
        {



        $users = User::where('is_employee',1)->get();
            //dd($profiles);
            $employee='';
            $total='';
            $start='';
            $end='';
            $paystatus='';
    
            return view('admin.employee.allemployecreateprofile', [
                'employee' => $employee,
                'profiles' => $profiles,
                'start' => $start,
                'end' => $end,
                'users'=>$users,
                'total'=>$total,
                'date'=>$date,
                'paystatus'=>$paystatus
            ]);
        }elseif($type == 'freelancerworklist'){
            menuSubmenu('freelancer','worklist');
            $start=Carbon::now();
            $end=Carbon::now();
    
            $users = User::where('is_freelancer',1)->get();
       
            $employee='';
            $total='';
            $date='';
            $paystatus='';

            return view('admin.freelancer.freelancer_worklist',[
                'works'=> $works,
                'start' => $start,
                'end' => $end,
                'users'=>$users,
                'employee'=>$employee,
                'total'=>$total,
                'date'=>$date,
                'paystatus'=>$paystatus
            ]);

                             
        }else{
          
        }


    }
    public function employeserviceProfilelistfilter(Request $request)
    {
        // symlink ( storage_path('app/public') , public_path('storage'));
        menuSubmenu('employee', 'employeeAll');
        if (!Auth::user()->hasPermission('employee')) {
            abort(401);
        }
       
        $start = $request->date_from;
        $end = $request->date_to;
        $paystatus=$request->paystatus;
        $date = $request->date;

        $employee = User::where('id', $request->employee)->first();
      
        
      


        if($employee){
            if($request->paystatus==2){

                if($request->date_from != Null){
                
                    $profiles =ServiceProfile::where('addedby_id',$request->employee)
                    ->where('is_trial',true)
                    ->whereBetween('created_at',[$start,$end])
                    ->latest()
                    ->paginate(50);
                
                }else{
                
                
                    if($date == 'today')
                    {
                        $profiles = ServiceProfile::where('addedby_id',$request->employee)->where('is_trial',true)->whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->latest()->paginate(50);                
                    
                    }
                    elseif($date == 'yesterday')
                    {
                        $profiles = ServiceProfile::where('addedby_id',$request->employee)->where('is_trial',true)->whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')->latest()->paginate(50);
                
                    }
                    elseif($date == 7)
                    {
                        $start = Carbon::now()->subDays(6)->toDateString();
                        $end = Carbon::now()->toDateString();
                    
                        
                        $profiles = ServiceProfile::where('addedby_id',$request->employee)->where('is_trial',true)->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->latest()->paginate(50);
                    }
            
                    elseif($date == 30)
                    {
                        $end = Carbon::now()->toDateString();
                        $start = Carbon::now()->subDays(29)->toDateString();
                        $profiles = ServiceProfile::where('addedby_id',$request->employee)->where('is_trial',true)->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->latest()->paginate(50);
                    
                    }
                    elseif($date == 'this_month')
                    {
                    
                        $profiles = ServiceProfile::where('addedby_id',$request->employee)->where('is_trial',true)->whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')
                        ->latest()->paginate(50);   
                    
            
            
                    }
                    elseif($date == 'last_month')
                    {
                        $previous =  Carbon::now()->subMonth(); 
                        $lastMonthYear =  $previous->format('Y'); 
                        $lastMonth =  $previous->format('m'); 
                        $profiles = ServiceProfile::where('addedby_id',$request->employee)->where('is_trial',true)->whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->latest()->paginate(50);                
                    }else{
                        $profiles = ServiceProfile::where('addedby_id',$request->employee)->where('is_trial',true)->orderBy('id','desc')->latest()->paginate(50);                

                    }

                } 
        
            }else{
                        if($request->date_from != Null){
                    
                            $profiles =ServiceProfile::where('addedby_id',$request->employee)
                            ->where('paystatus',$request->paystatus)
                            ->whereBetween('created_at',[$start,$end])
                            ->latest()
                            ->paginate(50);
                        
                        }else{
                        
                        
                            if($date == 'today')
                            {
                                $profiles = ServiceProfile::where('addedby_id',$request->employee)->where('paystatus',$request->paystatus)->whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->latest()->paginate(50);                
                            
                            }
                            elseif($date == 'yesterday')
                            {
                                $profiles = ServiceProfile::where('addedby_id',$request->employee)->where('paystatus',$request->paystatus)->whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')->latest()->paginate(50);
                        
                            }
                            elseif($date == 7)
                            {
                                $start = Carbon::now()->subDays(6)->toDateString();
                                $end = Carbon::now()->toDateString();
                            
                                
                                $profiles = ServiceProfile::where('addedby_id',$request->employee)->where('paystatus',$request->paystatus)->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->latest()->paginate(50);
                            }
                    
                            elseif($date == 30)
                            {
                                $end = Carbon::now()->toDateString();
                                $start = Carbon::now()->subDays(29)->toDateString();
                                $profiles = ServiceProfile::where('addedby_id',$request->employee)->where('paystatus',$request->paystatus)->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->latest()->paginate(50);
                            
                            }
                            elseif($date == 'this_month')
                            {
                            
                                $profiles = ServiceProfile::where('addedby_id',$request->employee)->where('paystatus',$request->paystatus)->whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')
                                ->latest()->paginate(50);   
                            
                    
                    
                            }
                            elseif($date == 'last_month')
                            {
                                $previous =  Carbon::now()->subMonth(); 
                                $lastMonthYear =  $previous->format('Y'); 
                                $lastMonth =  $previous->format('m'); 
                                $profiles = ServiceProfile::where('addedby_id',$request->employee)->where('paystatus',$request->paystatus)->whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->latest()->paginate(50);                
                            }else{
                                $profiles = ServiceProfile::where('addedby_id',$request->employee)->where('paystatus',$request->paystatus)->orderBy('id','desc')->latest()->paginate(50);                

                            }

                        } 
                    

            }

        }else{
            
            $employee='';
            if($request->paystatus==2){

                if($request->date_from != Null){
                
                    $profiles =ServiceProfile::where('is_trial',true)
                    ->whereBetween('created_at',[$start,$end])
                    ->latest()
                    ->paginate(50);
                
                }else{
                
                
                    if($date == 'today')
                    {
                        $profiles = ServiceProfile::where('is_trial',true)->whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->latest()->paginate(50);                
                    
                    }
                    elseif($date == 'yesterday')
                    {
                        $profiles = ServiceProfile::where('is_trial',true)->whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')->latest()->paginate(50);
                
                    }
                    elseif($date == 7)
                    {
                        $start = Carbon::now()->subDays(6)->toDateString();
                        $end = Carbon::now()->toDateString();
                    
                        
                        $profiles = ServiceProfile::where('is_trial',true)->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->latest()->paginate(50);
                    }
            
                    elseif($date == 30)
                    {
                        $end = Carbon::now()->toDateString();
                        $start = Carbon::now()->subDays(29)->toDateString();
                        $profiles = ServiceProfile::where('is_trial',true)->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->latest()->paginate(50);
                    
                    }
                    elseif($date == 'this_month')
                    {
                    
                        $profiles = ServiceProfile::where('is_trial',true)->whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')
                        ->latest()->paginate(50);   
                    
            
            
                    }
                    elseif($date == 'last_month')
                    {
                        $previous =  Carbon::now()->subMonth(); 
                        $lastMonthYear =  $previous->format('Y'); 
                        $lastMonth =  $previous->format('m'); 
                        $profiles = ServiceProfile::where('is_trial',true)->whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->latest()->paginate(50);                
                    }else{
                        $profiles = ServiceProfile::where('is_trial',true)->orderBy('id','desc')->latest()->paginate(50);                

                    }

                } 
        
            }else{
                        if($request->date_from != Null){
                    
                            $profiles =ServiceProfile::where('addedby_id',$request->employee)
                            ->where('paystatus',$request->paystatus)
                            ->whereBetween('created_at',[$start,$end])
                            ->latest()
                            ->paginate(50);
                        
                        }else{
                        
                        
                            if($date == 'today')
                            {
                                $profiles = ServiceProfile::where('paystatus',$request->paystatus)->whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->latest()->paginate(50);                
                            
                            }
                            elseif($date == 'yesterday')
                            {
                                $profiles = ServiceProfile::where('paystatus',$request->paystatus)->whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')->latest()->paginate(50);
                        
                            }
                            elseif($date == 7)
                            {
                                $start = Carbon::now()->subDays(6)->toDateString();
                                $end = Carbon::now()->toDateString();
                            
                                
                                $profiles = ServiceProfile::where('paystatus',$request->paystatus)->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->latest()->paginate(50);
                            }
                    
                            elseif($date == 30)
                            {
                                $end = Carbon::now()->toDateString();
                                $start = Carbon::now()->subDays(29)->toDateString();
                                $profiles = ServiceProfile::where('paystatus',$request->paystatus)->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->latest()->paginate(50);
                            
                            }
                            elseif($date == 'this_month')
                            {
                            
                                $profiles = ServiceProfile::where('paystatus',$request->paystatus)->whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')
                                ->latest()->paginate(50);   
                            
                    
                    
                            }
                            elseif($date == 'last_month')
                            {
                                $previous =  Carbon::now()->subMonth(); 
                                $lastMonthYear =  $previous->format('Y'); 
                                $lastMonth =  $previous->format('m'); 
                                $profiles = ServiceProfile::where('paystatus',$request->paystatus)->whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->latest()->paginate(50);                
                            }else{
                                $profiles = ServiceProfile::where('paystatus',$request->paystatus)->orderBy('id','desc')->latest()->paginate(50);                

                            }

                        } 
                    

            }

        }
           

        
        

              

        $total=$profiles->count();

        
     
       $users = User::where('is_employee',1)->get();
       //dd($employee);

        return view('admin.employee.allemployecreateprofile', [
            'employee' => $employee,
            'profiles' => $profiles,
            'start' => $start,
            'end' => $end,
            'users'=>$users,
            'total'=>$total,
            'date'=>$date,
            'paystatus'=>$paystatus
        ]);
    }

    public function employeserviceProfilelist()
    {
        // symlink ( storage_path('app/public') , public_path('storage'));

        menuSubmenu('employee', 'profilelist');
        $start=Carbon::now();
        $end=Carbon::now();

        $profiles = ServiceProfile::latest()->paginate(50);
        $users = User::where('is_employee',1)->get();
   
        $employee='';
        $total='';
        $date='';
        $paystatus='';

        return view('admin.employee.allemployecreateprofile', [
            'profiles' => $profiles,
            'start' => $start,
            'end' => $end,
            'users'=>$users,
            'employee'=>$employee,
            'total'=>$total,
            'date'=>$date,
            'paystatus'=>$paystatus
        ]);
    }


    public function freelancerworklist(Request $request)
    {
       
            menuSubmenu('freelancer','worklist');

            $works = FreelanceJobWork::where('category_id','22')->orderBy('status')->paginate(15);
            $start=Carbon::now();
            $end=Carbon::now();
    
            $users = User::where('is_freelancer',1)->get();
       
            $employee='';
            $total='';
            $date='';
            $paystatus='';

            return view('admin.freelancer.freelancer_worklist',[
                'works'=> $works,
                'start' => $start,
                'end' => $end,
                'users'=>$users,
                'employee'=>$employee,
                'total'=>$total,
                'date'=>$date,
                'paystatus'=>$paystatus
            ]);
        
    }

    public function freelancerworklistfilter(Request $request)
    {
        // symlink ( storage_path('app/public') , public_path('storage'));
        menuSubmenu('freelancer','worklist');
        if (!Auth::user()->hasPermission('freelancer')) {
            abort(401);
        }
        
        $start = $request->date_from;
        $end = $request->date_to;
        $date = $request->date;

        $employee = User::withoutGlobalScopes()
        ->where('id', $request->employee)
        ->firstOrFail();


        //dd($request->employee);
        if($request->date_from != Null){
     
            $works =FreelanceJobWork::where('category_id','22')->where('user_id',$request->employee)
            ->whereBetween('created_at',[$start,$end])
            ->latest()
            ->paginate(50);
          
        }else{
          
          
            if($date == 'today')
            {
                   $works = FreelanceJobWork::where('category_id','22')->where('user_id',$request->employee)->whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->latest()->paginate(50);                
               
            }
            elseif($date == 'yesterday')
            {
                $works = FreelanceJobWork::where('category_id','22')->where('user_id',$request->employee)->whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')->latest()->paginate(50);
        
            }
            elseif($date == 7)
            {
                $start = Carbon::now()->subDays(6)->toDateString();
                $end = Carbon::now()->toDateString();
               
                
                $works = FreelanceJobWork::where('category_id','22')->where('user_id',$request->employee)->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->latest()->paginate(50);
            }
    
            elseif($date == 30)
            {
                $end = Carbon::now()->toDateString();
                $start = Carbon::now()->subDays(29)->toDateString();
                $works = FreelanceJobWork::where('category_id','22')->where('user_id',$request->employee)->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->latest()->paginate(50);
               
            }
            elseif($date == 'this_month')
            {
               
                $works = FreelanceJobWork::where('category_id','22')->where('user_id',$request->employee)->whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')
                ->latest()->paginate(50);   
               
    
    
            }
            elseif($date == 'last_month')
            {
                $previous =  Carbon::now()->subMonth(); 
                $lastMonthYear =  $previous->format('Y'); 
                $lastMonth =  $previous->format('m'); 
                $works = FreelanceJobWork::where('category_id','22')->where('user_id',$request->employee)->whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->latest()->paginate(50);                
            }else{
                $works = FreelanceJobWork::where('category_id','22')->where('user_id',$request->employee)->orderBy('id','desc')->latest()->paginate(50);                

            }

        } 

        $total=$works->count();
      $paystatus='';

        
     
       $users = User::where('is_freelancer',1)->get();
       //dd($works);

       return view('admin.freelancer.freelancer_worklist',[
        'works'=> $works,
        'start' => $start,
        'end' => $end,
        'users'=>$users,
        'employee'=>$employee,
        'total'=>$total,
        'date'=>$date,
        'paystatus'=>$paystatus
        ]);
    }

     public function freelanncerWorklist($id)
    {
        menuSubmenu('freelancer','worklist');
        if (!Auth::user()->hasPermission('freelancer')) {
            abort(401);
        }
        $start = '';
        $end = '';
        $date = '';

        $employee = User::withoutGlobalScopes()
        ->where('id', $id)
        ->firstOrFail();

        $works = FreelanceJobWork::where('category_id','22')->where('user_id',$id)->orderBy('id','desc')->latest()->paginate(50);
        $users = User::where('is_freelancer',1)->get();
        //dd($works);
        $total=$works->count();
        $paystatus='';
 
        return view('admin.freelancer.freelancer_worklist',[
            'works'=> $works,
            'start' => $start,
            'end' => $end,
            'users'=>$users,
            'employee'=>$employee,
            'total'=>$total,
            'date'=>$date,
            'paystatus'=>$paystatus
         ]);
    }
}
