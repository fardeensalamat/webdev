<?php

namespace App\Http\Controllers\Admin\Outlets;

use Auth;
use Cache;
use Hash;
use Validator;
use App\Models\Outlet;
use App\Models\Upazila;
use App\Models\Division;
use App\Models\District;
use App\Models\BrandOutlet;
use App\Models\ProductBrand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminOutletController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'outlets','lsbsm'=>'outlets']);

        $divisions = Division::select(['id', 'name'])->orderBy('name')->get();
        $districts = District::select(['id', 'name', 'division_id'])->orderBy('name')->get();
        $thanas = Upazila::select(['id', 'name','district_id', 'division_id'])->orderBy('name')->get(); 

        $outlets = Outlet::latest()->paginate(100);

        $brands = ProductBrand::where('active',1)->get();

        return view('admin.outlets.outletAll',[
            'divisions' => $divisions,
            'districts' => $districts->toArray(),
            'thanas' => $thanas->toArray(),
            'outlets' => $outlets,
            'brands' => $brands
        ]);
    }

    public function outletPost(Request $request)
    {
        // dd($request->all());
        
        $validation = Validator::make($request->all(),
        [ 
            'load_division'=> 'required',
            'load_district' => 'required',
            'load_thana' => 'required',
            'name' => 'required',
            'mobile' => 'required | unique:outlets',
            'address' => 'required'
        ]);

        if($validation->fails())
        {
            if($request->ajax()){
                return Response()->json([
                    'success' => false,
                    'sessionError' => 'something went wrong',
                    'errors' => $validation->errors()->toArray()
                ]);
            }
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }

        $outlet = new Outlet;

        $outlet->name = $request->name;
        $outlet->mobile = $request->mobile;
        $outlet->address = $request->address;
        $outlet->code = $request->code;
        $outlet->district_id = $request->load_district;
        $outlet->division_id = $request->load_division;
        $outlet->thana_id = $request->load_thana;
        $outlet->save();

        if(isset($request->brands))
        {
            foreach($request->brands as $brand)
            {
                $c = BrandOutlet::where('brand_id',$brand)
                ->where('outlet_id',$outlet->id)
                ->first();
                
                if(!$c)
                {
                   $c = new BrandOutlet;
                   $c->brand_id = $brand;
                   $c->outlet_id = $outlet->id;
                   $c->addedby_id = Auth::id();
                   $c->save();
                }
            }
        }

        $outlets = Outlet::latest()->paginate(100);
        if($request->ajax())
        {
            return Response()->json([
                'success' => true,
                'page'=> View('admin.outlets.includes.outletsList',[
                    'outlets' => $outlets 
                ])->render() 
            ]);
        }
        return redirect()->back()->with('success','Outlet Created Successfully.')->withInput();

    }

    public function outletUpdateInfo(Outlet $outlet,Request $request)
    {
        // dd($request->all());

        $validation = Validator::make($request->all(),
        [ 
            'load_division'=> 'required',
            'load_district' => 'required',
            'load_thana' => 'required',
            'name' => 'required',
            // 'mobile' => 'required | unique:outlets',
            'address' => 'required'
        ]);

        if($validation->fails())
        {
            if($request->ajax()){
                return Response()->json([
                    'success' => false,
                    'sessionError' => 'something went wrong',
                    'errors' => $validation->errors()->toArray()
                ]);
            }
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }

        $outlet->name = $request->name;
        $outlet->mobile = $request->mobile;
        $outlet->address = $request->address;
        $outlet->code = $request->code;
        $outlet->district_id = $request->load_district;
        $outlet->division_id = $request->load_division;
        $outlet->thana_id = $request->load_thana;
        $outlet->save();

        $outlet->brands()->detach();

        if(isset($request->brands))
        {
            foreach($request->brands as $brand)
            {
                $c = BrandOutlet::where('brand_id',$brand)
                ->where('outlet_id',$outlet->id)
                ->first();
                
                if(!$c)
                {
                   $c = new BrandOutlet;
                   $c->brand_id = $brand;
                   $c->outlet_id = $outlet->id;
                   $c->addedby_id = Auth::id();
                   $c->save();
                }
            }
        }

        if($request->ajax())
        {
            return Response()->json([
                'success' => true,
                'page'=> View('admin.outlets.parts.outletEdit') 
            ]);
        }
        return redirect()->back()->with('success','Outlet information Updated Successfully.')->withInput();

    }

    public function outletEdit(Outlet $outlet)
    {
        $request = request();
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'outlets','lsbsm'=>'outlets']);
        $divisions = Division::select(['id', 'name'])->orderBy('name')->get();
        $districts = District::select(['id', 'name', 'division_id'])->orderBy('name')->get();
        $thanas = Upazila::select(['id', 'name','district_id', 'division_id'])->orderBy('name')->get(); 

        $brands = ProductBrand::where('active',1)->get();

        return view('admin.outlets.outletEdit',[
            'divisions' => $divisions,
            'districts' => $districts->toArray(),
            'thanas' => $thanas->toArray(),
            'brands' => $brands,
            'outlet' => $outlet
        ]);
    }

    public function outletDelete(Outlet $outlet)
    {
        $outlet->items()->delete();
        $outlet->delete();
        return redirect()->back()->with('success','Outlet Deleted Successfully.')->withInput();
    }
}
