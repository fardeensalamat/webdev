<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceProfileProduct;
use App\Models\ServiceProfile;
use App\Models\Serviceitem;
use App\Models\FreelancerJob;
use App\Models\Subscriber;
use App\Models\Courseitem;
use Auth;
use Hash;
use Session;
use Validator;
use DB;
use App\Models\HomeShortCartFavorite;
use App\Models\HomeShortCart;
use App\Helps\Getipaddress;

class AutocompleteSearchController extends Controller
{

    public function autosearch(Request $request)
    {

        $subscription = Subscriber::where('user_id',Auth::id())->first();

        if ($request->ajax()) {
            $output = '';
            if($request->name==''){
                $keyword='.';
            }else{
                $keyword=$request->name;
            }

            $data = ServiceProfileProduct::where('name','LIKE',$keyword.'%')->where('status', 'approved')->where('active', true)->limit(5)->get();

            $data1 = ServiceProfile::where('name','LIKE',$keyword.'%')->where('profile_type', 'business')
                    ->where('status', 1)
                    ->limit(5)->get();

            $data3 = FreelancerJob::where('status',null)->where('category_id', '!=' , 20)
                    ->whereNull('admin_completed_status')
                    ->has('user')
                    ->whereDoesntHave('works',function($qq) use ($subscription) {
                        $qq->where('subscriber_id', $subscription->id);
                    })
                    ->whereRaw('total_worker > freelancer_jobs.work_done')
                    ->where('title','LIKE',$keyword.'%')->limit(5)->get();

            $data4 = Courseitem::where('title','LIKE',$keyword.'%')->where('status', 'approved')->where('active', true)->limit(5)->get();
            $data5 = Serviceitem::where('title','LIKE',$keyword.'%')->where('status', 'approved')->where('active', true)->limit(5)->get();


            if (count($data)>0 || count($data1)>0 || count($data3)>0 ||count($data4)>0 || count($data5)>0) {
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                foreach ($data as $row) {
                    $output .= '<a href="'.route('welcome.productShare', ['profile' => $row->service_profile_id, 'product' => $row->id, 'reffer' => $row->subscription->subscription_code]).'"><li class="list-group-item">'.$row->name.' <sub style="text-color:#808080">Product</sub></a></li>';
                }
                foreach ($data1 as $row1) {
                    $output .= '<a href="'.route('welcome.profileShare', ['profile' => $row1->id, 'reffer' => $row1->ownerSubscription->subscription_code]) .'"><li class="list-group-item">'.$row1->name.' <sub style="text-color:#808080">Service Profile</sub></a></li>';
                }

                foreach ($data3 as $row3) {
                    $output .= '<a href="'.route('subscriber.freelanceJobDetails', ['freelanceJob' => $row3, 'subscription' => $subscription->subscription_code]).'"><li class="list-group-item">'.$row3->title.' <sub>Work</sub></a></li>';
                }

                foreach ($data4 as $row4) {
                    $output .= '<a href="'.route('welcome.courseShare', ['product'=>$row4->id,'profile'=>$row4->serviceProfile->id,'reffer'=>$row4->subscriber->subscription_code]).'"><li class="list-group-item">'.$row4->title.' <sub>Course</sub></a></li>';
                }
                foreach ($data5 as $row5) {
                    $output .= '<a href="'.route('welcome.serviceItemShare', ['item'=>$row5->id,'profile'=>$row5->serviceProfile->id,'reffer'=>$row5->subscriber->subscription_code]).'"><li class="list-group-item">'.$row5->title.' <sub>Service Item</sub></a></li>';
                }
                $output .= '</ul>';
            }else {

            }
            return $output;
        }
        return view('autosearch');
    }



    // start Razib work

    public function autosearchUser(Request $request)
    {

        $subscription = Subscriber::where('user_id', \Illuminate\Support\Facades\Auth::id())->first();
//        return  response()->json($subscription);

        if ($request->ajax()) {
            $output = '';
            if($request->name==''){
                $keyword='.';
            }else{
                $keyword=$request->name;
            }


            $data = ServiceProfileProduct::where('name','LIKE',$keyword.'%')->where('status', 'approved')->where('active', true)->limit(5)->get();

            $data1 = ServiceProfile::where('name','LIKE',$keyword.'%')->where('profile_type', 'business')
                ->where('status', 1)
                ->limit(5)->get();

//            $data3 = FreelancerJob::where('status',null)->where('category_id', '!=' , 20)
//                    ->whereNull('admin_completed_status')
//                    ->has('user')
//                    ->whereDoesntHave('works',function($qq) use ($subscription) {
//                        $qq->where('subscriber_id', $subscription->id);
//                    })
//                    ->whereRaw('total_worker > freelancer_jobs.work_done')
//                    ->where('title','LIKE',$keyword.'%')->limit(5)->get();
//
//            $data4 = Courseitem::where('title','LIKE',$keyword.'%')->where('status', 'approved')->where('active', true)->limit(5)->get();
//            $data5 = Serviceitem::where('title','LIKE',$keyword.'%')->where('status', 'approved')->where('active', true)->limit(5)->get();


            if (count($data)>0 || count($data1)>0 ) { //            || count($data3)>0 ||count($data4)>0 || count($data5)>0
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';


                foreach ($data as $row) {

                    $output .= '<a target="_blank" href="' . route('welcome.productShare', ['profile' => $row->service_profile_id, 'product' => $row->id, 'reffer' => $row->subscription->subscription_code]) . '"><li class="list-group-item" data-url="' . route('welcome.productShare', ['profile' => $row->service_profile_id, 'product' => $row->id, 'reffer' => $row->subscription->subscription_code]) . '">' . $row->name . ' <sub style="text-color:#808080">Product</sub></a></li>';

                }
                foreach ($data1 as $row1) {
                    $output .= '<a target="_blank" href="' . route('welcome.profileShare', ['profile' => $row1->id, 'reffer' => $row1->ownerSubscription->subscription_code]) . '"><li class="list-group-item">' . $row1->name . ' <sub style="text-color:#808080">Service Profile</sub></a></li>';


                }

//                foreach ($data3 as $row3) {
//                    $output .= '<a href="'.route('subscriber.freelanceJobDetails', ['freelanceJob' => $row3, 'subscription' => $subscription->subscription_code]).'"><li class="list-group-item">'.$row3->title.' <sub>Work</sub></a></li>';
//                }
//
//                foreach ($data4 as $row4) {
//                    $output .= '<a href="'.route('welcome.courseShare', ['product'=>$row4->id,'profile'=>$row4->serviceProfile->id,'reffer'=>$row4->subscriber->subscription_code]).'"><li class="list-group-item">'.$row4->title.' <sub>Course</sub></a></li>';
//                }
//                foreach ($data5 as $row5) {
//                    $output .= '<a href="'.route('welcome.serviceItemShare', ['item'=>$row5->id,'profile'=>$row5->serviceProfile->id,'reffer'=>$row5->subscriber->subscription_code]).'"><li class="list-group-item">'.$row5->title.' <sub>Service Item</sub></a></li>';
//                }
                $output .= '</ul>';
            }else {

            }



            echo $output;
        }
//        return view('autosearch');
    }




    public function autosearchUserProduct(Request $request)
    {

        $subscription = Subscriber::where('user_id', \Illuminate\Support\Facades\Auth::id())->first();
//        return  response()->json($subscription);

        if ($request->ajax()) {
            $output = '';
            if($request->name==''){
                $keyword='.';
            }else{
                $keyword=$request->name;
            }


            $data = ServiceProfileProduct::where('name','LIKE',$keyword.'%')->where('status', 'approved')->where('active', true)->limit(5)->get();

//            $data1 = ServiceProfile::where('name','LIKE',$keyword.'%')->where('profile_type', 'business')
//                ->where('status', 1)
//                ->limit(5)->get();

//            $data3 = FreelancerJob::where('status',null)->where('category_id', '!=' , 20)
//                    ->whereNull('admin_completed_status')
//                    ->has('user')
//                    ->whereDoesntHave('works',function($qq) use ($subscription) {
//                        $qq->where('subscriber_id', $subscription->id);
//                    })
//                    ->whereRaw('total_worker > freelancer_jobs.work_done')
//                    ->where('title','LIKE',$keyword.'%')->limit(5)->get();
//
//            $data4 = Courseitem::where('title','LIKE',$keyword.'%')->where('status', 'approved')->where('active', true)->limit(5)->get();
//            $data5 = Serviceitem::where('title','LIKE',$keyword.'%')->where('status', 'approved')->where('active', true)->limit(5)->get();


            if (count($data)>0  ) { //            || count($data3)>0 ||count($data4)>0 || count($data5)>0
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';


                foreach ($data as $row) {

                    $output .= '<a target="_blank" href="' . route('welcome.productShare', ['profile' => $row->service_profile_id, 'product' => $row->id, 'reffer' => $row->subscription->subscription_code]) . '"><li class="list-group-item" data-url="' . route('welcome.productShare', ['profile' => $row->service_profile_id, 'product' => $row->id, 'reffer' => $row->subscription->subscription_code]) . '">' . $row->name . ' <sub style="text-color:#808080">Product</sub></a></li>';

                }
//                foreach ($data1 as $row1) {
//                    $output .= '<a target="_blank" href="' . route('welcome.profileShare', ['profile' => $row1->id, 'reffer' => $row1->ownerSubscription->subscription_code]) . '"><li class="list-group-item">' . $row1->name . ' <sub style="text-color:#808080">Service Profile</sub></a></li>';
//
//
//                }

//                foreach ($data3 as $row3) {
//                    $output .= '<a href="'.route('subscriber.freelanceJobDetails', ['freelanceJob' => $row3, 'subscription' => $subscription->subscription_code]).'"><li class="list-group-item">'.$row3->title.' <sub>Work</sub></a></li>';
//                }
//
//                foreach ($data4 as $row4) {
//                    $output .= '<a href="'.route('welcome.courseShare', ['product'=>$row4->id,'profile'=>$row4->serviceProfile->id,'reffer'=>$row4->subscriber->subscription_code]).'"><li class="list-group-item">'.$row4->title.' <sub>Course</sub></a></li>';
//                }
//                foreach ($data5 as $row5) {
//                    $output .= '<a href="'.route('welcome.serviceItemShare', ['item'=>$row5->id,'profile'=>$row5->serviceProfile->id,'reffer'=>$row5->subscriber->subscription_code]).'"><li class="list-group-item">'.$row5->title.' <sub>Service Item</sub></a></li>';
//                }
                $output .= '</ul>';
            }else {

            }



            echo $output;
        }
//        return view('autosearch');
    }











    public function autosearchUserShortCart(Request  $request){
        $home_short_cart = new HomeShortCart();
        $home_short_cart->title = $request->name;
        $home_short_cart->url = $request->url;
        $home_short_cart->ip_address = Getipaddress::getUserIpAddr();
        $home_short_cart->user_id = Auth::check() ? Auth::id() : null;
        $home_short_cart->device = Getipaddress::get_device();
        $home_short_cart->browser = Getipaddress::get_browsers();
        $home_short_cart->save();
        $check = HomeShortCart::where(['ip_address'=> Getipaddress::getUserIpAddr(), 'url' => $request->url, 'title' => $request->name, 'device' => Getipaddress::get_device(), 'browser'=> Getipaddress::get_browsers()])->count();
        if($check == 10){
            $home_short_car = new HomeShortCartFavorite();
            $home_short_car->title = $request->name;
            $home_short_car->url = $request->url;
            $home_short_car->ip_address = Getipaddress::getUserIpAddr();
            $home_short_car->user_id = Auth::check() ? Auth::id() : null;
            $home_short_car->device = Getipaddress::get_device();
            $home_short_car->browser = Getipaddress::get_browsers();
            $home_short_car->save();
        }
    }


    public function autosearchUserShortCartFavorite(Request  $request){
        $home_short_car = new HomeShortCartFavorite();
        $home_short_car->title = $request->name;
        $home_short_car->url = 'https://'.$request->url;
        $home_short_car->ip_address = Getipaddress::getUserIpAddr();
        $home_short_car->user_id = Auth::check() ? Auth::id() : null;
        $home_short_car->device = Getipaddress::get_device();
        $home_short_car->browser = Getipaddress::get_browsers();
        $home_short_car->save();
        return redirect()->back();
    }

// end razib work



    public  function index(){
        $homeShortCart = HomeShortCartFavorite::where(['ip_address'=> Getipaddress::getUserIpAddr(),  'device' => Getipaddress::get_device(), 'browser'=> Getipaddress::get_browsers()])->orderByDesc('id')->take(7)->get();
        return view('app_view', compact('homeShortCart'));
    }















}
