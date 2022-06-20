<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Hash;
use DB;
use Session;
use Validator;

use App\Models\Size;
use App\Models\Unit;
use App\Models\Color;
use App\Models\Category;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Postoffice;

class AdminProductVariationController extends Controller
{
     public function createunit()
    {
        $categories=Category::orderBy('name')->get();
        menuSubmenu('variations', 'units');
        return view('admin.unit.create',compact('categories'));
    }
    public function storeunit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sval' => 'required',
            'cat_id' => 'required'
        ]);
        $data = new Unit;
        $data->name = $request->name;
        $data->sval = $request->sval;
        $data->cat_id = $request->cat_id;
       // $data->description = $request->description;
        $data->save();
        return redirect()->back()->with('success', 'Units Added Successfully');
        
    }
    public function editunit($id)
    {
        menuSubmenu('variations', 'units');
        $categories=Category::whereIn('work_station_id',[9,12])->orderBy('name')->get();
        $data = Unit::find($id);
        if (!$data) {
            return redirect()->back()->with('warning', 'No Unit Found');
        }
        return view('admin.unit.edit',compact('data','categories')); 
    }
    public function updateunit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sval' => 'required',
            'cat_id' => 'required'

        ]);
        $data = Unit::where('id',$request->id)->first();
        $data->name = $request->name;
        $data->sval = $request->sval;
        $data->cat_id = $request->cat_id;
       // $data->description = $request->description;
        $data->save();
        return redirect()->back()->with('success', 'Units Update Successfully');
    }
    public function deleteunit($id)
    {
        $data = Unit::where('id',$id)->first();
        $data->delete();
        return redirect()->back()->with('success', 'Units Delete Successfully');
        
    }
    public function listunit()
    {
        menuSubmenu('variations', 'units');
        $units = Unit::latest()->paginate(20);

        return view('admin.unit.index', [
            'units' => $units
        ]);
    }


    //size



    public function createsize()
    {
        $categories=Category::whereIn('work_station_id',[9,12])->orderBy('name')->get();
        menuSubmenu('variations', 'sizes');
        return view('admin.size.create',compact('categories'));
    }
    public function storesize(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sval' => 'required',
            'cat_id' => 'required'
            
        ]);
        $data = new Size;
        $data->name = $request->name;
        $data->sval = $request->sval;
        $data->cat_id = $request->cat_id;
        //$data->description = $request->description;
        $data->save();
        return redirect()->back()->with('success', 'Sizes Added Successfully');
        
    }
    public function editsize($id)
    {
        menuSubmenu('variations', 'sizes');
        $categories=Category::whereIn('work_station_id',[9,12])->orderBy('name')->get();
        $data = Size::find($id);
        if (!$data) {
            return redirect()->back()->with('warning', 'No Size Found');
        }
        return view('admin.size.edit',compact('data','categories')); 
    }
    public function updatesize(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sval' => 'required',
            'cat_id' => 'required'
        ]);
        $data = Size::where('id',$request->id)->first();
        $data->name = $request->name;
        $data->sval = $request->sval;
        $data->cat_id = $request->cat_id;
       // $data->description = $request->description;
        $data->save();
        return redirect()->back()->with('success', 'Sizes Update Successfully');
    }
    public function deletesize($id)
    {
        $data = Size::where('id',$id)->first();
        $data->delete();
        return redirect()->back()->with('success', 'Sizes Delete Successfully');
        
    }
    public function listsize()
    {
        menuSubmenu('variations', 'sizes');
        $sizes = Size::latest()->paginate(20);

        return view('admin.size.index', [
            'sizes' => $sizes
        ]);
    }



    //color 


    public function createcolor()
    {
        menuSubmenu('variations', 'colors');
        return view('admin.color.create');
    }
    public function storecolor(Request $request)
    {
        $request->validate([
            'name' => 'required |unique:colors,name',
            'sval' => 'required |unique:colors,sval'
        ]);
        $data = new Color;
        $data->name = $request->name;
        $data->sval = $request->sval;
        $data->description = $request->description;
        $data->save();
        return redirect()->back()->with('success', 'Colors Added Successfully');
        
    }
    public function editcolor($id)
    {
        menuSubmenu('variations', 'colors');
        $data = Color::find($id);
        if (!$data) {
            return redirect()->back()->with('warning', 'No color Found');
        }
        return view('admin.color.edit',compact('data')); 
    }
    public function updatecolor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sval' => 'required'
        ]);
        $data = Color::where('id',$request->id)->first();
        $data->name = $request->name;
        $data->sval = $request->sval;
        $data->description = $request->description;
        $data->save();
        return redirect()->back()->with('success', 'Colors Update Successfully');
    }
    public function deletecolor($id)
    {
        $data = Color::where('id',$id)->first();
        $data->delete();
        return redirect()->back()->with('success', 'Colors Delete Successfully');
        
    }
    public function listcolor()
    {
        menuSubmenu('variations', 'colors');
        $colors = Color::latest()->paginate(20);

        return view('admin.color.index', [
            'colors' => $colors
        ]);
    }


    //district 


    public function createdistrict()
    {
        menuSubmenu('variations', 'districts');
        return view('admin.district.create');
    }
    public function storedistrict(Request $request)
    {
        $request->validate([
            'name' => 'required |unique:districts,name'
        ]);
        $data = new District;
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->save();
        return redirect()->back()->with('success', 'Districts Added Successfully');
        
    }
    public function editdistrict($id)
    {
        menuSubmenu('variations', 'districts');
        $data = District::find($id);
        if (!$data) {
            return redirect()->back()->with('warning', 'No District Found');
        }
        return view('admin.district.edit',compact('data')); 
    }
    public function updatedistrict(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $data = District::where('id',$request->id)->first();
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->save();
        return redirect()->back()->with('success', 'Districts Update Successfully');
    }
    public function deletedistrict($id)
    {
        $data = District::where('id',$id)->first();
        $data->delete();
        return redirect()->back()->with('success', 'Districts Delete Successfully');
        
    }
    public function listdistrict()
    {
        menuSubmenu('variations', 'districts');
        $districts = District::latest()->paginate(20);

        return view('admin.district.index', [
            'districts' => $districts
        ]);
    }

    //Thana


    public function createthana()
    {
        menuSubmenu('variations', 'thanas');
        $districts = District::get();
        return view('admin.thana.create',compact('districts'));
    }
    public function storethana(Request $request)
    {
        $request->validate([
            'name' => 'required |unique:upazilas,name',
            'district_id' => 'required'
        ]);
        $data = new Upazila;
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->district_id = $request->district_id;
        $data->save();
        return redirect()->back()->with('success', 'Thanas Added Successfully');
        
    }
    public function editthana($id)
    {
        menuSubmenu('variations', 'thanas');
        $data = Upazila::find($id);
        $districts = District::get();
        if (!$data) {
            return redirect()->back()->with('warning', 'No Thana Found');
        }
        return view('admin.thana.edit',compact('data','districts')); 
    }
    public function updatethana(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $data = Upazila::where('id',$request->id)->first();
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->district_id = $request->district_id;
     
        $data->save();
        return redirect()->back()->with('success', 'Thanas Update Successfully');
    }
    public function deletethana($id)
    {
        $data = Upazila::where('id',$id)->first();
        $data->delete();
        return redirect()->back()->with('success', 'Thanas Delete Successfully');
        
    }
    public function listthana()
    {
        menuSubmenu('variations', 'thanas');
        $thanas = Upazila::latest()->paginate(20);

        return view('admin.thana.index', [
            'thanas' => $thanas
        ]);
    }
     //Post Office


     public function createpostoffice()
     {
         menuSubmenu('variations', 'postoffices');
         $thanas = Upazila::get();
         return view('admin.postoffice.create',compact('thanas'));
     }
     public function storepostoffice(Request $request)
     {
         $request->validate([
             'name' => 'required |unique:postoffices,name',
             'thana_id' => 'required',
             'code' => 'required',
         ]);
         $data = new Postoffice;
         $data->name = $request->name;
         $data->bn_name = $request->bn_name;
         $data->code = $request->code;
         $data->thana_id = $request->thana_id;
         $data->save();
         return redirect()->route('admin.listpostoffice')->with('success', 'Post Offices Added Successfully');
         
     }
     public function editpostoffice($id)
     {
         menuSubmenu('variations', 'postoffices');
         $data = Postoffice::find($id);
         $thanas = Upazila::get();
         if (!$data) {
             return redirect()->back()->with('warning', 'No Post Office Found');
         }
         return view('admin.postoffice.edit',compact('data','thanas')); 
     }
     public function updatepostoffice(Request $request)
     {
         $request->validate([
             'name' => 'required',
             'thana_id' => 'required',
             'code' => 'required'
         ]);
         $data = Postoffice::where('id',$request->id)->first();
         $data->name = $request->name;
         $data->bn_name = $request->bn_name;
         $data->code = $request->code;
         $data->thana_id = $request->thana_id;
      
         $data->save();
         return redirect()->route('admin.listpostoffice')->with('success', 'Post Office Update Successfully');
     }
     public function deletepostoffice($id)
     {
         $data = Postoffice::where('id',$id)->first();
         $data->delete();
         return redirect()->route('admin.listpostoffice')->with('success', 'Post Office Delete Successfully');
         
     }
     public function listpostoffice()
     {
         menuSubmenu('variations', 'postoffices');
         $postoffices = Postoffice::latest()->paginate(20);
 
         return view('admin.postoffice.index', [
             'postoffices' => $postoffices
         ]);
     }
}
