<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use Cookie;
use Validator;
use App\Models\User;
use App\Models\BalanceTransaction;
use App\Models\VerifiedData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SendSms;
use DB;

class UserCheckController extends Controller
{
     
    public function userCheckByMobile(Request $request)
    {
       $user =  User::where('mobile', $request->mobile)->count();
       

        $dialCode = substr($request->mobile, 0, 4);
        if($dialCode == '+880')
        {
            if(!$user)
            {
                $rcookie = $request->cookie('reffer');
                $cookie = $request->cookie('mobile_saved');
                if($cookie)
                {
                    Cookie::forget('mobile_saved');
                    
                }    
                
                $name = 'mobile_saved';
                $value = $request->mobile;
                $min = 60 * 24; //for one day;
                $cookie = cookie($name, $value, $min);
    
                $vd = VerifiedData::where('mobile', $request->mobile)
                ->where('user_id', null)
                ->first();
                if($vd)
                {
                    $vd->verify_code = $request->verification_code;
                    $vd->mobile_country = 'bd';
                    $vd->calling_code = '880';
                    $vd->country_name = 'Bangladesh (বাংলাদেশ)';
                    $vd->verified = 0;
                    $vd->save();
                }
                else
                {
                    $vd = new VerifiedData;
                    $vd->mobile = $request->mobile;
                    $vd->verify_code = $request->verification_code;
                    $vd->mobile_country = 'bd';
                    $vd->calling_code = '880';
                    $vd->country_name = 'Bangladesh (বাংলাদেশ)';
                    $vd->verified = 0;
                    $vd->save();
                }


                if($rcookie)
                {
                    $vd->reffer_code = $rcookie;
                    $vd->save();
                }
    
    
                //save mobile, country,currency, calling code
                // mobile
                // mobile_country
                // calling_code
                // currency_code
    
               if($request->ajax())
               {
                    return response()->json([
                        'success' => true,
                        'mobile' => $request->mobile,
                        'user' => 0,
                        'bdMobile' => true
                    ])->cookie($cookie);
               }
            }

        }
        $usercheck =  DB::table('users')->where('mobile',$request->mobile)->first();
       if($usercheck->active==0){
            if($request->ajax())
            {
            return response()->json([
                'usercheck' => 2,
            ]);
            }

       }

       if($request->ajax())
       {
        return response()->json([
            'mobile' => $request->mobile,
            'user' => $user > 0 ? true : false,
        ]);
       }

       return back();
    }

    public function loginByMobile(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'login_mobile' => 'required|exists:users,mobile',
            'login_password' => 'required|string|min:8',
        ]);

        if($validation->fails())
        {
            if($request->ajax())
            {
                return Response()->json(array(
                'success' => false,
                'errors' => $validation->errors()->toArray()
                ));
            }
        }

        $remember = true;

        if (Auth::attempt(['mobile' => $request->login_mobile, 'password' => $request->login_password], $remember)) 
        {
            // The user is being logging and remembered...
            $request->session()->regenerate();

            $user = Auth::user();

            if($user->isAdmin())
            {
                $url = route('admin.dashboard');
            }
            else
            {
                $url =  route('user.dashboard');
            }

            if($request->ajax())
            {
                return Response()->json(array(
                'success' => true,
                'url' => $url
                ));
            }
        }
        else
        {
            if($request->ajax())
            {
                return Response()->json(array(
                'success' => false,
                'errors' => ['login'=> 'Your mobile number and password did not match']
                ));
            }
        }
    }

    public function saveNewMobile(Request $request)
    {
        // dd($request->all());
        $user = User::where('mobile', $request->register_mobile)->first();
        if(!$user)
        {
            $rcookie = $request->cookie('reffer');
            $cookie = $request->cookie('mobile_saved');
            if($cookie)
            {
           
                Cookie::forget('mobile_saved');

            }    
            
            $name = 'mobile_saved';
            $value = $request->register_mobile;
            $min = 60 * 24; //for one day;
            $cookie = cookie($name, $value, $min);

            $vd = VerifiedData::where('mobile', $request->register_mobile)
            ->where('user_id', null)
            ->first();
            if($vd)
            {
                $vd->verify_code = $request->verification_code;
                $vd->mobile_country = $request->mobile_country;
                $vd->calling_code = $request->calling_code;
                $vd->country_name = $request->country_name;
                $vd->verified = 1;
                $vd->save();
            }
            else
            {
                $vd = new VerifiedData;
                $vd->mobile = $request->register_mobile;
                $vd->verify_code = $request->verification_code;
                $vd->mobile_country = $request->mobile_country;
                $vd->calling_code = $request->calling_code;
                $vd->country_name = $request->country_name;
                $vd->verified = 1;
                $vd->save();
            }

            if($rcookie)
            {
                $vd->reffer_code = $rcookie;
                $vd->save();
            }


            //save mobile, country,currency, calling code
            // mobile
            // mobile_country
            // calling_code
            // currency_code

           if($request->ajax())
           {
                return response()->json([
                    'success' => true
                ])->cookie($cookie);
           }
        }

       if($request->ajax())
       {
        return response()->json([
            'success' => false,
        ]);
       }

       return back();
    }

    public function passwordSaveByMobile(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'password' => 'required|string|confirmed|min:8|max:60|',
            'verified_mobile' => 'required|exists:users,mobile'
        ]);

        if($validation->fails())
        {
            if($request->ajax())
            {
                return Response()->json(array(
                'success' => false,
                'errors' => $validation->errors()->toArray()
                ));
            }
        }

        $user = User::where('mobile', $request->verified_mobile)->first();

        if($user){

            $me=$user;
            if($me->balance>2){
                $me->decrement('balance', 2);
                $bt = new BalanceTransaction;
                $bt->from = 'user';
                $bt->to = 'admin';
                $bt->purpose = 'update_pin';
                $bt->subscriber_id = $me->subscriptions->first()->id;
                $bt->user_id = $me->id;
                $bt->previous_balance = $me->balance;  // user old balance
                $bt->moved_balance = 2; // job cost
                $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
                $bt->type = 'user';
                $bt->details = "Dear {$me->name}, Your Password Change Charge";
                $bt->type_id = $me->id;
                $bt->addedby_id = $me->id;
                $bt->save();

            }else{
                $me->increment('due_balance', 2);
                $bt = new BalanceTransaction;
                $bt->from = 'user';
                $bt->to = 'admin';
                $bt->purpose = 'update_pin';
                $bt->subscriber_id = $me->subscriptions->first()->id;
                $bt->user_id = $me->id;
                $bt->previous_balance = $me->balance;  // user old balance
                $bt->moved_balance = 0; // job cost
                $bt->new_balance = $me->balance; // user new balance
                $bt->type = 'user';
                $bt->details = "Dear {$me->name}, Your Password Change Charge. And your due balance add 2 SCB";
                $bt->type_id = $me->id;
                $bt->addedby_id = $me->id;
                $bt->save();

            }
          

        }

        

        if($user)
        {
            $me = $user;
            $me->password = Hash::make($request->password);
            $me->save();

            $remember = true;

            if (Auth::attempt(['mobile' => $me->mobile, 'password' => $request->password], $remember)) 
            {
                // The user is being logging and remembered...
                        $request->session()->regenerate();

                        $user = Auth::user();

                        if($user->isAdmin())
                        {
                            $url = route('admin.dashboard');
                        }
                        else
                        {
                            $url =  route('user.dashboard');
                        }

                        if($request->ajax())
                        {
                            return Response()->json(array(
                            'success' => true,
                            'url' => $url
                            ));
                        }
            }
        }


    }


    public function registerByMobile(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'full_name' => 'required|string|min:3',
            'password' => 'required|string|confirmed|min:8|max:60|',
        ]);

        if($validation->fails())
        {
            if($request->ajax())
            {
                return Response()->json(array(
                'success' => false,
                'errors' => $validation->errors()->toArray()
                ));
            }
        }

        $number = $request->cookie('mobile_saved');
        $user = User::where('mobile', $number)->first();

        if(!$number)
        {
            if($request->ajax())
            {
                return Response()->json(array(
                'success' => false,
                'errors' => $validation->errors()->toArray(),
                'errors' => ['mobile_number'=> 'Try again using mobile number']
                ));
            }
        }

        if(!$user)
        {
            $me = new User;
            $me->name = $request->full_name;
            $me->mobile = $number;
            $me->password = Hash::make($request->password);

            $vd = VerifiedData::where('mobile', $me->mobile)->first();
            if($vd)
            {
                $me->mobile_verified_at = now();
                // $me->mobile_verify_code = $vd->verify_code;
                $me->mobile_country = $vd->mobile_country;
                $me->calling_code = $vd->calling_code;
                $me->save();
                
                $vd->user_id = $me->id;
                $vd->save();
            }else
            {
                $me->save();
            }

            $number=$me->mobile;
            $messages= "Dear {$me->name}, Thank you for joining with us. Please visit our site www.sc-bd.com. From Soft Commerce.";

            //$me->sendSingleMessage($number,$messages);
            $SendSms=new SendSms;
            try { 
                // Send a message using the primary device.
                $msg = $SendSms->sendSingleMessage($number,$messages);

            } catch (Exception $e) {
                echo $e->getMessage();
            }

            $remember = true;

            if (Auth::attempt(['mobile' => $me->mobile, 'password' => $request->password], $remember)) 
            {
                // The user is being logging and remembered...
                $request->session()->regenerate();

                if($request->ajax())
                {
                    return Response()->json(array(
                    'success' => true,
                    'url' =>  route('user.dashboard'),
                    ))->withCookie(Cookie::forget('mobile_saved'))->withCookie( Cookie::forget('reffer'));
                }
            }
        }


        if($request->ajax())
       {
        return response()->json([
            'success' => false,
        ]);
       }

       return back();
    }

    public function unsaveMobile(Request $request)
    {
        $cookie = $request->cookie('mobile_saved');
        if($cookie)
        {
       
            return back()->withCookie(Cookie::forget('mobile_saved'));

        } 

        return back()->withCookie(Cookie::forget('mobile_saved'));
    }

    public function passwordRecoverByMobile(Request $request)
    {
        return view('auth.passwordRecoverByMobile');
    }
}
