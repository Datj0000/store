<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (Auth::check()) {
            $brand = Brand::query()->get();
            $category = Category::query()->get();
            $import = Import::query()->get();
            $product = Product::query()->get();
            $supplier = Supplier::query()->get();
            return view('user.product.import')
                ->with('brand', $brand)
                ->with('category', $category)
                ->with('product', $product)
                ->with('import', $import)
                ->with('supplier', $supplier);
        }
        return view('auth.login');
    }

    public function fetchdata():\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Import::query()->select('suppliers.supplier_name', 'imports.*')
                ->join('suppliers', 'suppliers.id', '=', 'imports.supplier_id')
                ->get();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request)
    {
        if (Auth::check()) {
            $import = new Import();
            $import->supplier_id = $request->supplier_id;
            $import->import_fee_ship = $request->import_fee_ship;
            $import->save();
            return $import->id;
        }
    }

    public function edit(int $id):\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Import::query()->whereId($id)->first();
            return response()->json($data);
        }
    }

    public function update(Request $request,int $id)
    {
        if (Auth::check()) {
            $import = Import::query()->whereId($id)->first();
            $import->supplier_id = $request->supplier_id;
            $import->import_fee_ship = $request->import_fee_ship;
            $import->save();
        }
    }

    public function destroy(int $id)
    {
        if (Auth::check()) {
            $check = ImportDetail::query()->where('import_id','=',$id)->first();
            if($check){
                return 0;
            } else{
                Import::query()->whereId($id)->delete();
                return 1;
            }
        }
    }
}
