<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('user.product.supplier');
        }
        return Redirect::to('/login');
    }
    public function fetchdata()
    {
        if (Auth::check()) {
            $data = Supplier::all();
            return response()->json([
                "data" => $data->toArray(),
            ]);
        }
    }

    public function create(Request $request)
    {
        if (Auth::check()) {
            $check_name = Supplier::query()->where('name','=',$request->input('name'))->first();
            $check_phone = Supplier::query()->where('phone','=',$request->input('phone'))->first();
            $check_email = Supplier::query()->where('email','=',$request->input('email'))->first();
            $check_mst = Supplier::query()->where('mst','=',$request->input('mst'))->first();
            if ($check_name){
                return 0;
            } else if ($check_phone){
                return 1;
            } else if ($check_email){
                return 2;
            } else if ($check_mst){
                return 3;
            } else{
                Supplier::query()->create([
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                    'mst' => $request->input('mst'),
                    'address' => $request->input('address'),
                    'information' => $request->input('information'),
                ]);
                return 4;
            }
        }
    }

    public function edit(int $id)
    {
        if (Auth::check()) {
            $query = Supplier::query()->where('id','=',$id)->first();
            if($query){
                return response()->json($query->toArray());
            }
        }
    }

    public function update(Request $request,int $id):int
    {
        if (Auth::check()) {
            $check_name = Supplier::query()->where('name','=',$request->input('name'))->where('id','!=',$id)->first();
            $check_phone = Supplier::query()->where('phone','=',$request->input('phone'))->where('id','!=',$id)->first();
            $check_email = Supplier::query()->where('email','=',$request->input('email'))->where('id','!=',$id)->first();
            $check_mst = Supplier::query()->where('mst','=',$request->input('mst'))->where('id','!=',$id)->first();
            if ($check_name){
                return 0;
            } else if ($check_phone){
                return 1;
            } else if ($check_email){
                return 2;
            } else if ($check_mst){
                return 3;
            } else{
                Supplier::query()->where('id','=',$id)->update([
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                    'mst' => $request->input('mst'),
                    'address' => $request->input('address'),
                    'information' => $request->input('information'),
                ]);
                return 4;
            }
        }
    }

    public function destroy(int $id)
    {
        if (Auth::check()) {
            $check = Product::query()->where('supplier_id','=',$id)->first();
            if($check){
                return 0;
            } else {
                $query = Supplier::query()->where('id','=',$id)->first();
                if($query){
                    $query->delete();
                    return 1;
                }
            }
        }
    }
}
