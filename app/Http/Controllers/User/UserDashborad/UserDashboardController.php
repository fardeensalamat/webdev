<?php

namespace App\Http\Controllers\User\UserDashborad;

use Auth;
use Hash;
use Session;
use Validator;
use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use GuzzleHttp\Client;
use App\Models\UserRole;
use App\Models\District;
use App\Models\Subscriber;
use App\Models\Honorarium;
use App\Models\WorkStation;
use App\Models\Subcategory;
use App\Models\VerifiedData;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use App\Models\AdminBalance;
use App\Models\BalanceTransaction;
use App\Models\SubcriberPayment;
use App\Models\SubscriberHonorarium;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OnlinePaymentController;
use App\Models\Bid;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Favourite;
use App\Models\Need;
use App\Models\NeedsPayment;
use App\Models\Opinion;
use App\Models\PostCategory;
use App\Models\Serviceitem;
use App\Models\ServicePayment;
use App\Models\ServiceProductCart;
use App\Models\ServiceProductOrder;
use App\Models\ServiceProductOrderItem;
use App\Models\ServiceProfile;
use App\Models\ServiceProfileInfo;
use App\Models\ServiceProfileInfoValue;
use App\Models\ServiceProfileProduct;
use App\Models\Suggestion;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;
use App\Models\SendSms;
use App\Models\OrderNotifications;
use App\Models\DeliveryMan;
use App\Models\Courseitem;
use App\Models\CourseOrder;
use App\Models\SpecialLink;
use App\Models\Rating;

use App\Models\SpecialCategory;

use App\Models\SoftcomJobCandidate;

use App\Models\WithdrawalAccount;

use App\Models\ServiceProfileWorker;

use App\Models\TopPrio;
use App\Models\ValuedCustomer;
use App\Models\SoftcomApplicantCategory;
use App\Jobs\CreatePostpaidAccount;
Use Image;


class UserDashboardController extends Controller
{
    // function getProduct(Request $request){
    //     $lat = $request->input('lat');
    //     $lon = $request->input('lon');


    //     if( $lat != '' && $lon != '' ){
    //         $products = DB::table('service_profiles')
    //             ->selectRaw("service_profiles.*,
    //                         ( 3959 * acos( 
    //                         cos( radians(" . $lat . ") ) *
    //                         cos( radians(service_profiles.lat) ) *
    //                         cos( radians(service_profiles.lng) - radians(" . $lon . ") ) + 
    //                         sin( radians(" . $lat . ") ) *
    //                         sin( radians(service_profiles.lat) ) ) ) 
    //                         AS distance"
    //                         )
    //             // ->where('shop.id','=','product.shop_id')
    //             ->having("distance", "<", 10)
    //             ->orderBy("distance")
    //             ->get();
    //         return $products;
    //     }else{  
    //         return 'Error Msg';
    //     }    
    // }




    public function dashboard()
    {
        if (Auth::check()) {
            $ids = Subscriber::where('user_id', Auth::id())->groupBy('category_id')->pluck('id');
            if ($ids) {
                $t =  DB::table('subscribers')
                    ->where('user_id', Auth::id())
                    ->where('active', true)
                    ->whereNotIn('id', $ids)
                    ->update([
                        'active' => false
                    ]);
            }
        }
        $request = request();
        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'dashboard', 'lsbsm' => 'dashboard']);
        $user = Auth::user();
        $subscriber = Subscriber::where('user_id', $user->id)->first();

        // $shops = ServiceProfile::where('profile_type', 'business')->where('status', 1)->has('isOrderTrue')->has('liveProducts')->simplePaginate(24);

        $lat = $user->lat ?: 23.792433799999998;
        $lng = $user->lng ?: 90.4266676;
        $number = filter_var($request->radius, FILTER_SANITIZE_NUMBER_INT);
        $radius = $number ? (int) $number : 3000;
        if ($lat and $lng) {
            $haversine = "(6371 * acos(cos(radians(" . $lat . ")) 
                        * cos(radians(`lat`)) 
                        * cos(radians(`lng`) 
                        - radians(" . $lng . ")) 
                        + sin(radians(" . $lat . ")) 
                        * sin(radians(`lat`))))";
        }

        $shops = ServiceProfile::select('id', 'lat', 'lng', 'workstation_id', 'ws_cat_id', 'subscriber_id', 'user_id', 'name', 'email', 'mobile', 'img_name', 'cover_image', 'address', 'short_bio', 'zip_code', 'city', 'country', 'status','paystatus', 'profile_type', 'addedby_id', 'open', 'fixed_location', 'package_status','website_link')
            ->where('profile_type', 'business', 'expired_at')
            ->where('status', 1)
            ->where(function ($q) {
                $q->where('expired_at', '>=', Carbon::now()->today());
                $q->orWhere('expired_at', null);
            })
            // ->has('isOrderTrue')
            // ->has('liveProducts')
            // ->whereRaw("{$haversine} < ?", [$radius])
            ->selectRaw("{$haversine} AS distance")
            ->latest()
            ->orderBy('distance')
            ->paginate(8);
         //dd($shops);
         $speciallink = SpecialLink::where('linktype', 'special')->first();

         $customerList = ValuedCustomer::all();
         $priorityList = TopPrio::all(); 
         $profilecount=ServiceProfile::where('user_id',Auth::user()->id)->count();
         $myprofile=ServiceProfile::where('user_id',Auth::user()->id)->get();

        return view('user.dashboard', [
            'user' => $user,
            // 'biz_profiles' => $biz_profile,
            'subscriber' => $subscriber,
            'speciallink' => $speciallink,
            'shops' => $shops,
            'customerList' => $customerList,
            'priorityList' => $priorityList,
            'profilecount' => $profilecount,
            'myprofile' => $myprofile
        ]);
    }

    public function userpublishservice()
    {
        if (Auth::check()) {
            $ids = Subscriber::where('user_id', Auth::id())->groupBy('category_id')->pluck('id');
            if ($ids) {
                $t =  DB::table('subscribers')
                    ->where('user_id', Auth::id())
                    ->where('active', true)
                    ->whereNotIn('id', $ids)
                    ->update([
                        'active' => false
                    ]);
            }
        }
        $request = request();
        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'dashboard', 'lsbsm' => 'publishservice']);
        $user = Auth::user();
        $subscriber = Subscriber::where('user_id', $user->id)->first();

        // $shops = ServiceProfile::where('profile_type', 'business')->where('status', 1)->has('isOrderTrue')->has('liveProducts')->simplePaginate(24);

        $lat = $user->lat ?: 23.792433799999998;
        $lng = $user->lng ?: 90.4266676;
        $number = filter_var($request->radius, FILTER_SANITIZE_NUMBER_INT);
        $radius = $number ? (int) $number : 3000;
        if ($lat and $lng) {
            $haversine = "(6371 * acos(cos(radians(" . $lat . ")) 
                        * cos(radians(`lat`)) 
                        * cos(radians(`lng`) 
                        - radians(" . $lng . ")) 
                        + sin(radians(" . $lat . ")) 
                        * sin(radians(`lat`))))";
        }

        $shops = ServiceProfile::select('id', 'lat', 'lng', 'workstation_id', 'ws_cat_id', 'subscriber_id', 'user_id', 'name', 'email', 'mobile', 'img_name', 'cover_image', 'address', 'short_bio', 'zip_code', 'city', 'country', 'status','paystatus', 'profile_type', 'addedby_id', 'open', 'fixed_location', 'package_status')
            ->where('profile_type', 'business', 'expired_at')
            ->where('status', 1)
            ->where('paystatus',1)
            ->where('user_id',$user->id)
            ->where(function ($q) {
                $q->where('expired_at', '>=', Carbon::now()->today());
                $q->orWhere('expired_at', null);
            })
            // ->has('isOrderTrue')
            // ->has('liveProducts')
            // ->whereRaw("{$haversine} < ?", [$radius])
            ->selectRaw("{$haversine} AS distance")
            ->latest()
            ->orderBy('distance')
            ->paginate(8);
         //dd($shops);

        return view('user.services.publishservice', [
            'user' => $user,
            // 'biz_profiles' => $biz_profile,
            'subscriber' => $subscriber,
            'shops' => $shops
        ]);
    }
    public function userunpublishservice()
    {
        if (Auth::check()) {
            $ids = Subscriber::where('user_id', Auth::id())->groupBy('category_id')->pluck('id');
            if ($ids) {
                $t =  DB::table('subscribers')
                    ->where('user_id', Auth::id())
                    ->where('active', true)
                    ->whereNotIn('id', $ids)
                    ->update([
                        'active' => false
                    ]);
            }
        }
        $request = request();
        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'dashboard', 'lsbsm' => 'unpublishservice']);
        $user = Auth::user();
        $subscriber = Subscriber::where('user_id', $user->id)->first();

        // $shops = ServiceProfile::where('profile_type', 'business')->where('status', 1)->has('isOrderTrue')->has('liveProducts')->simplePaginate(24);

        $lat = $user->lat ?: 23.792433799999998;
        $lng = $user->lng ?: 90.4266676;
        $number = filter_var($request->radius, FILTER_SANITIZE_NUMBER_INT);
        $radius = $number ? (int) $number : 3000;
        if ($lat and $lng) {
            $haversine = "(6371 * acos(cos(radians(" . $lat . ")) 
                        * cos(radians(`lat`)) 
                        * cos(radians(`lng`) 
                        - radians(" . $lng . ")) 
                        + sin(radians(" . $lat . ")) 
                        * sin(radians(`lat`))))";
        }

        $shops = ServiceProfile::select('id', 'lat', 'lng', 'workstation_id', 'ws_cat_id', 'subscriber_id', 'user_id', 'name', 'email', 'mobile', 'img_name', 'cover_image', 'address', 'short_bio', 'zip_code', 'city', 'country', 'status','paystatus', 'profile_type', 'addedby_id', 'open', 'fixed_location', 'package_status')
            ->where('profile_type', 'business', 'expired_at')
            ->where('status', 0)
            ->where('paystatus',0)
            ->where('user_id',$user->id)
            ->selectRaw("{$haversine} AS distance")
            ->latest()
            ->orderBy('distance')
            ->paginate(8);
         //dd($shops);

        return view('user.services.unpublishservice', [
            'user' => $user,
            // 'biz_profiles' => $biz_profile,
            'subscriber' => $subscriber,
            'shops' => $shops
        ]);
    }


    public function usertrialservice()
    {
        if (Auth::check()) {
            $ids = Subscriber::where('user_id', Auth::id())->groupBy('category_id')->pluck('id');
            if ($ids) {
                $t =  DB::table('subscribers')
                    ->where('user_id', Auth::id())
                    ->where('active', true)
                    ->whereNotIn('id', $ids)
                    ->update([
                        'active' => false
                    ]);
            }
        }
        $request = request();
        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'dashboard', 'lsbsm' => 'trialservice']);
        $user = Auth::user();
        $subscriber = Subscriber::where('user_id', $user->id)->first();

        // $shops = ServiceProfile::where('profile_type', 'business')->where('status', 1)->has('isOrderTrue')->has('liveProducts')->simplePaginate(24);

        $lat = $user->lat ?: 23.792433799999998;
        $lng = $user->lng ?: 90.4266676;
        $number = filter_var($request->radius, FILTER_SANITIZE_NUMBER_INT);
        $radius = $number ? (int) $number : 3000;
        if ($lat and $lng) {
            $haversine = "(6371 * acos(cos(radians(" . $lat . ")) 
                        * cos(radians(`lat`)) 
                        * cos(radians(`lng`) 
                        - radians(" . $lng . ")) 
                        + sin(radians(" . $lat . ")) 
                        * sin(radians(`lat`))))";
        }

        $shops = ServiceProfile::select('id', 'lat', 'lng', 'workstation_id', 'ws_cat_id', 'subscriber_id', 'user_id', 'name', 'email', 'mobile', 'img_name', 'cover_image', 'address', 'short_bio', 'zip_code', 'city', 'country', 'status','paystatus', 'profile_type', 'addedby_id', 'open', 'fixed_location', 'package_status')
            ->where('is_trial',true)
            ->where('user_id',$user->id)
            ->latest()
            ->paginate(8);
         //dd($shops);

        return view('user.services.trialservice', [
            'user' => $user,
            // 'biz_profiles' => $biz_profile,
            'subscriber' => $subscriber,
            'shops' => $shops
        ]);
    }

    public function uservendorlist()
    {
        if (Auth::check()) {
            $ids = Subscriber::where('user_id', Auth::id())->groupBy('category_id')->pluck('id');
            if ($ids) {
                $t =  DB::table('subscribers')
                    ->where('user_id', Auth::id())
                    ->where('active', true)
                    ->whereNotIn('id', $ids)
                    ->update([
                        'active' => false
                    ]);
            }
        }
        $request = request();
        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'dashboard', 'lsbsm' => 'trialservice']);
        $user = Auth::user();

        $subscriber = Subscriber::where('user_id', $user->id)->first();
        if (!$subscriber) {
            abort(404);
        }

        $vendors = ServiceProductOrder::where('user_id', $user->id)
        ->groupBy('service_profile_id')
        ->paginate(20);

        //dd( $customers);

        return view('user.services.vendorlist', [
            'subscriber' => $subscriber,
            'user' => $user,
            'vendors' => $vendors
        ]);
    }

    public function getUsers(Request $request)
    {
        // return "OK";
        $user = Auth::user();
        $subscriber = Subscriber::where('user_id', $user->id)->first();
        $lat = $user->lat ?: 23.792433799999998;
        $lng = $user->lng ?: 90.4266676;
        $number = filter_var($request->radius, FILTER_SANITIZE_NUMBER_INT);
        $radius = $number ? (int) $number : 3000;
        if ($lat and $lng) {
            $haversine = "(6371 * acos(cos(radians(" . $lat . ")) 
                        * cos(radians(`lat`)) 
                        * cos(radians(`lng`) 
                        - radians(" . $lng . ")) 
                        + sin(radians(" . $lat . ")) 
                        * sin(radians(`lat`))))";
        }
        $shops = ServiceProfile::select('id', 'lat', 'lng', 'workstation_id', 'ws_cat_id', 'subscriber_id', 'user_id', 'name', 'email', 'mobile', 'img_name', 'cover_image', 'address', 'short_bio', 'zip_code', 'city', 'country', 'status','paystatus', 'profile_type', 'addedby_id', 'open', 'fixed_location', 'package_status')
            ->where('profile_type', 'business', 'expired_at')
            ->where('status', 1)
            ->where('paystatus',1)
            ->where(function ($q) {
                $q->where('expired_at', '>=', Carbon::now()->today());
                $q->orWhere('expired_at', null);
            })
            // ->has('isOrderTrue')
            // ->has('liveProducts')
            ->whereRaw("{$haversine} < ?", [$radius])
            ->selectRaw("{$haversine} AS distance")
            ->latest()
            ->orderBy('distance')
            ->paginate(4);

        if ($request->ajax()) {
            // return $shops;
            $view = view('user.shopAjax', ['shops' => $shops, 'subscriber' => $subscriber])->render();
            return response()->json(['html' => $view]);
        }
    }


    public function myNeeds(Request $request)
    {
        menuSubmenu('myNeeds', 'myNeeds');
        $user = Auth::user();
        $needs = Need::where('user_id', $user->id)->latest()->paginate('30');
        return view('user.whatYouWant.myNeeds', compact('needs'));
    }
    public function myNeedDetails(Request $request)
    {

        $need = Need::where('id', $request->need)->first();

        if (!$need) {
            return back();
        }
        if ($need->user_id != Auth::id()) {
            return back();
        }

        return view('user.whatYouWant.myNeedDetails', compact('need'));
    }
    public function myNeedEdit(Request $request)
    {
        $need = Need::where('id', $request->need)->first();
        if (!$need) {
            return back();
        }
        if ($need->user_id != Auth::id()) {
            return back()->with('warning', 'You are not able to edit another user Need');
        }
        return view('user.whatYouWant.myNeedEdit', compact('need'));
    }
    public function myNeedBidDetails(Request $request)
    {
        $need = Need::where('id', $request->need)->first();
        if (!$need) {
            return back();
        }
        if ($need->user_id != Auth::id()) {
            return back();
        }
        $bid = Bid::where('id', $request->bid)->first();
        if (!$bid) {
            return back();
        }
        if ($bid->need_id != $need->id) {
            return back();
        }

        return view('user.whatYouWant.myNeedBidDetails', compact('need', 'bid'));
    }
    public function myNeedBidUpdate(Request $request)
    {
        $bid = Bid::find($request->bid_id);
        $need = Need::find($request->need_id);
        if ($need->hasApprovedBid()) {
            return redirect()->back()->with('warning', 'You Have already Hired a Person!!. So, you are not able to approve another bid');
        }
        $status = $request->status;
        $me = Auth::user();
        if ($status == 'approved') {
            $myBlance = $me->balance;
            if ($myBlance < $bid->price) {
                return redirect()->back()->with('warning', 'Insufficient Balance');
            } else {

                $bt = new BalanceTransaction;
                // $bt->subscriber_id = $subscription->id;
                $bt->from = 'tenant';
                $bt->to = 'admin';
                $bt->purpose = 'needs';
                $bt->user_id = $me->id;
                $bt->previous_balance = $me->balance;  // user old balance
                $bt->moved_balance = $bid->price; // job cost
                $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
                $bt->type = 'needs';
                $bt->details = "To Approved Bid ({$bid->id}) for ({$need->title}). {$bt->moved_balance} TK deducted from tenant balance for \"Needs\" order. ";
                $bt->type_id = $me->id;
                $bt->addedby_id = $me->id;
                $bt->save();

                $me->decrement('balance', $bid->price);
                $bid->status = 'approved';
                $bid->save();

                // $need_payment= new NeedsPayment;
                // $need_payment->payment_status= 'advanced';
                // $need_payment->pending_balance= $bt->moved_balance;
                // $need_payment->need_id= $need->id;
                // $need_payment->bid_id= $bid->id;
                // $need_payment->user_id= $me->id;
                // $need_payment->addedby_id= $me->id;
                // $need_payment->save();
                $need->order_confirmed_price = $bt->moved_balance;
                $need->payment_status = 'advanced';
                $need->save();
            }
        }
        $bid->status = $status;
        $bid->save();
        return redirect()->back()->with('success', 'Status Successfully Updated');
    }
    public function locationSet(Request $request)
    {
        if (!Auth::check()) {
            return Response()->json(['success' => false, 'i' => 1]);
        }

        $lat = $request->lat;
        $lng = $request->lng;
        $user = Auth::user();
        $user->lat = $lat;
        $user->lng = $lng;
        $user->save();

        return Response()->json([
            'success' => true,
            'lat' => $lat,
            'lng' => $lng
        ]);
    }

    public function userBalance()
    {
        menuSubmenu('balance', 'balance');
        $user = Auth::user();

        // $transactions = $user->balanceTransactions()->where('to', 'user')
        //     ->latest()
        //     ->paginate(10);

        $bkash=WithdrawalAccount::where('type','Bkash')->where('user_id',$user->id)->first();
        $rocket=WithdrawalAccount::where('type','Rocket')->where('user_id',$user->id)->first();
        $nagad=WithdrawalAccount::where('type','Nagad')->where('user_id',$user->id)->first();
        $upay=WithdrawalAccount::where('type','Upay')->where('user_id',$user->id)->first();

            $transactions = $user->balanceTransactions()->where('user_id', $user->id)
            ->latest()
            ->paginate(10);
        return view('user.userBalance.userBalance', [
            'user' => $user,
            'transactions' => $transactions,
            'bkash' => $bkash,
            'rocket' => $rocket,
            'nagad' => $nagad,
            'upay' => $upay

        ]);
    }
    public function userpaydue()
    {
        menuSubmenu('balance', 'balance');
        $me = Auth::user();
        $due= $me->due_balance;

      
        if ($me->balance < $due) {
           
            return back()->with('error', 'Your account balance less then Due balance.');
           
        }
        $me->decrement('balance', $due);
        $me->decrement('due_balance', $due);

        $bt = new BalanceTransaction;
        $bt->from = 'user';
        $bt->to = 'admin';
        $bt->purpose = 'due_balance';
        $bt->subscriber_id = $me->subscriptions->first()->id;
        $bt->user_id = $me->id;
        $bt->previous_balance = $me->balance;  // user old balance
        $bt->moved_balance = $due; // job cost
        $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
        $bt->type = 'user';
        $bt->details = "Dear {$me->name}, Your due balance {$due} SCB successfully paid.";
        $bt->type_id = $me->id;
        $bt->addedby_id = Auth::id();
        $bt->save();
        return back()->with('success', 'Your due balance paid successfully.');
    }

    public function addBalanceToWallet(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'amount' => 'required|numeric|min:10'
            ]
        );

        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', ' Please, Try Again with Correct Information.');
        }

        $me = Auth::user();
        $subscribe = $me->subscriptions->first();

        // $order = Order::where('user_id', $me->id)->where('order_status', 'Pending')->where('order_for', 'deposit')->first();

        // if($order)
        // {
        //     // $order->paid_amount = $request->amount;
        //     // $order->pending_at = Carbon::now();
        //     // $order->save();
        //     return back()->with('error','You have already submit for balance recharge.Please wait untill review.');
        // }
        // else
        // {
        $order = new Order;
        $order->user_id = $me->id;
        $order->work_station_id = $subscribe ? $subscribe->work_station_id : null;
        $order->subscriber_id = $subscribe ? $subscribe->id : null;

        $order->paid_amount = $request->amount;

        $order->name = $me->name;
        $order->mobile = $me->mobile;
        $order->order_for = 'deposit';
        $order->order_status = 'temp';
        $order->payment_status = 'unpaid';
        $order->addedBy_id = Auth::id();
        $order->pending_at = Carbon::now();
        $order->save();

        // no order item, because there is no extra table
        // }
        return view('user.userBalance.balanceRecharge', [
            'order' => $order,
            'user' => $me
        ]);
    }

    public function balaceRechargeRequest($order, Request $request)
    {
        // dd($request->all());
        $order = Order::find($order);
        $order->order_status = 'pending';
        $order->save();

        $me = Auth::user();

        // $previous = OrderPayment::where('user_id',$order->user_id)->where('order_id',$order->id)->where('payment_status','pending')->first();

        // if(!$previous)
        // {
        $payment =  new OrderPayment;

        $payment->trans_date = date('Y-m-d');
        $payment->order_id = $order->id;
        $payment->work_station_id = $order->work_station_id;
        $payment->subscriber_id = $order->subscriber_id;
        $payment->user_id = $order->user_id;
        $payment->payment_by = 'bkash';
        $payment->payment_type = 'mobile bank';
        $payment->payment_status = 'pending';
        $payment->bank_name = null;
        $payment->account_number = '01821952907';
        $payment->cheque_number = null;
        // $payment->note = $order->transaction_id;
        $payment->note = $request->transection;
        $payment->sender = $request->sender;
        $payment->paid_amount = $order->paid_amount;
        $payment->receivedby_id = null;
        $payment->addedby_id = $order->user_id;
        $payment->editedby_id = null;
        // dd($request->sender);
        $payment->save();

        $notification1=new OrderNotifications;
        $notification1->type='addbalance';
        $notification1->title='Add Balance Request';
        $notification1->messages='Your payment successfully completed.';
        $notification1->details= "Your payment successfully completed. Add balance request amount Tk {$order->paid_amount} Proccess is under review.Please wait a minute";
        $notification1->user_id= Auth::id();
        $notification1->status='1';
        $notification1->date=now();
        $notification1->link=$payment->id;
        $notification1->save();
    
        $notification2=new OrderNotifications;
        $notification2->type='admin';
        $notification2->title='Add Balance Request';
        $notification2->messages= "Add balance request from {$me->name}";
        $notification2->details="Add balance request from {$me->name}.Add balance request for Number {$me->mobile} amount tk {$order->paid_amount} will be add";
        $notification2->user_id='3';
        $notification2->status='1';
        $notification2->date=now();
        $notification2->link=$payment->id;
        $notification2->save();


        return redirect()->route('user.userBalance')->with('success', 'Your payment successfully completed. Proccess is under review.');
        // }
        // else
        // {
        //     return redirect()->route('user.userBalance')->with('error', 'You have already submit for balance recharge.Please wait untill review.');
        // }
    }

    public function userEdit()
    {
        $user = Auth::user();
        $request = request();
        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'user', 'lsbsm' => 'userEdit']);

        return view('user.userEdit.editUserInfo', [
            'user' => $user
        ]);
    }


    public function userPinChange()
    {
        $user = Auth::user();
        $request = request();
        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'user', 'lsbsm' => 'userPinChange']);

        return view('user.userEdit.userPinChange', [
            'user' => $user
        ]);
    }

    public function userPasswordChange()
    {
        $user = Auth::user();
        $request = request();
        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'user', 'lsbsm' => 'userPasswordChange']);

        return view('user.userEdit.userPasswordChange', [
            'user' => $user
        ]);
    }


    public function userPasswordUpdate(Request $request)
    {
        $user = Auth::user();
        $validation = Validator::make(
            $request->all(),
            [
                'password' => ['required', 'string', 'min:6', 'confirmed'],

                'current_password' => ['required', 'string', 'min:6'],

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = $request->password ? Hash::make($request->password) : $user->password;
            $user->save();
            return back()->with('success', 'Your password successfully updated.');
        } else {
            return back()->with('error', 'Sorry, your current password did not match.');
        }
    }

    public function userPassCheck(Request $request)
    {
        $me = Auth::user();
        $validation = Validator::make(
            $request->all(),
            [
                'password' => ['required', 'string', 'min:6'],
                // 'new_pin' => ['required', 'numeric', 'string', 'min:4'],

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }
      
           
    
            if (Hash::check($request->password, $me->password)) {
                if($request->send==1){
    
                    // return back()->with('success', 'Your Password Matched. This section currently in maintenance');
                    // $member = $me->memberAccount;
                    if ($me->balance < 2) {
                        return redirect()->back()->with('warning', 'insufficient balance. Please Recharge');
                    }
                    
                    $pin= rand(1000, 9999);
                    $me->pin=$pin;
                    
        
                    $me->save();
                    $number=$me->mobile;
                    $messages= "Dear {$me->name}, Your OTP is {$pin}.Please use this OTP for set new pin";
        
                    //$me->sendSingleMessage($number,$messages);
                    $SendSms=new SendSms;
                    try {
                        // Send a message using the primary device.
                        $msg = $SendSms->sendSingleMessage($number,$messages);
        
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    // $me->decrement('balance', 2);
        
                    // $bt = new BalanceTransaction;
                    // $bt->from = 'user';
                    // $bt->to = 'admin';
                    // $bt->purpose = 'update_pin';
                    // $bt->subscriber_id = $me->subscriptions->first()->id;
                    // $bt->user_id = $me->id;
                    // $bt->previous_balance = $me->balance;  // user old balance
                    // $bt->moved_balance = 2; // job cost
                    // $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
                    // $bt->type = 'user';
                    // $bt->details = "Dear {$me->name}, Your OTP is {$me->pin}. please use This OTP for set new Pin";
                    // $bt->type_id = $me->id;
                    // $bt->addedby_id = Auth::id();
                    // $bt->save();
        
                    return redirect()->route('user.userPinCheck')->with('success', 'You got four digit OTP code in your mobile. please use you OTP and click Validate')->with('check', "checked");
                }else{
                    return redirect()->route('user.userPinCheck')->with('success', 'You Match Your Password')->with('check', "checked");
                }
            } else {
                return back()->with('error', 'Sorry, your password did not match.');
            }

       

       
    }

    public function userPinCheck(Request $request)
    {
        $user = Auth::user();
        return view('user.userEdit.pin.otpCheck', compact('user'));
    }
    public function userPinSet(Request $request)
    {
        $user = Auth::user();
        return view('user.userEdit.pin.setPin', compact('user'));
    }
    public function userOTPCheck(Request $request)
    {
        if ($request->check != 'checked') {
            return redirect()->route('user.userPinChange')->with('warning', 'You does not check your password. Please input password and submit');
        }
        $me = Auth::user();
        $validation = Validator::make(
            $request->all(),
            [
                // 'password' => ['required', 'string', 'min:6'],
                'otp' => ['required', 'numeric', 'string', 'min:4'],

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }
        // $otp == 50;
        if ($request->otp == $me->pin) {
            return redirect()->route('user.userPinSet')->with('success', 'Please input your new Pin. And pin must be 4 character')->with('check', 'checked');
        } else {
            return redirect()->back()->with('error', 'Otp Dosen\'t Match');
        }
    }


    public function userPinUpdate(Request $request)
    {
        if ($request->check != 'checked') {
            return redirect()->route('user.userPinChange')->with('error', 'You does not check your password.Please input password and submit');
        }
        $me = Auth::user();
        $validation = Validator::make(
            $request->all(),
            [
                // 'password' => ['required', 'string', 'min:6'],
                'new_pin' => ['required', 'numeric', 'string', 'min:4'],

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }
        $me->pin = $request->new_pin;
        $me->save();
        return redirect()->route('user.userPinChange')->with('success', 'Your pin successfully updated.');
    }

    public function userUpdate(Request $request)
    {
        // dd( $request->sc_fb_group_link_image);
        $user = Auth::user();

        $validation = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255', 'min:3'],
                //'email' => ['required', 'string', 'email','max:255'],
                'password' => ['nullable', 'string', 'min:6', 'confirmed'],
                //'sc_fb_group_link_image' => 'required',
                //'sc_youtube_channel_link_image' => 'required',

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $user->name = $request->name ?: $user->name;
        $user->email = $request->email ?: $user->email;
        // $user->mobile = $request->mobile ?: $user->mobile;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->addedby_id = Auth::id();
        $user->sc_youtube_channel_link_image =  $request->sc_youtube_channel_link_image;
        $user->sc_fb_group_link_image = $request->sc_fb_group_link_image;
        $user->save();


        // if ($cp = $request->sc_youtube_channel_link_image) {
        //     $f = 'user/others/' . $user->sc_youtube_channel_link_image;
        //     if (Storage::disk('public')->exists($f)) {
        //         Storage::disk('public')->delete($f);
        //     }

        //     $extension = strtolower($cp->getClientOriginalExtension());
        //     $randomFileName = $user->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

        //     list($width, $height) = getimagesize($cp);
        //     $mime = $cp->getClientOriginalExtension();
        //     $size = $cp->getSize();

        //     $originalName = strtolower($cp->getClientOriginalName());

        //     Storage::disk('public')->put('user/others/' . $randomFileName, File::get($cp));

        //     $user->sc_youtube_channel_link_image = $randomFileName;

        //     $user->save();
        // }

        // if ($cp = $request->sc_fb_group_link_image) {
        //     $f = 'user/others/' . $user->sc_fb_group_link_image;
        //     if (Storage::disk('public')->exists($f)) {
        //         Storage::disk('public')->delete($f);
        //     }

        //     $extension = strtolower($cp->getClientOriginalExtension());
        //     $randomFileName = $user->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

        //     list($width, $height) = getimagesize($cp);
        //     $mime = $cp->getClientOriginalExtension();
        //     $size = $cp->getSize();

        //     $originalName = strtolower($cp->getClientOriginalName());

        //     Storage::disk('public')->put('user/others/' . $randomFileName, File::get($cp));

        //     $user->sc_fb_group_link_image = $randomFileName;

        //     $user->save();
        // }

        if ($cp = $request->image) {

            $f = 'user/image/' . $user->img_name;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }

            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $user->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            list($width, $height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size = $cp->getSize();

            $originalName = strtolower($cp->getClientOriginalName());

            Storage::disk('public')->put('user/image/' . $randomFileName, File::get($cp));

            $user->img_name = $randomFileName;

            $user->save();
        }

        // return back()->with('success', 'User successfully Updated');
        return redirect()->route('user.dashboard')->with('success', 'User successfully Updated');
    }

    public function newsubscriptionPaid($cat)
    {
        $request = request();
        $category = Category::find($cat);

        if ($category) {
            $subscription = Subscriber::where('category_id', $cat)->where('user_id', Auth::id())->first();
            // return $subscription;
            return view('user.newSubscriptionForm', ['cat' => $category, 'subscription' => $subscription]);
        } else {
            abort(404);
        }
    }

    public function newsubscriptionFree($cat)
    {
        $request = request();
        $haveSubscription = Subscriber::where('category_id', $cat)
            ->where('user_id', Auth::id())
            ->first();
        if ($haveSubscription) {
            return redirect()->back()->with('warning', 'You have already Post paid account in this category');
        }

        $category = Category::find($cat);

        $workstation = Workstation::find($category->work_station_id);

        $me = Auth::user();
        $cookieReffer_id = null;

        if (!$me->subscriptions()->count()) {
            $rvd = $me->verifiedDatas()->first();
            if ($rvd) {
                $cookieReffer_id = $rvd->reffer_code;
            }
        }

        $code = Subscriber::where('subscription_code', $cookieReffer_id)
            ->where('id', '>', 15)
            ->where('subscription_code', '<>', null)
            ->where('work_station_id', $workstation->id)
            ->first();

        if ($code) {
            $workstationId = $code->work_station_id;
            $reffer_id = $code->id;
        } else {

            if ($sf = $me->isWSSubscription($workstation)) {

                $reffer_id = $sf->id;
                $workstationId = $workstation->id;
            } else {
                $reffer_id = null;
                // $reffer_id = $workstation->id + 15;
                $workstationId = $workstation->id;
            }
        }

        $prRow = Subscriber::where('work_station_id', $workstationId)->orderBy('ws_position', 'desc')->first();

        $dis = $me->subscriptionDistrict()->id;
        if (strlen($dis) < 2) {
            $dis = '0' . $dis;
        }

        $wsId = $workstationId;
        if (strlen($wsId) < 2) {
            $wsId = '0' . $wsId;
        }

        $meMob = $me->mobile ?: '00';
        if (strlen($meMob) > 2) {
            // $meMob = last 2 digit;
            $meMob = substr($meMob, -2);
        }

        $num = 100000000;
        $ws_pos = $prRow->ws_position + 1;
        $num = $num + $ws_pos;
        $scode = $wsId . $num . $meMob . $me->subscriptionDistrict()->id;

        $s = new Subscriber;
        $s->ws_position = $ws_pos;
        $s->name = $me->name;
        $s->email = $me->email;
        $s->mobile = $me->mobile;
        $s->category_id = $category->id;
        $s->district_id = $me->subscriptionDistrict()->id;
        $s->user_id = $me->id;
        $s->referral_id = $reffer_id;
        $s->work_station_id = $workstationId;
        $s->subscription_code = $scode;
        $s->addedby_id = Auth::id();
        $s->free_account = 1;

        $s->save();

        return back()->with('success', 'New subscription successfully created');
    }

    public function newsubscription($cat, Request $request)
    {
        $request->validate([
            'payment_type' => 'required'
        ]);
        if ($request->payment_type == 'nagad') {
            $category = Category::find($cat);
            $workstation = Workstation::find($category->work_station_id);
            $me = Auth::user();
            $code = Subscriber::where('subscription_code', $request->reffer)
                ->where('id', '>', 15)
                ->where('subscription_code', '<>', null)
                ->where('work_station_id', $workstation->id)
                ->first();

            if ($code) {
                $workstationId = $code->work_station_id;
                $reffer_id = $code->id;
            } else {

                if ($sf = $me->isWSSubscription($workstation)) {

                    $reffer_id = $sf->id;
                    $workstationId = $workstation->id;
                } else {
                    $reffer_id = null;
                    // $reffer_id = $workstation->id + 15;
                    $workstationId = $workstation->id;
                }
            }
            $payment = SubcriberPayment::where('cat_id', $category->id)->where('status', 'temp')->where('user_id', Auth::id())->first();
            $transection_id = "SC" . rand(9999, '54545');
            if (!$payment) {
                $payment = new SubcriberPayment;
                $payment->user_id = $me->id;
                $payment->work_station_id = $workstation->id;
                $payment->amount = $request->amount;
                $payment->refer_id = $reffer_id;
                $payment->district_id = $me->subscriptionDistrict()->id;
                $payment->transaction_no = $transection_id;
                $payment->sender_no = null;
                $payment->receiver_no = null;
                $payment->status = 'temp';
                $payment->save();
            }
            $payment->transaction_no = $transection_id;
            $payment->save();

            $result = new OnlinePaymentController;
            $result->getNagad(100,  $payment->transaction_no, 'subscription');
            $_SESSION['type'] = "subscription";
            $_SESSION['category'] = $cat;
            exit;
        }
        $request = request();
        $category = Category::find($cat);

        $workstation = Workstation::find($category->work_station_id);

        $me = Auth::user();

        $code = Subscriber::where('subscription_code', $request->reffer)
            ->where('id', '>', 15)
            ->where('subscription_code', '<>', null)
            ->where('work_station_id', $workstation->id)
            ->first();

        if ($code) {
            $workstationId = $code->work_station_id;
            $reffer_id = $code->id;
        } else {

            if ($sf = $me->isWSSubscription($workstation)) {

                $reffer_id = $sf->id;
                $workstationId = $workstation->id;
            } else {
                $reffer_id = null;
                // $reffer_id = $workstation->id + 15;
                $workstationId = $workstation->id;
            }
        }


        //new subscription by balance
        if ($me->balance > 99.999) {
            if ($request->for_user == "own") {
                $payment = new SubcriberPayment;
                $payment->user_id = $me->id;
                $payment->work_station_id = $workstation->id;
                $payment->amount = $request->amount;
                $payment->refer_id = $reffer_id;
                $payment->district_id = $me->subscriptionDistrict()->id;
                $payment->transaction_no = $request->transection;
                $payment->sender_no = null;
                $payment->receiver_no = null;
                $payment->status = 'paid';
                $payment->save();
                $payment->paidby_id = Auth::id();
                //my balance reduce
                $me->balance = $me->balance - 100;
                $me->save();

                //transaction history and pf create start

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
                $ws_pos = $prRow->ws_position + 1;
                $num = $num + $ws_pos;
                $scode = $wsId . $num . $meMob . $dis;

                $s = new Subscriber;
                $s->ws_position = $ws_pos;
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

                // bt will be here
                $bt = new BalanceTransaction;
                // $bt->subscriber_id = $subscription->id;
                $bt->from = 'tenant';
                $bt->to = 'admin';
                $bt->purpose = 'new_subscription';
                $bt->user_id = $me->id;
                $bt->previous_balance = $me->balance + 100;  // user old balance
                $bt->moved_balance = 100; // job cost
                $bt->new_balance = $me->balance; // user new balance
                $bt->type = 'order';
                $bt->details = "To create new (pf-{$s->subscription_code}) subscriber of (T-{$s->user_id}) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is {$payment->id}.";
                $bt->type_id = $payment->id;
                $bt->addedby_id = Auth::id();
                $bt->save();


                //for joining amount to admin
                $joining_to_admin = 100;
                //100tk

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
                    $previousBalance = $s->balance ?: 0;

                    $bt = new BalanceTransaction;
                    $bt->subscriber_id = $s->id;
                    $bt->from = 'admin';
                    $bt->to = 'subscriber';
                    $bt->purpose = 'honorarium';
                    $bt->user_id = $s->user_id;
                    $bt->previous_balance = $s->balance ?: 0;  // user balance
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

                //for balance transfer from admin joining to admin reward fund
                // $rewardComm = Honorarium::where('workstation_id',$s->work_station_id)
                // ->where('active',1)
                // ->where('system_type','Joining')
                // ->where('earning_type','Reward')
                // ->sum('commission');
                // $rewardAmount = $rewardComm; //commmission * (joining fee /100)
                //10tk

                // admin balance

                // $adminLast = $adminLast - $rewardAmount;
                //80tk
                // $admin_balance = $this->updateAdBalance($rewardAmount,$s->work_station_id,'joining_reward');


                //balance transfer  row will be created here for admin Reward fund
                // $bt = new BalanceTransaction;
                // $bt->subscriber_id = $s->id;
                // $bt->from = 'admin';
                // $bt->to = 'admin';
                // $bt->purpose = 'joining_reward';
                // $bt->user_id = $payment->user_id;
                // $bt->previous_balance = $abReward->previous_balance;  // admin joining_reward balance
                // $bt->moved_balance = $rewardAmount; // rewardAmount
                // $bt->new_balance = $abReward->new_balance; // admin new reward balance
                // $bt->type = 'joining_reward';
                // $bt->details = "Reward balance {$rewardAmount} of SubcriberPayment of #{$payment->id} transfered from joining balance to reward balance";

                // $bt->addedby_id = Auth::id();
                // $bt->save();


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
                    // $n = $sub->ws_position - 1;
                    // $i = $n;

                    //new logic start for data loop failure
                    // $refferer = Subscriber::where('ws_position', $i)
                    //     ->where('work_station_id', $sub->work_station_id)
                    //     ->first();
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

                    //new logic end for data loop failure



                    // //loop-logic-for up balance
                    // for($i = $n; $i > 0; $i--)
                    // {
                    //     $refferer = Subscriber::where('ws_position', $i)
                    //     ->where('work_station_id', $sub->work_station_id)
                    //     ->first();
                    //     if($refferer)
                    //     {
                    //         if($refferer->id != $sub->referral_id)
                    //         {
                    //             continue;
                    //         }
                    //         else
                    //         {
                    //             // $adminBalance->joining = $adminBalance->joining - $refferalAmount;
                    //             // $adminRefTransferBalance = $adminRefTransferBalance + $refferalAmount;
                    //             //70tk

                    //             if($rUser = $refferer->user)
                    //             {
                    //                 $set = $rUser->honorarium_earning_set;
                    //                 $refferalCommission = $refferalAmount * ($set / 100);
                    //                 $refferalPerAmt =  $refferalCommission;
                    //                 $reAmount = ($s->referral_id == $refferer->id) ? $refferalAmount : $refferalPerAmt;
                    //                 // nearest introducer will not get penalty
                    //             }
                    //             else
                    //             {
                    //                 $refferalCommission = 0;
                    //                 $refferalPerAmt =  $refferalCommission;
                    //                 $reAmount = ($s->referral_id == $refferer->id) ? $refferalAmount : $refferalPerAmt;
                    //                 // nearest introducer will not get penalty
                    //             }

                    //             //for referer subscriber_honorarium  row will be created here for refferal commission
                    //             $shr = new SubscriberHonorarium;
                    //             $shr->workstation_id = $s->work_station_id;
                    //             $shr->subscriber_id = $refferer->id;
                    //             $shr->user_id = $refferer->user_id;
                    //             $shr->system_type = 'Joining';
                    //             $shr->earning_type = 'Refferal';
                    //             $shr->commission = $reAmount; //in percent
                    //             $shr->amount = $reAmount;
                    //             $shr->delivered_to = 'subscriber';
                    //             $shr->completed = 1;
                    //             $shr->addedby_id = Auth::id();
                    //             if($reAmount > 0)
                    //             {
                    //                 $shr->save();
                    //             }

                    //             // bt will be here
                    //             $bt = new BalanceTransaction;
                    //             $bt->subscriber_id = $refferer->id;
                    //             $bt->from = 'admin';
                    //             $bt->to = 'subscriber';
                    //             $bt->purpose = 'honorarium';
                    //             $bt->user_id = $refferer->user_id;
                    //             $bt->previous_balance = $refferer->balance;  // admin joining_reward balance
                    //             $bt->moved_balance = $reAmount; // rewardAmount
                    //             $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // admin new reward balance
                    //             $bt->type = 'refferal_reward';
                    //             $bt->details = "{$reAmount} tk refferal reward honorarium balance  added to subscriber {$refferer->subscription_code} balance purpose of {$sub->subscription_code}. (udc:828)";

                    //             $bt->addedby_id = Auth::id();
                    //             if($reAmount > 0)
                    //             {
                    //                 $bt->save();
                    //             }

                    //             $refferer->balance = $refferer->balance + $reAmount;
                    //             $refferer->save();

                    //             $refferalAmount = $refferalAmount * (10/100);
                    //             $sub = $refferer;
                    //         }
                    //     }
                    // }

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

                    // if($refferalPerAmt > 0)
                    // {$bt->save();}

                    $bt->save();

                    $refferer->balance = $refferer->balance + $refferalPerAmt;
                    $refferer->save();
                }

                // $adminLast = $adminLast - $adminRefTransferBalance;
                //68 tk
                // $admin_balance = $this->updateAdBalance($adminRefTransferBalance,$s->work_station_id,'joining_referal');

                // joining_referal commission will be here

                // //for pair commission

                // $pairComm = Honorarium::where('workstation_id',$s->work_station_id)
                //     ->where('active',1)
                //     ->where('system_type','Joining')
                //     ->where('earning_type','Pair')
                //     ->sum('commission');
                // $pairAmount = $pairComm; //commmission * (joining fee /100)
                //     //10tk
                // $j = $s->ws_position;
                // $k = $j;
                // // $adminPairTransferBalance = 0;
                // for($j = $s->ws_position; $j > 0; $j--)
                // {

                //     if($k % 2 == 0)
                //     {

                //         break;
                //     }
                //     else
                //     {


                //         if($j != $k)
                //         {

                //             continue;
                //         }
                //         else
                //         {

                //             $id = (int) ($k / 2);

                //             //id will be credited;
                //             $topSubscriber = Subscriber::where('ws_position', $id)
                //             ->where('work_station_id', $s->work_station_id)
                //             ->first();
                //             if($topSubscriber)
                //             {
                //                 // $adminBalance->joining = $adminBalance->joining - $pairAmount;
                //                 // $adminPairTransferBalance = $adminPairTransferBalance + $pairAmount;
                //                 //70tk

                //                 if($rUser = $topSubscriber->user)
                //                 {
                //                     $set = $rUser->honorarium_earning_set;
                //                     $pairCommission = $pairComm * ($set / 100);
                //                     $pairPerAmt =  $pairCommission;

                //                 }
                //                 else
                //                 {
                //                     $pairCommission = 0;
                //                     $pairPerAmt =  $pairCommission;
                //                 }

                //                 //for topSubscriber subscriber_honorarium  row will be created here for refferal commission
                //                 $sht = new SubscriberHonorarium;
                //                 $sht->workstation_id = $s->work_station_id;
                //                 $sht->subscriber_id = $topSubscriber->id;
                //                 $sht->user_id = $topSubscriber->user_id;
                //                 $sht->system_type = 'Joining';
                //                 $sht->earning_type = 'Pair';
                //                 $sht->commission = $pairCommission; //in percent
                //                 $sht->amount = $pairPerAmt;
                //                 $sht->delivered_to = 'subscriber';
                //                 $sht->completed = 1;
                //                 $sht->addedby_id = Auth::id();
                //                 if($pairPerAmt > 0)
                //                 {$sht->save();}

                //                 // bt will  be here
                //                 $bt = new BalanceTransaction;
                //                 $bt->subscriber_id = $topSubscriber->id;
                //                 $bt->from = 'admin';
                //                 $bt->to = 'subscriber';
                //                 $bt->purpose = 'honorarium';
                //                 $bt->user_id = $topSubscriber->user_id;
                //                 $bt->previous_balance = $topSubscriber->balance;  // admin joining_reward balance
                //                 $bt->moved_balance = $pairPerAmt; // rewardAmount
                //                 $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // admin new reward balance
                //                 $bt->type = 'pair';
                //                 $bt->details = "{$pairPerAmt} tk pair honorarium added to subscriber {$topSubscriber->subscription_code} balance.";

                //                 $bt->addedby_id = Auth::id();
                //                 if($pairPerAmt > 0)

                //                 {$bt->save();}

                //                 $topSubscriber->balance = $topSubscriber->balance + $pairPerAmt;
                //                 $topSubscriber->save();

                //                 $k = $id;
                //                 // $pairAmount = $pairAmount * (10/100);

                //             }

                //         }

                //     }
                // }
                // admin balance
                // $adminLast = $adminLast - $adminPairTransferBalance;

                // $admin_balance = $this->updateAdBalance($adminPairTransferBalance,$s->work_station_id,'joining_pair');

                // $adminBalance->save();
                // $admin_balance = $this->updateAdBalance($adminLast,$s->work_station_id,'joining');
                //transaction history and pf create end

                return redirect()->route('user.dashboard')->with('success', 'Your new subscribtion process successfully completed');
            }
            // create new user and make transaction ##atiq
            elseif ($request->for_user == "new") {
                // dd($request->all());
                $validation = Validator::make(
                    $request->all(),
                    [
                        'username' => 'required|string|max:255|min:3',
                        // 'email' => 'nullable|string|email|max:255',
                        // 'sender' => 'required|numeric',
                        'mobile' => 'required|numeric|min:11|unique:users',
                        'password' => 'required|min:8|string'
                    ]
                );

                if ($validation->fails()) {
                    return back()->withInput()->withErrors($validation);
                }

                $numbr = '+' . bdMobile($request->mobile);

                if (strlen($numbr) != 14) {
                    return back()->withInput()->withErrors($validation)->with('error', 'Please, submit Bangladeshi mobile number');
                }

                $oldU = User::withoutGlobalScopes()->where('mobile', $numbr)->first();
                if ($oldU) {
                    return back()->withInput()->withErrors($validation)->with('error', 'This number already saved in our record');
                }



                $newuser = new User;
                $newuser->name = $request->username;
                $newuser->mobile = $numbr;
                $newuser->password = Hash::make($request->password);
                $newuser->save();

                $payment = new SubcriberPayment;
                $payment->user_id = $newuser->id;
                $payment->work_station_id = $workstation->id;
                $payment->amount = $request->amount;
                $payment->refer_id = $reffer_id;
                $payment->district_id = $me->subscriptionDistrict()->id;
                $payment->transaction_no = $request->transection;
                $payment->sender_no = null;
                $payment->receiver_no = null;
                $payment->status = 'paid';
                $payment->paidby_id = Auth::id();
                $payment->save();

                //my balance reduce
                $me->balance = $me->balance - 100;
                $me->save();

                //transaction history and pf create start

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
                $ws_pos = $prRow->ws_position + 1;
                $num = $num + $ws_pos;
                $scode = $wsId . $num . $meMob . $dis;

                $s = new Subscriber;
                $s->ws_position = $ws_pos;
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

                //for joining amount to admin
                $joining_to_admin = 100;
                //100tk

                //for signup commission
                $honorariumComm = Honorarium::where('workstation_id', $s->work_station_id)
                    ->where('active', 1)
                    ->where('system_type', 'Joining')
                    ->where('earning_type', 'Signup')
                    ->sum('commission');
                $joining_signup_commission = $honorariumComm; //commmission * (joining fee /100)
                //10tk

                // $adminBalance->joining = $adminBalance->joining + $joining_to_admin - $joining_signup_commission;

                // $adminLast = $joining_to_admin - $joining_signup_commission;
                //90tk

                $s->save();


                // bt will be here
                $bt = new BalanceTransaction;
                // $bt->subscriber_id = $subscription->id;
                $bt->from = 'tenant';
                $bt->to = 'admin';
                $bt->purpose = 'new_subscription';
                $bt->user_id = $me->id;
                $bt->previous_balance = $me->balance + 100;  // user old balance
                $bt->moved_balance = 100; // job cost
                $bt->new_balance = $me->balance; // user new balance
                $bt->type = 'order';
                $bt->details = "To create new (pf-{$s->subscription_code}) subscriber of (T-{$s->user_id}) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is {$payment->id}. udc:1236";
                $bt->type_id = $payment->id;
                $bt->addedby_id = Auth::id();
                $bt->save();

                //subscriber_honorarium row will be created here
                $sh = new SubscriberHonorarium;
                $sh->workstation_id = $s->work_station_id;
                $sh->subscriber_id = $s->id;
                $sh->user_id = $s->user_id;
                $sh->system_type = 'Joining';
                $sh->earning_type = 'Signup';
                $sh->commission = $honorariumComm; //in percent
                $sh->amount = $joining_signup_commission;
                $sh->delivered_to = 'subscriber';
                $sh->completed = 1;
                $sh->addedby_id = Auth::id();
                $sh->save();


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
                $bt->details = "{$joining_signup_commission} tk joining honorarium balance added to subscriber {$s->subscription_code} balance.";

                $bt->addedby_id = Auth::id();
                $bt->save();

                //for joining comm to subscriber
                $s->balance = $bt->new_balance;
                //10tk
                $s->save();

                //for balance transfer from admin joining to admin reward fund
                // $rewardComm = Honorarium::where('workstation_id',$s->work_station_id)
                // ->where('active',1)
                // ->where('system_type','Joining')
                // ->where('earning_type','Reward')
                // ->sum('commission');
                // $rewardAmount = $rewardComm; //commmission * (joining fee /100)
                //10tk

                // admin balance

                // $adminLast = $adminLast - $rewardAmount;
                //80tk
                // $admin_balance = $this->updateAdBalance($rewardAmount,$s->work_station_id,'joining_reward');


                //balance transfer  row will be created here for admin Reward fund
                // $bt = new BalanceTransaction;
                // $bt->subscriber_id = $s->id;
                // $bt->from = 'admin';
                // $bt->to = 'admin';
                // $bt->purpose = 'joining_reward';
                // $bt->user_id = $payment->user_id;
                // $bt->previous_balance = $abReward->previous_balance;  // admin joining_reward balance
                // $bt->moved_balance = $rewardAmount; // rewardAmount
                // $bt->new_balance = $abReward->new_balance; // admin new reward balance
                // $bt->type = 'joining_reward';
                // $bt->details = "Reward balance {$rewardAmount} of SubcriberPayment of #{$payment->id} transfered from joining balance to reward balance";

                // $bt->addedby_id = Auth::id();
                // $bt->save();


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
                    // $n = $sub->ws_position - 1;
                    // $i = $n;

                    //loop-failure code start
                    // $refferer = Subscriber::where('ws_position', $i)
                    //     ->where('work_station_id', $sub->work_station_id)
                    //     ->first();

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
                        $shr->commission =  $reAmount; //in percent
                        $shr->amount =  $reAmount;
                        $shr->delivered_to = 'subscriber';
                        $shr->completed = 1;
                        $shr->addedby_id = Auth::id();
                        if ($reAmount > 0) {
                            $shr->save();
                        }


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
                        $bt->details = "{$reAmount} tk refferal reward honorarium balance added to subscriber {$refferer->subscription_code} balance  purpose of {$sub->subscription_code}. ( udc:1317)";

                        $bt->addedby_id = Auth::id();
                        // if( $reAmount > 0)
                        // {$bt->save();}

                        $bt->save();

                        // $refferer->balance = $bt->new_balance;
                        $refferer->balance = $refPreBalance + $reAmount;
                        $refferer->save();
                    }

                    //loop-failure logic end

                    // //loop-logic start
                    // for($i = $n; $i > 0; $i--)
                    // {
                    //     $refferer = Subscriber::where('ws_position', $i)
                    //     ->where('work_station_id', $sub->work_station_id)
                    //     ->first();
                    //     if($refferer)
                    //     {
                    //         if($refferer->id != $sub->referral_id)
                    //         {
                    //             continue;
                    //         }
                    //         else
                    //         {
                    //             // $adminBalance->joining = $adminBalance->joining - $refferalAmount;
                    //             // $adminRefTransferBalance = $adminRefTransferBalance + $refferalAmount;
                    //             //70tk

                    //             if($rUser = $refferer->user)
                    //             {
                    //                 $set = $rUser->honorarium_earning_set;
                    //                 $refferalCommission = $refferalAmount * ($set / 100);
                    //                 $refferalPerAmt =  $refferalCommission;
                    //                 $reAmount = ($s->referral_id == $refferer->id) ? $refferalAmount : $refferalPerAmt;
                    //                 // nearest introducer will not get penalty
                    //             }
                    //             else
                    //             {
                    //                 $refferalCommission = 0;
                    //                 $refferalPerAmt =  $refferalCommission;
                    //                 $reAmount = ($s->referral_id == $refferer->id) ? $refferalAmount : $refferalPerAmt;
                    //                 // nearest introducer will not get penalty

                    //             }







                    //             //for referer subscriber_honorarium  row will be created here for refferal commission
                    //             $shr = new SubscriberHonorarium;
                    //             $shr->workstation_id = $s->work_station_id;
                    //             $shr->subscriber_id = $refferer->id;
                    //             $shr->user_id = $refferer->user_id;
                    //             $shr->system_type = 'Joining';
                    //             $shr->earning_type = 'Refferal';
                    //             $shr->commission =  $reAmount; //in percent
                    //             $shr->amount =  $reAmount;
                    //             $shr->delivered_to = 'subscriber';
                    //             $shr->completed = 1;
                    //             $shr->addedby_id = Auth::id();
                    //             if($reAmount > 0)
                    //             {$shr->save();}


                    //             // bt will be here
                    //             $refPreBalance = $refferer->balance;
                    //             $bt = new BalanceTransaction;
                    //             $bt->subscriber_id = $refferer->id;
                    //             $bt->from = 'admin';
                    //             $bt->to = 'subscriber';
                    //             $bt->purpose = 'honorarium';
                    //             $bt->user_id = $refferer->user_id;
                    //             $bt->previous_balance = $refferer->balance;  // admin joining_reward balance
                    //             $bt->moved_balance =  $reAmount; // rewardAmount
                    //             $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // admin new reward balance
                    //             $bt->type = 'refferal_reward';
                    //             $bt->details = "{$reAmount} tk refferal reward honorarium balance added to subscriber {$refferer->subscription_code} balance  purpose of {$sub->subscription_code}. ( udc:1317)";

                    //             $bt->addedby_id = Auth::id();
                    //             if( $reAmount > 0)
                    //             {$bt->save();}



                    //             // $refferer->balance = $bt->new_balance;
                    //             $refferer->balance = $refPreBalance + $reAmount;
                    //             $refferer->save();

                    //             $refferalAmount = $refferalAmount * (10/100);
                    //             $sub = $refferer;
                    //         }
                    //     }
                    // }

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
                    $bt->details = "{$refferalAmount} tk refferal reward honorarium added to subscriber {$refferer->subscription_code} balance. (drct: udc:1169)";


                    $bt->addedby_id = Auth::id();
                    $bt->save();

                    $refferer->balance = $bt->new_balance;
                    $refferer->save();
                }

                // $adminLast = $adminLast - $adminRefTransferBalance;
                //68 tk
                // $admin_balance = $this->updateAdBalance($adminRefTransferBalance,$s->work_station_id,'joining_referal');

                // joining_referal commission will be here

                // //for pair commission

                // $pairComm = Honorarium::where('workstation_id',$s->work_station_id)
                //     ->where('active',1)
                //     ->where('system_type','Joining')
                //     ->where('earning_type','Pair')
                //     ->sum('commission');
                // $pairAmount = $pairComm; //commmission * (joining fee /100)
                //     //10tk
                // $j = $s->ws_position;
                // $k = $j;
                // // $adminPairTransferBalance = 0;
                // for($j = $s->ws_position; $j > 0; $j--)
                // {

                //     if($k % 2 == 0)
                //     {

                //         break;
                //     }
                //     else
                //     {


                //         if($j != $k)
                //         {

                //             continue;
                //         }
                //         else
                //         {

                //             $id = (int) ($k / 2);

                //             //id will be credited;
                //             $topSubscriber = Subscriber::where('ws_position', $id)
                //             ->where('work_station_id', $s->work_station_id)
                //             ->first();
                //             if($topSubscriber)
                //             {
                //                 // $adminBalance->joining = $adminBalance->joining - $pairAmount;
                //                 // $adminPairTransferBalance = $adminPairTransferBalance + $pairAmount;
                //                 //70tk

                //                 if($rUser = $topSubscriber->user)
                //                 {
                //                     $set = $rUser->honorarium_earning_set;
                //                     $pairCommission = $pairComm * ($set / 100);
                //                     $pairPerAmt =  $pairCommission;

                //                 }
                //                 else
                //                 {
                //                     $pairCommission = 0;
                //                     $pairPerAmt =  $pairCommission;
                //                 }

                //                 //for topSubscriber subscriber_honorarium  row will be created here for refferal commission
                //                 $sht = new SubscriberHonorarium;
                //                 $sht->workstation_id = $s->work_station_id;
                //                 $sht->subscriber_id = $topSubscriber->id;
                //                 $sht->user_id = $topSubscriber->user_id;
                //                 $sht->system_type = 'Joining';
                //                 $sht->earning_type = 'Pair';
                //                 $sht->commission = $pairCommission; //in percent
                //                 $sht->amount = $pairPerAmt;
                //                 $sht->delivered_to = 'subscriber';
                //                 $sht->completed = 1;
                //                 $sht->addedby_id = Auth::id();
                //                 if($pairPerAmt > 0)
                //                 {$sht->save();}

                //                 // bt will be here
                //                 $topSpreBalance = $topSubscriber->balance;
                //                 $bt = new BalanceTransaction;
                //                 $bt->subscriber_id = $topSubscriber->id;
                //                 $bt->from = 'admin';
                //                 $bt->to = 'subscriber';
                //                 $bt->purpose = 'honorarium';
                //                 $bt->user_id = $topSubscriber->user_id;
                //                 $bt->previous_balance = $topSubscriber->balance;  // admin joining_reward balance
                //                 $bt->moved_balance = $pairPerAmt; // rewardAmount
                //                 $bt->new_balance = $bt->previous_balance + $bt->moved_balance; // admin new reward balance
                //                 $bt->type = 'pair';
                //                 $bt->details = "{$pairPerAmt} tk pair honorarium added to subscriber {$topSubscriber->subscription_code} balance.";

                //                 $bt->addedby_id = Auth::id();
                //                 if($pairPerAmt > 0)

                //                 {$bt->save();}

                //                 $topSubscriber->balance = $topSpreBalance + $pairPerAmt;
                //                 $topSubscriber->save();

                //                 $k = $id;
                //                 // $pairAmount = $pairAmount * (10/100);

                //             }

                //         }

                //     }
                // }
                // admin balance
                // $adminLast = $adminLast - $adminPairTransferBalance;

                // $admin_balance = $this->updateAdBalance($adminPairTransferBalance,$s->work_station_id,'joining_pair');

                // $adminBalance->save();
                // $admin_balance = $this->updateAdBalance($adminLast,$s->work_station_id,'joining');
                //transaction history and pf create end

                return redirect()->route('user.dashboard')->with('success', 'Your new subscribtion process successfully completed');
            }
            // for new tenant
        } else {
            // $request->for_user == "new"
            if ($request->for_user == "own") {
                $myOrder = SubcriberPayment::where('user_id', $me->id)->where('work_station_id', $workstation->id)->where('status', 'pending')->first();

                if ($myOrder) {
                    return back()->with('error', 'Your previous order is pending.');
                }

                $payment = new SubcriberPayment;
                $payment->user_id = $me->id;
                $payment->cat_id = $category->id;
                $payment->work_station_id = $workstation->id;
                $payment->amount = $request->amount;
                $payment->refer_id = $reffer_id;
                $payment->district_id = $me->subscriptionDistrict()->id;
                $payment->transaction_no = $request->transection;
                $payment->sender_no = $request->sender;
                $payment->receiver_no = '01821952907';
                $payment->status = 'pending';

                $payment->save();

                return redirect()->route('user.dashboard')->with('success', 'Your subscribtion order is pending. Please wait untill approve.');
            } elseif ($request->for_user == "new") {

                $numbbr = '+' . bdMobile($request->mobile);

                $oldUs = User::withoutGlobalScopes()->where('mobile', $numbbr)->first();
                if ($oldUs) {
                    return back()->withInput()->with('error', 'This number already saved in our record');
                }

                $newuser = new User;
                $newuser->name = $request->username;
                $newuser->mobile = $numbbr;
                $newuser->password = Hash::make($request->password);
                $newuser->save();

                $payment = new SubcriberPayment;
                $payment->user_id = $newuser->id;
                $payment->cat_id = $category->id;
                $payment->work_station_id = $workstation->id;
                $payment->amount = $request->amount;
                $payment->refer_id = $reffer_id;
                $payment->district_id = $me->subscriptionDistrict()->id;
                $payment->transaction_no = $request->transection;
                $payment->sender_no = $request->sender;
                $payment->receiver_no = '01821952907';
                $payment->status = 'pending';

                $payment->save();

                return redirect()->route('user.dashboard')->with('success', 'Your subscribtion order is pending. Please wait untill approve.');
            }
        }

        return back();
    }
    ///Deposit Money

    public function addNagAddMoney(Request $request)
    {
        $me = Auth::user();
        $order = Order::where('payment_status', 'temp')->where('user_id', $me->id)->first();
        $invoice = "SC" . rand(11111, 99999) . Carbon::now()->format('ymd');
        if (!$order) {
            $order = new Order;
            $order->user_id = $me->id;
            $order->work_station_id = null;
            $order->subscriber_id = null;
            $order->paid_amount = $request->amount;
            $order->name = $me->name;
            $order->mobile = $me->mobile;
            $order->inv_id = $invoice;
            $order->amount = $request->amount;
            $order->order_for = 'deposit';
            $order->order_status = 'temp';
            $order->payment_status = 'unpaid';
            $order->pending_at = Carbon::now();
            $order->save();
        }
        $order->inv_id = $invoice;
        $order->amount = $request->amount;
        $order->save();

        $result = new OnlinePaymentController;
        // return $request->amount;
        // $invoice = "SC" . rand(100, $payment->id);
        $result->getNagad($request->amount,  $order->inv_id, 'deposit');
        $_SESSION['type'] = "deposit";
        // $_SESSION['category'] = $cat;
    }


    public function job()
    {
        $request = request();
        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'job', 'lsbsm' => 'job']);

        $categories = Category::all();
        $subcategories = Subcategory::select(['id', 'title', 'category_id'])->orderBy('title')->get();
        return view('user.job.job', [
            'categories' => $categories,
            'subcategories' => $subcategories->toArray()
        ]);
    }

    public function postJob()
    {
        $request = request();
        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'postjob', 'lsbsm' => 'postjob']);

        return view('user.job.job');
    }

    //Date 10-04-2021 Start

    public function myServicesDashboard()
    {
        menuSubmenu('dashboard', 'services');
        $user = Auth::user();
        $all_profiles = ServiceProfile::where('user_id', $user->id)
            ->where('profile_type', 'business')
            ->paginate(100);
        return view('user.services.myServices', compact('user', 'all_profiles'));
    }
    public function myServicesprofileUpdate(Request $request)
    {
        $profile = ServiceProfile::where('id', $request->profile)->first();
        if (!$profile) {
            return redirect()->back();
        }
        if ($profile->user_id != Auth::id()) {
            return redirect()->back();
        }
        $category = Category::where('id', $profile->ws_cat_id)->first();

        if($request->open == 'pay'){

            if( $profile->paystatus=='1'){
                return redirect()->back()->with('success','You Already pay for this account'); 
            }


            $whoCreatingAccount = Auth::user();

            if ($whoCreatingAccount->balance < 100) {
           
                return redirect()->route('user.userBalance')->with('error', 'Your account balance less then 100 tk. If you want to create service then please recharge.');
               
                //return redirect()->back()->with('error', 'Your account balance less then ' . $category->sp_create_charge . '. if you want to create service then please recharge.');
            }else{
                $bt = new BalanceTransaction;
                $bt->from = 'user';
                $bt->to = 'admin';
                $bt->purpose = 'sp_create_charge';
                $bt->subscriber_id = $profile->subscription_id;
                $bt->user_id = $whoCreatingAccount->id;
                $bt->previous_balance = $whoCreatingAccount->balance;  // user old balance
                $bt->moved_balance = 100; // job cost
                $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
                $bt->type = 'service';
                $bt->details = "{$bt->moved_balance} TK deducted from User balance. to Createing Service/Shop for user_id({$whoCreatingAccount->id}), Mobile ($whoCreatingAccount->mobile) .";
                $bt->type_id = $profile->ws_cat_id;
                $bt->addedby_id = Auth::id();
                $bt->save();
                $whoCreatingAccount->decrement('balance', $bt->moved_balance);
                $whoCreatingAccount->increment('ad_balance', $category->sp_adtopup_bonus);
                $profile->expired_at = Carbon::now()->addDay(365);
                $profile->paystatus = 1;
                $profile->status = 1;
                $profile->is_trial = 0;
                $profile->save();


            }
            return redirect()->back()->with('success', 'Your service profile payment successfull');





        }
        if ($request->open == 'open') {
            $profile->open = true;
            $profile->save();
            //   return redirect()->back()->with('success','Your Status is updated to Open');
        } elseif ($request->open == 'closed') {
            $profile->open = false;
            $profile->save();
            // return redirect()->back()->with('success','Your Status is updated to Open');
        } else {
            return back()->with('error', 'Something wrong');
        }
        return redirect()->back()->with('success', 'Your Status is updated to ' . $request->open . '');
    }

    public function servicesSearchDashboard(Request $request)
    {
        menuSubmenu('dashboard', 'search');
        $user = Auth::user();
        $service_station = WorkStation::all();
        return view('user.services.serviceSearch', compact('user', 'service_station'));
    }
    public function servicesSearchFilterDashboard(Request $request)
    {
        menuSubmenu('dashboard', 'search');
        $user = Auth::user();
        $service_station = WorkStation::all();
        $service_station_id = $request->service_station;
        $workstation_cat = $request->workstation_cat;


        if (isset($request->service_station) && isset($request->workstation_cat)) {
            $station_wise_cat = $service_station->where('id', $service_station_id)->first()->categories;
            $selected_category = Category::where('id', $workstation_cat)->first();

            // $services = ServiceProfile::where('workstation_id', $request->service_station)
            //     ->where('ws_cat_id', $request->workstation_cat)
            //     // ->where('user_id', $user->id)
            //     ->where('profile_type', 'business')
            //     ->where('status', 1)
            //     ->paginate(18);
            $shops =  ServiceProfile::where('workstation_id', $request->service_station)
                ->where('ws_cat_id', $request->workstation_cat)
                // ->where('user_id', $user->id)
                ->where('profile_type', 'business')
                ->where('status', 1)
                ->where('paystatus', 1)
                ->paginate(24);
            return view('user.services.serviceSearchFilter', compact(
                'user',
                'service_station',
                // 'services',
                'workstation_cat',
                'service_station_id',
                'selected_category',
                'station_wise_cat',
                'shops'
            ));
        }
        return back()->with('warning', 'please select a Service Station and a category!!!');
    }

    public function allSubscribersStation()
    {
        menuSubmenu('dashboard', 'station');
        $catwise_servie_station = Category::orderBy('work_station_id')->paginate(12);
        $user = Auth::user();
        // $post_paid_subscription= Subscriber::where()
        return view('user.services.allServiceStation', compact('user','catwise_servie_station'));
    }

    public function createPostpaidAccountInAllCat(Request $request)
    {
       
        $haveSubscription = Category::whereDoesntHave('subscription', function ($query) {
            $query->where('user_id', Auth::id());
        })->get()->take(10);
        if (count($haveSubscription) == 0) {
            return redirect()->back()->with('warning', 'You have already account in all categories');
        }
        foreach ($haveSubscription as $key => $category) {
            $workstation = Workstation::find($category->work_station_id);

            $me = Auth::user();
            $cookieReffer_id = null;
          

            if (!$me->subscriptions()->count()) {
                $rvd = $me->verifiedDatas()->first();
                if ($rvd) {
                    $cookieReffer_id = $rvd->reffer_code;
                }
            }
          
            $code = Subscriber::where('subscription_code', $cookieReffer_id)
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

            $prRow = Subscriber::where('work_station_id', $workstationId)->orderBy('ws_position', 'desc')->first();

            $dis = $me->subscriptionDistrict()->id;
            if (strlen($dis) < 2) {
                $dis = '0' . $dis;
            }

            $wsId = $workstationId;
            if (strlen($wsId) < 2) {
                $wsId = '0' . $wsId;
            }

            $meMob = $me->mobile ?: '00';
            if (strlen($meMob) > 2) {
                // $meMob = last 2 digit;
                $meMob = substr($meMob, -2);
            }

            $num = 100000000;
            $ws_pos = $prRow->ws_position + 1;
            $num = $num + $ws_pos;
            $scode = $wsId . $num . $meMob . $me->subscriptionDistrict()->id;

            $s = new Subscriber;
            $s->ws_position = $ws_pos;
            $s->name = $me->name;
            $s->email = $me->email;
            $s->mobile = $me->mobile;
            $s->category_id = $category->id;
            $s->district_id = $me->subscriptionDistrict()->id;
            $s->user_id = $me->id;
            $s->referral_id = $reffer_id;
            $s->work_station_id = $workstationId;
            $s->subscription_code = $scode;
            $s->addedby_id = Auth::id();
            $s->free_account = 1;

            $s->save();
           
        }
        return redirect()->back()->with('success', 'Accounts Created Successfully');
    }

    public function addServiceProduct(Request $request)
    {
        $user = Auth::user();
        $profile = ServiceProfile::where('user_id', $user->id)->first();

        // $subscription = Subscriber::where('user_id', Auth::id())->where('category_id', $profile->ws_cat_id)->first();
        $service_station = WorkStation::has('isOrderTrueInCategories')->get();
        // $subscription= Subscriber::where('user_id',Auth::id())->first();
        // if ($subscription) {
        //     $subscription_code= $subscription->subscription_code;
        // }else{

        //     $workstation = Workstation::find($profile->workstation_id);

        //     $me = Auth::user();
        //     $cookieReffer_id = null;

        //     if (!$me->subscriptions()->count()) {
        //         $rvd = $me->verifiedDatas()->first();
        //         if ($rvd) {
        //             $cookieReffer_id = $rvd->reffer_code;
        //         }
        //     }
        //     $code = Subscriber::where('subscription_code', $cookieReffer_id)
        //         ->where('id', '>', 15)
        //         ->where('subscription_code', '<>', null)
        //         ->where('work_station_id', $workstation->id)
        //         ->first();

        //     if ($code) {
        //         $workstationId = $code->work_station_id;
        //         $reffer_id = $code->id;
        //     } else {

        //         if ($sf = $me->isWSSubscription($workstation)) {

        //             $reffer_id = $sf->id;
        //             $workstationId = $workstation->id;
        //         } else {
        //             $reffer_id = null;
        //             // $reffer_id = $workstation->id + 15;
        //             $workstationId = $workstation->id;
        //         }
        //     }

        //     $prRow = Subscriber::where('work_station_id', $workstationId)->orderBy('ws_position', 'desc')->first();

        //     $dis = $me->subscriptionDistrict()->id;
        //     if (strlen($dis) < 2) {
        //         $dis = '0' . $dis;
        //     }

        //     $wsId = $workstationId;
        //     if (strlen($wsId) < 2) {
        //         $wsId = '0' . $wsId;
        //     }

        //     $meMob = $me->mobile ?: '00';
        //     if (strlen($meMob) > 2) {
        //         // $meMob = last 2 digit;
        //         $meMob = substr($meMob, -2);
        //     }

        //     $num = 100000000;
        //     $ws_pos = $prRow->ws_position + 1;
        //     $num = $num + $ws_pos;
        //     $scode = $wsId . $num . $meMob . $me->subscriptionDistrict()->id;

        //     $s = new Subscriber;
        //     $s->ws_position = $ws_pos;
        //     $s->name = $me->name;
        //     $s->email = $me->email;
        //     $s->mobile = $me->mobile;
        //     $s->category_id = $profile->ws_cat_id;
        //     $s->district_id = $me->subscriptionDistrict()->id;
        //     $s->user_id = $me->id;
        //     $s->referral_id = $reffer_id;
        //     $s->work_station_id = $workstationId;
        //     $s->subscription_code = $scode;
        //     $s->addedby_id = Auth::id();
        //     $s->free_account = 1;
        //     $s->save();
        //     $subscription_code = $s->subscription_code;

        // }
        $myServiceProfile = ServiceProfile::where('user_id', Auth::id())->where('profile_type', 'business')->where('paystatus', 1)->where('status', true)->get();
        if (count($myServiceProfile) < 0) {
            return redirect()->route('subscriber.subscriptionPostBusinessProfile', ['subscription' => 12]);
        }
        $product = new ServiceProfileProduct;
        // $product->
        return view('user.serviceProfileProducts.addServiceProducts', compact('user', 'service_station', 'myServiceProfile'));
    }
    public function searchOrderwiseCategoryAjax(Request $request)
    {
        $service_station = WorkStation::where('id', $request->id)->first();
        $cat = Category::where('work_station_id', $service_station->id)->where('sp_order', true)->get();
        $subscription = Subscriber::where('user_id', Auth::id())->first();
        $subscription_code = null;
        if (!$subscription) {
            $workstation = Workstation::find($cat->work_station_id);

            $me = Auth::user();
            $cookieReffer_id = null;

            if (!$me->subscriptions()->count()) {
                $rvd = $me->verifiedDatas()->first();
                if ($rvd) {
                    $cookieReffer_id = $rvd->reffer_code;
                }
            }
            $code = Subscriber::where('subscription_code', $cookieReffer_id)
                ->where('id', '>', 15)
                ->where('subscription_code', '<>', null)
                ->where('work_station_id', $workstation->id)
                ->first();

            if ($code) {
                $workstationId = $code->work_station_id;
                $reffer_id = $code->id;
            } else {

                if ($sf = $me->isWSSubscription($workstation)) {

                    $reffer_id = $sf->id;
                    $workstationId = $workstation->id;
                } else {
                    $reffer_id = null;
                    // $reffer_id = $workstation->id + 15;
                    $workstationId = $workstation->id;
                }
            }

            $prRow = Subscriber::where('work_station_id', $workstationId)->orderBy('ws_position', 'desc')->first();

            $dis = $me->subscriptionDistrict()->id;
            if (strlen($dis) < 2) {
                $dis = '0' . $dis;
            }

            $wsId = $workstationId;
            if (strlen($wsId) < 2) {
                $wsId = '0' . $wsId;
            }

            $meMob = $me->mobile ?: '00';
            if (strlen($meMob) > 2) {
                // $meMob = last 2 digit;
                $meMob = substr($meMob, -2);
            }

            $num = 100000000;
            $ws_pos = $prRow->ws_position + 1;
            $num = $num + $ws_pos;
            $scode = $wsId . $num . $meMob . $me->subscriptionDistrict()->id;

            $s = new Subscriber;
            $s->ws_position = $ws_pos;
            $s->name = $me->name;
            $s->email = $me->email;
            $s->mobile = $me->mobile;
            $s->category_id = $cat->id;
            $s->district_id = $me->subscriptionDistrict()->id;
            $s->user_id = $me->id;
            $s->referral_id = $reffer_id;
            $s->work_station_id = $workstationId;
            $s->subscription_code = $scode;
            $s->addedby_id = Auth::id();
            $s->free_account = 1;
            $s->save();
            $subscription_code = $s->subscription_code;
        } else {
            $subscription_code = $subscription->subscription_code;
        }
        $dd = ['hi' => $subscription_code];
        return response()->json([
            'categories' => $cat,
            'subscription_code' => $subscription_code,
            'pp' => $dd
        ]);
    }
    public function checkServiceProfile(Request $request)
    {
        $service_profiles = ServiceProfile::where('ws_cat_id', $request->id)->where('user_id', Auth::id())->where('profile_type', 'business')->get();
        $cat = Category::find($request->id);
        return response()->json([
            'service_profiles' => $service_profiles
        ]);
    }
    public function submitServiceProduct(Request $request)
    {
        return $request->all();
    }


    public function allOpinions(Request $request)
    {
        menuSubmenu('opinion', 'allopinions');
        $user = Auth::user();
        $opinions = Opinion::where('status', 'lived')->orderBy('id', 'DESC')->has('user')->paginate(100);
        // $opinions = Opinion::all();
        $populerOpenions = Opinion::where('status', 'lived')->orderBy('visit_count', 'DESC')->has('user')->get();

        return view('user.opinion.all', compact('user', 'opinions', 'populerOpenions'));
    }
    public function myOpinions(Request $request)
    {
        menuSubmenu('opinion', 'myopinions');
        $user = Auth::user();
        $my_opinions = Opinion::where('user_id', Auth::id())->orderBy('id', 'DESC')->orderBy('status', "DESC")->paginate(100);
        // $opinions= Opinion::where('user_id',Auth::id())->orderBy('id','DESC')->paginate(100);
        return view('user.opinion.my', compact('user', 'my_opinions'));
    }

    public function addOpinions(Request $request)
    {
        menuSubmenu('opinion', 'addopinions');
        $user = Auth::user();
        return view('user.opinion.add', compact('user'));
    }
    public function storeOpinions(Request $request)
    {
        $request->validate([
            'opinion' => 'required'
        ]);
        try {
            $opinion = new Opinion;
            $opinion->opinion = $request->opinion;
            $opinion->user_id = Auth::id();
            $opinion->addedby_id = Auth::id();
            $opinion->save();
            return back()->with('success', 'Thanks for your Opinion. Admin will be review your opinion and approved!!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Worng!!');
        }
    }
    public function editOpinion(Request $request)
    {
        $user = Auth::user();
        $user_opinion = Opinion::where('id', $request->opinion)->first();
        if ($user_opinion->user_id != $user->id) {
            return back()->with('warning', 'You are not able to edit another user Opinion');
        }

        return view('user.opinion.edit', compact('user', 'user_opinion'));
    }
    public function viewOpinion(Request $request)
    {
        $opinion = Opinion::where('id', $request->opinion)->first();
        return view('admin.opinions.view', compact('opinion'));
    }
    public function updateOpinion(Request $request)
    {
        $request->validate([
            'opinion' => 'required'
        ]);
        $update_opinion = Opinion::where('id', $request->opinion_id)->first();
        $update_opinion->opinion = $request->opinion;
        $update_opinion->status = 'pending';
        $update_opinion->save();
        return redirect()->back()->with('success', 'Opinion Updated Successfully and your status in pending. as son as possible admin will aprove your opinion ');
    }
    public function deleteOpinion(Request $request)
    {
        $user = Auth::user();
        $user_opinion = Opinion::where('id', $request->opinion)->first();
        if ($user_opinion->user_id != $user->id) {
            return back()->with('warning', 'You are not able to Delete another user Opinion');
        }
        $user_opinion->delete();
        return back()->with('success', 'your Opinion Deleted Successfully');
    }

    public function searchCategoryAjax(Request $request)
    {
        $service_station = WorkStation::where('id', $request->id)->first();
        return response()->json([
            'categories' => $service_station->categories
        ]);
    }

    public function postPaidOrFullPaidDashboard(Request $request)
    {
        if($request->user){
            $user = User::Where('id',$request->user)->first();
        }else{
            $user = Auth::user();  
        }

        if ($request->type == "post_paid" || $request->type == "full_paid") {
            if ($request->type == "post_paid") {
                menuSubmenu('dashboard', 'post_paid');
                $dashboard_title = "Unpaid";
                $accounts = Subscriber::where('user_id', $user->id)->where('free_account', true)->where('active', true)->orderBy('work_station_id')->orderBy('category_id')->paginate(100);
            }
            if ($request->type == "full_paid") {
                menuSubmenu('dashboard', 'full_paid');
                $dashboard_title = "Paid";
                $accounts = Subscriber::where('user_id', $user->id)->where('free_account', false)->orderBy('work_station_id')->orderBy('category_id')->paginate(100);
                // $accounts = Subscriber::where('user_id', $user->id)->where('free_account', false)->paginate(100);
            }
            return view('user.services.postOrFullPaidDashboard', compact('user', 'accounts', 'dashboard_title'));
        }
        // return redirect()->to('mypanel/dashboard');
        return redirect()->back();
    }
    //My orders
    public function myOrders(Request $request)
    {
        menuSubmenu('orders', 'myorders');
        $user = Auth::user();
        $my_orders = ServiceProductOrder::where('user_id', $user->id)->orderBy('id', "DESC")->paginate(50);
        return view('user.serviceOrders.my.myOrders', compact('user', 'my_orders'));
    }
    public function myOrderDetails(Request $request)
    {
        menuSubmenu('orders', 'myorders');
        $order = ServiceProductOrder::where('id', $request->order)->where('user_id', Auth::id())->first();
        // return $order->serviceProfile->fi();
        $orderItems = ServiceProductOrderItem::where('service_product_order_id', $order->id)->where('user_id', Auth::id())->get();
        if (!$order or !$orderItems) {
            return redirect()->back()->with('warning', 'You are not able to see Details of another Subscriber Order');
        }
        $user = Auth::user();
        return view('user.serviceOrders.my.orderDetails', compact('order', 'orderItems', 'user'));
    }
    public function myOrderDetailsUpdate(Request $request)
    {


        $order = ServiceProductOrder::where('id', $request->order_id)->first();
       

        if ($request->order_status == $order->order_status) {
            return back()->with('warning', 'Order status Already updated');
        }
        $me = Auth::user();
        $at_field = $request->order_status . '_at';

            ServiceProductOrderItem::where('service_product_order_id', $request->order_id)->update([
                'order_status' => $request->order_status,
                $at_field => Carbon::now(), 
                'editedby_id' => Auth::id()
            ]);

            
        $category=Category::Where('id',$request->cat_id)->first();
        $comission_per=$category->service_product_commission;
        $comission_amount=($order->total_sale_price*($comission_per/100));

        $owner_amount=($order->total_sale_price-$comission_amount);
        //dd($owner_amount);

        $serviceProfileWoner = $order->serviceProfile->user;

        $admin=User::Where('id','2')->first();
        //dd($admin);

        //dd($owner_amount);

        // User::find($item->serviceProfile->user_id);

        if($order->payment_status == 'advanced'){
            $bt = new BalanceTransaction;
            $bt->user_id = $order->serviceProfile->user_id;
            $bt->subscriber_id = $order->serviceProfile->subscriber_id;
            $bt->from = "order_user"; // 
            $bt->to = "profile_owner"; //saller User 
            $bt->purpose = 'order_confirmed_balance';
            $bt->previous_balance = $serviceProfileWoner->balance;
            $bt->moved_balance = $owner_amount;
            $bt->new_balance = $bt->previous_balance + $bt->moved_balance;
            $bt->type = 'profile_order'; 
            $bt->type_id = $order->id;
            $bt->details = 'Balance (' . $bt->moved_balance . ') Added from For Order. Transaction id:(' . $order->	transection_id . ')';
            $bt->save();
    
            $at = new BalanceTransaction;
            $at->user_id = '2';
            $at->from = "order_user"; // 
            $at->to = "admin"; //saller User 
            $at->purpose = 'order_confirmed_balance';
            $at->previous_balance = $admin->balance;
            $at->moved_balance = $comission_amount;
            $at->new_balance = $at->previous_balance + $at->moved_balance;
            $at->type = 'profile_order';
            $at->type_id = $order->id;
            $at->details = 'Balance (' . $at->moved_balance . ') Added from For Order Comission. Transaction id: (' . $order->	transection_id . ')';
            $at->save();
    
            $serviceProfileWoner->increment('balance', $bt->moved_balance);
            $admin->increment('balance', $at->moved_balance);
            $order->decrement('order_confirmed_price', $order->total_sale_price);
            $order->payment_status = 'paid';
            $order->save();  

        }

        ServiceProductOrder::where('id', $request->order_id)->update([
            'order_status' => $request->order_status,
             $at_field => Carbon::now(), 
            'editedby_id' => Auth::id()
        ]);

        $notification1=new OrderNotifications;
        $notification1->type='order';
        $notification1->title='Order Status Changed';
        $notification1->messages= "Order status is {$request->order_status}";
        $notification1->details="Order status is {$request->order_status}. Order Invoice: {$order->transection_id}";
        $notification1->user_id=$order->serviceProfile->user_id;
        $notification1->status='1';
        $notification1->date=now();
        $notification1->link=$order->id;
        $notification1->save();
    
        $notification2=new OrderNotifications;
        $notification2->type='order';
        $notification2->title='Order Status Changed';
        $notification2->messages= "Your change order status.Order status is {$request->order_status}";
        $notification2->details="Your change order status.Order status is {$request->order_status}.Order Invoice: {$order->transection_id}";
        $notification2->user_id=Auth::id();
        $notification2->status='1';
        $notification2->date=now();
        $notification2->link=$order->id;
        $notification2->save();

        if ($request->order_status == 'satisfied') {
            return redirect()->route('user.addOpinions')->with('success', 'Order Status updated Successfully');
        }
        if ($request->order_status == 'unsatisfied') {
            return redirect()->route('user.suggesions')->with('success', 'Admin Will be review your order and get back to you. Thanks For using Softcode');
        }

       

       
    }

    public function myServieProfileOrders(Request $request)
    {
        menuSubmenu('orders', 'serviceProfileOrders');
        $user = Auth::user();
        $myProfileIds = ServiceProfile::where('user_id', Auth::id())->where('profile_type', 'business')->pluck('id');
        $orders = ServiceProductOrder::whereIn('service_profile_id', $myProfileIds)->orderBy('id', 'DESC')->paginate(30);
        $deliveryman=DeliveryMan::where('user_id',$user->id)->get();

        return view('user.serviceOrders.myProfileOrders.myProfileOrders', compact('orders', 'user','deliveryman'));
    }
    public function myProfileOrderDetails(Request $request)
    {
        $future = strtotime('21 July 2012'); //Future date.
        // $timefromdb = Carbon::now()->addDays(5);
        // $d= Carbon::now()->diffInDays($timefromdb, false);
        // return $d;
        //   $subscription_end = new Carbon('2016-08-19 00:56:48');

        //     $left = $subscription_end->subDays(Carbon::now()->dayOfWeek());

        //     return $left->diffForHumans();

        menuSubmenu('orders', 'serviceProfileOrders');
        $user = Auth::user();
        $myProfile = ServiceProfile::where('user_id', Auth::id())->where('id', $request->profile)->where('profile_type', 'business')->first();
        if (!$myProfile) {
            return redirect()->back()->with('warning', 'This is not your profile');
        }
        $order = ServiceProductOrder::where('service_profile_id', $myProfile->id)->where('id', $request->order)->first();

        return view('user.serviceOrders.myProfileOrders.myProfileOrderDetails', compact('order', 'user'));
    }

    public function myServieProfileProducts(Request $request)
    {
        $user = Auth::user();
        menuSubmenu('product', 'product');
        $myallProducts = ServiceProfileProduct::where('user_id', Auth::id())
            ->where('status', '!=', 'temp')
            ->where('sale_price', '>', 0)
            ->latest()
            ->paginate(20);
        $myallServices = ServiceProfileProduct::where('user_id', Auth::id())
            ->where('status', '!=', 'temp')
            ->where('sale_price', '=', null)
            ->latest()
            ->paginate(20);

        return view('user.serviceProfileProducts.myServiceProfileProducts', compact('user', 'myallProducts', 'myallServices'));
    }

    public function updateproductpricelist(Request $request)
    {
        
     
        menuSubmenu('product', 'product');
       $sale_price=$request->get('sale_price');
       $id=$request->get('id');
       $count_items = count($sale_price);

       for($i = 0; $i<$count_items; $i++)
       {
            $product =ServiceProfileProduct::Where('id',$id[$i])->first();
            $product->sale_price=$sale_price[$i];
            $product->save();
       }
        
        return redirect()->route('user.myServieProfileProducts')->with('success', 'Update  Successfully');


    }

    public function myServieProfileProductsUpdateActive(Request $request)
    {
        $product = ServiceProfileProduct::where('id', $request->product)->first();
        if (!$product) {
            return back()->with('warning', 'Product Not Found');
        }
        if ($product->user_id != Auth::id()) {
            return back()->with('warning', 'You are not able to update another User Product');
        }
        if ($request->active == 'inactive') {
            $product->active = false;
            $product->save();
            return redirect()->back()->with('warning', 'Your Product Inactived Successfully');
        }
        if ($request->active == 'active') {
            $product->active = true;
            $product->save();
            return redirect()->back()->with('success', 'Your Product Actived Successfully');
        }
        return back();
    }
    public function editMyServieProfileProducts(Request $request)
    {
        $user = Auth::user();
        $product = ServiceProfileProduct::where('id', $request->product)->first();
        if (!$product) {
            return back()->with('warning', 'Product Not Found');
        }
        if ($product->user_id != Auth::id()) {
            return back()->with('warning', 'You are not able to update Another User Product');
        }

        return view('user.serviceProfileProducts.editMyServiceProfileProducts', compact('product', 'user'));
    }
    public function deleteMyServieProfileProducts(Request $request)
    {
        $product = ServiceProfileProduct::where('id', $request->product)->first();

        if (!$product) {
            return back()->with('warning', 'Product Not Found');
        }
        if ($product->user_id != Auth::id()) {
            return back()->with('warning', 'You are not able to Delete Another User Product');
        }
        if ($product->status != 'temp') {
            return back()->with('warning', 'Your Product is now Pending. You are not able to delete this product. if you want to delete this product then Contact with admin');
        }
        if ($product->feature_image_name) {
            $f = 'product/serviceproduct/' . $product->feature_image_name;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
        }
        if ($images = $product->galary_image) {
            foreach ($images as $img) {
                $f = 'product/serviceproduct/galary/' . $img->img_name;
                if (Storage::disk('public')->exists($f)) {
                    Storage::disk('public')->delete($f);
                }
                $images->delete($img->id);
            }
        }
        $product->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }

    public function softmarket(Request $request)
    {
        $user = Auth::user();
        $lat = $user->lat ?: 23.792433799999998;
        $lng = $user->lng ?: 90.4266676;
        $number = filter_var($request->radius, FILTER_SANITIZE_NUMBER_INT);
        $radius = $number ? (int) $number : 3000;
        if ($lat and $lng) {
            $haversine = "(6371 * acos(cos(radians(" . $lat . ")) 
                        * cos(radians(`lat`)) 
                        * cos(radians(`lng`) 
                        - radians(" . $lng . ")) 
                        + sin(radians(" . $lat . ")) 
                        * sin(radians(`lat`))))";
        }

        $shops = ServiceProfile::select('id', 'lat', 'lng', 'workstation_id', 'ws_cat_id', 'subscriber_id', 'user_id', 'name', 'email', 'mobile', 'img_name', 'cover_image', 'home_delivery', 'offline_sale', 'online_sale', 'address', 'short_bio', 'zip_code', 'city', 'country', 'status', 'profile_type', 'addedby_id')
            ->where('profile_type', 'business')
            ->where('status', 1)
            ->where('paystatus', 1)
            // ->has('isOrderTrue')
            // ->has('liveProducts')
            ->whereRaw("{$haversine} < ?", [$radius])
            ->selectRaw("{$haversine} AS distance")
            ->latest()
            ->orderBy('distance')
            ->paginate(24);


        $categories = Category::orderBy('name')
            ->where('active', 1)
            ->select('name', 'id')
            ->get();

        $softmarkets = Category::where('sp_order', true)->where('active', true)->orderBy('name')->get();
        $service_station = WorkStation::orderBy('title')->get();
        $specialcategory = SpecialCategory::get();
        // return view('user.services.serviceSearch', compact('user', 'service_station'));

        return view('user.softmarkets.index', compact('softmarkets','specialcategory','service_station'));
    }
    public function catwiseShop(Request $request)
    {
        $category = Category::where('id', $request->cat)->where('sp_order', true)->first();
        if (!$category) {
            return back();
        }
        $user = Auth::user();
        $lat = $user->lat ?: 23.792433799999998;
        $lng = $user->lng ?: 90.4266676;
        $number = filter_var($request->radius, FILTER_SANITIZE_NUMBER_INT);
        $radius = $number ? (int) $number : 3000;
        if ($lat and $lng) {
            $haversine = "(6371 * acos(cos(radians(" . $lat . ")) 
                        * cos(radians(`lat`)) 
                        * cos(radians(`lng`) 
                        - radians(" . $lng . ")) 
                        + sin(radians(" . $lat . ")) 
                        * sin(radians(`lat`))))";
        }

        $shops = ServiceProfile::select('id', 'lat', 'lng', 'workstation_id', 'ws_cat_id', 'subscriber_id', 'user_id', 'name', 'email', 'mobile', 'img_name', 'cover_image', 'home_delivery', 'offline_sale', 'online_sale', 'address', 'short_bio', 'zip_code', 'city', 'country', 'status', 'profile_type', 'addedby_id', 'open', 'package_status','website_link')
            ->where('profile_type', 'business', 'expired_at')
            ->where('status', 1)
            ->where('ws_cat_id', $request->cat)
            ->has('isOrderTrue')
            ->where(function ($q) {
                $q->where('expired_at', '>=', Carbon::now()->today());
                $q->orWhere('expired_at', null);
            })
            // // ->has('liveProducts')
            ->whereRaw("{$haversine} < ?", [$radius])
            ->selectRaw("{$haversine} AS distance")
            ->latest()
            ->orderBy('distance')
            ->paginate(24);
        //     return $shops;
        // return ServiceProfile::where('ws_cat_id',$request->cat)->get();
        return view('user.softmarkets.catwiseShop', compact('shops', 'user', 'category'));
    }

    public function catwiseProduct(Request $request)
    {
       
        $category = Category::where('id', $request->cat)->where('sp_order', true)->first();
        if (!$category) {
            return back();
        }
        $user = Auth::user();
       
        $service_productall = ServiceProfileProduct::where('status', 'approved')
        ->where('active', true)
        ->where('ws_cat_id', $request->cat)
        ->latest()
        ->get();
    // dd($service_product);
    $user = Auth::user();
    return view('user.softmarkets.catwiseProduct', compact('user','service_productall','category'));
       
    }

    public function softmarketSearch(Request $request)
    {
        $selectedCat = Category::where('id', $request->category)
            ->where('active', 1)
            ->first();
        if (!$selectedCat) {
            return back();
        }
        $shops = ServiceProfile::where('ws_cat_id', $request->category)
            ->where('profile_type', 'business')
            ->where('status', true)
            ->where('paystatus', 1)
            ->paginate(24);
        // return $shops;
        $categories = Category::orderBy('name')
            ->where('active', 1)
            ->select('name', 'id')
            ->get();

        return view('user.softmarkets.softmarketSearch', compact('shops', 'categories', 'selectedCat'));
    }
    public function profileCheckForShop(Request $request)
    {
        $profile = ServiceProfile::find($request->profile);
        $subscription = Subscriber::where('user_id', Auth::id())->where('category_id', $profile->ws_cat_id)->first();
        if (!$subscription) {
            $workstation = Workstation::find($profile->workstation_id);

            $me = Auth::user();
            $cookieReffer_id = null;

            if (!$me->subscriptions()->count()) {
                $rvd = $me->verifiedDatas()->first();
                if ($rvd) {
                    $cookieReffer_id = $rvd->reffer_code;
                }
            }
            $code = Subscriber::where('subscription_code', $cookieReffer_id)
                ->where('id', '>', 15)
                ->where('subscription_code', '<>', null)
                ->where('work_station_id', $workstation->id)
                ->first();

            if ($code) {
                $workstationId = $code->work_station_id;
                $reffer_id = $code->id;
            } else {

                if ($sf = $me->isWSSubscription($workstation)) {

                    $reffer_id = $sf->id;
                    $workstationId = $workstation->id;
                } else {
                    $reffer_id = null;
                    // $reffer_id = $workstation->id + 15;
                    $workstationId = $workstation->id;
                }
            }

            $prRow = Subscriber::where('work_station_id', $workstationId)->orderBy('ws_position', 'desc')->first();

            $dis = $me->subscriptionDistrict()->id;
            if (strlen($dis) < 2) {
                $dis = '0' . $dis;
            }

            $wsId = $workstationId;
            if (strlen($wsId) < 2) {
                $wsId = '0' . $wsId;
            }

            $meMob = $me->mobile ?: '00';
            if (strlen($meMob) > 2) {
                // $meMob = last 2 digit;
                $meMob = substr($meMob, -2);
            }

            $num = 100000000;
            $ws_pos = $prRow->ws_position + 1;
            $num = $num + $ws_pos;
            $scode = $wsId . $num . $meMob . $me->subscriptionDistrict()->id;

            $s = new Subscriber;
            $s->ws_position = $ws_pos;
            $s->name = $me->name;
            $s->email = $me->email;
            $s->mobile = $me->mobile;
            $s->category_id = $profile->ws_cat_id;
            $s->district_id = $me->subscriptionDistrict()->id;
            $s->user_id = $me->id;
            $s->referral_id = $reffer_id;
            $s->work_station_id = $workstationId;
            $s->subscription_code = $scode;
            $s->addedby_id = Auth::id();
            $s->free_account = 1;
            $s->save();
            $subscription_code = $s->subscription_code;
        } else {
            $subscription_code = $subscription->subscription_code;
        }
        return redirect()->route('subscriber.findProfileDetails', ['profile' => $profile->id, 'subscription' => $subscription_code]);
    }

    public function serviceProducts(Request $request)
    {
        $service_product = ServiceProfileProduct::where('status', 'approved')
            ->where('active', true)
            ->latest()
            ->groupBy('service_profile_id')
            ->get();
            $service_productall = ServiceProfileProduct::where('status', 'approved')
            ->where('active', true)
            ->latest()
            ->get();
        // dd($service_product);
        $user = Auth::user();
        return view('user.allServiceProducts.allProducts', compact('service_product', 'user','service_productall'));
    }

    public function Courseitem(Request $request)
    {
            $course = Courseitem::where('status', 'approved')
            ->where('active', true)
            ->latest()
            ->groupBy('service_profile_id')
            ->get();
            $courseall = Courseitem::where('status', 'approved')
            ->where('active', true)
            ->latest()
            ->get();
        // dd($service_product);
        $user = Auth::user();
        return view('user.course.allCourse', compact('course', 'user','courseall'));
    }
    public function userService(Request $request)
    {
        $service_product = ServiceProfile::where('status', true)
            ->where('paystatus', 1)
            ->where('profile_type', 'business')
            ->latest()
            ->simplePaginate(24);
        // dd($service_product);
        // return $service_product;


        $user = Auth::user();
        $lat = $user->lat ?: 23.792433799999998;
        $lng = $user->lng ?: 90.4266676;
        $number = filter_var($request->radius, FILTER_SANITIZE_NUMBER_INT);
        $radius = $number ? (int) $number : 3000;
        if ($lat and $lng) {
            $haversine = "(6371 * acos(cos(radians(" . $lat . ")) 
                        * cos(radians(`lat`)) 
                        * cos(radians(`lng`) 
                        - radians(" . $lng . ")) 
                        + sin(radians(" . $lat . ")) 
                        * sin(radians(`lat`))))";
        }

        $shops = ServiceProfile::select("*")
            ->where('profile_type', 'business')
            ->where('status', 1)
            ->where('paystatus', 1)
            ->with('category', 'serviceitems')
            ->whereHas('category', function ($qq) {
                $qq->where('business_type', 'service');
            })
            // ->where(function ($q) {
            //     $q->where('expired_at', '>=', Carbon::now()->today());
            //     $q->orWhere('expired_at', null);
            // })
            // ->has('liveProducts')
            // ->whereRaw("{$haversine} < ?", [$radius])
            ->selectRaw("{$haversine} AS distance")
            ->latest()
            ->orderBy('distance')
            ->paginate(24);
        // ->count();
        // $shops= Serviceitem::where()
        // return $shops;
        return view('user.allServiceProducts.allService', compact('service_product', 'user', 'shops'));
    }
    public function serviceSearchAjax(Request $request)
    {
        $q = $request->q;
        $user = Auth::user();
        $lat = $user->lat ?: 23.792433799999998;
        $lng = $user->lng ?: 90.4266676;
        $number = filter_var($request->radius, FILTER_SANITIZE_NUMBER_INT);
        $radius = $number ? (int) $number : 3000;
        if ($lat and $lng) {
            $haversine = "(6371 * acos(cos(radians(" . $lat . ")) 
                        * cos(radians(`lat`)) 
                        * cos(radians(`lng`) 
                        - radians(" . $lng . ")) 
                        + sin(radians(" . $lat . ")) 
                        * sin(radians(`lat`))))";
        }
        $shops = ServiceProfile::select("*")
            ->where('profile_type', 'business')
            ->where('status', true)
            ->where('paystatus', 1)
            ->where('name', 'like', '%' . $q . '%')
            // ->orWhere('address', 'like', '%' . $q . '%')
            ->whereHas('category', function ($qq) use ($q) {
                $qq->where('business_type', 'service');

                // $qq->where(function ($p) use ($q) {
                //     $p->orWhere('name', 'like', '%' . $q . '%');
                // });
            })
            // ->where(function ($qq) use ($q) {
            //     // $qq->where('name', 'like', '%' . $q . '%');
            //     $qq->orWhere('address', 'like', '%' . $q . '%');
            //     $qq->where('expired_at', '>=', Carbon::now()->today());
            //     $qq->orWhere('expired_at', null);
            // })
            // ->has('liveProducts')
            // ->whereRaw("{$haversine} < ?", [$radius])
            ->selectRaw("{$haversine} AS distance")
            ->latest()
            ->orderBy('distance')
            ->paginate(24);
        $page = view('user.softmarkets.includes.serviceCard', ['shops' => $shops]);
        return $page;
        if ($request->ajax()) {
            return Response()->json(array(
                'q' => $request->q,
                'page' => $page,
            ));
        }
    }
    public function serviceProductsCheckForAddToCart(Request $request)
    {
        $profile = ServiceProfile::find($request->profile);
        $subscription = Subscriber::where('user_id', Auth::id())->where('category_id', $profile->ws_cat_id)->first();
        if (!$subscription) {
            $workstation = Workstation::find($profile->workstation_id);

            $me = Auth::user();
            $cookieReffer_id = null;

            if (!$me->subscriptions()->count()) {
                $rvd = $me->verifiedDatas()->first();
                if ($rvd) {
                    $cookieReffer_id = $rvd->reffer_code;
                }
            }
            $code = Subscriber::where('subscription_code', $cookieReffer_id)
                ->where('id', '>', 15)
                ->where('subscription_code', '<>', null)
                ->where('work_station_id', $workstation->id)
                ->first();

            if ($code) {
                $workstationId = $code->work_station_id;
                $reffer_id = $code->id;
            } else {

                if ($sf = $me->isWSSubscription($workstation)) {

                    $reffer_id = $sf->id;
                    $workstationId = $workstation->id;
                } else {
                    $reffer_id = null;
                    // $reffer_id = $workstation->id + 15;
                    $workstationId = $workstation->id;
                }
            }

            $prRow = Subscriber::where('work_station_id', $workstationId)->orderBy('ws_position', 'desc')->first();

            $dis = $me->subscriptionDistrict()->id;
            if (strlen($dis) < 2) {
                $dis = '0' . $dis;
            }

            $wsId = $workstationId;
            if (strlen($wsId) < 2) {
                $wsId = '0' . $wsId;
            }

            $meMob = $me->mobile ?: '00';
            if (strlen($meMob) > 2) {
                // $meMob = last 2 digit;
                $meMob = substr($meMob, -2);
            }

            $num = 100000000;
            $ws_pos = $prRow->ws_position + 1;
            $num = $num + $ws_pos;
            $scode = $wsId . $num . $meMob . $me->subscriptionDistrict()->id;

            $s = new Subscriber;
            $s->ws_position = $ws_pos;
            $s->name = $me->name;
            $s->email = $me->email;
            $s->mobile = $me->mobile;
            $s->category_id = $profile->ws_cat_id;
            $s->district_id = $me->subscriptionDistrict()->id;
            $s->user_id = $me->id;
            $s->referral_id = $reffer_id;
            $s->work_station_id = $workstationId;
            $s->subscription_code = $scode;
            $s->addedby_id = Auth::id();
            $s->free_account = 1;
            $s->save();
            $subscription_code = $s->subscription_code;
        } else {
            $subscription_code = $subscription->subscription_code;
        }

        if ($request->type == 'url') {
            return redirect()->route('welcome.productShare', ['product' => $request->product, 'profile' => $profile->id, 'reffer' => $subscription_code]);
        }
        if ($request->type == 'carttostore') {
            return redirect()->route('welcome.profileShare', ['profile' => $profile->id, 'reffer' => $subscription_code]);
        }
        if ($request->type == 'cart') {
            $product = ServiceProfileProduct::where('id', $request->product)->first();
            $subscriber = Subscriber::where('subscription_code', $request->subscription)->where('user_id', Auth::id())->first();
            $isAlreadyAddedToCart = ServiceProductCart::where('product_id', $product->id)->where('service_profile_id', $product->service_profile_id)->where('user_id', Auth::id())->first();
            if ($isAlreadyAddedToCart) {
                $isAlreadyAddedToCart->increment('quantity');
            } else {
                $service_product_cart = new ServiceProductCart;
                $service_product_cart->product_id = $product->id;
                $service_product_cart->ws_cat_id = $product->ws_cat_id;
                $service_product_cart->workstation_id = $product->workstation_id;
                $service_product_cart->service_profile_id = $product->service_profile_id;
                $service_product_cart->subscriber_id = $subscriber ? $subscriber->id : null;
                $service_product_cart->quantity = 1;
                $service_product_cart->user_id = Auth::id();
                $service_product_cart->addedby_id = Auth::id();
                $service_product_cart->save();
            }

            return redirect()->route('welcome.productShare', ['profile' => $profile->id, 'reffer' => $subscription_code, 'product' => $request->product])->with('success', 'Product Addet To Cart');
        }

        return back();
    }

    //Soft Commarce  Start
    public function softcommerce(Request $request)
    {
        $user = Auth::user();
        $postpaid = Subscriber::where('user_id', $user->id)->where('free_account', true)->where('active', true)->count();
        $postpaid_reffer = Subscriber::where('user_id', $user->id)->where('free_account', true)->where('active', true)->count('referral_id');
        $prepaid_reffer = Subscriber::where('user_id', $user->id)->where('free_account', false)->where('active', true)->count('referral_id');
        $prepaid = Subscriber::where('user_id', $user->id)->where('free_account', false)->where('active', true)->count();
        $totalPfbalance = Subscriber::where('user_id', $user->id)->where('free_account', false)->sum('balance');
        $totalWithdrow = BalanceTransaction::where('user_id', $user->id)->where('purpose', 'withdraw')->sum('moved_balance');
        $totalDeposit = BalanceTransaction::where('user_id', $user->id)->where('purpose', 'deposit')->sum('moved_balance');
        $biz_profiles = ServiceProfile::where('profile_type', 'business')->where('user_id', $user->id)->where('paystatus', 1)->where('status', true)->get();
        $paidshop = ServiceProfile::where('user_id', $user->id)->where('paystatus', 1)->where('status', true)->count();
        $unpaidshop = ServiceProfile::where('user_id', $user->id)->where('paystatus', 0)->count();

        $sales = DB::table('service_product_orders')
        ->leftjoin('service_profiles', 'service_product_orders.service_profile_id', '=', 'service_profiles.id')
        ->where('service_profiles.user_id', $user->id)
        ->where('service_profiles.profile_type', 'business')
        ->select('service_product_orders.*')
        ->get();
       $profile_count=ServiceProfile::where('user_id',Auth::user()->id)->count();
     
        $sales_total = $sales->sum('total_sale_price');
        $sales_count = $sales->count('service_profile_id');

        $myProfileIds = ServiceProfile::where('user_id', $user->id)->where('profile_type', 'business')->pluck('id');
        $orders = ServiceProductOrder::whereIn('service_profile_id', $myProfileIds)->whereIn('order_status', ['pending', 'confirmed', 'processing','ready_to_ship','shipped','delivered'])->where('payment_status','advanced')->orderBy('id', 'DESC')->get();

        $pending_balance= $orders->sum('total_sale_price');
    
        
      
    
        $purchase_total = ServiceProductOrder::where('user_id',$user->id)->sum('total_sale_price');
        $purchase_count = ServiceProductOrder::where('user_id',$user->id)->count('user_id');
        return view('user.softcommerce.softcommerce', compact('user', 'postpaid','paidshop','unpaidshop','sales_total','purchase_count','sales_count','purchase_total', 'prepaid', 'totalPfbalance', 'totalWithdrow', 'biz_profiles', 'totalDeposit', 'postpaid_reffer', 'prepaid_reffer','pending_balance','profile_count'));
    }
    public function userwithdrawdetails(Request $request)
    {
        $user = Auth::user();

        $totalwitdrawdetails = BalanceTransaction::where('user_id', $user->id)->where('purpose', 'withdraw')->latest()->paginate(10);
        $totalwitdraw=$totalwitdrawdetails->sum('moved_balance'); 
        $grandtotalwitdraw = BalanceTransaction::where('user_id', $user->id)->where('purpose', 'withdraw')->sum('moved_balance');

        return view('user.softcommerce.userwithdrawdetails', compact(
            'totalwitdrawdetails',
            'totalwitdraw',
            'grandtotalwitdraw'
        ));
    }
    public function userdepositdetails(Request $request)
    {
        $user = Auth::user();

        $totaldepositdetails = BalanceTransaction::where('user_id', $user->id)->where('purpose', 'deposit')->latest()->paginate(10);
        $totaldeposit=$totaldepositdetails->sum('moved_balance'); 
        $grandtotaldeposit = BalanceTransaction::where('user_id', $user->id)->where('purpose', 'deposit')->sum('moved_balance');

        return view('user.softcommerce.userdepositdetails', compact(
            'totaldepositdetails',
            'totaldeposit',
            'grandtotaldeposit'
        ));
    }


    public function myProfile(Request $request)
    {
        $user = Auth::user();
        return view('user.softcommerce.myProfile', compact('user'));
    }
    //Soft Commarce  End

    public function connectingfriends()
    {
        $user = Auth::user();
        $referall = Subscriber::where('user_id', $user->id)->where('free_account', true)->orderBy('work_station_id')->orderBy('category_id')->latest()->first();
        //dd($referall);
        return view('user.softcommerce.connectingfriends', compact('user','referall'));
    }
    public function sharelink()
    {
        $user = Auth::user();
        $accounts = Subscriber::where('user_id', $user->id)->where('free_account', false)->orderBy('work_station_id')->orderBy('category_id')->paginate(100);
        $accountspost = Subscriber::where('user_id', $user->id)->where('free_account', true)->orderBy('work_station_id')->orderBy('category_id')->paginate(100);
        return view('user.softcommerce.sharelink', compact('user', 'accounts', 'accountspost'));
    }


    public function searchLeftCategoryAjax(Request $request)
    {


        $page = '';
        $q = $request->q;

        $categories = Category::where('name', 'like', "%" . $q . "%")
            ->orWhere('id', $q)
            ->select('id', 'name')
            ->latest()
            ->paginate(30)
            ->appends(['q' => $q]);

        $page = View('user.softmarkets.includes.leftSideCategoryList', ['categories' => $categories, 'q' => $q])->render();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'page' => $page
            ]);
        }
    }


    public function softcodeFreelancing()
    {
        $subscription = Auth::user()
            ->subscriptions()
            ->where('work_station_id', 1)
            ->where('category_id', 1)
            ->orderBy('id')
            ->orderBy('free_account', 'desc')
            ->first();

        return view('user.softcodeFreelancing.dashboard', ['subscription' => $subscription]);
    }
    public function makeServiceProfile(Request $request)
    {
        $workstation = WorkStation::where('active', true)->get();
        return  view('user.softcommerce.serviceProfile.makeServiceProfile', compact('workstation'));
    }

    public function makeUserCreateForServiceProfile(Request $request)
    {
        //dd('ok');

        $validation = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255', 'min:3'],
                // 'email' => ['required', 'string', 'email', 'unique:users', 'max:255'],
                'mobile' => ['required','unique:users','string'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'active' => ['nullable']
            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $phn=bdMobileWithCode($request->mobile);
        $usercheeck=User::where('mobile',$phn)->count();

        if($usercheeck>0){
            return back()->with('warning', 'This number already used a account');
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = bdMobileWithCode($request->mobile);
        $user->password_temp = $request->password;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->active = $request->active ? true : false;
        $user->addedby_id = Auth::id();
        $user->save();

        $number=bdMobileWithCode($request->mobile);
        $messages= "Dear {$request->name}, Thank you for joining with us. Please visit our site www.sc-bd.com. From Soft Commerce";

        //$me->sendSingleMessage($number,$messages);
        $SendSms=new SendSms;
        try {
            // Send a message using the primary device.
            $msg = $SendSms->sendSingleMessage($number,$messages);

        } catch (Exception $e) {
            echo $e->getMessage();
        }



        // if($request->workstation!=null){
        //     $haveSubscription = Category::where('work_station_id',$request->workstation)->whereDoesntHave('subscription', function ($query) use ($user) {
        //         $query->where('user_id', $user->id);
        //     })->get();
    
        //     if (count($haveSubscription) == 0) {
        //         return redirect()->back()->with('warning', 'You have already Account in all Categories');
        //     }
        //     foreach ($haveSubscription as $key => $category) {
        //         $workstation = WorkStation::find($category->work_station_id);
    
        //         $me = $user;
        //         $cookieReffer_id = null;
    
        //         if (!$me->subscriptions()->count()) {
        //             $rvd = $me->verifiedDatas()->first();
        //             if ($rvd) {
        //                 $cookieReffer_id = $rvd->reffer_code;
        //             }
        //         }
        //         $code = Subscriber::where('subscription_code', $cookieReffer_id)
        //             ->where('id', '>', 15)
        //             ->where('subscription_code', '<>', null)
        //             ->where('work_station_id', $workstation->id)
        //             ->first();
    
        //         if ($code) {
        //             $workstationId = $code->work_station_id;
        //             $reffer_id = $code->id;
        //         } else {
    
        //             if ($sf = $me->isWSSubscription($workstation)) {
    
        //                 $reffer_id = $sf->id;
        //                 $workstationId = $workstation->id;
        //             } else {
        //                 $reffer_id = null;
        //                 // $reffer_id = $workstation->id + 15;
        //                 $workstationId = $workstation->id;
        //             }
        //         }
    
        //         $prRow = Subscriber::where('work_station_id', $workstationId)->orderBy('ws_position', 'desc')->first();
    
        //         $dis = $me->subscriptionDistrict()->id;
        //         if (strlen($dis) < 2) {
        //             $dis = '0' . $dis;
        //         }
    
        //         $wsId = $workstationId;
        //         if (strlen($wsId) < 2) {
        //             $wsId = '0' . $wsId;
        //         }
    
        //         $meMob = $me->mobile ?: '00';
        //         if (strlen($meMob) > 2) {
        //             // $meMob = last 2 digit;
        //             $meMob = substr($meMob, -2);
        //         }
    
        //         $num = 100000000;
        //         $ws_pos = $prRow->ws_position + 1;
        //         $num = $num + $ws_pos;
        //         $scode = $wsId . $num . $meMob . $me->subscriptionDistrict()->id;
    
        //         $whoCreatingAccount = Auth::user();
        //         $introducer = Subscriber::where('user_id', $whoCreatingAccount->id)->where('work_station_id', $workstationId)->first();
        //         if ($introducer) {
        //             if ($key == 0) {
        //                 $s = new Subscriber;
        //                 $s->ws_position = $ws_pos;
        //                 $s->name = $me->name;
        //                 $s->email = $me->email;
        //                 $s->mobile = $me->mobile;
        //                 $s->category_id = $category->id;
        //                 $s->district_id = $me->subscriptionDistrict()->id;
        //                 $s->user_id = $me->id;
        //                 $s->referral_id = $introducer->id;
        //                 $s->work_station_id = $workstationId;
        //                 $s->subscription_code = $scode;
        //                 $s->addedby_id = Auth::id();
        //                 $s->free_account = 1;
        //                 $s->save();
        //             }
        //         }
    
        //         $s = new Subscriber;
        //         $s->ws_position = $ws_pos;
        //         $s->name = $me->name;
        //         $s->email = $me->email;
        //         $s->mobile = $me->mobile;
        //         $s->category_id = $category->id;
        //         $s->district_id = $me->subscriptionDistrict()->id;
        //         $s->user_id = $me->id;
        //         $s->referral_id = $reffer_id;
        //         $s->work_station_id = $workstationId;
        //         $s->subscription_code = $scode;
        //         $s->addedby_id = Auth::id();
        //         $s->free_account = 1;
    
        //         $s->save();
        //     }

        // }

        

        return back()->with('success', 'New user successfully Created');
    }

    public function storeServiceProfileFromUser(Request $request)
    {
     // dd($request->paynow);

        $validation = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255', 'min:2'],
                'user' => ['required'],
                'workstation' => ['required'],
                'category' => ['required'],
                'address' => ['required'],
                'img' => ['mimes:jpeg,jpg,png|required'],
                'location' => ['required']
            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $category = Category::where('id', $request->category)->first();

        //dd($category->sp_adtopup_bonus);
        $user = User::where('id', $request->user)->first();
        $whoCreatingAccount = Auth::user();

       

        $ifHaveSubscriptionByWhoCreating = Subscriber::where('user_id', $whoCreatingAccount->id)
            //->where('category_id', $request->category)
            ->first();
        if (!$ifHaveSubscriptionByWhoCreating) {
            return back()->with('error', 'You don\'t have Subscription in this category. Please Subscribe in this category and try again');
        }

      

          
        $subscription = Subscriber::where('user_id', $user->id)
            ->where('category_id', $request->category)
            ->first();
        

        if($subscription){
            if($subscription->refferal_id==null){
                $subscription->refferal_id== $ifHaveSubscriptionByWhoCreating->id;
                $subscription->save();   
            }
        }

        if (!$subscription) {
            $workstation = Workstation::find($category->work_station_id);
            $cookieReffer_id = null;
            if (!$user->subscriptions()->count()) {
                $rvd = $user->verifiedDatas()->first();
                if ($rvd) {
                    $cookieReffer_id = $rvd->reffer_code;
                }
            }

            $code = Subscriber::where('subscription_code', $cookieReffer_id)
                ->where('id', '>', 15)
                ->where('subscription_code', '<>', null)
                ->where('work_station_id', $workstation->id)
                ->first();

            if ($code) {
                $workstationId = $code->work_station_id;
                $reffer_id = $code->id;
            } else {
                if ($sf = $user->isWSSubscription($workstation)) {

                    $reffer_id = $sf->id;
                    $workstationId = $workstation->id;
                } else {
                    $reffer_id = null;
                    $workstationId = $workstation->id;
                }
            }


            $prRow = Subscriber::where('work_station_id', $workstationId)->orderBy('ws_position', 'desc')->first();

            $dis = $user->subscriptionDistrict()->id;
            if (strlen($dis) < 2) {
                $dis = '0' . $dis;
            }

            $wsId = $workstationId;
            if (strlen($wsId) < 2) {
                $wsId = '0' . $wsId;
            }

            $meMob = $user->mobile ?: '00';
            if (strlen($meMob) > 2) {
                // $meMob = last 2 digit;
                $meMob = substr($meMob, -2);
            }

            $num = 100000000;
            $ws_pos = $prRow->ws_position + 1;
            $num = $num + $ws_pos;
            $code = $wsId . $num . $meMob . $user->subscriptionDistrict()->id;

            $subscription = new Subscriber;
            $subscription->ws_position = $ws_pos;
            $subscription->name = $user->name;
            $subscription->email = $user->email;
            $subscription->mobile = $user->mobile;
            $subscription->category_id = $category->id;
            $subscription->district_id = $user->subscriptionDistrict()->id;
            $subscription->user_id = $user->id;
            if($ifHaveSubscriptionByWhoCreating){
                $subscription->referral_id = $ifHaveSubscriptionByWhoCreating->id;
            }else{
                $subscription->referral_id = $reffer_id;
            }
           
            $subscription->work_station_id = $workstationId;
            $subscription->subscription_code = $code;
            $subscription->addedby_id = Auth::id();
            $subscription->free_account = 1;
            $subscription->save();
        }
        $oldProfile = ServiceProfile::where('user_id', $subscription->user_id)
            ->where('workstation_id', $subscription->work_station_id)
            ->where('ws_cat_id', $subscription->category_id)
            ->where('profile_type', $request->profile_type)
            ->first();

        $user = User::where('id', $subscription->user_id)->first();

        if ($oldProfile) {
            $moreTalk = $oldProfile->status == true ? '' : ' Please, wait until approve it';
            return back()->with('error', 'Already submitted a profile.' . $moreTalk)->withInput();
        }

       
        
        $profile = new ServiceProfile;
        $profile->user_id = $subscription->user_id;
        $profile->subscriber_id = $subscription->id;
        $profile->workstation_id = $subscription->work_station_id;
        $profile->ws_cat_id = $subscription->category_id;
        $profile->name = $request->name;
        $profile->email = $user->email;
        $profile->mobile = $user->mobile;
        $profile->profile_type = $request->profile_type == 'business' ? $request->profile_type : 'personal';
        $profile->address = $request->location;
        $profile->home_delivery = $request->home_delivery ? 1 : 0;
        $profile->online_sale = $request->online_sale ? 1 : 0;
        $profile->offline_sale = $request->offline_sale ? 1 : 0;
        $profile->fixed_location = $request->fixed_location ? 1 : 0;
        $profile->lat = $request->lat;
        $profile->lng = $request->lng;
        // if ($subscription->free_account) {
        //     $profile->expired_at = Carbon::now()->addDay(60);
        // } else {
        //     $profile->expired_at = null;
        // }
        $profile->short_bio = $request->bio;
        $profile->designation = $request->designation;
        $profile->zip_code = $request->zip_code;
        $profile->city = $request->city;
        $profile->country = $request->country;
        $profile->status = false; ///Because This Service profile created by a USER
        $profile->paystatus = 0;
        if ($subscription->free_account) {
            $profile->expired_at = Carbon::now()->addDay(60);
        } else {
            $profile->expired_at = Carbon::now()->addDay(365);
        }
        $profile->open = true;
        $profile->addedby_id = Auth::id();
        $profile->save();

        if ($cp = $request->img) {
            $f = 'user/profile/' . $profile->img_name;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $profile->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            list($width, $height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size = $cp->getSize();

            $originalName = strtolower($cp->getClientOriginalName());

            //Storage::disk('public')->put('user/profile/' . $randomFileName, File::get($cp));

            Image::make($cp)->fit(160, 160, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/user/profile/' . $randomFileName));

            $profile->img_name = $randomFileName;
            $profile->save();
        }
        if ($cp = $request->cover_image) {
            // return "ache2";
            $f = 'user/profile/cover/' . $profile->cover_image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }

            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $profile->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            list($width, $height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size = $cp->getSize();

            $originalName = strtolower($cp->getClientOriginalName());

            //Storage::disk('public')->put('user/profile/cover/' . $randomFileName, File::get($cp));

            Image::make($cp)->fit(958, 168, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/user/profile/cover/' . $randomFileName));

            $profile->cover_image = $randomFileName;
            $profile->save();
        }


        // dd($request->key_values);
        foreach (json_decode($request->key_values) as $key => $value) {

            $keyv = 'key_' . $value;
            // return $keyv;
            if ($request[$keyv] != null) {
                $info = ServiceProfileInfo::where('id', $value)->first();
                if ($info) {
                    $serviceProfileValue = new ServiceProfileInfoValue;
                    $serviceProfileValue->workstation_id = $subscription->work_station_id;
                    $serviceProfileValue->ws_cat_id = $subscription->work_station_id;
                    $serviceProfileValue->subscriber_id = $subscription->category_id;
                    $serviceProfileValue->user_id = $subscription->user_id;

                    $serviceProfileValue->service_profile_id = $profile->id;

                    $serviceProfileValue->service_profile_info_id = $info->id;

                    $serviceProfileValue->profile_info_key = $info->profile_info_key;
                    $serviceProfileValue->field_type = $info->field_type;
                    $serviceProfileValue->access_type = $info->access_type;
                    $serviceProfileValue->profile_card_display = $info->profile_card_display;

                    if (($info->field_type == 'image') or ($info->field_type == 'pdf') or ($info->field_type == 'doc')) {
                        if ($request->file($keyv)) {

                            $ctp = $request->file($keyv);
                            $ext = strtolower($ctp->getClientOriginalExtension());
                            $ctpn = $profile->id . $info->field_type . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $ext;
                            $ctpn = strtolower($ctpn);

                            if ($info->field_type == 'image') {
                                $os = array("png", "bmp", "jpg", "jpeg", "gif");
                                if (!in_array($ext, $os)) {

                                    $f = 'user/profile/' . $profile->img_name;
                                    if (Storage::disk('public')->exists($f)) {
                                        Storage::disk('public')->delete($f);
                                    }
                                    $profile->serviceProfileValues()->delete();
                                    $profile->delete();

                                    return back()->with('error', 'Sorry, you did not upload image file in image field');
                                }
                            }


                            if ($info->field_type == 'doc') {
                                $os = array("doc", "docx");
                                if (!in_array($ext, $os)) {

                                    $f = 'user/profile/' . $profile->img_name;
                                    if (Storage::disk('public')->exists($f)) {
                                        Storage::disk('public')->delete($f);
                                    }

                                    $profile->serviceProfileValues()->delete();
                                    $profile->delete();

                                    return back()->with('error', 'Sorry, you did not upload doc (msword) file in doc field');
                                }
                            }

                            if ($info->field_type == 'pdf') {
                                $os = array("pdf");
                                if (!in_array($ext, $os)) {

                                    $f = 'user/profile/' . $profile->img_name;
                                    if (Storage::disk('public')->exists($f)) {
                                        Storage::disk('public')->delete($f);
                                    }

                                    $profile->serviceProfileValues()->delete();
                                    $profile->delete();

                                    return back()->with('error', 'Sorry, you did not upload pdf file in pdf field');
                                }
                            }

                            Storage::disk('public')->put('service/profile/' . $ctpn, File::get($ctp));
                            $serviceProfileValue->profile_info_value = $ctpn;
                        }
                    } else {
                        $serviceProfileValue->profile_info_value = trim($request[$keyv]);
                    }

                    $serviceProfileValue->active = false;
                    $serviceProfileValue->addedby_id = $subscription->user_id;

                    $serviceProfileValue->save();
                }
            }
        }

        if($request->paynow == "paynow"){
            $welcome_balance=100;
            if($whoCreatingAccount->is_employee==true){
                if ($whoCreatingAccount->employee_balance < 100) {
            
                    return redirect()->route('user.userBalance')->with('error', 'Your employee balance less then 100 tk. If you want to create service then please contract office.');
                }else{
                    if($profile->paystatus==0){
                        
                        $bt = new BalanceTransaction;
                        $bt->from = 'user';
                        $bt->to = 'admin';
                        $bt->purpose = 'sp_create_charge';
                        $bt->subscriber_id = $subscription->id;
                        $bt->user_id = $whoCreatingAccount->id;
                        $bt->previous_balance = $whoCreatingAccount->employee_balance;  // user old balance
                        $bt->moved_balance = 100; // job cost
                        $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
                        $bt->type = 'service';
                        $bt->details = "{$bt->moved_balance} TK deducted from User balance. to Createing Service/Shop for user_id({$user->id}), Mobile ($user->mobile) .";
                        $bt->type_id = $category->id;
                        $bt->addedby_id = Auth::id();
                        $bt->save();
                        $whoCreatingAccount->decrement('employee_balance', $bt->moved_balance);
                        $user->increment('ad_balance', $category->sp_adtopup_bonus);
                        $user->increment('welcome_balance',$welcome_balance);
                        $profile->paystatus = 1; 
                        $profile->status = true; 
                        $profile->save();

                        $number=$user->mobile;
                        $messages= "Dear {$user->name}, Thank you for create service profile.You have paid service profile.Your service profile name: {$request->name}.Please visit our site www.sc-bd.com. From Soft Commerce";

                        //$me->sendSingleMessage($number,$messages);
                        $SendSms=new SendSms;
                        try {
                            // Send a message using the primary device.
                            $msg = $SendSms->sendSingleMessage($number,$messages);

                        }catch (Exception $e) {
                            echo $e->getMessage();
                        }
                        return back()->with('success', 'Profile Submitted Successfully.'); 

                    }else{
                        return redirect()->with('error', 'You already pay for this service profile');

                    }


                }

            }else{
                if ($whoCreatingAccount->balance < 100) {
            
                    return redirect()->route('user.userBalance')->with('error', 'Your account balance less then 100 tk. If you want to create service then please recharge.');
                }else{
                    if($profile->paystatus==0){
                        
                        $bt = new BalanceTransaction;
                        $bt->from = 'user';
                        $bt->to = 'admin';
                        $bt->purpose = 'sp_create_charge';
                        $bt->subscriber_id = $subscription->id;
                        $bt->user_id = $whoCreatingAccount->id;
                        $bt->previous_balance = $whoCreatingAccount->balance;  // user old balance
                        $bt->moved_balance = 100; // job cost
                        $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
                        $bt->type = 'service';
                        $bt->details = "{$bt->moved_balance} TK deducted from User balance. to Createing Service/Shop for user_id({$user->id}), Mobile ($user->mobile) .";
                        $bt->type_id = $category->id;
                        $bt->addedby_id = Auth::id();
                        $bt->save();
                        $whoCreatingAccount->decrement('balance', $bt->moved_balance);
                        $user->increment('ad_balance', $category->sp_adtopup_bonus);
                        $user->increment('welcome_balance',$welcome_balance);
                        $profile->paystatus = 1; 
                        $profile->status = true; 
                        $profile->save();

                        $number=$user->mobile;
                        $messages= "Dear {$user->name}, Thank you for create service profile.You have paid service profile.Your service profile name: {$request->name}.Please visit our site www.sc-bd.com. From Soft Commerce";

                        //$me->sendSingleMessage($number,$messages);
                        $SendSms=new SendSms;
                        try {
                            // Send a message using the primary device.
                            $msg = $SendSms->sendSingleMessage($number,$messages);

                        }catch (Exception $e) {
                            echo $e->getMessage();
                        }
                        return back()->with('success', 'Profile Submitted Successfully.'); 

                    }else{
                        return redirect()->with('error', 'You already pay for this service profile');

                    }


                }
            }

               

        }

        if($request->paynow = "trial"){
            $profile->expired_at = Carbon::now()->addDay(45);
            $profile->is_trial = 1; 
            $profile->status = true; 
            $profile->save();

            $number=$user->mobile;
                $messages= "Dear {$user->name}, Thank you for create service profile.You have unpaid service profile.Your service profile name: {$request->name}.45 Days you have free trial.Please visit our site www.sc-bd.com. From Soft Commerce";

                //$me->sendSingleMessage($number,$messages);
                $SendSms=new SendSms;
                try {
                    // Send a message using the primary device.
                    $msg = $SendSms->sendSingleMessage($number,$messages);

                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                return back()->with('success', 'Profile Submitted Successfully.'); 

        }

               $number=$user->mobile;
                $messages= "Dear {$user->name}, Thank you for create service profile.You have unpaid service profile.Your service profile name: {$request->name}.For published service you have to pay.Please visit our site www.sc-bd.com. From Soft Commerce";

                //$me->sendSingleMessage($number,$messages);
                $SendSms=new SendSms;
                try {
                    // Send a message using the primary device.
                    $msg = $SendSms->sendSingleMessage($number,$messages);

                } catch (Exception $e) {
                    echo $e->getMessage();
                }


        return back()->with('success', 'Profile Submitted Successfully.');
    }
    public function whatDoYouWant(Request $request)
    {
        $service_station = WorkStation::all();
        $needs = Need::orderBy('id', 'DESC')
            ->where('status', 'approved')
            ->where('closed_date', '>=', Carbon::today())
            ->paginate(50);

        return view('user.whatYouWant.index', compact('service_station', 'needs'));
    }
    public function storeNeeds(Request $request)
    {
        $request->validate([
            'title' => 'required | max:250',
            'description' => 'required',
            'closed_date' => 'required |date'
        ]);
        $hasNotApprovedOrClosed = Need::where('user_id', Auth::id())->where('status', '!=', 'approved')->orWhere('status', 'closed')->first();
        if ($hasNotApprovedOrClosed) {
            return redirect()->back()->with('warning', 'You have already posted. Please wait for approved or closed this post');
        }
        // return $request->closed_date.' '.Carbon::now()->format('H:m:s');
        $need = new Need;
        $need->title = $request->title;
        $need->description = $request->description;
        $need->closed_date = $request->closed_date;
        $need->user_id = Auth::id();
        $need->addedby_id = Auth::id();
        $need->save();
        return redirect()->back()->with('success', 'Submitted Successfully');
    }
    public function needDetails(Request $request)
    {
        $need = Need::where('id', $request->need)->where('status', 'approved')->first();

        if (!$need) {
            return back();
        }
        if (!Auth::user()->havBizProfile($need->ws_cat_id)) {
            return redirect()->back()->with('warning', 'You haven\'t Business profile in ' . $need->category->name . ' Category. Please Create a business profile in this category and try again');
        }
        if ($need->user_id == Auth::id()) {
            $bids = Bid::where('need_id', $need->id)->latest()->paginate(20);
        } else {
            $bids = Bid::where('need_id', $need->id)
                ->where('user_id', Auth::id())->paginate(50);
        }
        $totalBids = Bid::where('need_id', $need->id)->count();

        // return $bids;
        return view('user.whatYouWant.needDetails', compact('need', 'bids', 'totalBids'));
    }

    public function storeBid(Request $request)
    {
        // return $request->price;
        $request->validate([
            'delivery_date' => 'required|date',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);
        $need = Need::where('id', $request->need_id)->first();
        $user = Auth::user();
        if (!$need) {
            return back();
        }
        if ($need->user_id == $user->id) {
            return redirect()->back()->with('warning', 'You are Not able to bid your own Needs!!');
        }
        $bid = Bid::where('ws_cat_id', $need->ws_cat_id)
            ->where('workstation_id', $need->workstation_id)
            ->where('user_id', $user->id)
            ->where('need_id', $need->id)
            ->first();
        if ($bid) {
            return redirect()->back()->with('warning', 'Already Bided!!');
        }
        $bid = new Bid;
        $bid->description = $request->description;
        $bid->user_id = $user->id;
        $bid->need_id = $need->id;
        $bid->price = $request->price;
        $bid->ws_cat_id = $need->ws_cat_id;
        $bid->workstation_id = $need->workstation_id;
        $bid->service_profile = $request->service_profile;
        $bid->addedby_id = $user->id;
        $bid->delivery_date = $request->delivery_date;
        $bid->save();
        return redirect()->back()->with('success', 'Bid Successfully Submitted');
    }

    public function myBids(Request $request)
    {

        if ($request->status == 'approved') {
            menuSubmenu('myBids', 'approvedBids');
            $status = 'Approved';
            $bids = Bid::where('user_id', Auth::id())
                ->where('status', 'approved')
                ->latest()
                ->paginate();
        } elseif ($request->status == 'pending') {
            menuSubmenu('myBids', 'pendingBids');
            $status = 'Pending';
            $bids = Bid::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->latest()
                ->paginate();
        } elseif ($request->status == 'rejected') {
            menuSubmenu('myBids', 'rejectedBids');
            $status = 'Rejected';
            $bids = Bid::where('user_id', Auth::id())
                ->where('status', 'rejected')
                ->latest()
                ->paginate();
        } else {
            return back();
        }

        return view('user.whatYouWant.myBids', compact('bids', 'status'));
    }
    public function myBidDetails(Request $request)
    {
        $bid = Bid::find($request->bid);
        if (!$bid) {
            return back();
        }
        if ($bid->user_id != Auth::id()) {
            return back();
        }
        return view('user.whatYouWant.myBidDetails', compact('bid'));
    }
    public function updateBidStatus(Request $request)
    {
        $bid = Bid::where('id', $request->bid_id)->first();
        $need = Need::where('id', $request->need_id)->first();
        $bid_owner = User::where('id', $bid->user_id)->first();
        if (!$need) {
            return back();
        }
        if ($request->order_status == 'delivered') {
            if (!$bid->user_id == Auth::id()) {
                return back();
            }
            $need->order_status = 'delivered';
            $need->delivered_at = Carbon::now();
            $need->save();
        }
        if ($request->order_status == 'satisfied') {
            $need->order_status = 'satisfied';
            $need->payment_status = 'paid';
            $need->satisfied_at = Carbon::now();
            $need->save();
            if ($need->order_confirmed_price <= 0) {
                return back();
            }

            $bt = new BalanceTransaction;
            $bt->from = 'need_owner';
            $bt->to = 'bid_owner';
            $bt->purpose = 'need_delivery';
            $bt->user_id = $bid_owner->id;
            $bt->previous_balance = $bid_owner->balance;  // user old balance
            $bt->moved_balance = $need->order_confirmed_price; // job cost
            $bt->new_balance = $bid_owner->balance + $need->order_confirmed_price; // user new balance
            $bt->type = 'order';
            $bt->details = "To Delivery Needs, {$bt->moved_balance} TK deducted from User balance for Delivery Needs order.";
            $bt->type_id = $bid->id;
            $bt->addedby_id = Auth::id();
            $bt->save();

            $need->decrement('order_confirmed_price', $bt->moved_balance);
            $bid_owner->increment('balance', $bt->moved_balance);
        }

        return redirect()->back()->with('success', "Needs " . $request->order_status . " Successfully");
    }
    public function addTofavourite(Request $request)
    {
        $type = $request->type;
        $type_id = $request->typeid;
        if ($type == 'service_product') {
            $product = ServiceProfileProduct::find($type_id);
            if (!$product) {
                return back();
            }
            $fv = Favourite::where('favourable_id', $product->id)
                ->where('favourable_type', ServiceProfileProduct::class)
                ->first();

            if ($fv) {
                $fv->delete();
                $msg = 'Product Successfully Removed to Favourite';
                $added = false;
                // return redirect()->back()->with('warning','Product Successfully Removed to Favourite');
            } else {
                $fvn = new Favourite;
                $fvn->user_id = Auth::id();
                $fvn->favourable_id = $product->id;
                $fvn->favourable_type = ServiceProfileProduct::class;
                $fvn->addedby_id = Auth::id();
                $fvn->save();
                $msg = 'Product Successfully added to Favourite';
                $added = true;
            }
        } elseif ($type == 'service_profile') {
            $profile_id = ServiceProfile::find($type_id);
            if (!$profile_id) {
                return back();
            }
            $fv = Favourite::where('favourable_id', $profile_id->id)
                ->where('favourable_type', ServiceProfile::class)
                ->first();

            if ($fv) {
                $fv->delete();
                $msg = 'Shop/Service Successfully Removed to Favourite';
                $added = false;
                // return redirect()->back()->with('warning','Shop/Service Successfully Removed to Favourite');
            } else {
                $fvn = new Favourite;
                $fvn->user_id = Auth::id();
                $fvn->favourable_id = $profile_id->id;
                $fvn->favourable_type = ServiceProfile::class;
                $fvn->addedby_id = Auth::id();
                $fvn->save();
                $msg = 'Shop/Service Successfully added to Favourite';
                $added = true;
            }
        } elseif ($type == 'needs') {
            $need = Need::find($type_id);
            if (!$need) {
                return back();
            }
            $fv = Favourite::where('favourable_id', $need->id)
                ->where('favourable_type', Need::class)
                ->first();

            if ($fv) {
                $fv->delete();
                $msg = 'Needs Successfully Removed to Favourite';
                $added = false;
                // return redirect()->back()->with('warning','Needs Successfully Removed to Favourite');
            } else {
                $fvn = new Favourite;
                $fvn->user_id = Auth::id();
                $fvn->favourable_id = $need->id;
                $fvn->favourable_type = Need::class;
                $fvn->addedby_id = Auth::id();
                $fvn->save();
                $msg = 'Needs Successfully added to Favourite';
                $added = true;
            }
        } else {
            return back();
        }
        return redirect()->back()->with($added ? 'success' : 'warning', $msg);


        // return response()->json([
        //     'success' => true,
        //     'msg'=>"Working"
        // ]);

        // $type= $request->type;
        // $type_id= $request->typeid;
        // if ($type == 'service_product') {
        //     $product= ServiceProfileProduct::findOrFail($type_id);
        //     $fv= Favourite::where('favourable_id',$product->id)
        //     ->where('favourable_type',ServiceProfileProduct::class)
        //     ->first();
        //     if ($fv) {
        //         $fv->delete();
        //         return response()->json(['msg'=>'delete'], 200);
        //         $msg= 'Product Successfully Removed to Favourite';
        //         $success= false;
        //         // return redirect()->back()->with('warning','Product Successfully Removed to Favourite');
        //     }else{
        //         $fvn= new Favourite;
        //         $fvn->user_id= Auth::id();
        //         $fvn->favourable_id = $product->id;
        //         $fvn->favourable_type = ServiceProfileProduct::class;
        //         $fvn->addedby_id = Auth::id();
        //         $fvn->save();
        //         $msg= 'Product Successfully added to Favourite';
        //         $success= true;
        //     }
        // }elseif ($type == 'service_profile') {
        //     $profile_id= ServiceProfile::findOrFail($type_id);
        //     $fv= Favourite::where('favourable_id',$profile_id->id)
        //     ->where('favourable_type',ServiceProfile::class)
        //     ->first();
        //     if ($fv) {
        //         $fv->delete();
        //         // return response()->json(['msg'=>'delete'], 200);
        //         $msg= 'Shop/Service Successfully Removed to Favourite';
        //         $success= false;
        //         // return redirect()->back()->with('warning','Shop/Service Successfully Removed to Favourite');
        //     }else{
        //         $fvn= new Favourite;
        //         $fvn->user_id= Auth::id();
        //         $fvn->favourable_id = $profile_id->id;
        //         $fvn->favourable_type = ServiceProfile::class;
        //         $fvn->addedby_id = Auth::id();
        //         $fvn->save();
        //         $msg= 'Shop/Service Successfully added to Favourite';
        //         $success= true;
        //     }
        // }elseif ($type == 'needs') {
        //     $need= Need::findOrFail($type_id);
        //     $fv= Favourite::where('favourable_id',$need->id)
        //     ->where('favourable_type',Need::class)
        //     ->first();
        //     if ($fv) {
        //         $fv->delete();
        //         $msg= 'Needs Successfully Removed to Favourite';
        //         $success= false;
        //         // return redirect()->back()->with('warning','Needs Successfully Removed to Favourite');
        //     }else{
        //         $fvn= new Favourite;
        //         $fvn->user_id= Auth::id();
        //         $fvn->favourable_id = $need->id;
        //         $fvn->favourable_type = Need::class;
        //         $fvn->addedby_id = Auth::id();
        //         $fvn->save();
        //         $msg= 'Needs Successfully added to Favourite';
        //         $success= true;
        //     }
        // }else{
        //     return back();
        // }
        // if ($request->ajax()) {
        //     return response()->json([
        //         'success' => $success,
        //         'msg'=>$msg
        //     ]);
        // }
        // return response()->json([
        //     'success'=>$success,
        //     'msg'=>$msg
        // ], 200);
        // return redirect()->back()->with('success','Product Successfully added to Favourite');
    }
    public function favourite(Request $request)
    {
        $favourites = Favourite::latest()->paginate(50);
        return view('user.favourite.index', compact('favourites'));
    }
    public function myBlog(Request $request)
    {
        menuSubmenu('blog', 'blog');
        $user = Auth::user();
        $blogs = Blog::where('user_id', $user->id)
            ->where('publish_status', '!=', 'temp')
            // ->where('tags','like','Fugit')
            ->orderBy('id', 'DESC')
            ->paginate(30);
        // return $blogs;
        return view('user.myBlog.myblog', compact('blogs'));
    }
    public function editMyBlog(Request $request)
    {
        $blog = Blog::where('id', $request->blog)->first();
        if (!$blog) {
            return back();
        }
        if ($blog->user_id != Auth::id()) {
            return back()->with('warning', 'You are not able to edit another user blog');
        }
        $cats = BlogCategory::all();
        $oldTags = $blog->tags ? explode(", ", $blog->tags) : null;
        return view('user.myBlog.editMyBlog', compact('cats', 'oldTags', 'blog'));
    }
    public function updateMyBlog(Request $request)
    {
        $blog = Blog::find($request->blog);
        if (!$blog) {
            return back();
        }
        if ($blog->user_id != Auth::id()) {
            return back()->with('warning', 'You are not able to edit another user blog');
        }

        $request->validate([
            'excerpt' => 'max:254|required',
            'type' => 'required'
            // 'feature_image' => 'image|dimensions:min_with=300,min_height=200,ratio=3/2'
        ]);
        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $t = BlogTag::where('name', $tag)->first();
                if (!$t) {
                    $t = new BlogTag;
                    $t->name = $tag;
                    // $t->addedby_id = Auth::id();
                    $t->save();
                }
            }
        }

        $blog->title = $request->name ?: null;
        $blog->description = $request->description ?: null;
        $blog->excerpt = $request->excerpt ?: null;
        $blog->publish_status = $request->publish ? 'published' : 'draft';
        $blog->type = $request->type;
        $blog->editedby_id = Auth::id();

        if ($request->tags) {
            $blog->tags = implode(', ', $request->tags);
        } else {
            $blog->tags = null;
        }
        if ($request->hasFile('feature_image')) {
            $f = 'blog/' . $blog->feature_image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $ffile = $request->feature_image;
            $fimgExt = strtolower($ffile->getClientOriginalExtension());
            $fimageNewName = time() . '.' . $fimgExt;
            $originalName = $ffile->getClientOriginalName();
            Storage::disk('public')->put('blog/' . $fimageNewName, File::get($ffile));
            $blog->feature_img_name = $fimageNewName;
        }
        $blog->save();
        $blog->blogCategories()->detach();

        if ($request->categories) {
            foreach ($request->categories as $cat) {
                $c = PostCategory::where('category_id', $cat)->where('post_id', $blog->id)->first();
                if (!$c) {
                    $c = new PostCategory;
                    $c->category_id = $cat;
                    $c->post_id = $blog->id;
                    $c->addedby_id = Auth::id();
                    $c->save();
                }
            }
        }
        return redirect()->back()->with('success', 'Blog Updated Successfully');
    }
    public function reffer()
    {
        $user = Auth::user();
        $mySubscription = Subscriber::where('user_id', $user->id)->pluck('id');
        $iReffered = Subscriber::whereIn('referral_id', $mySubscription)->latest()->paginate(30);
        return view('subscriber.reffer.index', compact('iReffered'));
    }
    public function subscriberEdit(Subscriber $subcriber, Request $request)
    {
        $subcriber = Subscriber::find($request->subscription);
        $myReffer = Subscriber::where('referral_id', $subcriber->id)->latest()->paginate(20);
        $mySubscription = Subscriber::where('id', $subcriber->id)->first();
        $myLeader = Subscriber::where('id', $mySubscription->referral_id)->first();
        return view('subscriber.reffer.editSubscriber', compact('subcriber', 'myReffer', 'myLeader'));
    }
    public function loginAsAdmin(Request $request)
    {
        $adminCookie = Cookie::get('adminCookie');
        if (!$adminCookie) {
            return redirect('/');
        }
        Auth::logout();
        Auth::loginUsingId($adminCookie, true);
        Cookie::queue(Cookie::forget('adminCookie'));
        return redirect()->route('admin.dashboard');
    }
    public function userSettings()
    {
        menuSubmenu('user', 'settings');
        return view('user.userEdit.settings');
    }
    public function softcodeFreelanchingDashboard()
    {
        $user = Auth::user();
        $subscriber = Subscriber::where('user_id', $user->id)
            ->where('work_station_id', 1)
            ->where('category_id', 1)
            ->where('free_account', false)
            // ->where('active',true)
            ->first();

        if (!$subscriber) {
            return back()->with('warning', 'You haven\t subscription in this category. please subscribe and try again');
        }
        $workstation = WorkStation::find($subscriber->work_station_id);
        return  view('user.freelanchingDashboard', [
            'user' => $user,
            'subscription' => $subscriber,
            'workstation' => $workstation,
        ]);
    }
    public function suggesions(Request $request)
    {
        $suggessions = Suggestion::where('user_id', Auth::id())->latest()->paginate(20);
        return view('user.suggessions.suggessions', compact('suggessions'));
    }
    public function storeSuggesion(Request $request)
    {
        // $usrSuggession= Suggestion::where('user_id',Auth::id())->where('');
        $request->validate([
            'type' => 'required',
            'body' => 'required',
        ]);
        $suggesion = new Suggestion;
        $suggesion->user_id = Auth::id();
        $suggesion->body = $request->body;
        $suggesion->type = $request->type;
        $suggesion->addedby_id = Auth::id();
        $suggesion->save();

        return redirect()->back()->with('success', 'suggestion added successfully');
    }
    public function viewSuggesion(Request $request)
    {
        $suggestion = Suggestion::find($request->suggession);
        return view('user.suggessions.viewSuggessions', compact('suggestion'));
    }
    public function addSuggesionsPost(Request $request)
    {
        $request->validate([
            'body'=>'required'
        ]);
        if ($request->type == 'admin') {
            $parentSg= Suggestion::where('id',$request->parent)->first();
            $sg= new Suggestion;
            $sg->user_id =$parentSg->user_id;
            $sg->parent_id= $request->parent;
            $sg->admin_id= Auth::id();
            $sg->body= $request->body;
            $sg->type= $parentSg->type;
            $sg->addedby_id= Auth::id();
            $sg->save();
        }else {
            $parentSg= Suggestion::where('id',$request->parent)->first();
            $sg= new Suggestion;
            $sg->user_id =Auth::id();
            $sg->parent_id= $request->parent;
            $sg->body= $request->body;
            $sg->type= $parentSg->type;
            $sg->addedby_id= Auth::id();
            $sg->save();
        }

        return redirect()->back()->with('success','Success');
    }
    public function CloseSuggesionsPost(Request $request)
    {
        $sg= Suggestion::where('id',$request->parent)->first();
        $sg->closed = true;
        $sg->editedby_id = Auth::id();
        $sg->save();
        return redirect()->back()->with('success','Disscussion Closed');
    }
    public function OpenSuggesionsPost(Request $request)
    {
        $sg= Suggestion::where('id',$request->parent)->first();
        $sg->closed = false;
        $sg->editedby_id = Auth::id();
        $sg->save();
        return redirect()->back()->with('success','Disscussion Open');
    }
    public function ClosedSuggestionChat(Request $request)
    {
        $sg= Suggestion::where('parent_id',null)->where('user_id',Auth::id())->where('closed',true)->get();
        return view('user.suggessions.prev.closedChat',['suggessions'=>$sg]);
    }
    public function closedSuggestionChatDetails(Request $request)
    {
        $suggession= Suggestion::find($request->chat);
        return view('user.suggessions.prev.closedChatDetails',compact('suggession'));
    }
    public function ServiceProductSearchAjax(Request $request)
    {

        //    return "HELLO";
        if ($request->q == '') {
            $service_product = ServiceProfileProduct::where('status', 'approved')
                ->where('active', true)
                ->latest()
                ->simplePaginate(24);
        } else {
            $service_product = ServiceProfileProduct::where('status', 'approved')
                ->where('active', true)
                ->where('name', 'like', '%' . $request->q . '%')
                ->orWhere('sale_price', 'like', '%' . $request->q . '%')
                ->latest()
                ->simplePaginate(24);
        }


        $user = Auth::user();

        $page = View('user.allServiceProducts.serviceProductAjaxl', ['service_product' => $service_product, 'user' => $user])->render();
        // return $page;
        if ($request->ajax()) {
            return Response()->json(array(
                'q' => $request->q,
                'page' => $page,
            ));
        }
    }

    public function ServiceProfileCatSearchAjax(Request $request)
    {


        if($request->cat){
            if ($request->q == '') {
                $shops = ServiceProfile::select('id', 'lat', 'lng', 'workstation_id', 'ws_cat_id', 'subscriber_id', 'user_id', 'name', 'email', 'mobile', 'img_name', 'cover_image', 'home_delivery', 'offline_sale', 'online_sale', 'address', 'short_bio', 'zip_code', 'city', 'country', 'status', 'profile_type', 'addedby_id', 'open', 'package_status','website_link')
                ->where('status', 1)
                ->where('ws_cat_id', $request->cat)
                ->paginate(24);
            }else{
                $shops = ServiceProfile::select('id', 'lat', 'lng', 'workstation_id', 'ws_cat_id', 'subscriber_id', 'user_id', 'name', 'email', 'mobile', 'img_name', 'cover_image', 'home_delivery', 'offline_sale', 'online_sale', 'address', 'short_bio', 'zip_code', 'city', 'country', 'status', 'profile_type', 'addedby_id', 'open', 'package_status','website_link')
                ->where('status', 1)
                ->where('name', 'like', '%' . $request->q . '%')
                ->where('ws_cat_id', $request->cat)
                ->paginate(24);
            }
        }else{
            if ($request->q == '') {
                $shops = ServiceProfile::select('id', 'lat', 'lng', 'workstation_id', 'ws_cat_id', 'subscriber_id', 'user_id', 'name', 'email', 'mobile', 'img_name', 'cover_image', 'home_delivery', 'offline_sale', 'online_sale', 'address', 'short_bio', 'zip_code', 'city', 'country', 'status', 'profile_type', 'addedby_id', 'open', 'package_status','website_link')
                ->where('status', 1)
                ->paginate(24);
            }else{
                $shops = ServiceProfile::select('id', 'lat', 'lng', 'workstation_id', 'ws_cat_id', 'subscriber_id', 'user_id', 'name', 'email', 'mobile', 'img_name', 'cover_image', 'home_delivery', 'offline_sale', 'online_sale', 'address', 'short_bio', 'zip_code', 'city', 'country', 'status', 'profile_type', 'addedby_id', 'open', 'package_status','website_link')
                ->where('status', 1)
                ->where('name', 'like', '%' . $request->q . '%')
                ->paginate(24);
            }

        }
            


        $user = Auth::user();

        $page = View('user.softmarkets.includes.shopCardSmall', ['shops' => $shops, 'user' => $user])->render();
        // return $page;
        if ($request->ajax()) {
            return Response()->json(array(
                'q' => $request->q,
                'page' => $page,
            ));
        }
    }

    public function courseSearchAjax(Request $request)
    {

        //    return "HELLO";
        if ($request->q == '') {
            $courseall = Courseitem::where('status', 'approved')
                ->where('active', true)
                ->latest()
                ->simplePaginate(24);
        } else {
            $courseall = Courseitem::where('status', 'approved')
                ->where('active', true)
                ->where('title', 'like', '%' . $request->q . '%')
                ->where('ins_name', 'like', '%' . $request->q . '%')
                ->where('subtitle', 'like', '%' . $request->q . '%')
                ->orWhere('price', 'like', '%' . $request->q . '%')
                ->latest()
                ->simplePaginate(24);
        }


        $user = Auth::user();

        $page = View('user.course.courseallAjax', ['courseall' => $courseall, 'user' => $user])->render();
        // return $page;
        if ($request->ajax()) {
            return Response()->json(array(
                'q' => $request->q,
                'page' => $page,
            ));
        }
    }

    public function ServiceCategorySearchAjax(Request $request)
    {

        //    return "HELLO";
        if ($request->q == '') {
            $softmarkets = Category::where('sp_order', true)->where('active', true)->orderBy('name')->get();
        } else {
            $softmarkets = Category::where('sp_order', true) ->where('name', 'like', '%' . $request->q . '%')->where('active', true)->orderBy('name')->get();
        }


        $user = Auth::user();

        $page = View('user.softmarkets.includes.softmarketajax', ['softmarkets' => $softmarkets, 'user' => $user])->render();
        // return $page;
        if ($request->ajax()) {
            return Response()->json(array(
                'q' => $request->q,
                'page' => $page,
            ));
        }
    }
    public function ServieItems()
    {
        menuSubmenu('ServieItems', 'ServieItems');
        $serviceItems= Serviceitem::where('user_id',Auth::id())->latest()->get();
        return view('user.serviceItemsandorders.serviceItems', compact('serviceItems'));
    }

    public function ServieItemOrders(Request $request)
    {
        menuSubmenu('orders', 'ServieItemOrders');
        $orders= ServicePayment::whereHas('serviceitem',function($q){
            $q->where('user_id',Auth::id());
        })
        ->latest()
        ->get();
       return view('user.serviceItemsandorders.serviceItemOrders',compact('orders'));
    }
    public function ServieItemOrderDetails(Request $request)
    {
        if ($request->type == 'owner') {

            $order = ServicePayment::find($request->order);
            if ($order->serviceitem->user_id == Auth::id()) {
                return view('user.serviceItemsandorders.serviceItemOrderDetails', compact('order'));
            }else {
                return back();
            }
            
        } elseif ($request->type == 'user') {
            $order = ServicePayment::find($request->order);
            if ($order->user_id != Auth::id()) {
                return back();
            }
            return view('user.serviceItemsandorders.givenServiceItemOrderDetails', compact('order'));
        }
        return back();
    }
    public function getServieItemOrders(Request $request)
    {
        menuSubmenu('orders', 'ServieItemOrders');
        $orders= ServicePayment::where('user_id',Auth::id())
        ->latest()
        ->get();
       return view('user.serviceItemsandorders.GetServiceItemOrders',compact('orders'));
    }


    public function EnrollCourse(Request $request)
    {
        menuSubmenu('orders', 'enrollcourse');
        $orders= CourseOrder::where('user_id',Auth::id())
        ->latest()
        ->get();
       return view('user.courseenroll.allenrollcourse',compact('orders'));
    }

    public function EnrollCourseDetails(Request $request)
    {
        menuSubmenu('orders', 'enrollcourse');
        $order = CourseOrder::where('id', $request->order)->where('user_id', Auth::id())->first();
        $user = Auth::user();
        return view('user.courseenroll.enrollCourseDetails', compact('order', 'user'));
    }
    public function purchase(Request $request)
    {
        menuSubmenu('orders', 'getServieItemOrders');
        $user = Auth::user();
        $my_orders = ServiceProductOrder::where('user_id', $user->id)->orderBy('id', "DESC")->paginate(50);
        
        $orders= ServicePayment::whereHas('serviceitem',function($q){
            $q->where('user_id',Auth::id());
        })
        ->latest()
        ->get();
        //dd($orders);
       return view('user.serviceOrders.purchase',compact('my_orders','orders'));
    }
    public function sales(Request $request)
    {
        menuSubmenu('orders', 'serviceProfileOrders');
        $user = Auth::user();
      
        $myProfileIds = ServiceProfile::where('user_id', Auth::id())->where('profile_type', 'business')->pluck('id');
        $orders = ServiceProductOrder::whereIn('service_profile_id', $myProfileIds)->orderBy('id', 'DESC')->paginate(30);
        $orders2= ServicePayment::where('user_id',Auth::id())
        ->latest()
        ->get();
        
       return view('user.serviceOrders.sales',compact('orders','orders2'));
    }

    public function reffersaleshistory()
    {
        $user=User::where('id',request()->user)->first();


        $postpaid = Subscriber::where('user_id', $user->id)->where('free_account', true)->where('active', true)->count();
        $postpaid_reffer = Subscriber::where('user_id', $user->id)->where('free_account', true)->where('active', true)->count('referral_id');
        $prepaid_reffer = Subscriber::where('user_id', $user->id)->where('free_account', false)->where('active', true)->count('referral_id');
        $prepaid = Subscriber::where('user_id', $user->id)->where('free_account', false)->where('active', true)->count();
        $totalPfbalance = Subscriber::where('user_id', $user->id)->where('free_account', false)->sum('balance');
        $totalWithdrow = BalanceTransaction::where('user_id', $user->id)->where('purpose', 'withdraw')->sum('moved_balance');
        $totalDeposit = BalanceTransaction::where('user_id', $user->id)->where('purpose', 'deposit')->sum('moved_balance');
        $biz_profiles = ServiceProfile::where('profile_type', 'business')->where('user_id', $user->id)->where('paystatus', 1)->where('status', true)->get();
        $paidshop = ServiceProfile::where('user_id', $user->id)->where('paystatus', 1)->where('status', true)->count();
        $unpaidshop = ServiceProfile::where('user_id', $user->id)->where('paystatus', 0)->count();

        $sales = DB::table('service_product_orders')
        ->leftjoin('service_profiles', 'service_product_orders.service_profile_id', '=', 'service_profiles.id')
        ->where('service_profiles.user_id', $user->id)
        ->where('service_profiles.profile_type', 'business')
        ->select('service_product_orders.*')
        ->get();
       
     
        $sales_total = $sales->sum('total_sale_price');
        $sales_count = $sales->count('service_profile_id');
    
        
      
    
        $purchase_total = ServiceProductOrder::where('user_id',$user->id)->sum('total_sale_price');
        $purchase_count = ServiceProductOrder::where('user_id',$user->id)->count('user_id');
       
        $user = User::withoutGlobalScopes()->where('id', request()->user)->firstOrFail();
     
        // $standard_subscriber= $user->subscriber->where('free_account',0)->where('user_id',Auth::id())->get();
        $subscription = Subscriber::where('user_id', '!=', request()->user)
            ->where('free_account', false)
            ->where('referral_id', '!=', null)
            ->get();
  
        return view('user.employee.refferdetailshistory', compact('postpaid','paidshop','unpaidshop','sales_total','purchase_count','sales_count','purchase_total', 'prepaid', 'totalPfbalance', 'totalWithdrow', 'biz_profiles', 'totalDeposit', 'postpaid_reffer', 'prepaid_reffer','subscription','user'));
    }

   //Job and vacancy announce
   public function jobdashboard()
   {
       if (Auth::check()) {
           $ids = Subscriber::where('user_id', Auth::id())->groupBy('category_id')->pluck('id');
           if ($ids) {
               $t =  DB::table('subscribers')
                   ->where('user_id', Auth::id())
                   ->where('active', true)
                   ->whereNotIn('id', $ids)
                   ->update([
                       'active' => false
                   ]);
           }
       }
       $request = request();
       $request->session()->forget(['lsbm', 'lsbsm']);
       $request->session()->put(['lsbm' => 'dashboard', 'lsbsm' => 'dashboard']);
       $user = Auth::user();
       $subscriber = Subscriber::where('user_id', $user->id)->first();

       // $shops = ServiceProfile::where('profile_type', 'business')->where('status', 1)->has('isOrderTrue')->has('liveProducts')->simplePaginate(24);

       $lat = $user->lat ?: 23.792433799999998;
       $lng = $user->lng ?: 90.4266676;
       $number = filter_var($request->radius, FILTER_SANITIZE_NUMBER_INT);
       $radius = $number ? (int) $number : 3000;
       if ($lat and $lng) {
           $haversine = "(6371 * acos(cos(radians(" . $lat . ")) 
                       * cos(radians(`lat`)) 
                       * cos(radians(`lng`) 
                       - radians(" . $lng . ")) 
                       + sin(radians(" . $lat . ")) 
                       * sin(radians(`lat`))))";
       }

       $shops = ServiceProfile::select('id', 'lat', 'lng', 'workstation_id', 'ws_cat_id', 'subscriber_id', 'user_id', 'name', 'email', 'mobile', 'img_name', 'cover_image', 'address', 'short_bio', 'zip_code', 'city', 'country', 'status','paystatus', 'profile_type', 'addedby_id', 'open', 'fixed_location', 'package_status')
           ->where('profile_type', 'business', 'expired_at')
           ->where('status', 1)
           ->where('paystatus',1)
           ->where(function ($q) {
               $q->where('expired_at', '>=', Carbon::now()->today());
               $q->orWhere('expired_at', null);
           })
           // ->has('isOrderTrue')
           // ->has('liveProducts')
           // ->whereRaw("{$haversine} < ?", [$radius])
           ->selectRaw("{$haversine} AS distance")
           ->latest()
           ->orderBy('distance')
           ->paginate(8);
        //dd($shops);

       return view('user.jobs.jobdashboard', [
           'user' => $user,
           // 'biz_profiles' => $biz_profile,
           'subscriber' => $subscriber,
           'shops' => $shops
       ]);
   }



   //end job and vacancy announce
    //Delivery Man


    public function createdeliveryman()
    {
        menuSubmenu('delivery', 'delivery');
        return view('user.deliveryman.create');
    }
    public function storedeliveryman(Request $request)
    {
        $request->validate([
            'name' => 'required',
            //'phone' => 'required |unique:deliverymans,phone',
            'nid' => 'required',
        ]);
        $user = Auth::user();
        $data = new DeliveryMan;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->nid = $request->nid;
        $data->address = $request->address;
        $data->area = $request->area;
        $data->user_id =$user->id;

        //dd($request->profile_image);
      
        if ($pi = $request->profile_image) {
            $f = 'user/deliveryman/' . $data->profile_image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $extension = strtolower($pi->getClientOriginalExtension());
            $randomFileName = $data->id . '_profileimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            list($width, $height) = getimagesize($pi);
            $mime = $pi->getClientOriginalExtension();
            $size = $pi->getSize();

            $originalName = strtolower($pi->getClientOriginalName());

            Storage::disk('public')->put('user/deliveryman/' . $randomFileName, File::get($pi));

            $data->profile_image = $randomFileName;
            $data->save();
        }

        if ($ni = $request->nid_image) {
            $f = 'user/deliveryman/' . $data->nid_image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $extension1 = strtolower($ni->getClientOriginalExtension());
            $randomFileName = $data->id . '_nidimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension1;

            list($width, $height) = getimagesize($ni);
            $mime = $ni->getClientOriginalExtension();
            $size = $ni->getSize();

            $originalName = strtolower($ni->getClientOriginalName());

            Storage::disk('public')->put('user/deliveryman/' . $randomFileName, File::get($ni));

            $data->nid_image = $randomFileName;
            $data->save();
        }
        $data->save();
       
        return redirect()->route('user.listdeliveryman')->with('success', 'Delivery Man Added Successfully');
        
    }
    public function editdeliveryman($id)
    {
        menuSubmenu('delivery', 'delivery');
        $data = DeliveryMan::find($id);
        return view('user.deliveryman.edit',compact('data')); 
    }
    public function updatedeliveryman(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'nid' => 'required',
        ]);
        $data = DeliveryMan::where('id',$request->id)->first();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->nid = $request->nid;
        $data->address = $request->address;
        $data->area = $request->area;
        $data->save();
        if ($pi = $request->profile_image) {
            $f = 'user/deliveryman/' . $data->profile_image;
          
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $extension = strtolower($pi->getClientOriginalExtension());
            $randomFileName = $data->id . '_profileimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            list($width, $height) = getimagesize($pi);
            $mime = $pi->getClientOriginalExtension();
            $size = $pi->getSize();

            $originalName = strtolower($pi->getClientOriginalName());

            Storage::disk('public')->put('user/deliveryman/' . $randomFileName, File::get($pi));

            $data->profile_image = $randomFileName;
            $data->save();
        }

        if ($ni = $request->nid_image) {
            $f = 'user/deliveryman/' . $data->nid_image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $extension = strtolower($ni->getClientOriginalExtension());
            $randomFileName = $data->id . '_nidimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            list($width, $height) = getimagesize($ni);
            $mime = $ni->getClientOriginalExtension();
            $size = $ni->getSize();

            $originalName = strtolower($ni->getClientOriginalName());

            Storage::disk('public')->put('user/deliveryman/' . $randomFileName, File::get($ni));

            $data->nid_image = $randomFileName;
            $data->save();
        }
        return redirect()->route('user.listdeliveryman')->with('success', 'Delivery Man Update Successfully');
    }
    public function deletedeliveryman($id)
    {
        $data = DeliveryMan::where('id',$id)->first();
        $f = 'user/deliveryman/' . $data->image;
        if (Storage::disk('public')->exists($f)) {
            Storage::disk('public')->delete($f);
        }
        $data->delete();
        return redirect()->route('user.listdeliveryman')->with('success', 'Delivery Man Delete Successfully');
        
    }
    public function listdeliveryman()
    {
        menuSubmenu('delivery', 'delivery');
        $user = Auth::user();
        $datas = DeliveryMan::where('user_id', $user->id)->latest()->paginate(20);

        return view('user.deliveryman.index', [
            'datas' => $datas
        ]);
    }


    public function orderpendingbalancedetails(Request $request)
    {
        menuSubmenu('orders', 'serviceProfileOrders');
        $user = Auth::user();
        $myProfileIds = ServiceProfile::where('user_id', $user->id)->where('profile_type', 'business')->pluck('id');
        $orders = ServiceProductOrder::whereIn('service_profile_id', $myProfileIds)->whereIn('order_status', ['pending', 'confirmed', 'processing','ready_to_ship','shipped','delivered'])->where('payment_status','advanced')->orderBy('id', 'DESC')->paginate(24);
        $deliveryman=DeliveryMan::where('user_id',$user->id)->get();

        return view('user.serviceOrders.myProfileOrders.myProfileOrders', compact('orders', 'user','deliveryman'));
    }


    //Withdrawal account add

    public function addwithdrawalaccount()
    {
        $user = Auth::user();
        menuSubmenu('user', 'withdrawalaccount');
        return view('user.withdraw.addwithdrawalaccounts',compact('user'));
    }

    public function withdrawalaccountlist()
    {
        menuSubmenu('user', 'withdrawalaccount');
        $user = Auth::user();
        $datas=WithdrawalAccount::where('user_id',$user->id)->get();
    
        return view('user.withdraw.withdrawalaccountslist',compact('user','datas'));
    }
    public function withdrawalaccountedit($id)
    {
        menuSubmenu('user', 'withdrawalaccount');
        $user = Auth::user();
        $data=WithdrawalAccount::find($id);

    
        return view('user.withdraw.editwithdrawalaccounts',compact('user','data'));
    }



     public function withdrawalaaccountstore(Request $request)
    {

       // dd($request->all());
        $me = Auth::user();
        $validation = Validator::make(
            $request->all(),
            [
                'password' => ['required', 'string', 'min:6'],
                'pin' => ['required', 'numeric', 'string', 'min:4'],
                'number' => ['required'],
                'name' => ['required'],

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }
      
           
    
            if ((Hash::check($request->password, $me->password)) && ($me->pin==$request->pin)){
                $check=WithdrawalAccount::where('type',$request->type)->where('user_id',$me->id)->count();
                //dd($check);
                if($check<1){
                    $data = new WithdrawalAccount;
                    $data->name = $request->name;
                    $data->number = $request->number;
                    $data->type = $request->type;
                    $data->user_id =$me->id;
                    $data->save();

                    return redirect()->route('user.withdrawalaccountlist')->with('success', 'Withdrawal Account Added Successfully');

                }else{
                    return redirect()->back()->with('error','Already Add This Type Account.If You Want To Change Number Please Edit');
                }

               

            }else{
                return redirect()->back()->with('error','Password Or Pin Wrong.Please Enter Correct Password');

            }


    }


    public function withdrawalaaccountupdate(Request $request)
    {

       // dd($request->all());
        $me = Auth::user();
        $validation = Validator::make(
            $request->all(),
            [
                'password' => ['required', 'string', 'min:6'],
                'pin' => ['required', 'numeric', 'string', 'min:4'],
                'number' => ['required'],
                'name' => ['required'],

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }
      
           
    
            if ((Hash::check($request->password, $me->password)) && ($me->pin==$request->pin)){
                //dd($request->all());
              
                    $data =WithdrawalAccount::where('id',$request->id)->first();;
                    $data->name = $request->name;
                    $data->number = $request->number;
                    $data->save();

                    return redirect()->route('user.withdrawalaccountlist')->with('success', 'Withdrawal Account Update Successfully');

               

            }else{
                return redirect()->back()->with('error','Password Or Pin Wrong.Please Enter Correct Password');

            }


    }

    public function withdrawalaccountdelete($id)
    {
        $data = WithdrawalAccount::where('id',$id)->first();
        $data->delete();
        return redirect()->route('user.withdrawalaccountlist')->with('success', 'Withdrawal Account Delete Successfully');
        
    }


    //End Withdrawal account


    //Review Ratings

    public function ratingstore(Request $request)
    {

       // dd($request->all());
        $me = Auth::user();
        $validation = Validator::make(
            $request->all(),
            [
                'rating' => ['required', 'digits_between:1,5'],
                'comments' => ['required'],
                'profile_id' => ['required'],

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }
      
           
    
            
        $data = new Rating;
        $data->user_id = $me->id;
        $data->profile_id = $request->profile_id;
        $data->type = 'Profile';
        $data->rating =$request->rating;
        $data->comments =$request->comments;
        $data->status ='Approved';
        $data->save();

        return redirect()->back()->with('success', 'Rating And Review Added Successfully');

    


    }

    public function ratingdelete($id)
    {
        $data = Rating::where('id',$id)->first();
        $data->delete();
        return redirect()->back()->with('success', 'Rating And Review Delete Successfully');
        
    }


    //Softcom Job Candidate account add

    public function SoftcomJobApplyForm()
    {
        $categories = SoftcomApplicantCategory::get();
        $user = Auth::user();
        menuSubmenu('dashboard', 'softcomjobcandidate');
        return view('user.softcomjobapply.softcomjobapplyform',compact('user','categories'));
    }

    public function SoftcomJobApplyStore(Request $request)
    {

        //dd($request->all());
        $user = Auth::user();
        menuSubmenu('dashboard', 'softcomjobcandidate');
        $me = Auth::user();
        $validation = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'mobile' => ['required'],
                'nid' => ['required'],
                'nid_image' => ['required'],
                'candidate_image' => ['required'],
                'qualification' => ['required'],
                'category' => ['required']

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $check = SoftcomJobCandidate::where('user_id',$me->id)->count();
        if($check>0){
            return redirect()->back()->with('warning', 'Your Already Apply');

        }
       
      
           
    
            
        $data = new SoftcomJobCandidate;
        $data->user_id = $me->id;
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->nid = $request->nid;
        $data->qualification = $request->qualification;
        $data->description = $request->description;
        $data->category = $request->category;
        $data->status =0;
        $data->save();
        if ($pi = $request->candidate_image) {
            $f = 'user/softcomcandidate/' . $data->candidate_image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $extension = strtolower($pi->getClientOriginalExtension());
            $randomFileName = $data->id . '_candidateimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            list($width, $height) = getimagesize($pi);
            $mime = $pi->getClientOriginalExtension();
            $size = $pi->getSize();

            $originalName = strtolower($pi->getClientOriginalName());

            Storage::disk('public')->put('user/softcomcandidate/' . $randomFileName, File::get($pi));

            $data->candidate_image = $randomFileName;
            $data->save();
        }

        if ($ni = $request->nid_image) {
            $f = 'user/softcomcandidate/' . $data->nid_image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $extension1 = strtolower($ni->getClientOriginalExtension());
            $randomFileName = $data->id . '_nidimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension1;

            list($width, $height) = getimagesize($ni);
            $mime = $ni->getClientOriginalExtension();
            $size = $ni->getSize();

            $originalName = strtolower($ni->getClientOriginalName());

            Storage::disk('public')->put('user/softcomcandidate/' . $randomFileName, File::get($ni));

            $data->nid_image = $randomFileName;
            $data->save();
        }
      
       

        return redirect()->back()->with('success', 'Apply Successfully Complete');
    }

    public function SoftcomJobApplyList()
    {
        menuSubmenu('dashboard', 'softcomjobcandidate');
        $user = Auth::user();
        $categories=SoftcomApplicantCategory::get();
        $datas=SoftcomJobCandidate::where('user_id',$user->id)->paginate(24);
        $count=$datas->count();

      

        if($count>0){
            return view('user.softcomjobapply.softcomapplylist',compact('user','datas','categories'));
        }else{
            return view('user.softcomjobapply.softcomjobapplyform',compact('user','categories'));
        }
    
       
    }

    public function SoftcomJobApplyDelete($id)
    {
        $data = SoftcomJobCandidate::where('id',$id)->first();

        $check=ServiceProfileWorker::where('worker_id',$data->id)->first();
        if($check){
            return redirect()->back()->with('warning', 'You Cant Delete.Depend On Others Activities'); 
        }
        $data->delete();
        return redirect()->back()->with('success', 'Apply Delete Successfully');
        
    }

    public function SoftcomJobCandidateApprovedList()
    {
        menuSubmenu('dashboard', 'softcomjobcandidate');
        $user = Auth::user();
        $datas=SoftcomJobCandidate::where('status',1)->whereNOTIn('user_id',[$user->id])->paginate(24);
    
        return view('user.softcomjobapply.allapprovedcandidate',compact('user','datas'));
    }

    public function AssignApplicantforServiceprofile($workerid)
    {
        menuSubmenu('dashboard', 'softcomjobcandidate');
        $user = Auth::user();
        $data=SoftcomJobCandidate::where('status',1)->where('id',$workerid)->first();
        $profiles=ServiceProfile::where('user_id',$user->id)->get();

        //dd($data);
    
        return view('user.softcomjobapply.assignapplicantforserviceprofile',compact('user','data','profiles'));
    }

    public function AssignApplicantforServiceprofileStore(Request $request)
    {

       // dd($request->all());
        $me = Auth::user();
        $validation = Validator::make(
            $request->all(),
            [
                'worker_user_id' => ['required'],
                'worker_id' => ['required'],
                'profile_id' => ['required'],
                'owner_id' => ['required']

            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $check1 = ServiceProfileWorker::where('worker_id',$request->worker_id)->count();
        if($check1>10){
            return redirect()->back()->with('warning', 'You cant asign this person. He already asign 10 profile.Try another one');

        }
        $check = ServiceProfileWorker::where('worker_id',$request->worker_id)->where('profile_id',$request->profile_id)->first();
        if($check){
            return redirect()->back()->with('warning', 'You alreday asign this person for your service profile');

        }
        $category=SoftcomApplicantCategory::where('id',$request->category)->first();

        if(!$category){
            return redirect()->back()->with('warning', 'Worker Category Not Found');

        }
       
      
        $sdate = Carbon::today();   
        $edate = Carbon::today()->addDays(30);
            
        $data = new ServiceProfileWorker;
        $data->worker_id = $request->worker_id;
        $data->worker_user_id = $request->worker_user_id;
        $data->profile_id = $request->profile_id;
        $data->owner_id = $request->owner_id;
        $data->name = $request->workername;
        $data->category = $request->category;
        $data->order = $request->order_list ? 1 : 0;
        $data->order_change = $request->order_status_change ? 1 : 0;
        $data->order_details = $request->order_status_details  ? 1 : 0;
        $data->customer_list = $request->customer_list ? 1 : 0;
        $data->add = $request->add ? 1 : 0;
        $data->edit = $request->edit ? 1 : 0;
        $data->delete = $request->delete ? 1 : 0;
        $data->list = $request->list ? 1 : 0;
        $data->status = true;
        $data->sdate =$sdate;
        $data->edate =$edate;

        if($category->name=="Shop Manager"){
            if ($category->total_amount > $me->balance) {
                return redirect()->back()->with('warning', 'Insufficient balance');
            }

            $bt = new BalanceTransaction;
            $bt->from = 'profile_owner';
            $bt->to = 'admin';
            $bt->purpose = 'for_worker';
            $bt->user_id = $me->id;
            $bt->previous_balance = $me->balance;  // user old balance
            $bt->moved_balance = $category->total_amount; // job cost
            $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
            $bt->type = 'worker';
            $bt->details = "To Assign Worker ({$request->workername}) For Service Profile. {$bt->moved_balance} TK deducted from tenant balance for assign worker service. {$category->service_charge} For Service Charge. {$category->salary_amount} For Charge Worker Salary";
            $bt->type_id = $request->worker_user_id;
            $bt->addedby_id = $me->id;
            $bt->save();
            $me->decrement('balance', $category->total_amount);
            $data->save();
        }else{
            if ($category->service_charge > $me->balance) {
                return redirect()->back()->with('warning', 'Insufficient balance');
            }

            $bt = new BalanceTransaction;
            $bt->from = 'profile_owner';
            $bt->to = 'admin';
            $bt->purpose = 'for_worker';
            $bt->user_id = $me->id;
            $bt->previous_balance = $me->balance;  // user old balance
            $bt->moved_balance = $category->service_charge; // job cost
            $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
            $bt->type = 'worker';
            $bt->details = "To Assign Worker ({$request->workername}) For Service Profile. {$bt->moved_balance} TK deducted from tenant balance for assign worker service. {$category->service_charge} For Service Charge.";
            $bt->type_id = $request->worker_user_id;
            $bt->addedby_id = $me->id;
            $bt->save();
            $me->decrement('balance', $category->service_charge);
            $data->save();

        }
        
        return redirect()->route('user.SoftcomJobCandidateApprovedList')->with('success', 'Worker Assign Successfully');
    }

    public function MyProfileworkerlist()
    {
        menuSubmenu('dashboard', 'myprofileworker');
        $user = Auth::user();
        $datas=ServiceProfileWorker::where('owner_id', $user->id)->paginate(24);
    
        return view('user.softcomjobapply.myprofileworkerlist',compact('user','datas'));
    }
    public function MyProfileworkerdetails($id)
    {
        $data = SoftcomJobCandidate::where('id', $id)->first();
        return view('user.softcomjobapply.myprofileworkerdetails', compact('data'));
    }

    public function MyworkedProfilelist()
    {
        menuSubmenu('dashboard', 'myworkedprofile');
        $user = Auth::user();
        $datas=ServiceProfileWorker::where('worker_user_id', $user->id)->paginate(24);
    
        return view('user.softcomjobapply.myworkedprofilelist',compact('user','datas'));
    }
    public function WorkerGetSalary($id)
    {
        menuSubmenu('dashboard', 'myworkedprofile');
        $me = Auth::user();
        $data=ServiceProfileWorker::where('id',$id)->first();
        $category=SoftcomApplicantCategory::where('id',$data->category)->first();

        if(!$category){
            return redirect()->back()->with('warning', 'Worker Category Not Found');

        }

        if($category->name=='Shop Manager'){
            if($data->edate <= Carbon::today()) {
                //dd('ok');
                $bt = new BalanceTransaction;
                $bt->from = 'admin';
                $bt->to = 'user';
                $bt->purpose = 'worker_salary';
                $bt->user_id = $me->id;
                $bt->previous_balance = $me->balance;  // user old balance
                $bt->moved_balance = $category->salary_amount; // job cost
                $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
                $bt->type = 'worker';
                $bt->details = "{$bt->moved_balance} TK added from profile owner for salary.";
                $bt->type_id = $data->owner_id;
                $bt->addedby_id = $me->id;
                $bt->save();
                $me->increment('balance', $category->salary_amount);
                $data->salary_status=true;
                $data->save();
                return redirect()->route('user.MyworkedProfilelist')->with('success', 'You Get Salary Successfully');
    
            }else{
                return redirect()->route('user.MyworkedProfilelist')->with('warning', 'Your Working Month Not Closed');
    
            }

        }else{
            return redirect()->route('user.MyworkedProfilelist')->with('warning', 'Something Went To Wrong');
        }

        
    }


        public function WorkerRenew($id)
        {
            menuSubmenu('dashboard', 'myworkedprofile');
            $me = Auth::user();
           

            $sdate = Carbon::today();   
            $edate = Carbon::today()->addDays(30);

            $data=ServiceProfileWorker::where('id',$id)->first();
    
            $data->sdate =$sdate;
            $data->edate =$edate;  
            $data->salary_status =false;
            $category=SoftcomApplicantCategory::where('id',$data->category)->first();

            if(!$category){
                return redirect()->back()->with('warning', 'Worker Category Not Found');
    
            }

            if($category->name=='Shop Manager'){
                if ($category->total_amount > $me->balance) {
                    return redirect()->back()->with('warning', 'Insufficient balance');
                }
                $bt = new BalanceTransaction;
                $bt->from = 'profile_owner';
                $bt->to = 'admin';
                $bt->purpose = 'for_worker';
                $bt->user_id = $me->id;
                $bt->previous_balance = $me->balance;  // user old balance
                $bt->moved_balance = $category->total_amount; // job cost
                $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
                $bt->type = 'worker';
                $bt->details = "To Assign Worker ({$data->name}) For Service Profile. {$bt->moved_balance} TK deducted from tenant balance for assign worker service. {$category->service_charge} For Service Charge. {$category->salary_amount} For Charge Worker Salary";
                $bt->type_id = $data->worker_user_id;
                $bt->addedby_id = $me->id;
                $bt->save();
                $me->decrement('balance', $category->total_amount);

            }else{
                if ($category->service_charge > $me->balance) {
                    return redirect()->back()->with('warning', 'Insufficient balance');
                }
                $bt = new BalanceTransaction;
                $bt->from = 'profile_owner';
                $bt->to = 'admin';
                $bt->purpose = 'for_worker';
                $bt->user_id = $me->id;
                $bt->previous_balance = $me->balance;  // user old balance
                $bt->moved_balance = $category->service_charge; // job cost
                $bt->new_balance = $bt->previous_balance - $bt->moved_balance; // user new balance
                $bt->type = 'worker';
                $bt->details = "To Assign Worker ({$data->name}) For Service Profile. {$bt->moved_balance} TK deducted from tenant balance for assign worker service. {$category->service_charge} For Service Charge.";
                $bt->type_id = $data->worker_user_id;
                $bt->addedby_id = $me->id;
                $bt->save();
                $me->decrement('balance', $category->service_charge);

            }
            
           

            $data->save();

            return redirect()->route('user.MyProfileworkerlist')->with('Success', 'Worker Renew Successfully');
    
        
    }

    public function editworkeraccess($id)
    {
        menuSubmenu('dashboard', 'myprofileworker');
        $data = ServiceProfileWorker::find($id);
        return view('user.softcomjobapply.editworkeraccess',compact('data')); 
    }
    public function updateworkeraccess(Request $request)
    {
        
       
        $data = ServiceProfileWorker::where('id',$request->id)->first();
       // dd( $request->all());
        $data->order = $request->order_list ? 1 : 0;
        $data->order_change = $request->order_change ? 1 : 0;
        $data->order_details = $request->order_status_details  ? 1 : 0;
        $data->customer_list = $request->customer_list ? 1 : 0;
        $data->add = $request->add ? 1 : 0;
        $data->edit = $request->edit ? 1 : 0;
        $data->delete = $request->delete ? 1 : 0;
        $data->list = $request->list ? 1 : 0;
        $data->status = $request->status ? 1 : 0;


        $data->save();
     
        return redirect()->route('user.MyProfileworkerlist')->with('success', 'Access Update Successfully');
    }

    public function getCourier(Request $request, $id=null)
    {
        $data = ValuedCustomer::where('type', 'LIKE', '4')->get();

        return view('user.serviceOrders.myProfileOrders.courier',compact('data'));
             
      
    }






}//class end
