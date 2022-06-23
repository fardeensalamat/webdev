<?php

namespace App\Http\Controllers\User\UserDashborad;

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
use App\Models\BlogTag;
use App\Models\Category;
use App\Models\Need;
use App\Models\Note;
use App\Models\Opinion;
use App\Models\PostCategory;
use App\Models\Serviceitem;
use App\Models\ServicePayment;
use App\Models\ServiceProductOrder;
use App\Models\ServiceProfileInfo;
use App\Models\ServiceProfileInfoValue;
use App\Models\ServiceProfileProduct;
use App\Models\ServiceProfileVisitor;
use App\Models\EmployeeReport;
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

class EmployeeDashboardController extends Controller
{

    public function EmployeeCreateProfileList(){

    menuSubmenu('employee', 'employee');
    $user = Auth::user();
    $profiles =ServiceProfile::where('addedby_id',$user->id)
        ->latest()
        ->paginate(50);
    $total=$profiles->count();

    $start=Carbon::now();
    $end=Carbon::now();
    $paystatus='';
    $date='';

    return view('user.employee.createdserviceprofile', [
        'user' => $user,
        'profiles' => $profiles,
        'start' => $start,
        'end' => $end,
        'total'=>$total,
        'paystatus'=> $paystatus,
        'date'=>$date
    ]);

    }
    public function  EmployeeCreateProfileListFilter(Request $request)
    {

        $type = $request->type;
        $user = User::where('id',$request->user)->first();
        $date = $request->date;
        if ($type == 'all_create_profile_date') {

            menuSubmenu('employee', 'employee');
            $start = $request->date_from;
            $end = $request->date_to;
            $paystatus=$request->paystatus;
           if($request->date_from != null){
                $profiles =ServiceProfile::where('addedby_id',$user->id)
                ->where('paystatus',$request->paystatus)
                ->whereBetween('created_at',[$start,$end])
                ->latest()
                ->paginate(50);

           }else{

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

            return view('user.employee.createdserviceprofile', [
                'user' => $user,
                'profiles' => $profiles,
                'type' => $type,
                'start' => $start,
                'end' => $end,
                'total'=>$total,
                'paystatus'=> $paystatus,
                'date'=>$date
            ]);
        }



        return back();
    }

    public function categorycommissioncheck()
    {
        menuSubmenu('categories', 'categories');
        $user = Auth::user();
       $categories =Category::orderBy('name', 'asc')->get();

       return view('user.employee.categorylist', [
            'user' => $user,
            'categories' => $categories
        ]);

    }

    public function EmployeeReport()
    {
        menuSubmenu('employee_report', 'employee_report');

        $datas = EmployeeReport::where('user_id', Auth::id())->get();

        return view('user.employeeReport.index',compact('datas'));
    }





    public function EmployeeReportAdd()
    {
        menuSubmenu('employee_report', 'employee_report');
        return view('user.employeeReport.addReport');
    }


    public function EmployeeReportUpdate(Request  $request, $id){

        $employee = EmployeeReport::where('id', $id)->first();
        if($request->isMethod('post')){

            $validated = $request->validate([
                'location' => 'required',
                'photo' => 'required',
            ]);

            $image =$request->photo;
            $imageInfo = explode(";base64,", $image);
//            print_r($imageInfo);
            $imgExt = str_replace('data:image/', '', $imageInfo[0]);
            $image = str_replace(' ', '+', $imageInfo[1]);
            $imageName = $employee->id. '_employeereportimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999).".".$imgExt;


            Storage::disk('public')->put('employeereport/' .$imageName, base64_decode($image));






//            if ($pi = $request->image) {
//                $extension = strtolower($pi->getClientOriginalExtension());
//                $randomFileName = $employee->id. '_employeereportimg2_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;
//
//                list($width, $height) = getimagesize($pi);
//                $mime = $pi->getClientOriginalExtension();
//                $size = $pi->getSize();
//
//                $originalName = strtolower($pi->getClientOriginalName());
//
//
////                dd('ok');
//
//                Storage::disk('public')->put('employeereport/' . $randomFileName, File::get($pi));
//
////                return redirect()->route('user.employeeReport');
//            }


            EmployeeReport::where('id', $id)->update(['end_location'=> $request->location, 'end_lat'=> $request->last_lat, 'end_lng' => $request->last_lng, 'last_image' => $imageName, 'status' => 'Done']);
            return redirect()->route('user.employeeReport');
        }
        return  view('user.employeeReport.editReport', compact('employee'));
//        return redirect()->back();

    }


    public function EmployeeReportStore(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required',
            'photo' => 'required',
        ]);

        $userNew = new EmployeeReport();

        $userNew->type = $request->type;
        $userNew->date = $request->date;
        $userNew->note = $request->note;
        $userNew->special_note = $request->special_note;
        $userNew->user_id = Auth::user()->id;
        $userNew->start_location = $request->location;
        $userNew->start_lat = $request->start_lat;
        $userNew->start_lng = $request->start_lng;
        $userNew->status = 'start';
        $userNew->save();



//        $image =$request->photo;
//        $imageInfo = explode(";base64,", $image);
//        print_r($imageInfo);
//        $imgExt = str_replace('data:image/', '', $imageInfo[0]);
//        $image = str_replace(' ', '+', $imageInfo[1]);
//        $imageName = "post-".time().".".$imgExt;
//        $size = $image->getSize();
//        print_r(base64_decode($size));die;



        if ($pi = $request->photo) {


//            $f = 'employeereport/' . $userNew->image;
//            if (Storage::disk('public')->exists($f)) {
//                Storage::disk('public')->delete($f);
//            }

//



            $image =$request->photo;
            $imageInfo = explode(";base64,", $image);
//            print_r($imageInfo);
            $imgExt = str_replace('data:image/', '', $imageInfo[0]);
            $image = str_replace(' ', '+', $imageInfo[1]);
            $imageName = $userNew->id. '_employeereportimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999).".".$imgExt;







            Storage::disk('public')->put('employeereport/' .$imageName, base64_decode($image));

//
//            $extension = strtolower($pi->getClientOriginalExtension());
//            $randomFileName = $userNew->id. '_employeereportimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

//            list($width, $height) = getimagesize($pi);
//            $mime = $pi->getClientOriginalExtension();
//            $size = $pi->getSize();
//
//            $originalName = strtolower($pi->getClientOriginalName());






          //  Storage::disk('public')->put('employeereport/' . $randomFileName, File::get($pi));

            $userNew->image = $imageName;
            $userNew->save();

        }


    	return redirect()->route('user.employeeReport');

    }

    public function myteam()
    {
        menuSubmenu('myteam', 'myteam');
        $user = Auth::user();
        $employeeAll =User::where('group_id',  $user->id)->latest()->paginate(20);

       return view('user.employee.myteam', [
            'user' => $user,
            'employeeAll' => $employeeAll
        ]);

    }


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

            return view('user.employee.createdserviceprofile', [
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
            menuSubmenu('employee', 'employee');
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

            return view('user.employee.createdserviceprofile', [
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





}
