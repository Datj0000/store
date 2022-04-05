<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;

class ProductController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (Auth::check()) {
            $category = Category::query()->get();
            $brand = Brand::query()->get();
            $unit = Unit::query()->get();
            return view('user.product.product')
                ->with('cate', $category)
                ->with('brand', $brand)
                ->with('unit', $unit);
        }
        return view('auth.login');
    }

    public function fetchdata():\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Product::query()->select('brands.brand_name', 'categories.category_name','units.unit_name', 'products.*')
                ->join('brands', 'brands.id', '=', 'products.brand_id')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->join('units', 'units.id', '=', 'products.unit_id')
                ->get();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request)
    {
        if (Auth::check()) {
            $check = Product::query()->where('brand_id','=', $request->brand_id)->where('product_name','=', $request->product_name)->first();
            if (!$check){
                $product = new product();
                $product->product_name = $request->product_name;
                $product->category_id = $request->category_id;
                $product->brand_id = $request->brand_id;
                $product->unit_id = $request->unit_id;
                $get_image = $request->file('product_image');
                if ($get_image) {
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move('uploads/product', $new_image);
                    $product->product_image = $new_image;
                }
                $product->save();
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function edit(int $id):\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Product::query()->whereId($id)->first();
            return response()->json($data);
        }
    }

    public function update(Request $request,int $id)
    {
        if (Auth::check()) {
            $check = Product::query()->where('brand_id','=', $request->brand_id)->where('product_name','=', $request->product_name)->where('id','!=', $id)->first();
            if (!$check){
                $product = Product::query()->whereId($id)->first();
                $product->product_name = $request->product_name;
                $product->category_id = $request->category_id;
                $product->brand_id = $request->brand_id;
                $product->unit_id = $request->unit_id;
                $get_image = $request->file('product_image');
                if ($get_image) {
                    if ($product->product_image) {
                        $destinationPath = 'uploads/product/' . $product->product_image;
                        if (file_exists($destinationPath)) {
                            unlink($destinationPath);
                        }
                    }
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move('uploads/product', $new_image);
                    $product->product_image = $new_image;
                }
                $product->save();
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function destroy(int $id)
    {
        if (Auth::check()) {
            Product::query()->whereId($id)->delete();
            return 1;
        }
    }
    public function load(Request $request)
    {
        if (Auth::check()) {
            $product = Product::query()->where('brand_id','=', $request->brand_id)->where('category_id','=', $request->category_id)->get();
            if ($product->count() > 0) {
                $output = '';
                foreach ($coupon as $key => $val) {
                    $output .= '
                        <li class="li_search_coupon">' . $val->coupon_code . '</li>
                   ';
                }
                $output .= '</ul>';
                return $output;
            }
        }
        $data = $request->all();
        if ($data['query']) {
            $coupon = Coupon::query()->where('coupon_status','=', 0)->where('coupon_code', 'LIKE', '%' . $data['query'] . '%')->get();
            if ($coupon->count() > 0) {
                $output = '
                <ul class="dropdown-menu2">';
                foreach ($coupon as $key => $val) {
                    $output .= '
                        <li class="li_search_coupon">' . $val->coupon_code . '</li>
                   ';
                }
                $output .= '</ul>';
                return $output;
            }
        }
    }
}
