<?php

namespace App\Http\Controllers\Admin;

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
use Illuminate\Http\Request;
use App\Models\BalanceTransaction;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
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
use App\Models\SocialGroup;
use App\Models\Suggestion;
use App\Models\UserUpdateInformation;
use App\Models\WorkStation;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use App\Models\OrderNotifications;
use App\Models\UserRoleItem;
use App\Models\Courseitem;
use App\Models\CourseOrder;
use App\Models\Rating;
use App\Models\EmployeeReport;
use App\Models\SoftcomJobCandidate;
use App\Models\LogActivity;
use App\Models\ServiceProfileWorker;
use Image;
class AdminController extends Controller
{

    // public function purposeChangeToWithdraw()
    // {
    //     BalanceTransaction::where('purpose', 'bkash')->orWhere('purpose', 'mobile_recharge')->update(['purpose' => 'withdraw']);
    //     return redirect('/');
    // }

    public function dashboard(Request $request)
    {

        menuSubmenu('dashboard', 'dashboard');

        $withdrawSum = BalanceTransaction::where(function ($qq) {
            $qq->where('purpose', 'withdraw');
            $qq->orWhere('purpose', 'bkash');
        })->sum('moved_balance');

        $userCount = User::count();

        $me = Auth::user();





        // dd($soft);
        return  view('admin.dashboard', [
            'userCount' => $userCount,
            'user' => $me
        ]);
    }

    public function dashboardmain(Request $request)
    {

        menuSubmenu('dashboard', 'dashboard');

        $withdrawSum = BalanceTransaction::where(function ($qq) {
            $qq->where('purpose', 'withdraw');
            $qq->orWhere('purpose', 'bkash');
        })->sum('moved_balance');

        $userCount = User::count();

        $me = Auth::user();

        $useraddbalance = UserBalanceEdit::where('type','add')->sum('changed_balance');
        $usersubtractbalance = UserBalanceEdit::where('type','subtract')->sum('changed_balance');

        $tenentbalanceaddbyadmin= $useraddbalance-$usersubtractbalance;

        $totalPf = Subscriber::count();

        $paidtotalPf = Subscriber::where('free_account', '0')->count();
        $unpaidtotalpf=Subscriber::where('free_account', '1')->count();

        $totalpaidshop=ServiceProfile::where('paystatus', '1')->count();
        $totalunpaidshop=ServiceProfile::where('paystatus', '0')->count();

        //dd($paidtotalPf);

        $Rental = SubcriberPayment::where('status', 'paid')->sum('amount');
        $totalRental=$Rental+414100;
        //previous rental rewards 414100
        $rewards= ($totalRental *(35/100));

        // $totalDeposit = BalanceTransaction::where('purpose','deposit')->sum('moved_balance');

        $totalDeposit = Order::where('order_for', 'deposit')->where('order_status', 'delivered')->where('payment_status', 'paid')->sum('paid_amount');

        $totalTenantWallet = User::sum(\DB::raw('balance + system_balance'));
        $totalTenantAdbalance=User::sum('ad_balance');
        $totalduebalance=User::sum('due_balance');
        $totalPfBalance = Subscriber::sum('balance');

        $totalwitdraw = BalanceTransaction::where('purpose', 'withdraw')->sum('moved_balance');

        $in = $totalRental + $totalDeposit;

        $present = $totalTenantWallet + $totalPfBalance;

        $softBalance = $in - ($present + $totalwitdraw+$rewards);


        // today total in
        $today = Carbon::today();
        $todaytotalRental = SubcriberPayment::where('status', 'paid')
            ->whereDate('created_at', $today)
            ->sum('amount');

        $todayTotalDeposit = Order::where('order_for', 'deposit')->where('order_status', 'delivered')
            ->where('payment_status', 'paid')
            ->whereDate('created_at', $today)
            ->sum('paid_amount');

        $todayIn = $todaytotalRental + $todayTotalDeposit;

        // today total out (withdrawl)
        $todaytotalwitdraw = BalanceTransaction::where('purpose', 'withdraw')
            ->whereDate('created_at', $today)
            ->sum('moved_balance');

        // today present

        $todaytotalTenantWallet = User::whereDate('created_at', $today)->sum(\DB::raw('balance + system_balance'));
        $todaytotalPfBalance = Subscriber::whereDate('created_at', $today)->sum('balance');

        $todayPresent = $todaytotalTenantWallet + $todaytotalPfBalance;
        $todaysoftBalance = $todayIn - ($todayPresent + $todaytotalwitdraw);


        $todaySoftcodeGive = BalanceTransaction::where('from', 'admin')
            ->whereDate('created_at', $today)
            ->sum('moved_balance');
        $todaySoftcodeGet = BalanceTransaction::where('to', 'admin')
            ->whereDate('created_at', $today)
            ->sum('moved_balance');

        $totalSoftcodeGive = BalanceTransaction::where('from', 'admin')->sum('moved_balance');
        $totalSoftcodeget = BalanceTransaction::where('to', 'admin')->sum('moved_balance');
        //    dd($order);

        // dd($soft);
        return  view('admin.dashboardmain', [
            'userCount' => $userCount,
            'user' => $me,
            'totalPf' => $totalPf,
            'totalRental' => $totalRental,
            'totalDeposit' => $totalDeposit,
            'totalTenantWallet' => $totalTenantWallet,
            'totalPfBalance' => $totalPfBalance,
            'totalwitdraw' => $totalwitdraw,
            'softBalance' => $softBalance,
            'in' => $in,
            'present' => $present,
            'todayIn' => $todayIn,
            'todaytotalwitdraw' => $todaytotalwitdraw,
            'todaysoftBalance' => $todaysoftBalance,
            'todaySoftcodeGive' => $todaySoftcodeGive,
            'todaySoftcodeGet' => $todaySoftcodeGet,
            'totalSoftcodeGive' => $totalSoftcodeGive,
            'totalSoftcodeget' => $totalSoftcodeget,
            // 'order' => $order
            'totalTenantAdbalance'=>$totalTenantAdbalance,
            'tenentbalanceaddbyadmin'=>$tenentbalanceaddbyadmin,
            'rewards'=> $rewards,
            'paidtotalPf'=> $paidtotalPf,
            'unpaidtotalpf'=> $unpaidtotalpf,
            'totalpaidshop'=> $totalpaidshop,
            'totalunpaidshop'=>$totalunpaidshop,
            'totalduebalance'=>$totalduebalance
        ]);
    }
    public function dashboardsalesinfo(Request $request)
    {

        menuSubmenu('dashboard', 'dashboard');

        $withdrawSum = BalanceTransaction::where(function ($qq) {
            $qq->where('purpose', 'withdraw');
            $qq->orWhere('purpose', 'bkash');
        })->sum('moved_balance');

        $userCount = User::count();

        $me = Auth::user();

        $service_item=ServiceProfileProduct::where('active',true)->get()->count();
        $order=ServiceProductOrder::get();
        $total_order=$order->count();
        $total_order_amount=$order->sum('order_confirmed_price');

        $commission= BalanceTransaction::where('to', 'admin')
        ->where('purpose','service_product_commission')
        ->sum('moved_balance');
        $orders = ServiceProductOrder::latest()->take(5)->get();
        $serviceItems = Serviceitem::latest()->take(5)->get();
        $serviceItemOrders= ServicePayment::orderByRaw("FIELD(order_status ,'pending', 'confirmed', 'delivered','satisfied','un_satisfied','canceled') ASC")->latest()->take(5)->get();


        //    dd($order);

        // dd($soft);
        return  view('admin.dashboardsalesinfo', [
            'userCount' => $userCount,
            'user' => $me,
            'service_item'=>$service_item,
            'total_order'=>$total_order,
            'total_order_amount'=>$total_order_amount,
            'commission'=>$commission,
            'serviceItems'=>$serviceItems,
            'serviceItemOrders'=>$serviceItemOrders,
            'orders'=>$orders


        ]);
    }

    public function dashboardtenantinfo(Request $request)
    {

        menuSubmenu('dashboard', 'dashboard');

        $withdrawSum = BalanceTransaction::where(function ($qq) {
            $qq->where('purpose', 'withdraw');
            $qq->orWhere('purpose', 'bkash');
        })->sum('moved_balance');

        $userCount = User::count();

        $me = Auth::user();

        $useraddbalance = UserBalanceEdit::where('type','add')->sum('changed_balance');
        $usersubtractbalance = UserBalanceEdit::where('type','subtract')->sum('changed_balance');

        $tenentbalanceaddbyadmin= $useraddbalance-$usersubtractbalance;

        $totalPf = Subscriber::count();

        $paidtotalPf = Subscriber::where('free_account', '0')->count();
        $unpaidtotalpf=Subscriber::where('free_account', '1')->count();

        $totalpaidshop=ServiceProfile::where('paystatus', '1')->count();
        $totalunpaidshop=ServiceProfile::where('paystatus', '0')->count();

        //dd($paidtotalPf);

        $Rental = SubcriberPayment::where('status', 'paid')->sum('amount');
        $totalRental=$Rental+414100;
        //previous rental rewards 414100
        $rewards= ($totalRental *(35/100));

        // $totalDeposit = BalanceTransaction::where('purpose','deposit')->sum('moved_balance');

        $totalDeposit = Order::where('order_for', 'deposit')->where('order_status', 'delivered')->where('payment_status', 'paid')->sum('paid_amount');

        $totalTenantWallet = User::sum(\DB::raw('balance + system_balance'));
        $totalTenantAdbalance=User::sum('ad_balance');
        $totalduebalance=User::sum('due_balance');
        $totalPfBalance = Subscriber::sum('balance');

        $totalwitdraw = BalanceTransaction::where('purpose', 'withdraw')->sum('moved_balance');

        $in = $totalRental + $totalDeposit;

        $present = $totalTenantWallet + $totalPfBalance;

        $softBalance = $in - ($present + $totalwitdraw);


        // today total in
        $today = Carbon::today();
        $todaytotalRental = SubcriberPayment::where('status', 'paid')
            ->whereDate('created_at', $today)
            ->sum('amount');

        $todayTotalDeposit = Order::where('order_for', 'deposit')->where('order_status', 'delivered')
            ->where('payment_status', 'paid')
            ->whereDate('created_at', $today)
            ->sum('paid_amount');

        $todayIn = $todaytotalRental + $todayTotalDeposit;

        // today total out (withdrawl)
        $todaytotalwitdraw = BalanceTransaction::where('purpose', 'withdraw')
            ->whereDate('created_at', $today)
            ->sum('moved_balance');

        // today present

        $todaytotalTenantWallet = User::whereDate('created_at', $today)->sum(\DB::raw('balance + system_balance'));
        $todaytotalPfBalance = Subscriber::whereDate('created_at', $today)->sum('balance');

        $todayPresent = $todaytotalTenantWallet + $todaytotalPfBalance;
        $todaysoftBalance = $todayIn - ($todayPresent + $todaytotalwitdraw);


        $todaySoftcodeGive = BalanceTransaction::where('from', 'admin')
            ->whereDate('created_at', $today)
            ->sum('moved_balance');
        $todaySoftcodeGet = BalanceTransaction::where('to', 'admin')
            ->whereDate('created_at', $today)
            ->sum('moved_balance');

        $totalSoftcodeGive = BalanceTransaction::where('from', 'admin')->sum('moved_balance');
        $totalSoftcodeget = BalanceTransaction::where('to', 'admin')->sum('moved_balance');
        //    dd($order);

        // dd($soft);
        return  view('admin.dashboardtenantinfo', [
            'userCount' => $userCount,
            'user' => $me,
            'totalPf' => $totalPf,
            'totalRental' => $totalRental,
            'totalDeposit' => $totalDeposit,
            'totalTenantWallet' => $totalTenantWallet,
            'totalPfBalance' => $totalPfBalance,
            'totalwitdraw' => $totalwitdraw,
            'softBalance' => $softBalance,
            'in' => $in,
            'present' => $present,
            'todayIn' => $todayIn,
            'todaytotalwitdraw' => $todaytotalwitdraw,
            'todaysoftBalance' => $todaysoftBalance,
            'todaySoftcodeGive' => $todaySoftcodeGive,
            'todaySoftcodeGet' => $todaySoftcodeGet,
            'totalSoftcodeGive' => $totalSoftcodeGive,
            'totalSoftcodeget' => $totalSoftcodeget,
            // 'order' => $order
            'totalTenantAdbalance'=>$totalTenantAdbalance,
            'tenentbalanceaddbyadmin'=>$tenentbalanceaddbyadmin,
            'rewards'=> $rewards,
            'paidtotalPf'=> $paidtotalPf,
            'unpaidtotalpf'=> $unpaidtotalpf,
            'totalpaidshop'=> $totalpaidshop,
            'totalunpaidshop'=>$totalunpaidshop,
            'totalduebalance'=>$totalduebalance
        ]);
    }

    public function serviceProfilelist()
    {
        // symlink ( storage_path('app/public') , public_path('storage'));

        menuSubmenu('profilelist', 'profilelist');

        $profiles = ServiceProfile::latest()->paginate(50);

        return view('admin.profile.serviceProfilelist', [
            'profiles' => $profiles
        ]);
    }

    public function serviceProfileDetails(Request $request)
    {
        $profile = ServiceProfile::where('id', $request->profile)->first();
        if (!$profile) {
            abort(404);
        }
        return view('admin.profile.serviceProfileDetails', compact('profile'));
    }
    ///
    public function serviceProfileEdit(Request $request)
    {

        $profile = ServiceProfile::where('id', $request->profile)->first();
        $serviceProfileInfos = ServiceProfileInfo::where('category_id', $profile->ws_cat_id)
            ->where('type', 'business')
            ->select('id', 'field_type', 'profile_info_key', 'access_type')
            ->get();
        // return $serviceProfileInfos;
        $category = Category::find($profile->ws_cat_id);

        return view('admin.profile.serviceProfileEdit', compact(
            'profile',
            'serviceProfileInfos',
            'category'
        ));
    }

    public function serviceProfileUpdate(Request $request)
    {

        $request->validate([
            'location' => 'required',

        ]);

        $service_profile = ServiceProfile::where('id', $request->profile_id)->first();
        $service_profile->name = $request->name;
        $service_profile->short_bio = $request->bio;
        $service_profile->zip_code = $request->zip_code;
        $service_profile->city = $request->city;
        $service_profile->country = $request->country;
        $service_profile->location = $request->location;
        $service_profile->address = $request->address;
        $service_profile->expired_at = $request->expired_at;
        $service_profile->lat = $request->lat;
        $service_profile->lng = $request->lng;
        $service_profile->home_delivery = $request->home_delivery ? 1 : 0;
        $service_profile->online_sale = $request->online_sale ? 1 : 0;
        $service_profile->offline_sale = $request->offline_sale ? 1 : 0;
        $service_profile->city = $request->city;
        $service_profile->country = $request->country;
        $service_profile->fixed_location = $request->fixed_location ? 1 : 0;
        $service_profile->package_status = $request->package_status;
        $service_profile->commission = $request->commission;
        $service_profile->website_link = $request->website_link;


        if ($cp = $request->img) {
            $f = 'user/profile/' . $service_profile->img_name;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }

            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $service_profile->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            list($width, $height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size = $cp->getSize();

            $originalName = strtolower($cp->getClientOriginalName());

           // Storage::disk('public')->put('user/profile/' . $randomFileName, File::get($cp));
            Image::make($cp)->fit(160, 160, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/user/profile/' . $randomFileName));

            $service_profile->img_name = $randomFileName;
        }
        if ($cp = $request->cover_image) {
            $f = 'user/profile/cover/' . $service_profile->cover_image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }

            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $service_profile->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            list($width, $height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size = $cp->getSize();

            $originalName = strtolower($cp->getClientOriginalName());

            Storage::disk('public')->put('user/profile/cover/' . $randomFileName, File::get($cp));

            $service_profile->cover_image = $randomFileName;
            $service_profile->save();
        }

        $service_profile->save();

        foreach (json_decode($request->key_values) as $key => $value) {
            $keyv = 'key_' . $value;
            // return $value;
            if ($request[$keyv] != null) {
                $info = ServiceProfileInfo::where('id', $value)->first();

                $service_profile_value = ServiceProfileInfoValue::where('service_profile_info_id', $value)->where('service_profile_id', $service_profile->id)->first();
                if ($service_profile_value) {
                    if ($info) {
                        if (($info->field_type == 'image') or ($info->field_type == 'pdf') or ($info->field_type == 'doc')) {
                            if ($request->file($keyv)) {
                                $ctp = $request->file($keyv);
                                $ext = strtolower($ctp->getClientOriginalExtension());
                                $ctpn = $service_profile->id . $info->field_type . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $ext;
                                $ctpn = strtolower($ctpn);

                                if ($info->field_type == 'image') {
                                    $os = array("png", "bmp", "jpg", "jpeg", "gif");
                                    if (!in_array($ext, $os)) {
                                        return back()->with('error', 'Sorry, you did not upload image file in image field');
                                    }
                                }


                                if ($info->field_type == 'doc') {
                                    $os = array("doc", "docx");
                                    if (!in_array($ext, $os)) {
                                        return back()->with('error', 'Sorry, you did not upload doc (msword) file in doc field');
                                    }
                                }

                                if ($info->field_type == 'pdf') {
                                    $os = array("pdf");
                                    if (!in_array($ext, $os)) {
                                        return back()->with('error', 'Sorry, you did not upload pdf file in pdf field');
                                    }
                                }

                                $f = 'service/profile/' . $service_profile_value->profile_info_value;
                                if (Storage::disk('public')->exists($f)) {
                                    Storage::disk('public')->delete($f);
                                }
                                Storage::disk('public')->put('service/profile/' . $ctpn, File::get($ctp));
                                $service_profile_value->profile_info_value = $ctpn;
                            }
                        } else {
                            $service_profile_value->profile_info_value = trim($request[$keyv]);
                        }
                        $service_profile_value->save();
                    }
                } else {
                    $serviceProfileValue = new ServiceProfileInfoValue;
                    $serviceProfileValue->workstation_id = $service_profile->ownerSubscription->work_station_id;
                    $serviceProfileValue->ws_cat_id = $service_profile->ownerSubscription->work_station_id;
                    $serviceProfileValue->subscriber_id = $service_profile->ownerSubscription->category_id;
                    $serviceProfileValue->user_id = $service_profile->ownerSubscription->user_id;

                    $serviceProfileValue->service_profile_id = $request->profile_id;

                    $serviceProfileValue->service_profile_info_id = $info->id;
                    $serviceProfileValue->profile_info_key = $info->profile_info_key;
                    $serviceProfileValue->field_type = $info->field_type;
                    $serviceProfileValue->access_type = $info->access_type;
                    $serviceProfileValue->profile_card_display = $info->profile_card_display;
                    if (($info->field_type == 'image') or ($info->field_type == 'pdf') or ($info->field_type == 'doc')) {
                        if ($request->file($keyv)) {
                            $ctp = $request->file($keyv);
                            $ext = strtolower($ctp->getClientOriginalExtension());
                            $ctpn = $service_profile->id . $info->field_type . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $ext;
                            $ctpn = strtolower($ctpn);

                            if ($info->field_type == 'image') {
                                $os = array("png", "bmp", "jpg", "jpeg", "gif");
                                if (!in_array($ext, $os)) {
                                    return back()->with('error', 'Sorry, you did not upload image file in image field');
                                }
                            }


                            if ($info->field_type == 'doc') {
                                $os = array("doc", "docx");
                                if (!in_array($ext, $os)) {
                                    return back()->with('error', 'Sorry, you did not upload doc (msword) file in doc field');
                                }
                            }

                            if ($info->field_type == 'pdf') {
                                $os = array("pdf");
                                if (!in_array($ext, $os)) {
                                    return back()->with('error', 'Sorry, you did not upload pdf file in pdf field');
                                }
                            }

                            Storage::disk('public')->put('service/profile/' . $ctpn, File::get($ctp));
                            $serviceProfileValue->profile_info_value = $ctpn;
                        }
                    } else {
                        $serviceProfileValue->profile_info_value = trim($request[$keyv]);
                    }
                    $serviceProfileValue->active = false;
                    $serviceProfileValue->addedby_id = Auth::id();
                    $serviceProfileValue->save();
                }
            }
        }

        \LogActivity::addToLog($service_profile->name. ' This Profile Successfully Updated');
        return back()->with('success', 'Profile Successfully Updated');
    }

    public function serviceProfileDelete(Request $request)
    {
      $checkserviceprofile=ServiceProfileProduct::where('service_profile_id',$request->profile)->count();
      $checkserviceprofile1=ServiceProfileWorker::where('profile_id',$request->profile)->count();

      if($checkserviceprofile>0 || $checkserviceprofile1>0){
        return back()->with('warning', 'Cannot Deleted This Profile. This Profile Depend On Other Table');
      }
        try {
            $service_value = ServiceProfileInfoValue::where('service_profile_id', $request->profile)->get();
            foreach ($service_value as  $value) {
                $field_type = $value->serviceInfo->field_type;
                if (($field_type == 'image') or ($field_type == 'pdf') or ($field_type == 'doc')) {
                    $f = 'service/profile/' . $value->profile_info_value;
                    if (Storage::disk('public')->exists($f)) {
                        Storage::disk('public')->delete($f);
                    }
                }
            }
            ServiceProfileInfoValue::where('service_profile_id', $request->profile)->delete();
            ServiceProfileVisitor::where('service_profile_id', $request->profile)->delete();

            $profile = ServiceProfile::where('id', $request->profile)->first();
            $f = 'user/profile/' . $profile->img_name;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            \LogActivity::addToLog($profile->name. ' This Service profile successfully Deleted');
            $profile->delete();
            return redirect()->back()->with('success', 'Service profile successfully Deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Worng');
        }
    }


    public function profileStatusChange(Request $request)
    {
        $status = $request->status;
        // dd($status);
        $profile = ServiceProfile::find($request->profile);
        if ($status == 'approve') {
            $profile->status = true;
            $profile->paystatus = 1;
            $profile->save();
            \LogActivity::addToLog($profile->name. ' This Profile approved successfully');
            return back()->with('success', 'Profile approved successfully.');
        } elseif ($status == 'deny') {
            $profile->status = "deny";
            // dd($profile);
            $profile->save();
            \LogActivity::addToLog($profile->name. 'This Profile deny successfully.');
            return back()->with('success', 'Profile deny successfully.');
        }
    }

    //Service Products START
    public function serviceProductslist(Request $request)
    {
        menuSubmenu('serviceProducts', 'serviceProducts');
        $products = ServiceProfileProduct::where('status', '!=', 'temp')->has('serviceProfile')->latest()->paginate(50);

        return view('admin.profile.serviceProducts.serviceProducts', compact('products'));
    }

    public function serviceProductUpdate(Request $request)
    {
        $product = ServiceProfileProduct::find($request->product);
        if ($request->type == 'approved') {
            $product->status = 'approved';
            $product->save();
        }
        if ($request->type == 'reject') {
            $product->status = 'reject';
            $product->save();
        }
        if ($request->type == 'archived') { ///If admin want to Delete This post
            $product->status = 'archived';
            $product->save();
        }
        \LogActivity::addToLog($product->name. 'Product Status update to' .$product->status);
        return redirect()->back()->with('success', 'Product Status update to ' . $product->status . '');
    }

    public function serviceProductDetails(Request $request)
    {
        $product = ServiceProfileProduct::where('id', $request->product)->has('serviceProfile')->first();
        return view('admin.profile.serviceProducts.serviceProductdetails', compact('product'));
    }
    //Service Products END
    //Service Item STAET
    public function serviceItems(Request $request)
    {
        menuSubmenu('serviceItems', 'serviceItems');
        $serviceItems = Serviceitem::latest()->paginate(20);
        return view('admin.profile.serviceItems.allServiceItems', compact('serviceItems'));
    }
    public function serviceItemsStatusUpdate(Request $request)
    {
        $item = Serviceitem::find($request->item);
        if (!$item) {
            abort(404);
        }
        $item->status = 'approved';
        $item->save();
        \LogActivity::addToLog($item->title. 'This Service Item Updated Successfully');
        return redirect()->back()->with('success', 'Service Item Updated Successfully');
    }

    public function serviceItemsEdit(Request $request)
    {
        $serviceItem = Serviceitem::find($request->item);
        if (!$serviceItem) {
            abort(404);
        }
        return view('admin.profile.serviceItems.editServiceItem', compact('serviceItem'));
    }
    public function updateServiceItem(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'excerpt' => 'required|string|min:150|max:250',
            'description' => 'required',
            'price' => 'required|numeric',
            'negotiations' => 'nullable',
            'status' => 'required'
        ]);
        $serviceItem = Serviceitem::where('id', $request->item)
            ->first();
        $serviceItem->title = $request->title;
        $serviceItem->excerpt = $request->excerpt;
        $serviceItem->description = $request->description;
        $serviceItem->price = $request->price;
        $serviceItem->negotiations = $request->negotiations ? 1 : 0;
        $serviceItem->active = $request->active ? 1 : 0;
        $serviceItem->addedby_id = Auth::id();
        $serviceItem->status = $request->status;
        $serviceItem->save();
        if ($cp = $request->image) {
            $f = 'product/serviceitems/' . $serviceItem->image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $serviceItem->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            $originalName = strtolower($cp->getClientOriginalName());

            Storage::disk('public')->put('product/serviceitems/' . $randomFileName, File::get($cp));

            $serviceItem->image = $randomFileName;
            $serviceItem->save();
        }
        \LogActivity::addToLog($serviceItem->title. ' This Service Item Updated Successfully');
        return redirect()->back()->with('success', 'Service Item Updated Successfully');
    }
    public function serviceItemsDetails(Request $request)
    {
        $serviceItem= Serviceitem::find($request->item);
        return view('admin.profile.serviceItems.ServiceItemDetails',compact('serviceItem'));
    }
    public function serviceItemOrders(Request $request)
    {
        menuSubmenu('serviceItemOrders','serviceItemOrders');
        $serviceItemOrders= ServicePayment::orderByRaw("FIELD(order_status ,'pending', 'confirmed', 'delivered','satisfied','un_satisfied','canceled') ASC")->paginate(50);
        return view('admin.profile.serviceItems.ServiceItemOrdersList',compact('serviceItemOrders'));
    }
    public function serviceItemOrdersDetails(Request $request)
    {
        $order= ServicePayment::find($request->order);
        return view('admin.profile.serviceItems.ServiceItemOrdersDetails',compact('order'));
    }

    //Service Item END

    //Service Product Orders
    public function serviceProductOrderList(Request $request)
    {
        menuSubmenu('serviceOrders', 'serviceOrders');
        $orders = ServiceProductOrder::orderBy('order_status', 'DESC')->paginate(30);
        return view('admin.profile.serviceProducts.serviceProductsOrders', compact('orders'));
    }
    public function serviceProductOrderDetails(Request $request)
    {
        $user = Auth::user();
        $myProfile = ServiceProfile::where('user_id', Auth::id())->where('id', $request->profile)->where('profile_type', 'business')->first();
        $order = ServiceProductOrder::where('id', $request->order)->first();
        return view('admin.profile.serviceProducts.serviceProductsOrderDetails', compact('myProfile', 'order'));
    }
    //Service Product Orders

  //course item
  public function courseItems(Request $request)
  {
      menuSubmenu('courseItems', 'courseItems');
      $courseItems = Courseitem::latest()->paginate(20);
      return view('admin.profile.course.allCourseItems', compact('courseItems'));
  }

  public function courseItemOrders(Request $request)
  {
      menuSubmenu('courseItemOrders','courseItemOrders');
      $courseItemOrders= CourseOrder::orderByRaw("FIELD(order_status ,'pending', 'confirmed', 'delivered','satisfied','un_satisfied','canceled') ASC")->paginate(50);
      return view('admin.profile.course.allCourseOrders',compact('courseItemOrders'));
  }
  public function courseOrdersDetails(Request $request)
  {
      $order= CourseOrder::find($request->order);
      return view('admin.profile.course.courseOrdersDetails',compact('order'));
  }



  public function courseItemsEdit(Request $request)
  {
      $courseItem = Courseitem::find($request->item);
      if (!$courseItem) {
          abort(404);
      }
      return view('admin.profile.course.coursedit', compact('courseItem'));
  }
  public function updatecourseItem(Request $request)
  {
    $request->validate([
        'title' => 'required|string|max:250',
        'ins_name' => 'required|string|max:250',
        'ins_designation' => 'required',
        'price' => 'required|numeric',
        'negotiations' => 'nullable',
        'status' => 'required',
        //'courseimage'=>'required|mimes:jpg,bmp,png'
      ]);
      $courseItem = Courseitem::where('id', $request->item)->first();
    //   $courseItem->service_profile_id = $serviceProfile->id;
    //   $courseItem->category_id = $serviceProfile->category->id;
    //   $courseItem->workstation_id = $serviceProfile->workstation->id;
    //   $courseItem->subscriber_id = $subscription->id;
      $courseItem->title = $request->title;
      $courseItem->subtitle = $request->subtitle;
      $courseItem->ins_name = $request->ins_name;
      $courseItem->ins_designation = $request->ins_designation;
      $courseItem->whatlearn = $request->whatlearn;
      $courseItem->aboutcourse = $request->aboutcourse;
      $courseItem->coursesyllabus = $request->coursesyllabus;
      $courseItem->hoursdetails = $request->hoursdetails;
      $courseItem->price = $request->price;
      $courseItem->courselink = $request->courselink;
      $courseItem->negotiations = $request->negotiations ? 1 : 0;
      $courseItem->active = $request->active ? 1 : 0;
      $courseItem->status = $request->status;
      $courseItem->addedby_id = Auth::id();
      $courseItem->save();
    if ($cp = $request->courseimage) {
      $f = 'product/courseitems/' . $courseItem->courseimage;
      if (Storage::disk('public')->exists($f)) {
        Storage::disk('public')->delete($f);
      }

      $extension = strtolower($cp->getClientOriginalExtension());
      $randomFileName = $courseItem->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

      $originalName = strtolower($cp->getClientOriginalName());

      Storage::disk('public')->put('product/courseitems/' . $randomFileName, File::get($cp));

      $courseItem->courseimage = $randomFileName;
      $courseItem->save();
    }

    \LogActivity::addToLog($courseItem->title. 'This Course Item Updated Successfully');
      return redirect()->back()->with('success', 'Course Item Updated Successfully');
  }

  public function courseItemsDelete($item)
  {
      $checkcourseorder=CourseOrder::where('course_id',$item)->count();
      if($checkcourseorder<1){
        $course= Courseitem::find($item);

        \LogActivity::addToLog($course->title. 'This Course Item Delete Successfully');
        $course->delete();
        return redirect()->back()->with('success', 'Course Item Delete Successfully');

      }else{
        return redirect()->back()->with('warning', 'Course Item Depend On Order Table');
      }

  }


  //end Course





    public function messages()
    {
        menuSubmenu('Messages', 'Messages');
        $messageFrom = auth()->user();
        $conversations = auth()->user()->messageContacts();
        return view('admin.messages', compact('messageFrom', 'conversations'));
    }
    public function message(User $messageTo)
    {
        menuSubmenu('Messages', 'Messages');
        $messageFrom = auth()->user();
        if ($messageFrom->id == $messageTo->id) {
            abort(401);
        }

        $conversation = auth()->user()->messageWithUser($messageTo);
        $conversations = auth()->user()->messageContacts();


        return view('admin.messages', compact('messageFrom', 'messageTo', 'conversation', 'conversations'));
    }

    public function deviceSearch(Request $request)
    {
        $q = $request->q;
        $items = Product::where(function ($query) use ($q) {
            $query->where('macid', 'like', "%{$q}%");
            $query->orWhere('title', 'like', "%{$q}%");
            $query->orWhere('region', 'like', "%{$q}%");
            $query->orWhere('zone', 'like', "%{$q}%");
        })
            ->paginate(20);

        return view('admin.productsAll', [

            'q' => $request->q,
            'items' => $items

        ]);
    }

    public function companyAllData(Company $company, Request $request)
    {
        $type = $request->type ?: null;
        // dd($company);
        $settingData = $company->productSettingDatas()
            ->whereHas('product', function ($query) use ($type) {
                if ($type == 'battery') {
                    $query->where('type', $type);
                } elseif ($type == 'rectifier') {
                    $query->where('type', $type);
                }

                if ($d = request()->device) {
                    $query->where('product_id', $d);
                }
            })
            ->latest()->paginate(15);



        return view('admin.productsAllActivities', [
            'company' => $company,

            'settingDatas' => $settingData,
            'type' => $type
        ]);
    }

    public function companiesAll(Request $request)
    {
        $status = $request->status ?: '';
        menuSubmenu('company', 'companiesAll' . $status);

        $companiesAll = Company::orderBy('title')
            ->where(function ($query) use ($status) {

                if ($status == 'active') {
                    $query->where('status', $status);
                } elseif ($status == 'inactive') {
                    $query->where('status', $status);
                } else
                    $query->where('status', '<>', 'temp');
            })
            ->paginate(50);

        return view('admin.companiesAll', ['companiesAll' => $companiesAll, 'status' => $status]);
    }

    public function singleDeviceMap(Company $company, Request $request)
    {
        $products = Product::where('macid', $request->macid)->first();

        // $datas = $product->productLocationDatas()->latest()->paginate(2);
        // dd($datas);
        $product = $products->productLocationDatas()->latest()->first();

        if ($product) {
            return view('admin.singleDeviceMapLocation', [
                'product' => $product,
                'company' => $company
            ]);
        }
        Session::flash('message', "Device Location Not Found");
        return back();
    }

    public function allProduct(Request $request)
    {
        $type = $request->type ?: '';
        $company_id = $request->company ?: null;

        menuSubmenu('device', 'productsAll' . $type);

        $data =  Product::where('status', 'active')
            ->where(function ($query) use ($type, $company_id) {
                if ($type == 'battery') {
                    $query->where('type', $type);
                } elseif ($type == 'rectifier') {
                    $query->where('type', $type);
                }

                if ($company_id) {
                    $query->where('company_id', $company_id);
                }
            })
            ->has('company')
            ->paginate(20);
        // dd($data);
        return view('admin.productsAll', [
            'items' => $data,
            'type' => $type,
            'company_id' => $company_id
        ]);
    }

    public function productsAllOfType(Request $request)
    {
        $type = $request->type;
        $status = $request->status;
        $company_id = $request->company ?: null;
        menuSubmenu('device', 'productsType' . $type . $status);

        $products =  Product::where('status', 'active')
            ->where(function ($qq) use ($type, $status, $company_id) {

                $qq->where('type', $type);

                if ($status == 'online') {
                    $qq->where('location_offline', 0);
                } elseif ($status == 'offline') {
                    $qq->where('location_offline', 1);
                }

                if ($company_id) {
                    $qq->where('company_id', $company_id);
                }
            })

            ->has('company')

            ->paginate(20);
        return view('admin.productsAll', [
            'items' => $products,
            'type' => $type,
            'company_id' => $company_id
        ]);
    }



    public function allLatestData(Request $request)
    {
        $type = $request->type ?: '';
        menuSubmenu('dataMonitor', 'latestAll' . $type);

        $settingDatas = ProductSettingData::where('macid', '<>', null)
            ->whereHas('product', function ($query) use ($type) {
                if ($type == 'battery') {
                    $query->where('type', $type);
                } elseif ($type == 'rectifier') {
                    $query->where('type', $type);
                }
            })
            ->latest()->paginate(15);
        // dd($settingDatas);
        return view('admin.latestAllData', [
            'settingDatas' => $settingDatas,
            'type' => $type
        ]);
    }

    public function singleDeviceSingleDataDetails(ProductSettingData $data)
    {
        $products = Product::where('status', 'active')->pluck('id');

        $alarms = ProductAlarmData::whereIn('product_id', $products)
            ->where('macid', $data->macid)
            ->where('hide', 0)
            ->orderBy('send_time', 'desc')
            ->latest()
            ->paginate(50);

        return view('admin.singleDeviceSingleDataDetails', [

            'sd' => $data,
            'product' => $data->product,
            'alarmData' => $alarms,
        ]);
    }

    public function filterData(Request $request)
    {
        $type = $request->type;
        menuSubmenu('dataMonitor', 'filterData' . $type);
        $companies = Company::all();
        $products = Product::all();

        return view('admin.allFilterData', [
            'companies' => $companies,
            'products' => $products,
            'type' => $type
        ]);
    }

    public function searchData(Request $request)
    {
        $type = $request->type;
        menuSubmenu('dataMonitor', 'filterData' . $type);

        $products = Product::all();
        $companies = Company::all();
        $fromDate = $request->from ?: date('Y-m-d');
        $toDate = $request->to ?: date('Y-m-d');
        $comps = $request->comps;
        $macids = $request->macids;
        $page = $request->pages ?: 20;

        $items = ProductSettingData::whereBetween('created_at', [$fromDate . " 00:00:00", $toDate . " 23:59:59"])
            ->where(function ($query) use ($macids, $comps) {

                if ($macids) {
                    $query->whereIn('macid', $macids);
                }

                if ($comps) {
                    $query->whereIn('company_id', $comps);
                }
            })
            ->whereHas('product', function ($qq) use ($type) {
                if ($type == 'battery') {
                    $qq->where('type', $type);
                } elseif ($type == 'rectifier') {
                    $qq->where('type', $type);
                }
            })
            ->latest()
            ->paginate($page);

        // dd($comps);

        return view('admin.dataSearch', [
            'items' => $items,
            'filter' => $request->filter ?: [],
            'macids' => $request->macids ?: [],
            'from' => $fromDate,
            'to' => $toDate,
            'companies' => $companies,
            'comps' => $comps ?: [],
            'products' => $products,
            'pages' => $page,
            'type' => $type

        ]);
    }

    public function alarmDatasearch(Request $request)
    {
        menuSubmenu('alarm', 'alarmFilter');
        $companies = Company::all();
        $products = Product::all();

        $fromDate = $request->from ?: date('Y-m-d');
        $toDate = $request->to ?: date('Y-m-d');

        $fDate = strtotime($fromDate) * 1000;
        $tDate = strtotime($toDate) * 1000;

        $macids = $request->macids;
        $comps = $request->comps;

        $page = $request->pages ?: 20;

        $items = ProductAlarmData::whereBetween('send_time', [$fDate, $tDate])
            ->where(function ($query) use ($macids, $comps) {
                if ($macids) {
                    $query->whereIn('macid', $macids);
                }

                if ($comps) {
                    $query->whereIn('company_id', $comps);
                }
            })
            ->latest()
            ->paginate($page);

        // dd($items);

        return view('admin.alarmSearch', [
            'companies' => $companies,
            'products' => $products,
            'items' => $items,
            'macids' => $request->macids ?: [],
            'from' => $fromDate,
            'to' => $toDate,
            'comps' => $comps ?: [],
            'pages' => $page


        ]);
    }

    public function allAlarmData(Request $request)
    {
        $company_id = $request->company ?: null;

        menuSubmenu('alarm', 'alarmAll');
        $datas = ProductAlarmData::where('macid', '<>', null)
            ->where(function ($query) use ($company_id) {
                if ($company_id) {
                    $query->where('company_id', $company_id);
                }

                if ($d = request()->device) {
                    $query->where('product_id', $d);
                }
            })
            ->latest()->paginate(15);
        return view('admin.allAlarmsData', [
            'datas' => $datas,
        ]);
    }

    public function alarmDataFilter()
    {
        menuSubmenu('alarm', 'alarmFilter');
        $company = Company::all();
        $products = Product::all();
        // dd($products);
        return view('admin.alarmFilter', [
            'company' => $company,
            'products' => $products
        ]);
    }

    public function companyEdit(Company $company)
    {
        return view('admin.companyEdit', ['company' => $company]);
    }

    public function  usersAll(Request $request)
    {
        if (!Auth::user()->hasPermission('tenant')) {
            abort(401);
        }

        menuSubmenu('user', 'usersAll');

        if ($request->user) {
            $usersAll = User::withoutGlobalScopes()->where('id', $request->user)->latest()->paginate(20);
        } else {
            $usersAll = User::withoutGlobalScopes()->latest()->paginate(20);
        }


        return view('admin.users.usersAll', ['usersAll' => $usersAll]);
    }

    public function  employeeAll(Request $request)
    {
        if (!Auth::user()->hasPermission('employee')) {
            abort(401);
        }

        menuSubmenu('employee', 'employeeAll');

        if ($request->user) {
            $employeeAll = User::withoutGlobalScopes()->where('is_employee', 1)->where('id', $request->user)->latest()->paginate(20);
        } else {
            $employeeAll = User::withoutGlobalScopes()->where('is_employee', 1)->latest()->paginate(20);
        }


        return view('admin.employee.employeeAll', ['employeeAll' => $employeeAll]);
    }

    public function  freelancerAll(Request $request)
    {
        if (!Auth::user()->hasPermission('freelancer')) {
            abort(401);
        }

        menuSubmenu('freelancer', 'freelancerAll');

        if ($request->user) {
            $freelancerAll = User::withoutGlobalScopes()->where('is_freelancer', 1)->where('id', $request->user)->latest()->paginate(20);
        } else {
            $freelancerAll = User::withoutGlobalScopes()->where('is_freelancer', 1)->latest()->paginate(20);
        }


        return view('admin.freelancer.freelancerAll', ['freelancerAll' => $freelancerAll]);
    }

    public function companyOwnerAdd(Company $company, Request $request)
    {
        $user = User::where('active', true)->where('id', $request->user)->first();

        if ($user) {
            $company->user_id = $user->id;
            $company->save();

            if ($request->ajax()) {
                return Response()->json([

                    'success' => true

                ]);
            }
        }

        if ($request->ajax()) {
            return Response()->json([

                'success' => false

            ]);
        }

        return back();
    }

    public function newUserCreate()
    {
        // menuSubmenu('user','newUserCreate');

        return  view('admin.newUserCreate');
    }

    public function companyUpdate(Company $company, Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'title' => ['required', 'string', 'max:255', 'min:3'],
                'description' => ['nullable', 'string', 'max:255'],
                'company_code' => ['nullable', 'string'],
                // 'login_password' => ['nullable','string'],
                // 'login_type' => ['nullable'],
                'mobile' => ['nullable'],
                'email' => ['nullable'],
                'address' => ['nullable'],
                'zip_code' => ['nullable'],
                'city' => ['nullable'],
                'status' => ['nullable'],
                'country' => ['nullable'],

            ]
        );

        if ($validation->fails()) {

            return back()
                ->with('warning', 'Please, fill-up all the fields correctly and try again')
                ->withInput()
                ->withErrors($validation);
        }

        $company->title = $request->title ?: $company->title;
        $company->description = $request->description ?: null;
        $company->company_code = $request->company_code ?: $company->company_code;
        // $company->login_password = $request->login_password ?: $company->login_password;
        // $company->login_type = $request->login_type ?: $company->login_type;
        $company->mobile = $request->mobile ?: $company->mobile;
        $company->email = $request->email ?: $company->email;
        $company->address = $request->address ?: $company->address;
        $company->zip_code = $request->zip_code ?: $company->zip_code;
        $company->city = $request->city ?: $company->city;
        $company->country = $request->country ?: $company->country;
        $company->status = $request->status ? 'active' : 'inactive';
        $company->editedby_id = Auth::id();




        if ($request->hasFile('logo')) {
            $cp = $request->file('logo');
            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $company->id . '_logo_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            #delete old rows of profilepic
            Storage::disk('upload')->put('company/logo/' . $randomFileName, File::get($cp));

            if ($company->logo_name) {
                $f = 'company/logo/' . $company->logo_name;
                if (Storage::disk('upload')->exists($f)) {
                    Storage::disk('upload')->delete($f);
                }
            }

            $company->logo_name = $randomFileName;
        }

        $company->save();
        \LogActivity::addToLog('Company Successfully Updated');

        return redirect()->route('admin.companyEdit', $company)->with('success', 'Company successfully updated.');
    }

    public function companyAddNew(Request $request)
    {
        menuSubmenu('company', 'companyAddNew');
        $company = Company::where('status', 'temp')->where('addedby_id', Auth::id())->latest()->first();
        if (!$company) {
            $company = new Company;
            $company->status = 'temp';
            $company->addedby_id = Auth::id();
            $company->save();
        }

        return view('admin.companyAddNew', ['company' => $company]);
    }

    public function newUserCreatePost(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255', 'min:3'],
                'email' => ['required', 'string', 'email', 'unique:users', 'max:255'],
                'mobile' => ['required', 'string'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'active' => ['nullable']

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->active = $request->active ? true : false;

        $user->addedby_id = Auth::id();
        $user->save();
        return back()->with('success', 'New user successfully created');
    }

    public function userEdit()
    {
        $user = User::withoutGlobalScopes()->where('id', request()->user)->firstOrFail();
        $users = User::where('is_tso',true)->where('is_employee',true)->get();
        $userBalanceEdits = UserBalanceEdit::where('user_id', request()->user)->orderBy('id', 'DESC')->paginate(20);
        $user_update_informations = UserUpdateInformation::where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(20);
        // dd($user_update_informations);

        // $standard_subscriber= $user->subscriber->where('free_account',0)->where('user_id',Auth::id())->get();
        $subscription = Subscriber::where('user_id', '!=', request()->user)
            ->where('free_account', false)
            ->where('referral_id', '!=', null)
            ->get();
        $notes = Note::where('user_id', $user->id)->paginate(30);
        $paidshop = ServiceProfile::where('user_id', $user->id)->where('paystatus', 1)->where('status', true)->count();
        $unpaidshop = ServiceProfile::where('user_id', $user->id)->where('paystatus', 0)->count();
        // return $subscription;
        return view('admin.userEdit', ['user' => $user,'users' => $users, 'paidshop' => $paidshop,'unpaidshop' => $unpaidshop,'ubes' => $userBalanceEdits, 'user_update_informations' => $user_update_informations, 'subscription' => $subscription, 'notes' => $notes]);
    }
    public function addUserNote(Request $request)
    {
        $user = User::find($request->user);
        if (!$user) {
            return back();
        }
        $request->validate([
            'note' => 'required',
            'image' => 'nullable'
        ]);

        $note = new Note;
        $note->note = $request->note;
        $note->user_id = $user->id;
        $note->addedby_id = Carbon::now();
        $note->save();
        if ($np = $request->image) {
            $extension = strtolower($np->getClientOriginalExtension());
            $randomFileName = $note->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;
            Storage::disk('public')->put('user/note/' . $randomFileName, File::get($np));
            $note->image = $randomFileName;
            $note->save();
        }


        return redirect()->back()->with('success', 'Note Successfully Added');
    }
    public function noteUpdate(Request $request)
    {
        $note = Note::find($request->note);
        if (!$note) {
            return back();
        }
        $note->note = $request->note_details;
        $note->editedby_id = Auth::id();
        $note->updated_at = Carbon::now();
        $note->save();
        if ($np = $request->image) {
            $f = 'user/note/' . $note->image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $extension = strtolower($np->getClientOriginalExtension());
            $randomFileName = $note->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;
            Storage::disk('public')->put('user/note/' . $randomFileName, File::get($np));
            $note->image = $randomFileName;
            $note->save();
        }
        return redirect()->back()->with('success', 'Note Successfully Updated');
    }
    public function deleteUserNote(Request $request)
    {
        $note = Note::find($request->note);
        if (!$note) {
            return back();
        }
        $note->delete();
        return redirect()->back()->with('success', 'User Note Deleted Successfully');
    }
    public function updateReferrals(Request $request)
    {
        // return $request->subscriber;
        $ref = $request->subscriber;
        $user = User::where('id', $request->user)->first();
        if (!$user->subscriber) {
            return redirect()->back()->with('warning', 'This User donn\'t have any Subscription. Please Subscribe and try again');
        }

        $user->singleReffer()->update([
            'referral_id' => $ref
        ]);


        return redirect()->back()->with('success', 'Reffer Changed Successfuly');
    }

    public function selectNewReffer(Request $request)
    {
        $subscription = Subscriber::where('user_id', '!=', request()->user)
            ->where('id', 'like', '%' . $request->q . '%')
            ->orWhere('subscription_code', 'like', '%' . $request->q . '%')
            ->orWhere('user_id', 'like', '%' . $request->q . '%')
            ->orWhere('name', 'like', '%' . $request->q . '%')
            ->where('free_account', false)
            ->take(10)->get();
        // $users = User::where('email', 'like', '%' . $request->q . '%')
        //     // ->orWhere('username', 'like', '%'.$request->q.'%')
        //     // ->orWhere('name', 'like', '%'.$request->q.'%')
        //     ->orWhere('mobile', 'like', '%' . $request->q . '%')
        //     ->select(['id', 'mobile', 'email'])->take(30)->get();
        if ($subscription->count()) {
            if ($request->ajax()) {
                // return Response()->json(['items'=>$users]);
                return $subscription;
            }
        } else {
            if ($request->ajax()) {
                return $subscription;
            }
        }
    }

    public function userUpdate(Request $request)
    {
        // return $request->status_auto_change_date;
        $user = User::withoutGlobalScopes()->where('id', request()->user)->firstOrFail();
        $user_update_info = new UserUpdateInformation;
        $status = $request->status;

        if ($status == 'basic') {
            $validation = Validator::make(
                $request->all(),
                [
                    'name' => ['required', 'string', 'max:255', 'min:3'],
                    // 'email' => ['required', 'string','email', 'unique:users,email,'.$user->id, 'max:255'],
                    // 'mobile' => ['required', 'string'],
                    // 'password' => ['nullable', 'string', 'min:6', 'confirmed'],
                    'active' => ['nullable'],
                    'status_auto_change_date' => ['nullable'],
                    'referral' => ['nullable'],

                ]
            );

            if ($validation->fails()) {

                return back()
                    ->withInput()
                    ->withErrors($validation);
            }
            if ($user->name != $request->name) {
                $user_update_info->previus_name = $user->name;
                $user_update_info->new_name = $request->name;
            }
            if ($user->mobile != $request->mobile) {
                $user_update_info->previus_mobile = $user->mobile;
                $user_update_info->new_mobile = $request->mobile;
            }

            if ($user->active != $e = $request->active ? 1 : 0) {
                $user_update_info->active = $user->active;
                $user_update_info->active = $e;
            }
            $user->referral = $request->referral ? 1 : 0;
            $user->is_employee = $request->is_employee ? 1 : 0;
            $user->is_freelancer = $request->is_freelancer ? 1 : 0;
            $user->is_vendor = $request->is_vendor ? 1 : 0;
            $user->is_tso = $request->is_tso ? 1 : 0;
            $user->group_id = $request->group_id;


            if (($user->name != $request->name) or ($user->mobile != $request->mobile) or ($user->active != $e = $request->active ? 1 : 0)) {
                $user_update_info->description = Auth::user()->name . ' Edited manually!!';
                $user_update_info->user_id = $user->id;
                $user_update_info->addedby_id = Auth::id();
                $user_update_info->save();
            }




            $user->name = $request->name ?: $user->name;
            $user->email = $request->email ?: $user->email;
            $user->status_auto_change_date = $request->status_auto_change_date;

            if (Auth::user()->roleItems()->count() < 1) {
                $user->mobile = $request->mobile ?: $user->mobile;
            }
            // $user->password = $request->password ? Hash::make($request->password) : $user->password;
            $user->active = $request->active ? true : false;
            // $user->wallet_lock = $request->wallet_lock ? true : false;
            $user->addedby_id = Auth::id();
            $user->save();




            return back()->with('success', 'Tenant basic info successfully updated');
        }
        if ($status == 'balance') {
            $validation = Validator::make(
                $request->all(),
                [
                    'balance' => ['nullable', 'numeric', 'min:0'],
                    'system_balance' => ['nullable', 'numeric', 'min:0'],
                    'honorarium_earning_set' => ['numeric', 'min:0', 'max:100']
                    // 'password' => ['nullable', 'string', 'min:6', 'confirmed'],
                    // 'active'=> ['nullable']

                ]
            );

            if ($validation->fails()) {

                return back()
                    ->withInput()
                    ->withErrors($validation);
            }

            $userPreviousTotalBalance = $user->balance + $user->system_balance;
            $employeePreviousTotalBalance = $user->employee_balance;

            // dd($userPreviousTotalBalance);

            $b = $request->has('balance') ? $request->balance : $user->balance;
            $user->balance = $b;
            $ad = $request->has('ad_balance') ? $request->ad_balance : $user->ad_balance;
            $user->ad_balance = $ad;

            $eb = $request->has('employee_balance') ? $request->employee_balance : $user->employee_balance;
            $user->employee_balance = $eb;

            $sb = $request->has('system_balance') ? $request->system_balance : $user->system_balance;
            if ($sb == null) {
                $sb = 0;
            }
            $user->system_balance = $sb;
            $user->honorarium_earning_set = $request->honorarium_earning_set ? $request->honorarium_earning_set : 100;
            $user->wallet_lock = $request->wallet_lock ? true : false;
            $user->withdraw_lock = $request->withdraw_lock ? true : false;
            $user->purchase_lock = $request->purchase_lock ? true : false;
            $user->save();

            $userNewBalance = $user->balance + $user->system_balance;

            $employeeNewBalance = $user->employee_balance;

            $ube = new UserBalanceEdit; // user balance edit

            $ube->user_id = $user->id;

            $ube->previous_balance = $userPreviousTotalBalance; //100a
            $ube->new_balance = $userNewBalance; // 150a
            $ube->note = $request->note; // 150a
            if ($userPreviousTotalBalance > $userNewBalance) {
                // negetive
                $ube->changed_balance = $userPreviousTotalBalance - $userNewBalance;
                $ube->type = 'subtract';
            } else {
                // positive
                $ube->changed_balance = $userNewBalance - $userPreviousTotalBalance; // 150a - 100a = 50
                $ube->type = 'add';
            }

            $ube->employee_previous_balance = $employeePreviousTotalBalance; //100a
            $ube->employee_new_balance = $employeeNewBalance; // 150a
            $ube->note = $request->note; // 150a
            if ($employeePreviousTotalBalance > $employeeNewBalance) {
                // negetive
                $ube->employee_changed_balance = $employeePreviousTotalBalance - $employeeNewBalance;
                $ube->employee_type = 'subtract';
            } else {
                // positive
                $ube->changed_balance = $employeeNewBalance - $employeePreviousTotalBalance; // 150a - 100a = 50
                $ube->employee_type = 'add';
            }

            $ube->addedby_id = Auth::id();
            $ube->save();

            return back()->with('success', 'Tenant balance successfully Updated');
        }

        return back();
    }

    public function newTempPassSendPost(Request $request)
    {
        $user = User::withoutGlobalScopes()->where('id', request()->user)->firstOrFail();
        // dd($request->all());
        $validation = Validator::make(
            $request->all(),
            [
                'new_password' => 'required|min:6'
            ]
        );
        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Something Went Worng!');
        }
        if ($user->balance < 2) {
            return redirect()->back()->with('warning', 'User Balance Less then 2 taka. please recharge and try again');
        }

        if ($user->mobile) {
            if (strlen(bdMobile($user->mobile)) != 13) {
                return back()->with('warning', 'Mobile Number Not Valid');
            }
        } else {
            return redirect()->back()->with('warning', 'Mobile Number Not found');
        }

        $user->password_temp = $request->new_password;
        $user->password = Hash::make($request->new_password);
        $user->save();

        $messages="Dear {$user->name}, Your Soft Commerce Mobile : {$user->mobile} and new Password : {$user->password_temp} www.sc-bd.com"; //150 characters allowed here
        $number=$user->mobile;
        $SendSms=new SendSms;
        try {
            // Send a message using the primary device.
            $msg = $SendSms->sendSingleMessage($number,$messages);

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        //$user->passwordResetSmsSend();
        $user->decrement('balance', 2);
        // Transiction
        $bt = new BalanceTransaction;
        $bt->from = 'user';
        $bt->to = 'admin';
        $bt->purpose = 'update_password';
        $bt->subscriber_id = null;
        $bt->user_id = $user->id;
        $bt->previous_balance = $user->balance;  // user old balance
        $bt->moved_balance = 2; // job cost
        $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
        $bt->type = 'user';
        $bt->details = "Dear {$user->name}, Your softcodeint Mobile : {$user->mobile} and new Password : {$user->password_temp} www.softcodeint.com";
        $bt->type_id = $user->id;
        $bt->addedby_id = Auth::id();
        $bt->save();

        return back()->with('success', "New temporary password set for {$user->username}");
    }

    public function userCompanies(User $user)
    {
        $companiesAll = $user->companies()->where('status', '<>', 'temp')->orderBy('title')->paginate(100);
        return view('admin.userCompanies', ['user' => $user, 'companiesAll' => $companiesAll]);
    }
    //Opinion Start
    public function opinions(Request $request)
    {
        menuSubmenu('opinions', 'allopinions');
        $all_opinions = Opinion::orderBy('id', 'DESC')->orderBy('status', 'DESC')->paginate(100);
        return view('admin.opinions.opinions', compact('all_opinions'));
    }
    public function viewOpinion(Request $request)
    {
        $opinion = Opinion::where('id', $request->opinion)->first();
        if (!$opinion) {
            return redirect()->back();
        }
        return view('admin.opinions.view', compact('opinion'));
    }
    public function editOpinion(Request $request)
    {
        $user_opinion = Opinion::where('id', $request->opinion)->first();
        return view('admin.opinions.edit', compact('user_opinion'));
    }
    public function updateOpinion(Request $request)
    {
        $request->validate([
            'opinion' => 'required'
        ]);
        $update_opinion = Opinion::where('id', $request->opinion_id)->first();
        $update_opinion->opinion = $request->opinion;
        $update_opinion->featured = $request->featured ? 1 : 0;
        $update_opinion->save();
        return redirect()->back()->with('success', 'Opinion Updated Successfully ');
    }

    public function updateOpinionStatus(Request $request)
    {
        $opinion_status_update = Opinion::where('id', $request->opinion)->first();
        if ($request->status == 'cancled') {
            $opinion_status_update->status = 'cancled';
        } elseif ($request->status == 'lived') {
            $opinion_status_update->status = 'lived';
        } elseif ($request->status == 'featured') {
            $opinion_status_update->featured = true;
        } else {
            return back();
        }
        $opinion_status_update->save();
        return redirect()->back()->with('success', 'Opinion Status updated to ' . $opinion_status_update->status . '');
    }
    public function deleteOpinion(Request $request)
    {
        try {
            Opinion::where('id', $request->opinion)->delete();
            return redirect()->back()->with('success', 'Opinion Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Something Worng');
        }
    }

    //Opinion End

    public function companyProducts(Company $company)
    {

        return view('admin.servicesAll', ['company' => $company, 'items' => $object->rows]);
    }


    public function productStatus(Company $company, Request $request)
    {


        $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=BMSrealTimeState&mds={$company->mds}&macid={$request->macid}&_r={time()}";
        // dd($url);
        $client = new Client();

        try {
            $r = $client->request('GET', $url);
            $result = $r->getBody()->getContents();

            $arr = json_decode($result, true);

            if ($arr['success'] == 'true') {
                $data = $arr['data'][0];
                $state = json_decode($data['State'], true);
            } else {
                if ($request->ajax()) {

                    return Response()->json([
                        'view' => View('admin.includes.modals.productStatusModalLg', [
                            'company' => null,
                            'state' => null,
                            'macid' => $request->macid,
                            'platenumber' => $request->platenumber
                        ])->render(),
                        'success' => false,
                    ]);
                }
            }
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            // This is will catch all connection timeouts
            // Handle accordinly
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // This will catch all 400 level errors.
            // return $e->getResponse()->getStatusCode();
        }

        if ($request->ajax()) {


            return Response()->json([
                'view' => View('admin.includes.modals.productStatusModalLg', [
                    'company' => $company,
                    'state' => $state,
                    'macid' => $request->macid,
                    'platenumber' => $request->platenumber
                ])->render(),

                'success' => $arr['success'] == 'true' ? true : false,
            ]);
        }

        return back();
    }

    public function productSettings(Company $company, Request $request)
    {


        $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=BMSrealTimeState&mds={$company->mds}&macid={$request->macid}&_r={time()}";
        // dd($url);
        $client = new Client();

        try {
            $r = $client->request('GET', $url);
            $result = $r->getBody()->getContents();

            $arr = json_decode($result, true);

            if ($arr['success'] == 'true') {
                $data = $arr['data'][0];

                $setting = json_decode($data['Seting'], true);
            } else {
                if ($request->ajax()) {

                    return Response()->json([
                        'view' => View('admin.includes.modals.productSettingsModalLg', [
                            'company' => null,
                            'setting' => null,
                            'macid' => $request->macid,
                            'platenumber' => $request->platenumber
                        ])->render(),
                        'success' => false,
                    ]);
                }
            }
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            // This is will catch all connection timeouts
            // Handle accordinly
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // This will catch all 400 level errors.
            // return $e->getResponse()->getStatusCode();
        }

        if ($request->ajax()) {


            return Response()->json([
                'view' => View('admin.includes.modals.productSettingsModalLg', [
                    'company' => $company,
                    'setting' => $setting,
                    'macid' => $request->macid,
                    'platenumber' => $request->platenumber
                ])->render(),

                'success' => $arr['success'] == 'true' ? true : false,
            ]);
        }

        return back();
    }

    public function productVersion(Company $company, Request $request)
    {


        $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=GetBmsSNInfo&mds={$company->mds}&Macid={$request->macid}&Key=BMS_Version&_r={time()}";
        $client = new Client();

        try {
            $r = $client->request('GET', $url);
            $result = $r->getBody()->getContents();

            $arr = json_decode($result, true);


            if ($arr['success'] == 'true') {
                $data = json_decode($arr['data'][0], true);
            } else {
                if ($request->ajax()) {

                    return Response()->json([
                        'view' => View('admin.includes.modals.productVersionModalLg', [
                            'company' => null,
                            'data' => null,
                            'macid' => $request->macid,
                            'platenumber' => $request->platenumber
                        ])->render(),
                        'success' => false,
                    ]);
                }
            }
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            // This is will catch all connection timeouts
            // Handle accordinly
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // This will catch all 400 level errors.
            // return $e->getResponse()->getStatusCode();
        }

        if ($request->ajax()) {


            return Response()->json([
                'view' => View('admin.includes.modals.productVersionModalLg', [
                    'company' => $company,
                    'data' => $data,
                    'macid' => $request->macid,
                    'platenumber' => $request->platenumber
                ])->render(),

                'success' => $arr['success'] == 'true' ? true : false,
            ]);
        }

        return back();
    }



    public function companyDetails(Company $company)
    {
        // dd($company);
        return view('admin.companyDetails', ['company' => $company]);
    }

    // public function companyDelete(Company $company)
    // {
    // 	if($company->logo_name)
    //     {
    //         $f = 'company/logo/'.$company->logo_name;
    //         if(Storage::disk('upload')->exists($f))
    //         {
    //             Storage::disk('upload')->delete($f);
    //         }
    //     }

    //     // $company->products()->delete();
    //     // $company->productDatas()->delete();
    //     // $company->productSettingDatas()->delete();
    //     // $company->productAlarmDatas()->delete();
    //     // $company->productLocationDatas()->delete();
    //     // $company->productRectDataItems()->delete();
    //     // $company->productRectDatas()->delete();
    //     // $company->subroleitems()->delete();
    //     // $company->subroles()->delete();


    //     $company->delete();


    //     return back()->with('success', 'Company successfully deleted');


    // }


    public function companyDelete(Company $company)
    {
        if ($company->logo_name) {
            $f = 'company/logo/' . $company->logo_name;
            if (Storage::disk('upload')->exists($f)) {
                Storage::disk('upload')->delete($f);
            }
        }
        $company->allMessages()->delete();
        $company->takenCourseExamItems()->delete();
        $company->takenCourseExams()->delete();
        $company->creditTransactions()->delete();
        $company->courseAssignments()->delete();
        $company->courseAssignmentAnswers()->delete();
        $company->takenCourses()->delete();
        $company->takenPackageSubroles()->delete();
        $company->takenpackages()->delete();
        $company->subroles()->delete();
        $company->orders()->delete();
        $company->orderItems()->delete();
        $company->orderPayments()->delete();
        $company->delete();
        return back()->with('success', 'Company successfully deleted');
    }

    // order
    public function order(Request $request)
    {
        $type = $request->type;
        menuSubmenu('order', 'order' . $type);

        $orders = Order::where('order_status', $type)
            ->latest()
            ->paginate(30);

        return view('admin.order.index', [
            'type' => $type,
            'orders' => $orders
        ]);
    }

    public function orderDetails(Order $order, Request $request)
    {
        $type = $request->type;
        $orderItem = $order->items()->first();

        return view('admin.order.orderDetails', [
            'order' => $order,
            'orderItem' => $orderItem,
            'type' => $type
        ]);
    }

    public function orderItemOrderStatusUpdate(OrderItem $item, Request $request)
    {
        $order = $item->order;
        $status = $request->order_status;

        if ($request->order_status != 'cancelled') {
            $at_field = $request->order_status . '_at';
            $item[$at_field] = Carbon::now();
        }

        $item->order_status = $status;
        $item->editedby_id = Auth::id();
        $item->save();

        if ($order->items->count() == $order->items()->where('order_status', $status)->count()) {
            if ($request->order_status != 'cancelled') {
                if ($order->order_status != 'cancelled') {
                    $order->order_status = $status;
                    // $order->grand_total = $item->total_price;
                    $order->total_paid = $item->total_price;
                    $order[$at_field] = $item[$at_field];
                    $order->editedby_id = Auth::id();
                    $order->save();

                    if ($order->payment_status == 'paid' and $order->order_status == 'confirmed') {
                        if ($item->taken_pakage_id) {
                            return back()->with('info', 'This order already has a package');
                        }
                        // $item->taken_package_id = $item->package_id;

                        $tp = new TakenPackage;
                        $tp->user_id = $order->user_id;
                        $tp->company_id = $order->company_id ?: null;
                        $tp->package_id = $item->package_id;
                        $tp->order_id = $order->id;
                        $tp->order_item_id = $item->id;

                        if ($item->package_id) {
                            $tp->title = $item->package->title;
                            $tp->course_level = $item->package->course_level;
                            $tp->no_of_courses = $item->package->no_of_courses;
                            $tp->no_of_persons =  $item->package->no_of_persons;
                            $tp->no_of_attempts = $item->package->no_of_attempts;
                            $tp->no_of_credits =  $item->package->no_of_credits;
                            $tp->price = $item->package->price;
                            $tp->duration = $item->package->duration;
                            $tp->package_for = $item->package->package_for;
                            $tp->package_type = $item->package->package_type;
                            $tp->taken_date = date('Y-m-d');
                            $tp->expired_date = Carbon::now()->addDays($tp->duration);
                        }

                        $tp->save();

                        $item->taken_package_id = $tp->id;
                        $item->order_status = 'delivered';
                        $item->delivered_at = Carbon::now();
                        $item->save();

                        $order->order_status = 'delivered';
                        $order->delivered_at = Carbon::now();
                        $order->save();

                        $creditTrans = new CreditTransaction;
                        $creditTrans->user_id               = $order->user_id;
                        $creditTrans->company_id            = $order->company_id ?: null;
                        $creditTrans->company_subrole_id    = null;
                        $creditTrans->package_id            = $tp->package_id;
                        $creditTrans->taken_package_id      = $tp->id;
                        $creditTrans->course_id             = null;
                        $creditTrans->taken_course_id       = null;
                        $creditTrans->taken_course_exam_id  = null;
                        $creditTrans->order_id              = $order->id;
                        $creditTrans->previous_credit       = 0;
                        $creditTrans->transferred_credit    = $item->package->no_of_credits;
                        $creditTrans->current_credit        = $item->package->no_of_credits;
                        $creditTrans->transaction_type      = 'add';
                        $creditTrans->credit_from           = 'order';
                        $creditTrans->credit_for            = 'taken_package';
                        $creditTrans->addedby_id            = auth()->user()->id;
                        $creditTrans->transaction_date      = now();
                        $creditTrans->save();
                    }
                }
            } else {
                $order->order_status = $status;
                // $order->grand_total = $item->total_price;
                $order->total_paid = $item->total_price;
                $order->editedby_id = Auth::id();
                $order->save();
            }
        }

        return back()->with('success', 'Item order status successfully updated');
    }

    public function orderPaymentSubmit(Order $order, Request $request)
    {


        $paidAmount = $request->paid_amount;
        if ($paidAmount < 1) {
            return back();
        }
        $dueAmount = $order->total_due - $paidAmount;

        if ($dueAmount <= -1) {
            return back();
        }

        $dueAmount = $dueAmount <= 1 ? 0 : $dueAmount;

        $payment = OrderPayment::where('order_id', $order->id)->first();

        $item = $order->items()->first();
        $payment->trans_date = date('Y-m-d');
        $payment->order_id = $order->id;
        $payment->user_id = Auth::id();
        $payment->payment_by = $request->payment_type;
        $payment->payment_type = $request->payment_type;
        $payment->payment_status = 'completed';
        $payment->bank_name = $request->payment_type;
        $payment->account_number = $request->account_number;
        $payment->cheque_number = null;
        $payment->note = $request->note;
        $payment->paid_amount = $request->paid_amount;
        $payment->receivedby_id = Auth::id();
        $payment->addedby_id = Auth::id();
        $payment->editedby_id = null;

        $payment->save();

        $amount = $request->paid_amount;
        $paidAmount = $order->total_paid + $amount;
        $dueAmount = $order->grand_total - $paidAmount;

        $dueAmount = $dueAmount <= 1 ? 0 : $dueAmount;

        $order->total_paid = $paidAmount;
        $order->total_due = $dueAmount;


        if ($dueAmount) {
            $order->payment_status = 'partial';
        } else {
            $order->payment_status = 'paid';
        }


        $order->save();

        if ($order->payment_status == 'paid' and $order->order_status == 'confirmed') {

            if ($item->taken_pakage_id) {
                return back()->with('info', 'This order already has a package');
            }
            // $item->taken_package_id = $item->package_id;

            $tp = new TakenPackage;
            $tp->user_id = $order->user_id;
            $tp->company_id = $order->company_id ?: null;
            $tp->package_id = $item->package_id;
            $tp->order_id = $order->id;
            $tp->order_item_id = $item->id;
            if ($item->package_id) {
                $tp->course_level = $item->package->course_level;
                $tp->no_of_courses = $item->package->no_of_courses;
                $tp->no_of_persons =  $item->package->no_of_persons;
                $tp->no_of_attempts = $item->package->no_of_attempts;
                $tp->no_of_credits =  $item->package->no_of_credits;
                $tp->price = $item->package->price;
                $tp->duration = $item->package->duration;
                $tp->package_for = $item->package->package_for;
                $tp->package_type = $item->package->package_type;
                $tp->taken_date = date('Y-m-d');
                $tp->expired_date = Carbon::now()->addDays($tp->duration);
            }

            $tp->save();

            $item->taken_package_id = $tp->id;
            $item->order_status = 'delivered';
            $item->delivered_at = Carbon::now();
            $item->save();

            $order->order_status = 'delivered';
            $order->delivered_at = Carbon::now();
            $order->save();

            $creditTrans = new CreditTransaction;
            $creditTrans->user_id               = $order->user_id;
            $creditTrans->company_id            = $order->company_id ?: null;
            $creditTrans->company_subrole_id    = null;
            $creditTrans->package_id            = $tp->package_id;
            $creditTrans->taken_package_id      = $tp->id;
            $creditTrans->course_id             = null;
            $creditTrans->taken_course_id       = null;
            $creditTrans->taken_course_exam_id  = null;
            $creditTrans->order_id              = $order->id;
            $creditTrans->previous_credit       = 0;
            $creditTrans->transferred_credit    = $item->package->no_of_credits;
            $creditTrans->current_credit        = $item->package->no_of_credits;
            $creditTrans->transaction_type      = 'add';
            $creditTrans->credit_from           = 'order';
            $creditTrans->credit_for            = 'taken_package';
            $creditTrans->addedby_id            = auth()->user()->id;
            $creditTrans->transaction_date      = now();
            $creditTrans->save();
        }

        return redirect()->back()->with('success', 'Payment successfully done');
    }

    public function orderPaymentUpdate(OrderPayment $payment, Request $request)
    {
        // dd($request->all());

        $order = $payment->order;

        $paidamount = $request->paid_amount;
        if ($paidamount < 1) {
            return back();
        }

        $dueAmount = $order->total_due - $paidamount;
        if ($dueAmount <= -1) {

            return back();
        }

        $dueAmount = $dueAmount <= 1 ? 0 : $dueAmount;

        $payment->trans_date = date('Y-m-d');
        // $payment->order_id = $order->id;
        // $payment->user_id = $order->user_id;
        $payment->payment_by = $request->payment_type;
        $payment->payment_type = $request->payment_type;
        $payment->payment_status = 'completed';

        $payment->bank_name = $request->payment_type;
        $payment->account_number = $request->account_number;
        $payment->cheque_number = null;
        $payment->note = $request->note;
        $payment->paid_amount = $request->paid_amount;
        $payment->receivedby_id = Auth::id();
        // $payment->addedby_id = $order->user_id;
        $payment->editedby_id = Auth::id();
        $payment->save();

        // test
        $amount = $request->paid_amount;
        $paidAmount = $order->total_paid + $amount;
        $dueAmount = $order->grand_total - $paidAmount;
        $dueAmount = $dueAmount <= 1 ? 0 : $dueAmount;

        $order->total_paid = $paidAmount;
        $order->total_due = $dueAmount;
        $order->total_paid = $paidAmount;
        if ($dueAmount) {
            $order->payment_status = 'partial';
        } else {
            $order->payment_status = 'paid';
        }

        $order->save();

        $item = $order->items()->first();

        if ($order->payment_status == 'paid' and $order->order_status == 'confirmed') {
            if ($item->order_for == 'package') {
                if ($item->taken_pakage_id) {
                    return back()->with('info', 'This order already has a package');
                }
                // $item->taken_package_id = $item->package_id;

                $tp = new TakenPackage;
                $tp->user_id = $order->user_id;
                $tp->company_id = $order->company_id ?: null;
                $tp->package_id = $item->package_id;
                $tp->order_id = $order->id;
                $tp->order_item_id = $item->id;
                if ($item->package_id) {
                    $tp->course_level = $item->package->course_level;
                    $tp->no_of_courses = $item->package->no_of_courses;
                    $tp->no_of_persons =  $item->package->no_of_persons;
                    $tp->no_of_attempts = $item->package->no_of_attempts;
                    $tp->no_of_credits =  $item->package->no_of_credits;
                    $tp->price = $item->package->price;
                    $tp->duration = $item->package->duration;
                    $tp->package_for = $item->package->package_for;
                    $tp->package_type = $item->package->package_type;
                    $tp->taken_date = date('Y-m-d');
                    $tp->expired_date = Carbon::now()->addDays($tp->duration);
                }

                $tp->save();
                $item->taken_package_id = $tp->id;

                $creditTrans = new CreditTransaction;
                $creditTrans->user_id               = $order->user_id;
                $creditTrans->company_id            = $order->company_id ?: null;
                $creditTrans->company_subrole_id    = null;
                $creditTrans->package_id            = $tp->package_id;
                $creditTrans->taken_package_id      = $tp->id;
                $creditTrans->course_id             = null;
                $creditTrans->taken_course_id       = null;
                $creditTrans->taken_course_exam_id  = null;
                $creditTrans->order_id              = $order->id;
                $creditTrans->previous_credit       = 0;
                $creditTrans->transferred_credit    = $item->package->no_of_credits;
                $creditTrans->current_credit        = $item->package->no_of_credits;
                $creditTrans->transaction_type      = 'add';
                $creditTrans->credit_from           = 'order';
                $creditTrans->credit_for            = 'taken_package';
                $creditTrans->addedby_id            = auth()->user()->id;
                $creditTrans->transaction_date      = now();
                $creditTrans->save();
            } elseif ($item->order_for == 'credit') {
                $user = $item->user;
                $user->credit = $user->credit + $item->total_price;
                $user->save();

                $creditTrans = new CreditTransaction;
                $creditTrans->user_id               = $item->user->id;
                $creditTrans->company_id            = null;
                $creditTrans->company_subrole_id    = null;
                $creditTrans->package_id            = null;
                $creditTrans->taken_package_id      = null;
                $creditTrans->course_id             = null;
                $creditTrans->taken_course_id       = null;
                $creditTrans->taken_course_exam_id  = null;
                $creditTrans->order_id              = $order->id;
                $creditTrans->previous_credit       = $item->user->credit - $item->total_price;
                $creditTrans->transferred_credit    = $item->total_price;
                $creditTrans->current_credit        = $item->user->credit;
                $creditTrans->transaction_type      = 'add';
                $creditTrans->credit_from           = 'order';
                $creditTrans->credit_for            = 'user_credit';
                $creditTrans->addedby_id            = auth()->user()->id;
                $creditTrans->transaction_date      = now();
                $creditTrans->save();
            } else {
                return redirect()->back()->with('error', 'Unexpected error')->withInput();
            }

            $item->order_status = 'delivered';
            $item->delivered_at = Carbon::now();
            $item->save();

            $order->order_status = 'delivered';
            $order->delivered_at = Carbon::now();
            $order->save();
        }

        return redirect()->back()->with('success', 'Payment successfully completed');
    }

    public function orderpaymentDelete(OrderPayment $payment)
    {
        $payment->delete();

        return redirect()->back()->with('success', 'Successfully Payment Delete');
    }

    //admin
    public function adminsAll(Request $request)
    {
        menuSubmenu('role', 'adminsAll');
        $usersAll = UserRole::has('user')->doesntHave('roleItems')->latest()->paginate(20);

        return view('admin.adminsAll', [
            'usersAll' => $usersAll
        ]);
    }

    public function addNewRole(Request $request)
    {
        menuSubmenu('role', 'addNewRole');
        $usersAll = UserRole::has('user')->where('role_name', 'admin')->latest()->paginate(20);

        return view('admin.addNewRole', [
            'usersAll' => $usersAll
        ]);
    }
    public function editNewrole($id)
    {
        menuSubmenu('role', 'addNewRole');
            $role = UserRole::find($id);
            $user=User::where('id',$role->user_id)->first();

            return view('admin.editNewRole', [
                'role' => $role,
                'user'=>$user
            ]);
    }
    public function allRoleUser(Request $request)
    {

        menuSubmenu('role', 'allRoleUser');
        $rolesAll = UserRole::has('user')->has('roleItems')->latest()->paginate(20);
        // dd($rolesAll);
        return view('admin.allRoleUser', [
            'rolesAll' => $rolesAll
        ]);
    }

    public function roleAddNewPost(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make(
            $request->all(),
            [
                'user' => ['required'],
                'rolename' => ['required', 'string', 'max:255'],
                'items' => ['required'],
            ]
        );

        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Something went wrong.');
        }
        $user = User::where('mobile', $request->user)->first();


        if($request->edit==1){
            $role = UserRole::where('user_id', $user->id)->first();

            if ($role->user->id == Auth::id()) {
                return back()->with('error', 'Your Admin Role can not be deleted by yourself.');
            }
            $role->roleItems()->delete();
            $role->delete();

        }


        if ($user) {
            if (!$user->isAdmin()) {
                if ($request->items) {
                    $role =  $user->roles()->create([
                        'role_name' => 'admin',
                        'role_value' => $request->rolename,
                        'addedby_id' => Auth::id()
                    ]);
                    foreach ($request->items as $item) {
                        $user->roleItems()->create([
                            'role_id' => $role->id,
                            'name' => $item,
                            'addedby_id' => Auth::id()
                        ]);
                    }
                    return redirect()->route('admin.allRoleUser')->with('success', 'New Role Successfully Created.');
                }
            }
            return back()->with('error', 'This user already has a role.');
        }
        return back();
    }
    public function selectNewRole(Request $request)
    {
        $users = User::where('email', 'like', '%' . $request->q . '%')
            // ->orWhere('username', 'like', '%'.$request->q.'%')
            // ->orWhere('name', 'like', '%'.$request->q.'%')
            ->orWhere('mobile', 'like', '%' . $request->q . '%')
            ->select(['id', 'mobile', 'email'])->take(30)->get();
        if ($users->count()) {
            if ($request->ajax()) {
                // return Response()->json(['items'=>$users]);
                return $users;
            }
        } else {
            if ($request->ajax()) {
                return $users;
            }
        }
    }


    public function adminAddNewPost(Request $request)
    {

        $user = User::where('mobile', $request->user)->first();

        if ($user) {
            if (!$user->isAdmin()) {
                $user->roles()->create(['role_name' => 'admin', 'addedby_id' => Auth::id()]);

                return back()->with('success', 'New Admin Successfully Created.');
            } else {
                return back()->with('error', 'This User Already Admin.');
            }
        }
    }

    public function adminDelete(UserRole $role, Request $request)
    {
        if ($role->user->id == Auth::id()) {
            return back()->with('error', 'Your Admin Role can not be deleted by yourself.');
        }
        $role->roleItems()->delete();
        $role->delete();

        return back()->with('success', 'Admin Successfully Deleted.');
    }

    //subscribers
    public function subscribersList(Request $request)
    {
        if (!Auth::user()->hasPermission('subscriber')) {
            abort(401);
        }

        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'subscribers', 'lsbsm' => 'subscribers']);

        if ($request->subscriber) {
            //this is for subscriber from honorarium and other pf link
            $subcribers = Subscriber::where('id', $request->subscriber)->paginate(50);
        } else {
            $subcribers = Subscriber::orderBy('id', 'desc')->paginate(50);
        }



        // return view('admin.usersAll', ['usersAll'=> $usersAll]);

        return view('admin.subcribers.subcriberList', [
            'subcribers' => $subcribers,
        ]);
    }

    public function subcriberEdit(Subscriber $subcriber, Request $request)
    {
        if (!Auth::user()->hasPermission('subscriber')) {
            abort(401);
        }
        // dd($subcriber);
        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'subscribers', 'lsbsm' => 'subscribers']);

        $districts = District::orderBy('name')->get();
        $myReffer = Subscriber::where('referral_id', $subcriber->id)->latest()->paginate(20);
        $mySubscription = Subscriber::where('id', $subcriber->id)->first();
        $myLeader = Subscriber::where('id', $mySubscription->referral_id)->first();
        // return $myLeader;
        return view('admin.subcribers.subcriberEdit', [
            'subcriber' => $subcriber,

            'districts' => $districts,
            'myReffer'  => $myReffer,
            'myLeader'  => $myLeader
        ]);
    }
    public function updatePfReffer(Request $request)
    {
        if ($request->type == 'delete') {
            $refferRow = Subscriber::where('id', $request->subcriber)->first();
            $refferRow->referral_id = null;
            $refferRow->save();
            return redirect()->back()->with('success', 'Reffer Deleted Successfully');
        }
        if ($request->type == 'update') {
            $request->validate([
                'reffer' => 'required'
            ]);
            $refferRow = Subscriber::where('id', $request->subcriber)->first();
            $refferRow->referral_id = $request->reffer;
            $refferRow->save();
            return redirect()->back()->with('success', 'Refferer Update Successfully');
        }
        if ($request->type == 'add') {
            $request->validate([
                'refferme' => 'required'
            ]);
            $refferRow = Subscriber::where('id', $request->refferme)->first();
            $refferRow->referral_id = $request->subcriber;
            $refferRow->save();
            return redirect()->back()->with('success', 'Refferer Added Successfully');
        }
        return back();
    }


    public function selectNewRefferFromSubscriber(Request $request)
    {
        $subscription = Subscriber::where('id', 'like', '%' . $request->q . '%')
            ->orWhere('subscription_code', 'like', '%' . $request->q . '%')
            ->orWhere('user_id', 'like', '%' . $request->q . '%')
            ->orWhere('name', 'like', '%' . $request->q . '%')
            ->where('free_account', false)
            ->orderBy('name')
            ->take(10)->get();
        // $users = User::where('email', 'like', '%' . $request->q . '%')
        //     // ->orWhere('username', 'like', '%'.$request->q.'%')
        //     // ->orWhere('name', 'like', '%'.$request->q.'%')
        //     ->orWhere('mobile', 'like', '%' . $request->q . '%')
        //     ->select(['id', 'mobile', 'email'])->take(30)->get();
        if ($subscription->count()) {
            if ($request->ajax()) {
                // return Response()->json(['items'=>$users]);
                return $subscription;
            }
        } else {
            if ($request->ajax()) {
                return $subscription;
            }
        }
    }

    ///Need Confirm via Masud Vai
    public function selectNewRefferFromSubscriber2(Request $request)
    {
        $current_subscriber = Subscriber::where('id', $request->subscription)->first();
        $subscription = Subscriber::where('id', 'like', '%' . $request->q . '%')
            ->orWhere('subscription_code', 'like', '%' . $request->q . '%')
            ->orWhere('user_id', 'like', '%' . $request->q . '%')
            ->orWhere('name', 'like', '%' . $request->q . '%')
            ->where('free_account', false)
            ->where('work_station_id', $current_subscriber->work_station_id)
            ->take(10)->get();
        // $users = User::where('email', 'like', '%' . $request->q . '%')
        //     // ->orWhere('username', 'like', '%'.$request->q.'%')
        //     // ->orWhere('name', 'like', '%'.$request->q.'%')
        //     ->orWhere('mobile', 'like', '%' . $request->q . '%')
        //     ->select(['id', 'mobile', 'email'])->take(30)->get();
        if ($subscription->count()) {
            if ($request->ajax()) {
                // return Response()->json(['items'=>$users]);
                return $subscription;
            }
        } else {
            if ($request->ajax()) {
                return $subscription;
            }
        }
    }

    public function subcriberUpdate(Subscriber $subcriber, Request $request)
    {

        // dd($request->all());
        $validation = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255', 'min:3'],
                'user' => ['string', 'max:255', 'exists:users,id'],
                'mobile' => ['required', 'string'],
            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }
        // user id
        $user = User::find($request->user);

        if ($user) {
            $subcriber->user_id = $user->id;
        }

        $subcriber->name = $request->name ?: $subcriber->name;
        // $subcriber->email = $request->email ?: $subcriber->email;
        $subcriber->mobile = $request->mobile ?: $subcriber->mobile;

        $subcriber->subscription_code = $request->subscription_code;

        // $subcriber->work_station_id = $request->work_station_id;
        // $subcriber->position = $request->position;
        // $subcriber->top_subscriber_id = $request->top_subscriber_id;
        $subcriber->district_id = $request->load_district;
        $subcriber->addedby_id = Auth::id();
        $subcriber->save();

        return redirect()->route('admin.subscribersList')->with('success', 'User successfully Updated');
    }


    public function createServiceProfile(Request $request)
    {
        $user = Auth::user();
        menuSubmenu('createServiceProfile', 'createServiceProfile');
        $workstation = WorkStation::where('active', true)->get();
        //   dd($workstation);
        return view('subscriber.profile.makeServiceProfile', compact('user', 'workstation'));
    }
    public function newUserCreateForServiceProfile(Request $request)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255', 'min:3'],
                'email' => ['required', 'string', 'email', 'unique:users', 'max:255'],
                'mobile' => ['required', 'string'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'active' => ['nullable']

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = bdMobileWithCode($request->mobile);
        $user->password_temp = $request->password;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->active = $request->active ? true : false;
        $user->addedby_id = Auth::id();
        $user->save();

        // $haveSubscription = Category::whereDoesntHave('subscription', function ($query) use ($user) {
        //     $query->where('user_id', $user->id);
        // })->get();

        // if (count($haveSubscription) == 0) {
        //     return redirect()->back()->with('warning', 'You have already Account in all Categories');
        // }
        // foreach ($haveSubscription as $key => $category) {
        //     $workstation = WorkStation::find($category->work_station_id);

        //     $me = $user;
        //     $cookieReffer_id = null;

        //     if (!$me->subscriptions()->count()) {
        //         $rvd = $me->verifiedDatas()->first();
        //         if ($rvd) {
        //             $cookieReffer_id = $rvd->reffer_code;
        //         }
        //     }
        //     $code = Subscriber::where('subscription_code', $cookieReffer_id)
        //         ->where('id', '>', 15)
        //         ->where('subscription_code', '<>', null)
        //         ->where('work_station_id', $workstation->id)
        //         ->first();

        //     if ($code) {
        //         $workstationId = $code->work_station_id;
        //         $reffer_id = $code->id;
        //     } else {

        //         if ($sf = $me->isWSSubscription($workstation)) {

        //             $reffer_id = $sf->id;
        //             $workstationId = $workstation->id;
        //         } else {
        //             $reffer_id = null;
        //             // $reffer_id = $workstation->id + 15;
        //             $workstationId = $workstation->id;
        //         }
        //     }

        //     $prRow = Subscriber::where('work_station_id', $workstationId)->orderBy('ws_position', 'desc')->first();

        //     $dis = $me->subscriptionDistrict()->id;
        //     if (strlen($dis) < 2) {
        //         $dis = '0' . $dis;
        //     }

        //     $wsId = $workstationId;
        //     if (strlen($wsId) < 2) {
        //         $wsId = '0' . $wsId;
        //     }

        //     $meMob = $me->mobile ?: '00';
        //     if (strlen($meMob) > 2) {
        //         // $meMob = last 2 digit;
        //         $meMob = substr($meMob, -2);
        //     }

        //     $num = 100000000;
        //     $ws_pos = $prRow->ws_position + 1;
        //     $num = $num + $ws_pos;
        //     $scode = $wsId . $num . $meMob . $me->subscriptionDistrict()->id;

        //     $whoCreatingAccount = Auth::user();
        //     $introducer = Subscriber::where('user_id', $whoCreatingAccount->id)->where('work_station_id', $workstationId)->first();
        //     if ($introducer) {
        //         if ($key == 0) {
        //             $s = new Subscriber;
        //             $s->ws_position = $ws_pos;
        //             $s->name = $me->name;
        //             $s->email = $me->email;
        //             $s->mobile = $me->mobile;
        //             $s->category_id = $category->id;
        //             $s->district_id = $me->subscriptionDistrict()->id;
        //             $s->user_id = $me->id;
        //             $s->referral_id = $introducer->id;
        //             $s->work_station_id = $workstationId;
        //             $s->subscription_code = $scode;
        //             $s->addedby_id = Auth::id();
        //             $s->free_account = 1;
        //             $s->save();
        //         }
        //     }

        //     $s = new Subscriber;
        //     $s->ws_position = $ws_pos;
        //     $s->name = $me->name;
        //     $s->email = $me->email;
        //     $s->mobile = $me->mobile;
        //     $s->category_id = $category->id;
        //     $s->district_id = $me->subscriptionDistrict()->id;
        //     $s->user_id = $me->id;
        //     $s->referral_id = $reffer_id;
        //     $s->work_station_id = $workstationId;
        //     $s->subscription_code = $scode;
        //     $s->addedby_id = Auth::id();
        //     $s->free_account = 1;

        //     $s->save();
        // }

        return back()->with('success', 'New user successfully Created');
    }
    public function fetchAjaxData(Request $request)
    {
        $subscription = Subscriber::where('user_id', $request->user)->where('category_id', $request->id)->first();
        // return $subscription;
        // if (!$subscription) {
        //     $dd = "<div class='text-danger'>User Not Found or Subscriber Not Found. Create user and try</div>";
        //     return  response()->json(['html' => $dd]);
        // }
        // $user= User::find($request->user);
        // if (!$user) {
        //     $dd = "<div class='text-danger'>User Not Found. Please Select a User</div>";
        //     return  response()->json(['html' => $dd]);
        // }
        $category = Category::find($request->id);
        // return $category;
        $serviceProfileInfos = ServiceProfileInfo::where('category_id', $request->id)
            ->where('type', 'business')
            ->select('id', 'field_type', 'profile_info_key', 'access_type')
            ->get();
        // return $serviceProfileInfos;
        // foreach ($serviceProfileInfos as $key => $value) {
        //    return $value->category;
        // }
        //  return $service_profile_infos;

        $html = View::make('subscriber.profile.test', compact('serviceProfileInfos', 'subscription', 'category'))->render();

        return  response()->json(['html' => $html]);
    }

    public function storeServiceProfileFromAdmin(Request $request)
    {
       // dd($request->paynow);

       $validation = Validator::make(
        $request->all(),
        [
            'name' => ['required', 'string', 'max:255', 'min:4'],
            'user' => ['required'],
            'workstation' => ['required'],
            'category' => ['required'],
            'address' => ['required'],
            'img' => ['required'],
            'location' => ['required']
        ]
    );

    if ($validation->fails()) {

        return back()
            ->withInput()
            ->withErrors($validation);
    }

    $category = Category::where('id', $request->category)->first();

    //dd($category->sp_adtopup_bonus);
    $user = User::where('id', $request->user)->first();
    $whoCreatingAccount = Auth::user();



    $ifHaveSubscriptionByWhoCreating = Subscriber::where('user_id', $whoCreatingAccount->id)
        ->where('category_id', $request->category)
        ->first();



        // if (!$ifHaveSubscriptionByWhoCreating) {
        //     return back()->with('error', 'You don\'t have Subscription in this category. Please Subscribe in this category and try again');
        // }

    $subscription = Subscriber::where('user_id', $user->id)
        ->where('category_id', $request->category)
        ->first();
    if($subscription){
        if($subscription->refferal_id==null){
            $subscription->refferal_id== $ifHaveSubscriptionByWhoCreating->id;
            $subscription->save();
        }
    }

    if (!$subscription) {
        $workstation = Workstation::find($category->work_station_id);
        $cookieReffer_id = null;
        if (!$user->subscriptions()->count()) {
            $rvd = $user->verifiedDatas()->first();
            if ($rvd) {
                $cookieReffer_id = $rvd->reffer_code;
            }
        }

        $code = Subscriber::where('subscription_code', $cookieReffer_id)
            ->where('id', '>', 15)
            ->where('subscription_code', '<>', null)
            ->where('work_station_id', $workstation->id)
            ->first();

        if ($code) {
            $workstationId = $code->work_station_id;
            $reffer_id = $code->id;
        } else {
            if ($sf = $user->isWSSubscription($workstation)) {

                $reffer_id = $sf->id;
                $workstationId = $workstation->id;
            } else {
                $reffer_id = null;
                $workstationId = $workstation->id;
            }
        }


        $prRow = Subscriber::where('work_station_id', $workstationId)->orderBy('ws_position', 'desc')->first();

        $dis = $user->subscriptionDistrict()->id;
        if (strlen($dis) < 2) {
            $dis = '0' . $dis;
        }

        $wsId = $workstationId;
        if (strlen($wsId) < 2) {
            $wsId = '0' . $wsId;
        }

        $meMob = $user->mobile ?: '00';
        if (strlen($meMob) > 2) {
            // $meMob = last 2 digit;
            $meMob = substr($meMob, -2);
        }

        $num = 100000000;
        $ws_pos = $prRow->ws_position + 1;
        $num = $num + $ws_pos;
        $code = $wsId . $num . $meMob . $user->subscriptionDistrict()->id;

        $subscription = new Subscriber;
        $subscription->ws_position = $ws_pos;
        $subscription->name = $user->name;
        $subscription->email = $user->email;
        $subscription->mobile = $user->mobile;
        $subscription->category_id = $category->id;
        $subscription->district_id = $user->subscriptionDistrict()->id;
        $subscription->user_id = $user->id;
        if($ifHaveSubscriptionByWhoCreating){
            $subscription->referral_id = $ifHaveSubscriptionByWhoCreating->id;
        }else{
            $subscription->referral_id = $reffer_id;
        }

        $subscription->work_station_id = $workstationId;
        $subscription->subscription_code = $code;
        $subscription->addedby_id = Auth::id();
        $subscription->free_account = 1;
        $subscription->save();
    }
    $oldProfile = ServiceProfile::where('user_id', $subscription->user_id)
        ->where('workstation_id', $subscription->work_station_id)
        ->where('ws_cat_id', $subscription->category_id)
        ->where('profile_type', $request->profile_type)
        ->first();

    $user = User::where('id', $subscription->user_id)->first();

    // if ($oldProfile) {
    //     $moreTalk = $oldProfile->status == true ? '' : ' Please, wait until approve it';
    //     return back()->with('error', 'Already submitted a profile.' . $moreTalk)->withInput();
    // }



    $profile = new ServiceProfile;
    $profile->user_id = $subscription->user_id;
    $profile->subscriber_id = $subscription->id;
    $profile->workstation_id = $subscription->work_station_id;
    $profile->ws_cat_id = $subscription->category_id;
    $profile->name = $request->name;
    $profile->email = $user->email;
    $profile->mobile = $user->mobile;
    $profile->profile_type = $request->profile_type == 'business' ? $request->profile_type : 'personal';
    $profile->address = $request->location;
    $profile->home_delivery = $request->home_delivery ? 1 : 0;
    $profile->online_sale = $request->online_sale ? 1 : 0;
    $profile->offline_sale = $request->offline_sale ? 1 : 0;
    $profile->fixed_location = $request->fixed_location ? 1 : 0;
    $profile->lat = $request->lat;
    $profile->lng = $request->lng;
    // if ($subscription->free_account) {
    //     $profile->expired_at = Carbon::now()->addDay(60);
    // } else {
    //     $profile->expired_at = null;
    // }
    $profile->short_bio = $request->bio;
    $profile->designation = $request->designation;
    $profile->zip_code = $request->zip_code;
    $profile->city = $request->city;
    $profile->country = $request->country;
    $profile->status = false; ///Because This Service profile created by a USER
    $profile->paystatus = 0;
    $profile->website_link = $request->website_link;
    if ($subscription->free_account) {
        $profile->expired_at = Carbon::now()->addDay(60);
    } else {
        $profile->expired_at = Carbon::now()->addDay(365);
    }
    $profile->open = true;
    $profile->addedby_id = Auth::id();
    $profile->save();

    if ($cp = $request->img) {
        $f = 'user/profile/' . $profile->img_name;
        if (Storage::disk('public')->exists($f)) {
            Storage::disk('public')->delete($f);
        }
        $extension = strtolower($cp->getClientOriginalExtension());
        $randomFileName = $profile->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

        list($width, $height) = getimagesize($cp);
        $mime = $cp->getClientOriginalExtension();
        $size = $cp->getSize();

        $originalName = strtolower($cp->getClientOriginalName());

        Storage::disk('public')->put('user/profile/' . $randomFileName, File::get($cp));

        $profile->img_name = $randomFileName;
        $profile->save();
    }
    if ($cp = $request->cover_image) {
        // return "ache2";
        $f = 'user/profile/cover/' . $profile->cover_image;
        if (Storage::disk('public')->exists($f)) {
            Storage::disk('public')->delete($f);
        }

        $extension = strtolower($cp->getClientOriginalExtension());
        $randomFileName = $profile->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

        list($width, $height) = getimagesize($cp);
        $mime = $cp->getClientOriginalExtension();
        $size = $cp->getSize();

        $originalName = strtolower($cp->getClientOriginalName());

        Storage::disk('public')->put('user/profile/cover/' . $randomFileName, File::get($cp));

        $profile->cover_image = $randomFileName;
        $profile->save();
    }


    // dd($request->key_values);
    foreach (json_decode($request->key_values) as $key => $value) {

        $keyv = 'key_' . $value;
        // return $keyv;
        if ($request[$keyv] != null) {
            $info = ServiceProfileInfo::where('id', $value)->first();
            if ($info) {
                $serviceProfileValue = new ServiceProfileInfoValue;
                $serviceProfileValue->workstation_id = $subscription->work_station_id;
                $serviceProfileValue->ws_cat_id = $subscription->work_station_id;
                $serviceProfileValue->subscriber_id = $subscription->category_id;
                $serviceProfileValue->user_id = $subscription->user_id;

                $serviceProfileValue->service_profile_id = $profile->id;

                $serviceProfileValue->service_profile_info_id = $info->id;

                $serviceProfileValue->profile_info_key = $info->profile_info_key;
                $serviceProfileValue->field_type = $info->field_type;
                $serviceProfileValue->access_type = $info->access_type;
                $serviceProfileValue->profile_card_display = $info->profile_card_display;

                if (($info->field_type == 'image') or ($info->field_type == 'pdf') or ($info->field_type == 'doc')) {
                    if ($request->file($keyv)) {

                        $ctp = $request->file($keyv);
                        $ext = strtolower($ctp->getClientOriginalExtension());
                        $ctpn = $profile->id . $info->field_type . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $ext;
                        $ctpn = strtolower($ctpn);

                        if ($info->field_type == 'image') {
                            $os = array("png", "bmp", "jpg", "jpeg", "gif");
                            if (!in_array($ext, $os)) {

                                $f = 'user/profile/' . $profile->img_name;
                                if (Storage::disk('public')->exists($f)) {
                                    Storage::disk('public')->delete($f);
                                }
                                $profile->serviceProfileValues()->delete();
                                $profile->delete();

                                return back()->with('error', 'Sorry, you did not upload image file in image field');
                            }
                        }


                        if ($info->field_type == 'doc') {
                            $os = array("doc", "docx");
                            if (!in_array($ext, $os)) {

                                $f = 'user/profile/' . $profile->img_name;
                                if (Storage::disk('public')->exists($f)) {
                                    Storage::disk('public')->delete($f);
                                }

                                $profile->serviceProfileValues()->delete();
                                $profile->delete();

                                return back()->with('error', 'Sorry, you did not upload doc (msword) file in doc field');
                            }
                        }

                        if ($info->field_type == 'pdf') {
                            $os = array("pdf");
                            if (!in_array($ext, $os)) {

                                $f = 'user/profile/' . $profile->img_name;
                                if (Storage::disk('public')->exists($f)) {
                                    Storage::disk('public')->delete($f);
                                }

                                $profile->serviceProfileValues()->delete();
                                $profile->delete();

                                return back()->with('error', 'Sorry, you did not upload pdf file in pdf field');
                            }
                        }

                        Storage::disk('public')->put('service/profile/' . $ctpn, File::get($ctp));
                        $serviceProfileValue->profile_info_value = $ctpn;
                    }
                } else {
                    $serviceProfileValue->profile_info_value = trim($request[$keyv]);
                }

                $serviceProfileValue->active = false;
                $serviceProfileValue->addedby_id = $subscription->user_id;

                $serviceProfileValue->save();
            }
        }
    }
    //dd($request->paynow);


    if($request->paynow == "paynow"){
       // dd($request->paynow);
        if ($whoCreatingAccount->balance < 100) {

            return redirect()->route('user.userBalance')->with('error', 'Your account balance less then 100 tk. If you want to create service then please recharge.');

            //return redirect()->back()->with('error', 'Your account balance less then ' . $category->sp_create_charge . '. if you want to create service then please recharge.');
        }else{
            if($profile->paystatus==0){

                $bt = new BalanceTransaction;
                $bt->from = 'user';
                $bt->to = 'admin';
                $bt->purpose = 'sp_create_charge';
                $bt->subscriber_id = $subscription->id;
                $bt->user_id = $whoCreatingAccount->id;
                $bt->previous_balance = $whoCreatingAccount->balance;  // user old balance
                $bt->moved_balance = 100; // job cost
                $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
                $bt->type = 'service';
                $bt->details = "{$bt->moved_balance} TK deducted from User balance. to Createing Service/Shop for user_id({$user->id}), Mobile ($user->mobile) .";
                $bt->type_id = $category->id;
                $bt->addedby_id = Auth::id();
                $bt->save();
                $whoCreatingAccount->decrement('balance', $bt->moved_balance);
                $user->increment('ad_balance', $category->sp_adtopup_bonus);
                $profile->paystatus = 1;
                $profile->status = true;
                $profile->save();

                $number=$user->mobile;
                $messages= "Dear {$user->name}, Thank you for create service profile.You have paid service profile.Your service profile name: {$request->name}.Please visit our site www.sc-bd.com. From Soft Commerce";

                //$me->sendSingleMessage($number,$messages);
                $SendSms=new SendSms;
                try {
                    // Send a message using the primary device.
                    $msg = $SendSms->sendSingleMessage($number,$messages);

                }catch (Exception $e) {
                    echo $e->getMessage();
                }
                return back()->with('success', 'Profile Submitted Successfully.');

            }else{
                return redirect()->with('error', 'You already pay for this service profile');

            }


        }

    }

    if($request->paynow = "trial"){
        $profile->expired_at = Carbon::now()->addDay(45);
        $profile->is_trial = 1;
        $profile->status = true;
        $profile->save();

        $number=$user->mobile;
            $messages= "Dear {$user->name}, Thank you for create service profile.You have unpaid service profile.Your service profile name: {$request->name}.45 Days you have free trial.Please visit our site www.sc-bd.com. From Soft Commerce";

            //$me->sendSingleMessage($number,$messages);
            $SendSms=new SendSms;
            try {
                // Send a message using the primary device.
                $msg = $SendSms->sendSingleMessage($number,$messages);

            } catch (Exception $e) {
                echo $e->getMessage();
            }
            return back()->with('success', 'Profile Submitted Successfully.');

    }

           $number=$user->mobile;
            $messages= "Dear {$user->name}, Thank you for create service profile.You have unpaid service profile.Your service profile name: {$request->name}.For published service you have to pay.Please visit our site www.sc-bd.com. From Soft Commerce";

            //$me->sendSingleMessage($number,$messages);
            $SendSms=new SendSms;
            try {
                // Send a message using the primary device.
                $msg = $SendSms->sendSingleMessage($number,$messages);

            } catch (Exception $e) {
                echo $e->getMessage();
            }


    return back()->with('success', 'Profile Submitted Successfully.');
    }
    //Needs
    public function needs(Request $request)
    {
        menuSubmenu('needs', 'needs');
        $needs = Need::orderBy('status', 'DESC')->orderBy('id')->paginate(40);

        return view('admin.needs.index', compact('needs'));
    }
    public function detailsNeeds(Request $request)
    {
        $need = Need::where('id', $request->need)->first();
        if (!$need) {
            return redirect()->back()->with('warning', 'Something Worng!!');
        }
        return view('admin.needs.view', compact('need'));
    }
    public function editNeeds(Request $request)
    {
        $need = Need::where('id', $request->need)->first();
        if (!$need) {
            return redirect()->back()->with('warning', 'Something Worng!!');
        }
        $service_station = WorkStation::all();
        if ($need->workstation_id && $need->ws_cat_id) {
            $categories = Category::where('work_station_id', $need->workstation_id)->get();
            $selected_cat = Category::find($need->ws_cat_id);
        } else {
            $categories = null;
            $selected_cat = null;
        }
        // return $selected_cat;
        return view('admin.needs.edit', compact('service_station', 'need', 'categories', 'selected_cat'));
    }
    public function updateNeed(Request $request)
    {
        $request->validate([
            'title' => 'required|max:250',
            'description' => 'required',
            'service_station' => 'required',
            'workstation_cat' => 'required',
            'status' => 'required'
        ]);
        $need = Need::find($request->need_id);
        if (!$need) {
            return redirect()->back()->with('warning', 'Something Worng!!');
        }
        $need->title = $request->title;
        $need->description = $request->description;
        $need->ws_cat_id = $request->workstation_cat;
        $need->workstation_id = $request->service_station;
        $need->status = $request->status;
        $need->editedby_id = Auth::id();
        $need->save();
        return back()->with('success', 'Need- Succesfully Updated');
    }
    public function allBlogs(Request $request)
    {
        menuSubmenu('allBlogs', 'allBlogs');
        $posts = Blog::where('publish_status', '<>', 'temp')->orderby('id', 'desc')->paginate(20);
        return view('admin.blog.index', compact('posts'));
    }
    public function addNewBlog(Request $request)
    {
        menuSubmenu('allBlogs', 'addNewBlog');
        $tags = BlogTag::latest();
        $cats = BlogCategory::all();
        $post = Blog::where('publish_status', 'temp')->first();
        if (!$post) {
            $post = new Blog;
            $post->addedby_id = Auth::id();
            $post->publish_status = 'temp';
            $post->save();
        }

        return view('admin.blog.addNew', compact('tags', 'cats', 'post'));
    }
    public function StoreBlog(Request $request)
    {
        $request->validate([
            'excerpt' => 'max:254|required',
            'title' => 'required',
            'type' => 'required'
            // 'feature_image' => 'image|dimensions:min_with=300,min_height=200,ratio=3/2'
        ]);
        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $t = BlogTag::where('name', $tag)->first();
                if (!$t) {
                    $t = new BlogTag;
                    $t->name = $tag;
                    // $t->addedby_id = Auth::id();
                    $t->save();
                }
            }
        }
        $post = Blog::where('publish_status', 'temp')->first();
        if (!$post) {
            $post = new Blog;
            $post->addedby_id = Auth::id();
            $post->save();
        }
        $post->title = $request->title ?: null;
        $post->description = $request->description ?: null;
        $post->excerpt = $request->excerpt ?: null;
        $post->publish_status = $request->publish ? 'published' : 'draft';
        $post->type = $request->type;
        $post->user_id = Auth::id();
        $post->addedby_id = Auth::id();

        if ($request->tags) {
            $post->tags = implode(', ', $request->tags);
        } else {
            $post->tags = null;
        }
        if ($request->hasFile('feature_image')) {
            $f = 'blog/' . $post->feature_image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $ffile = $request->feature_image;
            $fimgExt = strtolower($ffile->getClientOriginalExtension());
            $fimageNewName = time() . '.' . $fimgExt;
            $originalName = $ffile->getClientOriginalName();
            Storage::disk('public')->put('blog/' . $fimageNewName, File::get($ffile));
            $post->feature_img_name = $fimageNewName;
        }
        $post->save();
        $post->blogCategories()->detach();

        if ($request->categories) {
            foreach ($request->categories as $cat) {
                $c = PostCategory::where('category_id', $cat)->where('post_id', $post->id)->first();
                if (!$c) {
                    $c = new PostCategory;
                    $c->category_id = $cat;
                    $c->post_id = $post->id;
                    $c->addedby_id = Auth::id();
                    $c->save();
                }
            }
        }
        return redirect()->back()->with('success', 'Blog Created Successfully');
    }

    public function blogEdit(Blog $blog, Request $request)
    {
        menuSubmenu('allBlogs', 'allBlogs');
        $cats = BlogCategory::all();
        $oldTags = $blog->tags ? explode(", ", $blog->tags) : null;
        return view('admin.blog.edit', compact('cats', 'oldTags', 'blog'));
    }
    public function blogUpdateToPublished(Blog $blog, Request $request)
    {
        menuSubmenu('allBlogs', 'allBlogs');
        $blog->publish_status = 'published';
        $blog->save();
        return redirect()->back()->with('success', 'Blog Published Successfully');
    }
    public function postUpdate(Blog $blog, Request $request)
    {
        $request->validate([
            'excerpt' => 'max:254|required',
            'type' => 'required'
            // 'feature_image' => 'image|dimensions:min_with=300,min_height=200,ratio=3/2'
        ]);
        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $t = BlogTag::where('name', $tag)->first();
                if (!$t) {
                    $t = new BlogTag;
                    $t->name = $tag;
                    // $t->addedby_id = Auth::id();
                    $t->save();
                }
            }
        }

        $blog->title = $request->name ?: null;
        $blog->description = $request->description ?: null;
        $blog->excerpt = $request->excerpt ?: null;
        $blog->publish_status = $request->publish ? 'published' : 'draft';
        $blog->type = $request->type;
        $blog->editedby_id = Auth::id();

        if ($request->tags) {
            $blog->tags = implode(', ', $request->tags);
        } else {
            $blog->tags = null;
        }
        if ($request->hasFile('feature_image')) {
            $f = 'blog/' . $blog->feature_image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $ffile = $request->feature_image;
            $fimgExt = strtolower($ffile->getClientOriginalExtension());
            $fimageNewName = time() . '.' . $fimgExt;
            $originalName = $ffile->getClientOriginalName();
            Storage::disk('public')->put('blog/' . $fimageNewName, File::get($ffile));
            $blog->feature_img_name = $fimageNewName;
        }
        $blog->save();
        $blog->blogCategories()->detach();

        if ($request->categories) {
            foreach ($request->categories as $cat) {
                $c = PostCategory::where('category_id', $cat)->where('post_id', $blog->id)->first();
                if (!$c) {
                    $c = new PostCategory;
                    $c->category_id = $cat;
                    $c->post_id = $blog->id;
                    $c->addedby_id = Auth::id();
                    $c->save();
                }
            }
        }
        return redirect()->back()->with('success', 'Blog Updated Successfully');
    }
    public function postDelete(Blog $blog, Request $request)
    {
        if ($blog->feature_img_name) {
            $f = 'blog/' . $blog->feature_image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $blog->feature_img_name = null;
            $blog->save();
        }
        $blog->blogCategories()->detach();
        $blog->delete();

        Cache::flush();

        return back()->with('success', 'Blog successfully deleted.');
    }

    public function categories(Request $request)
    {
        menuSubmenu('allBlogs', 'categories');
        $categories = BlogCategory::latest()->paginate(30);
        return view('admin.blog.category.index', compact('categories'));
    }
    public function addCategory(Request $request)
    {
        menuSubmenu('allBlogs', 'categories');
        $request->validate([
            'name' => 'required |unique:blog_categories,name'
        ]);
        $bcat = new BlogCategory;
        $bcat->name = $request->name;
        $bcat->save();
        return redirect()->back()->with('success', 'Category Added Success fully');
    }
    public function editCategory(Request $request)
    {
        menuSubmenu('allBlogs', 'categories');
        $categories = BlogCategory::latest()->paginate(30);
        $cat = BlogCategory::find($request->category);
        if (!$cat) {
            return redirect()->back()->with('warning', 'No Category Found');
        }
        return view('admin.blog.category.edit', compact('categories', 'cat'));
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'name' => 'required |unique:blog_categories,name'
        ]);
        $bcat = BlogCategory::find($request->category);
        if (!$bcat) {
            return redirect()->back()->with('warning', 'No Category Found');
        }
        $bcat->name = $request->name;
        $bcat->save();
        return redirect()->back()->with('success', 'Category Added Successfully');
    }
    public function deleteCategory(Request $request)
    {
        $bcat = BlogCategory::find($request->category);
        if (!$bcat) {
            return redirect()->back()->with('warning', 'No Category Found');
        }
        $bcat->delete();
        return back()->with('success', 'Category Deleted Successfully');
    }

    // Tags
    public function tags(Request $request)
    {
        menuSubmenu('allBlogs', 'tags');
        $tags = BlogTag::latest()->paginate(30);
        return view('admin.blog.tags.index', compact('tags'));
    }
    public function addTags(Request $request)
    {
        menuSubmenu('allBlogs', 'tags');
        $request->validate([
            'name' => 'required |unique:blog_tags,name'
        ]);
        $bcat = new BlogTag;
        $bcat->name = $request->name;
        $bcat->save();
        return redirect()->back()->with('success', 'Tags Added Success fully');
    }
    public function editTags(Request $request)
    {
        menuSubmenu('allBlogs', 'tags');
        $tags = BlogTag::latest()->paginate(30);
        $tag = BlogTag::find($request->tag);
        if (!$tag) {
            return redirect()->back()->with('warning', 'No Category Found');
        }
        return view('admin.blog.tags.edit', compact('tags', 'tag'));
    }

    public function updateTags(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $bcat = BlogTag::find($request->tag);
        if (!$bcat) {
            return redirect()->back()->with('warning', 'No Tag Found');
        }
        $bcat->name = $request->name;
        $bcat->save();
        return redirect()->back()->with('success', 'Tag Added Successfully');
    }
    public function deleteTags(Request $request)
    {
        $bcat = BlogTag::find($request->tag);
        if (!$bcat) {
            return redirect()->back()->with('warning', 'No Tag Found');
        }
        $bcat->delete();
        return back()->with('success', 'Tag Deleted Successfully');
    }
    public function selectTagsOrAddNew(Request $request)
    {
        $tags = BlogTag::where('name', 'like', '%' . $request->q . '%')
            ->select(['name'])->take(30)->get();
        if ($tags->count()) {
            if ($request->ajax()) {
                return $tags;
            }
        } else {
            if ($request->ajax()) {
                return $tags;
            }
        }
    }
    public function socialGroups()
    {
        menuSubmenu('socialGroups', 'socialGroups');
        $socials = SocialGroup::latest()->paginate(20);
        return view('admin.socialGroups.index', compact('socials'));
    }
    public function socialGroupsStore(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'link' => 'required | url',
            'active' => 'nullable'
        ]);
        $socilG = new SocialGroup;
        $socilG->type = $request->type;
        $socilG->title = $request->title;
        $socilG->link = $request->link;
        $socilG->active = $request->active ? 1 : 0;
        $socilG->addedby_id = Auth::id();
        $socilG->save();
        return redirect()->back()->with('success', 'Social Group Successfully Added');
    }
    public function socialGroupsStatusUpdate(Request $request)
    {
        $socialGroup = SocialGroup::where('id', $request->social)->first();
        if (!$socialGroup) {
            return back();
        }
        $groupType = $request->type;


        if ($groupType == 'inactive') {
            $socialGroup->active = 0;
        } elseif ($groupType == 'active') {
            $socialGroup->active = 1;
        } elseif ($groupType == 'delete') {
            $socialGroup->delete();
        } elseif ($groupType == 'edit') {
            $socials = SocialGroup::latest()->paginate(20);
            return view('admin.socialGroups.edit', compact('socials', 'socialGroup'));
        } else {
            return back();
        }
        $socialGroup->save();

        return redirect()->back()->with('success', "Social Group Updated Successfully!!");
    }

    public function socialGroupsUpdate(Request $request)
    {
        $socialGroup = SocialGroup::where('id', $request->social)->first();
        if (!$socialGroup) {
            return back();
        }
        $socialGroup->type = $request->type;
        $socialGroup->title = $request->title;
        $socialGroup->link = $request->link;
        $socialGroup->active = $request->active ? 1 : 0;
        $socialGroup->editedby_id = Auth::id();
        $socialGroup->save();
        return redirect()->back()->with('success', 'Social Group Updated Successfuly');
    }
    public function suggessionAll()
    {
        menuSubmenu('suggessionAll','suggessionAll');
       $suggessions= Suggestion::where('parent_id',null)->orderBy('closed')->orderBy('created_at','desc')->get();


       return view('admin.suggession.allSuggession',compact('suggessions'));
    }

    public function suggessionChat(Request $request)
    {
        $suggession= Suggestion::find($request->chat);
        return view('admin.suggession.suggessionChat',compact('suggession'));
    }

    public function usersmssendpage()
    {
        menuSubmenu('usersmssend', 'usersmssend');
        $workstation = WorkStation::where('active', true)->get();
        return view('admin.usersendsms',compact('workstation'));
    }
    public function usersmssend(Request $request)
    {
        $request->validate([
            'message' => 'required',
            //'key' => 'required',

        ]);

        // if( $request->key!="1234"){
        //     return redirect()->back()->with('warning', 'Key is Wrong');
        // }
        $messages= $request->message;


        if($request->workstation!='' && $request->category!=''){
            $users = DB::table('users')
            ->join('service_profiles', 'users.id', '=', 'service_profiles.user_id')
            ->where('service_profiles.workstation_id', $request->workstation)
            ->where('service_profiles.workstation_id', $request->category)
            ->where('service_profiles.profile_type', 'business')
            ->select('users.mobile')
            ->get();

        }else{
            $users = user::select('mobile')->get();
        }

        $user_count= $users->count();

       if($user_count>0){
        foreach($users as $user){
            $number= $user->mobile;
            $SendSms=new SendSms;
            try {
                // Send a message using the primary device.
                $msg = $SendSms->sendSingleMessage($number,$messages);

            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }

       }else{
        return redirect()->back()->with('warning', 'User  not Found');
       }


        return redirect()->back()->with('success', 'Message Send Successfully');
    }


    public function usernotificatioonsendpage()
    {
        menuSubmenu('usernotificatioonsend', 'usernotificatioonsend');
        $workstation = WorkStation::where('active', true)->get();
        return view('admin.usernotificatioonsend',compact('workstation'));
    }
    public function usernotificatioonsend(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'message' => 'required',
            'details' => 'required'

        ]);

        // if( $request->key!="1234"){
        //     return redirect()->back()->with('warning', 'Key is Wrong');
        // }
        $messages= $request->message;
        $title= $request->title;
        $details= $request->details;


        if($request->workstation!='' && $request->category!=''){
            $users = DB::table('users')
            ->join('service_profiles', 'users.id', '=', 'service_profiles.user_id')
            ->where('service_profiles.workstation_id', $request->workstation)
            ->where('service_profiles.workstation_id', $request->category)
            ->where('service_profiles.profile_type', 'business')
            ->select('users.id')
            ->get();

        }else{
            $users = User::select('id')->get();
        }

        //dd($users)

        $user_count= $users->count();

       if($user_count>0){
        foreach($users as $user){
            $notification1=new OrderNotifications;
            $notification1->type='Messages';
            $notification1->title=$title;
            $notification1->messages=$messages;
            $notification1->details=$details;
            $notification1->user_id=$user->id;
            $notification1->status='1';
            $notification1->date=now();
            $notification1->save();


        }

       }else{
        return redirect()->back()->with('warning', 'User  not Found');
       }


        return redirect()->back()->with('success', 'Notification Send Successfully');
    }

    public function categorylist(Request $request)
    {
        menuSubmenu('categories', 'categories');
        $workstations=WorkStation::orderBy('title', 'asc')->get();
        $workstation_id='';
        if($request->workstation_id){
            $categories =Category::where('work_station_id',$request->workstation_id)->orderBy('name', 'asc')->get();
            $workstation_id=$request->workstation_id;
        }else{
            $categories =Category::orderBy('name', 'asc')->get();
        }


       return view('admin.categories.categorylist', [
            'categories' => $categories,
            'workstations' => $workstations,
            'workstation_id' => $workstation_id
        ]);

    }

    public function updatecategorylist(Request $request)
    {
        menuSubmenu('categories', 'categories');
       $sp_create_charge=$request->get('sp_create_charge');
       $id=$request->get('id');
       $service_product_commission=$request->get('service_product_commission');
       $count_items = count($sp_create_charge);

       for($i = 0; $i<$count_items; $i++)
       {
            $categories =Category::Where('id',$id[$i])->first();
            $categories->sp_create_charge=$sp_create_charge[$i];
            $categories->service_product_commission=$service_product_commission[$i];
            $categories->save();
       }

        return redirect()->back()->with('success', 'Update  Successfully');


    }


    public function adminnotificationslist()
    {
      $notifications=OrderNotifications::where('type','admin')->latest()->paginate(10);

      return view('admin.adminnotification.notificationslist', [
        'notifications' => $notifications
      ]);
    }
    public function adminnotificationsdetails($id)
    {
      $details=OrderNotifications::where('id',$id)->first();

      $details->status='2';
      $details->save();

      return view('admin.adminnotification.notificationsdetails', [
        'details' => $details
      ]);
    }


    //Review & Rating


    public function ratinglist()
    {
      menuSubmenu('ratinglist', 'ratinglist');
      $rating=Rating::latest()->paginate(50);

      return view('admin.rating.index', [
        'rating' => $rating
      ]);
    }

    public function editrating($id)
    {
        $data = Rating::where('id', $id)->first();
        return view('admin.rating.edit', compact('data'));
    }

    public function deleterating($id)
    {
        $data = Rating::where('id',$id)->first();
        $data->delete();
        return redirect()->back()->with('success', 'Rating And Review Delete Successfully');
    }

    public function updaterating(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'rating' => ['required', 'digits_between:1,5'],
                'comments' => ['required']

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $data = Rating::where('id',$request->id)->first();
        $data->rating = $request->rating;
        $data->comments = $request->comments;
        $data->status = $request->status;
        $data->save();
        return redirect()->back()->with('success', 'Rating And Review Update Successfully');
    }


    //Applicant application List

    public function applicationlist()
    {
      menuSubmenu('softcomapplication', 'softcomapplicationlist');
      $datas=SoftcomJobCandidate::latest()->paginate(50);

      return view('admin.softcomapplication.index', [
        'datas' => $datas
      ]);
    }

    public function applicationdetails($id)
    {
        $data = SoftcomJobCandidate::where('id', $id)->first();
        return view('admin.softcomapplication.details', compact('data'));
    }

    public function applicationupdate(Request $request)
    {


        $id=$request->id;
        $type=$request->type;


        $data = SoftcomJobCandidate::where('id', $id)->first();
        if($type==1){
            $data->status=$request->type;
        }else{
            $data->status=$request->type;
        }
        $data->save();

        return redirect()->route('admin.applicationlist')->with('success', 'Status Update Successfully');
    }


    public function EmployeeReport()
    {
        menuSubmenu('employeeReport', 'employeeReport');
        $datas = EmployeeReport::all();
        return view('admin.employeeReport.index',compact('datas'));
    }


    public function deleteEmployeeReport($id=null)
    {
        $data = EmployeeReport::where('id',$id)->first();

        $data->delete();
        return redirect()->route('admin.employeeReport')->with('success', 'Deleted Successfully');

    }



    public function editEmployeeReport($id){
        $employeDetails = EmployeeReport::where('id', $id)->first();
        $paidService = ServiceProfile::where('user_id', $id)->where('paystatus', 1)->get();

        $unpaidService = ServiceProfile::where('user_id', $id)->where('paystatus', 0)->get();

        $trilService = ServiceProfile::where('user_id', $id)->where('is_trial', 1)->get();



        return view('admin.employeeReport.employeeDetails', compact('employeDetails', 'paidService', 'unpaidService', 'trilService'));
    }






















    public function LogActivityList()
    {
        menuSubmenu('LogActivity', 'LogActivity');
        $logs = \LogActivity::logActivityLists();
        return view('admin.logactivity.index',compact('logs'));
    }


    public function LogActivityDelete($id)
    {
        $data = LogActivity::where('id',$id)->first();
        $data->delete();
        return redirect()->route('admin.LogActivityList')->with('success', 'Deleted Successfully');

    }






}
