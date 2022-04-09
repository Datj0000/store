<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Unit;

class UnitController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('user.product.unit');
        }
        return view('auth.login');
    }
    public function fetchdata()
    {
        if (Auth::check()) {
            $data = Unit::all();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request)
    {
        if (Auth::check()) {
            $check = Unit::query()->where('unit_name', $request->unit_name)->first();
            if (!$check){
                Unit::query()->create([
                    'unit_name' => $request->input('unit_name'),
                    'unit_desc' => $request->input('unit_desc'),
                ]);
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function edit(int $id)
    {
        if (Auth::check()) {
            $data = Unit::query()->whereId($id)->first();
            return response()->json($data->toArray());
        }
    }

    public function update(Request $request, int $id)
    {
        if (Auth::check()) {
            $check = Unit::query()->where('unit_name','=', $request->input('unit_name'))->where('id','!=', $id)->first();
            if (!$check){
                Unit::query()->whereId($id)->update([
                    'unit_name' => $request->input('unit_name'),
                    'unit_desc' => $request->input('unit_desc'),
                ]);
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function destroy(int $id)
    {
        if (Auth::check()) {
            $check = Product::query()->where('unit_id','=',$id)->first();
            if($check){
                return 0;
            } else{
                Unit::query()->whereId($id)->delete();
                return 1;
            }
        }
    }
}
