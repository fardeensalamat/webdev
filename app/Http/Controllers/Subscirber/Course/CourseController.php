<?php

namespace App\Http\Controllers\Subscirber\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ServiceItemRequest;
use App\Models\Serviceitem;
use App\Models\ServiceProfile;
use App\Models\Subscriber;
use App\Models\Courseitem;
use Auth;
use DB;
use Validator;
use Carbon\Carbon;
use App\Models\ServiceProductCart;
use App\Models\SendSms;
use App\Models\CourseOrder;
use App\Models\BalanceTransaction;

use App\Models\User;

use App\Models\OrderNotifications;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function newCourse(Request $request)
    {
  
      $request = request();
      $request->session()->forget(['lsbm', 'lsbsm']);
      $request->session()->put(['lsbm' => 'job', 'lsbsm' => 'newCourse']);
  
      $serviceProfile = ServiceProfile::find($request->profile);
      $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
      if (!$serviceProfile || !$subscription) {
        abort(404);
      }
      $profile = ServiceProfile::where('id', $request->profile)->first();
      return view('subscriber.course.addcourseitem', compact('subscription', 'serviceProfile','profile'));
    }






    public function storeCourse(Request $request)
  {

    $request->validate([
      'title' => 'required|string|max:250',
      'ins_name' => 'required|string|max:250',
      'ins_designation' => 'required',
      'price' => 'required|numeric',
      'negotiations' => 'nullable',
      'courseimage'=>'required|mimes:jpg,bmp,png'
    ]);
    $serviceProfile = ServiceProfile::find($request->profile);
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$serviceProfile || !$subscription) {
      abort(404);
    }

    $course = Courseitem::where('service_profile_id', $serviceProfile->id)->count();
    if($course<=8 && $serviceProfile->paystatus==1){
        $me = Auth::user();
        $me->increment('ad_balance', 50);
    }

    $user = Auth::user();
    $courseItem = new Courseitem;
    $courseItem->user_id = $user->id;
    $courseItem->service_profile_id = $serviceProfile->id;
    $courseItem->category_id = $serviceProfile->category->id;
    $courseItem->workstation_id = $serviceProfile->workstation->id;
    $courseItem->subscriber_id = $subscription->id;
    $courseItem->title = $request->title;
    $courseItem->subtitle = $request->subtitle;
    $courseItem->ins_name = $request->ins_name;
    $courseItem->ins_designation = $request->ins_designation;
    $courseItem->whatlearn = $request->whatlearn;
    $courseItem->aboutcourse = $request->aboutcourse;
    $courseItem->coursesyllabus = $request->coursesyllabus;
    $courseItem->hoursdetails = $request->hoursdetails;
    $courseItem->price = $request->price;
    $courseItem->courselink = $request->courselink;
    $courseItem->negotiations = $request->negotiations ? 1 : 0;
    $courseItem->active = $request->active ? 1 : 0;
    $courseItem->addedby_id = Auth::id();
    $courseItem->save();
    if ($cp = $request->courseimage) {
      $f = 'product/courseitems/' . $courseItem->courseimage;
      if (Storage::disk('public')->exists($f)) {
        Storage::disk('public')->delete($f);
      }

      $extension = strtolower($cp->getClientOriginalExtension());
      $randomFileName = $courseItem->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

      $originalName = strtolower($cp->getClientOriginalName());

      Storage::disk('public')->put('product/courseitems/' . $randomFileName, File::get($cp));

      $courseItem->courseimage = $randomFileName;
      $courseItem->save();
    }


     

    // $serviceI= Serviceitem::create($request->validated());
    return redirect()->back()->with('success', 'Course item Successfully Added');
  }



  public function allCourseItems(Request $request)
  {

    $request = request();
    $request->session()->forget(['lsbm', 'lsbsm']);
    $request->session()->put(['lsbm' => 'job', 'lsbsm' => 'allCourseItems']);

    $serviceProfile = ServiceProfile::find($request->profile);
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$serviceProfile || !$subscription) {
      abort(404);
    }
    $profile = ServiceProfile::where('id', $request->profile)->first(); 		
    $courseItems = Courseitem::with('user', 'category', 'workstation')->where('service_profile_id', $request->profile)->where('active', true)->get();
    return view('subscriber.course.allcourseitems', compact('courseItems', 'serviceProfile', 'subscription','profile'));
  }





  public function editCourseItems(Request $request)
  {
    $serviceProfile = ServiceProfile::find($request->profile);
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$serviceProfile || !$subscription) {
      abort(404);
    }
    $courseItem = Courseitem::where('id', $request->item)->first();
    $profile = ServiceProfile::where('id', $request->profile)->first(); 		

    return view('subscriber.course.editcourseitem', compact('courseItem','profile', 'serviceProfile', 'subscription'));
  }



  
  public function updateCourseItems(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:250',
      'ins_name' => 'required|string|max:250',
      'ins_designation' => 'required',
      'price' => 'required|numeric',
      'negotiations' => 'nullable',
    ]);

    //dd($request->all());
    $serviceProfile = ServiceProfile::find($request->profile);
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$serviceProfile || !$subscription) {
      abort(404);
    }
      $courseItem = Courseitem::where('id', $request->item)->first();
      $courseItem->service_profile_id = $serviceProfile->id;
      $courseItem->category_id = $serviceProfile->category->id;
      $courseItem->workstation_id = $serviceProfile->workstation->id;
      $courseItem->subscriber_id = $subscription->id;
      $courseItem->title = $request->title;
      $courseItem->subtitle = $request->subtitle;
      $courseItem->ins_name = $request->ins_name;
      $courseItem->ins_designation = $request->ins_designation;
      $courseItem->whatlearn = $request->whatlearn;
      $courseItem->aboutcourse = $request->aboutcourse;
      $courseItem->coursesyllabus = $request->coursesyllabus;
      $courseItem->hoursdetails = $request->hoursdetails;
      $courseItem->price = $request->price;
      $courseItem->courselink = $request->courselink;
      $courseItem->negotiations = $request->negotiations ? 1 : 0;
      $courseItem->active = $request->active ? 1 : 0;
      $courseItem->addedby_id = Auth::id();
      $courseItem->save();
    if ($cp = $request->courseimage) {
      $f = 'product/courseitems/' . $courseItem->courseimage;
      if (Storage::disk('public')->exists($f)) {
        Storage::disk('public')->delete($f);
      }

      $extension = strtolower($cp->getClientOriginalExtension());
      $randomFileName = $courseItem->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

      $originalName = strtolower($cp->getClientOriginalName());

      Storage::disk('public')->put('product/courseitems/' . $randomFileName, File::get($cp));

      $courseItem->courseimage = $randomFileName;
      $courseItem->save();
    }
    $profile = ServiceProfile::where('id', $request->profile)->first(); 		
    $courseItems = Courseitem::with('user', 'category', 'workstation')->where('service_profile_id', $request->profile)->where('status', 'approved')->where('active', true)->get();

    return view('subscriber.course.allcourseitems', compact('courseItems', 'serviceProfile', 'subscription','profile'))->with('success', 'Course Item Updated Successfully');
    //return redirect()->back()->with('success', 'Course Item Updated Successfully');
  }

  public function courseItemsDelete($item)
  {
      $checkcourseorder=CourseOrder::where('course_id',$item)->count();
     
      if($checkcourseorder<1){
        //dd($checkcourseorder);
        $course= Courseitem::find($item);
        $course->delete();
        return redirect()->back()->with('success', 'Course Item Delete Successfully');

      }else{
        return redirect()->back()->with('warning', 'Course Item Depend On Order Table');
      }
    
  }

  public function addToCartCourse(Request $request)
  {
    //dd($request->profile);
    // $service_profile_id = ServiceProfile::where('user_id', Auth::id())->first();
    $profile = ServiceProfile::find($request->profile);
    if (!$profile) {
        return back();
    }
    $subscriber = Subscriber::where('user_id', Auth::id())->where('category_id', $profile->ws_cat_id)->first();
    //dd($subscription->subscription_code);

    if (!Auth::check()) {
     return redirect()->back()->with('warning','Login First');
    }
    $product = Courseitem::where('id', $request->product)->first();

    //$subscriber = Subscriber::where('subscription_code', $request->subscription)->where('user_id', Auth::id())->first();

    $isAlreadyAddedToCart = ServiceProductCart::where('product_id', $product->id)->where('service_profile_id', $product->service_profile_id)->where('user_id', Auth::id())->first();
    if ($isAlreadyAddedToCart) {
      return redirect()->route('subscriber.checkoutCourse', ['profile' =>  $product->service_profile_id, 'subscription' => $subscriber->subscription_code])->with('success', 'Course Already Add To Cart');
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
     return redirect()->route('subscriber.checkoutCourse', ['profile' =>  $product->service_profile_id, 'subscription' => $subscriber->subscription_code])->with('success', 'Course Add To Cart');
   
  }

  public function checkoutCourse(Request $request)
  {
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$subscription) {
      abort(404);
    }
    $allCartProducts = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $request->profile)->get();
    $profile = ServiceProfile::where('id', $request->profile)->first();
    $total_amount = 0;
    foreach ($allCartProducts as  $item) {
      $total_amount += $item->quantity * $item->course->price;
    }
    $user = Auth::user();
    return view('subscriber.course.checkoutCourse', compact('subscription', 'allCartProducts', 'total_amount', 'profile', 'user'));
  }

  public function courseOrderSubmit(Request $request)
  {
   
    $request->validate([
      'name' => 'required',
      //'email' => 'required',
      'phone' => 'required',
      'delivery_address' => 'required',
      'paymod' => 'required'
    ]);

    User::where('id', Auth::id())->update([
      'address' => $request->delivery_address,
      'email' => $request->email
    ]);

   

   $transaction_id=now()->format('Ymds');
   $profile = ServiceProfile::where('id', $request->profile)->first();
    if($request->paymod=='bysoft'){
      $serviceProductOrder = new CourseOrder;
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
  
      $allCartProducts = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $request->profile)->first();
     // dd($allCartProducts->course->serviceProfile->id)
      $serviceProductOrder->course_id = $allCartProducts->product_id;
      $serviceProductOrder->course_profile_id = $allCartProducts->course->serviceProfile->id;
      $serviceProductOrder->total_quantity = $allCartProducts->quantity;
      $serviceProductOrder->order_confirmed_price = $allCartProducts->course->price;
      $serviceProductOrder->order_status = 'approved';
      $serviceProductOrder->confirmed_at = now();
      $me = Auth::user();
      $order_confirmed_price=$allCartProducts->course->price;
      if ($allCartProducts->course->price > $me->balance) {
        return redirect()->back()->with('warning', 'Insufficient balance');
      }
  
      $serviceProductOrder->save();
      $order_user = Auth::user();
      $item = Courseitem::where('id', $allCartProducts->product_id)->first();

      $serviceProfileWoner = $item->serviceProfile->user;
      $bto = new BalanceTransaction;
      $bto->user_id = $order_user->id;
      $bto->subscriber_id = $profile->subscriber_id;
      $bto->from = "order_user"; // 
      $bto->to = "order_confirmed_balance"; //saller User 
      $bto->purpose = 'order_confirmed_balance';
      $bto->previous_balance = $order_user->balance;
      $bto->moved_balance = $serviceProductOrder->order_confirmed_price;
      $bto->new_balance = $bto->previous_balance - $bto->moved_balance;
      $bto->type = 'profile_order';
      $bto->type_id = $serviceProductOrder->id;
      $bto->details = 'Balance (' . $bto->moved_balance . ') diducted from your balance For product Order';
      $bto->save();
      $order_user->decrement("balance", $bto->moved_balance);

  
      $percentage = $item->category->service_product_commission;
      $commission=(($item->price * $percentage)/100);

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
      $bt->moved_balance = $item->price - $commission;
      $bt->new_balance = $bt->previous_balance + $bt->moved_balance;
      $bt->type = 'profile_order';
      $bt->type_id = $item->service_product_order_id;
      $bt->details = 'Balance (' . $bt->moved_balance . ') Added from From product (' . $item->title . ') sale';
      $bt->save();

      $serviceProfileWoner->increment('balance', $bt->moved_balance);
      $allCartProducts->delete();
   
    
    }

    $number=$me->mobile;
    $messages= "Dear {$me->name}, You Successfully Enroll This Course. Your Order ID: {$transaction_id}";

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
    }
        


    $notification1=new OrderNotifications;
    $notification1->type='order';
    $notification1->title='Course Conformation';
    $notification1->messages= $messages;
    $notification1->details="Dear {$me->name}, Your course profile name {$profile->name}. Your order total:{$order_confirmed_price}.Order status pending.Payment status {$paystatus}";
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


   
    return redirect()->route('user.EnrollCourse')->with('success', 'Enroll Course Successfully Complete');
  }

  public function allordersOfCourse(Request $request)
  {
    $request = request();
    $request->session()->forget(['lsbm', 'lsbsm']);
    $request->session()->put(['lsbm' => 'job', 'lsbsm' => 'allordersOfCourse']);

    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$subscription) {
      abort(404);
    }
    $profile = ServiceProfile::where('id', $request->profile)->where('user_id', Auth::id())->first();
    if (!$profile) {
      return redirect()->back()->with('warning', 'You are not able to see another Subscriber Order');
    }
    $allOrders = CourseOrder::where('service_profile_id', $profile->id)->get();
    // dd($profile->workstation->title);
    return view('subscriber.course.courseallorders', compact('subscription', 'profile', 'allOrders'));
  }

  public function orderDetailsOfCourse(Request $request)
  {
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$subscription) {
      abort(404);
    }
    $profile = ServiceProfile::where('id', $request->profile)->where('user_id', Auth::id())->first();
    if (!$profile) {
      return redirect()->back()->with('warning', 'You are not able to see Details of Subscriber Order');
    }
    $order = CourseOrder::find($request->order);
    return view('subscriber.course.orderDetailsOfCourse', compact('order', 'profile', 'subscription'));
  }
  
}
