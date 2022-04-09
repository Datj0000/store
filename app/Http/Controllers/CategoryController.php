<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('user.product.category');
        }
        return view('auth.login');
    }
    public function fetchdata()
    {
        if (Auth::check()) {
            $data = Category::all();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request)
    {
        if (Auth::check()) {
            $check = Category::query()->where('category_name', $request->category_name)->first();
            if (!$check){
                Category::query()->create([
                    'category_name' => $request->input('category_name'),
                    'category_desc' => $request->input('category_desc'),
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
            $data = Category::query()->whereId($id)->first();
            return response()->json($data->toArray());
        }
    }

    public function update(Request $request, int $id)
    {
        if (Auth::check()) {
            $check = Category::query()->where('category_name','=', $request->input('category_name'))->where('id','!=', $id)->first();
            if (!$check){
                Category::query()->whereId($id)->update([
                    'category_name' => $request->input('category_name'),
                    'category_desc' => $request->input('category_desc'),
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
            $check = Product::query()->where('category_id','=',$id)->first();
            if($check){
                return 0;
            } else{
                Category::query()->whereId($id)->delete();
                return 1;
            }
        }
    }
}
