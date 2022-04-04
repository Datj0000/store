<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Import;
use App\Models\ImportDetail;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImportDetailController extends Controller
{

    public function fetchdata():\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = ImportDetail::query()->select('suppliers.supplier_name', 'products.product_name', 'ImportDetails.*')
                ->join('suppliers', 'suppliers.id', '=', 'ImportDetails.supplier_id')
                ->join('products', 'products.id', '=', 'ImportDetails.product_id')
                ->get();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request):int
    {
        if (Auth::check()) {
            $check = Product::query()->where('product_name', $request->product_name)->first();
            if (!$check){
                $product = new product();
                $product->product_name = $request->product_name;
                $product->category_id = $request->category_id;
                $product->brand_id = $request->brand_id;
                $product->unit_id = $request->unit_id;
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

    public function update(Request $request,int $id):int
    {
        if (Auth::check()) {
            $check = Product::query()->where('product_name','=', $request->product_name)->where('id','!=', $id)->first();
            if (!$check){
                $product = Product::query()->whereId($id)->first();
                $product->product_name = $request->product_name;
                $product->category_id = $request->category_id;
                $product->brand_id = $request->brand_id;
                $product->unit_id = $request->unit_id;
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
        }
    }
}
