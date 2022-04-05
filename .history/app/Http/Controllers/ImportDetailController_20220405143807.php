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
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Link drive</th>
                            <th>Giá nhập</th>
                            <th>Giá bán</th>
                            <th>Số lượng</th>
                            <th>VAT</th>
                            <th>Bảo hành từ</th>
                            <th>Bảo hành đến</th>
                            <th>Chức năng</th>
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
                                $output .='<div class="comment__shape">
                                    <img class="comment__img" src="'.url('uploads/product/'.$item->detail_image.'').'">
                                </div>';
                            }else {
                                $output .='<div class="comment__shape">
                                    <img class="comment__img" src="'.url('asset/media/users/noimage.png').'">
                                </div>';
                            }
                            $output .='
                            <td>'.$item->product_name.'</td>
                            <td>'.$item->detail_drive.'</td>
                            <td>'.$item->detail_import_price.'</td>
                            <td>'.$item->detail_sell_price.'</td>
                            <td>'.$item->detail_quantity.'</td>
                            <td>'.$item->detail_vat.'</td>
                            <td>'.$item->coupon_date_start.'</td>
                            <td>'.$item->coupon_date_end.'</td>
                            <td>
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

    public function create(Request $request):int
    {
        if (Auth::check()) {
            return 1;
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
