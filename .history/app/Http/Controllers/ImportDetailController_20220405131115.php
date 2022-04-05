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

class ImportDetailController extends Controller
{

    public function fetchdata(int $id)
    {
        if (Auth::check()) {
            return 1;
        }
    }

    public function create(Request $request):int
    {
        if (Auth::check()) {
            $check = ImportDetail::query()->where('product_id', $request->product_id)->first();
            if (!$check){
                $detail = new ImportDetail();
                $detail->import_id = $request->import_id;
                $detail->product_id = $request->product_id;
                $detail->detail_drive = $request->detail_drive;
                $detail->detail_import_price = $request->detail_import_price;
                $detail->detail_sell_price = $request->detail_sell_price;
                $detail->coupon_date_start = $request->coupon_date_start;
                $detail->coupon_date_end = $request->coupon_date_end;
                $detail->detail_quantity = $request->detail_quantity;
                $detail->detail_vat = $request->detail_vat;
                $get_image = $request->file('detail_image');
                if ($get_image) {
                    if ($detail->detail_image) {
                        $destinationPath = 'uploads/product/' . $detail->detail_image;
                        if (file_exists($destinationPath)) {
                            unlink($destinationPath);
                        }
                    }
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move('uploads/product', $new_image);
                    $detail->detail_image = $new_image;
                }
                $detail->save();
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function edit(int $id):\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Product::query()->whereId($id)->first();
            return response()->json($data);
        }
    }

    public function update(Request $request,int $id):int
    {
        if (Auth::check()) {
            $check = Product::query()->where('product_name','=', $request->product_name)->where('id','!=', $id)->first();
            if (!$check){
                $detail = Product::query()->whereId($id)->first();
                $detail->product_name = $request->product_name;
                $detail->category_id = $request->category_id;
                $detail->brand_id = $request->brand_id;
                $detail->unit_id = $request->unit_id;
                $detail->save();
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function destroy(int $id)
    {
        if (Auth::check()) {
            Product::query()->whereId($id)->delete();
        }
    }
}
