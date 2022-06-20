<?php

namespace App\Console\Commands;

use DB;
use File;
use Storage;
use App\Models\User;
use App\Models\Subscriber;
use App\Models\Category;
use App\Models\Honorarium;
use App\Models\AdminBalance;
use App\Models\FreelancerJob;
use Illuminate\Console\Command;
use App\Models\SubcriberPayment;
use App\Models\FreelanceJobWork;
use App\Models\BalanceTransaction;
use App\Models\UserUpdateInformation;
use Carbon\Carbon;

class UpdateEveryminute extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'update:everyminute';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Every minute update the backend jo jo';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {





    ####### users without subscriptions Delete start #######
    $userIds  = User::withoutGlobalScopes()
      ->doesntHave('subscriptions')
      ->whereDate('created_at', '<', now()->subDays(2))
      ->whereDoesntHave('subscriptionPayments', function ($qq) {
        $qq->where('status', 'paid');
      })
      ->where('active', 0)
      ->take(10)
      ->pluck('id');

    SubcriberPayment::whereIn('user_id', $userIds)->delete();
    User::withoutGlobalScopes()->whereIn('id', $userIds)->delete();
    ####### users without subscriptions Delete end #######


    ########## start job update ###############

    // FreelancerJob::where('status',null)
    // ->whereRaw('total_worker <= freelancer_jobs.work_done')
    // ->update(['status' => 'completed']);


    FreelanceJobWork::where('status', 'locked')
      ->where('created_at', '<', now()->subMinutes(15)->toDateTimeString())
      ->delete();

    FreelancerJob::whereHas('works', function ($query) {
      $query->where('status', 'locked');
    })
      ->update([
        'status' => null
      ]);

    $jobs = FreelancerJob::where('status', null)
      ->whereRaw('total_worker <= freelancer_jobs.work_done')
      ->take(5)
      ->get();

    foreach ($jobs as $job) {
      if ($job->total_worker <= $job->worksCountWithoutReject()) {
        if ($job->lockedWorksCount()) {
          $job->status = null;
        } else {
          $job->status = 'completed';
        }
        $job->save();
      }
    }

    ########## end job update


    // ###### another loop for pending before 2 days #######

    $wk = FreelanceJobWork::doesntHave('bt')
      // ->where('user_id', 1063)
      ->where(function ($query) {
        //   $query->where('status', 'approved');
        $query->orWhere(function ($q) {
          $q->whereDate('created_at', '<', now()->subDays(2));
          $q->where('status', 'pending');
        });
      })
      ->with('job')
      ->first();

    if ($wk) {
      $paidAmount = $wk->job->job_work_price;
      $type = 'work_done';
      $this->honorariaDistribute($paidAmount, $wk, $type);
    }

    $wk2 = FreelanceJobWork::doesntHave('bt')
      // ->where('user_id', 1063)
      ->where(function ($query) {
        //   $query->where('status', 'approved');
        $query->orWhere(function ($q) {
          $q->whereDate('created_at', '<', now()->subDays(2));
          $q->where('status', 'pending');
        });
      })
      ->with('job')
      ->first();

    if ($wk2) {
      $paidAmount = $wk2->job->job_work_price;
      $type = 'work_done';
      $this->honorariaDistribute($paidAmount, $wk2, $type);
    }

    $wk3 = FreelanceJobWork::doesntHave('bt')
      // ->where('user_id', 1063)
      ->where(function ($query) {
        //   $query->where('status', 'approved');
        $query->orWhere(function ($q) {
          $q->whereDate('created_at', '<', now()->subDays(2));
          $q->where('status', 'pending');
        });
      })
      ->with('job')
      ->first();

    if ($wk3) {
      $paidAmount = $wk3->job->job_work_price;
      $type = 'work_done';
      $this->honorariaDistribute($paidAmount, $wk3, $type);
    }

    $wk4 = FreelanceJobWork::doesntHave('bt')
      // ->where('user_id', 1063)
      ->where(function ($query) {
        //   $query->where('status', 'approved');
        $query->orWhere(function ($q) {
          $q->whereDate('created_at', '<', now()->subDays(2));
          $q->where('status', 'pending');
        });
      })
      ->with('job')
      ->first();

    if ($wk4) {
      $paidAmount = $wk4->job->job_work_price;
      $type = 'work_done';
      $this->honorariaDistribute($paidAmount, $wk4, $type);
    }

    $wk5 = FreelanceJobWork::doesntHave('bt')
      // ->where('user_id', 1063)
      ->where(function ($query) {
        //   $query->where('status', 'approved');
        $query->orWhere(function ($q) {
          $q->whereDate('created_at', '<', now()->subDays(2));
          $q->where('status', 'pending');
        });
      })
      ->with('job')
      ->first();

    if ($wk5) {
      $paidAmount = $wk5->job->job_work_price;
      $type = 'work_done';
      $this->honorariaDistribute($paidAmount, $wk5, $type);
    }




    // ->latest()
    // ->take(5)
    // ->get();

    // dd($works);

    // foreach($wks as $wk)
    // {
    //     // $wk->distributed_at = now();
    //     // $wk->save();

    //     //honoraria distribution start
    //     $paidAmount = $wk->job->job_work_price;
    //     $type = 'work_done';
    //     $this->honorariaDistribute($paidAmount,$wk,$type);
    // }

    #### cron job end ####




    #### cron job end ####

    ##

    $users = User::where('status_auto_change_date', '<>', null)
      ->whereDate('status_auto_change_date', now()->today())->limit(2)->get();
    if ($users) {
      foreach ($users as $user) {
        $user->active = $user->active ? false : true;
        $user->status_auto_change_date = null;
        $user->save();
        $um = $user->active ? 'Activated' : 'Inactivated';

        $uu = new UserUpdateInformation;
        $uu->description = "Today This Account Auto {$um}";
        $uu->user_id = $user->id;
        $uu->active =  $user->active;
        $uu->save();
      }
    }

    ///Created_at to add 365 day and update expired_at
    $subscription = Subscriber::where('expired_at', null)
      ->take(10)
      ->get();
    foreach ($subscription as  $s) {
      $s->expired_at = Carbon::parse($s->created_at)->addDay(365);
      $s->save();
    }
    ///Subscriber Expired Check  and Update free account True;
    DB::table('subscribers')->where('expired_at', '<=', Carbon::now())
      ->where('free_account', false)
      ->limit(10)
      ->update([
        'free_account' => true
      ]);

    // Only One PF Allow Start

    // if (Auth::check()) {
    //   $ids = Subscriber::where('user_id', Auth::id())->where('category_id', '!=', null)->groupBy('category_id')->pluck('id');
    //   if ($ids) {
    //     $t =  DB::table('subscribers')
    //       ->where('user_id', Auth::id())
    //       ->where('category_id', '!=', null)
    //       ->where('active', true)
    //       ->whereNotIn('id', $ids)
    //       ->update([
    //         'active' => false
    //       ]);

    //     return $t;
    //   }
    // }
    // Monthly Balance Status SMS SEND START 
    $users =  User::whereDoesntHave('balanceTransactions', function ($q) {
      $q->where('purpose', 'balance_status_send');
      $q->where('created_at', '>=', Carbon::now()->subDay(30));
    })->where('active', true)
      ->where('balance', '>', 2)
      ->take(10)
      ->get();
    if ($users) {
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
        $user->monthlyBalanceStatusSmsSend();
      }
    }

    // Only One PF Allow Start
    ///Balance Transection
  }

  public function honorariaDistribute($paidAmount, $work, $type)
  {

    // $user = User::where('mobile', '01918515567')->first();

    // if($user)
    // {
    //     $user->welcomeSmsSend();
    // }

    // AdminBalance::where('work_station_id',$work->work_station_id)
    // ->where('type',$type)
    // ->where('last',true)
    // ->update([
    //         'last' => 0
    //     ]);

    // $adminBalance = AdminBalance::where('work_station_id',$work->work_station_id)
    // ->where('type',$type)
    // ->orderBy('id','desc')
    // ->first();

    // if($adminBalance)
    // {
    //     $previousB = $adminBalance->new_balance;
    // }
    // else
    // {
    //     $previousB = 0;
    // }
    // $ab = new AdminBalance;

    // $ab->work_station_id = $work->work_station_id;
    // $ab->previous_balance = $previousB;
    // $ab->transfer_balance = $paidAmount;
    // $ab->new_balance = $ab->previous_balance - $ab->transfer_balance;
    // $ab->type = $type;
    // $ab->last = true;

    // $ab->save();

    // worker balance added

    $subscriberWorker = $work->subscriber;
    $sOldbalance = $subscriberWorker->balance;
    $sNewBalance = $subscriberWorker->balance + $paidAmount;
    $subscriberWorker->balance =   $sNewBalance;
    $subscriberWorker->save();


    //balance transfer created for work done

    $bt = new BalanceTransaction;
    $bt->subscriber_id = $work->subscriber_id;
    $bt->from = 'admin';
    $bt->to = 'subscriber';
    $bt->purpose = 'work_done';
    $bt->user_id = $subscriberWorker->user_id;
    $bt->previous_balance = $sOldbalance;

    $bt->moved_balance = $paidAmount; // work price
    $bt->new_balance = $sNewBalance;
    $bt->type = 'App\Models\FreelanceJobWork'; //work
    $bt->type_id = $work->id;
    $bt->details = "balance {$paidAmount} TK transfer to subscriber for work (work id {$work->id}) approved. uem:315";

    $bt->addedby_id = $work->user_id;
    $bt->save();

    if ($bt->id) {
      if ($work->status != 'approved') {
        $work->status = 'approved';
        $work->approved_at = now();
      }

      $work->distributed_at = now();
      $work->save();
    }
  }
}
