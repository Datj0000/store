<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Insurance;

class InsuranceController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $supplier = Supplier::query()->get();
            return view('user.insurance.insurance')->with('supplier',$supplier);
        }
        return Redirect::to('/login');
    }
    public function fetchdata()
    {
        if (Auth::check()) {
            $data = Insurance::query()->select('importdetails.product_id','products.product_name','brands.brand_name','insurances.*')
                ->join('importdetails','importdetails.product_code','=','insurances.product_code')
                ->join('products','products.id','=','importdetails.product_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->get();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request)
    {
        if (Auth::check()) {
            $check = Insurance::query()->where('order_id','=',$request->order_id)->where('product_code','=',$request->product_code)->first();
            if (!$check){
                $insurance = new Insurance();
                $insurance->order_id = $request->order_id;
                $insurance->product_code = $request->product_code;
                $insurance->insurance_price = $request->insurance_price;
                $insurance->save();
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function edit(int $id):\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Insurance::query()->where('id','=',$id)->first();
            return response()->json($data);
        }
    }

    public function update(Request $request,int $id):int
    {
        if (Auth::check()) {
            $check = Insurance::query()->where('order_id','=',$request->order_id)->where('product_code','=',$request->product_code)->where('id','!=',$id)->first();
            if (!$check){
                $insurance = Insurance::query()->where('id','=',$id)->first();
                $insurance->order_id = $request->order_id;
                $insurance->product_code = $request->product_code;
                $insurance->insurance_price = $request->insurance_price;
                $insurance->save();
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function destroy(int $id):int
    {
        if (Auth::check()) {
            Insurance::query()->where('id','=',$id)->delete();
            return 1;
        }
    }
}
