<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Hash;
use DB;
use Session;
use Validator;
use App\Models\Sms;
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
use App\Models\SocialGroup;
use App\Models\Suggestion;
use App\Models\UserUpdateInformation;
use App\Models\WorkStation;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class AdmindashboarddetailsController extends Controller
{
     public function todaytotalcashindetails()
     {
        menuSubmenu('dashboard', 'dashboard');
        $today = Carbon::today();
        //dd($today);
        $todaytotalRentaldetails = SubcriberPayment::where('status', 'paid')
            ->whereDate('created_at', $today)
            ->get();

            //dd($todaytotalRentaldetails);

        $todaytotalRental=$todaytotalRentaldetails->sum('amount');

        $todayTotalDepositdetails = Order::where('order_for', 'deposit')->where('order_status', 'delivered')
            ->where('payment_status', 'paid')
            ->whereDate('created_at', $today)
            ->get();

        //dd($todayTotalDepositdetails);

        $todayTotalDeposit=$todayTotalDepositdetails->sum('paid_amount');
         
        $todayIn = $todaytotalRental + $todayTotalDeposit;

        return view('admin.dashboarddetails.todaytotalcashindetails', compact(
            'todaytotalRentaldetails',
            'todaytotalRental',
            'todayTotalDepositdetails',
            'todayTotalDeposit',
            'todayIn'
        ));




     }
     public function todaytotalwitdrawdetails()
     {
        menuSubmenu('dashboard', 'dashboard');
        $today = Carbon::today();
        $todaytotalwitdrawdetails = BalanceTransaction::where('purpose', 'withdraw')->whereDate('created_at', $today)->latest()->paginate(10);
        $todaytotalwitdraw=$todaytotalwitdrawdetails->sum('moved_balance'); 
        $grandtodaytotalwitdraw = BalanceTransaction::where('purpose', 'withdraw')->whereDate('created_at', $today)->sum('moved_balance');

        return view('admin.dashboarddetails.todaytotalwitdrawdetails', compact(
            'todaytotalwitdrawdetails',
            'todaytotalwitdraw',
            'grandtodaytotalwitdraw'
        ));
           




     }
     public function totalwitdrawdetails()
     {
        menuSubmenu('dashboard', 'dashboard');
        $totalwitdrawdetails = BalanceTransaction::where('purpose', 'withdraw')->latest()->paginate(10);
        $totalwitdraw=$totalwitdrawdetails->sum('moved_balance'); 
        $grandtotalwitdraw = BalanceTransaction::where('purpose', 'withdraw')->sum('moved_balance');

        return view('admin.dashboarddetails.totalwitdrawdetails', compact(
            'totalwitdrawdetails',
            'totalwitdraw',
            'grandtotalwitdraw'
        ));
     }
     public function totalcashoutdetails()
     {
        menuSubmenu('dashboard', 'dashboard');

     }
     //softcode in details/ SCB balance details

     // Toaday softcode in details/ SCB balance details
     
     public function todaysoftcodeindetails()
     {
        menuSubmenu('dashboard', 'dashboard');
        $today = Carbon::today();
        $todaySoftcodegetdetails = BalanceTransaction::where('to', 'admin')->whereDate('created_at', $today)->latest()->paginate(10);
        $todaySoftcodeget=$todaySoftcodegetdetails->sum('moved_balance');
        $grandtodaySoftcodeget = BalanceTransaction::where('to', 'admin')->whereDate('created_at', $today)->sum('moved_balance');

        return view('admin.dashboarddetails.todaysoftcodeindetails', compact(
            'todaySoftcodegetdetails',
            'todaySoftcodeget',
            'grandtodaySoftcodeget'
        ));

        
     }
     public function todaysoftcodeoutdetails()
     {
        $today = Carbon::today();
        menuSubmenu('dashboard', 'dashboard');
        $todaySoftcodeoutdetails = BalanceTransaction::where('from', 'admin')->whereDate('created_at', $today)->latest()->paginate(10);

        $todaySoftcodeout=$todaySoftcodeoutdetails->sum('moved_balance');
        $grandtodaySoftcodeout = BalanceTransaction::where('from', 'admin')->whereDate('created_at', $today)->sum('moved_balance');

        return view('admin.dashboarddetails.todaysoftcodeoutdetails', compact(
            'todaySoftcodeoutdetails',
            'todaySoftcodeout',
            'grandtodaySoftcodeout'
        ));

     }
      // total softcode in details/ SCB balance details
     public function totalsoftcodeindetails()
     {
        menuSubmenu('dashboard', 'dashboard');
        $totalSoftcodegetdetails = BalanceTransaction::where('to', 'admin')->latest()->paginate(10);

        $totalSoftcodeget=$totalSoftcodegetdetails->sum('moved_balance');
        $grandtotalSoftcodeget = BalanceTransaction::where('to', 'admin')->sum('moved_balance');
        $end='';
        $start='';
        return view('admin.dashboarddetails.totalsoftcodeindetails', compact(
            'totalSoftcodegetdetails',
            'totalSoftcodeget',
            'grandtotalSoftcodeget',
            'start','end'
        ));
     }
     public function totalsoftcodeoutdetails()
     {
        menuSubmenu('dashboard', 'dashboard');
        $totalSoftcodegetdetails = BalanceTransaction::where('from', 'admin')->latest()->paginate(10);

        $totalSoftcodeget=$totalSoftcodegetdetails->sum('moved_balance');
        $grandtotalSoftcodeget = BalanceTransaction::where('from', 'admin')->sum('moved_balance');
        $end='';
        $start='';

        return view('admin.dashboarddetails.totalsoftcodeoutdetails', compact(
            'totalSoftcodegetdetails',
            'totalSoftcodeget',
            'grandtotalSoftcodeget',
            'start','end'
        ));
     }
     public function rentaldetails()
     {
        menuSubmenu('dashboard', 'dashboard');
       
        $rentaldetails = SubcriberPayment::where('status', 'paid')->latest()->paginate(10);
        $totalRental =   $rentaldetails->sum('amount');
        $grandtotalRental=SubcriberPayment::where('status', 'paid')->sum('amount');

        return view('admin.dashboarddetails.rentaldetails', compact(
            'rentaldetails',
            'totalRental',
            'grandtotalRental'
        ));
     }
     public function depositdetails()
     {
        menuSubmenu('dashboard', 'dashboard');
        $grandtotalDeposit = Order::where('order_for', 'deposit')->where('order_status', 'delivered')->where('payment_status', 'paid')->sum('paid_amount'); 


        $depositdetails = Order::where('order_for', 'deposit')->where('order_status', 'delivered')->where('payment_status', 'paid')->latest()->paginate(10); 
        $totalDeposit= $depositdetails->sum('paid_amount');
        
        return view('admin.dashboarddetails.depositdetails', compact(
            'depositdetails',
            'totalDeposit',
            'grandtotalDeposit'
        ));
     }
     public function tenantwalletdetails()
     {
        menuSubmenu('dashboard', 'dashboard');
        $grandtotalTenantWallet = User::sum(\DB::raw('balance + system_balance'));
        $tenantwalletdetails = User::latest()->paginate(10);
        $totalTenantWallet= $tenantwalletdetails->sum(\DB::raw('balance + system_balance'));

        return view('admin.dashboarddetails.tenantwalletdetails', compact(
            'tenantwalletdetails',
            'grandtotalTenantWallet',
            'totalTenantWallet'
        ));
        
     }
     public function pfbalancedetails()
     {
        menuSubmenu('dashboard', 'dashboard');

        $grandtotalPfBalance = Subscriber::sum('balance');
        $pfbalancedetails = Subscriber::latest()->paginate(10);
        //dd($pfbalancedetails);
        $totalPfBalance= $pfbalancedetails->sum('balance');
        
        return view('admin.dashboarddetails.pfbalancedetails', compact(
            'pfbalancedetails',
            'grandtotalPfBalance',
            'totalPfBalance'
        ));
     }


     public function tenentbalanceaddbyadmin()
     {
        menuSubmenu('dashboard', 'dashboard');

        $end='';
        $start='';
        $useraddbalance = UserBalanceEdit::where('type','add')->sum('changed_balance');
        $usersubtractbalance = UserBalanceEdit::where('type','subtract')->sum('changed_balance');

        $tenentbalanceaddbyadmin= $useraddbalance-$usersubtractbalance;

        $grandtotalBalance = UserBalanceEdit::sum('changed_balance');
        $balancedetails = UserBalanceEdit::latest()->paginate(10);
        //dd($pfbalancedetails);
        $totalBalance= $balancedetails->sum('changed_balance');
        
        return view('admin.dashboarddetails.tenentbalanceaddbyadmin', compact(
            'balancedetails',
            'grandtotalBalance',
            'totalBalance',
            'tenentbalanceaddbyadmin',
            'useraddbalance',
            'usersubtractbalance',
            'start','end'

        ));
     }

     public function tenentinfobyadmin()
     {
        menuSubmenu('dashboard', 'dashboard');

        $end='';
        $start='';
        $user_update_informations = UserUpdateInformation::orderBy('id', 'DESC')->paginate(20);
        
        return view('admin.dashboarddetails.tenentinfobyadmin', compact(
            'user_update_informations',
            'start','end'

        ));
     }


     public function detailsGetByDateInterval(Request $request)
     {        
         $start = $request->date_from;
         $end = $request->date_to;
         $type = $request->type; 
         
         if($type == 'totalin')
         {
            $totalSoftcodegetdetails = BalanceTransaction::where('to', 'admin')->whereBetween('created_at',[$start,$end])->latest()->paginate(10);

            $totalSoftcodeget=$totalSoftcodegetdetails->sum('moved_balance');
            $grandtotalSoftcodeget = BalanceTransaction::where('to', 'admin')->whereBetween('created_at',[$start,$end])->sum('moved_balance');
    
            return view('admin.dashboarddetails.totalsoftcodeindetails', compact(
                'totalSoftcodegetdetails',
                'totalSoftcodeget',
                'grandtotalSoftcodeget',
                'start','end'

            ));
         }elseif($type == 'totalout'){
            $totalSoftcodegetdetails = BalanceTransaction::where('from', 'admin')->whereBetween('created_at',[$start,$end])->latest()->paginate(10);

            $totalSoftcodeget=$totalSoftcodegetdetails->sum('moved_balance');
            $grandtotalSoftcodeget = BalanceTransaction::where('from', 'admin')->whereBetween('created_at',[$start,$end])->sum('moved_balance');
            
    
            return view('admin.dashboarddetails.totalsoftcodeoutdetails', compact(
                'totalSoftcodegetdetails',
                'totalSoftcodeget',
                'grandtotalSoftcodeget',
                'start','end'
            ));
         }elseif($type == 'addedbalance'){


            $useraddbalance = UserBalanceEdit::where('type','add')->whereBetween('created_at',[$start,$end])->sum('changed_balance');
            $usersubtractbalance = UserBalanceEdit::where('type','subtract')->whereBetween('created_at',[$start,$end])->sum('changed_balance');
    
            $tenentbalanceaddbyadmin= $useraddbalance-$usersubtractbalance;
    
            //$grandtotalBalance = UserBalanceEdit::sum('changed_balance')->whereBetween('created_at',[$start,$end]);
            $balancedetails = UserBalanceEdit::latest()->whereBetween('created_at',[$start,$end])->paginate(10);
            //dd($pfbalancedetails);
            $totalBalance= $balancedetails->sum('changed_balance');
            
            return view('admin.dashboarddetails.tenentbalanceaddbyadmin', compact(
                'balancedetails',
                //'grandtotalBalance',
                'totalBalance',
                'tenentbalanceaddbyadmin',
                'useraddbalance',
                'usersubtractbalance',
                'start','end'
    
            ));

         }elseif($type == 'tenantinfochanged') {
            $user_update_informations = UserUpdateInformation::whereBetween('created_at',[$start,$end])->orderBy('id', 'DESC')->paginate(20);
        
            return view('admin.dashboarddetails.tenentinfobyadmin', compact(
                'user_update_informations',
                'start','end'
    
            ));
         }else{
             
         }
 
        
         
       
         
     }


     public function tenantserviceprofiledetails(Request $request)
     {
        menuSubmenu('dashboard', 'dashboard');
        $type = $request->type;

        if($type=='paidpf'){
            $title="Paid PF";
            $subcribers = Subscriber::where('free_account', '0')->latest()->paginate(12);
            return view('admin.subcribers.subcriberList', [
                'subcribers' => $subcribers,
                'type' => $type,
                'title' => $title
            ]);
        }elseif($type=='unpaidpf'){
            $title="Unpaid PF";
            $subcribers=Subscriber::where('free_account', '1')->latest()->paginate(12);
            return view('admin.subcribers.subcriberList', [
                'subcribers' => $subcribers,
                'type' => $type,
                'title' => $title
            ]);
           
        }elseif($type=='paidshop'){
            $title="Paid Shop";
            $profiles=ServiceProfile::where('paystatus', '1')->latest()->paginate(12);
            return view('admin.dashboarddetails.tenantshopdetails', compact(
                'profiles',
                'title',
                'type'
    
            ));
           
        }elseif($type=='unpaidshop'){
            $title="Unpaid Shop";
            $profiles=ServiceProfile::where('paystatus', '0')->latest()->paginate(12);

            return view('admin.dashboarddetails.tenantshopdetails', compact(
                'profiles',
                'title',
                'type'
    
            ));
        }else{

        }

      
       
       
     }

}
