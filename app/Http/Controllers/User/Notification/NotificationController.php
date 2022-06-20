<?php

namespace App\Http\Controllers\User\Notification;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function deleteMainNoti(Request $request)
    {
        Auth::user()->touchMainsDelete();
        if($request->ajax())
        {
            return Response()->json(['success'=> true]);
        }
        return back();
    }
}
