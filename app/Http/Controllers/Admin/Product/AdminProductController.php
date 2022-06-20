<?php

namespace App\Http\Controllers\Admin\Product;

use DB;
use Auth;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\UserRole;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function createNewProduct(Request $request)
    {
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'product','lsbsm'=>'products']);

        // return view('admin.products.createProduct');

        $me = Auth::user();
        $product = Product::where('status', 'temp')->where('addedby_id',$me->id)->first();
        if(!$product)
        {
            $product = new Product;

            $product->addedby_id = $me->id;
            $product->editedby_id = $me->id;
            $product->status = 'temp';
            $product->save();
        }

        $categories=Category::orderBy('id','desc')->get(['id', 'name->en as text','parent_id as parent', DB::raw('IFNULL(parent_id,"#") as parent')]); 
        $brands = ProductBrand::where('active',1)->get();

        return view('admin.products.create',[
            'product'=>$product,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    public function productInformationAdd(Request $request,Product $product)
    {
        
        $validation = Validator::make($request->all(),
        [
            'name' => 'required|min:3',
            'regular_price' => 'required'
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }

        $product->name = ['en'=>$request->name];
        $product->excerpt = ['en'=>$request->excerpt];
        $product->description = ['en'=>$request->description];
        $product->brand_id = $request->brand;
        $product->publish_date = $request->publish_date ? date('Y-m-d', strtotime($request->publish_date)) : date('Y-m-d');

        $product->close_date = $request->close_date ? date('Y-m-d', strtotime($request->close_date)) : null;

        $product->mfg_date = $request->mfg_date ? date('Y-m-d', strtotime($request->published_date)) : null;

        $product->exp_date = $request->exp_date ? date('Y-m-d', strtotime($request->exp_date)) : null;

        $product->purchase_price = $request->purchase_price;
        $product->sale_price = $request->regular_price;
        $product->pv = $request->pv;

        $product->pre_order = $request->preorder ? 1 : 0;
        $product->refundable = $request->refundable ? 1 : 0;
        $product->unit_weight = $request->unit_weight ? 1 : 0;
        $product->status = $request->published;
        
        $product->save();

        return back()->with('success', 'Product successfully updated');

    }

    public function productInformationUpdate(Request $request,Product $product)
    {
        $validation = Validator::make($request->all(),
        [
            'name' => 'required|min:3',
            'regular_price' => 'required'
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }

        $product->name = ['en'=>$request->name];
        $product->excerpt = ['en'=>$request->excerpt];
        $product->description = ['en'=>$request->description];
        $product->brand_id = $request->brand;
        $product->publish_date = $request->publish_date ? date('Y-m-d', strtotime($request->publish_date)) : date('Y-m-d');

        $product->close_date = $request->close_date ? date('Y-m-d', strtotime($request->close_date)) : null;

        $product->mfg_date = $request->mfg_date ? date('Y-m-d', strtotime($request->published_date)) : null;

        $product->purchase_price = $request->purchase_price;
        $product->sale_price = $request->regular_price;
        $product->pv = $request->pv;

        $product->pre_order = $request->preorder ? 1 : 0;
        $product->refundable = $request->refundable ? 1 : 0;
        $product->unit_weight = $request->unit_weight ? 1 : 0;
        $product->status = $request->published;
        
        $product->save();

        return back()->with('success', 'Product successfully Updated');
    }

    public function allProductList(Request $request)
    {
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'product','lsbsm'=>'allProductList']);

        $products = Product::where('status','<>','temp')->latest()->paginate(100);

        return view('admin.products.productList',[
            'products' => $products
        ]);
    }

    public function editProduct(Product $product)
    {
        $request = request();
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'product','lsbsm'=>'products']);

        $categories=Category::orderBy('id','desc')->get(['id', 'name->en as text','parent_id as parent', DB::raw('IFNULL(parent_id,"#") as parent')]); 
        $brands = ProductBrand::where('active',1)->get();

        return view('admin.products.edit',[
            'product'=>$product,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product successfully deleted');
    }
}
