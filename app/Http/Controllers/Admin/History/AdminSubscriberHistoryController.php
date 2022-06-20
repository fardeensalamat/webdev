<?php

namespace App\Http\Controllers\Admin\History;

use Auth;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Subscriber;
use App\Models\FreelancerJob;
use App\Models\FreelanceJobWork;
use App\Models\SubscriberHonorarium;
use App\Models\BalanceTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServiceProductOrder;
use App\Models\ServiceProfile;
use App\Models\ServiceProductOrderItem;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class AdminSubscriberHistoryController extends Controller
{
    // public function dispositHistory(Subscriber $subscriber)
    // {
    //     $transactionHistory = BalanceTransaction::where('subscriber_id',$subscriber->id)->latest()->paginate(25);

    //     return view('admin.subcribers.depositHistory',[
    //         'subscriber' => $subscriber,
    //         'transactionHistory' => $transactionHistory
    //     ]);
    // }

    // public function honorariumTransfer(Subscriber $subscriber)
    // {
    //     $transactionHistory = SubscriberHonorarium::where('subscriber_id',$subscriber->id)->latest()->paginate(25);
    //     return view('admin.subcribers.honorariumTransfer',[
    //         'subscriber' => $subscriber,
    //         'transactionHistory' => $transactionHistory
    //     ]);
    // }


    public function userStatusUpdate(Request $request)
    {
        $type = $request->type;
        $user = User::withoutGlobalScopes()
            ->where('id', $request->user)
            ->firstOrFail();

        if ($type == 'active') {
            $user->active = $user->active ? false : true;
            $user->save();
        }

        if ($type == 'wallet') {
            $user->wallet_lock = $user->wallet_lock ? false : true;
            $user->save();
        }

        return back();
    }

    public function userHistoryInfo(Request $request)
    {

        $type = $request->type;
        $user = User::withoutGlobalScopes()
            ->where('id', $request->user)
            ->firstOrFail();


        if ($type == 'all_tr') {
            if (!Auth::user()->hasPermission('tenant')) {
                abort(401);
            }
            $transactions = $user->balanceTransactions()
                // ->where('to','user')
                ->latest()
                ->paginate(50)
                ->appends(['type' => $type]);

            return view('admin.users.userTrHistory', [
                'user' => $user,
                'transactions' => $transactions,
                'type' => $type
            ]);
        }

        if (($type == 'deposit') or ($type == 'withdraw')) {
            if (!Auth::user()->hasPermission('tenant')) {
                abort(401);
            }
            $transactions = $user->balanceTransactions()
                ->where('to', 'user')
                ->where('purpose', $type)
                ->latest()
                ->paginate(50)
                ->appends(['type' => $type]);

            return view('admin.users.userTrHistory', [
                'user' => $user,
                'transactions' => $transactions,
                'type' => $type
            ]);
        }

        if ($type == 'subscribers') {
            if (!Auth::user()->hasPermission('tenant')) {
                abort(401);
            }

            if ($request->status == "post_paid") {
                $title = "Post Paid ";
                $subcribers = Subscriber::where('user_id', $user->id)->where('free_account', 1)
                    ->orderBy('work_station_id', 'DESC')
                    ->paginate(50);
            } elseif ($request->status == "standard") {
                $title = "Standard";
                $subcribers = Subscriber::where('user_id', $user->id)->where('free_account', 0)
                    ->orderBy('work_station_id', 'DESC')
                    ->paginate(50);
            } else {
                $title = "All";
                $subcribers = Subscriber::where('user_id', $user->id)
                    ->orderBy('work_station_id', 'DESC')
                    ->paginate(50);
            }

            return view('admin.subcribers.subcriberList', [
                'user' => $user,
                'subcribers' => $subcribers,
                'type' => $type,
                'title' => $title
            ]);
        }

        if ($type == 'shop') {
            if (!Auth::user()->hasPermission('tenant')) {
                abort(401);
            }

            if($request->status=='paidshop'){
                $title="Paid Shop";
                $profiles=ServiceProfile::where('paystatus', '1')->where('user_id', $user->id)->latest()->paginate(12);
                return view('admin.dashboarddetails.tenantshopdetails', compact(
                    'profiles',
                    'title'
        
                ));
               
            }elseif($request->status=='unpaidshop'){
                $title="Unpaid Shop";
                $profiles=ServiceProfile::where('paystatus', '0')->where('user_id', $user->id)->latest()->paginate(12);
    
                return view('admin.dashboarddetails.tenantshopdetails', compact(
                    'profiles',
                    'title'
        
                ));
            }else{

                $title="All Shop";
                $profiles=ServiceProfile::latest()->paginate(12);
                return view('admin.dashboarddetails.tenantshopdetails', compact(
                    'profiles',
                    'title'
        
                ));
    
            }
        }
        if ($type == 'reffer') {
            if (!Auth::user()->hasPermission('tenant')) {
                abort(401);
            }
            $title = "All Reffer";
            $myAllPf = Subscriber::where('user_id', $user->id)
                ->has('referredTeam')
                ->pluck('id');

            $subcribers = Subscriber::where('user_id', '!=', $user->id)
                ->whereIn('referral_id', $myAllPf)
                ->paginate(50);

            return view('admin.subcribers.subcriberList', [
                'user' => $user,
                'subcribers' => $subcribers,
                'type' => $type,
                'title' => $title
            ]);
        }

        if ($type == 'honorarium') {
            if (!Auth::user()->hasPermission('tenant')) {
                abort(401);
            }
            $transactionHistory = SubscriberHonorarium::where('user_id', $user->id)
                ->latest()
                ->paginate(25)
                ->appends(['type' => $type]);
            return view('admin.users.userHonorariumTransfer', [
                'user' => $user,
                'transactionHistory' => $transactionHistory,
                'type' => $type
            ]);
        }

        return back();
    }
public function userSalesHistoryInfo(Request $request)
{
    $user = User::find($request->user);
    $salesHistory= ServiceProductOrder::where('user_id',$user->id)->where('order_status','satisfied')->latest()->paginate(20);

  return view('admin.reports.salesHistoryInfo',compact('user','salesHistory'));
}
public function orderItemHistoryInfo(Request $request)
{
    $order= $request->order;
    $order_history= ServiceProductOrderItem::where('service_product_order_id',$request->order)->latest()->paginate(20);
    return view('admin.reports.salseItemHistoryInfo',compact('order_history','order'));
}
    public function subscriberHistoryInfo(Subscriber $subscriber, Request $request)
    {
        if (!Auth::user()->hasPermission('subscriber')) {
            abort(401);
        }
        $type = $request->type;

        if ($type == 'honorarium') {
            $transactionHistory = SubscriberHonorarium::where('subscriber_id', $subscriber->id)->latest()->paginate(25)->appends(['type' => $type]);
            return view('admin.subcribers.honorariumTransfer', [
                'subscriber' => $subscriber,
                'transactionHistory' => $transactionHistory
            ]);
        }

        if ($type == 'job') {
            $jobs = FreelancerJob::where('subscriber_id', $subscriber->id)->latest()->paginate(25)->appends(['type' => $type]);
            return view('admin.subcribers.jobs', [
                'subscriber' => $subscriber,
                'jobs' => $jobs
            ]);
        }

        if ($type == 'work') {
            $works = FreelanceJobWork::where('subscriber_id', $subscriber->id)->latest()->paginate(25)->appends(['type' => $type]);
            return view('admin.subcribers.works', [
                'subscriber' => $subscriber,
                'works' => $works
            ]);
        }


        if (($type == 'move_to_wallet')) {
            $trs = BalanceTransaction::where('subscriber_id', $subscriber->id)
                ->where('purpose', $type)
                ->latest()
                ->paginate(25)
                ->appends(['type' => $type]);
            return view('admin.subcribers.subscriberTrHistory', [
                'subscriber' => $subscriber,
                'transactions' => $trs,
                'type' => $type
            ]);
        }

        return back();
    }
    public function LoginAsUser(Request $request)
    {
      $admin= Auth::id();
      Auth::logout();
      $min = 60 * 24 * 30 * 2; //for 2 months;
      Cookie::queue('adminCookie', $admin, $min);
      Auth::loginUsingId($request->user, true);
      return redirect()->route('user.dashboard');

    }
}
