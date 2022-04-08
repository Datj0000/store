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
use Illuminate\Support\Facades\DB;
//use Dompdf\Dompdf;

class ImportController extends Controller
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
            $data = Import::query()->select('suppliers.supplier_name', DB::raw('SUM(importdetails.detail_import_price) As total'), 'imports.*')
                ->leftJoin('importdetails', 'importdetails.import_id', '=', 'imports.id')
                ->join('suppliers', 'suppliers.id', '=', 'imports.supplier_id')
                ->groupBy('suppliers.supplier_name','imports.import_code','imports.id','imports.import_fee_ship','imports.supplier_id', 'imports.created_at', 'imports.updated_at')
                ->orderBy('id', 'Desc')->get();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request)
    {
        if (Auth::check()) {
            $import = new Import();
            do {
                $import_code = rand(106890122,1000000000);
                $check = Import::query()->where('import_code','=', $import_code)->first();
            } while ($check);
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

    public function print(int $id)
    {
        if (Auth::check()) {
            $import = Import::query()->whereId($id)->first();
            $supplier = Supplier::query()->whereId($import->supplier_id)->first();
            $detail = ImportDetail::query()->select('products.product_name', 'importdetails.*')
                ->join('products', 'products.id', '=', 'importdetails.product_id')
                ->where('import_id', $id)->get();
            $pdf = \PDF::loadView('pdf.import', [
                'import' => $import,
                'supplier' => $supplier,
                'details' => $detail
            ]);
            return $pdf->stream();
        }
    }
}
