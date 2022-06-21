<?php

namespace App\Http\Controllers\Subscirber\ServiceProfileProduct;

use Auth;
use DB;
use Validator;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Media;
use App\Models\ServiceProfileInfo;
use App\Models\ServiceProfile;
use App\Models\OrderItem;
use App\Models\OrderWork;
use App\Models\Subscriber;
use App\Models\WorkStation;
use App\Models\JobWorkLink;
use App\Models\JobCategory;
use App\Models\ServiceProfileInfoValue;
use Illuminate\Http\Request;
use App\Models\OrderPayment;
use App\Models\AdminBalance;
use App\Models\Honorarium;
use App\Models\FreelancerJob;
use App\Models\JobSubcategory;
use App\Models\FreelanceJobWork;
use App\Models\BalanceTransaction;
use App\Models\SubscriberHonorarium;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ServiceProductCart;
use App\Models\ServiceProductImage;
use App\Models\ServiceProductOrder;
use App\Models\ServiceProductOrderItem;
use App\Models\ServiceProfileProduct;
use App\Models\ServiceProfileVisitor;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use App\Models\SendSms;

use App\Models\OrderNotifications;

use App\Models\ServiceProductVariation;

use App\Models\ServiceProfileWorker;

class ServiceProductCartController extends Controller
{
  public function addToCartProduct(Request $request)
  {
    //dd($request->subscription);
    // $service_profile_id = ServiceProfile::where('user_id', Auth::id())->first();


    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$subscription) {
      return back();
    }
    $profile = ServiceProfile::find($request->profile);
    if (!$profile) {
        return back();
    }
    $subscriber = Subscriber::where('user_id', Auth::id())->where('category_id', $profile->ws_cat_id)->first();
    //dd($subscription->subscription_code);

    if (!$subscriber) {
      $user = Auth::user();
      $workstation = Workstation::find($profile->workstation_id);
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

      $subscriber = new Subscriber;
      $subscriber->ws_position = $ws_pos;
      $subscriber->name = $user->name;
      $subscriber->email = $user->email;
      $subscriber->mobile = $user->mobile;
      $subscriber->category_id = $profile->ws_cat_id;
      $subscriber->district_id = $user->subscriptionDistrict()->id;
      $subscriber->user_id = $user->id;
      $subscriber->referral_id = $reffer_id;

      $subscriber->work_station_id = $workstationId;
      $subscriber->subscription_code = $code;
      $subscriber->addedby_id = Auth::id();
      $subscriber->free_account = 1;
      $subscriber->save();
  }



    if (!Auth::check()) {
     return redirect()->back()->with('warning','Login First');
    }
    $product = ServiceProfileProduct::where('id', $request->product)->first();

    //$subscriber = Subscriber::where('subscription_code', $request->subscription)->where('user_id', Auth::id())->first();

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
   
   $status=$request->buynow;
    
   if($status=='b'){
     return redirect()->route('subscriber.checkoutServiceProducts', ['profile' =>  $product->service_profile_id, 'subscription' => $subscriber->subscription_code])->with('success', 'Product Add To Cart');
   }elseif($status=='c'){
     //return redirect()->back()->with('success', 'Product Addet To Cart');
     return redirect()->route('subscriber.allCartProducts', ['profile' =>  $product->service_profile_id, 'subscription' => $subscriber->subscription_code])->with('success', 'Product Add To Cart');
   }else{
    return redirect()->route('subscriber.allCartProducts', ['profile' =>  $product->service_profile_id, 'subscription' => $subscriber->subscription_code])->with('success', 'Product Add To Cart');
   }
   
  }
  
  public function allCartProducts(Request $request)
  {
    $allCartProducts = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $request->profile)->orderBy('id', 'DESC')->paginate(20);
    $product_count = $allCartProducts->count();
    if ($product_count < 1) {
      return redirect()->back()->with('warning', 'Sorry!!. you don\'t have any product in cart. Please add some product in your cart');
    }
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$subscription) {
      abort(404);
    }
    $profile = ServiceProfile::where('id', $request->profile)->first();

    // dd($profile->ws_cat_id);
    return view('subscriber.product.allCartProductsOfSubscriber', compact('subscription', 'allCartProducts', 'profile'));
  }
  public function updateCartProduct(Request $request)
  {
    try {
      $spc = ServiceProductCart::find($request->cart);
      if($request->variation==1){
        $vari=ServiceProductVariation::where('proid',$spc->product_id)->where('colid',$request->color)->where('sizid',$request->color)->first();

        //dd($vari);
        if($vari->stkqty < $request->quantity){
          return redirect()->back()->with('error', 'Product quanity are not available');
        }
      }

      if($spc->product->stock < $request->quantity){
        return redirect()->back()->with('error', 'Product quanity are not available');
      }
      $spc->color = $request->color;
      $spc->size = $request->size;
      $spc->quantity = $request->quantity;
      $spc->save();
      return redirect()->back()->with('success', 'Cart Updated Successfully');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Something Went To Worng');
    }
  }
  public function deleteCartProduct(Request $request)
  {
    
    ServiceProductCart::find($request->cart)->delete();
    $isServiceProductExistInCart = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $request->profile)->count();
    if ($isServiceProductExistInCart < 1) {
      return redirect()->route('subscriber.cartsServiceProfileProduct')->with('success', 'Product Removed From Cart');
    }
    return redirect()->back()->with('success', 'Product Removed From Cart');
  }

  public function checkoutServiceProducts(Request $request)
  {
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$subscription) {
      abort(404);
    }
    $allCartProducts = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $request->profile)->get();
    $profile = ServiceProfile::where('id', $request->profile)->first();
    $total_amount = 0;
    foreach ($allCartProducts as  $item) {
      $total_amount += $item->quantity * $item->product->sale_price;
    }
    $user = Auth::user();
    return view('subscriber.product.checkoutServiceproduct', compact('subscription', 'allCartProducts', 'total_amount', 'profile', 'user'));
  }

  public function serviceProductsOrderSubmit(Request $request)
  {

    $request->validate([
      'name' => 'required',
      //'email' => 'required',
      'phone' => 'required',
      'delivery_address' => 'required',
      'paymod' => 'required'
    ]);

    $user = Auth::user();
    if ($user->purchase_lock==1) {
        return back()->with('error', 'Sorry, You can not buy product.Please contact with Administrator.');
    }

    User::where('id', Auth::id())->update([
      'address' => $request->delivery_address,
      'email' => $request->email
    ]);

   // dd($user = Auth::user());

   $transaction_id=now()->format('Ymds');
   $profile = ServiceProfile::where('id', $request->profile)->first();
   //dd($profile);
    if($request->paymod=='bysoft'){
      $serviceProductOrder = new ServiceProductOrder;
      $serviceProductOrder->name = $request->name;
      $serviceProductOrder->email = $request->email;
      $serviceProductOrder->phone = $request->phone;
      $serviceProductOrder->delivery_address = $request->delivery_address;
      $serviceProductOrder->user_id = Auth::id();
      $serviceProductOrder->service_profile_id = $profile->id;
      $serviceProductOrder->ws_cat_id = $profile->ws_cat_id;
      $serviceProductOrder->workstation_id = $profile->workstation_id;
      $serviceProductOrder->transection_id =  $transaction_id;
      $serviceProductOrder->payment_status = 'advanced';
      $serviceProductOrder->addedby_id = Auth::id();
  
      $allCartProducts = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $request->profile)->get();
  

      foreach ($allCartProducts as  $product) {
      
        $pro=ServiceProfileProduct::where('id', $product->product_id)->first();
        if($pro->stock < $product->quantity){
          return redirect()->back()->with('warning', 'Product quantity are not available');
        }
      }

      foreach ($allCartProducts as  $pro) {
      
        $p=ServiceProfileProduct::where('id', $pro->product_id)->first();
        $p->stock=$p->stock - $pro->quantity;
        $p->save();

        //dd($pro->color);
        if($pro->color != null){
          $vari=ServiceProductVariation::where('proid', $pro->product_id)->where('colid', $pro->color)->where('sizid', $pro->size)->first();
          $vari->stkqty=$vari->stkqty - $pro->quantity;
          $vari->save();
        }
       
      }

   
      $order_confirmed_price = 0;
      $total_quantity = 0;
      $total_sale_price = 0;
      $total_purchase_price = 0;
  
      foreach ($allCartProducts as  $item) {
        $total_quantity += $item->quantity;
        $total_sale_price += $item->quantity * $item->product->sale_price;
        $total_purchase_price += $item->quantity * $item->product->purchase_price;
        $order_confirmed_price += $item->quantity * $item->product->sale_price;
      }
      $serviceProductOrder->total_quantity = $total_quantity;
      $serviceProductOrder->total_sale_price = $total_sale_price;
      $serviceProductOrder->total_purchase_price = $total_purchase_price;
      $serviceProductOrder->order_confirmed_price = $order_confirmed_price;
      $serviceProductOrder->order_status = 'pending';
      $serviceProductOrder->pending_at = now();
      $me = Auth::user();
  
      if ($order_confirmed_price > $me->balance) {
        return redirect()->back()->with('warning', 'Insufficient balance');
      }
  
      $serviceProductOrder->save();
      $order_user = $serviceProductOrder->user;
      $bt = new BalanceTransaction;
      $bt->user_id = $order_user->id;
      $bt->subscriber_id =  $serviceProductOrder->serviceProfile->subscriber_id;
      $bt->from = "order_user"; // 
      $bt->to = "order_confirmed_balance"; //saller User 
      $bt->purpose = 'order_confirmed_balance';
      $bt->previous_balance = $serviceProductOrder->user->balance;
      $bt->moved_balance = $serviceProductOrder->order_confirmed_price;
      $bt->new_balance = $bt->previous_balance - $bt->moved_balance;
      $bt->type = 'profile_order';
      $bt->type_id = $serviceProductOrder->id;
      $bt->details = 'Balance (' . $bt->moved_balance . ') diducted from your balance For product Order';
      $bt->save();
      $order_user->decrement("balance", $bt->moved_balance);
      foreach ($allCartProducts as $item) {
        $serviceProductOrderItem = new ServiceProductOrderItem;
        $serviceProductOrderItem->user_id = Auth::id();
        $serviceProductOrderItem->service_product_order_id = $serviceProductOrder->id;
        $serviceProductOrderItem->service_profile_id = $profile->id;
        $serviceProductOrderItem->ws_cat_id = $profile->ws_cat_id;
        $serviceProductOrderItem->workstation_id = $profile->workstation_id;
        $serviceProductOrderItem->service_product_id = $item->product->id;
        $serviceProductOrderItem->quantity = $item->quantity;
        $serviceProductOrderItem->color = $item->color;
        $serviceProductOrderItem->size = $item->size;
        $serviceProductOrderItem->purchase_price = $item->product->purchase_price;
        $serviceProductOrderItem->sale_price = $item->product->sale_price;
        $serviceProductOrderItem->total_purchase_price = $item->product->purchase_price * $item->quantity;
        $serviceProductOrderItem->total_sale_price = $item->product->sale_price *  $item->quantity;
        $serviceProductOrderItem->order_status = "pending";
        $serviceProductOrderItem->delivery_date = $item->product->max_delivery_days? Carbon::now()->addDay($item->product->max_delivery_days) : null;
        $serviceProductOrderItem->pending_at = now();
        $serviceProductOrderItem->save();
        $item->delete();
      }


    }else{

      $serviceProductOrder = new ServiceProductOrder;
      $serviceProductOrder->name = $request->name;
      $serviceProductOrder->email = $request->email;
      $serviceProductOrder->phone = $request->phone;
      $serviceProductOrder->delivery_address = $request->delivery_address;
      $serviceProductOrder->user_id = Auth::id();
      $serviceProductOrder->service_profile_id = $profile->id;
      $serviceProductOrder->ws_cat_id = $profile->ws_cat_id;
      $serviceProductOrder->workstation_id = $profile->workstation_id;
      $serviceProductOrder->transection_id = $transaction_id;
      $serviceProductOrder->payment_status = 'cashon';
      $serviceProductOrder->addedby_id = Auth::id();
  
      $allCartProducts = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $request->profile)->get();
      

      foreach ($allCartProducts as  $product) {
      
        $pro=ServiceProfileProduct::where('id', $product->product_id)->first();
        if($pro->stock < $product->quantity){
          return redirect()->back()->with('warning', 'Product quantity are not available');
        }
      }

      foreach ($allCartProducts as  $pro) {
      
        $p=ServiceProfileProduct::where('id', $pro->product_id)->first();
        $p->stock=$p->stock - $pro->quantity;
        $p->save();

        //dd($pro->color);
        if($pro->color != null){
          $vari=ServiceProductVariation::where('proid', $pro->product_id)->where('colid', $pro->color)->where('sizid', $pro->size)->first();
          $vari->stkqty=$vari->stkqty - $pro->quantity;
          $vari->save();
        }
       
      }
     //dd($vari);
      $order_confirmed_price = 0;
      $total_quantity = 0;
      $total_sale_price = 0;
      $total_purchase_price = 0;
  
      foreach ($allCartProducts as  $item) {
        $total_quantity += $item->quantity;
        $total_sale_price += $item->quantity * $item->product->sale_price;
        $total_purchase_price += $item->quantity * $item->product->purchase_price;
        $order_confirmed_price += $item->quantity * $item->product->sale_price;
      }
      $serviceProductOrder->total_quantity = $total_quantity;
      $serviceProductOrder->total_sale_price = $total_sale_price;
      $serviceProductOrder->total_purchase_price = $total_purchase_price;
      $serviceProductOrder->order_confirmed_price = $order_confirmed_price;
      $serviceProductOrder->order_status = 'pending';
      $serviceProductOrder->pending_at = now();
      $me = Auth::user();
  
      $serviceProductOrder->save();
  
      foreach ($allCartProducts as $item) {
        $serviceProductOrderItem = new ServiceProductOrderItem;
        $serviceProductOrderItem->user_id = Auth::id();
        $serviceProductOrderItem->service_product_order_id = $serviceProductOrder->id;
        $serviceProductOrderItem->service_profile_id = $profile->id;
        $serviceProductOrderItem->ws_cat_id = $profile->ws_cat_id;
        $serviceProductOrderItem->workstation_id = $profile->workstation_id;
        $serviceProductOrderItem->service_product_id = $item->product->id;
        $serviceProductOrderItem->quantity = $item->quantity;
        $serviceProductOrderItem->color = $item->color;
        $serviceProductOrderItem->size = $item->size;
        $serviceProductOrderItem->purchase_price = $item->product->purchase_price;
        $serviceProductOrderItem->sale_price = $item->product->sale_price;
        $serviceProductOrderItem->total_purchase_price = $item->product->purchase_price * $item->quantity;
        $serviceProductOrderItem->total_sale_price = $item->product->sale_price *  $item->quantity;
        $serviceProductOrderItem->order_status = "pending";
        $serviceProductOrderItem->delivery_date = $item->product->max_delivery_days? Carbon::now()->addDay($item->product->max_delivery_days) : null;
        $serviceProductOrderItem->pending_at = now();
        $serviceProductOrderItem->save();
        $item->delete();
      }

    }

    $number=$me->mobile;
    $messages= "Dear {$me->name}, Your Order Successfully Complete. Your Order ID: {$transaction_id}";

    //$me->sendSingleMessage($number,$messages);
    $SendSms=new SendSms;
    try {
        // Send a message using the primary device.
        $msg = $SendSms->sendSingleMessage($number,$messages);

    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if($request->paymod=='bysoft'){
      $paystatus='Online';
    }else{
      $paystatus="Cash On";
    }
        


    $notification1=new OrderNotifications;
    $notification1->type='order';
    $notification1->title='Order Conformation';
    $notification1->messages= $messages;
    $notification1->details="Dear {$me->name}, Your order shop name {$profile->name}. Your order total:{$order_confirmed_price}.Order status pending.Payment status {$paystatus}";
    $notification1->user_id=$me->id;
    $notification1->status='1';
    $notification1->date=now();
    $notification1->link=$serviceProductOrder->id;
    $notification1->save();

    $notification2=new OrderNotifications;
    $notification2->type='order';
    $notification2->title='Get Order';
    $notification2->messages= "Dear {$profile->name}, You get a order. Your Order ID: {$transaction_id}";
    $notification2->details="Dear {$profile->name}, Your order user name {$me->name}. Order total:{$order_confirmed_price}.Order status pending.Payment status {$paystatus}";
    $notification2->user_id=$profile->user_id;
    $notification2->status='1';
    $notification2->date=now();
    $notification2->link=$serviceProductOrder->id;
    $notification2->save();


   
    return redirect()->route('user.myOrders')->with('success', 'Order Successfully Complete');
  }


  public function allordersOfServiceProducts(Request $request)
  {
    $request = request();
    $request->session()->forget(['lsbm', 'lsbsm']);
    $request->session()->put(['lsbm' => 'job', 'lsbsm' => 'allordersOfServiceProducts']);

    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$subscription) {
      abort(404);
    }

    $worker= ServiceProfileWorker::where('profile_id', $request->profile)->where('worker_user_id', Auth::id())->first();

      if($worker){
          $profile = ServiceProfile::where('id', $request->profile)->first();

      }else{
          $profile = ServiceProfile::where('id', $request->profile)->where('user_id', Auth::id())->first();

      }
    if (!$profile) {
      return redirect()->back()->with('warning', 'You are not able to see another Subscriber Order');
    }
    $allOrders = ServiceProductOrder::where('service_profile_id', $profile->id)->get();
    // dd($profile->workstation->title);
    return view('subscriber.product.serviceProductOrders', compact('subscription', 'profile', 'allOrders'));
  }
  public function orderDetailsOfServiceProducts(Request $request)
  {
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$subscription) {
      abort(404);
    }
   
    $worker= ServiceProfileWorker::where('profile_id', $request->profile)->where('worker_user_id', Auth::id())->first();

    if($worker){
        $profile = ServiceProfile::where('id', $request->profile)->first();

    }else{
        $profile = ServiceProfile::where('id', $request->profile)->where('user_id', Auth::id())->first();

    }
    if (!$profile) {
      return redirect()->back()->with('warning', 'You are not able to see Details of Subscriber Order');
    }
    $order = ServiceProductOrder::find($request->order);
    $orderitems = ServiceProductOrderItem::where('service_product_order_id', $order->id)->get();
    // dd($orderitems);
    return view('subscriber.product.orderDetailsOfSubscriber', compact('order', 'profile', 'subscription', 'orderitems'));
  }

  /// For user need to another method
  public function orderItemStatusUpdateOfServiceProducts(Request $request)
  {
    $item = ServiceProductOrderItem::where('id', $request->item_id)->first();
    $me = Auth::user();
    $order = ServiceProductOrder::where('id', $request->order_id)->first();

    if ($request->order_status == $item->order_status) {
      return back()->with('warning', 'Order status Already updated');
    }

    $item->order_status = $request->order_status;
    $at_field = $request->order_status . '_at';
    $item[$at_field] = Carbon::now();
    $item->editedby_id = Auth::id();
    $item->save();

    $serviceProfileWoner = $item->serviceProfile->user;

    if ($item->order_status == 'confirmed') {
     $visitor= ServiceProfileVisitor::where('user_id',$order->user_id)
     ->where('service_profile_id',$order->service_profile_id)
     ->where('workstation_id',$order->workstation_id)
     ->where('ws_cat_id',$order->ws_cat_id)
     ->first();
     $visitor->customer = true;
     $visitor->save();
    }
    if ($item->order_status == 'cancelled') {
      // dd("Cancled");
      $item_user = $item->user;
      // dd($item_user);
      $item_user->increment('balance', $item->total_sale_price);
      $bt = new BalanceTransaction;
      $bt->user_id = $item->user_id;
      $bt->subscriber_id = $item->subscriber_id ?? null;
      $bt->from = "profile_owner"; // 
      $bt->to = "order_user"; //saller User 
      $bt->purpose = 'confirmed_balance_return';
      $bt->previous_balance = $item_user->balance;
      $bt->moved_balance = $item->total_sale_price;
      $bt->new_balance = $bt->previous_balance + $bt->moved_balance;
      $bt->type = 'profile_order';
      $bt->type_id = $item->service_product_order_id;
      $bt->details = 'Form order Only one product is cancelled. Balance (' . $bt->moved_balance . ') Added from From product (' . $item->product->name . ') sale';
      $bt->save();
      // dd("DONE");
      $order->decrement('order_confirmed_price', $bt->moved_balance);
    }
    if ($item->order_status == 'satisfied') {
      // $item->serviceProfile->user_id->user->update(['balance'=>]);
      $percentage = $item->category->service_product_commission;
      $commission=(($item->total_sale_price * $percentage)/100);

      $btc = new BalanceTransaction;
      $btc->user_id = $item->serviceProfile->user_id;
      $btc->subscriber_id = $item->serviceProfile->subscriber_id;
      $btc->from = "profile_owner"; // 
      $btc->to = "admin"; 
      $btc->purpose = 'service_product_commission';
      $btc->previous_balance = $item->category->product_commission_balance;
      $btc->moved_balance = $commission;
      $btc->new_balance = $btc->previous_balance + $btc->moved_balance;
      $btc->type = 'profile_order';
      $btc->type_id = $item->service_product_order_id;
      $btc->details = 'Balance (' . $btc->moved_balance . ') TK Added from From product Commission';
      $btc->save();

      $item->category->increment('product_commission_balance', $btc->moved_balance);

      $bt = new BalanceTransaction;
      $bt->user_id = $item->serviceProfile->user_id;
      $bt->subscriber_id = $item->serviceProfile->subscriber_id;
      $bt->from = "order_user"; // 
      $bt->to = "profile_owner"; //saller User 
      $bt->purpose = 'order_confirmed_balance';
      $bt->previous_balance = $serviceProfileWoner->balance;
      $bt->moved_balance = $item->total_sale_price - $commission;
      $bt->new_balance = $bt->previous_balance + $bt->moved_balance;
      $bt->type = 'profile_order';
      $bt->type_id = $item->service_product_order_id;
      $bt->details = 'Balance (' . $bt->moved_balance . ') Added from From product (' . $item->product->name . ') sale';
      $bt->save();

      $serviceProfileWoner->increment('balance', $bt->moved_balance);
      $order->decrement('order_confirmed_price', $item->total_sale_price);

      if ($order->order_confirmed_price < 1) {
        $order->payment_status = 'paid';
        $order->order_status = 'satisfied';
        $order->satisfied_at = Carbon::now();
        $order->save();
      }


    }
    if ($item->order_status == 'unsatisfied') {
      return redirect()->back()->with('success','Softcode Admin will be check your order and as son as possible get back to you.');
    }
    return redirect()->back()->with('success', 'Product Order Status updated Successfully');
  }

  public function orderSelectDeliveryman(Request $request)
  {
    // dd('ok');
    $request->validate([
      'deliveryman_id' => 'required'
    ]);
    $order = ServiceProductOrder::where('id', $request->order_id)->first();
    if (!$order) {
      return redirect()->back();
    }
    $me = Auth::user();
    $order->deliveryman_id = $request->deliveryman_id;
    $order->save();
    return redirect()->back()->with('success', 'Delivery Man Select Successfully');
  }

  public function orderStatusUpdateOfServiceProducts(Request $request)
  {
    // $request->validate([
    //   'allItem' => 'required'
    // ]);
    $order = ServiceProductOrder::where('id', $request->order_id)->first();
    if (!$order) {
      return redirect()->back();
    }
    
    $me = Auth::user();

    if ($request->order_status == $order->order_status) {
      return back()->with('warning', 'Order status Already updated');
    }
    if($order->serviceProfile->commission==0){
      $percentage = $order->category->service_product_commission;
      $commission=(($order->order_confirmed_price * $percentage)/100);
    }else{
      $percentage=$order->serviceProfile->commission;
      $commission=(($order->order_confirmed_price * $percentage)/100);

    }


 

    //dd($commission);

   

    $admin=User::Where('id','2')->first();

    if($order->payment_status == 'cashon' && $order->order_status == 'pending'){
      if ($commission > $me->welcome_balance && $commission > $me->balance) {
        return redirect()->back()->with('warning', 'Insufficient balance.If You Change this order status, You need to added '.$commission.' Tk. For Your soft wallet');
      }else{

        $at = new BalanceTransaction;
        $at->user_id = '2';
        $at->from = "profile_owner"; // 
        $at->to = "admin"; //saller User 
        $at->purpose = 'order_confirmed_balance';
        $at->previous_balance = $admin->balance;
        $at->moved_balance = $commission;
        $at->new_balance = $at->previous_balance + $at->moved_balance;
        $at->type = 'profile_order';
        $at->type_id = $order->id;
        $at->details = 'Balance (' . $at->moved_balance . ') Added from For Order Comission. Transaction id: (' . $order->	transection_id . ')';
        $at->save();
        $admin->increment('balance', $at->moved_balance);
        if($me->welcome_balance > $at->moved_balance){
          $me->decrement('welcome_balance', $at->moved_balance);
          
        }else{
          $me->decrement('balance', $at->moved_balance);

        }
       
       
      }


    }
    
    $order->order_status = $request->order_status;
    $at_field = $request->order_status . '_at';
    $order[$at_field] = Carbon::now();
    $order->editedby_id = Auth::id();
    $order->save();
    $serviceProfileWoner = $order->serviceProfile->user;


    if ($order->order_status == 'satisfied' && $order->payment_status!='cashon') {
      

      $btc = new BalanceTransaction;
      $btc->user_id = $order->serviceProfile->user_id;
      $btc->subscriber_id = $order->serviceProfile->subscriber_id;
      $btc->from = "profile_owner"; // 
      $btc->to = "admin"; 
      $btc->purpose = 'service_product_commission';
      $btc->previous_balance = $order->category->product_commission_balance;
      $btc->moved_balance = $commission;
      $btc->new_balance = $btc->previous_balance + $btc->moved_balance;
      $btc->type = 'profile_order';
      $btc->type_id = $order->id;
      $btc->details = 'Balance (' . $btc->moved_balance . ') TK Added from From product Commission';
      $btc->save();

      $order->category->increment('product_commission_balance', $btc->moved_balance);

      $admin->increment('balance', $btc->moved_balance);


      $bt = new BalanceTransaction;
      $bt->user_id = $order->serviceProfile->user_id;
      $bt->subscriber_id = $order->serviceProfile->subscriber_id;
      $bt->from = "order_user"; // 
      $bt->to = "profile_owner"; //saller User 
      $bt->purpose = 'order_confirmed_balance';
      $bt->previous_balance = $serviceProfileWoner->balance;
      $bt->moved_balance = $order->order_confirmed_price;
      $bt->new_balance = $bt->previous_balance + $bt->moved_balance;
      $bt->type = 'profile_order';
      $bt->type_id = $order->id;
      $bt->details = 'Balance (' . $bt->moved_balance . ') Added from From product sale';
      $bt->save();

      $serviceProfileWoner->increment('balance', $bt->moved_balance);
      $order->decrement('order_confirmed_price', $bt->moved_balance);

      $order->payment_status = 'paid';
      $order->save();
    }
    if ($order->order_status == 'cancelled' && $order->payment_status!='cashon') {
      $item_user = $order->user;
      $btr = new BalanceTransaction; // For Return Balance
      $btr->user_id = $order->user_id;
      $btr->subscriber_id = $order->subscriber_id ?? null;
      $btr->from = "profile_owner"; // 
      $btr->to = "order_user"; //saller User 
      $btr->purpose = 'confirmed_balance_return';
      $btr->previous_balance = $item_user->balance;
      $btr->moved_balance = $order->order_confirmed_price;
      $btr->new_balance = $btr->previous_balance + $btr->moved_balance;
      $btr->type = 'profile_order';
      $btr->type_id = $order->service_product_order_id;
      $btr->details = 'Order ('.$order->id.') is cancelled. Balance (' . $btr->moved_balance . ') Added from From product sale';
      $btr->save();
      
      $item_user->increment('balance', $btr->new_balance);
      $order->decrement('order_confirmed_price', $btr->moved_balance);

     


    }
    if ($order->order_status == 'cancelled'){
      $allorderProducts = ServiceProductOrderItem::where('service_product_order_id', $order->id)->get();
      foreach ($allorderProducts as  $pro) {
      
        $p=ServiceProfileProduct::where('id', $pro->service_product_id)->first();
        $p->stock=$p->stock + $pro->quantity;
        $p->save();
      }

    }

    $notification1=new OrderNotifications;
    $notification1->type='order';
    $notification1->title='Order Status Changed';
    $notification1->messages= "Order status is {$request->order_status}";
    $notification1->details="Order status is {$request->order_status}. Order Invoice: {$order->transection_id}";
    $notification1->user_id=$order->user_id;
    $notification1->status='1';
    $notification1->date=now();
    $notification1->link=$order->id;
    $notification1->save();

    $notification2=new OrderNotifications;
    $notification2->type='order';
    $notification2->title='Order Status Changed';
    $notification2->messages= "You change order status.Order status is {$request->order_status}";
    $notification2->details="You change order status.Order status is {$request->order_status}.Order Invoice: {$order->transection_id}";
    $notification2->user_id=Auth::id();
    $notification2->status='1';
    $notification2->date=now();
    $notification2->link=$order->id;
    $notification2->save();
    


    $orderitems = ServiceProductOrderItem::where('service_product_order_id', $order->id)->update([
      'order_status' => $request->order_status,
      $at_field => Carbon::now(),
      'editedby_id' => Auth::id()
    ]);


    return redirect()->back()->with('success', 'All Product Order Status updated Successfully');
  }

  public function allOrdersOfServieProfileProducts(Request $request)
  {
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$subscription) {
      abort(404);
    }
    $profile = ServiceProfile::where('id', $request->profile)->first();
    $my_orders = ServiceProductOrder::where('user_id', Auth::id())->where('service_profile_id', $request->profile)->orderBy('id','DESC')->paginate(30);
    return view('subscriber.product.myAllOrders', compact('subscription', 'my_orders', 'profile'));
  }

  public function OrdersOfServieProfileProducts(Request $request)
  {
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$subscription) {
      abort(404);
    }
    $profile = ServiceProfile::where('id', $request->profile)->first();
    $order = ServiceProductOrder::where('id', $request->order)->where('user_id', Auth::id())->first();
    if (!$order) {
      return redirect()->back()->with('warning', 'You Are Not able to see details of another subscriber order');
    }
    return view('subscriber.product.myOrderDetails', compact('subscription', 'order', 'profile'));
  }

  
}
