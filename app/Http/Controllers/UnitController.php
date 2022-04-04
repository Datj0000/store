<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Unit;

class UnitController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (Auth::check()) {
            return view('user.product.unit');
        }
        return view('auth.login');
    }
    public function fetchdata():\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Unit::query()->get();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request):int
    {
        if (Auth::check()) {
            $check = Unit::query()->where('unit_name','=', $request->unit_name)->first();
            if (!$check){
                $unit = new Unit();
                $unit->unit_name = $request->unit_name;
                $unit->unit_desc = $request->unit_desc;
                $unit->save();
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function edit(int $id):\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Unit::query()->whereId($id)->first();
            return response()->json($data);
        }
    }

    public function update(Request $request, int $id):int
    {
        if (Auth::check()) {
            $check = Unit::query()->where('unit_name','=', $request->unit_name)->where('id','!=', $id)->first();
            if (!$check){
                $unit = Unit::query()->whereId($id)->first();
                $unit->unit_name = $request->unit_name;
                $unit->unit_desc = $request->unit_desc;
                $unit->save();
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function destroy(int $id):int
    {
        if (Auth::check()) {
            $check = Product::query()->where('unit_id','=',$id)->first();
            if($check){
                return 0;
            } else {
                Unit::query()->whereId($id)->delete();
                return 1;
            }
        }
    }
}
