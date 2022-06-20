<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Session;
use Validator;
use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\OrderNotifications;

class UserNotificationsController extends Controller
{
    public function notificationslist()
    {
      $notifications=OrderNotifications::where('user_id',Auth::user()->id)->latest()->paginate(10);

      return view('user.usernotification.notificationslist', [
        'notifications' => $notifications
      ]);
    }
    public function notificationsdetails($id)
    {
      $details=OrderNotifications::where('id',$id)->first();

      $details->status='2';
      $details->save();

      return view('user.usernotification.notificationsdetails', [
        'details' => $details
      ]);
    }
    
}
