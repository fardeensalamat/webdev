<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use File;
use Storage;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Honorarium;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Models\FreelancerJob;
use App\Models\SubcriberPayment;
use App\Models\FreelanceJobWork;
use App\Models\BalanceTransaction;
use App\Http\Controllers\Controller;
use App\Models\SubscriberHonorarium;
use Carbon\Carbon;

class DevTestController extends Controller
{

    public function devtest(Request $request)
    {

        $refferalComm = Honorarium::where('workstation_id', 1)
            ->where('active', 1)
            ->where('system_type', 'Joining')
            ->where('earning_type', 'Refferal')
            ->sum('commission');
        $refferalAmount = $refferalComm;

        dd($refferalAmount);



        $a = FreelanceJobWork::where('status', 'locked')
            ->where('created_at', '<', now()->subMinutes(15)->toDateTimeString())
            ->get();
        dd($a);
        $users = User::all();
        foreach ($users as $user) {
            if ($user->mobile) {
                $user->mobile = '+' . bdMobile($user->mobile);
                $user->save();
            }
        }

        return back();


        // $fff = FreelanceJobWork::where('created_at', '<', now()->subDays(30))
        // ->whereHas('job',function($qq){
        //  $qq->where('status', 'completed')
        //     ->orWhere('status', 'cancel');
        // })
        // ->with('job')
        // ->limit(50)->get();

        // dd($fff);


        //    $ff = FreelanceJobWork::where('created_at', '<', now()->subDays(30))->limit(50)->get();

        //    foreach($ff as $work)
        //    {

        //         if($work->img)
        //         {
        //             $f = 'work/image/'.$work->img;

        //             if(Storage::disk('public')->exists($f))
        //             {
        //                 Storage::disk('public')->delete($f);
        //             }
        //         }

        //         if($work->img2)
        //         {
        //             $f = 'work/image/'.$work->img2;
        //             if(Storage::disk('public')->exists($f))
        //             {
        //                 Storage::disk('public')->delete($f);
        //             }
        //         }

        //         $work->delete();
        //    }
        //

        // $fj = FreelancerJob::where('created_at', '<', now()->subDays(30))
        // ->where('status', '<>', null)
        // ->where(function($qq){
        //     $qq->where('status', 'completed')
        //     ->orWhere('status', 'cancel');
        // })
        // ->doesntHave('works')
        // ->limit(5)
        // ->get();



        //    foreach($fj as $jjb)
        //    {

        //         if($jjb->img_name)
        //         {
        //             $g = 'media/job/'.$jjb->img_name;
        //             if(Storage::disk('public')->exists($g))
        //             {
        //                 Storage::disk('public')->delete($g);
        //                 $jjb->media()->where('collection_name', 'job_image')->delete();
        //             }
        //         }
        //         $jjb->delete();
        //    }

        dd('ok');



        ###### post User::class update ######

        DB::table('posts')->update(['postable_type' => 'App\Models\User']);

        dd(DB::table('posts')->latest()->get());

        ##### subscriber category update ########
        // $wsCats = Category::orderBy('work_station_id')
        // ->groupBy('work_station_id')
        // ->get();
        // // 8 num category missing
        // // dd($wsCats);
        // foreach($wsCats as $cat)
        // {
        //     Subscriber::where('work_station_id', $cat->work_station_id)->where('category_id', null)->update(['category_id' => $cat->id]);
        // }

        // dd('ok');


        ####### users without subscriptions #######
        $users  = User::withoutGlobalScopes()
            ->doesntHave('subscriptions')
            ->whereDate('created_at', '<', now()->subDays(2))
            ->whereDoesntHave('subscriptionPayments', function ($qq) {
                $qq->where('status', 'paid');
            })
            ->where('active', 0)
            // ->latest()
            ->take(3)
            // ->select('id')
            // ->get();
            ->pluck('id');

        // $pays = SubcriberPayment::whereIn('user_id', $users)->get();
        // dd($pays);

        dd($users);


        //approved work honoraria distributed;
        // $works = FreelanceJobWork::doesntHave('bt')
        // ->where(function ($query) {
        //       $query->where('status', 'approved');

        //   })
        // ->with('job')
        // // ->latest()
        // // ->take(1)
        // ->count();

        // dd($works);

        // $wks = FreelanceJobWork::doesntHave('bt')
        // ->where(function ($query) {
        //       $query->orWhere(function ($q){
        //         $q->whereDate('created_at', '<', now()->subDays(2));
        //         $q->where('status', 'pending');

        //       });
        //   })
        // ->with('job')
        // ->latest()
        // // ->take(1)
        // ->count();
        // dd($wks);







        ##### count for work of without bt ########
        // $works = FreelanceJobWork::doesntHave('bt')
        // ->where(function ($query) {
        //     //   $query->where('status', 'approved');
        //     //   $query->orWhere(function ($q){
        //     //     $q->whereDate('created_at', '<', now()->subDays(2));
        //     //     $q->where('status', 'pending');

        //     //   });
        //   })
        // ->with('job')
        // ->latest()
        // // ->take(50)
        // ->count();

        // dd($works);


        ######## count of work with/without bt ##########
        // $works = FreelanceJobWork::where(function ($query) {
        //       $query->where(function ($qqq){
        //         $qqq->where('status', 'approved');
        //         // $qqq->whereDate('distributed_at', '=', '2021-04-07');
        //         // $qqq->whereDate('pending_at', '<', now()->subDays(2));
        //     });
        //       $query->orWhere(function ($q){

        //         // $q->whereDate('created_at', '<', now()->subDays(2));
        //         // $q->where('status', 'pending');

        //       });
        //   })

        // ->with('job')
        // ->latest()
        // // ->take(50)
        // // ->get();
        // ->count();

        // dd($works);



        ####### bt test of user 1063 ######
        // $bt = BalanceTransaction::where('user_id', 1063)
        $bt = BalanceTransaction::where('purpose', 'work_done')
            ->latest()
            ->take(11)
            ->get();

        dd($bt);

        // $wrks = FreelanceJobWork::where('status', 'approved')
        // ->where('user_id', 1063)
        // ->doesntHave('bt')
        // // ->with('bt')


        // ->get();

        // dd($wrks);




        ######### some loop for work ###########
        // $users = DB::table('users')->where('id', '<', 200)->orderBy('id')->get();

        // DB::table('users')->where('id', '<', 200)->orderBy('id')->chunk(100, function ($users) {
        //     foreach ($users as $user) {



        //         $wrks = FreelanceJobWork::where('status', 'approved')
        //         ->where('user_id', $user->id)
        //         ->doesntHave('bt')
        //         // ->with('bt')


        //         ->get();


        //         foreach($wrks as $wrk)
        //         {
        //             $bt = BalanceTransaction::where('user_id', $wrk->user_id)
        //             ->where('purpose', 'work_done')
        //             ->where('type_id', null)
        //             ->first();

        //             // dd($wrk->id);

        //             // dd($bt);

        //             if($bt){



        //                 $bt->type = 'APP\Models\FreelanceJobWork';
        //                 $bt->type_id = $wrk->id;
        //                 $bt->save();
        //             }
        //         }

        //     }
        // });


        ####### work for with/without bt ##########
        // $works = FreelanceJobWork::doesntHave('bt')
        // ->where(function ($query) {
        //       $query->where('status', 'approved');
        //       $query->orWhere(function ($q){
        //         $q->whereDate('created_at', '<', now()->subDays(2));
        //         $q->where('status', 'pending');

        //       });
        //   })
        // ->with('job')
        // ->latest()
        // // ->take(50)
        // ->count();

        // dd($works);

        // $wrks = FreelanceJobWork::where('status', 'approved')
        // // ->where('user_id', 1063)
        // ->has('bt')
        // // ->with('bt')


        // ->count();


        // foreach($wrks as $wrk)
        // {
        //     $bt = BalanceTransaction::where('user_id', $wrk->user_id)
        //     ->where('purpose', 'work_done')
        //     ->where('type_id', null)
        //     ->first();

        //     // dd($wrk->id);

        //     // dd($bt);

        //     if($bt){



        //         $bt->type = 'APP\Models\FreelanceJobWork';
        //         $bt->type_id = $wrk->id;
        //         $bt->save();
        //     }
        // }

        // dd($wrks);




        ####### work with / without bt

        // $works = FreelanceJobWork::whereHas('balanceTransactions', function($qq){
        //     // $qq->whereIn('user_id', [1063]);
        //     $qq->where('user_id', 1063);
        //     // $qq->whereIn('user_id', [1300,90,1188,1146]);
        //     $qq->where('purpose', 'work_done');
        // })
        // ->where(function ($query) {
        //       $query->where('status', 'approved');
        //       $query->orWhere(function ($q){
        //         // $q->whereDate('created_at', '<', now()->subDays(2));
        //         // $q->where('status', 'pending');

        //       });
        //   })
        // ->with('job')
        // ->latest()
        // ->count();



        // dd($works);

        ######## bt of some user #########

        // $c = BalanceTransaction::whereIn('user_id', [1300,90,1188,1146])->count();

        // dd($c);

        // $works = FreelanceJobWork::doesntHave('balanceTransactions')
        // ->where(function ($query) {
        //         $query->where('status', 'approved');
        //         $query->orWhere(function ($q){
        //         $q->whereDate('created_at', '<', now()->subDays(2));
        //         $q->where('status', 'pending');

        //         });
        //     })
        // ->with('job')
        // ->latest()
        // ->take(50)
        // ->get();

        // dd($works);


        ########## work without bt ##########

        // $works = FreelanceJobWork::doesntHave('balanceTransactions')
        // ->where('status', 'approved')
        // ->with('job')
        // // ->latest()
        // ->take(10)
        // ->get();

        // // dd($works);

        // foreach($works as $work)
        // {
        //     dd($work);
        // }



















        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();


        if (!$subscription) {
            abort(404);
        }

        $me = Auth::user();

        if ($subscription->user_id) {

            $mb =  $me->balance;
            $sb = $subscription->balance;

            $me->balance = $mb + $sb;
            // $me->save();

            $subscription->balance = 0;
            // $subscription->save();

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
            // $bt->save();

            // dd($subscription->referral_id);

            if ($subscription->referral_id) {

                $s = $subscription;
                $lifetimeBalanceCom = Honorarium::where('workstation_id', $s->work_station_id)
                    ->where('active', 1)
                    ->where('system_type', 'Working') //Beneficiary
                    ->where('earning_type', 'Lifetime_refer') //move balance income
                    ->sum('commission');
                //10%


                $refferer = Subscriber::where('id', $s->referral_id)
                    ->where('work_station_id', $s->work_station_id)
                    ->first();

                if ($refferer) {
                    $ltBalance = $sb * ($lifetimeBalanceCom / 100);
                    //for referer subscriber_honorarium  row will be created here for refferal commission
                    $shr = new SubscriberHonorarium;
                    $shr->workstation_id = $s->work_station_id;
                    $shr->subscriber_id = $refferer->id;
                    $shr->user_id = $refferer->user_id;
                    $shr->system_type = 'Working'; //banaficiary
                    $shr->earning_type = 'Lifetime_refer'; //move balance income
                    $shr->commission = $lifetimeBalanceCom; //in percent
                    $shr->amount = $ltBalance;
                    $shr->delivered_to = 'subscriber';
                    $shr->completed = 1;
                    $shr->addedby_id = Auth::id();
                    // $shr->save();

                    //refferer balance update
                    $refferer->balance = $refferer->balance + $ltBalance;
                    dd($refferer);
                    // $refferer->save();

                    //from admin balance
                    //will be add later
                }
            }



            return back()->with('success', 'Balance Transfer To Your Wallet Successfully.');
        } else {
            abort(401);
        }
    }
    public function SubscriptionExpired(Request $request)
    {
        // $subscription = Subscriber::where('expired_at', null)
        //     ->take(10)
        //     ->get();
        // foreach ($subscription as  $s) {
        //     $s->expired_at = Carbon::parse($s->created_at)->addDay(365);
        //     $s->save();
        // }

        ///

        // return $subscription = Subscriber::where('expired_at', '<=', Carbon::now())
        //     ->where('free_account', false)
        //     ->take(10)
        //     ->get();
        // foreach ($subscription as  $s) {
        //     $s->free_account = true;
        //     $s->save();
        // }

        // DB::table('subscribers')->where('expired_at', '<=', Carbon::now())
        // ->where('free_account', false)
        // ->limit(10)
        // ->update([
        //     'free_account'=>true
        // ]);

        // Only One PF Allow Start

        if (Auth::check()) {
            $ids = Subscriber::where('user_id', Auth::id())->groupBy('category_id')->pluck('id');
            if ($ids) {
              $t=  DB::table('subscribers')
              ->where('user_id', Auth::id())
              ->where('active',true)
              ->whereNotIn('id', $ids)
              ->update([
                  'active'=>false
              ]);

            }
        }
    
      
        // Only One PF Allow Start


        foreach ($users as  $user) {
      $bt = new BalanceTransaction;
      $bt->from = 'user';
      $bt->to = 'admin';
      $bt->purpose = 'balance_status_send';
      $bt->subscriber_id = $user->subscriptions->first()->id;
      $bt->user_id = $user->id;
      $bt->previous_balance = $user->balance;  // user old balance
      $bt->moved_balance = 2; // job cost
      $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
      $bt->type = 'user';
      $bt->details = "Dear {$user->name}, Your softcodeint Mobile : {$user->mobile} and your current balance : {$bt->new_balance} . www.softcodeint.com";
      $bt->type_id = $user->id;
      $bt->addedby_id = Auth::id();
      $bt->save();
      // $s->monthlyBalanceStatusSmsSend();
    }
    }
}
