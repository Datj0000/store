<?php

namespace App\Http\Controllers;

use App\Models\ImportDetail;
use App\Models\InsuranceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Insurance;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class InsuranceController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if(Session::get('insurance')){
                Session::forget('insurance');
            }
            return view('user.insurance.insurance');
        }
        return Redirect::to('/login');
    }
    public function fetchdata()
    {
        if (Auth::check()) {
            $data = Insurance::all();
            return response()->json([
                "data" => $data->toArray(),
            ]);
        }
    }

    public function create(Request $request)
    {
        if (Auth::check()) {
            do {
                $code = rand(106890122,1000000000);
                $check = Insurance::query()->where('code','=',$code)->first();
            } while ($check);
            $insurance = Insurance::query()->create([
                'code' => $code,
                'method' => $request->input('method'),
                'fee' => $request->input('fee'),
                'note' => $request->input('note'),
            ]);
            if (Session::get('insurance')) {
                foreach (Session::get('insurance') as $key => $cart) {
                    InsuranceDetail::query()->create([
                        'insurance_id' => $insurance->id,
                        'product_code' => $cart['product_code'],
                        'quantity' => $cart['product_quantity'],
                    ]);
                    if($request->input('method') == 1){
                        $detail = ImportDetail::query()->where('product_code','=',$cart['product_code'])->first();
                        $detail->update([
                            'quantity' => $detail->quantity - $cart['product_quantity'],
                        ]);
                    }
                }
                Session::forget('insurance');
            }
        }
    }
    public function status(Request $quest, int $id)
    {
        if (Auth::check()) {
            $query = Insurance::query()->where('id','=',$id)->first();
            if($query){
//                if($query->method == 1){
//                    $detail = ImportDetail::query()->where('product_code','=',$cart['product_code'])->first();
//                    $detail->update([
//                        'quantity' => $detail->quantity - $cart['product_quantity'],
//                    ]);
//                }
            }
        }
    }
    public function edit(int $id)
    {
        if (Auth::check()) {
            $query = Insurance::query()->where('id','=',$id)->first();
            if($query){
                return response()->json($query->toArray());
            }
        }
    }

    public function update(Request $request,int $id)
    {
        if (Auth::check()) {
            $insurance = Insurance::query()->where('id','=',$id)->update([
                'method' => $request->input('method'),
                'fee' => $request->input('fee'),
                'note' => $request->input('note'),
            ]);
            if (Session::get('edit_insurance')) {
                $query = InsuranceDetail::query()->where('insurance_id','=',$id)->get();
                if($query){
                    $query->delete();
                }
                foreach (Session::get('edit_insurance') as $key => $cart) {
                    InsuranceDetail::query()->create([
                        'insurance_id' => $insurance->id,
                        'product_code' => $cart['product_code'],
                        'quantity' => $cart['product_quantity'],
                    ]);
                    if($request->input('method') == 1){
                        $detail = ImportDetail::query()->where('product_code','=',$cart['product_code'])->first();
                        $detail->update([
                            'quantity' => $detail->quantity - $cart['product_quantity'],
                        ]);
                    }
                }
//                Session::forget('edit_insurance');
            }
        }
    }

    public function destroy(int $id)
    {
        if (Auth::check()) {
            Insurance::query()->where('id','=',$id)->delete();
            return 1;
        }
    }
    public function add_insurance(Request $request)
    {
        if (Auth::check()) {
            $detail = ImportDetail::query()->select('brands.name as brand_name','products.name as product_name','products.brand_id','importdetails.*')
                ->join('products','products.id','=','importdetails.product_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->where('product_code','=',$request->input('code'))
                ->first();
            $session_id = substr(md5(microtime()),rand(0,26),5);
            $insurance = Session::get($request->input('type'));
            if ($insurance == true) {
                $check = 0;
                foreach ($insurance as $key => $val) {
                    if ($val['product_code'] == $request->input('code')) {
                        $check++;
                    }
                }
                if ($check == 0) {
                    $insurance[] = array(
                        'session_id' => $session_id,
                        'product_code' => $detail->product_code,
                        'product_name' => $detail->brand_name .' '. $detail->product_name,
                        'product_image' => $detail->image,
                        'product_quantity' => '1',
                    );
                    Session::put($request->input('type'),$insurance);
                    return 1;
                } else{
                    return 0;
                }
            } else {
                $insurance[] = array(
                    'session_id' => $session_id,
                    'product_code' => $detail->product_code,
                    'product_name' => $detail->brand_name .' '. $detail->product_name,
                    'product_image' => $detail->image,
                    'product_quantity' => '1',
                );
                Session::put($request->input('type'),$insurance);
                return 1;
            }
        }
    }

    public function update_insurance(Request $request)
    {
        if (Auth::check()) {
            $insurance = Session::get($request->input('type'));
            if ($insurance == true) {
                foreach ($insurance as $key => $val) {
                    if ($val['session_id'] == $request->input('session_id')) {
                        $insurance[$key]['product_quantity'] = $request->input('product_quantity');
                    }
                }
                Session::put($request->input('type'),$insurance);
            } else {
                return 0;
            }
        }
    }

    public function destroy_insurance(Request $request)
    {
        if (Auth::check()) {
            $insurance = Session::get($request->input('type'));
            if ($insurance == true) {
                foreach ($insurance as $key => $val) {
                    if ($val['session_id'] == $request->session_id) {
                        unset($insurance[$key]);
                    }
                }
                Session::put($request->input('type'),$insurance);
                return 1;
            } else {
                return 0;
            }
        }
    }
    public function load_insurance(Request $request)
    {
        if (Auth::check()) {
            if (Session::get($request->input('insurance'))) {
                $output = '
            <table class="table table-separate table-head-custom table-checkable display nowrap" cellspacing="0" width="100%" id="table_insurance">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th></th>
                    </tr>
                </thead>';
                $i = 1;
                foreach (Session::get($request->input('insurance')) as $key => $insurance) {
                    $output .= '
                <tr>
                    <td>' . $i++ . '</td>';
                    if ($insurance['product_image']) {
                        $output .= '
                        <td>
                            <div class="cart__shape">
                                <img class="cart__img" src="' . asset('uploads/import/' . $insurance['product_image']) . '" alt="IMG">
                            </div>
                        </td>';
                    } else {
                        $output .= '
                        <td>
                            <div class="cart__shape">
                                <img class="cart__img" src="' . asset('asset/media/users/noimage.png') . '" alt="IMG">
                            </div>
                        </td>';
                    }
                    $output .= '
                    <td>' . $insurance['product_name'] . '</td>';
                    $check_qty = ImportDetail::query()->where('product_code',$insurance['product_code'])->first();
                    if ($check_qty) {
                        $output .= '<input class="product_quantity_' . $insurance['session_id'] . '" type="hidden" value="' . $check_qty->quantity - $check_qty->soldout. '">';
                    }
                    $output .= '
                    <td>
                        <div class="wrap-num-product flex-w">
                            <div data-session_id="' . $insurance['session_id'] . '" class="btn-num-product-down hov-btn3 flex-c-m">
                                <i class="las la-minus"></i>
                            </div>
                            <input data-type="'.$request->input('insurance').'" data-session_id="' . $insurance['session_id'] . '" class="insurance_qty txt-center num-product" type="number" value="' . $insurance['product_quantity'] . '">
                            <div data-session_id="' . $insurance['session_id'] . '" class="btn-num-product-up hov-btn3 flex-c-m">
                                <i class="las la-plus"></i>
                            </div>
                        </div>
                    </td>
                    <td> <i style="cursor: pointer" data-type="insurance" data-session_id="' . $insurance['session_id'] . '" class="destroy_insur la la-trash"></td>
                </tr>';
                }
                $output .= '
                    </table>
                    </div>
                </div>
            </div>
            ';
            } else {
                $output = '';
            }
            return $output;
        }
    }
}
