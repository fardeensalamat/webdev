<?php

namespace App\Http\Controllers\Auth;

Use Alert;
use Cookie;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\District;
use App\Models\Honorarium;
use App\Models\Subscriber;
use App\Models\WorkStation;
use Illuminate\Http\Request;
use App\Models\OrderPayment;
use App\Models\AdminBalance;
use App\Models\SubcriberPayment;
use App\Models\BalanceTransaction;
use App\Models\SubscriberHonorarium;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $reffer = request()->reffer;

        if($reffer)
        {
            //previous destroy
            $cookie = request()->cookie('reffer');
            if($cookie)
            {
                Cookie::forget('reffer');
            }  

            //new create
            $name = 'reffer';
            $value = $reffer;
            $min = 60 * 24 * 30 * 2; //for 2 months;
            $newcookie = cookie($name, $value, $min);
            return redirect('/')->cookie($newcookie);
        }

        

        return redirect('/');

        $districts = District::orderBy('name')->get();
        return view('auth.register',[
            'districts' => $districts,
            'reffer' => request()->reffer ?: null
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validation = Validator::make($request->all(),
        [
            'name' => 'required|string|max:255|min:3',
            'transection' => 'required|string|max:255|min:3',
            'email' => 'nullable|string|email|max:255',
            'sender' => 'required|numeric',
            'mobile' => 'required|numeric|min:11|unique:users',
            'password' => 'required|min:8|string|confirmed'
        ]);

        if($validation->fails())
        {            
            return back()->withInput()->withErrors($validation);
        }

        if(strlen(bdMobileWithoutCode($request->mobile)) != 11)
        {
            return back()->withInput()->withErrors($validation)->with('error', 'Please, submit Bangladeshi mobile number');
        }

        if(SubcriberPayment::where('transaction_no', $request->transection)->first())
        {
            return back()->withInput()->withErrors($validation)->with('error', 'Please, Enter valid bkash Transaction ID and try again');
        }

        // $makePassword = rand(10000000,99999999);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_temp' => null,
            'active'=> 0,
            'mobile' => bdMobileWithoutCode($request->mobile)
        ]);

        

        // return redirect(RouteServiceProvider::HOME);
        
        // $user->welcomeSmsSend(); // message send to new register user
        
        $code = Subscriber::where('subscription_code',$request->reffer)->where('id', '>', 15)->where('subscription_code', '<>', null)->first();

        $ws_id= $request->ws;

        $workstation  =WorkStation::find($ws_id);

        if($code)
        {
            
            $workstationId = $code->work_station_id;
            $reffer_id = $code->id;
        }
        else
        {
            if($workstation)
            {
                $reffer_id = $workstation->id + 15;
                $workstationId = $workstation->id;
            }
            $workstationId = 1;
            $reffer_id = 16;
        }
        
 
        $me = $user;      
        
        $payment = new SubcriberPayment;
        $payment->user_id = $me->id;
        $payment->work_station_id = $workstationId;
        $payment->amount = 100;
        $payment->refer_id = $reffer_id;
        $payment->district_id = $request->district;
        $payment->transaction_no = $request->transection;
        $payment->sender_no = $request->sender;
        $payment->receiver_no = '01821952907';
        $payment->status = 'pending';
        $payment->cat_id = 1;
        $payment->save();



    //     //bkash integration start...

    //     // Merchant Info
    //     $msisdn = $payment->receiver_no; // bKash Merchant Number.
    //     $bkashUsername = "01821952907"; // bKash Merchant Username.
    //     $bkashPass = "123"; // bKash Merchant Password.
    //     $url = "https://www.bkashcluster.com:9081"; // bKash API URL with Port Number.
    //     $bkashTrxid = $payment->transaction_no; // bKash Transaction ID : TrxID.

    //     // Final URL for getting response from bKash.

    //     $bkash_url = $url.'/dreamwave/merchant/trxcheck/sendmsg?user='.$bkashUsername.'&pass='.$bkashPass.'&msisdn='.$msisdn.'&trxid='.$bkashTrxid;


    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(

    //         CURLOPT_PORT => 9081,

    //         CURLOPT_URL => $bkash_url,

    //         CURLOPT_RETURNTRANSFER => true,

    //         CURLOPT_ENCODING => "",

    //         CURLOPT_MAXREDIRS => 10,

    //         CURLOPT_TIMEOUT => 30,

    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

    //         CURLOPT_CUSTOMREQUEST => "GET",

    //         CURLOPT_HTTPHEADER => array(

    //             "cache-control: no-cache",

    //             "content-type: application/json"

    //         ),

    //     ));

    //     $response = curl_exec($curl);

    //     $err = curl_error($curl);

    //     $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    //     curl_close($curl);
    
    //         //print_r($response); // For Getting all Response Data.
    //         //
    //         dd($response);
    
    //         $api_response = json_decode($response, true);  // Getting Response from bKash API.

    //         dd($api_response);

    //         $transaction_status = $api_response['transaction']['trxStatus']; // Transaction Status Codes
    

    //     if ($err || $transaction_status == "4001") 
    //     {
    //             // echo 'Problem for Sending Response to bKash API ! Try Again after fews minutes.';
    //     }
    //     else
    //     {
    //         // Assign Transaction Information

    //         // $transaction_amount = $api_response['transaction']['amount']; // bKash Payment Amount.

    //         // $transaction_reference = $api_response['transaction']['reference']; // bKash Reference for Invoice ID.

    //         // $transaction_time = $api_response['transaction']['trxTimestamp']; // bKash Transaction Time & Date.


    //         // Return Transaction Information into Your Blade Template.

    //         // return view('transaction.bkash', compact('transaction_status', 'transaction_amount', 'transaction_reference', 'transaction_time'));
            
    //         if($transaction_status == '0000')
    //         {
    //             // echo "<div class='alert alert-success'>Transaction Successful. trxID is valid and transaction is successful.</div>";
                
    //             $user->active = 1;
    //             $user->save();
    //             $payment->status = 'paid';
    //             $payment->save();



    //             $prRow = Subscriber::where('work_station_id', $payment->work_station_id)->orderBy('ws_position', 'desc')->first();
        
    //             $dis = $payment->district_id ?: 1;
    //             if(strlen($dis) < 2)
    //             {
    //                 $dis = '0'.$dis;
    //             }

    //             $wsId = $payment->work_station_id;
    //             if(strlen($wsId) < 2)
    //             {
    //                 $wsId = '0'.$wsId;
    //             }

    //             $meMob = $payment->user->mobile ?: '00';
    //             if(strlen($meMob) > 2)
    //             {
    //                 // $meMob = last 2 digit;
    //                 $meMob = substr($meMob, -2);
                    
    //             }

    //             $num = 100000000;
    //             $ws_pos = $prRow->ws_position + 1;
    //             $num = $num + $ws_pos;
    //             $scode = $wsId . $num . $meMob .$dis ;                
                
    //             $s = new Subscriber;
    //             $s->ws_position = $ws_pos;
    //             $s->name = $payment->user->name;
    //             $s->email = $payment->user->email;
    //             $s->mobile = $payment->user->mobile;
    //             // $s->balance = $commission;
    //             $s->category_id = $payment->cat_id;
    //             $s->district_id = $payment->district_id ?: 1;
    //             $s->user_id = $payment->user_id;
    //             $s->referral_id = $payment->refer_id;
    //             $s->work_station_id = $payment->work_station_id;
    //             $s->subscription_code = $scode;
    //             $s->addedby_id = Auth::id();
                
    //             //for joining amount to admin
    //             $joining_to_admin = 100;
    //             //100tk

    //             //for signup commission
    //             $honorariumComm = Honorarium::where('workstation_id',$s->work_station_id)
    //             ->where('active',1)
    //             ->where('system_type','Joining')
    //             ->where('earning_type','Signup')
    //             ->sum('commission');       
    //             $joining_signup_commission = $honorariumComm; //commmission * (joining fee /100)
    //             //10tk 

    //             // $adminBalance->joining = $adminBalance->joining + $joining_to_admin - $joining_signup_commission;
                
    //             $adminLast = $joining_to_admin - $joining_signup_commission;
    //             //90tk

    //             //for joining comm to subscriber
    //             $s->balance = $s->balance + $joining_signup_commission;
    //             //10tk
    //             $s->save();
    //             //subscriber_honorarium row will be created here
    //             $sh = new SubscriberHonorarium; 
    //             $sh->workstation_id = $s->work_station_id;
    //             $sh->subscriber_id = $s->id;
    //             $sh->user_id = $s->user_id;
    //             $sh->system_type = 'Joining';
    //             $sh->earning_type = 'Signup';
    //             $sh->commission = $honorariumComm; //in percent
    //             $sh->amount = $joining_signup_commission;
    //             $sh->delivered_to = 'subscriber';
    //             $sh->completed = 1;
    //             $sh->addedby_id = Auth::id();
    //             $sh->save();


    //             //for balance transfer from admin joining to admin reward fund
    //             $rewardComm = Honorarium::where('workstation_id',$s->work_station_id)
    //             ->where('active',1)
    //             ->where('system_type','Joining')
    //             ->where('earning_type','Reward')
    //             ->sum('commission');
    //             $rewardAmount = $rewardComm; //commmission * (joining fee /100)
    //             //10tk

    //             // admin balance
                
    //             $adminLast = $adminLast - $rewardAmount;
    //             //80tk
    //             $admin_balance = $this->updateAdBalance($rewardAmount,$s->work_station_id,'joining_reward');       
                 

    //             //balance transfer  row will be created here for admin Reward fund
    //             // $bt = new BalanceTransaction;
    //             // $bt->subscriber_id = $s->id;
    //             // $bt->from = 'admin';
    //             // $bt->to = 'admin';
    //             // $bt->purpose = 'joining_reward';
    //             // $bt->user_id = $payment->user_id;
    //             // $bt->previous_balance = $abReward->previous_balance;  // admin joining_reward balance
    //             // $bt->moved_balance = $rewardAmount; // rewardAmount
    //             // $bt->new_balance = $abReward->new_balance; // admin new reward balance
    //             // $bt->type = 'joining_reward';
    //             // $bt->details = "Reward balance {$rewardAmount} of SubcriberPayment of #{$payment->id} transfered from joining balance to reward balance";
                
    //             // $bt->addedby_id = Auth::id();
    //             // $bt->save();

                 
    //             // //for up-refferer
    //             $adminRefTransferBalance = 0;
    //             if($s->referral_id)
    //             {
    //                 $refferalComm = Honorarium::where('workstation_id',$s->work_station_id)
    //                 ->where('active',1)
    //                 ->where('system_type','Joining')
    //                 ->where('earning_type','Refferal')
    //                 ->sum('commission');
    //                 $refferalAmount = $refferalComm; //commmission * (joining fee /100)
    //                 //10tk
                    
    //                 $sub = $s;
    //                 $n = $sub->ws_position - 1;
    //                 for($i = $n; $i > 0; $i--)
    //                 {
    //                     $refferer = Subscriber::where('ws_position', $i)
    //                     ->where('work_station_id', $sub->work_station_id)
    //                     ->first();
    //                     if($refferer)
    //                     {
    //                         if($refferer->id != $sub->referral_id) 
    //                         { 
    //                             continue;
    //                         }
    //                         else
    //                         {
    //                             // $adminBalance->joining = $adminBalance->joining - $refferalAmount;
    //                             $adminRefTransferBalance = $adminRefTransferBalance + $refferalAmount;
    //                             //70tk   
                                
    //                             //for referer subscriber_honorarium  row will be created here for refferal commission
    //                             $shr = new SubscriberHonorarium; 
    //                             $shr->workstation_id = $s->work_station_id;
    //                             $shr->subscriber_id = $refferer->id;
    //                             $shr->user_id = $refferer->user_id;
    //                             $shr->system_type = 'Joining';
    //                             $shr->earning_type = 'Refferal';
    //                             $shr->commission = $refferalComm; //in percent
    //                             $shr->amount = $refferalAmount;
    //                             $shr->delivered_to = 'subscriber';
    //                             $shr->completed = 1;
    //                             $shr->addedby_id = Auth::id();
    //                             $shr->save();

    //                             $refferer->balance = $refferer->balance + $refferalAmount;
    //                             $refferer->save();

    //                             $refferalAmount = $refferalAmount * (10/100);
    //                             $sub = $refferer;
    //                         }
    //                     }
    //                 }
                    
    //             }
    //             else
    //             {
    //                 $refferer = $s;
    //                 $refferalComm = Honorarium::where('workstation_id',$s->work_station_id)
    //                 ->where('active',1)
    //                 ->where('system_type','Joining')
    //                 ->where('earning_type','Refferal')
    //                 ->sum('commission');
    //                 $refferalAmount = $refferalComm; //commmission * (joining fee /100)
    //                 //10tk
    //                 $adminRefTransferBalance = $refferalComm;
                    
    //                 //for referer subscriber_honorarium  row will be created here for refferal commission
    //                 $shr = new SubscriberHonorarium; 
    //                 $shr->workstation_id = $s->work_station_id;
    //                 $shr->subscriber_id = $refferer->id;
    //                 $shr->user_id = $refferer->user_id;
    //                 $shr->system_type = 'Joining';
    //                 $shr->earning_type = 'Refferal';
    //                 $shr->commission = $refferalComm; //in percent
    //                 $shr->amount = $refferalAmount;
    //                 $shr->delivered_to = 'subscriber';
    //                 $shr->completed = 1;
    //                 $shr->addedby_id = Auth::id();
    //                 $shr->save();

    //                 $refferer->balance = $refferer->balance + $refferalAmount;
    //                 $refferer->save();

                    
    //             }

    //             $adminLast = $adminLast - $adminRefTransferBalance;
    //             //68 tk
    //             $admin_balance = $this->updateAdBalance($adminRefTransferBalance,$s->work_station_id,'joining_referal');

    //             // joining_referal commission will be here

    //             //for pair commission

    //             $pairComm = Honorarium::where('workstation_id',$s->work_station_id)
    //                 ->where('active',1)
    //                 ->where('system_type','Joining')
    //                 ->where('earning_type','Pair')
    //                 ->sum('commission');
    //             $pairAmount = $pairComm; //commmission * (joining fee /100)
    //                 //10tk
    //             $j = $s->ws_position;
    //             $k = $j;
    //             $adminPairTransferBalance = 0;
    //             for($j = $s->ws_position; $j > 0; $j--)
    //             { 

    //                 if($k % 2 == 0)
    //                 {
                        
    //                     break;
    //                 }
    //                 else
    //                 {
                    

    //                     if($j != $k)
    //                     {
                            
    //                         continue;
    //                     } 
    //                     else
    //                     {                   
                            
    //                         $id = (int) ($k / 2);
                            
    //                         //id will be credited;
    //                         $topSubscriber = Subscriber::where('ws_position', $id)
    //                         ->where('work_station_id', $s->work_station_id)
    //                         ->first();
    //                         if($topSubscriber)
    //                         {
    //                             // $adminBalance->joining = $adminBalance->joining - $pairAmount;
    //                             $adminPairTransferBalance = $adminPairTransferBalance + $pairAmount;
    //                             //70tk   
                                
    //                             //for topSubscriber subscriber_honorarium  row will be created here for refferal commission
    //                             $sht = new SubscriberHonorarium; 
    //                             $sht->workstation_id = $s->work_station_id;
    //                             $sht->subscriber_id = $topSubscriber->id;
    //                             $sht->user_id = $topSubscriber->user_id;
    //                             $sht->system_type = 'Joining';
    //                             $sht->earning_type = 'Pair';
    //                             $sht->commission = $pairComm; //in percent
    //                             $sht->amount = $pairAmount;
    //                             $sht->delivered_to = 'subscriber';
    //                             $sht->completed = 1;
    //                             $sht->addedby_id = Auth::id();
    //                             $sht->save();

    //                             $topSubscriber->balance = $topSubscriber->balance + $pairAmount;
    //                             $topSubscriber->save();

    //                             $k = $id;
    //                             // $pairAmount = $pairAmount * (10/100);

    //                         }                    

    //                     }
                        
    //                 }
    //             }
    //             // admin balance
    //             $adminLast = $adminLast - $adminPairTransferBalance;

    //             $admin_balance = $this->updateAdBalance($adminPairTransferBalance,$s->work_station_id,'joining_pair');
            
    //             // $adminBalance->save();
    //             $admin_balance = $this->updateAdBalance($adminLast,$s->work_station_id,'joining');



    //             if($user->subscriptions()->count() <= 1)
    //             {
    //                 $user->welcomeSmsSend();
    //             } 

    //         }

    //     }
    // //bkash integration end




        Auth::login($user);

        event(new Registered($user));

        alert()->success('Success','Your Subscription fee has been submitted.Please wait for verification.');

        // return redirect()->route('user.dashboard')->with('success', 'Your subscribtion order is pending. Please wait untill approve.');
        return redirect('/');


    }
}
