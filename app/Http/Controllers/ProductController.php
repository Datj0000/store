<?php

namespace App\Http\Controllers;

use App\Models\ImportDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (Auth::check()) {
            $category = Category::query()->get();
            $brand = Brand::query()->get();
            $unit = Unit::query()->get();
            return view('user.product.product')
                ->with('cate', $category)
                ->with('brand', $brand)
                ->with('unit', $unit);
        }
        return view('auth.login');
    }

    public function fetchdata():\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Product::query()->select('brands.brand_name', 'categories.category_name','units.unit_name', 'products.*', DB::raw('SUM(importdetails.detail_quantity) As quantity'))
                ->leftJoin('importdetails', 'importdetails.product_id', '=', 'products.id')
                ->join('brands', 'brands.id', '=', 'products.brand_id')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->join('units', 'units.id', '=', 'products.unit_id')
                ->groupBy('brands.brand_name','categories.category_name','units.unit_name','products.id','products.product_image','products.product_name','products.brand_id','products.category_id','products.unit_id', 'products.created_at', 'products.updated_at')
                ->get();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request)
    {
        if (Auth::check()) {
            $check = Product::query()->where('brand_id','=', $request->brand_id)->where('product_name','=', $request->product_name)->first();
            if (!$check){
                $product = new product();
                $product->product_name = $request->product_name;
                $product->category_id = $request->category_id;
                $product->brand_id = $request->brand_id;
                $product->unit_id = $request->unit_id;
                $get_image = $request->file('product_image');
                if ($get_image) {
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move('uploads/product', $new_image);
                    $product->product_image = $new_image;
                }
                $product->save();
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

    public function update(Request $request,int $id)
    {
        if (Auth::check()) {
            $check = Product::query()->where('brand_id','=', $request->brand_id)->where('product_name','=', $request->product_name)->where('id','!=', $id)->first();
            if (!$check){
                $product = Product::query()->whereId($id)->first();
                $product->product_name = $request->product_name;
                $product->category_id = $request->category_id;
                $product->brand_id = $request->brand_id;
                $product->unit_id = $request->unit_id;
                $get_image = $request->file('product_image');
                if ($get_image) {
                    if ($product->product_image) {
                        $destinationPath = 'uploads/product/' . $product->product_image;
                        if (file_exists($destinationPath)) {
                            unlink($destinationPath);
                        }
                    }
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move('uploads/product', $new_image);
                    $product->product_image = $new_image;
                }
                $product->save();
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function destroy(int $id)
    {
        if (Auth::check()) {
            $check = ImportDetail::query()->where('product_id','=',$id)->first();
            if($check){
                return 0;
            } else{
                Product::query()->whereId($id)->delete();
                return 1;
            }
        }
    }
    public function load(Request $request)
    {
        if (Auth::check()) {
            $product = Product::query()->where('brand_id','=', $request->brand_id)->where('category_id','=', $request->category_id)->get();
            if ($product->count() > 0) {
                $output = '';
                foreach ($product as $key => $val) {
                    $output .= '<option value="'.$val->id.'">' . $val->product_name . '</option>';
                }
            }
            else{
                $output = '<option value="">Không có sản phẩm ở danh mục và thương hiệu này</option>';
            }
            return $output;
        }
    }
    public function load_detail(int $id)
    {
        if (Auth::check()) {
            $detail = ImportDetail::query()->select('suppliers.supplier_name','suppliers.created_at as supplier_time', 'products.product_name', 'imports.supplier_id', 'importdetails.*')
                ->join('imports', 'imports.id', '=', 'importdetails.import_id')
                ->join('suppliers', 'suppliers.id', '=', 'imports.supplier_id')
                ->join('products', 'products.id', '=', 'importdetails.product_id')
                ->where('product_id', $id)->get();
            $output = '
            <div class="card-body">
            <table class="table table-separate table-head-custom table-checkable display nowrap" cellspacing="0" width="100%" id="responsive2">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tên sản phẩm</th>';
                            if(Auth::user()->role <= 1){
                                $output .='
                                <th scope="col">Nhà cung cấp</th>
                                <th scope="col">VAT</th>
                                <th scope="col">Giá nhập</th>
                                ';
                            }
                            $output .='
                                <th scope="col">Giá bán</th>
                                <th scope="col">Số lượng</th>';
                            if(Auth::user()->role <= 1){
                                $output .='<th scope="col">Thời gian nhập</th>';
                            }
                            $output .='
                                <th scope="col">Bảo hành từ</th>
                                <th scope="col">Bảo hành đến</th>';
                            if(Auth::user()->role <= 1){
                                $output .='<th scope="col">Chức năng</th>';
                            }
                            $output .='
                        </tr>
                    </thead>
                    <tbody>
            ';
            $detail_count = $detail->count();
            if ($detail_count > 0) {
                $i = 0;
                $total = 0;
                foreach ($detail as $key => $item) {
                    $i++;
                    $subtotal = $item->detail_sell_price * $item->detail_quantity;
                    $total += $subtotal;
                    $output .= '
                        <tr>
                            <td scope="row">' . $i . '</td>';
                            if($item->detail_image){
                                $output .='
                                    <td>
                                        <div class="product__shape">
                                            <img class="product__img" src="'.url('uploads/import/'.$item->detail_image.'').'">
                                        </div>
                                    </td>';
                            }else {
                                $output .='
                                    <td>
                                        <div class="product__shape">
                                            <img class="product__img" src="'.url('asset/media/users/noimage.png').'">
                                        </div>
                                    </td>';
                            }

                    $output .='<td>'.$item->product_name.'</td>';
                            if(Auth::user()->role <= 1){
                                $output .='<td>'.$item->supplier_name.'</td>';
                                if($item->detail_vat){
                                    $output .='<td>'.$item->detail_vat.'</td>';
                                }else {
                                    $output .='<td>Không có</td>';
                                }
                                $output .='<td>'.number_format($item->detail_import_price, 0, ',', '.').'đ'.'</td>';
                            }

                    $output .='
                            <td>'.number_format($item->detail_sell_price, 0, ',', '.').'đ'.'</td>
                            <td>'.$item->detail_quantity.'</td>';
                    if(Auth::user()->role <= 1){
                        $output .=' <td>'.$item->supplier_time.'</td>';
                    }
                    $output .='
                            <td>'.$item->detail_date_start.'</td>
                            <td>'.$item->detail_date_end.'</td>';
                    if(Auth::user()->role <= 1){
                        $output .='
                            <td>
                                <a href='.$item->detail_drive.' target="_blank" class="btn btn-sm btn-clean btn-icon" title="Link hình ảnh/video">
                                    <i class="lab la-google-drive"></i>
                                </a>
                                <span data-id='.$item->id.' class="edit_productdetail btn btn-sm btn-clean btn-icon" title="Sửa">
                                    <i class="la la-edit"></i>
                                </span>
                                <span data-product_id='.$item->product_id.' data-id='.$item->id.' class="destroy_productdetail btn btn-sm btn-clean btn-icon" title="Xoá">
                                    <i class="la la-trash"></i>
                                </span>
                            </td>';
                    }
                }
                $output .= '
                            </tr>
                        </tbody>
                    </table>
                </div>';
            } else {
                $output .= '<tr style="text-align: center" ><td colspan="11">Trong kho chưa có sản phẩm này</td></tr>';
            }
            return $output;
        }
    }
}
