<?php

namespace App\Http\Controllers;

use App\Model\BalanceTransaction;
use App\Model\Category;
use App\Models\Honorarium;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\SubcriberPayment;
use App\Models\Subscriber;
use App\Models\SubscriberHonorarium;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Session;

class OnlinePaymentController extends Controller
{

    // public $type;
    // public function __construct($type)
    // {
    //     $this->type = $type;
    // }

    public function successnagad($order_id)
    {
        $order = Order::where('inv_id', $order_id)->first();
        $user= Auth::user();
        $payment = SubcriberPayment::where('transaction_no', $order_id)->first();
        if ($order->order_for == 'subscription') {
            $payment->status = 'paid';
            $payment->save();
            $category = Category::find($_SESSION['category']);
            // return $payment->work_station_id;
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

            if (isset($prRow)) {
                $ws_pos = $prRow->ws_position + 1;
                $num = $num + $ws_pos;
                $scode = $wsId . $num . $meMob . $dis;
            } else {
                $scode = $wsId . $num . $meMob . $dis;
            }


            $s = new Subscriber;
            $s->ws_position = 1;
            $s->name = $payment->user->name;
            $s->email = $payment->user->email;
            $s->mobile = $payment->user->mobile;
            $s->category_id = $category->id;
            $s->district_id = $payment->district_id ?: 1;
            $s->user_id = $payment->user_id;
            $s->referral_id = $payment->refer_id;
            $s->work_station_id = $payment->work_station_id;
            $s->subscription_code = $scode;
            $s->addedby_id = Auth::id();
            $s->save();

            $bt = new BalanceTransaction;
            // $bt->subscriber_id = $subscription->id;
            $bt->from = 'tenant';
            $bt->to = 'admin';
            $bt->purpose = 'new_subscription';
            $bt->user_id = $user->id;
            $bt->previous_balance = $user->balance + 100;  // user old balance
            $bt->moved_balance = 100; // job cost
            $bt->new_balance = $user->balance; // user new balance
            $bt->type = 'order';
            $bt->details = "To create new (pf-{$s->subscription_code}) subscriber of (T-{$s->user_id}) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is {$payment->id}.";
            $bt->type_id = $payment->id;
            $bt->addedby_id = Auth::id();
            $bt->save();

            //for signup commission
            $honorariumComm = Honorarium::where('workstation_id', $s->work_station_id)
                ->where('active', 1)
                ->where('system_type', 'Joining')
                ->where('earning_type', 'Signup')
                ->sum('commission');
            $joining_signup_commission = $honorariumComm; //commmission * (joining fee /100)
            //10tk

            // $joining_signup_commission

            if ($joining_signup_commission > 0) {
                // $adminBalance->joining = $adminBalance->joining + $joining_to_admin - $joining_signup_commission;

                // $adminLast = $joining_to_admin - $joining_signup_commission;
                //90tk

                if ($rUser = $s->user) {
                    $set = $rUser->honorarium_earning_set;
                    $joiningSignupCommission = $honorariumComm * ($set / 100);
                    $joiningSignupAmt =  $joiningSignupCommission;
                } else {
                    $joiningSignupCommission = 0;
                    $joiningSignupAmt =  $joiningSignupCommission;
                }

                //subscriber_honorarium row will be created here
                $sh = new SubscriberHonorarium;
                $sh->workstation_id = $s->work_station_id;
                $sh->subscriber_id = $s->id;
                $sh->user_id = $s->user_id;
                $sh->system_type = 'Joining';
                $sh->earning_type = 'Signup';
                $sh->commission = $joiningSignupCommission; //in percent
                $sh->amount = $joiningSignupAmt;
                $sh->delivered_to = 'subscriber';
                $sh->completed = 1;
                $sh->addedby_id = Auth::id();
                if ($joiningSignupAmt > 0) {
                    $sh->save();
                }


                //bt will be here
                $previousBalance = $s->balance ?: 0.00;

                $bt = new BalanceTransaction;
                $bt->subscriber_id = $s->id;
                $bt->from = 'admin';
                $bt->to = 'subscriber';
                $bt->purpose = 'honorarium';
                $bt->user_id = $s->user_id;
                $bt->previous_balance = $s->balance ?: 0.00;  // user balance
                $bt->moved_balance =  $joiningSignupAmt; // subscriber balance
                $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // user new balance
                $bt->type = 'joining_bonus';
                $bt->details = "{$joiningSignupAmt} tk joining honorarium balance added to subscriber {$s->subscription_code} balance.";

                $bt->addedby_id = Auth::id();
                if ($joiningSignupAmt > 0) {
                    $bt->save();
                }

                //for joining comm to subscriber
                // $s->balance = $bt->new_balance;
                $s->balance = $previousBalance + $joiningSignupAmt;
                //10tk
                $s->save();
            }

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
                $refferer = $s->referrer;

                if ($refferer) {

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

                    //for referer subscriber_honorarium  row will be created here for refferal commission
                    $shr = new SubscriberHonorarium;
                    $shr->workstation_id = $s->work_station_id;
                    $shr->subscriber_id = $refferer->id;
                    $shr->user_id = $refferer->user_id;
                    $shr->system_type = 'Joining';
                    $shr->earning_type = 'Refferal';
                    $shr->commission = $reAmount; //in percent
                    $shr->amount = $reAmount;
                    $shr->delivered_to = 'subscriber';
                    $shr->completed = 1;
                    $shr->addedby_id = Auth::id();
                    if ($reAmount > 0) {
                        $shr->save();
                    }

                    // bt will be here
                    $bt = new BalanceTransaction;
                    $bt->subscriber_id = $refferer->id;
                    $bt->from = 'admin';
                    $bt->to = 'subscriber';
                    $bt->purpose = 'honorarium';
                    $bt->user_id = $refferer->user_id;
                    $bt->previous_balance = $refferer->balance;  // admin joining_reward balance
                    $bt->moved_balance = $reAmount; // rewardAmount
                    $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // admin new reward balance
                    $bt->type = 'refferal_reward';
                    $bt->details = "{$reAmount} tk refferal reward honorarium balance  added to subscriber {$refferer->subscription_code} balance purpose of {$sub->subscription_code}. (udc:828)";

                    $bt->addedby_id = Auth::id();
                    // if($reAmount > 0)
                    // {
                    $bt->save();
                    // }

                    $refferer->balance = $refferer->balance + $reAmount;
                    $refferer->save();
                }
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

                // if there is no refferer that means tenant get the won refferal bonus, so if a penalty tenant then

                if ($rUser = $refferer->user) {
                    $set = $rUser->honorarium_earning_set;
                    $refferalCommission = $refferalComm * ($set / 100);
                    $refferalPerAmt =  $refferalCommission;
                } else {
                    $refferalCommission = 0;
                    $refferalPerAmt =  $refferalCommission;
                }

                //for referer subscriber_honorarium  row will be created here for refferal commission
                $shr = new SubscriberHonorarium;
                $shr->workstation_id = $s->work_station_id;
                $shr->subscriber_id = $refferer->id;
                $shr->user_id = $refferer->user_id;
                $shr->system_type = 'Joining';
                $shr->earning_type = 'Refferal';
                $shr->commission = $refferalCommission; //in percent
                $shr->amount = $refferalPerAmt;
                $shr->delivered_to = 'subscriber';
                $shr->completed = 1;
                $shr->addedby_id = Auth::id();
                if ($refferalPerAmt > 0) {
                    $shr->save();
                }

                // bt will be here
                $bt = new BalanceTransaction;
                $bt->subscriber_id = $refferer->id;
                $bt->from = 'admin';
                $bt->to = 'subscriber';
                $bt->purpose = 'honorarium';
                $bt->user_id = $refferer->user_id;
                $bt->previous_balance = $refferer->balance;  // admin joining_reward balance
                $bt->moved_balance = $refferalPerAmt; // rewardAmount
                $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // admin new reward balance
                $bt->type = 'refferal_reward';
                $bt->details = "{$refferalPerAmt} tk refferal reward honorarium balance  added to subscriber {$refferer->subscription_code} balance (udc:617)";


                $bt->addedby_id = Auth::id();
                $bt->save();

                $refferer->balance = $refferer->balance + $refferalPerAmt;
                $refferer->save();
            }
            return redirect()->route('user.softcodeFreelanching')->with('success', 'Your Payment Successfuly');
        }
        if ($order->order_for == "deposit") {
            $order = Order::where('inv_id', $order_id)->first();
            $order->order_for = 'deposit';
            $order->order_status = 'delivered';
            $order->payment_status = 'paid';
            $order->delivered_at = Carbon::now();
            $order->save();


            $user = Auth::user();
            $oldBalance = $user->balance;
            $user->increment('balance', $order->amount);
            $bt = new BalanceTransaction;
            // $bt->subscriber_id = $subscription->id;
            $bt->from = 'tenant';
            $bt->to = 'admin';
            $bt->purpose = 'deposit';
            $bt->user_id = $user->id;
            $bt->previous_balance = $oldBalance;  // user old balance
            $bt->moved_balance = $order->amount; // job cost
            $bt->new_balance = $user->balance; // user new balance
            $bt->type = 'order';
            $bt->details = "{$bt->moved_balance} Taka Deposited Successfully. Your Payment id is {$order->inv_id}. Your new Balance is {$user->balance}. Thanks for using Softcode";
            $bt->type_id = $order->id;
            $bt->addedby_id = Auth::id();
            $bt->save();
        }
        return redirect('/')->with('success', $bt->details);

        // $order = order::where('inv_id', $order_id)->first();
        // if ($order) {
        //     $order->marchant_id = $merchentid;
        //     $order->payment_status = "paid";
        //     $order->paymentref_id = $payment_ref_id;
        //     $order->save();
        //     return redirect('/')->with('success', 'Your Payment Successfuly');
        // }
    }
    public function errornagadpaynow($order_id, Request $request)
    {
        // dd("HELLO");
        // return "ERROR";
        session_start();
        $type = $_SESSION['type'];
        $payment = SubcriberPayment::where('transaction_no', $order_id)->first();
        if ($type == 'subscription') {
            $payment->delete();
            unset($_SESSION['type']);
            return redirect()->route('user.dashboard')->with('error', 'You have Canceled');
        } elseif ($type == 'deposit') {
            $order = Order::where('inv_id', $order_id)->first();
            $order->delete();
            unset($_SESSION['type']);
            return redirect('/')->with('error', 'You have Canceled');
        }


        // if ( $type == 'addMoney') {
        //     # code...
        // }

        // return redirect('/')->with('success', 'Your Payment Successfuly');
        return redirect('/')->with('error', 'You have Canceled');
    }


    public function getNagad($amount, $order_id, $type)
    {
      
        //Invoice
        // $nagadID = Order::orderBy('id', 'DESC')->pluck('id')->first();
        // $iv ="SC".$nagadID.rand(100,500);
        // $invoiceNum = $iv;
        // session_start();
        // $type = $_SESSION['type'];
        $invoiceNum = $order_id;
        // if ($type== 'subscription') {
        //     $invoiceNum = $order_id;
        // }
        // if ($type == "deposit") {
        //     $invoiceNum =  $order_id;
        // }


        //
        function generateRandomString($length = 40)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            
            return $randomString;
        }

        function EncryptDataWithPublicKey($data)
        {
            $pgPublicKey = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiCWvxDZZesS1g1lQfilVt8l3X5aMbXg5WOCYdG7q5C+Qevw0upm3tyYiKIwzXbqexnPNTHwRU7Ul7t8jP6nNVS/jLm35WFy6G9qRyXqMc1dHlwjpYwRNovLc12iTn1C5lCqIfiT+B/O/py1eIwNXgqQf39GDMJ3SesonowWioMJNXm3o80wscLMwjeezYGsyHcrnyYI2LnwfIMTSVN4T92Yy77SmE8xPydcdkgUaFxhK16qCGXMV3mF/VFx67LpZm8Sw3v135hxYX8wG1tCBKlL4psJF4+9vSy4W+8R5ieeqhrvRH+2MKLiKbDnewzKonFLbn2aKNrJefXYY7klaawIDAQAB";
            $public_key = "-----BEGIN PUBLIC KEY-----\n" . $pgPublicKey . "\n-----END PUBLIC KEY-----";
        
            $key_resource = openssl_get_publickey($public_key);
            openssl_public_encrypt($data, $cryptText, $key_resource);
            return base64_encode($cryptText);
        }


        function SignatureGenerate($data)
            {
                $merchantPrivateKey = "MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCXU4fgULJP4REuHLm9aVi2N3NTwkWLe6tSWYmBRvOVMDlbLwSfNV/ZpnltqBXkosQdz3rmfqpqteesDomCEZPmBzGZXgMKtrAkQVfuQRB70A9HdYFUHcfs2CK+UTwOIiiEibqU81W/Ao/g9cfpicfSjOsFsGmMWqz4Rk9D6pRJVJLK4gS35EsBwBC9DtWl/Gg5lYQBrdD6eYfZ/HkBYlQJOAc1GvFxUbuIr4PJbecDBBePtWBa2hrN1vXvTcnM+aWbyui0xMbyCVKQTbOSdo/NT0U7JbSLtBVHNxpUxZPet2ubj3tx8pa8JG6BrRC2DInt6DGv5LrPZIJTXa+F1kpNAgMBAAECggEAYl5wU0bhwr9BlcIik5gpjLnbBDWjU5qesbd2hU0EBpUEk9uqm3vsxOVMxhWftbKA3ggDklYAncGFyfjhNmYKyFsgyNuuCobbVZYMfNpaxsFnTUJ7QZziW3nci+7upRlbUVzepvjPYo1dzhS3UX65IItuM5KL6ir/iZza5gFVR5zm6ob/Mn1JQIlmmI6pLTVCCPhZxmR4zu14DKdCVJKxhq5hL2DsK3M8lpGmxDP503/PDVMbkKD41zTVS/1AKowdXQI0z5k1OVtUK8ANkvmTj8WhxHlO52cMj/z9RfgMMKZatmph5BXh+XQ90VFetvBPt4+LZ6SFkt8ps8Hy8usTAQKBgQDzWkYdtZDui3fTDmxvXf85NNQQQtAWsF982KZXGfubUkB9TwLqYrj45RyiR8fQ4XwBIA6UT2RHm7oAL76xFS2UnuuwdQWP4+Z7zvFKU3d7KCOkI6uMwU73kcNxgX+NE2S+L2T80G5Fc6d6IbHjtPvLelV2HmzsrAFTipeR5Kb8LQKBgQCfMOB98u1phuMvW1EJroBzfzsh0BxcApqMQqjcI6FhwTHsiKO64iIFJiBNn4ibCBRG3NwwSk/yXrPhtX8WXRT7PXXef4cJd3wEUmhQLpKWyEfNf5Wh/+NqajJI6gcxwVIOarqv9n/ADxyiCnC831L47s/4wgKPazdDxknIdp26oQKBgAE5sSSxJ1usJBxR9EXTSVe2ZmL2kymqFbEBPkUuAlBT57M51J/tg1TtgmlmxyDMId23lZs1kyGxLQyXMPSfUK1w52rqC+8fjKeO8TQYm39pQlSvQUviJU2l1EAcENJbCKTUhEOpoQSEgpFg3g5xeNsbcJa5rH68lv0es4iuiBC5AoGAT8On2LQObZ/e2e3Bjz5Wsoh/0pN6gkfztG/6OEPKKzcoksJsd8mzDi1qZjqXska8Ej28Pp4drO3y6BePFF+Tkcfb9Z6kxQOPqoK4LeUIInE8OSXCjievhbSseYh6Dl41hW/JFz5GCLAJws/EaX7lDkJrBtP/gGlSia0jb0SwB8ECgYB61huiyjYF5+7lLxGUmdcLVoG+oBUouOQ6pz8j9Mf0tIKb3q9m3wQPBY8u1KgqNtHU7lrHRygjbng2XYA6ae/Z2tSxBX+AVBF6Ged2m7vN9BV2/hDMlDHgwd6TEtG99KyU4frI9ym+JmnNZKSdC+oyWAsNrW3HKdmAN3KfQZJo5A==";
                $private_key = "-----BEGIN RSA PRIVATE KEY-----\n" . $merchantPrivateKey . "\n-----END RSA PRIVATE KEY-----";
             
                openssl_sign($data, $signature, $private_key, OPENSSL_ALGO_SHA256);
                return base64_encode($signature);
            }



        function HttpPostMethod($PostURL, $PostData)
        {
             
            $url = curl_init($PostURL);
            $postToken = json_encode($PostData);
            $header = array(
                'Content-Type:application/json',
                'X-KM-Api-Version:v-0.2.0',
                'X-KM-IP-V4:' . get_client_ip(),
                'X-KM-Client-Type:PC_WEB'
            );

            curl_setopt($url, CURLOPT_HTTPHEADER, $header);
            curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($url, CURLOPT_POSTFIELDS, $postToken);
            curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
            // curl_setopt($url, CURLOPT_HEADER, 1); 

            $resultData = curl_exec($url);
            $ResultArray = json_decode($resultData, true);
            $header_size = curl_getinfo($url, CURLINFO_HEADER_SIZE);
            curl_close($url);
          
            $headers = substr($resultData, 0, $header_size);
            $body = substr($resultData, $header_size);

            print_r($body);
            print_r($headers);
            return $ResultArray;
        }

        function get_client_ip()
        {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if (isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if (isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if (isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }

        function DecryptDataWithPrivateKey($cryptText)
            {
                $merchantPrivateKey = "MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCXU4fgULJP4REuHLm9aVi2N3NTwkWLe6tSWYmBRvOVMDlbLwSfNV/ZpnltqBXkosQdz3rmfqpqteesDomCEZPmBzGZXgMKtrAkQVfuQRB70A9HdYFUHcfs2CK+UTwOIiiEibqU81W/Ao/g9cfpicfSjOsFsGmMWqz4Rk9D6pRJVJLK4gS35EsBwBC9DtWl/Gg5lYQBrdD6eYfZ/HkBYlQJOAc1GvFxUbuIr4PJbecDBBePtWBa2hrN1vXvTcnM+aWbyui0xMbyCVKQTbOSdo/NT0U7JbSLtBVHNxpUxZPet2ubj3tx8pa8JG6BrRC2DInt6DGv5LrPZIJTXa+F1kpNAgMBAAECggEAYl5wU0bhwr9BlcIik5gpjLnbBDWjU5qesbd2hU0EBpUEk9uqm3vsxOVMxhWftbKA3ggDklYAncGFyfjhNmYKyFsgyNuuCobbVZYMfNpaxsFnTUJ7QZziW3nci+7upRlbUVzepvjPYo1dzhS3UX65IItuM5KL6ir/iZza5gFVR5zm6ob/Mn1JQIlmmI6pLTVCCPhZxmR4zu14DKdCVJKxhq5hL2DsK3M8lpGmxDP503/PDVMbkKD41zTVS/1AKowdXQI0z5k1OVtUK8ANkvmTj8WhxHlO52cMj/z9RfgMMKZatmph5BXh+XQ90VFetvBPt4+LZ6SFkt8ps8Hy8usTAQKBgQDzWkYdtZDui3fTDmxvXf85NNQQQtAWsF982KZXGfubUkB9TwLqYrj45RyiR8fQ4XwBIA6UT2RHm7oAL76xFS2UnuuwdQWP4+Z7zvFKU3d7KCOkI6uMwU73kcNxgX+NE2S+L2T80G5Fc6d6IbHjtPvLelV2HmzsrAFTipeR5Kb8LQKBgQCfMOB98u1phuMvW1EJroBzfzsh0BxcApqMQqjcI6FhwTHsiKO64iIFJiBNn4ibCBRG3NwwSk/yXrPhtX8WXRT7PXXef4cJd3wEUmhQLpKWyEfNf5Wh/+NqajJI6gcxwVIOarqv9n/ADxyiCnC831L47s/4wgKPazdDxknIdp26oQKBgAE5sSSxJ1usJBxR9EXTSVe2ZmL2kymqFbEBPkUuAlBT57M51J/tg1TtgmlmxyDMId23lZs1kyGxLQyXMPSfUK1w52rqC+8fjKeO8TQYm39pQlSvQUviJU2l1EAcENJbCKTUhEOpoQSEgpFg3g5xeNsbcJa5rH68lv0es4iuiBC5AoGAT8On2LQObZ/e2e3Bjz5Wsoh/0pN6gkfztG/6OEPKKzcoksJsd8mzDi1qZjqXska8Ej28Pp4drO3y6BePFF+Tkcfb9Z6kxQOPqoK4LeUIInE8OSXCjievhbSseYh6Dl41hW/JFz5GCLAJws/EaX7lDkJrBtP/gGlSia0jb0SwB8ECgYB61huiyjYF5+7lLxGUmdcLVoG+oBUouOQ6pz8j9Mf0tIKb3q9m3wQPBY8u1KgqNtHU7lrHRygjbng2XYA6ae/Z2tSxBX+AVBF6Ged2m7vN9BV2/hDMlDHgwd6TEtG99KyU4frI9ym+JmnNZKSdC+oyWAsNrW3HKdmAN3KfQZJo5A==";
                $private_key = "-----BEGIN RSA PRIVATE KEY-----\n" . $merchantPrivateKey . "\n-----END RSA PRIVATE KEY-----";
                openssl_private_decrypt(base64_decode($cryptText), $plain_text, $private_key);
                return $plain_text;
            }
        //index
        session_start();

        date_default_timezone_set('Asia/Dhaka');

        $MerchantID = "687355555855331";
        $DateTime = Date('YmdHis');
        $amount = $amount;
        $OrderId = $invoiceNum;
        $random = generateRandomString();

        $PostURL = "https://api.mynagad.com/api/dfs/check-out/initialize/" . $MerchantID . "/" . $OrderId;

        $_SESSION['orderId'] = $OrderId;

        $merchantCallbackURL = "https://www.sc-bd.com/mypanel/user/balance/info";

        $SensitiveData = array(
            'merchantId' => $MerchantID,
            'datetime' => $DateTime,
            'orderId' => $OrderId,
            'challenge' => $random
        );
        

        $PostData = array(
            'accountNumber' => '01886279048', //Replace with Merchant Number
            'dateTime' => $DateTime,
            'sensitiveData' => EncryptDataWithPublicKey(json_encode($SensitiveData)),
            'signature' => SignatureGenerate(json_encode($SensitiveData))
        );

        $Result_Data = HttpPostMethod($PostURL, $PostData);
 

        if (isset($Result_Data['sensitiveData']) && isset($Result_Data['signature'])) {
            if ($Result_Data['sensitiveData'] != "" && $Result_Data['signature'] != "") {

                $PlainResponse = json_decode(DecryptDataWithPrivateKey($Result_Data['sensitiveData']), true);


                if (isset($PlainResponse['paymentReferenceId']) && isset($PlainResponse['challenge'])) {


                    $paymentReferenceId = $PlainResponse['paymentReferenceId'];


                    $randomServer = $PlainResponse['challenge'];

                    $SensitiveDataOrder = array(
                        'merchantId' => $MerchantID,
                        'orderId' => $OrderId,
                        'currencyCode' => '050',
                        'amount' => $amount,
                        'challenge' => $randomServer
                    );

                    $merchantAdditionalInfo = '{"Service Name": "Sheba.xyz"}';

                    $PostDataOrder = array(
                        'sensitiveData' => EncryptDataWithPublicKey(json_encode($SensitiveDataOrder)),
                        'signature' => SignatureGenerate(json_encode($SensitiveDataOrder)),
                        'merchantCallbackURL' => $merchantCallbackURL,
                        'additionalMerchantInfo' => json_decode($merchantAdditionalInfo)
                    );
                    // dd($PostDataOrder);

                    $OrderSubmitUrl = "https://api.mynagad.com/api/dfs/check-out/complete/" . $paymentReferenceId;
                    // dd($OrderSubmitUrl);
                    $Result_Data_Order = HttpPostMethod($OrderSubmitUrl, $PostDataOrder);
                    if ($Result_Data_Order['status'] == "Success") {

                        // $me = Auth::user();
                        // $subscribe = $me->subscriptions->first();
                        // //model
                        // $order = new Order;
                        // $order->user_id = $me->id;
                        // $order->work_station_id = $subscribe->work_station_id;
                        // $order->subscriber_id = $subscribe->id;
                        // $order->paid_amount = $amount;
                        // $order->name = $me->name;
                        // $order->mobile = $me->mobile;
                        // $order->inv_id = $invoiceNum;
                        // $order->order_for = 'nagad';
                        // $order->order_status = 'nagad';
                        // $order->payment_status = 'unpaid';
                        // $order->pending_at = Carbon::now();
                        // $order->save();
                        //model

                        $url = json_encode($Result_Data_Order['callBackUrl']);
                        echo "<script>window.open($url, '_self')</script>";
                    } else {
                        echo json_encode($Result_Data_Order);
                    }
                } else {
                    echo json_encode($PlainResponse);
                }
            }
        }
        //end nagad
    }

    ///For add money
    // public function addNagadMoney($amount)
    // {
    //     //Invoice
    //     $nagadID = Order::orderBy('id', 'DESC')->pluck('id')->first();
    //     $invo =$nagadID.rand(100,500);
    //     $invoiceNum = $order_id;


    //     //
    //     function generateRandomString($length = 40)
    //     {
    //         $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //         $charactersLength = strlen($characters);
    //         $randomString = '';
    //         for ($i = 0; $i < $length; $i++) {
    //             $randomString .= $characters[rand(0, $charactersLength - 1)];
    //         }
    //         return $randomString;
    //     }

    //     function EncryptDataWithPublicKey($data)
    //     {
    //         $pgPublicKey = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAjBH1pFNSSRKPuMcNxmU5jZ1x8K9LPFM4XSu11m7uCfLUSE4SEjL30w3ockFvwAcuJffCUwtSpbjr34cSTD7EFG1Jqk9Gg0fQCKvPaU54jjMJoP2toR9fGmQV7y9fz31UVxSk97AqWZZLJBT2lmv76AgpVV0k0xtb/0VIv8pd/j6TIz9SFfsTQOugHkhyRzzhvZisiKzOAAWNX8RMpG+iqQi4p9W9VrmmiCfFDmLFnMrwhncnMsvlXB8QSJCq2irrx3HG0SJJCbS5+atz+E1iqO8QaPJ05snxv82Mf4NlZ4gZK0Pq/VvJ20lSkR+0nk+s/v3BgIyle78wjZP1vWLU4wIDAQAB";
    //         $public_key = "-----BEGIN PUBLIC KEY-----\n" . $pgPublicKey . "\n-----END PUBLIC KEY-----";

    //         $key_resource = openssl_get_publickey($public_key);
    //         openssl_public_encrypt($data, $cryptText, $key_resource);
    //         return base64_encode($cryptText);
    //     }



    //     function SignatureGenerate($data)
    //     {
    //         $merchantPrivateKey = "MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCJakyLqojWTDAVUdNJLvuXhROV+LXymqnukBrmiWwTYnJYm9r5cKHj1hYQRhU5eiy6NmFVJqJtwpxyyDSCWSoSmIQMoO2KjYyB5cDajRF45v1GmSeyiIn0hl55qM8ohJGjXQVPfXiqEB5c5REJ8Toy83gzGE3ApmLipoegnwMkewsTNDbe5xZdxN1qfKiRiCL720FtQfIwPDp9ZqbG2OQbdyZUB8I08irKJ0x/psM4SjXasglHBK5G1DX7BmwcB/PRbC0cHYy3pXDmLI8pZl1NehLzbav0Y4fP4MdnpQnfzZJdpaGVE0oI15lq+KZ0tbllNcS+/4MSwW+afvOw9bazAgMBAAECggEAIkenUsw3GKam9BqWh9I1p0Xmbeo+kYftznqai1pK4McVWW9//+wOJsU4edTR5KXK1KVOQKzDpnf/CU9SchYGPd9YScI3n/HR1HHZW2wHqM6O7na0hYA0UhDXLqhjDWuM3WEOOxdE67/bozbtujo4V4+PM8fjVaTsVDhQ60vfv9CnJJ7dLnhqcoovidOwZTHwG+pQtAwbX0ICgKSrc0elv8ZtfwlEvgIrtSiLAO1/CAf+uReUXyBCZhS4Xl7LroKZGiZ80/JE5mc67V/yImVKHBe0aZwgDHgtHh63/50/cAyuUfKyreAH0VLEwy54UCGramPQqYlIReMEbi6U4GC5AQKBgQDfDnHCH1rBvBWfkxPivl/yNKmENBkVikGWBwHNA3wVQ+xZ1Oqmjw3zuHY0xOH0GtK8l3Jy5dRL4DYlwB1qgd/Cxh0mmOv7/C3SviRk7W6FKqdpJLyaE/bqI9AmRCZBpX2PMje6Mm8QHp6+1QpPnN/SenOvoQg/WWYM1DNXUJsfMwKBgQCdtddE7A5IBvgZX2o9vTLZY/3KVuHgJm9dQNbfvtXw+IQfwssPqjrvoU6hPBWHbCZl6FCl2tRh/QfYR/N7H2PvRFfbbeWHw9+xwFP1pdgMug4cTAt4rkRJRLjEnZCNvSMVHrri+fAgpv296nOhwmY/qw5Smi9rMkRY6BoNCiEKgQKBgAaRnFQFLF0MNu7OHAXPaW/ukRdtmVeDDM9oQWtSMPNHXsx+crKY/+YvhnujWKwhphcbtqkfj5L0dWPDNpqOXJKV1wHt+vUexhKwus2mGF0flnKIPG2lLN5UU6rs0tuYDgyLhAyds5ub6zzfdUBG9Gh0ZrfDXETRUyoJjcGChC71AoGAfmSciL0SWQFU1qjUcXRvCzCK1h25WrYS7E6pppm/xia1ZOrtaLmKEEBbzvZjXqv7PhLoh3OQYJO0NM69QMCQi9JfAxnZKWx+m2tDHozyUIjQBDehve8UBRBRcCnDDwU015lQN9YNb23Fz+3VDB/LaF1D1kmBlUys3//r2OV0Q4ECgYBnpo6ZFmrHvV9IMIGjP7XIlVa1uiMCt41FVyINB9SJnamGGauW/pyENvEVh+ueuthSg37e/l0Xu0nm/XGqyKCqkAfBbL2Uj/j5FyDFrpF27PkANDo99CdqL5A4NQzZ69QRlCQ4wnNCq6GsYy2WEJyU2D+K8EBSQcwLsrI7QL7fvQ==";
    //         $private_key = "-----BEGIN RSA PRIVATE KEY-----\n" . $merchantPrivateKey . "\n-----END RSA PRIVATE KEY-----";

    //         openssl_sign($data, $signature, $private_key, OPENSSL_ALGO_SHA256);
    //         return base64_encode($signature);
    //     }



    //     function HttpPostMethod($PostURL, $PostData)
    //     {
    //         $url = curl_init($PostURL);
    //         $postToken = json_encode($PostData);
    //         $header = array(
    //             'Content-Type:application/json',
    //             'X-KM-Api-Version:v-0.2.0',
    //             'X-KM-IP-V4:' . get_client_ip(),
    //             'X-KM-Client-Type:PC_WEB'
    //         );

    //         curl_setopt($url, CURLOPT_HTTPHEADER, $header);
    //         curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
    //         curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
    //         curl_setopt($url, CURLOPT_POSTFIELDS, $postToken);
    //         curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
    //         curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
    //         // curl_setopt($url, CURLOPT_HEADER, 1); 

    //         $resultData = curl_exec($url);
    //         $ResultArray = json_decode($resultData, true);
    //         $header_size = curl_getinfo($url, CURLINFO_HEADER_SIZE);
    //         curl_close($url);
    //         $headers = substr($resultData, 0, $header_size);
    //         $body = substr($resultData, $header_size);
    //         print_r($body);
    //         print_r($headers);
    //         return $ResultArray;
    //     }

    //     function get_client_ip()
    //     {
    //         $ipaddress = '';
    //         if (isset($_SERVER['HTTP_CLIENT_IP']))
    //             $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    //         else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    //             $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    //         else if (isset($_SERVER['HTTP_X_FORWARDED']))
    //             $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    //         else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
    //             $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    //         else if (isset($_SERVER['HTTP_FORWARDED']))
    //             $ipaddress = $_SERVER['HTTP_FORWARDED'];
    //         else if (isset($_SERVER['REMOTE_ADDR']))
    //             $ipaddress = $_SERVER['REMOTE_ADDR'];
    //         else
    //             $ipaddress = 'UNKNOWN';
    //         return $ipaddress;
    //     }

    //     function DecryptDataWithPrivateKey($cryptText)
    //     {
    //         $merchantPrivateKey = "MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCJakyLqojWTDAVUdNJLvuXhROV+LXymqnukBrmiWwTYnJYm9r5cKHj1hYQRhU5eiy6NmFVJqJtwpxyyDSCWSoSmIQMoO2KjYyB5cDajRF45v1GmSeyiIn0hl55qM8ohJGjXQVPfXiqEB5c5REJ8Toy83gzGE3ApmLipoegnwMkewsTNDbe5xZdxN1qfKiRiCL720FtQfIwPDp9ZqbG2OQbdyZUB8I08irKJ0x/psM4SjXasglHBK5G1DX7BmwcB/PRbC0cHYy3pXDmLI8pZl1NehLzbav0Y4fP4MdnpQnfzZJdpaGVE0oI15lq+KZ0tbllNcS+/4MSwW+afvOw9bazAgMBAAECggEAIkenUsw3GKam9BqWh9I1p0Xmbeo+kYftznqai1pK4McVWW9//+wOJsU4edTR5KXK1KVOQKzDpnf/CU9SchYGPd9YScI3n/HR1HHZW2wHqM6O7na0hYA0UhDXLqhjDWuM3WEOOxdE67/bozbtujo4V4+PM8fjVaTsVDhQ60vfv9CnJJ7dLnhqcoovidOwZTHwG+pQtAwbX0ICgKSrc0elv8ZtfwlEvgIrtSiLAO1/CAf+uReUXyBCZhS4Xl7LroKZGiZ80/JE5mc67V/yImVKHBe0aZwgDHgtHh63/50/cAyuUfKyreAH0VLEwy54UCGramPQqYlIReMEbi6U4GC5AQKBgQDfDnHCH1rBvBWfkxPivl/yNKmENBkVikGWBwHNA3wVQ+xZ1Oqmjw3zuHY0xOH0GtK8l3Jy5dRL4DYlwB1qgd/Cxh0mmOv7/C3SviRk7W6FKqdpJLyaE/bqI9AmRCZBpX2PMje6Mm8QHp6+1QpPnN/SenOvoQg/WWYM1DNXUJsfMwKBgQCdtddE7A5IBvgZX2o9vTLZY/3KVuHgJm9dQNbfvtXw+IQfwssPqjrvoU6hPBWHbCZl6FCl2tRh/QfYR/N7H2PvRFfbbeWHw9+xwFP1pdgMug4cTAt4rkRJRLjEnZCNvSMVHrri+fAgpv296nOhwmY/qw5Smi9rMkRY6BoNCiEKgQKBgAaRnFQFLF0MNu7OHAXPaW/ukRdtmVeDDM9oQWtSMPNHXsx+crKY/+YvhnujWKwhphcbtqkfj5L0dWPDNpqOXJKV1wHt+vUexhKwus2mGF0flnKIPG2lLN5UU6rs0tuYDgyLhAyds5ub6zzfdUBG9Gh0ZrfDXETRUyoJjcGChC71AoGAfmSciL0SWQFU1qjUcXRvCzCK1h25WrYS7E6pppm/xia1ZOrtaLmKEEBbzvZjXqv7PhLoh3OQYJO0NM69QMCQi9JfAxnZKWx+m2tDHozyUIjQBDehve8UBRBRcCnDDwU015lQN9YNb23Fz+3VDB/LaF1D1kmBlUys3//r2OV0Q4ECgYBnpo6ZFmrHvV9IMIGjP7XIlVa1uiMCt41FVyINB9SJnamGGauW/pyENvEVh+ueuthSg37e/l0Xu0nm/XGqyKCqkAfBbL2Uj/j5FyDFrpF27PkANDo99CdqL5A4NQzZ69QRlCQ4wnNCq6GsYy2WEJyU2D+K8EBSQcwLsrI7QL7fvQ==";
    //         $private_key = "-----BEGIN RSA PRIVATE KEY-----\n" . $merchantPrivateKey . "\n-----END RSA PRIVATE KEY-----";
    //         openssl_private_decrypt(base64_decode($cryptText), $plain_text, $private_key);
    //         return $plain_text;
    //     }
    //     //index
    //     session_start();

    //     date_default_timezone_set('Asia/Dhaka');

    //     $MerchantID = "683002007104225";
    //     $DateTime = Date('YmdHis');
    //     $amount = $amount;
    //     $OrderId = $invoiceNum;
    //     $random = generateRandomString();

    //     $PostURL = "http://sandbox.mynagad.com:10080/remote-payment-gateway-1.0/api/dfs/check-out/initialize/" . $MerchantID . "/" . $OrderId;

    //     $_SESSION['orderId'] = $OrderId;

    //     $merchantCallbackURL = "http://softcodeltd.test/mypanel/user/balance/info";

    //     $SensitiveData = array(
    //         'merchantId' => $MerchantID,
    //         'datetime' => $DateTime,
    //         'orderId' => $OrderId,
    //         'challenge' => $random
    //     );

    //     $PostData = array(
    //         'accountNumber' => '01886279048', //Replace with Merchant Number
    //         'dateTime' => $DateTime,
    //         'sensitiveData' => EncryptDataWithPublicKey(json_encode($SensitiveData)),
    //         'signature' => SignatureGenerate(json_encode($SensitiveData))
    //     );

    //     $Result_Data = HttpPostMethod($PostURL, $PostData);


    //     if (isset($Result_Data['sensitiveData']) && isset($Result_Data['signature'])) {
    //         if ($Result_Data['sensitiveData'] != "" && $Result_Data['signature'] != "") {

    //             $PlainResponse = json_decode(DecryptDataWithPrivateKey($Result_Data['sensitiveData']), true);


    //             if (isset($PlainResponse['paymentReferenceId']) && isset($PlainResponse['challenge'])) {


    //                 $paymentReferenceId = $PlainResponse['paymentReferenceId'];


    //                 $randomServer = $PlainResponse['challenge'];

    //                 $SensitiveDataOrder = array(
    //                     'merchantId' => $MerchantID,
    //                     'orderId' => $OrderId,
    //                     'currencyCode' => '050',
    //                     'amount' => $amount,
    //                     'challenge' => $randomServer
    //                 );

    //                 $merchantAdditionalInfo = '{"Service Name": "Sheba.xyz"}';

    //                 $PostDataOrder = array(
    //                     'sensitiveData' => EncryptDataWithPublicKey(json_encode($SensitiveDataOrder)),
    //                     'signature' => SignatureGenerate(json_encode($SensitiveDataOrder)),
    //                     'merchantCallbackURL' => $merchantCallbackURL,
    //                     'additionalMerchantInfo' => json_decode($merchantAdditionalInfo)
    //                 );
    //                 // dd("hello");

    //                 $OrderSubmitUrl = "http://sandbox.mynagad.com:10080/remote-payment-gateway-1.0/api/dfs/check-out/complete/" . $paymentReferenceId;
    //                 $Result_Data_Order = HttpPostMethod($OrderSubmitUrl, $PostDataOrder);
    //                 if ($Result_Data_Order['status'] == "Success") {

    //                     // $me = Auth::user();
    //                     // $subscribe = $me->subscriptions->first();
    //                     // //model
    //                     // $order = new Order;
    //                     // $order->user_id = $me->id;
    //                     // $order->work_station_id = $subscribe->work_station_id;
    //                     // $order->subscriber_id = $subscribe->id;
    //                     // $order->paid_amount = $amount;
    //                     // $order->name = $me->name;
    //                     // $order->mobile = $me->mobile;
    //                     // $order->inv_id = $invoiceNum;
    //                     // $order->order_for = 'nagad';
    //                     // $order->order_status = 'nagad';
    //                     // $order->payment_status = 'unpaid';
    //                     // $order->pending_at = Carbon::now();
    //                     // $order->save();
    //                     //model
    //                     session()->put('type', $type);
    //                     $url = json_encode($Result_Data_Order['callBackUrl']);
    //                     echo "<script>window.open($url, '_self')</script>";
    //                 } else {
    //                     echo json_encode($Result_Data_Order);
    //                 }
    //             } else {
    //                 echo json_encode($PlainResponse);
    //             }
    //         }
    //     }
    //     //end nagad
    // }
}
