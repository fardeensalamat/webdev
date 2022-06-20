<?php

namespace App\Http\Controllers\User\Withdraw;

use Auth;
use Validator;
use App\Models\AdminBalance;
use App\Models\BalanceTransaction;
use App\Http\Controllers\Controller;
use App\Models\WebsiteParameter;
use App\Models\WithdrawalList;
use Illuminate\Http\Request;
use App\Models\OrderNotifications;

class UserBalanceWithdrawController extends Controller
{
    public function commissionWithdraw()
    {
        // $brs = Branch::select(['id','branch_code', 'mobile'])->orderBy('branch_code')->get();
        $user = Auth::user();
        if ($user->withdraw_lock==1) {
            return back()->with('error', 'Sorry, You can not withdraw your balance.Please contact with Administrator.');
        }
        if ($user->wallet_lock) {
            return back()->with('error', 'Sorry, You can not withdraw your balance.Please contact with Administrator.');
        }
        return view('user.withdraw.commissionWithdraw', [
            'user' => $user
        ]);
    }

    public function pinCheck(Request $request)
    {
        $validation = Validator::make($request->all(), [
            // 'member_code' => 'required|unique:users,username|unique:member_accounts,member_code|min:3|max:20|string|alpha_dash',
            'pin' => 'required|string|min:4|max:4'
        ]);
        $errors = $validation->errors()->toArray();
        $errors['pin'] = 'Click for new pin';
        if ($validation->fails()) {
            if ($request->ajax()) {
                return Response()->json(array(
                    'success' => false,
                    'errors' => $errors,
                    'feedback' => 'Incorrect PIN Code'
                ));
            }
        }
        $me = Auth::user();
        if ($me->pin) {
            if ($request->pin == $me->pin) {
                if ($request->ajax()) {
                    return Response()->json(array(
                        'success' => true,
                        'feedback' => 'Success!'
                    ));
                }
            } else {
                if ($request->ajax()) {
                    return Response()->json(array(
                        'success' => false,
                        'errors' => $errors,
                        'feedback' => 'Your PIN Code is incorrect'
                    ));
                }
            }
        } else {
            if ($request->ajax()) {
                return Response()->json(array(
                    'success' => false,
                    'errors' => $errors,
                    'feedback' => 'Your PIN Code not set yet'
                ));
            }
        }
        // if($request->ajax())
        // {
        //     return Response()->json(array(
        //     'success' => true,
        //     'feedback' => 'Available'
        //     ));
        // }
    }

    public function newPinSend(Request $request)
    {

        $me = Auth::user();
        // $member = $me->memberAccount;
        $me->pin = rand(1000, 9999);
        $me->save();
        $me->smsWithNewPinSend($me->pin);
        if ($request->ajax()) {
            return Response()->json(array(
                'success' => true,
                'feedback' => "Success! Your new pin sent to your mobile {$me->mobile}. Please, use this pin code in your 4 digit pin code field."
            ));
        }
    }

    public function commissionWithdrawPost(Request $request)
    {

        // dd($request->all());
        $recharge_permission = WebsiteParameter::first()->recharge_permission;
        $me = Auth::user();
        $max = (int) $me->balance;

        if ($request->cashout_from == 'mobile_recharge') {
            $max = $max < 1000 ? $max : 1000;
            $validation = Validator::make($request->all(), [
                'cashout_from' => 'required',
                'mobile_number' => 'required|min:11|max:13',
                'recharge_amount' => 'required|numeric|min:10|max:' . $max,
                'pin_for_recharge' => 'required|string|min:4|max:4'
            ]);
            if ($validation->fails()) {
                return back()
                    ->withErrors($validation)
                    ->withInput()
                    ->with('error', 'Please, Enter Bangladeshi mobile number, recharge amount, and correct pin code for cashout from mobile recharge.');
            }
            if ($request->pin_for_recharge != $me->pin) {
                return back()->with('error', 'Your PIN Code is wrong');
            }
            $number = bdMobileWithoutCode($request->mobile_number);
            if (strlen($number) != 11) {
                return back();
            }
            $rechargeAmount = (int) $request->recharge_amount;

            if ($rechargeAmount <= 100) {
                $charge = 2;
                $rechargeAmount = $rechargeAmount - $charge;
            } elseif ($rechargeAmount > 100) {
                $charge = 5;
                $rechargeAmount = $rechargeAmount - $charge;
            }
            //dd($recharge_permission);
            if ($recharge_permission == 'online') {
                $rechargeAmount = (int) $request->recharge_amount;

                $result = $me->mobileRecharge($number, $rechargeAmount, $request->recharge_type);
               // dd($result);
                if ($result == 'Success') {
                    $success = 1;
                } else {
                    $success = 0;
                }

               // dd($success);
                if ($success) {
                    $details = "Mobile Recharge request for Number {$request->mobile_number} amount tk {$rechargeAmount} received, type {$request->recharge_type}";
                    // Debit Charge and Transection Start
                    // $oldBalance = $me->balance;
                    // $me->balance =  $oldBalance - $charge;
                    // $me->save();
                    // $newBalance = $me->balance;


                    // $ms = "Successfully TK " . $charge . " Charge for recharge {$rechargeAmount} Taka. Thank you for using softcommerce mobile recharge solution.";
                    // $bt = new BalanceTransaction;
                    // $bt->subscriber_id = null;
                    // $bt->from = 'user';
                    // $bt->to = 'admin';
                    // $bt->purpose = 'withdraw_charge';
                    // $bt->user_id = $me->id;
                    // $bt->previous_balance = $oldBalance;  // old balance
                    // $bt->moved_balance = $charge; // rechargeAmount $number
                    // $bt->new_balance = $newBalance; // ajb - ra
                    // $bt->type = 'mobile_recharge';
                    // $bt->details = $ms;
                    // $bt->addedby_id = Auth::id();
                    // $bt->save();
                    // Debit Charge and Transection End

                    // Debit Recharge Ammount With Transection Start 
                    $oldBalance = $me->balance;
                    $me->balance =  $oldBalance - $rechargeAmount;
                    $me->save();
                    $newBalance = $me->balance;
                    $ms = "Successfully TK " . $rechargeAmount . " recharged in {$request->mobile_number}. Thank you for using Soft Commerce mobile recharge solution.";

                    // bt will be here
                    $bt = new BalanceTransaction;
                    $bt->subscriber_id = null;
                    $bt->from = 'user';
                    $bt->to = 'user';
                    $bt->purpose = 'withdraw';
                    $bt->user_id = $me->id;
                    $bt->previous_balance = $oldBalance;  // old balance
                    $bt->moved_balance = $rechargeAmount; // rechargeAmount $number
                    $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // ajb - ra
                    $bt->type = 'mobile_recharge';
                    $bt->details = $ms;

                    $bt->addedby_id = Auth::id();
                    $bt->save();
                    // Debit Recharge Ammount With Transection End 

                    return back()->with('success', $ms);
                } else {
                    $ms = 'Sorry, We can not proceed your request right now. Please, try again later. Thank you';
                    return back()->with('info', $ms);
                }
                // return back()->with('error', $ms);
            } else {

                // Debit Charge and Transection Start
                $oldBalance = $me->balance;
                $me->balance =  $oldBalance - $charge;
                $me->save();
                $newBalance = $me->balance;


                $ms = "Successfully TK " . $charge . " Charge for recharge {$rechargeAmount} Taka. Thank you for using softcode mobile recharge solution.";
                $bt = new BalanceTransaction;
                $bt->subscriber_id = null;
                $bt->from = 'user';
                $bt->to = 'admin';
                $bt->purpose = 'withdraw_charge';
                $bt->user_id = $me->id;
                $bt->previous_balance = $oldBalance;  // old balance
                $bt->moved_balance = $charge; // rechargeAmount $number
                $bt->new_balance = $newBalance; // ajb - ra
                $bt->type = 'mobile_recharge';
                $bt->details = $ms;
                $bt->addedby_id = Auth::id();
                $bt->save();
                // Debit Charge and Transection End

                // Debit Recharge Ammount With Transection and Create Withdrwal raw Start 
                $oldBalance = $me->balance;
                $me->balance = $oldBalance - $rechargeAmount;
                $me->save();
                $newBalance = $me->balance;

                $withdrowlList = new WithdrawalList;
                $withdrowlList->user_id = Auth::id();
                $withdrowlList->withdraw_type = $request->cashout_from;
                $withdrowlList->recharge_type = $request->recharge_type;
                $withdrowlList->mobile_number = $number;
                $withdrowlList->withdraw_charge = $charge;
                $withdrowlList->amount = $rechargeAmount;
                $withdrowlList->addedby_id = Auth::id();
                // dd($withdrowlList);
                $ms = "Mobile Recharge request for Number {$request->mobile_number} amount tk {$rechargeAmount} received, type {$request->recharge_type}";

                // bt will be here
                $bt = new BalanceTransaction;
                $bt->subscriber_id = null;
                $bt->from = 'user';
                $bt->to = 'user';
                $bt->purpose = 'withdraw';
                $bt->user_id = $me->id;
                $bt->previous_balance = $oldBalance;  // old balance
                $bt->moved_balance = $rechargeAmount; // rechargeAmount $number
                $bt->new_balance = $newBalance; // ajb - ra
                $bt->type = 'mobile_recharge';
                $bt->details = $ms;
                $bt->addedby_id = Auth::id();
                $bt->save();
                $withdrowlList->transaction_id = $bt->id;
                $withdrowlList->save();
                // Debit Recharge Ammount With Transection and Create Withdrwal raw Start 

                $ms = "Mobile Recharge request for Number {$request->mobile_number} amount tk {$rechargeAmount} received, type {$request->recharge_type}. As soon as possible you got the recharge. Thank you";
                // $ms = 'Your recharge is pending. As soon ass possible you got the recharge. Thank you';


                $notification1=new OrderNotifications;
                $notification1->type='withdraw';
                $notification1->title='Mobile Recharge Request';
                $notification1->messages= $ms;
                $notification1->details= $ms;
                $notification1->user_id= Auth::id();
                $notification1->status='1';
                $notification1->date=now();
                $notification1->link=$withdrowlList->id;
                $notification1->save();
            
                $notification2=new OrderNotifications;
                $notification2->type='admin';
                $notification2->title='Mobile Recharge Request';
                $notification2->messages= "Mobile recharge request from {$me->name}";
                $notification2->details="Mobile recharge request from {$me->name}.Mobile Recharge request for Number {$request->mobile_number} amount tk {$rechargeAmount} received";
                $notification2->user_id='3';
                $notification2->status='1';
                $notification2->date=now();
                $notification2->link=$withdrowlList->id;
                $notification2->save();




                return back()->with('success', $ms);
            }
        } elseif ($request->cashout_from == 'bkash') {
            $max = $max < 1000 ? $max : 25000;
            $validation = Validator::make($request->all(), [
                'cashout_from' => 'required',
                'cashin_number' => 'required|min:11|max:15',
                'bkash_amount' => 'required|numeric|min:50|max:' . $max,
                'pin_for_bkash' => 'required|string|min:4|max:4',
                'service_type' => 'required'
            ]);
            if ($validation->fails()) {
                return back()
                    ->withErrors($validation)
                    ->withInput()
                    ->with('error', 'Please, enter Bangladeshi mobile number (bkash,nagad,rocket personal number), cash-in amount, and correct pin code for cash-in.');
            }
            if ($request->pin_for_bkash != $me->pin) {
                return back()->with('error', 'Your PIN Code is wrong');
            }
            $number = bdMobileWithoutCode($request->cashin_number);


            if ((strlen($number) == 11) or (strlen($number) == 12)) {
                $rechargeAmount = (int) $request->bkash_amount;
                if ($rechargeAmount <= 100) {
                    $charge = 2;
                    $rechargeAmount = $rechargeAmount - $charge;
                } elseif ($rechargeAmount > 100) {
                    $charge = 5;
                    $rechargeAmount = $rechargeAmount - $charge;
                }

                // Debit Charge and Transection Start
                $oldBalance = $me->balance;
                $me->balance =  $oldBalance - $charge;
                $me->save();
                $newBalance = $me->balance;

                $ms = "Successfully TK " . $charge . " Charge for recharge {$rechargeAmount} Taka. Thank you for using Soft Commerce mobile recharge solution.";
                $bt = new BalanceTransaction;
                $bt->subscriber_id = null;
                $bt->from = 'user';
                $bt->to = 'admin';
                $bt->purpose = 'withdraw_charge';
                $bt->user_id = $me->id;
                $bt->previous_balance = $oldBalance;  // old balance
                $bt->moved_balance = $charge; // rechargeAmount $number
                $bt->new_balance = $newBalance; // ajb - ra
                $bt->type = 'online_banking';
                $bt->details = $ms;
                $bt->addedby_id = Auth::id();
                $bt->save();
                // Debit Charge and Transection End

                // Debit CashIn Ammount With Transection and Create Withdrwal raw Start 
                $details = "{$request->service_type} cashIn request for personal {$request->service_type} number {$request->cashin_number} amount tk {$rechargeAmount} received, type {$request->cashout_from}";

                $oldBalance = $me->balance;
                $me->balance = $oldBalance - $rechargeAmount;
                $me->save();
                $newBalance = $me->balance;

                $withdrowlList = new WithdrawalList;
                $withdrowlList->user_id = Auth::id();
                $withdrowlList->withdraw_type = 'online_banking';
                $withdrowlList->service_type = $request->service_type;
                $withdrowlList->mobile_number = $number;
                $withdrowlList->withdraw_charge = $charge;
                $withdrowlList->amount = $rechargeAmount;
                $withdrowlList->addedby_id = Auth::id();

                $ms = "Your Payment request listed successfully. TK {$rechargeAmount} {$request->service_type} will be CashIn {$request->cashin_number}. Thank you for using softcode payment solution.";

                // bt will be here
                $bt = new BalanceTransaction;
                $bt->subscriber_id = null;
                $bt->from = 'user';
                $bt->to = 'user';
                $bt->purpose = 'withdraw';
                $bt->user_id = $me->id;
                $bt->previous_balance = $oldBalance;  // old balance
                $bt->moved_balance = $rechargeAmount; // rechargeAmount $number
                $bt->new_balance = $newBalance; // ajb - ra
                $bt->type = $request->service_type;
                $bt->details = $ms;

                $bt->addedby_id = Auth::id();
                $bt->save();

                $withdrowlList->transaction_id = $bt->id;
                $withdrowlList->save();
                // Debit CashIn Ammount With Transection and Create Withdrwal raw End 



                $notification1=new OrderNotifications;
                $notification1->type='withdraw';
                $notification1->title='Payment Request';
                $notification1->messages= $ms;
                $notification1->details= $ms;
                $notification1->user_id= Auth::id();
                $notification1->status='1';
                $notification1->date=now();
                $notification1->link=$withdrowlList->id;
                $notification1->save();
            
                $notification2=new OrderNotifications;
                $notification2->type='admin';
                $notification2->title='Payment Request';
                $notification2->messages= "Payment request from {$me->name}";
                $notification2->details="Payment request from {$me->name}.TK {$rechargeAmount} {$request->service_type} will be CashIn {$request->cashin_number}";
                $notification2->user_id='3';
                $notification2->status='1';
                $notification2->date=now();
                $notification2->link=$withdrowlList->id;
                $notification2->save();

                return back()->with('success', $ms);
            } else {
                return back()->with('info', 'Please try again with correct receive number.');
            }
        } elseif ($request->cashout_from == 'bank_account') {
            $max = $max < 1000 ? $max : 25000;
            $validation = Validator::make($request->all(), [
                'cashout_from' => 'required',
                'bank_amount' => 'required|numeric|min:500|max:' . $max,
                'pin_for_bank' => 'required|string|min:4|max:4',
                'account_number' => 'required|numeric',
                'account_holder_name' => 'required',
                'bank_name' => 'required',
                'branch_name' => 'required',
                'details' => 'nullable',
            ]);
            if ($validation->fails()) {
                return back()
                    ->withErrors($validation)
                    ->withInput();
            }
            if ($request->pin_for_bank != $me->pin) {
                return back()->with('error', 'Your PIN Code is wrong');
            }

            $rechargeAmount = (int) $request->bank_amount;
            if ($rechargeAmount <= 100) {
                $charge = 2;
                $rechargeAmount = $rechargeAmount - $charge;
            } elseif ($rechargeAmount > 100) {
                $charge = 5;
                $rechargeAmount = $rechargeAmount - $charge;
            }

            // Debit Charge and Transection Start
            $oldBalance = $me->balance;
            $me->balance =  $oldBalance - $charge;
            $me->save();
            $newBalance = $me->balance;

            $ms = "Successfully TK " . $charge . " Charge for recharge {$rechargeAmount} Taka. Thank you for using Soft Commerce mobile recharge solution.";
            $bt = new BalanceTransaction;
            $bt->subscriber_id = null;
            $bt->from = 'user';
            $bt->to = 'admin';
            $bt->purpose = 'withdraw_charge';
            $bt->user_id = $me->id;
            $bt->previous_balance = $oldBalance;  // old balance
            $bt->moved_balance = $charge; // rechargeAmount $number
            $bt->new_balance = $newBalance; // ajb - ra
            $bt->type = 'online_banking';
            $bt->type_id = $me->id;
            $bt->details = $ms;
            $bt->addedby_id = Auth::id();
            $bt->save();
            // Debit Charge and Transection End
            // Debit Bank Transfer Ammount With Transection and Create Withdrwal raw End 
            $oldBalance = $me->balance;
            $me->balance = $oldBalance - $rechargeAmount;
            $me->save();
            $newBalance = $me->balance;
            $withdrowlList = new WithdrawalList;
            $withdrowlList->user_id = Auth::id();
            $withdrowlList->withdraw_type = 'bank_account';
            $withdrowlList->account_holder_name = $request->account_holder_name;
            $withdrowlList->bank_name = $request->bank_name;
            $withdrowlList->branch_name = $request->branch_name;
            $withdrowlList->details = $request->details;
            $withdrowlList->withdraw_charge = $charge;
            $withdrowlList->account_number = $request->account_number;
            $withdrowlList->amount = $rechargeAmount;
            $withdrowlList->addedby_id = Auth::id();
            $withdrowlList->paid_type = 'manual';
            $withdrowlList->status = 'pending';
            $ms = "Your Payment request listed successfully. As soon as possible {$rechargeAmount} SCB  will be Credit in you bank account  {$request->account_number}. Thank you for using softcode payment solution.";

            // bt will be here
            $bt = new BalanceTransaction;
            $bt->subscriber_id = null;
            $bt->from = 'user';
            $bt->to = 'user';
            $bt->purpose = 'withdraw';
            $bt->user_id = $me->id;
            $bt->previous_balance = $oldBalance;  // old balance
            $bt->moved_balance = $rechargeAmount; // rechargeAmount $number
            $bt->new_balance = $newBalance; // ajb - ra
            $bt->type = 'user';
            $bt->type_id = $me->id;
            $bt->details = $ms;

            $bt->addedby_id = Auth::id();
            $bt->save();

            $withdrowlList->transaction_id = $bt->id;
            $withdrowlList->save();
            // Debit Bank Transfer Ammount With Transection and Create Withdrwal raw End 

            $notification1=new OrderNotifications;
            $notification1->type='withdraw';
            $notification1->title='Payment Request';
            $notification1->messages= $ms;
            $notification1->details= $ms;
            $notification1->user_id= Auth::id();
            $notification1->status='1';
            $notification1->date=now();
            $notification1->link=$withdrowlList->id;
            $notification1->save();
        
            $notification2=new OrderNotifications;
            $notification2->type='admin';
            $notification2->title='Payment Request';
            $notification2->messages= "Payment request from {$me->name}";
            $notification2->details="Payment request from {$me->name}.{$rechargeAmount} SCB  will be Credit in you bank account  {$request->account_number}";
            $notification2->user_id='3';
            $notification2->status='1';
            $notification2->date=now();
            $notification2->link=$withdrowlList->id;
            $notification2->save();

            return back()->with('success', $ms);
        }elseif ($request->cashout_from == 'cash') {
            $max = $max < 1000 ? $max : 1000000;
            $validation = Validator::make($request->all(), [
                'cashout_from' => 'required',
                'cash_amount' => 'required|numeric|min:50|max:' . $max,
                'pin_for_cash' => 'required|string|min:4|max:4',
            ]);
            if ($validation->fails()) {
                return back()
                    ->withErrors($validation)
                    ->withInput();
            }
            if ($request->pin_for_cash != $me->pin) {
                return back()->with('error', 'Your PIN Code is wrong');
            }
              $rechargeAmount=$request->cash_amount;

                $oldBalance = $me->balance;
                $me->balance = $oldBalance - $rechargeAmount;
                $me->save();
                $newBalance = $me->balance;

                $withdrowlList = new WithdrawalList;
                $withdrowlList->user_id = Auth::id();
                $withdrowlList->withdraw_type = 'Cash';
                $withdrowlList->service_type = 'cash';
                $withdrowlList->mobile_number = $me->mobile;
                $withdrowlList->withdraw_charge = 0;
                $withdrowlList->amount = $rechargeAmount;
                $withdrowlList->addedby_id = Auth::id();

                $ms = "Your Payment request listed successfully. TK {$rechargeAmount} will be Cashout. Thank you for using soft commerce payment solution.";

                // bt will be here
                $bt = new BalanceTransaction;
                $bt->subscriber_id = null;
                $bt->from = 'user';
                $bt->to = 'user';
                $bt->purpose = 'withdraw';
                $bt->user_id = $me->id;
                $bt->previous_balance = $oldBalance;  // old balance
                $bt->moved_balance = $rechargeAmount; // rechargeAmount $number
                $bt->new_balance = $newBalance; // ajb - ra
                $bt->type = 'cash';
                $bt->details = $ms;

                $bt->addedby_id = Auth::id();
                $bt->save();

                $withdrowlList->transaction_id = $bt->id;
                $withdrowlList->save();
                // Debit CashIn Ammount With Transection and Create Withdrwal raw End 



                $notification1=new OrderNotifications;
                $notification1->type='withdraw';
                $notification1->title='Payment Request';
                $notification1->messages= $ms;
                $notification1->details= $ms;
                $notification1->user_id= Auth::id();
                $notification1->status='1';
                $notification1->date=now();
                $notification1->link=$withdrowlList->id;
                $notification1->save();
            
                $notification2=new OrderNotifications;
                $notification2->type='admin';
                $notification2->title='Payment Request';
                $notification2->messages= "Payment request from {$me->name}";
                $notification2->details="Payment request from {$me->name}.TK {$rechargeAmount}  will be Cashout";
                $notification2->user_id='3';
                $notification2->status='1';
                $notification2->date=now();
                $notification2->link=$withdrowlList->id;
                $notification2->save();

                return back()->with('success', $ms);
           
            
        }

        return back();
    }

    public function directwithdraw(Request $request)
    {
        $recharge_permission = WebsiteParameter::first()->recharge_permission;
        $me = Auth::user();
        $max = (int) $me->balance;
        $max = $max < 1000 ? $max : 25000;
        $validation = Validator::make($request->all(), [
            'service_type' => 'required',
            'cashin_number' => 'required|min:11|max:15',
            'bkash_amount' => 'required|numeric|min:50|max:' . $max,
        ]);
        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Please, enter Bangladeshi mobile number (bkash,nagad,rocket personal number), cash-in amount, and correct pin code for cash-in.');
        }
        $number = bdMobileWithoutCode($request->cashin_number);


        if ((strlen($number) == 11) or (strlen($number) == 12)) {
            $rechargeAmount = (int) $request->bkash_amount;
            if ($rechargeAmount <= 100) {
                $charge = 2;
                $rechargeAmount = $rechargeAmount - $charge;
            } elseif ($rechargeAmount > 100) {
                $charge = 5;
                $rechargeAmount = $rechargeAmount - $charge;
            }

            // Debit Charge and Transection Start
            $oldBalance = $me->balance;
            $me->balance =  $oldBalance - $charge;
            $me->save();
            $newBalance = $me->balance;

            $ms = "Successfully TK " . $charge . " Charge for recharge {$rechargeAmount} Taka. Thank you for using softcode mobile recharge solution.";
            $bt = new BalanceTransaction;
            $bt->subscriber_id = null;
            $bt->from = 'user';
            $bt->to = 'admin';
            $bt->purpose = 'withdraw_charge';
            $bt->user_id = $me->id;
            $bt->previous_balance = $oldBalance;  // old balance
            $bt->moved_balance = $charge; // rechargeAmount $number
            $bt->new_balance = $newBalance; // ajb - ra
            $bt->type = 'online_banking';
            $bt->details = $ms;
            $bt->addedby_id = Auth::id();
            $bt->save();
            // Debit Charge and Transection End

            // Debit CashIn Ammount With Transection and Create Withdrwal raw Start 
            $details = "{$request->service_type} cashIn request for personal {$request->service_type} number {$request->cashin_number} amount tk {$rechargeAmount} received, type {$request->service_type}";

            $oldBalance = $me->balance;
            $me->balance = $oldBalance - $rechargeAmount;
            $me->save();
            $newBalance = $me->balance;

            $withdrowlList = new WithdrawalList;
            $withdrowlList->user_id = Auth::id();
            $withdrowlList->withdraw_type = 'online_banking';
            $withdrowlList->service_type = $request->service_type;
            $withdrowlList->mobile_number = $number;
            $withdrowlList->withdraw_charge = $charge;
            $withdrowlList->amount = $rechargeAmount;
            $withdrowlList->addedby_id = Auth::id();

            $ms = "Your Payment request listed successfully. TK {$rechargeAmount} {$request->service_type} will be CashIn {$request->cashin_number}. Thank you for using softcode payment solution.";

            // bt will be here
            $bt = new BalanceTransaction;
            $bt->subscriber_id = null;
            $bt->from = 'user';
            $bt->to = 'user';
            $bt->purpose = 'withdraw';
            $bt->user_id = $me->id;
            $bt->previous_balance = $oldBalance;  // old balance
            $bt->moved_balance = $rechargeAmount; // rechargeAmount $number
            $bt->new_balance = $newBalance; // ajb - ra
            $bt->type = $request->service_type;
            $bt->details = $ms;

            $bt->addedby_id = Auth::id();
            $bt->save();

            $withdrowlList->transaction_id = $bt->id;
            $withdrowlList->save();
            // Debit CashIn Ammount With Transection and Create Withdrwal raw End 



            $notification1=new OrderNotifications;
            $notification1->type='withdraw';
            $notification1->title='Payment Request';
            $notification1->messages= $ms;
            $notification1->details= $ms;
            $notification1->user_id= Auth::id();
            $notification1->status='1';
            $notification1->date=now();
            $notification1->link=$withdrowlList->id;
            $notification1->save();
        
            $notification2=new OrderNotifications;
            $notification2->type='admin';
            $notification2->title='Payment Request';
            $notification2->messages= "Payment request from {$me->name}";
            $notification2->details="Payment request from {$me->name}.TK {$rechargeAmount} {$request->service_type} will be CashIn {$request->cashin_number}";
            $notification2->user_id='3';
            $notification2->status='1';
            $notification2->date=now();
            $notification2->link=$withdrowlList->id;
            $notification2->save();

            return back()->with('success', $ms);
        } else {
            return back()->with('info', 'Please try again with correct receive number.');
        }

    }


    public function commissionTransferStates(Request $request)
    {
        menuSubmenu('dashboard', 'commissionTransferStates');
        $me = Auth::user();
        $member = $me->memberAccount;
        $cts = $member->commissionTransfers()->latest()->paginate(100);
        return view('user.commissionTransferStates', ['states' => $cts]);
    }

    public function commissionWithdrawStates(Request $request)
    {
        menuSubmenu('dashboard', 'commissionWithdrawStates');
        $me = Auth::user();
        $member = $me->memberAccount;
        $cts = $member->cashouts()->whereStatus('paid')->latest()->paginate(100);
        return view('user.commissionWithdrawStates', ['states' => $cts]);
    }
}
