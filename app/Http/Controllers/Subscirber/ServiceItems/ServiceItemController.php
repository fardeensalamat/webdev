<?php

namespace App\Http\Controllers\Subscirber\ServiceItems;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceItemRequest;
use App\Models\Serviceitem;
use App\Models\ServiceProfile;
use App\Models\Subscriber;
use Auth;
use DB;
use Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ServiceItemController extends Controller
{
  public function newServiceItem(Request $request)
  {

    $request = request();
    $request->session()->forget(['lsbm', 'lsbsm']);
    $request->session()->put(['lsbm' => 'job', 'lsbsm' => 'newServiceItem']);

    $serviceProfile = ServiceProfile::find($request->profile);
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$serviceProfile || !$subscription) {
      abort(404);
    }
    $profile = ServiceProfile::where('id', $request->profile)->first();
    return view('subscriber.serviceItems.addServiceItems', compact('subscription', 'serviceProfile','profile'));
  }

  public function storeServiceItem(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:250',
      'excerpt' => 'required|string|max:250',
      'description' => 'required',
      'price' => 'required|numeric',
      'negotiations' => 'nullable',
      'image'=>'required|mimes:jpg,bmp,png'
    ]);
    $serviceProfile = ServiceProfile::find($request->profile);
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$serviceProfile || !$subscription) {
      abort(404);
    }

    $user = Auth::user();
    $serviceItem = new Serviceitem;
    $serviceItem->user_id = $user->id;
    $serviceItem->service_profile_id = $serviceProfile->id;
    $serviceItem->category_id = $serviceProfile->category->id;
    $serviceItem->workstation_id = $serviceProfile->workstation->id;
    $serviceItem->subscriber_id = $subscription->id;
    $serviceItem->title = $request->title;
    $serviceItem->excerpt = $request->excerpt;
    $serviceItem->description = $request->description;
    $serviceItem->price = $request->price;
    $serviceItem->negotiations = $request->negotiations ? 1 : 0;
    $serviceItem->active = $request->active ? 1 : 0;
    $serviceItem->addedby_id = Auth::id();
    $serviceItem->save();
    if ($cp = $request->image) {
      $f = 'product/serviceitems/' . $serviceItem->image;
      if (Storage::disk('public')->exists($f)) {
        Storage::disk('public')->delete($f);
      }

      $extension = strtolower($cp->getClientOriginalExtension());
      $randomFileName = $serviceItem->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

      $originalName = strtolower($cp->getClientOriginalName());

      Storage::disk('public')->put('product/serviceitems/' . $randomFileName, File::get($cp));

      $serviceItem->image = $randomFileName;
      $serviceItem->save();
    }

    // $serviceI= Serviceitem::create($request->validated());
    return redirect()->back()->with('success', 'Service item Successfully Added');
  }
  public function allServiceItems(Request $request)
  {

    $request = request();
    $request->session()->forget(['lsbm', 'lsbsm']);
    $request->session()->put(['lsbm' => 'job', 'lsbsm' => 'allServiceItems']);

    $serviceProfile = ServiceProfile::find($request->profile);
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$serviceProfile || !$subscription) {
      abort(404);
    }
    $profile = ServiceProfile::where('id', $request->profile)->first(); 		
    $serviceItems = Serviceitem::with('user', 'category', 'workstation')->where('service_profile_id', $request->profile)->where('status', 'approved')->where('active', true)->get();
    return view('subscriber.serviceItems.allServiceProfileitems', compact('serviceItems', 'serviceProfile', 'subscription','profile'));
  }
  public function editServiceItems(Request $request)
  {
    $serviceProfile = ServiceProfile::find($request->profile);
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$serviceProfile || !$subscription) {
      abort(404);
    }
    $serviceItem = Serviceitem::where('id', $request->item)
      ->first();
    return view('subscriber.serviceItems.editServiceItem', compact('serviceItem', 'serviceProfile', 'subscription'));
  }
  public function updateServiceItems(ServiceItemRequest $request)
  {
    $serviceProfile = ServiceProfile::find($request->profile);
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
    if (!$serviceProfile || !$subscription) {
      abort(404);
    }
    $serviceItem = Serviceitem::where('id', $request->item)
      ->first();
    $serviceItem->title = $request->title;
    $serviceItem->excerpt = $request->excerpt;
    $serviceItem->description = $request->description;
    $serviceItem->price = $request->price;
    $serviceItem->negotiations = $request->negotiations ? 1 : 0;
    $serviceItem->active = $request->active ? 1 : 0;
    $serviceItem->addedby_id = Auth::id();
    $serviceItem->save();
    if ($cp = $request->image) {
      $f = 'product/serviceitems/' . $serviceItem->image;
      if (Storage::disk('public')->exists($f)) {
        Storage::disk('public')->delete($f);
      }

      $extension = strtolower($cp->getClientOriginalExtension());
      $randomFileName = $serviceItem->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

      $originalName = strtolower($cp->getClientOriginalName());

      Storage::disk('public')->put('product/serviceitems/' . $randomFileName, File::get($cp));

      $serviceItem->image = $randomFileName;
      $serviceItem->save();
    }
    return redirect()->back()->with('success', 'Service Item Updated Successfully');
  }
}
