<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use DB;
use Session;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\SpecialLink;
use App\Models\SpecialCategory;
use App\Models\WorkStation;
use App\Models\ValuedCustomer;
use App\Models\TopPrio;
use App\Models\DeliveryMan;
use App\Models\ServiceProfile;
use App\Models\SoftcomApplicantCategory;
use GuzzleHttp\Exception\GuzzleException;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use DateTime;
use Image;

class AdminSetupController extends Controller
{
    //Special Link
    public function createspeciallink()
    {
        menuSubmenu('variations', 'speciallinks');
        return view('admin.speciallink.create');
    }
    public function storespeciallink(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'linktype' => 'required |unique:special_links,linktype',
        ]);
        $data = new SpecialLink;
        $data->title = $request->title;
        $data->linktype = $request->linktype;
        $data->link = $request->link;
        $data->save();
        return redirect()->route('admin.listspeciallink')->with('success', 'Special Link Added Successfully');
        
    }
    public function editspeciallink($id)
    {
        menuSubmenu('variations', 'speciallinks');
        $data = SpecialLink::find($id);
        //dd($data);
        if (!$data) {
            return redirect()->back()->with('warning', 'No Special Link Found');
        }
        return view('admin.speciallink.edit',compact('data')); 
    }
    public function updatespeciallink(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'linktype' => 'required |unique:special_links,linktype',
        ]);
        $data = SpecialLink::where('id',$request->id)->first();
        $data->title = $request->title;
        $data->linktype = $request->linktype;
        $data->link = $request->link;
        $data->save();
        return redirect()->route('admin.listspeciallink')->with('success', 'Special Link Update Successfully');
    }
    public function deletespeciallink($id)
    {
        $data = SpecialLink::where('id',$id)->first();
        $data->delete();
        return redirect()->route('admin.listspeciallink')->with('success', 'Special Link Delete Successfully');
        
    }
    public function listspeciallink()
    {
        menuSubmenu('variations', 'speciallinks');
        $datas = SpecialLink::latest()->paginate(20);

        return view('admin.speciallink.index', [
            'datas' => $datas
        ]);
    }


    //Special Category
    public function createspecialcategory()
    {
        menuSubmenu('variations', 'specialcategories');
        $workstation = WorkStation::where('active', true)->get();
        return view('admin.specialcategory.create',compact('workstation'));
    }
    public function storespecialcategory(Request $request)
    {
        $request->validate([
            'category' => 'required |unique:special_categories,category',
        ]);
        $data = new SpecialCategory;
        $data->category = $request->category;
        $data->workstation = $request->workstation;
        $data->save();
        return redirect()->route('admin.listspecialcategory')->with('success', 'Special Category Added Successfully');
        
    }
    public function editspecialcategory($id)
    {
        menuSubmenu('variations', 'specialcategories');
        $data = SpecialCategory::find($id);
        //dd($data);
        if (!$data) {
            return redirect()->back()->with('warning', 'No Special Category Found');
        }
        return view('admin.specialcategory.edit',compact('data')); 
    }
    public function updatespecialcategory(Request $request)
    {
        $request->validate([
            'category' => 'required |unique:special_categories,category',
        ]);
        $data = SpecialCategory::where('id',$request->id)->first();
        $data->category = $request->category;
        $data->workstation = $request->workstation;
        $data->save();
        return redirect()->route('admin.listspecialcategory')->with('success', 'Special Category Update Successfully');
    }
    public function deletespecialcategory($id)
    {
        $data = SpecialCategory::where('id',$id)->first();
        $data->delete();
        return redirect()->route('admin.listspecialcategory')->with('success', 'Special Category Delete Successfully');
        
    }
    public function listspecialcategory()
    {
        menuSubmenu('variations', 'specialcategories');
        $datas = SpecialCategory::latest()->paginate(20);
        //dd( $datas);

        return view('admin.specialcategory.index', [
            'datas' => $datas
        ]);
    }

     //------------fardeen code --------------//
    
     public function addValuedCustomers()
     {
        menuSubmenu('valuedcustomer', 'valuedcustomercreate');
         
     
         return view('admin.valuedCustomer.addValuedCustomer');
     }
     
     public function valuedCustomers()
     {
        menuSubmenu('valuedcustomer', 'valuedcustomerlist');
         
         $customerList = ValuedCustomer::all(); 
 
         return view('admin.valuedCustomer.valuedCustomerList',compact('customerList'));
     }
 
     public function storeValuedCustomer(Request $request)
     {
        
        // dd($request->name);
         $userNew = new ValuedCustomer();
         
         $userNew->name = $request->name;
         $userNew->comment = $request->comment;
         $userNew->link = $request->link;
         $userNew->type = $request->type;
         $userNew->addedby_id = Auth::user()->id;
      
         $userNew->save();
         if ($pi = $request->image) {
             $f = 'valuedcustomer/' . $userNew->image;
             if (Storage::disk('public')->exists($f)) {
                 Storage::disk('public')->delete($f);
             }
             $extension = strtolower($pi->getClientOriginalExtension());
             $randomFileName = $userNew->id. '_valuedcustomerimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;
     
             list($width, $height) = getimagesize($pi);
             $mime = $pi->getClientOriginalExtension();
             $size = $pi->getSize();
     
             $originalName = strtolower($pi->getClientOriginalName());
     
             Storage::disk('public')->put('valuedcustomer/' . $randomFileName, File::get($pi));
     
             $userNew->image = $randomFileName;
             
              $userNew->save();
         }
 

         Session::flash('msg','User Successfully created'); 
         return redirect()->route('admin.addValuedCustomer');
        
 
         
     }
 

     public function deleteValuedCustomer($id=null)
     {
         $data = ValuedCustomer::where('id',$id)->first();
         // $f = 'img/' . $data->image;
         // if (Storage::disk('public')->exists($f)) {
         //     Storage::disk('public')->delete($f);
         // }
         $data->delete();
         return redirect()->route('admin.valuedCustomerList')->with('success', 'Deleted Successfully');
         
     }
 
     public function editValuedCustomer($id=null)
     {
        menuSubmenu('valuedcustomer', 'valuedcustomerlist');
         $editData = ValuedCustomer::find($id); 
 
         return view('admin.valuedCustomer.editValuedCustomer',compact('editData'));
         
     }
 
     public function storeEditedValuedCustomer(Request $request, $id )
     {
         
         $userNew = ValuedCustomer::find($id);
         $userNew->name = $request->name;
         $userNew->comment = $request->comment;
         $userNew->link = $request->link;
         $userNew->type = $request->type;
         $userNew->addedby_id = Auth::user()->id;
         $userNew->save();
         if ($pi = $request->image) {
             $f = 'valuedcustomer/' . $userNew->image;
             if (Storage::disk('public')->exists($f)) {
                 Storage::disk('public')->delete($f);
             }
             $extension = strtolower($pi->getClientOriginalExtension());
             $randomFileName = $userNew->id. '_valuedcustomerimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;
     
             list($width, $height) = getimagesize($pi);
             $mime = $pi->getClientOriginalExtension();
             $size = $pi->getSize();
     
             $originalName = strtolower($pi->getClientOriginalName());
     
             Storage::disk('public')->put('valuedcustomer/' . $randomFileName, File::get($pi));
     
             $userNew->image = $randomFileName;
             
              $userNew->save();
         }
       


         Session::flash('msg','Data Successfully Updated'); 
         return redirect()->route('admin.valuedCustomerList');
        
         
     }
 
 
     public function addTopPriorities()
     {
         menuSubmenu('toppriority', 'topprioritycreate');
         $service_station = ServiceProfile::all();
         return view('admin.topPriority.addTopPriority', compact('service_station'));
     }
     
     public function allPriority()
     {
        menuSubmenu('toppriority', 'topprioritylist');
         $priorityList = TopPrio::all(); 
 
         return view('admin.topPriority.topPriorityList',compact('priorityList'));
     }
 
     public function storeTopPriority(Request $request)
     {
         $rules = [
             
             'name' => 'required|max:50|min:2',
             
             
         ];
 
         // //cm = custom message (for validation)
 
          $cm = [
         
         'name.required' =>'Enter your first name',
         'name.max' =>"Your name must not contain more than 10 characters",
         'name.min' =>"Your name must  contain at least 3 characters",
         
         ];
 
          $this->validate($request, $rules, $cm);
         
        // dd($request->name);
         $userNew = new TopPrio();
         $userNew->name = $request->name;
         $userNew->comment = $request->comment;
         $userNew->link = $request->link;
         $userNew->from = $request->from;
         $userNew->to = $request->to;
         $userNew->service_profile = $request->service_profile;
         $userNew->addedby_id = Auth::user()->id;
         $userNew->save();
         if ($pi = $request->image) {
             $f = 'toppriority/' . $userNew->image;
             if (Storage::disk('public')->exists($f)) {
                 Storage::disk('public')->delete($f);
             }
             $extension = strtolower($pi->getClientOriginalExtension());
             $randomFileName = $userNew->id. '_toppriorityimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;
     
             list($width, $height) = getimagesize($pi);
             $mime = $pi->getClientOriginalExtension();
             $size = $pi->getSize();
     
             $originalName = strtolower($pi->getClientOriginalName());
     
             Storage::disk('public')->put('toppriority/' . $randomFileName, File::get($pi));
     
             $userNew->image = $randomFileName;
             
              $userNew->save();
         }
      
 
 
      
         Session::flash('msg','USer Successfully created'); 
         return redirect()->route('admin.addTopPriority');
        
         
     }
     public function deleteTopPriority($id=null)
     {
         $data = TopPrio::where('id',$id)->first();
         // $f = 'img/' . $data->image;
         // if (Storage::disk('public')->exists($f)) {
         //     Storage::disk('public')->delete($f);
         // }
         $data->delete();
         return redirect()->route('admin.topPriorityList')->with('success', 'Deleted Successfully');
         
     }
     
     public function editTopPriority($id=null)
     {
        menuSubmenu('toppriority', 'topprioritylist');
         $editData = TopPrio::find($id);
         $service_station = ServiceProfile::all(); 
     
         return view('admin.topPriority.editTopPriority',compact('editData','service_station'));
         
     }
     
     public function storeEditedTopPriority(Request $request, $id )
     {
         
         $userNew = TopPrio::find($id);
 
         $userNew->name = $request->name;
         $userNew->comment = $request->comment;
         $userNew->link = $request->link;
         $userNew->from = $request->from;
         $userNew->to = $request->to;
         $userNew->service_profile = $request->service_profile;
         $userNew->save();
 
         if ($pi = $request->image) {
             $f = 'toppriority/' . $userNew->image;
             if (Storage::disk('public')->exists($f)) {
                 Storage::disk('public')->delete($f);
             }
             $extension = strtolower($pi->getClientOriginalExtension());
             $randomFileName = $userNew->id. '_toppriorityimg_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;
     
             list($width, $height) = getimagesize($pi);
             $mime = $pi->getClientOriginalExtension();
             $size = $pi->getSize();
     
             $originalName = strtolower($pi->getClientOriginalName());
     
             Storage::disk('public')->put('toppriority/' . $randomFileName, File::get($pi));
     
             $userNew->image = $randomFileName;
             
              $userNew->save();
         }
      
      
 
 
     
         Session::flash('msg','Data Successfully updated'); 
         return redirect()->route('admin.topPriorityList');
        
         
     }
     
 
 
     //---------------------------------------------



      //Add Softcom Applicant Category
    public function createapplicantcategory()
    {
        menuSubmenu('softcomapplication', 'softcomapplicantcategory');
        return view('admin.applicantcategory.create');
    }
    public function storeapplicantcategory(Request $request)
    {
        $request->validate([
            'name' => 'required |unique:softcom_applicant_categories,name',
            'service_charge' => 'required',
            'salary_type'=>'required'
        ]);
        //dd($request->all());
        $data = new SoftcomApplicantCategory;
        $data->name = $request->name;
        $data->salary_type = $request->salary_type;
        $data->service_charge = $request->service_charge;
        $data->salary_amount = $request->salary_amount;
        $data->total_amount = $request->salary_amount+ $request->service_charge;
        $data->type = 'SoftCommerce';
        $data->added_by = Auth::user()->id;
        $data->save();
        return redirect()->route('admin.listapplicantcategory')->with('success', 'Applicant Category Added Successfully');
        
    }
    public function editapplicantcategory($id)
    {
        menuSubmenu('softcomapplication', 'softcomapplicantcategory');
        $data = SoftcomApplicantCategory::find($id);
        //dd($data);
        if (!$data) {
            return redirect()->back()->with('warning', 'No Applicant Category Found');
        }
        return view('admin.applicantcategory.edit',compact('data')); 
    }
    public function updateapplicantcategory(Request $request)
    {
        $data = SoftcomApplicantCategory::where('id',$request->id)->first();
        $request->validate([
            'name' => 'required |unique:softcom_applicant_categories,name,'.$data->id,
            'service_charge' => 'required',
            'salary_type'=>'required'
        ]);
       
        $data->name = $request->name;
        $data->salary_type = $request->salary_type;
        $data->service_charge = $request->service_charge;
        $data->salary_amount = $request->salary_amount;
        $data->total_amount = $request->salary_amount + $request->service_charge;
        $data->save();
        return redirect()->route('admin.listapplicantcategory')->with('success', 'Applicant Category Update Successfully');
    }
    public function deleteapplicantcategory($id)
    {
        $data = SoftcomApplicantCategory::where('id',$id)->first();
        $data->delete();
        return redirect()->route('admin.listapplicantcategory')->with('success', 'Applicant Category Delete Successfully');
        
    }
    public function listapplicantcategory()
    {
        menuSubmenu('softcomapplication', 'softcomapplicantcategory');
        $datas = SoftcomApplicantCategory::latest()->paginate(20);

        return view('admin.applicantcategory.index', [
            'datas' => $datas
        ]);
    }

    public function listdeliveryman()
    {
        menuSubmenu('variations', 'delivery');
        // $user = Auth::user();
        $data = DeliveryMan::latest()->paginate(5);

        return view('admin.deliveryman.index',compact('data'));
    }

    public function createdeliveryman()
    {
        menuSubmenu('variations', 'delivery');
        return view('admin.deliveryman.create');
    }

    public function storedeliveryman(Request $request)
    {
        $request->validate([
            'name' => 'required',
            //'phone' => 'required |unique:deliverymans,phone',
            'nid' => 'required',
        ]);
       
        $data = new DeliveryMan;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->type = $request->type;
        $data->email = $request->email;
        $data->nid = $request->nid;
        $data->address = $request->address;
        $data->area = $request->area;
        

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
       
        return redirect()->route('admin.listdeliveryman')->with('success', 'Delivery Man Added Successfully');
        
    }
    public function editdeliveryman($id)
    {
        menuSubmenu('delivery', 'delivery');
        $data = DeliveryMan::find($id);
        return view('admin.deliveryman.edit',compact('data')); 
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
        $data->type = $request->type;
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
            
            Image::make($pi)->fit(160, 160, function ($constraint) {
                $constraint->aspectRatio();
            })->save( Storage::disk('public')->put('user/deliveryman/' . $randomFileName, File::get($pi)));

           

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

            Image::make($ni)->fit(160, 160, function ($constraint) {
                $constraint->aspectRatio();
            })->save( Storage::disk('public')->put('user/deliveryman/' . $randomFileName, File::get($ni)));

            $data->nid_image = $randomFileName;
            $data->save();
        }
        return redirect()->route('admin.listdeliveryman')->with('success', 'Delivery Man Update Successfully');
    }


    public function deletedeliveryman($id)
    {
        $data = DeliveryMan::where('id',$id)->first();
        $f = 'user/deliveryman/' . $data->image;
        if (Storage::disk('public')->exists($f)) {
            Storage::disk('public')->delete($f);
        }
        $data->delete();
        return redirect()->route('admin.listdeliveryman')->with('success', 'Delivery Man Delete Successfully');
        
    }




}
