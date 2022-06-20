<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class adminsearchajax extends Controller
{
    public function searchAjax(Request $request)
    {  
        $type = $request->type;
        $page = '';
        $q = $request->q;
        $status = $request->status;
        
        if($type == 'category')
        {

            $categorys = Category::where(function($query) use ($q) {
                $query->where('name', 'like', "%{$q}%");
            })->latest()->paginate(100);

            $page = View('user.softmarkets.index',['categories' =>$categorys, 'q'=>$q])->render();
        }

    }
}
