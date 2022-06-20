<?php

namespace App\Http\Controllers\Admin\Honorarium;

use Auth;
use Validator;
use App\Models\WorkStation;
use App\Models\Honorarium;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminHonorariumController extends Controller
{
    public function addhonorarium(Request $request)
    {
        if(!Auth::user()->hasPermission('subscriber_honorarium'))
        {
            abort(401);
        }
        $station = '';
        if($request->ws)
        {
            $station = $request->ws;
        }
        
        menuSubmenu('honorarium','addhonorarium');
        $workstations = WorkStation::all();
        return view('admin.honorariums.create',[
            'workstations' => $workstations,
            'station' => $station
        ]);
    }

    public function addHonorariumPost(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'title' => ['required','string', 'max:255','min:2'],
            'commission' => ['numeric'],
            'payment_duration' => ['numeric', 'nullable'],
            'workstaion' => ['required', 'numeric'],
            'active'=> ['nullable'],
            'workorder_upto_amount'=> ['nullable']
        ]);
        
        if($validation->fails())
        {

            return back()
            ->withInput()
            ->withErrors($validation);
        }

        $hm = new Honorarium;
        
        $hm->title = $request->title;
        $hm->description =$request->description;
        $hm->workstation_id = $request->workstaion;
        $hm->system_type = $request->system_type;
        $hm->earning_type = $request->earning_type;
        $hm->commission = $request->commission; 
        $hm->workorder_upto_amount = $request->workorder_upto_amount ?: 0;
        $hm->payment_duration = $request->payment_duration ? : 0;
        $hm->active = $request->active ? '1' : '0';    
        $hm->addedby_id = Auth::id();
        $hm->save();

        return back()->with('success','New Honorarium Added Successfully.');
        
    }

    public function honorarialist()
    {
        if(!Auth::user()->hasPermission('subscriber_honorarium'))
        {
            abort(401);
        }
        menuSubmenu('honorarium','honorarialist');

        $honoraria = Honorarium::orderBy('workstation_id','asc')->paginate(30);
        return view('admin.honorariums.honorariaList',[
            'honoraria' => $honoraria
        ]);
    }

    public function honorariumEdit(Honorarium $honorarium)
    {
        if(!Auth::user()->hasPermission('workstation'))
        {
            abort(401);
        }
        menuSubmenu('honorarium','addhonorarium');
        $workstations = WorkStation::all();
        return view('admin.honorariums.edit',[
            'workstations' => $workstations,
            'honorarium' => $honorarium
        ]);
    }

    public function honorariumUpdate(Honorarium $honorarium, Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'title' => ['required','string', 'max:255','min:2'],
            'commission' => ['numeric'],
            'payment_duration' => ['numeric'],
            'active'=> ['nullable'],
            'earning_type' => 'required'

        ]);
        
        if($validation->fails())
        {

            return back()
            ->withInput()
            ->withErrors($validation);
        }
        // dd($request->all());
        $honorarium->title = $request->title;
        $honorarium->description =$request->description;
        $honorarium->workstation_id = $request->workstaion;
        $honorarium->system_type = $request->system_type;
        $honorarium->earning_type = $request->earning_type;
        $honorarium->commission = $request->commission;
        $honorarium->workorder_upto_amount = $request->workorder_upto_amount ?: 0;
        $honorarium->payment_duration = $request->payment_duration;
        $honorarium->active = $request->active ? '1' : '0';    
        $honorarium->editedby_id = Auth::id();
        $honorarium->save();

        // return back()->with('success','Honorarium Updated Successfully.');
        return redirect()->route('admin.honorarialist')->with('success','Honorarium Updated Successfully.');
    }

    public function honorariumDelete(Honorarium $honorarium)
    {
        if(!Auth::user()->hasPermission('workstation'))
        {
            abort(401);
        }
        $honorarium->delete();
        return back()->with('warning','Honorarium Deleted Successfully.');
    }

    public function HonorariaLists(WorkStation $workstation)
    {
        if(!Auth::user()->hasPermission('workstation'))
        {
            abort(401);
        }
        $honoraria = Honorarium::where('workstation_id',$workstation->id)->latest()->paginate(10);

        
        return view('admin.workStations.honorariaList',[
            'honoraria' => $honoraria,
            'workstation' => $workstation
        ]);
    }
}
