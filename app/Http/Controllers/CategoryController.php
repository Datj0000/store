<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (Auth::check()) {
            return view('user.product.category');
        }
        return view('auth.login');
    }
    public function fetchdata():\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Category::query()->get();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request):int
    {
        if (Auth::check()) {
            $check = Category::query()->where('category_name', $request->category_name)->first();
            if (!$check){
                $category = new Category();
                $category->category_name = $request->category_name;
                $category->category_desc = $request->category_desc;
                $category->save();
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function edit(int $id):\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Category::query()->whereId($id)->first();
            return response()->json($data);
        }
    }

    public function update(Request $request, int $id):int
    {
        if (Auth::check()) {
            $check = Category::query()->where('category_name','=', $request->category_name)->where('id','!=', $id)->first();
            if (!$check){
                $category = Category::query()->whereId($id)->first();
                $category->category_name = $request->category_name;
                $category->category_desc = $request->category_desc;
                $category->save();
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function destroy(int $id):int
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
