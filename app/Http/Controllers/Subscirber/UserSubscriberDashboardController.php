<?php

namespace App\Http\Controllers\Subscirber;

use Auth;
use Validator;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\JobCategory;
use App\Models\FreelanceJobWork;
use App\Models\Media;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\Subscriber;
use App\Models\FreelancerJob;
use App\Models\WorkStation;
use App\Models\SubcriberPayment;
use App\Models\Subcategory;
use App\Models\AdminBalance;
use App\Models\Honorarium;
use App\Models\SubscriberHonorarium;
use App\Models\BalanceTransaction;
use App\Models\JobSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserSubscriberDashboardController extends Controller
{
    public function subscriptionDashboard()
    {
        $request = request();
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        
        if(!$subscription)
        {
            abort(404);
        }

        //////////////////////////// cronjob start /////////////////

        // one time only start

        // $jobs = FreelancerJob::where('work_done', '<', 1)->get();

        // foreach($jobs as $job)
        // {
        //     $job->work_done = $job->worksCountWithoutReject();
        //     $job->save();
        // }
        //end


        // $comJob = FreelancerJob::where(function($qq){
        //     $qq->where('status', null);
        //     $qq->orWhere('status', 'completed');
        // })->whereRaw('total_worker <= freelancer_jobs.work_done')->first();

        // $wrks = $comJob->works()->where('status', '<>','rejected')->take($comJob->total_worker)->get();
        // $comp = 0;
        // foreach($wrks as $work)
        // {
        //     if($work->status == 'pending')
        //     {
        //         AdminBalance::where('work_station_id',$work->work_station_id)->where('type','work_done')->where('last',true)->update([
        //             'last' => 0
        //         ]);

        //         $adminBalance = AdminBalance::where('work_station_id',$work->work_station_id)->where('type','work_done')->orderBy('id','desc')->first();

        //         if($adminBalance)
        //         {
        //             $previousB = $adminBalance->new_balance;
        //         }
        //         else
        //         {
        //             $previousB = 0;
        //         }

        //         $ab = new AdminBalance;

        //         $ab->work_station_id = $work->work_station_id;
        //         $ab->previous_balance = $previousB;
        //         $ab->transfer_balance = $comJob->job_work_price;
        //         $ab->new_balance = $ab->previous_balance - $ab->transfer_balance;
        //         $ab->type = 'work_done';
        //         $ab->last = true;
        //         $ab->save();

        //         // worker balance added
        //         $subscriberWorker = $work->subscriber;
        //         $sOldbalance = $subscriberWorker->balance;
        //         $sNewBalance = $subscriberWorker->balance + $comJob->job_work_price ;
        //         $subscriberWorker->balance =   $sNewBalance;
        //         $subscriberWorker->save();

        //         //balance transfer created for work done

        //         $bt = new BalanceTransaction;
        //         $bt->subscriber_id = $work->subscriber_id;
        //         $bt->from = 'admin';
        //         $bt->to = 'subscriber';
        //         $bt->purpose = 'work_done';
        //         $bt->user_id = $work->user_id;
        //         $bt->previous_balance = $sOldbalance;

        //         $bt->moved_balance = $comJob->job_work_price; // work price
        //         $bt->new_balance = $sNewBalance ;
        //         $bt->type = 'work_done';
        //         $bt->details = "balance {$comJob->job_work_price} TK transfer to subscriber for work approved.";

        //         $bt->addedby_id = $work->user_id;
        //         $bt->save();
        //     }

        //     $comp++;
        // }

        //     if($comp == $comJob->total_worker)
        //     {
        //         $comJob->status = 'full_paid';
        //     }


        //     $comJob->works()->where('status', '<>', 'approved')->delete();
        //     $comJob->work_done = $comJob->worksCountWithoutReject();
        //     $comJob->save();
        //////////////////////////// cronjob end /////////////////

        if($subscription->free_account)
        {
            if($subscription->balance >= 100)
            {
                $oldBalance = $subscription->balance;
                $movedBalance = 100;
                $newBalance = $subscription->balance - $movedBalance;

                $subscription->balance = $newBalance;
                $subscription->free_account = 0;
                $subscription->save();

                //balance transfer  created here for 100 tk deduction
                $bt = new BalanceTransaction;
                $bt->subscriber_id = $subscription->id;
                $bt->from = 'subscriber';
                $bt->to = 'admin';
                $bt->purpose = 'upgrade_postpaid_account';
                $bt->user_id = $subscription->user_id;
                $bt->previous_balance = $oldBalance;  // user old balance
                $bt->moved_balance = $movedBalance; // job cost
                $bt->new_balance = $newBalance; // user new balance (uob-jobcost)
                $bt->type = 'order';
                $bt->details = "{$movedBalance} TK deducted from subscriber balance for upgrade postpaid account. usdc:155";
                $bt->type_id = null;
                $bt->addedby_id = Auth::id();
                $bt->save();


            $s = $subscription;
                //for signup commission
            $honorariumComm = Honorarium::where('workstation_id',$s->work_station_id)
            ->where('active',1)
            ->where('system_type','Joining')
            ->where('earning_type','Signup')
            ->sum('commission');
            $joining_signup_commission = $honorariumComm; //commmission * (joining fee /100)
            //10tk

            //bt will be here

            $bt = new BalanceTransaction;
            $bt->subscriber_id = $s->id;
            $bt->from = 'admin';
            $bt->to = 'subscriber';
            $bt->purpose = 'honorarium';
            $bt->user_id = $s->user_id;
            $bt->previous_balance = $s->balance ?: 0;  // user balance
            $bt->moved_balance =  $joining_signup_commission; // subscriber balance
            $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // user new balance
            $bt->type = 'joining_bonus';
            $bt->details = "{$joining_signup_commission} tk joining honorarium balance added to subscriber {$s->subscription_code} balance. usdc:183";

            $bt->addedby_id = Auth::id();
            $bt->save();

            //for joining comm to subscriber
            $s->balance = $bt->new_balance;
            //10tk
            $s->save();

            if($s->referral_id)
                {
                    $refferalComm = Honorarium::where('workstation_id',$s->work_station_id)
                    ->where('active',1)
                    ->where('system_type','Joining')
                    ->where('earning_type','Refferal')
                    ->sum('commission');
                    $refferalAmount = $refferalComm; //commmission * (joining fee /100)
                    //10tk

                    $sub = $s;
                    // $n = $sub->ws_position - 1;
                    // $i = $n;

                    //loop-failure code start
                    // $refferer = Subscriber::where('ws_position', $i)
                    //     ->where('work_station_id', $sub->work_station_id)
                    //     ->first();

                    $refferer = $s->referrer;
                    if($refferer)
                    {

                        if($rUser = $refferer->user)
                        {
                            $set = $rUser->honorarium_earning_set;
                            $refferalCommission = $refferalAmount * ($set / 100);
                            $refferalPerAmt =  $refferalCommission;
                            $reAmount = ($s->referral_id == $refferer->id) ? $refferalAmount : $refferalPerAmt;
                            // nearest introducer will not get penalty
                        }
                        else
                        {
                            $refferalCommission = 0;
                            $refferalPerAmt =  $refferalCommission;
                            $reAmount = ($s->referral_id == $refferer->id) ? $refferalAmount : $refferalPerAmt;
                            // nearest introducer will not get penalty

                        }


                        //for referer subscriber_honorarium  row will be created here for refferal commission
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
                        if($reAmount > 0)
                        {$shr->save();}


                        // bt will be here
                        $refPreBalance = $refferer->balance;
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
                        $bt->details = "{$reAmount} tk refferal reward honorarium balance added to subscriber {$refferer->subscription_code} balance  purpose of {$sub->subscription_code}. ( usdc:262)";

                        $bt->addedby_id = Auth::id();
                        // if( $reAmount > 0)
                        // {$bt->save();}

                        $bt->save();

                        // $refferer->balance = $bt->new_balance;
                        $refferer->balance = $refPreBalance + $reAmount;
                        $refferer->save();

                    }
                }
                else
                {
                    $refferer = $s;
                    $refferalComm = Honorarium::where('workstation_id',$s->work_station_id)
                    ->where('active',1)
                    ->where('system_type','Joining')
                    ->where('earning_type','Refferal')
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
                    $bt->details = "{$refferalAmount} tk refferal reward honorarium added to subscriber {$refferer->subscription_code} balance. (drct: usdc:313)";


                    $bt->addedby_id = Auth::id();
                    $bt->save();

                    $refferer->balance = $bt->new_balance;
                    $refferer->save();

                }


            }
        }



        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'subscriber','lsbsm'=>'subscriber']);
        $user = Auth::user();
        $workstation = $subscription->workStation->first();

        if($user->created_at < '2021-08-22 10:34:15')
        {
            return  view('subscriber.dashboard',[
                'user' => $user,
                'subscription' => $subscription,
                'workstation' => $workstation,
            ]);
        }
        elseif(($user->sc_fb_group_link_image !=null) and ($user->sc_youtube_channel_link_image !=null))
        {
            return  view('subscriber.dashboard',[
                'user' => $user,
                'subscription' => $subscription,
                'workstation' => $workstation,
            ]);
        }
        else
        {
            return redirect()->route('user.userEdit')->with('warning','Please join in facebook group, youtube channel & give the link here.');
            // return redirect()->route('user.userEdit')->with('warning','Please join in facebook group, youtube channel & give the link here.');
        }


    }

    public function updateubscriptionPaid()
    {
        $request = request();
        $cat=$request->cat;
        $subscription = Subscriber::where('user_id', Auth::id())->where('subscription_code', $request->subscription)->first();
        // dd($subscription);
        if(!$subscription)
        {
            abort(404);
        }
        if($subscription->free_account == 0)
        {
            return back()->with('warning', 'Sorry, your account already standard account');
        }
        $category = Category::find($cat);

        $fee = 100 - $subscription->balance; //60
        if($fee > Auth::user()->balance)
        {
            return back()->with('warning', 'Sorry, You have no available balace in your tenant wallet for upgrade your subscription account');
        }
        // dd($cat);
        if($category)
        {
            return view('subscriber.updateubscriptionPaid',['cat'=>$category,'subscription'=>$subscription]);
        }
        else
        {
            abort(404);
        }
    }


    public function updateSubscriptionOldAccount()
    {
        $request = request();
        $cat = $request->cat;
        $sub = $request->subscription;
        $category = Category::find($cat);
        // dd($request->all());
        $workstation = Workstation::find($category->work_station_id);

        $me = Auth::user();

        $s = Subscriber::where('subscription_code',$sub)
        ->where('subscription_code', '<>', null)
        ->where('user_id', Auth::id())
        ->where('work_station_id',$workstation->id)
        ->first();

        $fee = 0;
        if($s)
        {
            $fee = 100 - $s->balance; //60
            if($fee > Auth::user()->balance)
            {
                return back()->with('warning', 'Sorry, You have no available balace in your tenant wallet for upgrade your subscription account');
            }

            if($fee <= 0)
            {
                return back()->with('warning', 'Sorry, something went wrong');
            }
        }
        else
        {
            return back()->with('error','Someting went to wrong.');
        }

        //new subscription by balance
        if($me->balance > $fee)
        {
            $workstationId = $s->work_station_id;
            $reffer_id = $s->referral_id ?: $s->id;

            $s->free_account = 0;
            $s->balance = 0;
            $s->save();

            $payment = new SubcriberPayment;
            $payment->user_id = $me->id;
            $payment->work_station_id = $workstation->id;
            $payment->amount = $fee;
            $payment->refer_id = $reffer_id;
            $payment->district_id = $me->subscriptionDistrict()->id;
            $payment->transaction_no = $request->transection ?: null;
            $payment->sender_no = null;
            $payment->receiver_no = null;
            $payment->status = 'paid';
            $payment->save();
            $payment->paidby_id = Auth::id();

            //my balance reduce
            $me->balance = $me->balance - $fee;
            $me->save();

            $bt = new BalanceTransaction;
            // $bt->subscriber_id = $subscription->id;
            $bt->from = 'tenant';
            $bt->to = 'admin';
            $bt->purpose = 'upgrade_account';
            $bt->user_id = $me->id;
            $bt->previous_balance = $me->balance + $fee;  // user old balance
            $bt->moved_balance = $fee; //  cost
            $bt->new_balance = $me->balance; // user new balance
            $bt->type = 'upgrade_account';
            $bt->details = "To upgrade account (pf-{$s->subscription_code}) subscriber of (T-{$s->user_id}) tenant, {$bt->moved_balance} TK deducted from tenant balance for subscription order. Payment id is {$payment->id}. usdc:466";
            $bt->type_id = $payment->id;
            $bt->addedby_id = Auth::id();
            $bt->save();

            $btt = new BalanceTransaction;
            // $bt->subscriber_id = $subscription->id;
            $btt->from = 'subscriber';
            $btt->to = 'admin';
            $btt->purpose = 'upgrade_account';
            $btt->user_id = $me->id;
            $btt->previous_balance = 100 - $fee;  // user old balance
            $btt->moved_balance = 100 - $fee; //  cost
            $btt->new_balance = 0; // user new balance
            $btt->type = 'upgrade_account';
            $btt->details = "To upgrade account (pf-{$s->subscription_code}) subscriber of (T-{$s->user_id}) tenant, {$btt->moved_balance} TK deducted from this subscription account for subscription order. Payment id is {$payment->id}. usdc:481";
            $btt->type_id = $payment->id;
            $btt->addedby_id = Auth::id();
            $btt->save();

            //refer balance add

            //for signup commission
            $honorariumComm = Honorarium::where('workstation_id',$s->work_station_id)
            ->where('active',1)
            ->where('system_type','Joining')
            ->where('earning_type','Signup')
            ->sum('commission');
            $joining_signup_commission = $honorariumComm; //commmission * (joining fee /100)
            //10tk

            //bt will be here

            $bt = new BalanceTransaction;
            $bt->subscriber_id = $s->id;
            $bt->from = 'admin';
            $bt->to = 'subscriber';
            $bt->purpose = 'honorarium';
            $bt->user_id = $s->user_id;
            $bt->previous_balance = $s->balance ?: 0;  // user balance
            $bt->moved_balance =  $joining_signup_commission; // subscriber balance
            $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // user new balance
            $bt->type = 'joining_bonus';
            $bt->details = "{$joining_signup_commission} tk joining honorarium balance added to subscriber {$s->subscription_code} balance. usdc:509";

            $bt->addedby_id = Auth::id();
            $bt->save();

            //for joining comm to subscriber
            $s->balance = $bt->new_balance;
            //10tk
            $s->save();

            if($s->referral_id)
                {
                    $refferalComm = Honorarium::where('workstation_id',$s->work_station_id)
                    ->where('active',1)
                    ->where('system_type','Joining')
                    ->where('earning_type','Refferal')
                    ->sum('commission');
                    $refferalAmount = $refferalComm; //commmission * (joining fee /100)
                    //10tk

                    $sub = $s;
                    // $n = $sub->ws_position - 1;
                    // $i = $n;

                    //loop-failure code start
                    // $refferer = Subscriber::where('ws_position', $i)
                    //     ->where('work_station_id', $sub->work_station_id)
                    //     ->first();

                    $refferer = $s->referrer;
                    if($refferer)
                    {

                        if($rUser = $refferer->user)
                        {
                            $set = $rUser->honorarium_earning_set;
                            $refferalCommission = $refferalAmount * ($set / 100);
                            $refferalPerAmt =  $refferalCommission;
                            $reAmount = ($s->referral_id == $refferer->id) ? $refferalAmount : $refferalPerAmt;
                            // nearest introducer will not get penalty
                        }
                        else
                        {
                            $refferalCommission = 0;
                            $refferalPerAmt =  $refferalCommission;
                            $reAmount = ($s->referral_id == $refferer->id) ? $refferalAmount : $refferalPerAmt;
                            // nearest introducer will not get penalty

                        }


                        //for referer subscriber_honorarium  row will be created here for refferal commission
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
                        if($reAmount > 0)
                        {$shr->save();}


                        // bt will be here
                        $refPreBalance = $refferer->balance;
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
                        $bt->details = "{$reAmount} tk refferal reward honorarium balance added to subscriber {$refferer->subscription_code} balance  purpose of {$sub->subscription_code}. ( usdc:588)";

                        $bt->addedby_id = Auth::id();
                        // if( $reAmount > 0)
                        // {$bt->save();}

                        $bt->save();

                        // $refferer->balance = $bt->new_balance;
                        $refferer->balance = $refPreBalance + $reAmount;
                        $refferer->save();

                    }
                }
                else
                {
                    $refferer = $s;
                    $refferalComm = Honorarium::where('workstation_id',$s->work_station_id)
                    ->where('active',1)
                    ->where('system_type','Joining')
                    ->where('earning_type','Refferal')
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
                    $bt->details = "{$refferalAmount} tk refferal reward honorarium added to subscriber {$refferer->subscription_code} balance. (drct: usdc:473)";


                    $bt->addedby_id = Auth::id();
                    $bt->save();

                    $refferer->balance = $bt->new_balance;
                    $refferer->save();

                }



            return redirect()->route('user.dashboard')->with('success', 'Your subscribtion account successfully upgraded.');


        }

        else
        {
        return back()->with('info','Sorry,Insufficient tenant balance. Please recharge your balance.');

        }

        return back();
    }

    public function subscriptionPostedJob()
    {
        $request = request();
        menuSubmenu('myjob','mypostedjob');
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        // dd($subscription);
        if(!$subscription)
        {
            abort(404);
        }
        $myPostedJobs = FreelancerJob::where('subscriber_id',$subscription->id)->where('work_station_id',$subscription->work_station_id)->where('user_id',Auth::id())->latest()->paginate(15);

        return view('subscriber.job.subscriptionPostedJob',[
            'subscription' => $subscription,
            'myPostedJobs' => $myPostedJobs
        ]);
    }

    public function subscriptionMyJobWork()
    {
        $request = request();
        menuSubmenu('myjob','myjobwork');
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if(!$subscription)
        {
            abort(404);
        }
        $works = FreelanceJobWork::where('user_id',Auth::id())->where('work_station_id',$subscription->work_station_id)->where('subscriber_id',$subscription->id)->latest()->paginate(20);
        $nowTimeDate = Carbon::now();
        //dd($nowTimeDate);
        return view('subscriber.work.workList',[
            'subscription' => $subscription,
            'works' => $works
        ]);
    }

    public function subscriptionFindJob()
    {
        $request = request();

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if(!$subscription)
        {
            abort(404);
        }
        menuSubmenu('job','job');


        $categories = JobCategory::whereNotIn('id',[20,22,24])->get();
        $subcategories = JobSubcategory::get();

        $jobs = FreelancerJob::where('status',null)->whereNotIn('category_id',[20,22,24])
        ->whereNull('admin_completed_status')
        ->has('user')

        ->whereDoesntHave('works',function($qq) use ($subscription) {
            $qq->where('subscriber_id', $subscription->id);
        })

        ->whereRaw('total_worker > freelancer_jobs.work_done')

        // ->where('updated_at', '<', now()->subMinutes(1))
        ->latest()
        ->paginate(15);

        return view('subscriber.job.job',[
            'categories' => $categories,
            'subcategories' => $subcategories,
            'subscription' => $subscription,
            'jobs' => $jobs
        ]);

    }

    public function subscriptionFindJobsoftcommerce()   
    {
        $request = request();

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if(!$subscription)
        {
            abort(404);
        }
        menuSubmenu('job','job');


        $categories = JobCategory::where('id','20')->first();
        $subcategories = JobSubcategory::all();

        $jobs = FreelancerJob::where('status',null)->where('category_id','20')
        ->whereNull('admin_completed_status')
        ->has('user')

        ->whereDoesntHave('works',function($qq) use ($subscription) {
            $qq->where('subscriber_id', $subscription->id);
        })

        ->whereRaw('total_worker > freelancer_jobs.work_done')

        // ->where('updated_at', '<', now()->subMinutes(1))
        ->latest()
        ->paginate(15);

        return view('subscriber.job.softcommercejob',[
            'categories' => $categories,
            'subcategories' => $subcategories,
            'subscription' => $subscription,
            'jobs' => $jobs
        ]);

    }
    public function subscriptionFindJobsoftcommerceFreelancer()   
    {
        $request = request();

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if(!$subscription)
        {
            abort(404);
        }
        menuSubmenu('job','job');


        $categories = JobCategory::where('id','22')->first();
        $subcategories = JobSubcategory::all();

        $jobs = FreelancerJob::where('status',null)->where('category_id','22')
        ->whereNull('admin_completed_status')
        ->has('user')

        ->whereDoesntHave('works',function($qq) use ($subscription) {
            $qq->where('subscriber_id', $subscription->id);
        })

        ->whereRaw('total_worker > freelancer_jobs.work_done')

        // ->where('updated_at', '<', now()->subMinutes(1))
        ->latest()
        ->paginate(15);

        return view('subscriber.job.softcommercefreelancerjob',[
            'categories' => $categories,
            'subcategories' => $subcategories,
            'subscription' => $subscription,
            'jobs' => $jobs
        ]);

    }

    public function subscriptionFindJobsoftcommerceVendor()   
    {
        $request = request();

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if(!$subscription)
        {
            abort(404);
        }
        menuSubmenu('job','job');


        $categories = JobCategory::where('id','24')->first();
        $subcategories = JobSubcategory::all();

        $jobs = FreelancerJob::where('status',null)
        ->where('is_lock',false)
        ->where('category_id','24')
        ->whereNull('admin_completed_status')
        ->has('user')

        ->whereDoesntHave('works',function($qq) use ($subscription) {
            $qq->where('subscriber_id', $subscription->id);
        })

        ->whereRaw('total_worker > freelancer_jobs.work_done')

        // ->where('updated_at', '<', now()->subMinutes(1))
        ->latest()
        ->paginate(15);

        return view('subscriber.job.softcommercefreelancerjob',[
            'categories' => $categories,
            'subcategories' => $subcategories,
            'subscription' => $subscription,
            'jobs' => $jobs
        ]);

    }


    public function subscriptionJobSearch(Request $request)
    {
        // dd($request->subscription);
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if(!$subscription)
        {
            abort(404);
        }
        menuSubmenu('job','job');
        if($request->category == 22){
             $categories = JobCategory::where('id','22')->get();

        }elseif($request->category == 20){
            $categories = JobCategory::where('id','20')->get();
        }elseif($request->category == 20){
            $categories = JobCategory::where('id','24')->get();
        }else{
            $categories = JobCategory::whereNotIn('id',[20,22,24])->get();

        }

       
        $subcategories = JobSubcategory::get();

        $cat = $request->category;
        $subcat = $request->subcategory;
        $search = $request->q;
        $jobs = FreelancerJob::where('status',null)
        ->where(function($query) use ($search,$subcat)
        {

            if($search)
            {
                $query->where('title','like','%'.$search.'%');
            }
            if($subcat)
            {
                $query->where('subcategory_id',$subcat);
            }

        })
        ->whereDoesntHave('works',function($qq) use ($subscription) {
                $qq->where('subscriber_id', $subscription->id);
            })
        ->whereRaw('total_worker > freelancer_jobs.work_done')
        ->paginate(50);

        return view('subscriber.job.searchjob',[
            'categories' => $categories,
            'subcategories' => $subcategories,
            'subscription' => $subscription,
            'jobs' => $jobs
        ]);
    }

    public function getSubCategoryByCategory(JobCategory $category)
    {
        $subcat = $category->subcategories;
        return $subcat;
    }

    public function getSubCategoryPriceBySubCategory(JobSubcategory $subcategory)
    {
        $price = $subcategory;

        return $price;
    }

    public function getSubCategoryInstractionBySubCategory(JobSubcategory $subcategory)
    {
        $instraction = $subcategory;

        return $instraction;
    }
    public function subscriptionPostJob()
    {
        $request = request();

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if(!$subscription)
        {
            abort(404);
        }
        menuSubmenu('job','postjob');
        $me = Auth::user();
        if($me->is_freelancer==true){
            $categories = JobCategory::get();
        }else{
            $categories = JobCategory::whereNotIn('id',[20,22])->get();
        }
       


        $subcategories = JobSubcategory::get();

        return view('subscriber.job.postjob',[
            'categories' => $categories,
            'subcategories' => $subcategories,
            'subscription' => $subscription
        ]);
    }

    public function subscriptionSpecialPostJob()
    {
        $request = request();

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if(!$subscription)
        {
            abort(404);
        }
        menuSubmenu('job','postjob');
        $me = Auth::user();
       
        $categories = JobCategory::where('id','23')->first();
        $subcategories = JobSubcategory::where('job_category_id','23')->first();
        $date=Carbon::now()->addDays(120)->format('Y-m-d');
       

        return view('subscriber.job.specialpostjob',[
            'category' => $categories,
            'subcategory' => $subcategories,
            'subscription' => $subscription,
            'date' => $date
        ]);
    }

    public function subscriptionNewPostJob(Subscriber $subscription,WorkStation $worksation , Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
            // 'title' => ['required', 'string', 'max:255','min:4'],
            // 'description' => ['required', 'string','min:5'],
            'cost_per_worker' => ['required','numeric'],
            'total_worker' => ['required','numeric'],
            'image' => ['required']
        ]);


        if($validation->fails())
        {

            return back()
            ->withInput()
            ->withErrors($validation);
        }

        // test
        // $workStationIndiComm = Honorarium::where('workstation_id',$subscription->work_station_id)
        //     ->where('active',1)
        //     ->where('system_type','Working')
        //     ->where('earning_type','Work_station_individual')
        //     ->sum('commission');
        // // dd($workStationIndiComm);
        // if($workStationIndiComm > 0)
        // {

        // }
        // endtest--


        $sc = JobSubCategory::find($request->subcategory);
        // dd($sc->job_work_price);

        $totalPrice = ($sc->job_post_price) * ($request->total_worker);

        //dd($request->category);

        // if($request->category != [22,20,24] ){
        //     if($totalPrice != $request->estimate_cost)
        //     {
        //         return back()->with('error','Somting Went To Wrong.');
        //     }

        // }

      

        $me = Auth::user();
        $ad_balance=$me->ad_balance;
        if($request->ad_balance=='ad_balance'){
            if($ad_balance>$totalPrice){
                $me->decrement('ad_balance', $totalPrice);
                $me->increment('balance', $totalPrice);
                $me->save();

            }else{
                return back()->with('error','Sorry,Insufficient Ad Topup balance. Please recharge your balance');
            }
           

        }
        //dd($me);
        

        $cat = JobCategory::findOrFail($sc->job_category_id);
        $title = $cat->title . '>' . $sc->title . '>'. $sc->job_work_price .' Taka';

        $balance = $me->balance;
        if($balance > $request->estimate_cost )
        {
            $job = new FreelancerJob;

            $job->work_station_id = $worksation->id;
            $job->subscriber_id = $subscription->id;
            $job->user_id = Auth::id();
            $job->category_id = $request->category;
            $job->subcategory_id =$request->subcategory;
            // $job->title = $request->title;
            $job->title = $title;
            $job->description = $request->description;
            $job->link = $request->link;
            $job->total_worker = $request->total_worker;
            $job->job_post_price = $request->cost_per_worker;
            $job->job_work_price = $sc->job_work_price;
            $job->total_job_post_cost = $totalPrice;
            $job->total_job_work_cost  = ($job->total_worker) * ($job->job_post_price);
            $job->expired_day = $request->estimate_day ? $request->estimate_day : null;
            $job->commission = ($request->estimate_cost) - (($request->cost_per_worker)*($request->total_worker));
                if($sc->admin_approve == true){
                    $job->status = 'pending';
                }else{
                    $job->status = null;
                }
                $job->addedby_id = Auth::id();

                $job->save();

                if($cp = $request->image){
                        $f = 'media/job/'.$job->img_name;
                        if(Storage::disk('public')->exists($f)){
                            Storage::disk('public')->delete($f);
                            $job->media()->where('collection_name', 'job_image')->delete();
                        }
                        list($width,$height) = getimagesize($cp);
                        $mime = $cp->getClientOriginalExtension();
                        $size =$cp->getSize();

                        $extension = strtolower($cp->getClientOriginalExtension());
                        $originalName = strtolower($cp->getClientOriginalName());
                        $randomFileName = $job->id.'_img_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

                        Storage::disk('public')->put('media/job/'.$randomFileName, File::get($cp));

                        $file_new_url = 'storage/media/job/'.$randomFileName;

                        $media = new Media;
                        $media->file_name  = $randomFileName;
                        $media->file_original_name  = $originalName;
                        $media->file_mime  = $mime;
                        $media->file_ext  = $extension;
                        $media->file_size  = $size;
                        $media->file_type  = 'image';
                        $media->width  = $width;
                        $media->height  = $height;
                        $media->file_url  = $file_new_url;
                        $media->addedby_id  = Auth::id();
                        $media->editedby_id  = null;
                        $media->collection_name  = 'job_image';
                        // $media->disk  = 'public';
                        $job->media()->save($media);

                        $job->img_name = $randomFileName;

                }

                $job->save();

                //user balance decrease
                $oldBalance = $me->balance;
                $newBalance = $oldBalance - $job->total_job_post_cost;
                $me->balance  = $newBalance;
                $me->save();

                $order = new Order;
                $order->work_station_id = $worksation->id;
                $order->subscriber_id = $subscription->id;
                $order->user_id = $me->id;
                $order->name = $me->name;
                $order->mobile = $me->mobile;
                $order->order_for = "job_post";
                $order->order_status = "delivered";
                $order->payment_status = "paid";
                $order->paid_amount = $job->total_job_post_cost;
                $order->addedby_id = Auth::id();
                $order->delivered_at = Carbon::now();
                $order->save();

                $orderItem = new OrderItem;
                $orderItem->order_id = $order->id;
                $orderItem->work_station_id = $order->work_station_id;
                $orderItem->subscriber_id = $order->subscriber_id;
                $orderItem->user_id = $order->user_id;
                $orderItem->order_status = 'delivered';
                $orderItem->itemable_id = $job->id;
                $orderItem->itemable_type  = 'App/Models/FreelancerJob';
                $orderItem->extra_description = null;
                $orderItem->final_price = $order->paid_amount;
                $orderItem->addedby_id = Auth::id();
                $orderItem->delivered_at = Carbon::now();
                $orderItem ->save();

                $orderPayment = new OrderPayment;
                $orderPayment->order_id = $order->id;
                $orderPayment->work_station_id = $order->work_station_id;
                $orderPayment->subscriber_id = $order->subscriber_id;
                $orderPayment->user_id = $order->user_id;
                $orderPayment->trans_date = Carbon::today()->toDateString();
                $orderPayment->payment_by = 'balance';
                $orderPayment->payment_type = null;
                $orderPayment->payment_status = 'completed';
                $orderPayment->bank_name = null;
                $orderPayment->account_number = null;
                $orderPayment->cheque_number = null;
                $orderPayment->note = '';
                $orderPayment->sender = $order->user->mobile;
                $orderPayment->paid_amount = $order->paid_amount;
                $orderPayment->receivedby_id = null;
                $orderPayment->addedby_id = Auth::id();
                $orderPayment->save();

                //balance transfer  created here for admin add balance order fund
                $bt = new BalanceTransaction;
                $bt->subscriber_id = $subscription->id;
                $bt->from = 'subscriber';
                $bt->to = 'admin';
                $bt->purpose = 'job_post';
                $bt->user_id = $subscription->user_id;
                $bt->previous_balance = $oldBalance;  // user old balance
                $bt->moved_balance = $job->total_job_post_cost; // job cost
                $bt->new_balance = $newBalance; // user new balance (uob-jobcost)
                $bt->type = 'order';
                $bt->details = "{$job->total_job_post_cost} TK deducted from subscriber balance for job post.";
                $bt->type_id = $order->id;
                $bt->addedby_id = Auth::id();
                $bt->save();

                // balance added to admin order balance

                // $admin_balance = $this->updateAdBalance($job->total_job_post_cost,$orderPayment->work_station_id,'order_base_payment');

                //total job work price
                // $admin_balance = $this->updateAdBalance($job->total_job_work_cost,$orderPayment->work_station_id,'order_wages_payment');

                // $oma = 0; //order minius amount

                //affiliate commission for job post

                    //for signup commission
                $workorderUptoAmount = Honorarium::where('workstation_id',$subscription->work_station_id)
                ->where('active',1)
                ->where('system_type','Working')
                ->where('earning_type','Affiliate')
                //->where('workorder_upto_amount', '>=', $job->total_job_post_cost)
               // ->orderBy('workorder_upto_amount','asc')
                // ->pluck('workorder_upto_amount');
                ->first();


                //dd($workorderUptoAmount);


                if(!$workorderUptoAmount){
                    if($request->category==22){
                        return back()->with('success','Job Posted In Workstation Successfully.');
                    }else{
                        return back()->with('success','Job Posted In Workstation Successfully.');
                    }
                
                }

                $workorderUptoAmount = $workorderUptoAmount->workorder_upto_amount;

                $honorariumComm = Honorarium::where('workstation_id',$subscription->work_station_id)
                ->where('active',1)
                ->where('system_type','Working')
                ->where('earning_type','Affiliate')
                ->where('workorder_upto_amount',$workorderUptoAmount)
                ->sum('commission');
                $affAmount = $honorariumComm * ($job->total_job_post_cost / 100); //commmission * (job post fee /100)
                if($affAmount > 0){
                    // $ad->order = $ad->order - $affAmount;
                    // $ad->save();

                    // $admin_balance = $this->updateAdBalance($affAmount,$orderPayment->work_station_id,'order_base_payment');

                    // $oma = $affAmount + $oma; // update order amount



                    $subscriberOldBalance = $subscription->balance;
                    $subscriberNewBalance = $subscriberOldBalance + $affAmount;

                    //bt will be here
                    $bt = new BalanceTransaction;
                    $bt->subscriber_id = $subscription->id;
                    $bt->from = 'admin';
                    $bt->to = 'subscriber';
                    $bt->purpose = 'honorarium';
                    $bt->user_id = $subscription->user_id;
                    $bt->previous_balance = $subscriberOldBalance;  // subscriber old balance
                    $bt->moved_balance = $affAmount; // affiliate amount
                    $bt->new_balance = $subscriberNewBalance; // subscriber new balance (uob-jobcost)
                    $bt->type = 'affiliate';
                    $bt->details = "{$affAmount} TK affiliate honorarium added to subscriber balance from admin.";
                    $bt->type_id = $order->id;
                    $bt->addedby_id = Auth::id();
                    $bt->save();

                    //for affiliate comm to subscriber
                    $subscription->balance = $subscription->balance + $affAmount;
                    //10tk
                    $subscription->save();


                    //subscriber_honorarium row will be created here
                    $sh = new SubscriberHonorarium;
                    $sh->workstation_id = $subscription->work_station_id;
                    $sh->subscriber_id = $subscription->id;
                    $sh->user_id = $subscription->user_id;
                    $sh->system_type = 'Working';
                    $sh->earning_type = 'Affiliate';
                    $sh->commission = $honorariumComm; //in percent
                    $sh->amount = $affAmount;
                    $sh->delivered_to = 'subscriber';
                    $sh->completed = 1;
                    $sh->addedby_id = Auth::id();
                    $sh->save();
                }

                //for up and updown commision

                //for up commission

                $upComm = Honorarium::where('workstation_id',$subscription->work_station_id)
                ->where('active',1)
                ->where('system_type','Working')
                ->where('earning_type','Up')
                ->sum('commission');

                $upAmount = $upComm * ($job->total_job_post_cost / 100); // job post commission
                if($upAmount > 0){
                    $subOwnAmount = $upAmount / 2;  // subscriber own account
                    $upAmount = $upAmount - $subOwnAmount; // to all top subscriber

                    if($rUser = $subscription->user)
                    {
                        if($rUser->honorarium_earning_set == 100)
                        {
                            $subscrbOldBalance = $subscription->balance;
                            $subcrbNewBalance = $subscrbOldBalance + $subOwnAmount;
                        }
                        elseif(($rUser->honorarium_earning_set > 0) and ($rUser->honorarium_earning_set < 100))
                        {
                            $set = $rUser->honorarium_earning_set;
                            $penaltySubOwnAmt = $subOwnAmount * ($set / 100);

                            $subOwnAmount = $penaltySubOwnAmt;
                            $subscrbOldBalance = $subscription->balance;
                            $subcrbNewBalance = $subscrbOldBalance + $penaltySubOwnAmt;
                        }
                        else
                        {
                            $subOwnAmount = 0;
                        }
                    }


                    //bt will be here

                    $bt = new BalanceTransaction;
                    $bt->subscriber_id = $subscription->id;
                    $bt->from = 'admin';
                    $bt->to = 'subscriber';
                    $bt->purpose = 'honorarium';
                    $bt->user_id = $subscription->user_id;
                    $bt->previous_balance = $subscrbOldBalance;  // subscriber old balance
                    $bt->moved_balance = $subOwnAmount; // up amount for subscr
                    $bt->new_balance = $subcrbNewBalance; // subscriber new balance
                    $bt->type = 'up';
                    $bt->details = "{$subOwnAmount} TK added up honorarium to subscriber balance from admin.";
                    $bt->type_id = $order->id;
                    $bt->addedby_id = Auth::id();
                    if($subOwnAmount < 0)
                    {
                        $bt->save();
                    }


                    //for own subscriber_honorarium  row  here for post up commission
                    $shth = new SubscriberHonorarium;
                    $shth->workstation_id = $subscription->work_station_id;
                    $shth->subscriber_id = $subscription->id;
                    $shth->user_id = $subscription->user_id;
                    $shth->system_type = 'Working';
                    $shth->earning_type = 'Up';
                    $shth->commission = $upComm; //in percent
                    $shth->amount = $subOwnAmount;
                    $shth->delivered_to = 'subscriber';
                    $shth->completed = 1;
                    $shth->addedby_id = Auth::id();
                    if($subOwnAmount < 0)
                    {
                        $shth->save();
                    }
                    //10tk
                }


                // half of updown commision start ( up half)
                $totalUpdownComm = Honorarium::where('workstation_id',$subscription->work_station_id)
                ->where('active',1)
                ->where('system_type','Working')
                ->where('earning_type','Updown')
                ->sum('commission');

                $totalUpdownAmount = $totalUpdownComm * ($job->total_job_post_cost / 100); // job post commission 10tk

                // half of totalupdown comission
                $upHalfOfUpdown = $totalUpdownAmount / 2; // 5 tk
                // topsubscriber up commission
                $j = $subscription->ws_position;

                $k = $j;
                $workUpAmount = 0;
                for($j = $subscription->ws_position; $j > 0; $j--)
                {
                    if($j != $k)
                    {
                        continue;
                    }

                    $id = (int) ($k / 2);

                    //id will be credited;
                    $topSubscriber = Subscriber::where('ws_position', $id)
                    ->where('work_station_id', $subscription->work_station_id)
                    ->first();
                    if($topSubscriber)
                    {
                        $preBalanceOfTop = $topSubscriber->balance;
                        $upAmount = $upAmount / 2;
                        if($upAmount == 0)
                        {
                            break;
                        }


                        // updown up commission
                        if($upHalfOfUpdown == 0)
                        {
                            break;
                        }
                        $upHalfOfUpdown = $upHalfOfUpdown / 2;

                        if($rUser = $topSubscriber->user)
                        {
                            $set = $rUser->honorarium_earning_set;
                            $upCommissionforpenaly = $upComm * ($set / 100);
                            $upAmountforPenalty =  $upCommissionforpenaly * ($job->total_job_post_cost / 100);

                            $uphalfComOfUpdownPenalty = $upHalfOfUpdown * ($set / 100);
                            $uphalfOfUpdownAmountforPenalty = $uphalfComOfUpdownPenalty * ($job->total_job_post_cost / 100);

                        }
                        else
                        {
                            $upCommissionforpenaly = 0;
                            $upAmountforPenalty =  $upCommissionforpenaly;
                            $uphalfComOfUpdownPenalty = 0;
                            $uphalfOfUpdownAmountforPenalty = $uphalfComOfUpdownPenalty;

                        }

                        $subHon = new SubscriberHonorarium;
                        $subHon->workstation_id = $subscription->work_station_id;
                        $subHon->subscriber_id = $topSubscriber->id;
                        $subHon->user_id = $topSubscriber->user_id;
                        $subHon->system_type = 'Working';
                        $subHon->earning_type = 'Updown';
                        $subHon->commission = $uphalfComOfUpdownPenalty; // $totalUpdownComm; //in percent
                        $subHon->amount = $uphalfOfUpdownAmountforPenalty; //$upHalfOfUpdown;
                        $subHon->delivered_to = 'subscriber';
                        $subHon->completed = 1;
                        $subHon->addedby_id = Auth::id();
                        if($uphalfOfUpdownAmountforPenalty > 0)
                        {
                            $subHon->save();
                        }

                        $topSubscriber->balance = $topSubscriber->balance + $uphalfOfUpdownAmountforPenalty;
                        // $topSubscriber->save();

                        // $ad->order = $ad->order - $upAmount;
                        // $workUpAmount = $workUpAmount + $upAmount;
                        //for topSubscriber subscriber_honorarium  row created here for up commission
                        $sht = new SubscriberHonorarium;
                        $sht->workstation_id = $subscription->work_station_id;
                        $sht->subscriber_id = $topSubscriber->id;
                        $sht->user_id = $topSubscriber->user_id;
                        $sht->system_type = 'Working';
                        $sht->earning_type = 'Up';
                        $sht->commission = $upCommissionforpenaly; //$upComm; //in percent
                        $sht->amount = $upAmountforPenalty; //$upAmount;
                        $sht->delivered_to = 'subscriber';
                        $sht->completed = 1;
                        $sht->addedby_id = Auth::id();
                        if($upAmountforPenalty > 0)
                        {
                            $sht->save();
                        }

                        //bt will be here
                        $bt = new BalanceTransaction;
                        $bt->subscriber_id = $topSubscriber->id;
                        $bt->from = 'admin';
                        $bt->to = 'subscriber';
                        $bt->purpose = 'honorarium';
                        $bt->user_id = $topSubscriber->user_id;
                        $bt->previous_balance = $preBalanceOfTop; //$topSubscriber->balance;  // subscriber old balance
                        $bt->moved_balance = $upAmountforPenalty + $uphalfOfUpdownAmountforPenalty;
                        //$upAmount + $upHalfOfUpdown; // up amount for subscr
                        $bt->new_balance = $bt->moved_balance + $bt->previous_balance;
                        // subscriber new balance
                        $bt->type = 'Up_Updown';
                        $bt->details = "{$upAmount} TK for Up honorarium and {$upHalfOfUpdown} TK for updown honorarium added to subscriber balance from admin.";
                        $bt->type_id = $order->id;
                        $bt->addedby_id = Auth::id();
                        if(($upAmountforPenalty > 0) or ($uphalfOfUpdownAmountforPenalty > 0) )
                        {
                            $bt->save();
                        }

                        $topSubscriber->balance = $topSubscriber->balance + $upAmount;
                        $topSubscriber->save();
                        $k = $id;

                    }
                }

                // $ad->save();

                // $admin_balance = $this->updateAdBalance($workUpAmount,$orderPayment->work_station_id,'order_base_payment');

                // $oma = $workUpAmount + $oma; // order amount update to all top subscrb
                // $orderSoftcodeBalance = ($job->total_job_post_cost - $job->total_job_work_cost) - $oma;

                // $admin_balance = $this->updateAdBalance($orderSoftcodeBalance,$orderPayment->work_station_id,'order_softcode_balance');

                // $subOldBalance = $subscription->balance;
                // $subNewBalance = $subscrbOldBalance + $workUpAmount;

                // //bt will be here

                // $bt = new BalanceTransaction;
                // $bt->subscriber_id = $subscription->id;
                // $bt->from = 'admin';
                // $bt->to = 'subscriber';
                // $bt->purpose = 'job_post';
                // $bt->user_id = $subscription->user_id;
                // $bt->previous_balance = $subOldBalance;  // subscriber old balance
                // $bt->moved_balance = $workUpAmount; // up amount for subscr
                // $bt->new_balance = $subNewBalance; // subscriber new balance
                // $bt->type = 'order';
                // $bt->details = "{$workUpAmount} TK add to subscriber balance from admin.";
                // $bt->type_id = $order->id;
                // $bt->addedby_id = Auth::id();
                // $bt->save();

                //softcode_balance = obp - owp;
                // $softcodeBalance = $job->total_job_post_cost - $job->total_job_work_cost;
                // $admin_balance = $this->updateAdBalance($softcodeBalance,$orderPayment->work_station_id,'order_softcode_balance');

                ##############
                #in admin balance
                # softcodeBalance = joining + order_softcode_balance
                # it will show in admin dashboard
                #
                ###############

                //for down of updown commission


                // found last subscriber
                $downSubscriber = Subscriber::where('work_station_id', $subscription->work_station_id)->orderBy('ws_position','desc')->first();


                // topsubscriber down commission from updown

                $m = $subscription->ws_position;
                $first = $m;
                $last = $downSubscriber->ws_position; // 18
                $l = 1;
                $h = pow(2,$l); // horizontal person count 2
                $last_h = ($h * $first) + ($h - 1); // 5 , 11, 23 etc for (first = 2)
                $downHalf = $totalUpdownAmount / 2; // 5tk
                $halfOfDownHalf = $downHalf / 2; // 2.5tk

                $perHeadDownCom = $halfOfDownHalf / $h; // 1.75

                for($m = $first; $last >= $m; $m++)
                {
                    if(($m >= ($h * $first)) or ($m <= ($last_h)))
                    {

                        // commision distribution will be here

                        //down commision of updown commision

                        //id will be credited;
                        $presentSubscriber = Subscriber::where('ws_position', $m)
                        ->where('work_station_id', $subscription->work_station_id)
                        ->first();
                        if($presentSubscriber)
                        {


                            if($perHeadDownCom == 0)
                            {
                                break;
                            }

                            // $workUpAmount = $workUpAmount + $upAmount;

                            //for topSubscriber subscriber_honorarium  row created here for up commission
                            $sht = new SubscriberHonorarium;
                            $sht->workstation_id = $presentSubscriber->work_station_id;
                            $sht->subscriber_id = $presentSubscriber->id;
                            $sht->user_id = $presentSubscriber->user_id;
                            $sht->system_type = 'Working';
                            $sht->earning_type = 'Updown';
                            $sht->commission = $totalUpdownComm; //in percent
                            $sht->amount = $perHeadDownCom;
                            $sht->delivered_to = 'subscriber';
                            $sht->completed = 1;
                            $sht->addedby_id = Auth::id();
                            $sht->save();

                            //bt will be here
                            $bt = new BalanceTransaction;
                            $bt->subscriber_id = $presentSubscriber->id;
                            $bt->from = 'admin';
                            $bt->to = 'subscriber';
                            $bt->purpose = 'honorarium';
                            $bt->user_id = $presentSubscriber->user_id;
                            $bt->previous_balance = $presentSubscriber->balance;  // subscriber old balance
                            $bt->moved_balance = $perHeadDownCom; // up amount for subscr
                            $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // subscriber new balance
                            $bt->type = 'Updown';
                            $bt->details = "{$perHeadDownCom} TK down of updown honorarium added to subscriber balance from admin.";
                            $bt->type_id = $order->id;
                            $bt->addedby_id = Auth::id();
                            $bt->save();

                            $presentSubscriber->balance = $presentSubscriber->balance + $perHeadDownCom;
                            $presentSubscriber->save();

                        }


                        if($m == $last_h)
                        {
                            $l= $l + 1; // 2
                            $h = pow(2,$l); // 4
                            $halfOfDownHalf = $halfOfDownHalf / 2; // 1.75tk
                            $perHeadDownCom = $halfOfDownHalf / $h; // 0.4375tk

                            $last_h = ($h * $first) + ($h - 1);       // 23
                        }
                    }
                    else
                    {
                    continue;
                    }
                }

                //  team group honorarium
                $teamGroupComm = Honorarium::where('workstation_id',$subscription->work_station_id)
                ->where('active',1)
                ->where('system_type','Working')
                ->where('earning_type','Team_group')
                ->sum('commission');

                $totalTeamGroupAmount = $teamGroupComm * ($job->total_job_post_cost / 100); // job post commission 10tk

                if($totalTeamGroupAmount > 0)
                {
                    //my introducer
                    $introducer_id = $subscription->referrer ? $subscription->referrer->id : null;

                    //my subscricption_id
                    $my_id = $subscription->id;
                    // dd($my_id);

                    if($introducer_id !=null)
                    {

                        $all = array_merge([$my_id],[$introducer_id]);
                    }
                    else
                    {
                        $all = array_merge([$my_id]);
                    }
                    //my refferd_ids
                    $my_reffered_ids = $subscription->referredTeam()->pluck('id');

                    if(count($my_reffered_ids) > 0)
                    {
                        $all = $my_reffered_ids->merge($all);
                    }

                    $individualTeamComm = $totalTeamGroupAmount / count($all);

                    foreach($all as $id)
                    {
                        $subscriber = Subscriber::where('id', $id)
                        ->where('work_station_id', $subscription->work_station_id)
                        ->first();

                        //subscriber_honorarium row will be created here
                        $subscHono = new SubscriberHonorarium;
                        $subscHono->workstation_id = $subscription->work_station_id;
                        $subscHono->subscriber_id = $subscriber->id;
                        $subscHono->user_id = $subscriber->user_id;
                        $subscHono->system_type = 'Working';
                        $subscHono->earning_type = 'Team_group';
                        $subscHono->commission = $teamGroupComm; //in percent
                        $subscHono->amount = $individualTeamComm;
                        $subscHono->delivered_to = 'subscriber';
                        $subscHono->completed = 1;
                        $subscHono->addedby_id = Auth::id();
                        $subscHono->save();

                        // bt will be here
                        $bt = new BalanceTransaction;
                        $bt->subscriber_id = $subscriber->id;
                        $bt->from = 'admin';
                        $bt->to = 'subscriber';
                        $bt->purpose = 'honorarium';
                        $bt->user_id = $subscriber->user_id;
                        $bt->previous_balance = $subscriber->balance;  // subscriber old balance
                        $bt->moved_balance = $individualTeamComm; // up amount for subscr
                        $bt->new_balance = $bt->moved_balance + $bt->previous_balance; // subscriber new balance
                        $bt->type = 'team';
                        $bt->details = "{$individualTeamComm} TK for team group honorarium added to subscriber balance from admin.";
                        $bt->type_id = $order->id;
                        $bt->addedby_id = Auth::id();
                        $bt->save();

                        $subscriber->balance = $bt->new_balance;
                        //10tk
                        $subscriber->save();
                    }

                }

            // work station individual income honorarium


            return back()->with('success','Job Posted In Workstation Successfully.');
        }

        else
        {
            return back()->with('error','Due to Insufficient Balance You Can not post this job.Please Recharge your Balance');
        }

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

    public function moveBalanceToWallet(Request $request)
    {

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
       
        if(!$subscription)
        {
            abort(404);
        }
        
        $pf_balance= $subscription->balance;
        $subscription->balance = 0;
        $subscription->save();

        if ($pf_balance < 1) {
           return redirect()->back()->with('error','You PF balance is 0. So please don\'t try.' );
        }


        $me = Auth::user();

        // dd($subscription->referrer->user_id);
        if($subscription->user_id == $me->id )
        {

            if($subscription->free_account == 1)
            {
                return back()->with('warning', 'Sorry, your account is free account. Account must be at least a standard account before move to wallet');
            }

            $mb =  $me->balance;

            $sb = $pf_balance;

            $me->balance = $mb + $sb;
            $me->save();

            $subscription->balance = 0;
            $subscription->save();

            //balance transfer  row  created here for subscriber to user
            $bt = new BalanceTransaction;
            $bt->subscriber_id = $subscription->id;
            $bt->from = 'subscriber';
            $bt->to = 'user';
            $bt->purpose = 'move_to_wallet';
            $bt->user_id = $me->id;
            $bt->previous_balance = $mb;  // user balance
            $bt->moved_balance = $sb; // subscriber balance
            $bt->new_balance = $me->balance; // user new balance
            $bt->type = 'move_to_wallet';
            $bt->details = "Balance moved from my subscriber account {$subscription->subscription_code} to my cashout wallet";

            $bt->addedby_id = Auth::id();
            $bt->save();

            // dd($subscription->referral_id);

            if($intRef = $subscription->user->introducerRefferer())
            {
                // dd($subscription->referrer->user_id);

                // dd('yes');
                $s = $subscription;
                $lifetimeBalanceCom = Honorarium::where('workstation_id',$s->work_station_id)
                ->where('active',1)
                ->where('system_type','Working') //Beneficiary
                ->where('earning_type','Lifetime_refer') //move balance income
                ->sum('commission');
                //10%

                // $refferer = Subscriber::where('id', $s->referral_id)
                // ->where('work_station_id', $s->work_station_id)
                // ->first();

                if($intRef)
                {
                    $ltBalance = $sb * ($lifetimeBalanceCom / 100);
                    //for referer subscriber_honorarium  row will be created here for refferal commission
                    $shr = new SubscriberHonorarium;
                    $shr->workstation_id = $intRef->work_station_id;
                    $shr->subscriber_id = $intRef->id;
                    $shr->user_id = $intRef->user_id;
                    $shr->system_type = 'Working'; //banaficiary
                    $shr->earning_type = 'Lifetime_refer'; //move balance income
                    $shr->commission = $lifetimeBalanceCom; //in percent
                    $shr->amount = $ltBalance;
                    $shr->delivered_to = 'subscriber';
                    $shr->completed = 1;
                    $shr->addedby_id = Auth::id();
                    $shr->save();

                    // bt will be here
                    $bt = new BalanceTransaction;
                    $bt->subscriber_id = $intRef->id;
                    $bt->from = 'admin';
                    $bt->to = 'subscriber';
                    $bt->purpose = 'honorarium';
                    $bt->user_id = $intRef->user_id;
                    $bt->previous_balance = $intRef->balance;  // subscriber old balance
                    $bt->moved_balance = $ltBalance; // affiliate amount
                    $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // subscriber new balance (uob-jobcost)
                    $bt->type = 'move_to_wallet';
                    $bt->details = "{$ltBalance} TK lifetime refer honorarium added to introducer subscriber balance from admin.";

                    $bt->addedby_id = Auth::id();
                    $bt->save();

                    //refferer balance update
                    $intRef->balance = $intRef->balance + $ltBalance;
                    $intRef->save();


                }
            }

            // if($subscription->referral_id)
            // {
            //     $s = $subscription;
            //     $lifetimeBalanceCom = Honorarium::where('workstation_id',$s->work_station_id)
            //     ->where('active',1)
            //     ->where('system_type','Working') //Beneficiary
            //     ->where('earning_type','Lifetime_refer') //move balance income
            //     ->sum('commission');
            //     //10%


            //     $refferer = Subscriber::where('id', $s->referral_id)
            //     ->where('work_station_id', $s->work_station_id)
            //     ->first();

            //     if($refferer)
            //     {
            //         $ltBalance = $sb * ($lifetimeBalanceCom / 100);
            //         //for referer subscriber_honorarium  row will be created here for refferal commission
            //         $shr = new SubscriberHonorarium;
            //         $shr->workstation_id = $s->work_station_id;
            //         $shr->subscriber_id = $refferer->id;
            //         $shr->user_id = $refferer->user_id;
            //         $shr->system_type = 'Working'; //banaficiary
            //         $shr->earning_type = 'Lifetime_refer'; //move balance income
            //         $shr->commission = $lifetimeBalanceCom; //in percent
            //         $shr->amount = $ltBalance;
            //         $shr->delivered_to = 'subscriber';
            //         $shr->completed = 1;
            //         $shr->addedby_id = Auth::id();
            //         $shr->save();

            //         //refferer balance update
            //         $refferer->balance = $refferer->balance + $ltBalance;
            //         $refferer->save();

            //         //from admin balance
            //         //will be add later
            //     }
            // }



            return back()->with('success','Balance Transfer To Your Wallet Successfully.');

        }
        else
        {
            abort(401);
        }
    }

    public function OwnWorkApprove(FreelanceJobWork $freelancejobWork)
    {

       // dd($freelancejobWork->all());
        $request = request();
        $status = $request->status;
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        if (!$subscription) {
            abort(404);
        }

        $me = Auth::user();
        $job = FreelancerJob::find($freelancejobWork->freelancer_job_id);

            if ($status == 'approved') {

                if ($freelancejobWork->status == 'approved') {
                    return redirect()->back()->with('warning', 'Remember, your id is in danger. Don\'t try again.');
                }

                $freelancejobWork->status = 'approved';

                $freelancejobWork->job_owner_note = $request->comment;
                $freelancejobWork->approved_at = now();
                $freelancejobWork->distributed_at = now();
                $freelancejobWork->editedby_id = Auth::id();
                $freelancejobWork->save();

                // worker balance added
                $subscriberWorker = $freelancejobWork->subscriber;
                $sOldbalance = $subscriberWorker->balance;
                $sNewBalance = $subscriberWorker->balance + $job->job_work_price;
                $subscriberWorker->balance =   $sNewBalance;
                $subscriberWorker->save();

                $job->work_done = $job->worksCountWithoutReject();

                if ($job->total_worker <= $job->work_done) {
                    if ($job->status != 'completed') {
                        // $job->status = 'completed';
                        if ($job->lockedWorksCount()) {
                            $job->status = null;
                        } else {
                            $job->status = 'completed';
                        }
                    }
                }

                $job->save();

               
                //balance transfer created for work done

                $bt = new BalanceTransaction;
                $bt->subscriber_id = $freelancejobWork->subscriber_id;
                $bt->from = 'admin';
                $bt->to = 'subscriber';
                $bt->purpose = 'work_done';
                $bt->user_id = $freelancejobWork->user_id;
                $bt->previous_balance = $sOldbalance;

                $bt->moved_balance = $job->job_work_price; // work price
                $bt->new_balance = $sNewBalance;
                $bt->type = 'App\Models\FreelanceJobWork'; //work
                $bt->type_id = $freelancejobWork->id;
                $bt->details = "balance {$job->job_work_price} TK transfer to subscriber for work (work id: {$freelancejobWork->id}) approved. usfjc:953";

                $bt->addedby_id = $me->id;
                $bt->save();

                // return back()->with('success','Work is approved');

                return redirect()->back()->with('success', 'Work is approved.');
            } else {

                $freelancejobWork->job_owner_note = $request->comment;
                $freelancejobWork->status = 'claimed';
                $freelancejobWork->rejected_at = now();
                $freelancejobWork->editedby_id = Auth::id();
                $freelancejobWork->save();


                $job->status = null;
                $job->save();


                $job->work_done = $job->worksCountWithoutReject();
                $job->save();

                return redirect()->back()->with('success', 'Work is claimed and successfully submited to system-admin for review.');
            }
    }
}
