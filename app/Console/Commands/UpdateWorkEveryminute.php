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

class UpdateWorkEveryminute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
     protected $signature = 'update:workeveryminute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Every minute update the work jo jo';

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


        // $wrks = FreelanceJobWork::where('status', 'approved')
        //         // ->where('user_id', $user->id)
        //         ->doesntHave('bt')
        //         ->with('job')
        //         ->take(200)
        //         ->get();

        //         foreach($wrks as $wrk)
        //         {
        //             $btt = BalanceTransaction::where('user_id', $wrk->user_id)
        //             // ->where('moved_balance', $wrk->job->job_work_price)
        //             ->where('purpose', 'work_done')
        //             ->where('type_id', null)
        //             ->first();

        //             // dd($wrk->id);

        //             // dd($bt);

        //             if($btt){
        //                 $btt->type = 'APP\Models\FreelanceJobWork';
        //                 $btt->type_id = $wrk->id;
        //                 $btt->save();
        //             }
        //         }

        // FreelanceJobWork::whereHas('job', function($q){$q->where('status', 'temp');})->delete();
        // FreelancerJob::where('status', 'temp')->delete();

        // $w = FreelanceJobWork::doesntHave('balanceTransactions')->orderBy('id', 'desc')->first();
        // dd($w);


        #### for cron job start ####

        //approved work honoraria distributed;
        $work = FreelanceJobWork::doesntHave('bt')
        // ->where('user_id', 1063)
        ->where(function ($query) {
              $query->where('status', 'approved');
            //   $query->orWhere(function ($q){
            //     $q->whereDate('created_at', '<', now()->subDays(2));
            //     $q->where('status', 'pending');

            //   });
           })
        ->with('job')
        ->first();
        if($work)
        {
            $paidAmount = $work->job->job_work_price;
            $type = 'work_done';
            $this->honorariaDistribute($paidAmount,$work,$type);
        }


        $work2 = FreelanceJobWork::doesntHave('bt')
        // ->where('user_id', 1063)
        ->where(function ($query) {
              $query->where('status', 'approved');
            //   $query->orWhere(function ($q){
            //     $q->whereDate('created_at', '<', now()->subDays(2));
            //     $q->where('status', 'pending');

            //   });
           })
        ->with('job')
        ->first();
        if($work2)
        {
            $paidAmount = $work2->job->job_work_price;
            $type = 'work_done';
            $this->honorariaDistribute($paidAmount,$work2,$type);
        }

        $work3 = FreelanceJobWork::doesntHave('bt')
        // ->where('user_id', 1063)
        ->where(function ($query) {
              $query->where('status', 'approved');
            //   $query->orWhere(function ($q){
            //     $q->whereDate('created_at', '<', now()->subDays(2));
            //     $q->where('status', 'pending');

            //   });
           })
        ->with('job')
        ->first();
        if($work3)
        {
            $paidAmount = $work3->job->job_work_price;
            $type = 'work_done';
            $this->honorariaDistribute($paidAmount,$work3,$type);
        }

        $work4 = FreelanceJobWork::doesntHave('bt')
        // ->where('user_id', 1063)
        ->where(function ($query) {
              $query->where('status', 'approved');
            //   $query->orWhere(function ($q){
            //     $q->whereDate('created_at', '<', now()->subDays(2));
            //     $q->where('status', 'pending');

            //   });
           })
        ->with('job')
        ->first();
        if($work4)
        {
            $paidAmount = $work4->job->job_work_price;
            $type = 'work_done';
            $this->honorariaDistribute($paidAmount,$work4,$type);
        }

        $work5 = FreelanceJobWork::doesntHave('bt')
        // ->where('user_id', 1063)
        ->where(function ($query) {
              $query->where('status', 'approved');
            //   $query->orWhere(function ($q){
            //     $q->whereDate('created_at', '<', now()->subDays(2));
            //     $q->where('status', 'pending');

            //   });
           })
        ->with('job')
        ->first();
        if($work5)
        {
            $paidAmount = $work5->job->job_work_price;
            $type = 'work_done';
            $this->honorariaDistribute($paidAmount,$work5,$type);
        }


        // ->latest()
        // ->take(5)
        // ->get();

        // dd($works);

        // foreach($works as $work)
        // {
        //     // $work->distributed_at = now();
        //     // $work->save();

        //     //honoraria distribution start
        //     $paidAmount = $work->job->job_work_price;
        //     $type = 'work_done';
        //     $this->honorariaDistribute($paidAmount,$work,$type);
        // }


        // // ###### another loop for pending before 2 days #######

        // $wks = FreelanceJobWork::doesntHave('bt')
        // // ->where('user_id', 1063)
        // ->where(function ($query) {
        //     //   $query->where('status', 'approved');
        //       $query->orWhere(function ($q){
        //         $q->whereDate('created_at', '<', now()->subDays(2));
        //         $q->where('status', 'pending');

        //       });
        //   })
        // ->with('job')
        // // ->latest()
        // ->take(20)
        // ->get();

        // // dd($works);

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
    }

    public function honorariaDistribute($paidAmount,$work,$type)
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
        $sNewBalance = $subscriberWorker->balance + $paidAmount ;
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
        $bt->new_balance = $sNewBalance ;
        $bt->type = 'App\Models\FreelanceJobWork'; //work
        $bt->type_id = $work->id;
        $bt->details = "balance {$paidAmount} TK transfer to subscriber for work (work id {$work->id}) approved. uwem:303";

        $bt->addedby_id = $work->user_id;
        $bt->save();

        if($bt->id)
        {
            if($work->status != 'approved')
            {
                $work->status = 'approved';
                $work->approved_at = now();
            }

            $work->distributed_at = now();
            $work->save();
        }
    }
}
