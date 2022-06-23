<?php

namespace App\Http\Controllers\Welcome;

use Cookie;
use App\Models\Page;
use App\Models\WorkStation;
use App\Http\Controllers\Controller;
use App\Models\BalanceTransaction;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Category;
use App\Models\Need;
use App\Models\Negotiation;
use App\Models\Opinion;
use App\Models\Serviceitem;
use App\Models\ServicePayment;
use App\Models\ServiceProductCart;
use App\Models\ServiceProductOrder;
use App\Models\ServiceProfile;
use App\Models\ServiceProfileProduct;
use App\Models\ServiceProfileVisitor;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\Courseitem;
use App\Models\ValuedCustomer;
use App\Models\Rating;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Validator;

use Illuminate\Support\Facades\Hash;

class WelcomeController extends Controller
{

    public function welcomePage(Request $request, Page $page)
    {

        return view('theme.prt.page', ['page' => $page]);
    }
    public function workstationDetails(WorkStation $workstation)
    {
        // dd($workstation);
        return view('theme.prt.workstationDetails', [
            'workstation' => $workstation
        ]);
    }

    public function pf()
    {
        $reffer = request()->reffer;

        if ($reffer) {
            //previous destroy
            $cookie = request()->cookie('reffer');
            if ($cookie) {
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
    }
    public function profileShare(Request $request)
    {
        $profile = ServiceProfile::find($request->profile);
        if (!$profile) {
            return back();
        }

        $rating=Rating::where('profile_id',$request->profile)->orderBy('id', 'desc')->take(10)->get();

        $refferPf = $request->reffer;
        // return($subscription);
        if (Auth::check()) {
            $subscription = Subscriber::where('user_id', Auth::id())->where('category_id', $profile->ws_cat_id)->first();
            if ($subscription) {
                if ($refferPf == $subscription->subscription_code) {
                    if ($profile->category->business_type == 'shop') {
                        $business_type = 'shop';
                        $visitors = ServiceProfileVisitor::where('service_profile_id', $profile->id)->where('user_id', Auth::id())->first();
                        $service_product = ServiceProfileProduct::where('service_profile_id', $profile->id)->where('status', 'approved')->where('active', true)->orderBy('id', 'DESC')->paginate(20);
                        $cart = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->sum('quantity');
                        $my_order_count = ServiceProductOrder::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->count();

                        $my_orders_price = ServiceProductOrder::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->where('order_status', 'confirmed')
                            ->where(function ($query) {
                                $query->where('order_status', 'ready_to_ship');
                                $query->orWhere('order_status', 'confirmed');
                                $query->orWhere('order_status', 'proccesing');
                                $query->orWhere('order_status', 'shipped');
                                $query->orWhere('order_status', 'delivered');
                            })
                            ->latest()->sum('total_sale_price');

                        $sp_price = $profile->category->sp_full_price;
                    } elseif ($profile->category->business_type == 'service') {
                        $business_type = 'service';
                        $visitors = ServiceProfileVisitor::where('service_profile_id', $profile->id)->where('user_id', Auth::id())->first();

                        $service_product = Serviceitem::where('service_profile_id', $profile->id)->where('status', 'approved')->where('active', true)->orderBy('id', 'DESC')->paginate(20);
                        $cart = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->sum('quantity');
                        $my_order_count = ServiceProductOrder::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->count();

                        $my_orders_price = ServiceProductOrder::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->where('order_status', 'confirmed')
                            ->where(function ($query) {
                                $query->where('order_status', 'ready_to_ship');
                                $query->orWhere('order_status', 'confirmed');
                                $query->orWhere('order_status', 'proccesing');
                                $query->orWhere('order_status', 'shipped');
                                $query->orWhere('order_status', 'delivered');
                            })
                            ->latest()->sum('total_sale_price');

                        $sp_price = $profile->category->sp_full_price;
                    }elseif ($profile->category->business_type == 'course') {
                        $business_type = 'course';
                        $visitors = ServiceProfileVisitor::where('service_profile_id', $profile->id)->where('user_id', Auth::id())->first();

                        $service_product = Courseitem::where('service_profile_id', $profile->id)->where('status', 'approved')->where('active', true)->orderBy('id', 'DESC')->paginate(20);
                        $cart = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->sum('quantity');
                        $my_order_count = ServiceProductOrder::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->count();

                        $my_orders_price = ServiceProductOrder::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->where('order_status', 'confirmed')
                            ->where(function ($query) {
                                $query->where('order_status', 'ready_to_ship');
                                $query->orWhere('order_status', 'confirmed');
                                $query->orWhere('order_status', 'proccesing');
                                $query->orWhere('order_status', 'shipped');
                                $query->orWhere('order_status', 'delivered');
                            })
                            ->latest()->sum('total_sale_price');

                        $sp_price = $profile->category->sp_full_price;
                    }

                    // $orderd_Price= $my_orders->where('order_status','confirmed')->first()->total_sale_price;

                    // if ($my_orders->sp_full_price >= $sp_price) {
                    //     return "Orderd Price getter then Sp Price";
                    // }else {
                    //     return "Sp Price getter then Orderd Price";
                    // }

                    //subscriber.profile.findProfileDetails theme.prt.profileDetailsLatest

                    return view('theme.prt.profileDetailsLatest', [
                        'subscription' => $subscription,
                        'profile' => $profile,
                        'visitor' => $visitors,
                        'service_product' => $service_product,
                        'cart' => $cart,
                        'my_order_count' => $my_order_count,
                        'my_orders_price' => $my_orders_price,
                        'business_type' => $business_type,
                        'rating' => $rating
                    ]);
                } else {
                    return redirect()->route('welcome.profileShare', ['profile' => $profile->id, 'reffer' => $subscription->subscription_code]);
                }
            } else {
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
                if ($refferPf == $s->subscription_code) {
                    $visitors = ServiceProfileVisitor::where('service_profile_id', $profile->id)->first();
                    $service_product = ServiceProfileProduct::where('service_profile_id', $profile->id)->where('status', 'approved')->where('active', true)->orderBy('id', 'DESC')->paginate(20);

                    $cart = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->sum('quantity');

                    // $my_orders = ServiceProductOrder::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->get();
                    $my_order_count = ServiceProductOrder::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->count();
                    // return $my_order_count;

                    return view('theme.prt.profileDetailsLatest', [
                        'subscription' => $s,
                        'profile' => $profile,
                        'visitor' => $visitors,
                        'service_product' => $service_product,
                        'cart' => $cart,
                        'my_order_count' => $my_order_count,
                        'rating' => $rating
                    ]);
                } else {
                    return redirect()->route('welcome.profileShare', ['profile' => $profile->id, 'reffer' => $s->subscription_code]);
                }
            }
        }

        $reffer = $request->reffer;
        // dd($reffer);
        if ($reffer) {
            //previous destroy
            $cookie = $request->cookie('reffer');
            // dd($cookie);
            if ($cookie) {
                Cookie::forget('reffer');
            }

            //new create
            $name = 'reffer';
            $value = $reffer;
            $min = 60 * 24 * 30 * 2; //for 2 months;
            $newcookie = cookie($name, $value, $min);
            // dd($newcookie);
            $profile = ServiceProfile::where('id', $request->profile)->where('status', true)->first();
            if ($profile->category->business_type == 'shop') {
                $business_type = 'shop';
                $subscription = Subscriber::where('subscription_code', $request->reffer)->first();
                $service_product = ServiceProfileProduct::where('service_profile_id', $profile->id)->where('status', 'approved')->where('active', true)->orderBy('id', 'DESC')->paginate(20);

                $cart = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->sum('quantity');
                $my_orders = ServiceProductOrder::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->get();

                return response()->view('theme.prt.profileDetails', ['profile' => $profile, 'subscription' => $subscription, 'service_product' => $service_product, 'cart' => $cart, 'my_orders' => $my_orders, 'business_type' => $business_type])->withCookie($newcookie);
            } elseif ($profile->category->business_type == 'service') {
                $business_type = 'service';
                $subscription = Subscriber::where('subscription_code', $request->reffer)->first();
                $service_items = Serviceitem::where('service_profile_id', $profile->id)->where('status', 'approved')->where('active', true)->orderBy('id', 'DESC')->paginate(20);

                return response()->view('theme.prt.profileDetails', ['profile' => $profile, 'subscription' => $subscription, 'service_items' => $service_items, 'business_type' => $business_type])->withCookie($newcookie);
            }

            return back();
            // return response()->view('theme.prt.profileDetails', ['profile' => $profile, 'subscription' => $subscription, 'service_product' => $service_product, 'cart' => $cart, 'my_orders' => $my_orders,'business_type'=>$business_type])->withCookie($newcookie);
        }
    }


    public function productShare(Request $request)
    {
        $profile = ServiceProfile::find($request->profile);
        if (!$profile) {
            return back();
        }

        //dd($profile );
        $refferPf = $request->reffer;
        // return($subscription);
        if (Auth::check()) {
            $user = Auth::user();
            $subscriber = Subscriber::where('user_id', $user->id)->first();
            $subscription = Subscriber::where('user_id', Auth::id())->where('category_id', $profile->ws_cat_id)->first();
            if ($subscription) {
                if ($refferPf == $subscription->subscription_code) {
                    $product = ServiceProfileProduct::where('id', $request->product)->first();
                    if (!$product) {
                        return back();
                    }
                    $profile = ServiceProfile::where('id', $request->profile)->where('status', true)->first();
                    // return $product->isMyWishlisted();
                    $related_product = ServiceProfileProduct::where('workstation_id', $product->workstation_id)->where('service_profile_id', $product->service_profile_id)->where('status', 'approved')->where('active', true)->where('id', '!=', $request->product)->get();

                    return view('theme.prt.productDetailsLatest', [
                        // 'subscription' => $subscription,
                        // 'profile' => $profile,
                        // 'visitor' => $visitors,
                        // 'service_product' => $service_product,
                        // 'cart' => $cart,
                        // 'my_orders' => $my_orders
                        'profile' => $profile,
                        'related_product' => $related_product,
                        'subscription' => $subscription,
                        'product' => $product,
                        'subscriber' => $subscriber,

                    ]);
                } else {
                    $product = ServiceProfileProduct::where('id', $request->product)->first();
                    return redirect()->route('welcome.productShare', ['profile' => $profile->id, 'product' => $product, 'reffer' => $subscription->subscription_code]);
                }
            } else {
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
                if ($refferPf == $s->subscription_code) {
                    // $visitors = ServiceProfileVisitor::where('service_profile_id', $profile->id)->first();
                    // $service_product = ServiceProfileProduct::where('service_profile_id', $profile->id)->where('status', 'approved')->where('active', true)->orderBy('id', 'DESC')->paginate(20);
                    // $cart = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->sum('quantity');
                    // $my_orders = ServiceProductOrder::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->get();



                    $product = ServiceProfileProduct::where('id', $request->product)->first();
                    if (!$product) {
                        return back();
                    }
                    $profile = ServiceProfile::where('id', $request->profile)->where('status', true)->first();
                    // return $product->isMyWishlisted();
                    $related_product = ServiceProfileProduct::where('workstation_id', $product->workstation_id)->where('service_profile_id', $product->service_profile_id)->where('status', 'approved')->where('active', true)->where('id', '!=', $request->product)->get();

                    return view('theme.prt.productDetails', [
                        // 'subscription' => $s,
                        // 'profile' => $profile,
                        // 'visitor' => $visitors,
                        // 'service_product' => $service_product,
                        // 'cart' => $cart,
                        // 'my_orders' => $my_orders,

                        'profile' => $profile,
                        'related_product' => $related_product,
                        'subscription' => $subscription,
                        'product' => $product,
                    ]);
                } else {
                    $product = ServiceProfileProduct::where('id', $request->product)->first();
                    return redirect()->route('welcome.productShare', ['profile' => $profile->id, 'product' => $product, 'reffer' => $s->subscription_code]);
                }
            }
        }
        $reffer = $request->reffer;
        // dd($reffer);
        if ($reffer) {
            //previous destroy
            $cookie = $request->cookie('reffer');
            // dd($cookie);
            if ($cookie) {
                Cookie::forget('reffer');
            }

            //new create
            $name = 'reffer';
            $value = $reffer;
            $min = 60 * 24 * 30 * 2; //for 2 months;
            $newcookie = cookie($name, $value, $min);
            // dd($newcookie);
            $subscription = Subscriber::where('subscription_code', $request->reffer)->first();
            if (!$subscription) {
                abort(404);
            }
            $product = ServiceProfileProduct::where('id', $request->product)->first();
            if (!$product) {
                return back();
            }
            $profile = ServiceProfile::where('id', $request->profile)->where('status', true)->first();
            // return $product->isMyWishlisted();
            $related_product = ServiceProfileProduct::where('workstation_id', $product->workstation_id)->where('service_profile_id', $product->service_profile_id)->where('status', 'approved')->where('active', true)->where('id', '!=', $request->product)->get();

            // dd($related_product);

            // return view('subscriber.product.viewServiceProfileProduct', compact('subscription', 'product', 'related_product'));

            return response()->view('theme.prt.productDetailsLatest', ['profile' => $profile, 'related_product' => $related_product, 'subscription' => $subscription, 'product' => $product,])->withCookie($newcookie);
        }
    }
































    public function ModelShopList(Request $request)
    {
        $datas = ValuedCustomer::where('type', 3)->latest()->paginate('30');
        return view('theme.prt.modelshoplist', compact('datas'));
    }

    public function courseShare(Request $request)
    {
        $profile = ServiceProfile::find($request->profile);
        if (!$profile) {
            return back();
        }
        $refferPf = $request->reffer;
        // return($subscription);
        if (Auth::check()) {
            $user = Auth::user();
            $subscriber = Subscriber::where('user_id', $user->id)->first();
            $subscription = Subscriber::where('user_id', Auth::id())->where('category_id', $profile->ws_cat_id)->first();
            if ($subscription) {
                if ($refferPf == $subscription->subscription_code) {
                    $product = Courseitem::where('id', $request->product)->where('status', 'approved')->where('active', true)->first();
                    if (!$product) {
                        return back();
                    }
                    $profile = ServiceProfile::where('id', $request->profile)->where('status', true)->first();
                    // return $product->isMyWishlisted();
                    $related_product = Courseitem::where('workstation_id', $product->workstation_id)->where('service_profile_id', $product->service_profile_id)->where('status', 'approved')->where('active', true)->where('id', '!=', $request->product)->get();

                    return view('theme.prt.courseDetails', [
                        // 'subscription' => $subscription,
                        // 'profile' => $profile,
                        // 'visitor' => $visitors,
                        // 'service_product' => $service_product,
                        // 'cart' => $cart,
                        // 'my_orders' => $my_orders
                        'profile' => $profile,
                        'related_product' => $related_product,
                        'subscription' => $subscription,
                        'product' => $product,
                        'subscriber' => $subscriber,

                    ]);
                } else {
                    $product = Courseitem::where('id', $request->product)->where('status', 'approved')->where('active', true)->first();
                    return redirect()->route('welcome.courseShare', ['profile' => $profile->id, 'product' => $product, 'reffer' => $subscription->subscription_code]);
                }
            } else {
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
                if ($refferPf == $s->subscription_code) {
                    // $visitors = ServiceProfileVisitor::where('service_profile_id', $profile->id)->first();
                    // $service_product = ServiceProfileProduct::where('service_profile_id', $profile->id)->where('status', 'approved')->where('active', true)->orderBy('id', 'DESC')->paginate(20);
                    // $cart = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->sum('quantity');
                    // $my_orders = ServiceProductOrder::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->get();



                    $product = Courseitem::where('id', $request->product)->where('status', 'approved')->where('active', true)->first();
                    if (!$product) {
                        return back();
                    }
                    $profile = ServiceProfile::where('id', $request->profile)->where('status', true)->first();
                    // return $product->isMyWishlisted();
                    $related_product = Courseitem::where('workstation_id', $product->workstation_id)->where('service_profile_id', $product->service_profile_id)->where('status', 'approved')->where('active', true)->where('id', '!=', $request->product)->get();

                    return view('theme.prt.courseDetails', [
                        // 'subscription' => $s,
                        // 'profile' => $profile,
                        // 'visitor' => $visitors,
                        // 'service_product' => $service_product,
                        // 'cart' => $cart,
                        // 'my_orders' => $my_orders,

                        'profile' => $profile,
                        'related_product' => $related_product,
                        'subscription' => $subscription,
                        'product' => $product,
                    ]);
                } else {
                    $product = Courseitem::where('id', $request->product)->where('status', 'approved')->where('active', true)->first();
                    return redirect()->route('welcome.courseShare', ['profile' => $profile->id, 'product' => $product, 'reffer' => $s->subscription_code]);
                }
            }
        }
        $reffer = $request->reffer;
        // dd($reffer);
        if ($reffer) {
            //previous destroy
            $cookie = $request->cookie('reffer');
            // dd($cookie);
            if ($cookie) {
                Cookie::forget('reffer');
            }

            //new create
            $name = 'reffer';
            $value = $reffer;
            $min = 60 * 24 * 30 * 2; //for 2 months;
            $newcookie = cookie($name, $value, $min);
            // dd($newcookie);
            $subscription = Subscriber::where('subscription_code', $request->reffer)->first();
            if (!$subscription) {
                abort(404);
            }
            $product = ServiceProfileProduct::where('id', $request->product)->where('status', 'approved')->where('active', true)->first();
            if (!$product) {
                return back();
            }
            $profile = ServiceProfile::where('id', $request->profile)->where('status', true)->first();
            // return $product->isMyWishlisted();
            $related_product = ServiceProfileProduct::where('workstation_id', $product->workstation_id)->where('service_profile_id', $product->service_profile_id)->where('status', 'approved')->where('active', true)->where('id', '!=', $request->product)->get();

            // dd($related_product);

            // return view('subscriber.product.viewServiceProfileProduct', compact('subscription', 'product', 'related_product'));

            return response()->view('theme.prt.productDetails', ['profile' => $profile, 'related_product' => $related_product, 'subscription' => $subscription, 'product' => $product,])->withCookie($newcookie);
        }
    }


    ///Service item Share

    public function serviceItemShare(Request $request)
    {
        $profile = ServiceProfile::find($request->profile);
        if (!$profile) {
            return back();
        }
        $refferPf = $request->reffer;
        // return($subscription);
        if (Auth::check()) {
            $subscription = Subscriber::where('user_id', Auth::id())->where('category_id', $profile->ws_cat_id)->first();
            if ($subscription) {
                if ($refferPf == $subscription->subscription_code) {
                    $service_item = Serviceitem::where('id', $request->item)->where('status', 'approved')->where('active', true)->first();
                    if (!$service_item) {
                        return back();
                    }
                    $profile = ServiceProfile::where('id', $request->profile)->where('status', true)->first();
                    // return $product->isMyWishlisted();
                    $related_service_items = Serviceitem::where('workstation_id', $service_item->workstation_id)->where('service_profile_id', $service_item->service_profile_id)->where('status', 'approved')->where('active', true)->where('id', '!=', $request->product)->get();

                    // $negotiations= Negotiation::where('workstation_id', $service_item->workstation_id)->where('service_profile_id', $service_item->service_profile_id)->where('status', 'approved')->where('active', true);
                    return view('theme.prt.serviceItemDetailsForSubscriber', [
                        // 'subscription' => $subscription,
                        // 'profile' => $profile,
                        // 'visitor' => $visitors,
                        // 'service_product' => $service_product,
                        // 'cart' => $cart,
                        // 'my_orders' => $my_orders
                        'profile' => $profile,
                        'related_service_items' => $related_service_items,
                        'subscription' => $subscription,
                        'service_item' => $service_item,

                    ]);
                } else {
                    $service_item = Serviceitem::where('id', $request->item)->where('status', 'approved')->where('active', true)->first();
                    // return $service_item;
                    return redirect()->route('welcome.serviceItemShare', ['profile' => $profile->id, 'item' => $service_item->id, 'reffer' => $subscription->subscription_code]);
                }
            } else {
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
                if ($refferPf == $s->subscription_code) {
                    $service_item = Serviceitem::where('id', $request->item)->where('status', 'approved')->where('active', true)->first();
                    if (!$service_item) {
                        return back();
                    }
                    $profile = ServiceProfile::where('id', $request->profile)->where('status', true)->first();
                    // return $product->isMyWishlisted();
                    $related_service_items = Serviceitem::where('workstation_id', $service_item->workstation_id)->where('service_profile_id', $service_item->service_profile_id)->where('status', 'approved')->where('active', true)->where('id', '!=', $request->product)->get();

                    return view('theme.prt.serviceitemDetails', [
                        // 'subscription' => $subscription,
                        // 'profile' => $profile,
                        // 'visitor' => $visitors,
                        // 'service_product' => $service_product,
                        // 'cart' => $cart,
                        // 'my_orders' => $my_orders
                        'profile' => $profile,
                        'related_service_items' => $related_service_items,
                        'subscription' => $subscription,
                        'service_item' => $service_item,
                    ]);
                } else {
                    $service_item = Serviceitem::where('id', $request->product)->where('status', 'approved')->where('active', true)->first();
                    return redirect()->route('welcome.productShare', ['profile' => $profile->id, 'item' => $service_item->id, 'reffer' => $s->subscription_code]);
                }
            }
        }
        $reffer = $request->reffer;
        // dd($reffer);
        if ($reffer) {
            //previous destroy
            $cookie = $request->cookie('reffer');
            // dd($cookie);
            if ($cookie) {
                Cookie::forget('reffer');
            }

            //new create
            $name = 'reffer';
            $value = $reffer;
            $min = 60 * 24 * 30 * 2; //for 2 months;
            $newcookie = cookie($name, $value, $min);
            // dd($newcookie);
            $subscription = Subscriber::where('subscription_code', $request->reffer)->first();
            if (!$subscription) {
                abort(404);
            }
            $service_item = Serviceitem::where('id', $request->item)->where('status', 'approved')->where('active', true)->first();
            if (!$service_item) {
                return back();
            }
            $profile = ServiceProfile::where('id', $request->profile)->where('status', true)->first();
            // return $product->isMyWishlisted();
            $related_product = ServiceProfileProduct::where('workstation_id', $service_item->workstation_id)->where('service_profile_id', $service_item->service_profile_id)->where('status', 'approved')->where('active', true)->where('id', '!=', $request->product)->get();

            return response()->view('theme.prt.serviceitemDetails', ['profile' => $profile, 'related_product' => $related_product, 'subscription' => $subscription, 'service_item' => $service_item,])->withCookie($newcookie);
        }
    }
    public function myPF()
    {
        $user = Auth::user();
        $mySub = Subscriber::where('user_id', $user->id)->where('referral_id', '!=', null)->pluck('id');
        return $mySub;
    }
    public function postNeed(Request $request)
    {
        $tags = BlogTag::latest();
        $workstation = WorkStation::all();
        return view('need.index', compact('workstation'));
    }
    public function searchCategoryAjax(Request $request)
    {
        $service_station = WorkStation::where('id', $request->id)->first();
        return response()->json([
            'categories' => $service_station->categories
        ]);
    }

    public function storeNewNeedFromGuest(Request $request)
    {

        if (!Auth::check()) {
            $validation = Validator::make(
                $request->all(),
                [
                    'name' => ['required', 'string', 'max:255', 'min:3'],
                    'email' => ['required', 'string', 'email', 'unique:users', 'max:255'],
                    'mobile' => ['required', 'string'],
                    'password' => ['required', 'string', 'min:6', 'confirmed'],
                    'active' => ['nullable'],
                    'title' => ['required'],
                    'description' => ['required'],
                    'workstation' => ['required'],
                    'category' => ['required'],

                ]
            );

            if ($validation->fails()) {

                return back()
                    ->withInput()
                    ->withErrors($validation);
            }


            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = bdMobileWithCode($request->mobile);
            $user->password_temp = $request->password;
            $user->password = $request->password ? Hash::make($request->password) : $user->password;
            $user->active = $request->active ? true : false;
            $user->addedby_id = Auth::id() ?? null;
            $user->save();

            $category = Category::find($request->category);
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
            $scode = $wsId . $num . $meMob . $user->subscriptionDistrict()->id;

            $s = new Subscriber;
            $s->ws_position = $ws_pos;
            $s->name = $user->name;
            $s->email = $user->email;
            $s->mobile = $user->mobile;
            $s->category_id = $category->id;
            $s->district_id = $user->subscriptionDistrict()->id;
            $s->user_id = $user->id;
            $s->referral_id = $reffer_id;
            $s->work_station_id = $workstationId;
            $s->subscription_code = $scode;
            $s->addedby_id = Auth::id();
            $s->free_account = 1;
            $s->save();

            $need = new Need;
            $need->title = $request->title;
            $need->description = $request->description;
            $need->closed_date = $request->closed_date;
            $need->user_id = $user->id;
            $need->ws_cat_id = $s->category_id;
            $need->workstation_id = $request->workstation;
            $need->status = 'pending';
            $need->save();
            return redirect()->back()->with('success', 'Your Need is Pending. Please Wait for Approved or Contact with Admin');
        }


        $me = Auth::user();
        $validation = Validator::make(
            $request->all(),
            [
                'title' => ['required'],
                'description' => ['required'],
                'workstation' => ['required'],
                'category' => ['required'],
            ]
        );

        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $me = Auth::user();
        $haveSubscription = Subscriber::where('category_id', $request->category)
            ->where('user_id', $me->id)
            ->first();
        if (!$haveSubscription) {


            $category = Category::find($request->category);
            $workstation = Workstation::find($category->work_station_id);
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
        }
        $need = new Need;
        $need->title = $request->title;
        $need->description = $request->description;
        $need->closed_date = $request->closed_date;
        $need->user_id = $me->id;
        $need->ws_cat_id = $request->category;
        $need->workstation_id = $request->workstation;
        $need->status = 'pending';
        $need->save();

        return redirect()->back()->with('success', 'Your Need is Pending. Please Wait for Approved or Contact with Admin. Login Now with your phone number and password');
    }
    public function guestOpinions()
    {
        $opinions = Opinion::where('status', 'lived')->orderBy('id', 'DESC')->has('user')->paginate(100);
        // $opinions = Opinion::all();
        $populerOpenions = Opinion::where('status', 'lived')->orderBy('visit_count', 'DESC')->has('user')->get();

        return view('opinions.guestOpinions', compact('opinions', 'populerOpenions'));
    }
    public function addNegotiation(Request $request)
    {
        $item = Serviceitem::find($request->item);
        if (!$item) {
            abort(404);
        }
        if ($request->type == 'customer') {
            $itemNG = new Negotiation;
            $itemNG->user_id = Auth::id();
            $itemNG->item_id = $item->id;
            $itemNG->owner_id = $request->owner_id;
            $itemNG->service_profile_id = $item->service_profile_id;
            $itemNG->category_id = $item->category_id;
            $itemNG->workstation_id = $item->workstation_id;
            $itemNG->subscriber_id = $item->subscriber_id;
            $itemNG->price = $request->price;
            $itemNG->approved = $request->approved ?? 0.00;
            $itemNG->addedby_id = Auth::id();
            $itemNG->save();
            return redirect()->back()->with('success', 'Thanks For the Price');
        }
    }
    public function addNegotiationByOwner(Request $request)
    {
        $si = Serviceitem::find($request->item);
        if (!$si) {
            abort(404);
        }
        $itemNG = new Negotiation;
        $itemNG->user_id = $request->customer;
        $itemNG->item_id =  $si->id;
        $itemNG->owner_id = Auth::id();
        $itemNG->service_profile_id = $si->service_profile_id;
        $itemNG->category_id = $si->category_id;
        $itemNG->workstation_id = $si->workstation_id;
        $itemNG->subscriber_id = $si->subscriber_id;
        $itemNG->price = $request->price;
        $itemNG->approved = $request->approved ?? 0.00;
        $itemNG->addedby_id = Auth::id();
        $itemNG->save();
        return redirect()->back()->with('success', 'Thanks For the Price');
    }
    public function updateNegotiationByOwner(Request $request)
    {
        $ng = Negotiation::find($request->item);
        $ng->approved = true;
        $ng->save();
        return redirect()->back()->with('success', 'Negotiation Approved Succesfully');
    }
    public function serviceItemPayment(Request $request)
    {
        // return $request->item;
        $service_item = Serviceitem::find($request->item);
        // return $service_item->id;
        $paymentAmount = $service_item->approvedNegotiationByCustomer()? $service_item->approvedNegotiationByCustomer()->price : $service_item->price;
        // if (!$paymentAmount) {
        //     $paymentAmount = $service_item->price;
        // }
        $me = Auth::user();
        if ($me->balance < $paymentAmount) {
            return redirect()->back()->with('warning', 'insufficient balance!!. please reacharge and try again');
        }
        if (!$service_item) {
            abort(404);
        }
        $oldBalance = $me->balance;
        $me->decrement('balance', $paymentAmount);
        $bt = new BalanceTransaction;
        $bt->from = 'user';
        $bt->to = 'admin';
        $bt->purpose = 'order';
        $bt->subscriber_id = $service_item->subscriber_id;
        $bt->user_id = $me->id;
        $bt->previous_balance = $oldBalance;  // user old balance
        $bt->moved_balance = $paymentAmount; // job cost
        $bt->new_balance = $me->balance; // user new balance
        $bt->type = 'user';
        $bt->details = "{$paymentAmount} taka was deducted from your balance for Order service item ({$service_item->title} ($service_item->id)). Thanks for using softcode";
        $bt->type_id = $me->id;
        $bt->addedby_id = Auth::id();
        $bt->save();

        $servicePayment = new ServicePayment;
        $servicePayment->user_id = $me->id;
        $servicePayment->item_id = $service_item->id;
        $servicePayment->service_profile_id = $service_item->service_profile_id;
        $servicePayment->category_id = $service_item->category_id;
        $servicePayment->workstation_id = $service_item->workstation_id;
        $servicePayment->subscriber_id = $service_item->subscriber_id;
        $servicePayment->negotiation_id = $service_item->approvedNegotiationByCustomer() ? $service_item->approvedNegotiationByCustomer()->id : null;
        $servicePayment->order_confirmed_balance = $paymentAmount;
        $servicePayment->final_price = $paymentAmount;
        $servicePayment->order_status = 'pending';
        $servicePayment->payment_status = 'advanced';
        $servicePayment->pending_at = Carbon::now();
        $servicePayment->addedby_id = Auth::id();
        $servicePayment->save();
        return redirect()->back()->with('success', 'Payment successfully paid');
    }
    public function orderStatusUpdate(Request $request)
    {
        $request->validate([
            'order_status' => 'required'
        ]);

        $payment = ServicePayment::find($request->payment);

        $serviceItemOwner = $payment->serviceitem->user;
        //   return $serviceItemOwner;
        $payment->order_status = $request->order_status;
        $payment[$request->order_status . "_at"] = Carbon::now();
        $payment->editedby_id = Auth::id();
        $payment->save();

        if ($payment->order_status == 'canceled') {
           $user= $payment->user;
           $userOldbalance= $user->balance;
           $paymentAmount= $payment->order_confirmed_balance;
           $user->increment('balance', $payment->order_confirmed_balance);
           $payment->order_confirmed_balance = 0.00;
           $payment->payment_status = 'unpaid';
           $payment->save();
           $bt = new BalanceTransaction;
            $bt->from = 'admin';
            $bt->to = 'user';
            $bt->purpose = 'order';
            $bt->subscriber_id = $payment->subscriber_id;
            $bt->user_id = $serviceItemOwner->id;
            $bt->previous_balance = $userOldbalance;  // user old balance
            $bt->moved_balance = $paymentAmount; // job cost
            $bt->new_balance = $serviceItemOwner->balance; // user new balance
            $bt->type = 'user';
            $bt->details = "{$paymentAmount} taka was returned . Thanks for using softcode";
            $bt->type_id = $payment->id;
            $bt->addedby_id = Auth::id();
            $bt->save();
        }
        if ($payment->order_status == 'satisfied') {
            $ItemPrice = $payment->order_confirmed_balance;
            $payment->order_confirmed_balance = 0.00;
            $payment->payment_status = 'paid';
            $payment->save();

            $category= Category::find($payment->category_id);
            $service_product_commission = $category->service_product_commission;
            $old_product_commission_balance = $category->old_product_commission_balance;
            $commisson =  ($ItemPrice  * $service_product_commission) /100;
            $payableAmount= $ItemPrice - $commisson;
            ///Commission
            $payment->category->increment('product_commission_balance',$commisson);
            $bt = new BalanceTransaction;
            $bt->from = 'user';
            $bt->to = 'admin';
            $bt->purpose = 'order';
            $bt->subscriber_id = $payment->subscriber_id;
            $bt->user_id = $serviceItemOwner->id;
            $bt->previous_balance = $old_product_commission_balance?? 0.00;  // user old balance
            $bt->moved_balance = $commisson; // job cost
            $bt->new_balance = $serviceItemOwner->balance + $bt->moved_balance; // user new balance
            $bt->type = 'user';
            $bt->details = "{$commisson} taka was added for Service item sale . Order id ({$payment->id}) .";
            $bt->type_id = $payment->id;
            $bt->addedby_id = Auth::id();
            $bt->save();


            $oldBalance = $serviceItemOwner->balance;
            $serviceItemOwner->increment('balance', $payableAmount);

            $bt = new BalanceTransaction;
            $bt->from = 'user';
            $bt->to = 'user';
            $bt->purpose = 'order';
            $bt->subscriber_id = $payment->subscriber_id;
            $bt->user_id = $serviceItemOwner->id;
            $bt->previous_balance = $oldBalance;  // user old balance
            $bt->moved_balance = $payableAmount; // job cost
            $bt->new_balance = $serviceItemOwner->balance; // user new balance
            $bt->type = 'user';
            $bt->details = "{$payableAmount} taka was added for complete Service Item order. Thanks for using softcode";
            $bt->type_id = $payment->id;
            $bt->addedby_id = Auth::id();
            $bt->save();
        }

        if ($payment->order_status == 'un_satisfied') {
            return redirect()->back()->with('warning','We received your request. admin will be review you request and get back to you');

            // $paymentAmount = $payment->order_confirmed_balance;
            // $payment->order_confirmed_balance = 0.00;
            // $payment->save();
            // $bt = new BalanceTransaction;
            // $bt->from = 'user';
            // $bt->to = 'user';
            // $bt->purpose = 'order';
            // $bt->subscriber_id = $payment->subscriber_id;
            // $bt->user_id = $serviceItemOwner->id;
            // $bt->previous_balance = $userOldbalance;  // user old balance
            // $bt->moved_balance = $paymentAmount; // job cost
            // $bt->new_balance = $serviceItemOwner->balance; // user new balance
            // $bt->type = 'user';
            // $bt->details = "{$paymentAmount} taka was returned . Thanks for using softcode";
            // $bt->type_id = $payment->id;
            // $bt->addedby_id = Auth::id();
            // $bt->save();

        }

        return redirect()->back()->with('success', 'order Status ' . $payment->order_status . ' sucsessfull');
    }


}
