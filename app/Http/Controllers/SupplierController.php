<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (Auth::check()) {
            return view('user.product.supplier');
        }
        return view('auth.login');
    }
    public function fetchdata():\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Supplier::query()->get();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request):int
    {
        if (Auth::check()) {
            $check_name = Supplier::query()->where('supplier_name','=', $request->supplier_name)->first();
            $check_phone = Supplier::query()->where('supplier_phone','=', $request->supplier_phone)->first();
            $check_email = Supplier::query()->where('supplier_email','=', $request->supplier_email)->first();
            $check_mst = Supplier::query()->where('supplier_mst','=', $request->supplier_mst)->first();
            if ($check_name){
                return 0;
            } else if ($check_phone){
                return 1;
            } else if ($check_email){
                return 2;
            } else if ($check_mst){
                return 3;
            } else{
                $supplier = new Supplier();
                $supplier->supplier_name = $request->supplier_name;
                $supplier->supplier_phone = $request->supplier_phone;
                $supplier->supplier_email = $request->supplier_email;
                $supplier->supplier_mst = $request->supplier_mst;
                $supplier->supplier_address = $request->supplier_address;
                $supplier->supplier_information = $request->supplier_information;
                $supplier->save();
                return 4;
            }
        }
    }

    public function edit(int $id):\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Supplier::query()->whereId($id)->first();
            return response()->json($data);
        }
    }

    public function update(Request $request, int $id):int
    {
        if (Auth::check()) {
            $check_name = Supplier::query()->where('supplier_name','=', $request->supplier_name)->where('id','!=', $id)->first();
            $check_phone = Supplier::query()->where('supplier_phone','=', $request->supplier_phone)->where('id','!=', $id)->first();
            $check_email = Supplier::query()->where('supplier_email','=', $request->supplier_email)->where('id','!=', $id)->first();
            $check_mst = Supplier::query()->where('supplier_mst','=', $request->supplier_mst)->where('id','!=', $id)->first();
            if ($check_name){
                return 0;
            } else if ($check_phone){
                return 1;
            } else if ($check_email){
                return 2;
            } else if ($check_mst){
                return 3;
            } else{
                $supplier = Supplier::query()->whereId($id)->first();
                $supplier->supplier_name = $request->supplier_name;
                $supplier->supplier_phone = $request->supplier_phone;
                $supplier->supplier_email = $request->supplier_email;
                $supplier->supplier_mst = $request->supplier_mst;
                $supplier->supplier_address = $request->supplier_address;
                $supplier->supplier_information = $request->supplier_information;
                $supplier->save();
                return 4;
            }
        }
    }

    public function destroy(int $id):int
    {
        if (Auth::check()) {
            $check = Product::query()->where('supplier_id','=',$id)->first();
            if($check){
                return 0;
            } else {
                Supplier::query()->whereId($id)->delete();
                return 1;
            }
        }
    }
}
