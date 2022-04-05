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
use Carbon\Carbon;

class ImportDetailController extends Controller
{

    public function fetchdata(int $id)
    {
        if (Auth::check()) {
            $data = ImportDetail::query()->select('products.product_name', 'importdetails.*')
                ->join('products', 'products.id', '=', 'importdetails.product_id')
                ->where('import_id', $id)->get();
            $output = '
            <input type="hidden" id="importdetail_id" value="'.$id.'"/>
            <div class="card-body">
                <table class="table table-separate table-head-custom table-checkable display nowrap" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá nhập</th>
                            <th scope="col">Giá bán</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">VAT</th>
                            <th scope="col">Bảo hành từ</th>
                            <th scope="col">Bảo hành đến</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
            ';
            $data_count = $data->count();
            if ($data_count > 0) {
                $i = 0;
                foreach ($data as $key => $item) {
                    $i++;
                    $output .= '
                        <tr>
                            <td>' . $i . '</td>';
                            if($item->detail_image){
                                $output .='
                                <td>
                                    <div class="comment__shape">
                                        <img class="comment__img" src="'.url('uploads/product/'.$item->detail_image.'').'">
                                    </div>
                                </td>';
                            }else {
                                $output .='
                                <td>
                                    <div class="comment__shape">
                                        <img class="comment__img" src="'.url('asset/media/users/noimage.png').'">
                                    </div>
                                </td>';
                            }
                            $output .='
                            <td>'.$item->product_name.'</td>
                            <td>'.$item->detail_drive.'</td>
                            <td>'.$item->detail_import_price.'</td>
                            <td>'.$item->detail_sell_price.'</td>
                            <td>'.$item->detail_quantity.'</td>
                            <td>'.$item->detail_vat.'</td>
                            <td>'.$item->detail_date_start.'</td>
                            <td>'.$item->detail_date_end.'</td>
                            <td>
                                <span data-id='.$item->id.' class="edit_detail btn btn-sm btn-clean btn-icon" title="Sửa">
                                <i class="lab la-google-drive"></i>
                                </span>
                                <span data-id='.$item->id.' class="edit_detail btn btn-sm btn-clean btn-icon" title="Sửa">
                                    <i class="la la-edit"></i>
                                </span>
                                <span data-id='.$item->id.' class="delete_detail btn btn-sm btn-clean btn-icon" title="Xoá">
                                    <i class="la la-trash"></i>
                                </span>
                            </td>
                        </tr>
                    ';
                }
            } else {
                $output .= '<tr> <td colspan="11">Hoá đơn nhập hàng này chưa có sản phẩm</td></tr>';
            }
            $output .= '
                    </tbody>
                </table>
            </div>
            ';
            return $output;
        }
    }

    public function create(Request $request, int $id):int
    {
        if (Auth::check()) {
            $check = ImportDetail::query()->where('product_id','=', $request->product_id)->first();
            if (!$check){
                $detail = new ImportDetail();
                $detail->import_id = $id;
                $detail->product_id = $request->product_id;
                $detail->detail_import_price = $request->detail_import_price;
                $detail->detail_sell_price = $request->detail_sell_price;
                $detail->detail_date_start = Carbon::parse($request->detail_date_start)->format('Y-m-d');
                $detail->detail_date_end = Carbon::parse($request->detail_date_end)->format('Y-m-d');
                $detail->detail_quantity = $request->detail_quantity;
                $detail->detail_drive = $request->detail_drive;
                $detail->detail_vat = $request->detail_vat;
                $get_image = $request->file('detail_image');
                if ($get_image) {
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move('uploads/import', $new_image);
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
            $check = ImportDetail::query()->where('product_id','=', $request->product_id)->where('id','!=', $id)->first();
            if (!$check){
                $detail = ImportDetail::query()->whereId($id)->first();
                $detail->product_id = $request->product_id;
                $detail->detail_import_price = $request->detail_import_price;
                $detail->detail_sell_price = $request->detail_sell_price;
                $detail->detail_date_start = Carbon::parse($request->detail_date_start)->format('Y-m-d');
                $detail->detail_date_end = Carbon::parse($request->detail_date_end)->format('Y-m-d');
                $detail->detail_quantity = $request->detail_quantity;
                $detail->detail_drive = $request->detail_drive;
                $detail->detail_vat = $request->detail_vat;
                $get_image = $request->file('detail_image');
                if ($get_image) {
                    if ($detail->detail_image) {
                        $destinationPath = 'uploads/import/' . $detail->detail_image;
                        if (file_exists($destinationPath)) {
                            unlink($destinationPath);
                        }
                    }
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move('uploads/import', $new_image);
                    $detail->detail_image = $new_image;
                }
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
            return 1;
        }
    }
}
