<?php

namespace App\Http\Controllers;

use App\Models\Import;
use App\Models\ImportDetail;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Picqer\Barcode\BarcodeGeneratorHTML;

class ImportDetailController extends Controller
{

    public function fetchdata(int $id)
    {
        if (Auth::check()) {
            $detail = ImportDetail::query()->select('products.name as product_name','importdetails.*')
                ->join('products','products.id','=','importdetails.product_id')
                ->where('import_id','=',$id)->get();
            $output = '
            <input type="hidden" id="importid" value="'.$id.'"/>
            <div class="card-body">
            <table class="table table-separate table-head-custom table-checkable display nowrap" cellspacing="0" width="100%" id="table_import_'.$id.'">
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
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
            ';
            $count = $detail->count();
            if ($count > 0) {
                $i = 0;
                $total = 0;
                foreach ($detail as $key => $item) {
                    $i++;
                    $subtotal = $item->import_price * $item->quantity;
                    $total += $subtotal;
                    $output .= '
                        <tr>
                            <td scope="row">' . $i . '</td>';
                            if($item->image){
                                $output .='
                                <td>
                                    <div class="import__shape">
                                        <img class="import__img" src="'.url('uploads/import/'.$item->image.'').'">
                                    </div>
                                </td>';
                            }else {
                                $output .='
                                <td>
                                    <div class="import__shape">
                                        <img class="import__img" src="'.url('asset/media/users/noimage.png').'">
                                    </div>
                                </td>';
                            }
                            $output .='
                            <td>'.$item->product_name.'</td>
                            <td>'.number_format($item->import_price,0,',','.').'đ'.'</td>
                            <td>'.number_format($item->sell_price,0,',','.').'đ'.'</td>
                            <td>'.$item->quantity.'</td>';
                            if($item->vat){
                                $output .='<td>'.$item->vat.'</td>';
                            }else {
                                $output .='<td>Không có</td>';
                            }
                            $output .='
                            <td>'.$item->date_start.'</td>
                            <td>'.$item->date_end.'</td>
                            <td>'.number_format($subtotal,0,',','.').'đ'.'</td>
                            <td>
                                <a href='.$item->drive.' target="_blank" class="btn btn-sm btn-clean btn-icon" title="Link hình ảnh/video">
                                    <i class="lab la-google-drive"></i>
                                </a>
                                <span data-id='.$item->id.' class="edit_importdetail btn btn-sm btn-clean btn-icon" title="Sửa">
                                    <i class="la la-edit"></i>
                                </span>
                                <span data-import_id='.$item->import_id.' data-id='.$item->id.' class="destroy_importdetail btn btn-sm btn-clean btn-icon" title="Xoá">
                                    <i class="la la-trash"></i>
                                </span>
                            </td>
                        </tr>
                    ';
                }
                $import = Import::query()->where('id','=',$id)->first();
                $output .= '
                        </tbody>
                    </table>
                    <div style="margin-top: 20px" class="row form-group">
                        <div style="width: 10%">
                        Tổng:
                        </div>
                        <div style="width: 90%">
                            ' . number_format($total,0,',','.') . 'đ' . '
                        </div>
                        <div style="width: 10%">
                        Phí ship:
                        </div>
                        <div style="width: 90%">
                            ' . number_format($import->fee_ship,0,',','.') . 'đ' . '
                        </div>
                        <div style="width: 10%">
                        Thành tiền:
                        </div>
                        <div style="width: 90%">
                            ' . number_format($total + $import->fee_ship,0,',','.') . 'đ' . '
                        </div>
                    </div>
                </div>';
            } else {
                $output .= '<tr style="text-align: center" ><td colspan="11">Chưa nhập hàng cho đơn này</td></tr>';
            }
            return $output;
        }
    }

    public function create(Request $request,int $id)
    {
        if (Auth::check()) {
            $check = ImportDetail::query()->where('product_id','=',$request->input('product_id'))->where('import_id','=',$id)->first();
            if (!$check){
                do {
                    $product_code = rand(106890122,1000000000);
                    $check_code = ImportDetail::query()->where('product_code','=',$product_code)->first();
                } while ($check_code);
                $detail = ImportDetail::query()->create([
                    'import_id' => $id,
                    'product_id' => $request->input('product_id'),
                    'product_code' => $product_code,
                    'import_price' => $request->input('import_price'),
                    'sell_price' => $request->input('sell_price'),
                    'quantity' => $request->input('quantity'),
                    'drive' => $request->input('drive'),
                    'vat' => $request->input('vat'),
                    'date_start' => Carbon::parse($request->input('date_start'))->format('Y-m-d'),
                    'date_end' => Carbon::parse($request->input('date_end'))->format('Y-m-d'),
                ]);
                $get_image = $request->file('image');
                if ($get_image) {
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image . rand(0,99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move('uploads/import',$new_image);
                    $detail->update([
                        'image' => $new_image,
                    ]);
                }
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function edit(int $id)
    {
        if (Auth::check()) {
            $query = ImportDetail::query()
            ->select('products.brand_id', 'products.category_id','importdetails.*')
            ->join('products','products.id','=','importdetails.product_id')
            ->where('importdetails.id','=',$id)->first();
            if($query){
                return response()->json($query->toArray());
            }
        }
    }

    public function update(Request $request,int $id)
    {
        if (Auth::check()) {
            $check = ImportDetail::query()->where('product_id','=',$request->input('product_id'))->where('import_id','!=',$request->input('import_id'))->first();
            if (!$check){
                $detail = ImportDetail::query()->where('id','=',$id)->update([
                    'product_id' => $request->input('product_id'),
                    'import_price' => $request->input('import_price'),
                    'sell_price' => $request->input('sell_price'),
                    'quantity' => $request->input('quantity'),
                    'drive' => $request->input('drive'),
                    'vat' => $request->input('vat'),
                    'date_start' => Carbon::parse($request->input('date_start'))->format('Y-m-d'),
                    'date_end' => Carbon::parse($request->input('date_end'))->format('Y-m-d'),
                ]);
                $get_image = $request->file('image');
                if ($get_image) {
                    if ($detail->image) {
                        $destinationPath = 'uploads/import/' . $detail->image;
                        if (file_exists($destinationPath)) {
                            unlink($destinationPath);
                        }
                    }
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image . rand(0,99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move('uploads/import',$new_image);
                    $detail->update([
                        'image' => $new_image,
                    ]);
                }
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function destroy(int $id)
    {
        if (Auth::check()) {
            $query = ImportDetail::query()->where('id','=',$id)->first();
            if($query){
                $check = OrderDetail::query()->where('product_code','=',$query->product_code)->first();
                if($check){
                    return 0;
                } else{
                    $query->delete();
                    return 1;
                }
            }
        }
    }
}
