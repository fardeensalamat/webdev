<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\WorkStation;
use Auth;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Log;

class CreatePostpaidAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $haveSubscription;
    public $cookieReffer_id;
    public $district;
    public $meMob;
    public $me;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($haveSubscription, $cookieReffer_id, $distict, $meMob, $me)
    {
        $this->haveSubscription = $haveSubscription;
        $this->cookieReffer_id = $cookieReffer_id;
        $this->district = $distict;
        $this->meMob = $meMob;
        $this->me = $me;
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       
        foreach ($this->haveSubscription as $category) {

            $workstation = Workstation::find($category->work_station_id);

            $code = Subscriber::where('subscription_code', $this->cookieReffer_id)
            ->where('id', '>', 15)
            ->where('subscription_code', '<>', null)
            ->where('work_station_id', $workstation->id)
            ->first();

           

        if ($code) {
            $workstationId = $code->work_station_id;
            $reffer_id = $code->id;
           
        } else {

            // if ($sf = $me->isWSSubscription($workstation)) {

            //     $reffer_id = $sf->id;
            //     $workstationId = $workstation->id;
            // } else {
                $reffer_id = null;
                // $reffer_id = $workstation->id + 15;
                $workstationId = $workstation->id;
            //}
        }

        $wsId = $workstationId;
        if (strlen($wsId) < 2) {
            $wsId = '0' . $wsId;
        }

        $prRow = Subscriber::where('work_station_id', $workstationId)->orderBy('ws_position', 'desc')->first();

        $num = 100000000;
        $ws_pos = $prRow->ws_position + 1;
        $num = $num + $ws_pos;
        $scode = $wsId . $num . $this->meMob . $this->district;



            $s = new Subscriber;
            $s->ws_position = $ws_pos;
            $s->name = $this->me->name;
            $s->email = $this->me->email;
            $s->mobile = $this->me->mobile;
            $s->category_id = $category->id;
            $s->district_id =  $this->district;
            $s->user_id = $this->me->id;
            $s->referral_id = $reffer_id;
            $s->work_station_id = $workstationId;
            $s->subscription_code = $scode;
            $s->addedby_id =  $this->me->id;
            $s->free_account = 1;
            $s->save();
           
        }

    }
}
