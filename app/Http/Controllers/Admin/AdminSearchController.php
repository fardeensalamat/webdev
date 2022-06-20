<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Mail;
use Hash;
use Event;
use Cache;
use Str;
use Cookie;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Subscriber;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\FreelancerJob; 
use App\Models\ServiceProfile;
use App\Models\SubcriberPayment;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class AdminSearchController extends Controller
{

    public function searchAjax(Request $request)
    {
        $type = $request->type;
        $page = '';
        $q = $request->q;
        $status = $request->status;

        // if($type == 'product')
        // {
        //     $products = Product::where('status', '<>','temp')
        //     ->where(function($query) use ($q) {
        //         $query->where('id', 'like', "%{$q}%");
        //         $query->orWhere('title', 'like', "%{$q}%");
        //     })

        //     ->where(function($qq) {
        //         if($st = request()->status)
        //         {
        //             if($st == 'active')
        //             {
        //                 $qq->where('active',1);
        //             }
        //             elseif($st == 'inactive')
        //             {
        //                 $qq->where('active', 0);
        //             }
        //             elseif($st == 'stockout')
        //             {
        //                 $qq->where('quantity', '<', 1);
        //             }
        //             elseif($st == 'stocked')
        //             {
        //                 $qq->where('quantity', '>', 0);
        //             }
        //         }
        //     })
            
        //     ->latest()->paginate(100);

        //     $page = View('admin.products.includes.productsAll',['products' =>$products, 'q'=>$q, 'status'=>$status])->render();
        // }

        // if($type == 'category')
        // {

        //     $categories = ProductCategory::where(function($query) use ($q) {
        //         $query->where('id', 'like', "%{$q}%");
        //         $query->orWhere('title', 'like', "%{$q}%");
        //     })
            
        //     ->latest()->paginate(100);

        //     $page = View('admin.attributes.category.categoryAll',['categories' =>$categories, 'q'=>$q])->render();
        // }

        // if($type == 'subcategory')
        // {

        //     $subcategories = ProductSubcategory::where(function($query) use ($q) {
        //         $query->where('id', 'like', "%{$q}%");
        //         $query->orWhere('title', 'like', "%{$q}%");
        //     })
            
        //     ->latest()->paginate(100);

        //     $page = View('admin.attributes.subcategory.subcategoryAll',['subcategories' =>$subcategories, 'q'=>$q])->render();
        // }

        // if($type == 'subsubcategory')
        // {

        //     $subsubcategories = ProductSubsubcategory::where(function($query) use ($q) {
        //         $query->where('id', 'like', "%{$q}%");
        //         $query->orWhere('title', 'like', "%{$q}%");
        //     })
            
        //     ->latest()->paginate(100);

        //     $page = View('admin.attributes.subsubcategory.subsubcategoryAll',['subsubcategories' =>$subsubcategories, 'q'=>$q])->render();
        // }

        // if($type == 'brand')
        // {
        //     $data = ProductBrand::where(function($query) use ($q) {
        //         $query->where('id', 'like', "%{$q}%");
        //         $query->orWhere('title', 'like', "%{$q}%");
        //     })
            
        //     ->latest()->paginate(100);

        //     $page = View('admin.attributes.brand.brandAll',['brands' =>$data, 'q'=>$q])->render();

            
        // }


        // if($type == 'color')
        // {
        //     $data = Color::where(function($query) use ($q) {
        //         $query->where('id', 'like', "%{$q}%");
        //         $query->orWhere('title', 'like', "%{$q}%");
        //     })
            
        //     ->latest()->paginate(100);

        //     $page = View('admin.attributes.color.colorAll',['colors' =>$data, 'q'=>$q])->render();

            
        // }

        // if($type == 'size')
        // {
        //     $data = Size::where(function($query) use ($q) {
        //         $query->where('id', 'like', "%{$q}%");
        //         $query->orWhere('title', 'like', "%{$q}%");
        //     })
            
        //     ->latest()->paginate(100);

        //     $page = View('admin.attributes.size.sizeAll',['sizes' =>$data, 'q'=>$q])->render();

            
        // }

        // if($type == 'coupon')
        // {
        //     $data = Coupon::where(function($query) use ($q) {
        //         $query->where('id', 'like', "%{$q}%");
        //         $query->orWhere('coupon_code', 'like', "%{$q}%");
        //     })

        //     ->where('status', '<>', 'temp')
            
        //     ->latest()->paginate(100);

        //     $page = View('admin.coupons.couponsAll',['coupons' =>$data, 'q'=>$q])->render();

            
        // }

        // if($type == 'order')
        // {
        //     $data = Order::where(function($query) use ($q) {
        //         $query->where('id', 'like', "%{$q}%");
        //         $query->orWhere('transaction_id', 'like', "%{$q}%");
        //         $query->orWhere('mobile', 'like', "%{$q}%");
        //         $query->orWhere('email', 'like', "%{$q}%");
        //     }) 

        //     ->where(function($qq) use ($status) {

        //         if($status)
        //         {
        //             $qq->where('order_status', $status);
        //         }
        //     })

        //     ->latest()->paginate(100);

        //     $page = View('admin.orders.ordersAll',['orders' =>$data, 'q'=>$q, 'status' => $status])->render();

            
        // }
        
        // if($type == 'return')
        // {
        //     $data = OrderReturn::where(function($query) use ($q) {
        //         $query->where('id', 'like', "%{$q}%");
        //         $query->orWhere('invoice_number', 'like', "%{$q}%");
        //     }) 

        //     ->where(function($qq) use ($status) {

        //         if($status)
        //         {
        //             $qq->where('status', $status);
        //         }
        //     })

        //     ->latest()->paginate(100);

        //     $page = View('admin.orders.returnsAll',['returns' =>$data, 'q'=>$q, 'status' => $status])->render();

            
        // }

        // if($type == 'seller')
        // {
        //     $data = Seller::where(function($query) use ($q) {
        //         $query->where('id', 'like', "%{$q}%");
        //         $query->orWhere('title', 'like', "%{$q}%");
        //         $query->orWhere('mobile', 'like', "%{$q}%");
        //         // $query->orWhere('email', 'like', "%{$q}%");
        //     })

        //     ->where(function($query) use ($status){

        //     if($status == 'active')
        //     {
        //         $query->where('active', true);
        //     }
        //     if($status == 'inactive')
        //     {
        //         $query->where('active', false);
        //     }

        //     if($status == 'pending')
        //     {
        //         $query->where('status', 'pending');
        //     }

        //     if($status == 'approved')
        //     {
        //         $query->where('status', 'approved');
        //     }

        //     if($status == 'suspended')
        //     {
        //         $query->where('status', 'suspended');
        //     }

        // })->latest()->paginate(100);

        //     $page = View('admin.seller.sellersAll',['sellers' =>$data, 'q'=>$q, 'status' => $status])->render();

            
        // }


        if($type == 'user')
        {
            $data = User::withoutGlobalScopes()->where(function($query) use ($q) {
                $query->where('id', 'like', "%{$q}%");
                $query->orWhere('name', 'like', "%{$q}%");
                $query->orWhere('mobile', 'like', "%{$q}%");
                // $query->orWhere('email', 'like', "%{$q}%");
            })

            ->where(function($query) use ($status){

            if($status == 'active')
            {
                $query->where('active', true);
            }
            if($status == 'inactive')
            {
                $query->where('active', false);
            }

             

        })->latest()->paginate(100)->appends(['q'=>$q,'status'=>$status,'type'=>$type]);

            $page = View('admin.users.ajax.users_all',['usersAll' =>$data, 'q'=>$q, 'status' => $status])->render();

            
        }

        if($type == 'employee')
        {
            $data = User::withoutGlobalScopes()->where('is_employee',1)->where(function($query) use ($q) {
                $query->where('id', 'like', "%{$q}%");
                $query->orWhere('name', 'like', "%{$q}%");
                $query->orWhere('mobile', 'like', "%{$q}%");
                // $query->orWhere('email', 'like', "%{$q}%");
            })

            ->where(function($query) use ($status){

            if($status == 'active')
            {
                $query->where('active', true);
            }
            if($status == 'inactive')
            {
                $query->where('active', false);
            }

             

        })->latest()->paginate(100)->appends(['q'=>$q,'status'=>$status,'type'=>$type]);

            $page = View('admin.employee.ajax.employee_all',['employeeAll' =>$data, 'q'=>$q, 'status' => $status])->render();

            
        }


        if($type == 'freelancer')
        {
            $data = User::withoutGlobalScopes()->where('is_freelancer',1)->where(function($query) use ($q) {
                $query->where('id', 'like', "%{$q}%");
                $query->orWhere('name', 'like', "%{$q}%");
                $query->orWhere('mobile', 'like', "%{$q}%");
                // $query->orWhere('email', 'like', "%{$q}%");
            })

            ->where(function($query) use ($status){

            if($status == 'active')
            {
                $query->where('active', true);
            }
            if($status == 'inactive')
            {
                $query->where('active', false);
            }

             

        })->latest()->paginate(100)->appends(['q'=>$q,'status'=>$status,'type'=>$type]);

            $page = View('admin.freelancer.ajax.freelancer_all',['freelancerAll' =>$data, 'q'=>$q, 'status' => $status])->render();

            
        }
        if($type == 'job')
        {
            $data = FreelancerJob::where('id', 'like', "%{$q}%")
            ->latest()
            ->paginate(100)
            ->appends(['q'=>$q,'status'=>$status,'type'=>$type]);

            $page = View('admin.job.ajax.allJobs',['jobs' =>$data, 'q'=>$q, 'status' => $status])->render();

            
        }

        if($type == 'jobAdmin')
        {
            
            
            $data = FreelancerJob::where('id', 'like', "%{$q}%")
            ->latest()
            ->paginate(100)
            ->appends(['q'=>$q,'status'=>$status,'type'=>$type]);

            $page = View('admin.job.ajax.allPostedJobModifiedByAdmin',['jobs' =>$data, 'q'=>$q, 'status' => $status, 'type'=>$value=null])->render();

            
        }
        
        if($type == 'subscriber')
        {
             $data = Subscriber::where(function($query)use($q){
                $query->where('subscription_code', 'like', "%$q%");
                $query->orWhere('name', 'like', "%$q%");
                $query->orWhere('mobile', 'like', "%$q%");
                $query->orWhere('id', 'like',"%$q%");
                $query->orWhere('user_id', 'like',"%$q%");
             })->latest()->paginate(100)->appends(['q'=> $q,'type'=>$type,'status'=>$status]);

            $page = View('admin.subcribers.ajax.admin_subscriberAll',['subcribers' =>$data, 'q'=>$q, 'status' => $status])->render();

            
        }

        if($type == 'paidshop')
        {
             $data = ServiceProfile::where('paystatus', true)->where(function($query)use($q){
                $query->orWhere('name', 'like', "%$q%");
                $query->orWhere('mobile', 'like', "%$q%");
                $query->orWhere('id', 'like',"%$q%");
                $query->orWhere('user_id', 'like',"%$q%");
             })->latest()->paginate(24)->appends(['q'=> $q,'type'=>$type,'status'=>$status]);

            $page = View('admin.dashboarddetails.ajax.tenantshopdetails',['profiles' =>$data, 'q'=>$q, 'status' => $status])->render();

            
        }
        if($type == 'unpaidshop')
        {
             $data = ServiceProfile::where('paystatus', false)->where(function($query)use($q){
                $query->orWhere('name', 'like', "%$q%");
                $query->orWhere('mobile', 'like', "%$q%");
                $query->orWhere('id', 'like',"%$q%");
                $query->orWhere('user_id', 'like',"%$q%");
             })->latest()->paginate(24)->appends(['q'=> $q,'type'=>$type,'status'=>$status]);

            $page = View('admin.dashboarddetails.ajax.tenantshopdetails',['profiles' =>$data, 'q'=>$q, 'status' => $status])->render();

            
        }

        if($type == 'serviceprofile')
        {
             $data = ServiceProfile::where(function($query)use($q){
                $query->orWhere('name', 'like', "%$q%");
                $query->orWhere('mobile', 'like', "%$q%");
                $query->orWhere('id', 'like',"%$q%");
                $query->orWhere('user_id', 'like',"%$q%");
             })->latest()->paginate(24)->appends(['q'=> $q,'type'=>$type,'status'=>$status]);

            $page = View('admin.profile.serviceProfilelistajax',['profiles' =>$data, 'q'=>$q, 'status' => $status])->render();

            
        }
        
        if($type == 'order')
        {
            $sp = SubcriberPayment::whereHas('user', function($qq) use($q, $status) {
                
                $qq->where('id', 'like', "%{$q}%");
                $qq->orWhere('name', 'like', "%{$q}%");
                $qq->orWhere('mobile', 'like', "%{$q}%");
                
                if($status == 'active')
                {
                    $qq->where('active', true);
                }
                if($status == 'inactive')
                {
                    $qq->where('active', false);
                }
            })
            
           

            ->where(function($query) use ($status){

            if($status == 'paid')
            {
                $query->where('status', 'paid');
            }
            if($status == 'pending')
            {
                $query->where('status', 'pending');
            }

             

        })
            ->latest()
            ->orderBy('status')
            ->paginate(100)
            ->appends(['q'=>$q,'type'=>$type,'status'=>$status]);

            $page = View('admin.orders.ajax.paymentOrdersAll',['payments' =>$sp, 'q'=>$q, 'status' => $status])->render();

            
        }

        if($type == 'role')
        {
            $data = User::has('roles')
                ->where(function($query) use ($q) {
                $query->where('id', 'like', "%{$q}%");
                $query->orWhere('name', 'like', "%{$q}%");
                $query->orWhere('mobile', 'like', "%{$q}%");
                $query->orWhere('email', 'like', "%{$q}%");
            })

            ->where(function($query) use ($status){

            if($status == 'active')
            {
                $query->where('active', true);
            }
            if($status == 'inactive')
            {
                $query->where('active', false);
            }

             

        })->latest()->paginate(100)->appends(['q'=>$q,'type'=>$type,'status'=>$status]);

            $page = View('admin.users.admin_usersAll',['users' =>$data, 'q'=>$q, 'status' => $status])->render();

            
        }

        //category search
        // if($type == 'categoryss')
        // {
        //      $data = Category::where(function($query)use($q){
        //         $query->where('name', 'like', "%$q%");
        //      })->latest()->paginate(100)->appends(['q'=> $q,'type'=>$type,'status'=>$status]);

        //     $page = View('user.softmarkets.includes.ajaxdatacontainer',['category' =>$data, 'q'=>$q, 'status' => $status])->render();

            
        // }
        

        if($request->ajax())
        {
            return Response()->json(array(
            'success' => true,
            'type' => $type,
            'page' => $page,
            ));
        }
    }
    

}
