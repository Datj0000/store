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
            <input type="hidden" id="episode_server_id" value="'.$server_id.'"/>
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
                            <td>' . $i . '</td>
                            <td><input id="edit_episode_name_'.$item->id.'" class="custom_input" value="'.$item->episode_name.'" type="text"></td>
                            <td><input id="edit_episode_link_'.$item->id.'" class="custom_input" value="'.$item->episode_link.'" type="text"></td>
                            <td style="with: 15%">';
                            if ($item->episode_status == 0) {
                                $output .='<span data-id_episode='.$item->id.' class="unactive_episode btn btn-sm btn-clean btn-icon" title="Đang hiển thị">
                                    <i class="la la-eye"></i>
                                </span>';
                            } else {
                                $output .='<span data-id_episode='.$item->id.' class="active_episode btn btn-sm btn-clean btn-icon" title="Đang ẩn">
                                    <i class="la la-eye-slash"></i>
                                </span>';
                            }
                            $output .='</td>
                            <td style="with: 15%">
                                <span data-id_episode='.$item->id.' class="edit_episode btn btn-sm btn-clean btn-icon" title="Sửa">
                                    <i class="la la-edit"></i>
                                </span>
                                <span data-id_episode='.$item->id.' class="delete_episode btn btn-sm btn-clean btn-icon" title="Xoá">
                                    <i class="la la-trash"></i>
                                </span>
                            </td>
                        </tr>
                    ';
                }
            } else {
                $output .= '<tr> <td colspan="3">Phim chưa có tập phim nào cho sever này</td></tr>';
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
            $check = Product::query()->where('product_name', $request->product_name)->first();
            if (!$check){
                $product = new product();
                $product->product_name = $request->product_name;
                $product->category_id = $request->category_id;
                $product->brand_id = $request->brand_id;
                $product->unit_id = $request->unit_id;
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

    public function update(Request $request,int $id):int
    {
        if (Auth::check()) {
            $check = Product::query()->where('product_name','=', $request->product_name)->where('id','!=', $id)->first();
            if (!$check){
                $product = Product::query()->whereId($id)->first();
                $product->product_name = $request->product_name;
                $product->category_id = $request->category_id;
                $product->brand_id = $request->brand_id;
                $product->unit_id = $request->unit_id;
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
            Product::query()->whereId($id)->delete();
        }
    }
}
