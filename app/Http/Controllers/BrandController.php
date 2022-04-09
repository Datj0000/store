<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (Auth::check()) {
            return view('user.product.brand');
        }
        return view('auth.login');
    }
    public function fetchdata():\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Brand::all();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request):int
    {
        if (Auth::check()) {
            $check = Brand::query()->where('brand_name', $request->brand_name)->first();
            if (!$check){
                Brand::query()->create([
                    'brand_name' => $request->input('brand_name'),
                    'brand_desc' => $request->input('brand_desc'),
                ]);
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function edit(int $id):\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Brand::query()->whereId($id)->first();
            return response()->json($data->toArray());
        }
    }

    public function update(Request $request, int $id):int
    {
        if (Auth::check()) {
            $check = Brand::query()->where('brand_name','=', $request->input('brand_name'))->where('id','!=', $id)->first();
            if (!$check){
                Brand::query()->whereId($id)->update([
                    'brand_name' => $request->input('brand_name'),
                    'brand_desc' => $request->input('brand_desc'),
                ]);
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function destroy(int $id):int
    {
        if (Auth::check()) {
            $check = Product::query()->where('brand_id','=',$id)->first();
            if($check){
                return 0;
            } else{
                Brand::query()->whereId($id)->delete();
                return 1;
            }
        }
    }
}
