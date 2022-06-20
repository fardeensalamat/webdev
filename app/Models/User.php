<?php

namespace App\Models;

use DB;
use App\Models\Sms;
use App\Models\Post;
use GuzzleHttp\Client;
use App\Scopes\ActiveScope;
use App\Models\WebsiteParameter;
use Laravel\Passport\HasApiTokens;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'password_temp',
        'active',
        'user_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->hasMany('App\Models\UserRole', 'user_id');
    }
    public function roleItems()
    {
        return $this->hasMany('App\Models\UserRoleItem', 'user_id');
    }
    // public function isCommonWithoutAdmin()
    // {
    //     if($this->roles()->where('role_name', 'common')->where('role_value', '<>', 'Admin')->first())
    //     {
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }
    // }
    public function serviceProfile()
    {
        return $this->hasMany(ServiceProfile::class, 'user_id');
    }
    public function havBizProfile($cat)
    {
        return $this->serviceProfile()
            ->where('profile_type', 'business')
            // ->where('workstation_id',$ss)
            ->where('ws_cat_id', $cat)
            ->where('status', true)
            ->first();
    }
    public function bids()
    {
        return $this->hasMany(Bid::class, 'user_id');
    }
    public function bidded($need)
    {
        return $this->bids()
            ->where('need_id', $need)
            ->first();
    }
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope);
        //'active = 1'
    }

    public function isAdmin()
    {

        if ($this->roles()->where('role_name', 'admin')->first()) {
            return true;
        } else {
            return false;
        }
    }

    public function verifiedDatas()
    {
        return $this->hasMany(VerifiedData::class, 'user_id');
    }

    public function hasPermission($permission)
    {
        $itemsCount = $this->roleItems->count();
        if ($itemsCount < 1) {
            return true;
        } else {
            $item = $this->roleItems()->where('name', $permission)->first();
            if ($item) {
                return true;
            } else {

                return false;
            }
        }
    }

    public function fi()
    {
        return $this->img_name ? $this->img_name : 'ppm.jpg';
    }


    public function hasRole($role) //$role = admin, staff..
    {
        $rq = request();


        if ($role == 'admin') {



            if ($ad = $this->roles()->where('role_name', $role)->first()) {
                $permissions = $ad->permission;

                if (!$permissions) {
                    return true;
                }

                if ($permissions and ($permissions == 'all')) {
                    return true;
                }

                if ($permissions) {
                    $sg2 = $rq->segment(2);
                    $sg3 = $rq->segment(3);

                    if ($sg2 and $sg3) {
                        if ($rq->method() == 'GET') {
                            $permission = $sg2 . '_' . $sg3;

                            if (preg_match("~\b" . $permission . "\b~", $permissions)) {
                                return true;
                            } else {
                                abort(401);
                            }
                        } else {
                            return true;
                        }
                    } elseif ($sg2) {
                        return true;
                    }
                }
            } else {
                abort(401);
            }
        } elseif ($role == 'subscriber') {


            return (bool) $this->subscriptions()->count();
        }

        // elseif($role == 'company')
        // {
        //     return (bool) $this->companies()->count();
        // }

        // elseif($role == 'subrole')
        // {
        //     return (bool) $this->subroles()->count();
        // }
    }

    // public function posts()
    // {
    //     return $this->morphMany('App\Models\Post', 'postable');
    // }

    public function posts()
    {
        return $this->morphMany(Post::class, 'postable');
    }


    //touch //touches
    public function myTouches()
    {
        return $this->hasMany('App\Models\Touch', 'user_id');
    }

    public function touchMains()
    {
        return $this->myTouches()
            ->where('notify_type', 'main'); //->paginate(20) in blade
    }

    public function touchMainValue()
    {
        if ($a = $this->touchMains()->first()) {
            return $a->notify_value;
        } else {
            return 0;
        }
    }

    public function touchMainsIncrement()
    {
        $r = $this->touchMains()->firstOrCreate(['notify_type' => 'main']);
        $r->notify_value = $r->notify_value + 1;
        $r->save();
        return $r;
    }

    public function touchMainsDecrement()
    {
        $r = $this->touchMains()->firstOrCreate(['notify_type' => 'main']);
        if ($r->notify_value > 1) {
            $r->notify_value = $r->notify_value - 1;
        } else {
            $r->notify_value = 0;
        }
        $r->save();
        return $r;
    }

    public function touchMainsDelete()
    {
        $r = $this->touchMains()->firstOrCreate(['notify_type' => 'main']);
        $r->notify_value = 0;
        $r->save();
        return $r;
    }
    //touch



    //notification start

    ## notifications is created by laravel notification system

    public function notificationSix()
    {
        return $this->notifications()
            ->latest()
            ->limit(6)
            ->get();
    }
    //notification end


    public function userroles()
    {
        return $this->hasMany('App\Models\User', 'id');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Models\Subscriber');
    }

    public function sfBalanceTotal()
    {
        return $this->subscriptions()->sum('balance');
    }

    public function totalBalance()
    {
        return $this->balance + $this->system_balance;
    }

    public function singleReffer()
    {
        return $this->subscriptions()->first();
    }


    public function subscriber()
    {
        return $this->belongsTo('App\Models\Subscriber', 'id', 'user_id');
    }
    public function isWSSubscription($ws)
    {

        return $this->subscriptions()->where('work_station_id', $ws->id)->first();
    }

    public function workstationSubscriptions($ws)
    {

        return $this->subscriptions()->where('work_station_id', $ws->id)->get();
    }

    public function myWsCatIds($ws)
    {
        return $this->subscriptions()
            ->where('work_station_id', $ws->id)
            ->groupBy('category_id')->pluck('category_id');
    }

    public function WsCatSubscriptions($cat)
    {
        return $this->subscriptions()
            // ->where('work_station_id',$cat->work_station_id)
            ->where('category_id', $cat->id)
            ->get();
    }

    public function subscriptionPayments()
    {
        return $this->hasMany('App\Models\SubcriberPayment');
    }

    public function introducerRefferer()
    {

        $a = $this->subscriptions()
            ->where('referral_id', '<>', null)
            ->value('referral_id');
        // dd($a);
        if ($a) {

            // dd($this->id);
            $b = Subscriber::where('id', $a)
                ->where('user_id', '<>', $this->id)
                ->first();
            if ($b) {
                return $b;
            }
            return false;
        } else {
            return false;
        }
    }

    public function subscriptionDistrict()
    {
        if ($sp = $this->subscriptionPayments()->first()) {
            $d = District::find($sp->district_id);
            return $d ?: District::find(1);
        }
        return District::find(1);
    }

    public function welcomeSmsSend()
    {
        $to = bdMobile($this->mobile);
        if (strlen($to) != 13) {
            // return true;
        }
        // $smsNonMaskingCode = smsNonMaskingCode();
        // $api = smsApiKey();
        $msg = "Dear {$this->name}, Congratulations!!! Now You are Registered Member of SoftCodeInt. Your Login Mobile : {$this->mobile} and Temporary Password : {$this->password_temp}
        www.softcodeint.com"; //150 characters allowed here

        // if(env('APP_ENV') != 'local')
        // {
        //     $sms = new Sms;
        //     $sms->mobile = $to;
        //     $sms->sms = $msg;
        //     $sms->status = 0;
        //     $sms->save();
        // }


        $url = smsUrl($to, $msg);
        // dd($url);
        $client = new Client();
        try {
            $r = $client->request('GET', $url);
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
        } catch (\GuzzleHttp\Exception\ClientException $e) {
        }
    }

    public function passwordResetSmsSend()
    {
        $to = bdMobile($this->mobile);
        if (strlen($to) != 13) {
            return true;
        }
        // $smsNonMaskingCode = smsNonMaskingCode();
        // $api = smsApiKey();
        $msg = "Dear {$this->name}, Your softcodeint Mobile : {$this->mobile} and new Password : {$this->password_temp} www.softcodeint.com"; //150 characters allowed here

        // if(env('APP_ENV') != 'local')
        // {
        //     $sms = new Sms;
        //     $sms->mobile = $to;
        //     $sms->sms = $msg;
        //     $sms->status = 0;
        //     $sms->save();
        // }

        $url = smsUrl($to, $msg);

        $client = new Client();
        try {
            $r = $client->request('GET', $url);
            $result = $r->getBody()->getContents();
            // dd($result);
            $arr = json_decode($result, true);
            // dd($arr);  
            // array:5 [▼
            // "code" => 200
            // "status" => "success"
            // "count" => 1
            // "message_id" => "a3d28fc9-157d-4f48-adda-64ef5fe3731b"
            // "current_balance" => 280.77
            // ]

            // dd($arr['current_balance']); //281.13

            if ($arr['status'] == 'success') {
                $wp = WebsiteParameter::first();
                $wp->sms_price = $arr['current_balance'];
                $wp->save();
            }
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
        } catch (\GuzzleHttp\Exception\ClientException $e) {
        }
    }

    public function balanceTransactions()
    {
        return $this->hasMany('App\Models\BalanceTransaction');
    }

    public function totalWithdraw()
    {
        return $this->balanceTransactions()->where('purpose', 'withdraw')->sum('moved_balance');
    }

    public function totalDeposit()
    {
        return $this->balanceTransactions()->where('purpose', 'deposit')->sum('moved_balance');
    }

    public function smsWithNewPinSend($pin)
    {
        $to = bdMobile($this->mobile);
        if (strlen($to) != 13) {
            return true;
        } elseif (strlen($to) == 13) {
            // $smsNonMaskingCode = smsNonMaskingCode();
            // $api = smsApiKey();
            // $msg = urlencode("{$pin} is your new pin for your member account. Your member code is {$this->username}. www.easyproductsbd.com");
            $msg = "Dear {$this->name}, Your OTP is {$pin}. please use This OTP for set new Pin";
            //150 characters allowed here
            // dd($msg);
            // $url = "http://sms.multisoftbd.com/smsapi?api_key={$api}&type=text&contacts={$to}&senderid={$smsNonMaskingCode}&msg={$msg}";
            // dd($url);
            // if(env('APP_ENV') != 'local')
            // {
            //     $sms = new Sms;
            //     $sms->mobile = $to;
            //     $sms->sms = $msg;
            //     $sms->status = 0;
            //     $sms->save();
            // }
            $url = smsUrl($to, $msg);
            $client = new Client();
            try {
                $r = $client->request('GET', $url);
                // $result = $r->getBody()->getContents();
                // dd($result);
            } catch (\GuzzleHttp\Exception\ConnectException $e) {
            } catch (\GuzzleHttp\Exception\ClientException $e) {
            }
        }
    }

    public function mobileRechargeCheck($number, $amount, $type)
    {
        $type = $type == 'prepaid' ? 0 : 1; //1 for postpaid
        $url = "http://load16.com/db/response.php"; //for check

        $formParams = [
            'api' => urlencode("softcommerce"),
            'pass' => urlencode("Softcommerce7277"),
            'mobile' => urlencode($number),
            'type' => urlencode($type),
            'amt' => urlencode($amount),
            'domain' => urlencode("sc-bd.com"),
        ];
        $client = new Client();

        try {
            $r = $client->post($url, ['form_params' => $formParams]);
            $result = $r->getBody()->getContents();
            // dd($result); //"Success" , 'Doublicate Entry in 5 minutes' , pending
            return $result;
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
        } catch (\GuzzleHttp\Exception\ClientException $e) {
        }
    }

    public function bkashCashInCheck()
    {
    }

    public function companyBalanceCheck()
    {


        // $url = "https://hostparkbd.net/api/check.php?user=easyproducts&pass=Easy9191230&todo=balance";
        // // dd($url);
        // $client = new Client();

        // try {
        //         $r = $client->request('GET', $url);
        //         $result = $r->getBody()->getContents();

        //         $arr = json_decode($result, true);

        //         return $arr['balance'];

        //     } catch (\GuzzleHttp\Exception\ConnectException $e) {
        //         // This is will catch all connection timeouts
        //         // Handle accordinly
        //     } catch (\GuzzleHttp\Exception\ClientException $e) {
        //         // This will catch all 400 level errors.
        //         // return $e->getResponse()->getStatusCode();
        //     }
    }

    // public function bkashCashIn($number,$amount,$type)
    // {


    //     // $url = "https://hostparkbd.net/api/check.php?user=easyproducts&pass=Easy9191230&todo=bkash&mobile={$number}&amount={$amount}&type=cashin&pin=E1234";
    //     // // dd($url);
    //     // $client = new Client();

    //     // try {
    //     //         $r = $client->request('GET', $url);
    //     //         $result = $r->getBody()->getContents();



    //     //         $arr = json_decode($result, true);

    //     //         // dd($arr);

    //     //         return $arr;

    //     //     } catch (\GuzzleHttp\Exception\ConnectException $e) {
    //     //         // This is will catch all connection timeouts
    //     //         // Handle accordinly
    //     //     } catch (\GuzzleHttp\Exception\ClientException $e) {
    //     //         // This will catch all 400 level errors.
    //     //         // return $e->getResponse()->getStatusCode();
    //     //     }

    // }


    public function bkashCashIn($number, $amount, $type, $service)
    {
        // dd($number);

        // $type = ($type == 'bkash') ? 0 : 1; //1 for bkash agent, 0 for bkash personal

        $url = "http://load16.com/db/api_mob.php?api=Softcode&pass=softDhaka1212&mobile={$number}&type=0&amt={$amount}&item={$service}"; //provided by maruf vai
        //    dd($url);
        // $url = "http://load16.com/db/api_mob.php"; //for load
        // $url = "http://load16.com/db/response.php"; //for check
        // $formParams = [
        //     'api' => urlencode("Softcode"),
        //     'pass' => urlencode("softDhaka1212"),
        //     'mobile' => urlencode($number),
        //     'type' => urlencode("0"),
        //     'item' => urlencode('bkash'),
        //     'amt' => urlencode($amount),
        //     'domain' => urlencode("softcodeint.com"),
        // ];
        // dd($url);
        // dd($formParams);
        $client = new Client();
        try {
            $r = $client->post($url);
            // $r = $client->post($url,['form_params' => $formParams]);

            // $r = $client->request('GET', $url);
            $result = $r->getBody()->getContents();
            // dd($result); //"Success" , 'Doublicate Entry in 5 minutes' , pending
            // dd($result);
            // $arr = json_decode($result, true);
            //dd($arr);//null
            // return $arr;
            return $result;
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            // This is will catch all connection timeouts
            // Handle accordinly
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // This will catch all 400 level errors.
            // return $e->getResponse()->getStatusCode();
        }
    }

    public function mobileRecharge($number, $amount, $type)
    {
        $type = $type == 'prepaid' ? 0 : 1; //1 for postpaid

        $url = "http://load16.com/db/api_bd.php"; //for load
        // $url = "http://load16.com/db/response.php"; //for check
        $formParams = [
            'api' => urlencode("softcommerce"),
            'pass' => urlencode("Softcommerce7277"),
            'mobile' => urlencode($number),
            'type' => urlencode($type),
            'amt' => urlencode($amount),
            'domain' => urlencode("sc-bd.com"),
        ];
        // dd($url);
        $client = new Client();
        try {
            $r = $client->post($url, ['form_params' => $formParams]);
            // $r = $client->request('GET', $url);
            $result = $r->getBody()->getContents();
            // dd($result); //"Success" , 'Doublicate Entry in 5 minutes' , pending
            // dd($result);
            // $arr = json_decode($result, true);
            //dd($arr);//null
            // return $arr;
            return $result;
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            // This is will catch all connection timeouts
            // Handle accordinly
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // This will catch all 400 level errors.
            // return $e->getResponse()->getStatusCode();
        }
    }
    public function order()
    {
        return $this->hasMany(ServiceProductOrder::class,'user_id');
    }

    public function TotalSale()
    {
        return $this->order()->where('order_status','satisfied')->sum('total_sale_price');
    }
    public function balanceEdit()
    {
        return $this->hasMany(UserBalanceEdit::class,'user_id');
    }
    public function blanceEditDate()
    {
        return $this->balanceEdit()->latest()->first();
    }
    public function monthlyBalanceStatusSmsSend()
    {
        $to = bdMobile($this->mobile);
        if (strlen($to) != 13) {
            return true;
        }
        // $smsNonMaskingCode = smsNonMaskingCode();
        // $api = smsApiKey();
        $msg = "Dear {$this->name}, Your softcodeint Mobile : {$this->mobile} and your current balance : {$this->balance} . www.softcodeint.com"; //150 characters allowed here
        // if(env('APP_ENV') != 'local')
        // {
        //     $sms = new Sms;
        //     $sms->mobile = $to;
        //     $sms->sms = $msg;
        //     $sms->status = 0;
        //     $sms->save();
        // }

        $url = smsUrl($to, $msg);

        $client = new Client();
        try {
            $r = $client->request('GET', $url);
            $result = $r->getBody()->getContents();
            // dd($result);
            $arr = json_decode($result, true);
            // dd($arr);  
            // array:5 [▼
            // "code" => 200
            // "status" => "success"
            // "count" => 1
            // "message_id" => "a3d28fc9-157d-4f48-adda-64ef5fe3731b"
            // "current_balance" => 280.77
            // ]

            // dd($arr['current_balance']); //281.13

            if ($arr['status'] == 'success') {
                $wp = WebsiteParameter::first();
                $wp->sms_price = $arr['current_balance'];
                $wp->save();
            }
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
        } catch (\GuzzleHttp\Exception\ClientException $e) {
        }
    }
    public function notes()
    {
        return $this->hasMany(Note::class,'user_id')->orderBy('id','DESC');
    }

    public function negotiation()
    {
        return $this->hasMany(Negotiation::class,'user_id');
    }
    public function hasNegotiation()
    {
       return $this->negotiation()->count();
    }
    /* public function userGroup($user)
    {
        # code...
    } */
    public function suggession()
    {
        return $this->hasMany(Suggestion::class,'user_id');
    }

    // public function closedSuggession()
    // {
    //     return $this->suggession()->where('user_id',Auth::id())->where('parent_id',null)->where('closed',true)->count();
    // }

    // public function hasParentOpen()
    // {
    //    $this->suggession()->where('user_id',Auth::id())->where();
    // }
    function hasParentOpen()
    {
       return $this->suggession()->where('user_id',Auth::id())->where('parent_id',null)->where('closed',false)->first();
    }

    public function suggessionDiscuss($parent)
    {
        return $this->suggession()->where('parent_id',$parent)->get();
    }

    


}
