<?php

namespace App\Http\Controllers\Admin\Order;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Honorarium;
use App\Models\Subscriber;
use App\Models\AdminBalance;
use App\Models\OrderPayment;
use App\Models\SubscriberHonorarium;
use App\Models\BalanceTransaction;
use App\Models\SubcriberPayment;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\WithdrawalList;
use App\Models\WorkStation;
use Illuminate\Http\Request;
use App\Models\OrderNotifications;

class AdminOrderController extends Controller
{
    public function ordersAll(Request $request)
    {

        $type = $request->type;
        // dd($type);
        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'order', 'lsbsm' => 'order' . $type]);
        if ($type == 'all') {
            if (!Auth::user()->hasPermission('subscription')) {
                abort(401);
            }
            $payments = SubcriberPayment::orderBy('status', 'desc')->latest()->paginate(50)->appends(['type' => $type]);
        } elseif ($type == 'pending') {
            if (!Auth::user()->hasPermission('subscription')) {
                abort(401);
            }
            $payments = SubcriberPayment::where('status', $type)->orderBy('id', 'desc')->paginate(50)->appends(['type' => $type]);
        } elseif ($type == 'paid') {
            if (!Auth::user()->hasPermission('subscription')) {
                abort(401);
            }
            $payments = SubcriberPayment::where('status', $type)->orderBy('id', 'desc')->paginate(50)->appends(['type' => $type]);
        }
        return view('admin.orders.ordersAll', [
            'payments' => $payments,
            'type' => $type
        ]);
    }

    public function paymentApprovedWithMigrate(SubcriberPayment $payment, Request $request)
    {
        // dd('yes');
        if ($payment->status == 'paid') {
            return back()->with('error', 'User Already Paid For Subsciption');
        }

        $payment->status = 'paid';

        $payment->save();

        //welcome message for user for first subscription

        $user = User::withoutGlobalScopes()->where('id', $payment->user_id)->first();

        if ($user->subscriptions()->count() < 1) {
            $user->active = 1;
            $user->save();
        }


        $prRow = Subscriber::where('work_station_id', $payment->work_station_id)->orderBy('ws_position', 'desc')->first();

        $dis = $payment->district_id ?: 1;
        if (strlen($dis) < 2) {
            $dis = '0' . $dis;
        }

        $wsId = $payment->work_station_id;
        if (strlen($wsId) < 2) {
            $wsId = '0' . $wsId;
        }

        $meMob = $payment->user->mobile ?: '00';
        if (strlen($meMob) > 2) {
            // $meMob = last 2 digit;
            $meMob = substr($meMob, -2);
        }

        $num = 100000000;
        $ws_pos = $prRow->ws_position + 1;
        $num = $num + $ws_pos;
        $scode = $wsId . $num . $meMob . $dis;

        $s = new Subscriber;
        $s->ws_position = $ws_pos;
        $s->name = $payment->user->name;
        $s->email = $payment->user->email;
        $s->mobile = $payment->user->mobile;
        // $s->balance = $commission;
        $s->category_id = $payment->cat_id;
        $s->district_id = $payment->district_id ?: 1;
        $s->user_id = $payment->user_id;
        $s->referral_id = $payment->refer_id;
        $s->work_station_id = $payment->work_station_id;
        $s->subscription_code = $scode;
        $s->addedby_id = Auth::id();
        $s->save();

        if ($user->subscriptions()->count() <= 1) {
            $user->welcomeSmsSend();
        }

        return back()->with('success', 'Payment Successfully Done!');
    }

    public function paymentApproved(SubcriberPayment $payment, Request $request)
    {

        if ($payment->status == 'paid') {
            return back()->with('error', 'User Already Paid For Subsciption');
        }

        $payment->status = 'paid';

        $payment->save();

        //welcome message for user for first subscription

        $user = User::withoutGlobalScopes()->where('id', $payment->user_id)->first();

        if ($user and ($user->subscriptions()->count() < 1)) {
            $user->active = 1;
            $user->save();
        }


        $prRow = Subscriber::where('work_station_id', $payment->work_station_id)->orderBy('ws_position', 'desc')->first();

        $dis = $payment->district_id ?: 1;
        if (strlen($dis) < 2) {
            $dis = '0' . $dis;
        }

        $wsId = $payment->work_station_id;
        if (strlen($wsId) < 2) {
            $wsId = '0' . $wsId;
        }

        $meMob = $payment->user->mobile ?: '00';
        if (strlen($meMob) > 2) {
            // $meMob = last 2 digit;
            $meMob = substr($meMob, -2);
        }

        $num = 100000000;
        $ws_pos = $prRow->ws_position + 1;
        $num = $num + $ws_pos;
        $scode = $wsId . $num . $meMob . $dis;

        $s = new Subscriber;
        $s->ws_position = $ws_pos;
        $s->name = $payment->user->name;
        $s->email = $payment->user->email;
        $s->mobile = $payment->user->mobile;
        // $s->balance = $commission;
        $s->category_id = $payment->cat_id;
        $s->district_id = $payment->district_id ?: 1;
        $s->user_id = $payment->user_id;
        $s->referral_id = $payment->refer_id;
        $s->work_station_id = $payment->work_station_id;
        $s->subscription_code = $scode;
        $s->addedby_id = Auth::id();

        //for joining amount to admin
        $joining_to_admin = 100;
        //100tk

        //for signup commission
        $honorariumComm = Honorarium::where('workstation_id', $s->work_station_id)
            ->where('active', 1)
            ->where('system_type', 'Joining')
            ->where('earning_type', 'Signup')
            ->sum('commission');
        $joining_signup_commission = $honorariumComm; //commmission * (joining fee /100)
        //10tk

        // $adminBalance->joining = $adminBalance->joining + $joining_to_admin - $joining_signup_commission;

        // $adminLast = $joining_to_admin - $joining_signup_commission;
        //90tk

        //for joining comm to subscriber
        // $s->balance = $s->balance + $joining_signup_commission;
        //10tk
        $s->save();
        //subscriber_honorarium row will be created here
        $sh = new SubscriberHonorarium;
        $sh->workstation_id = $s->work_station_id;
        $sh->subscriber_id = $s->id;
        $sh->user_id = $s->user_id;
        $sh->system_type = 'Joining';
        $sh->earning_type = 'Signup';
        $sh->commission = $honorariumComm; //in percent
        $sh->amount = $joining_signup_commission;
        $sh->delivered_to = 'subscriber';
        $sh->completed = 1;
        $sh->addedby_id = Auth::id();
        $sh->save();

        // bt will be here

        $bt = new BalanceTransaction;
        $bt->subscriber_id = $s->id;
        $bt->from = 'admin';
        $bt->to = 'subscriber';
        $bt->purpose = 'honorarium';
        $bt->user_id = $s->user_id;
        $bt->previous_balance = $s->balance ? $s->balance : 0;  // admin joining_reward balance
        $bt->moved_balance = $joining_signup_commission; // rewardAmount
        $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // admin new reward balance
        $bt->type = 'joining_bonus';
        $bt->details = "{$joining_signup_commission} tk joining honorarium balance to subscriber {$s->subscription_code} balance.";

        $bt->addedby_id = Auth::id();
        $bt->save();

        $s->balance = $bt->new_balance;
        $s->save();


        //for balance transfer from admin joining to admin reward fund
        $rewardComm = Honorarium::where('workstation_id', $s->work_station_id)
            ->where('active', 1)
            ->where('system_type', 'Joining')
            ->where('earning_type', 'Reward')
            ->sum('commission');

        $rewardAmount = $rewardComm; //commmission * (joining fee /100)
        //10tk

        // admin balance

        // $adminLast = $adminLast - $rewardAmount;
        //80tk
        // $admin_balance = $this->updateAdBalance($rewardAmount,$s->work_station_id,'joining_reward');


        //balance transfer  row will be created here for admin Reward fund
        // $bt = new BalanceTransaction;
        // $bt->subscriber_id = $s->id;
        // $bt->from = 'admin';
        // $bt->to = 'admin';
        // $bt->purpose = 'joining_reward';
        // $bt->user_id = $payment->user_id;
        // $bt->previous_balance = $abReward->previous_balance;  // admin joining_reward balance
        // $bt->moved_balance = $rewardAmount; // rewardAmount
        // $bt->new_balance = $abReward->new_balance; // admin new reward balance
        // $bt->type = 'joining_reward';
        // $bt->details = "Reward balance {$rewardAmount} of SubcriberPayment of #{$payment->id} transfered from joining balance to reward balance";

        // $bt->addedby_id = Auth::id();
        // $bt->save();


        // //for up-refferer
        // $adminRefTransferBalance = 0;
        if ($s->referral_id) {

            $refferalComm = Honorarium::where('workstation_id', $s->work_station_id)
                ->where('active', 1)
                ->where('system_type', 'Joining')
                ->where('earning_type', 'Refferal')
                ->sum('commission');

            $refferalAmount = $refferalComm; //commmission * (joining fee /100)
            //10tk

            $sub = $s;
            $n = $sub->ws_position - 1;

            $i = $n;

            //loop-failure logic start
            // $refferer = Subscriber::where('ws_position', $i)
            //     ->where('work_station_id', $sub->work_station_id)
            //     ->first();

            $refferer = $s->referrer;



            if ($refferer) {



                // $adminBalance->joining = $adminBalance->joining - $refferalAmount;
                // $adminRefTransferBalance = $adminRefTransferBalance + $refferalAmount;
                //70tk

                //for referer subscriber_honorarium  row will be created here for refferal commission


                if ($rUser = $refferer->user) {
                    $set = $rUser->honorarium_earning_set;
                    $refferalCommission = $refferalAmount * ($set / 100);
                    $refferalPerAmt =  $refferalCommission;
                    $reAmount = ($s->referral_id == $refferer->id) ? $refferalAmount : $refferalPerAmt;
                    // nearest introducer will not get penalty
                } else {
                    $refferalCommission = 0;
                    $refferalPerAmt =  $refferalCommission;
                    $reAmount = ($s->referral_id == $refferer->id) ? $refferalAmount : $refferalPerAmt;
                    // nearest introducer will not get penalty

                }


                $shr = new SubscriberHonorarium;
                $shr->workstation_id = $s->work_station_id;
                $shr->subscriber_id = $refferer->id;
                $shr->user_id = $refferer->user_id;
                $shr->system_type = 'Joining';
                $shr->earning_type = 'Refferal';
                $shr->commission =  $reAmount; //in percent
                $shr->amount =  $reAmount;
                $shr->delivered_to = 'subscriber';
                $shr->completed = 1;
                $shr->addedby_id = Auth::id();
                // if($reAmount > 0)
                // {
                //     $shr->save();
                // }
                $shr->save();

                // bt will be here
                $bt = new BalanceTransaction;
                $bt->subscriber_id = $refferer->id;
                $bt->from = 'admin';
                $bt->to = 'subscriber';
                $bt->purpose = 'honorarium';
                $bt->user_id = $refferer->user_id;
                $bt->previous_balance = $refferer->balance;  // admin joining_reward balance
                $bt->moved_balance =  $reAmount; // rewardAmount
                $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // admin new reward balance
                $bt->type = 'refferal_reward';

                $bt->details = "{$reAmount} tk refferal reward honorarium balance  added to subscriber {$refferer->subscription_code} balance purpose of {$sub->subscription_code}. (aoc:298)";


                $bt->addedby_id = Auth::id();
                // if($reAmount > 0)
                // {
                //     $bt->save();
                // }
                $bt->save();

                $refferer->balance = $refferer->balance + $reAmount;
                $refferer->save();



                // $refferalAmount = $refferalAmount * (10/100);
                // $sub = $refferer;

            }

            //loop-failure logic end

            // //loop-logic start
            // for($i = $n; $i > 0; $i--)
            // {
            //     $refferer = Subscriber::where('ws_position', $i)
            //     ->where('work_station_id', $sub->work_station_id)
            //     ->first();
            //     if($refferer)
            //     {
            //         if($refferer->id != $sub->referral_id)
            //         {
            //             continue;
            //         }
            //         else
            //         {
            //             // $adminBalance->joining = $adminBalance->joining - $refferalAmount;
            //             // $adminRefTransferBalance = $adminRefTransferBalance + $refferalAmount;
            //             //70tk

            //             //for referer subscriber_honorarium  row will be created here for refferal commission


            //             if($rUser = $refferer->user)
            //             {
            //                 $set = $rUser->honorarium_earning_set;
            //                 $refferalCommission = $refferalAmount * ($set / 100);
            //                 $refferalPerAmt =  $refferalCommission;
            //                 $reAmount = ($s->referral_id == $refferer->id) ? $refferalAmount : $refferalPerAmt;
            //                 // nearest introducer will not get penalty
            //             }
            //             else
            //             {
            //                 $refferalCommission = 0;
            //                 $refferalPerAmt =  $refferalCommission;
            //                 $reAmount = ($s->referral_id == $refferer->id) ? $refferalAmount : $refferalPerAmt;
            //                 // nearest introducer will not get penalty

            //             }


            //             $shr = new SubscriberHonorarium;
            //             $shr->workstation_id = $s->work_station_id;
            //             $shr->subscriber_id = $refferer->id;
            //             $shr->user_id = $refferer->user_id;
            //             $shr->system_type = 'Joining';
            //             $shr->earning_type = 'Refferal';
            //             $shr->commission =  $reAmount; //in percent
            //             $shr->amount =  $reAmount;
            //             $shr->delivered_to = 'subscriber';
            //             $shr->completed = 1;
            //             $shr->addedby_id = Auth::id();
            //             if($reAmount > 0)
            //             {
            //                 $shr->save();
            //             }

            //             // bt will be here
            //             $bt = new BalanceTransaction;
            //             $bt->subscriber_id = $refferer->id;
            //             $bt->from = 'admin';
            //             $bt->to = 'subscriber';
            //             $bt->purpose = 'honorarium';
            //             $bt->user_id = $refferer->user_id;
            //             $bt->previous_balance = $refferer->balance;  // admin joining_reward balance
            //             $bt->moved_balance =  $reAmount; // rewardAmount
            //             $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // admin new reward balance
            //             $bt->type = 'refferal_reward';

            //             $bt->details = "{$reAmount} tk refferal reward honorarium balance  added to subscriber {$refferer->subscription_code} balance purpose of {$sub->subscription_code}. (aoc:298)";


            //             $bt->addedby_id = Auth::id();
            //             if($reAmount > 0)
            //             {
            //                 $bt->save();
            //             }

            //             $refferer->balance = $refferer->balance + $reAmount;
            //             $refferer->save();

            //             $refferalAmount = $refferalAmount * (10/100);
            //             $sub = $refferer;


            //         }
            //     }
            // }
            // //loop-logic end

        } else {
            $refferer = $s;
            $refferalComm = Honorarium::where('workstation_id', $s->work_station_id)
                ->where('active', 1)
                ->where('system_type', 'Joining')
                ->where('earning_type', 'Refferal')
                ->sum('commission');
            $refferalAmount = $refferalComm; //commmission * (joining fee /100)
            //10tk
            // $adminRefTransferBalance = $refferalComm;

            //for referer subscriber_honorarium  row will be created here for refferal commission
            $shr = new SubscriberHonorarium;
            $shr->workstation_id = $s->work_station_id;
            $shr->subscriber_id = $refferer->id;
            $shr->user_id = $refferer->user_id;
            $shr->system_type = 'Joining';
            $shr->earning_type = 'Refferal';
            $shr->commission = $refferalComm; //in percent
            $shr->amount = $refferalAmount;
            $shr->delivered_to = 'subscriber';
            $shr->completed = 1;
            $shr->addedby_id = Auth::id();
            $shr->save();

            // bt will be here
            $bt = new BalanceTransaction;
            $bt->subscriber_id = $refferer->id;
            $bt->from = 'admin';
            $bt->to = 'subscriber';
            $bt->purpose = 'honorarium';
            $bt->user_id = $refferer->user_id;
            $bt->previous_balance = $refferer->balance;  // admin joining_reward balance
            $bt->moved_balance = $refferalAmount; // rewardAmount
            $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // admin new reward balance
            $bt->type = 'refferal_reward';
            $bt->details = "{$refferalAmount} tk refferal reward honorarium added to subscriber {$refferer->subscription_code} balance. (aoc:356)";

            $bt->addedby_id = Auth::id();
            $bt->save();

            $refferer->balance = $bt->new_balance;
            $refferer->save();
        }

        // $adminLast = $adminLast - $adminRefTransferBalance;
        //68 tk
        // $admin_balance = $this->updateAdBalance($adminRefTransferBalance,$s->work_station_id,'joining_referal');

        // joining_referal commission will be here

        // //for pair commission

        // $pairComm = Honorarium::where('workstation_id',$s->work_station_id)
        //     ->where('active',1)
        //     ->where('system_type','Joining')
        //     ->where('earning_type','Pair')
        //     ->sum('commission');
        // $pairAmount = $pairComm; //commmission * (joining fee /100)
        //     //10tk
        // $j = $s->ws_position;
        // $k = $j;
        // // $adminPairTransferBalance = 0;
        // for($j = $s->ws_position; $j > 0; $j--)
        // {

        //     if($k % 2 == 0)
        //     {

        //         break;
        //     }
        //     else
        //     {


        //         if($j != $k)
        //         {

        //             continue;
        //         }
        //         else
        //         {

        //             $id = (int) ($k / 2);

        //             //id will be credited;
        //             $topSubscriber = Subscriber::where('ws_position', $id)
        //             ->where('work_station_id', $s->work_station_id)
        //             ->first();
        //             if($topSubscriber)
        //             {
        //                 if($pairAmount == 0)
        //                 {
        //                     break;
        //                 }
        //                 // $adminBalance->joining = $adminBalance->joining - $pairAmount;
        //                 // $adminPairTransferBalance = $adminPairTransferBalance + $pairAmount;
        //                 //70tk

        //                 //for topSubscriber subscriber_honorarium  row will be created here for refferal commission

        //                 if($rUser = $topSubscriber->user)
        //                 {
        //                     $set = $rUser->honorarium_earning_set;
        //                     $pairCommission = $pairComm * ($set / 100);
        //                     $pairPerAmt =  $pairCommission;
        //                 }
        //                 else
        //                 {
        //                     $pairCommission = 0;
        //                     $pairPerAmt =  $pairCommission;
        //                 }


        //                 $sht = new SubscriberHonorarium;
        //                 $sht->workstation_id = $s->work_station_id;
        //                 $sht->subscriber_id = $topSubscriber->id;
        //                 $sht->user_id = $topSubscriber->user_id;
        //                 $sht->system_type = 'Joining';
        //                 $sht->earning_type = 'Pair';
        //                 $sht->commission = $pairCommission; //in percent
        //                 $sht->amount = $pairPerAmt;
        //                 $sht->delivered_to = 'subscriber';
        //                 $sht->completed = 1;
        //                 $sht->addedby_id = Auth::id();
        //                 if($pairPerAmt > 0)
        //                 {
        //                     $sht->save();
        //                 }

        //                 // bt will be here
        //                 $prvBalance = $topSubscriber->balance;
        //                 $bt = new BalanceTransaction;
        //                 $bt->subscriber_id = $topSubscriber->id;
        //                 $bt->from = 'admin';
        //                 $bt->to = 'subscriber';
        //                 $bt->purpose = 'honorarium';
        //                 $bt->user_id = $topSubscriber->user_id;
        //                 $bt->previous_balance = $topSubscriber->balance;  // admin joining_reward balance
        //                 $bt->moved_balance = $pairPerAmt; // rewardAmount
        //                 $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // admin new reward balance
        //                 $bt->type = 'pair';
        //                 $bt->details = "{$pairPerAmt} tk pair honorarium added to subscriber {$topSubscriber->subscription_code} balance.";

        //                 $bt->addedby_id = Auth::id();
        //                 if($pairPerAmt > 0)
        //                 {
        //                     $bt->save();
        //                 }

        //                 // $topSubscriber->balance = $bt->new_balance;
        //                 $topSubscriber->balance = $prvBalance + $pairPerAmt;
        //                 $topSubscriber->save();

        //                 $k = $id;


        //                 // $pairAmount = $pairAmount * (10/100);

        //             }

        //         }

        //     }
        // }
        // admin balance
        // $adminLast = $adminLast - $adminPairTransferBalance;

        // $admin_balance = $this->updateAdBalance($adminPairTransferBalance,$s->work_station_id,'joining_pair');

        // $adminBalance->save();
        // $admin_balance = $this->updateAdBalance($adminLast,$s->work_station_id,'joining');

        // if($user->subscriptions()->count() <= 1)
        // {
        //     $user->welcomeSmsSend();
        // }

        return back()->with('success', 'Payment Successfully Done!');
    }

    // public function updateAdBalance($amount, $workstation_id ,$type)
    // {
    //     AdminBalance::where('work_station_id',$workstation_id)->where('type',$type)->where('last',true)->update([
    //         'last' => 0
    //     ]);

    //     $adminBalance = AdminBalance::where('work_station_id',$workstation_id)->where('type',$type)->orderBy('id','desc')->first();

    //     if($adminBalance)
    //     {
    //         $previousB = $adminBalance->new_balance;
    //     }
    //     else
    //     {
    //         $previousB = 0;
    //     }

    //     $ab = new AdminBalance;

    //     $ab->work_station_id = $workstation_id;
    //     $ab->previous_balance = $previousB;
    //     $ab->transfer_balance = $amount;
    //     $ab->new_balance = $ab->previous_balance + $ab->transfer_balance;
    //     $ab->type = $type;
    //     $ab->last = true;
    //     $ab->save();
    // }

    public function paymentDelete(SubcriberPayment $payment)
    {

        if ($payment->status == 'paid') {
            return back()->with('error', 'Someting Went To Wrong!');
        } else {
            $payment->delete();
            return back()->with('warning', 'Payment Delete Successfully.');
        }
    }

    public function jobPostOrder()
    {
        menuSubmenu('balance', 'jobPostOrder');

        $orders = Order::where('order_for', 'job_post')->orderBy('id', 'desc')->orderBy('order_status', 'asc')->paginate(50);

        return view('admin.jobPostOrder.ordersAll', [
            'orders' => $orders
        ]);
    }

    public function balanceOrdersAll()
    {
        if (!Auth::user()->hasPermission('balance')) {
            abort(401);
        }

        menuSubmenu('balance', 'pendingOrder');

        $orders = Order::where('order_for', 'deposit')
            ->where('order_status', '<>', 'temp')
            ->orderBy('id', 'desc')
            ->orderBy('order_status', 'asc')
            ->paginate(50);
        // dd($orders);
        return view('admin.balanceOrder.ordersAll', [
            'orders' => $orders,

        ]);
    }
    public function withdrawListAll(Request $request)
    {

        if (!Auth::user()->hasPermission('withdraw')) {
            abort(401);
        }
        // return WithdrawalList::all();
        menuSubmenu('withdrowList', 'withdrowList');
        $withdraw_lists = WithdrawalList::orderByRaw("FIELD(status , 'pending', 'paid', 'declined') ASC")->orderBy('created_at', 'desc')->paginate(50);
        // dd($withdraw_lists);
        return view('admin.balanceOrder.withdrawlist', [
            'orders' => $withdraw_lists,

        ]);
    }
    public function withdrawDecline(Request $request)
    {

        $wl = WithdrawalList::find($request->withdraw);
        if (!$wl) {
            return back();
        }
        $request->validate([
            'details' => 'required'
        ]);
        $orderOwner = User::where('id', $wl->user_id)->first();
        if (!$orderOwner) {
            return back();
        }
        $wl->status = 'declined';
        $wl->save();

        //Withdraw Dicline Charge Start
        $details= "Return {$wl->withdraw_charge} Taka for declined Charge";
        $bt = new BalanceTransaction;
        $bt->subscriber_id = null;
        $bt->from = 'admin';
        $bt->to = 'user';
        $bt->purpose = 'withdraw_charge_declined';
        $bt->user_id = $orderOwner->id;
        $bt->previous_balance = $orderOwner->balance;  // admin joining_reward balance
        $bt->moved_balance = $wl->withdraw_charge; // rewardAmount
        $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // admin new reward balance
        $bt->type = 'withdraw_declined';
        $bt->details = $details;
        $bt->addedby_id = Auth::id();
        $bt->save();
        
        $orderOwner->increment('balance', $bt->moved_balance);
        //Withdraw Dicline Charge End

        //Withdraw Dicline Amount Return Start
        $bt = new BalanceTransaction;
        // $bt->subscriber_id = $orderOwner->subscriptions->first()->id;
        $bt->subscriber_id = null;
        $bt->from = 'user';
        $bt->to = 'user';
        $bt->purpose = 'withdraw_declined';
        $bt->user_id = $orderOwner->id;
        $bt->previous_balance = $orderOwner->balance;  // admin joining_reward balance
        $bt->moved_balance = $wl->amount; // charged Amount
        $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // admin new reward balance
        $bt->type = 'withdraw_declined';
        $bt->details = $request->details;
        $bt->addedby_id = Auth::id();
        $bt->save();
        $orderOwner->increment('balance', $bt->moved_balance);
        //Withdraw Dicline Amount Return Start

        return redirect()->back()->with('success', 'Order Successfuly Declined');
    }
    public function withdrawListpost(Request $request)
    {
        $withdraw_num = WithdrawalList::where('id', $request->withdraw_id)->first();


        $me = User::where('id', $request->user_id)->first();
        if ($withdraw_num->withdraw_type == 'mobile_recharge') {

            if ($request->paid_type == "manual") {
                $withdraw_num->update([
                    'paid_type' => "manual",
                    'paid_from_number' => $request->paid_from_number,
                    'status' => "paid",
                    'editedby_id' => Auth::id()
                ]);
                $ms = "Successfully TK {$withdraw_num->amount} recharged in {$withdraw_num->mobile_number} From {$request->paid_from_number} Number. Thank you for using softcode mobile recharge solution.";
                $notification1=new OrderNotifications;
                $notification1->type='withdraw';
                $notification1->title='Mobile Recharge';
                $notification1->messages= $ms;
                $notification1->details= $ms;
                $notification1->user_id= Auth::id();
                $notification1->status='1';
                $notification1->date=now();
                $notification1->link=$withdraw_num->id;
                $notification1->save();
            
                return back()->with('success', $ms);
            }

            if ($request->paid_type == "online") {
                return "Online Recharge";
                die;
                $result = $me->mobileRecharge($withdraw_num->mobile_number, $withdraw_num->amount, $withdraw_num->recharge_type);
                if ($result == 'Success') {
                    $success = 1;
                } else {
                    $check = $me->mobileRechargeCheck($withdraw_num->mobile_number, $withdraw_num->amount, $withdraw_num->recharge_type);
                    if ($check == 'Success') {
                        $success = 1;
                    } else {
                        $success = 0;
                    }
                    $success = 0;
                }
                if ($success) {
                    $details = "Mobile Recharge request for Number {$withdraw_num->mobile_number} amount tk {$withdraw_num->amount} received, type {$withdraw_num->recharge_type}";
                    $oldBalance = $me->balance;
                    $me->balance = $oldBalance - $withdraw_num->amount;
                    $me->save();
                    $newBalance = $me->balance;

                    $ms = "Successfully TK {$withdraw_num->amount} recharged in {$withdraw_num->mobile_number}. Thank you for using softcode mobile recharge solution.";
                    $notification1=new OrderNotifications;
                    $notification1->type='withdraw';
                    $notification1->title='Mobile Recharge';
                    $notification1->messages= $ms;
                    $notification1->details= $ms;
                    $notification1->user_id= Auth::id();
                    $notification1->status='1';
                    $notification1->date=now();
                    $notification1->link=$withdraw_num->id;
                    $notification1->save();
                } else {
                    return "Something Worng";
                }
            }
        }
        if ($withdraw_num->withdraw_type == 'online_banking') {
            if ($request->paid_type == "manual") {
                // return "Manual";
                $withdraw_num->update([
                    'paid_type' => "online",
                    'paid_from_number' => $request->paid_from_number,
                    'status' => "paid",
                    'editedby_id' => Auth::id()
                ]);
                $ms = "Successfully TK {$withdraw_num->amount} {$withdraw_num->service_type} CashIn {$withdraw_num->mobile_number} From {$request->paid_from_number} Number. Thank you for using softcode payment solution.";

                $notification1=new OrderNotifications;
                $notification1->type='withdraw';
                $notification1->title='Payment Request';
                $notification1->messages= $ms;
                $notification1->details= $ms;
                $notification1->user_id= Auth::id();
                $notification1->status='1';
                $notification1->date=now();
                $notification1->link=$withdraw_num->id;
                $notification1->save();

                return back()->with('success', $ms);
            }
            if ($request->paid_type == "online") {
                return "Online Payment";
            }
        }
        if ($withdraw_num->withdraw_type == 'bank_account') {
            $withdraw_num->paid_from_number = $request->paid_from_number;
            $withdraw_num->status = 'paid';
            $withdraw_num->editedby_id = Auth::id();
            $withdraw_num->save();

            $ms = "Successfully TK {$withdraw_num->amount} {$withdraw_num->service_type} CashIn {$withdraw_num->mobile_number}. Thank you for using softcode payment solution.";

                $notification1=new OrderNotifications;
                $notification1->type='withdraw';
                $notification1->title='Payment Request';
                $notification1->messages= $ms;
                $notification1->details= $ms;
                $notification1->user_id= Auth::id();
                $notification1->status='1';
                $notification1->date=now();
                $notification1->link=$withdraw_num->id;
                $notification1->save();

            return back()->with('success', 'Paid Successfully');
        }
        return back();


    }



    public function balanceApprovedOrder(Order $order)
    {
        if (!Auth::user()->hasPermission('balance')) {
            abort(401);
        }
        // dd($order);

        // $previous = Order::where('user_id',$order->user_id)->where('order_status','pending')->first();
        // dd($previous);
        // if($previous)
        // {
        //     return back()->with('error','Somting went to wrong');
        // }

        $order->order_status = 'delivered';
        $order->payment_status = 'paid';
        $order->delivered_at = Carbon::now();

        $order->save();

        $orderPayment = OrderPayment::where('order_id', $order->id)->first();

        // $orderPayment = $order->orderPayment;
        $orderPayment->payment_status = 'completed';

        $orderPayment->save();

        $user = $order->user;
        $oldBalance = $user->balance;
        $newBalance = $user->balance + $order->paid_amount;

        $bt =  new BalanceTransaction;
        $bt->user_id = $order->user_id;
        $bt->subscriber_id = $order->subscriber_id;
        $bt->from = "user";
        $bt->to = "user";
        $bt->purpose = "deposit";
        $bt->previous_balance = $oldBalance;
        $bt->new_balance = $order->paid_amount;
        $bt->moved_balance = $order->paid_amount;
        $bt->new_balance = $newBalance;

        $bt->details = "order #{$order->id} for deposit to my balance.";
        $bt->type = 'order';

        $bt->type_id = $order->id;

        $bt->addedby_id = Auth::id();
        $bt->save();

        $user->balance = $newBalance;
        $user->save();

        // $ab = AdminBalance::first();

        // $ab->deposit = $ab->deposit + $order->paid_amount;
        // $ab->save();
        // $admin_balance = $this->updateAdBalance($order->paid_amount,null,'diposit');

        return back()->with('success', 'Order Successfully Approved.');
    }

    public function balanceOrderDelete(Order $order)
    {
        // dd(1);
        if ($order->order_status == 'pending') {
            $orderPayment = OrderPayment::where('order_id', $order->id)->first();

            if ($orderPayment) {
                $orderPayment->delete();
            }
            $order->delete();
            return back()->with('success', 'Order Delete Successfully');
        }

        return back()->with('error', 'Order Status not pending');
    }
    public function subscriptionAllPostpaidAccount(Request $request)
    {
        $user = User::find($request->user);
        if (!$user) {
            return back();
        }
        $haveSubscription = Category::whereDoesntHave('subscription', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        if (count($haveSubscription) == 0) {
            return redirect()->back()->with('warning', 'You have already Account in all Categories');
        }
        foreach ($haveSubscription as $key => $category) {
            $workstation = WorkStation::find($category->work_station_id);

            $me = Auth::user();
            $cookieReffer_id = null;

            if (!$me->subscriptions()->count()) {
                $rvd = $me->verifiedDatas()->first();
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

                if ($sf = $me->isWSSubscription($workstation)) {

                    $reffer_id = $sf->id;
                    $workstationId = $workstation->id;
                } else {
                    $reffer_id = null;
                    // $reffer_id = $workstation->id + 15;
                    $workstationId = $workstation->id;
                }
            }

            $prRow = Subscriber::where('work_station_id', $workstationId)->orderBy('ws_position', 'desc')->first();

            $dis = $me->subscriptionDistrict()->id;
            if (strlen($dis) < 2) {
                $dis = '0' . $dis;
            }

            $wsId = $workstationId;
            if (strlen($wsId) < 2) {
                $wsId = '0' . $wsId;
            }

            $meMob = $me->mobile ?: '00';
            if (strlen($meMob) > 2) {
                // $meMob = last 2 digit;
                $meMob = substr($meMob, -2);
            }

            $num = 100000000;
            $ws_pos = $prRow->ws_position + 1;
            $num = $num + $ws_pos;
            $scode = $wsId . $num . $meMob . $me->subscriptionDistrict()->id;

            $s = new Subscriber;
            $s->ws_position = $ws_pos;
            $s->name = $me->name;
            $s->email = $me->email;
            $s->mobile = $me->mobile;
            $s->category_id = $category->id;
            $s->district_id = $me->subscriptionDistrict()->id;
            $s->user_id = $me->id;
            $s->referral_id = $reffer_id;
            $s->work_station_id = $workstationId;
            $s->subscription_code = $scode;
            $s->addedby_id = Auth::id();
            $s->free_account = 1;
            $s->save();
        }
        $payment = SubcriberPayment::where('id', $request->payment)->first();
        $payment->delete();
        return redirect()->back()->with('success', 'Postpaid Accounts Created Successfully');
    }

    public function LastWithdrawlastbalancetransactionDetails(Request $request)
    {
        $user=User::where('id',$request->id)->first();
        $details = BalanceTransaction::whereIn('to',['user','subscriber'])
            ->whereIn('purpose',['honorarium','move_to_wallet','deposit','work_done'])
            ->where('user_id', $request->id)
            ->latest()->take(10)->get();

        $amount=$request->amount;

        $detailsamount=$details->sum('moved_balance');


            return view('admin.balanceOrder.lastbalancetransationdetails', [
                'details' => $details,
                'user' => $user,
                'amount' => $amount,
                'detailsamount' => $detailsamount
    
            ]);
    }
}
