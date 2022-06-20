<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class usersearchajax extends Controller
{
    public function searchAjax(Request $request)
    {  

        $type = $request->type;
        $page = '';
        $q = $request->q;
        $status = $request->status;
        $categories = Category::where(function($query) use ($q) {
                $query->where('name', 'like', "%{$q}%");
            })->latest()->paginate(100)->appends(['q'=>$q,'status'=>$status,'type'=>$type]);;

            $page = View('user.softmarkets.includes.ajaxdatacontainer',['categories' =>$categories, 'q'=>$q])->render();
        

    }
}
