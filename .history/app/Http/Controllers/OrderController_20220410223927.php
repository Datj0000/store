<?php

namespace App\Http\Controllers;

use App\Models\Import;
use App\Models\ImportDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $customer = Customer::query()->get();
            return view('user.order.order')
                ->with('customer',$customer);
        }
        return Redirect::to('/login');
    }

    public function fetchdata()
    {
        if (Auth::check()) {
            $data = Order::query()->select('customers.name as customer_name','orders.*')
                ->join('customers','customers.id','=','orders.customer_id')
                ->get();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request)
    {
        if (Auth::check()) {
            // do {
            //     $code = rand(106890122,1000000000);
            //     $check = Order::query()->where('code','=',$code)->first();
            // } while ($check);
            // $order = Order::query()->create([
            //     'code' => $code,
            //     'customer_id' => $request->input('customer_id'),
            //     'method_pay' => $request->input('method_pay'),
            //     'note' => $request->input('note'),
            // ]);
            // if (Session::get('fee')){
            //     $order->update([
            //         'fee_ship' => Session::get('fee')
            //     ]);
            //     Session::forget('fee');
            // }
            if (Session::get('coupon')){
                foreach (Session::get('coupon') as $key => $cou) {
                    // $order->update([
                    //     'coupon' => $cou['code']
                    // ]);
                    $coupon = Coupon::query()->where('code','=',$cou['code'])->first();
                    if($coupon){
                        $coupon->update([
                            'time' => $coupon->time++,
                        ]);
                    }
                }
                Session::forget('coupon');
            }
            // if (Session::get('cart')) {
            //     foreach (Session::get('cart') as $key => $cart) {
            //         $orderdetail = OrderDetail::query()->create([
            //             'order_id' => $order->id,
            //             'product_code' => $cart['product_code'],
            //             'quantity' => $cart['product_quantity'],
            //         ]);
            //         $importdetail = ImportDetail::query()->where('product_code','=',$cart['product_code'])->first();
            //         if($importdetail){
            //             $importdetail->update([
            //                 'soldout' => $importdetail->soldout + $cart['product_quantity'],
            //             ]);
            //         }
            //     }
            //     // Session::forget('cart');
            // }
        }
    }

    public function edit(int $id)
    {
        if (Auth::check()) {
            if(Session::get('edit_fee')){
                Session::forget('edit_fee');
            }
            if(Session::get('edit_coupon')){
                Session::forget('edit_coupon');
            }
            if(Session::get('edit_cart')){
                Session::forget('edit_cart');
            }
            $data = Order::query()->select('customers.name as customer_name','customers.phone as customer_phone','orders.*')
                ->join('customers','customers.id','=','orders.customer_id')
                ->where('orders.id','=',$id)->first();
            return response()->json($data->toArray());
        }
    }

    public function update(Request $request,int $id)
    {
        if (Auth::check()) {
            $order = Order::query()->where('id','=',$id)->update([
                'customer_id' => $request->input('customer_id'),
                'method_pay' => $request->input('method_pay'),
                'note' => $request->input('note'),
            ]);
            if (Session::get('edit_fee')){
                $order->update([
                    'fee_ship' => Session::get('edit_fee')
                ]);
                Session::forget('edit_fee');
            }
            if (Session::get('edit_coupon')){
                $order->update([
                    'coupon' => Session::get('edit_coupon')
                ]);
                Session::forget('edit_coupon');
            }
            if (Session::get('edit_cart')) {
                $query = OrderDetail::query()->where('order_id','=',$id)->get();
                if($query){
                    foreach($query as $item){
                        OrderDetail::query()->where('order_id','=',$item->order_id)->delete();
                    }
                }
                foreach (Session::get('edit_cart') as $key => $cart) {
                    $orderdetail = OrderDetail::query()->create([
                        'order_id' => $id,
                        'product_code' => $cart['product_code'],
                        'quantity' => $cart['product_quantity'],
                    ]);
                    $importdetail = ImportDetail::query()->where('product_code','=',$cart['product_code'])->first();
                    if($importdetail){
                        $importdetail->update([
                            'soldout' => $importdetail->soldout + $cart['product_quantity'],
                        ]);
                    }
                }
                Session::forget('edit_cart');
            }
        }
    }

    public function destroy(int $id)
    {
        if (Auth::check()) {
            $check = OrderDetail::query()->where('order_id','=',$id)->first();
            if($check){
                return 0;
            } else{
                $query = Order::query()->where('id','=',$id)->first();
                if($query){
                    $query->delete();
                    return 1;
                }
            }
        }
    }

    public function add_cart(Request $request)
    {
        if (Auth::check()) {
            $detail = ImportDetail::query()->select('brands.name as brand_name','products.name as product_name','products.brand_id','importdetails.*')
                ->join('products','products.id','=','importdetails.product_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->where('product_code','=',$request->input('code'))
                ->first();
            $session_id = substr(md5(microtime()),rand(0,26),5);
            $cart = Session::get($request->input('type'));
            if ($cart == true) {
                $check = 0;
                foreach ($cart as $key => $val) {
                    if ($val['product_code'] == $request->input('code')) {
                        $check++;
                    }
                }
                if ($check == 0) {
                    $cart[] = array(
                        'session_id' => $session_id,
                        'product_code' => $detail->product_code,
                        'product_name' => $detail->brand_name .' '. $detail->product_name,
                        'product_image' => $detail->image,
                        'product_quantity' => '1',
                        'product_iprice' => $detail->import_price,
                        'product_price' => $detail->sell_price,
                    );
                    Session::put($request->input('type'),$cart);
                    return 1;
                } else{
                    return 0;
                }
            } else {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_code' => $detail->product_code,
                    'product_name' => $detail->brand_name .' '. $detail->product_name,
                    'product_image' => $detail->image,
                    'product_quantity' => '1',
                    'product_iprice' => $detail->import_price,
                    'product_price' => $detail->sell_price,
                );
                Session::put($request->input('type'),$cart);
                return 1;
            }
        }
    }

    public function update_cart(Request $request)
    {
        if (Auth::check()) {
            $cart = Session::get($request->input('type'));
            if ($cart == true) {
                foreach ($cart as $key => $val) {
                    if ($val['session_id'] == $request->input('session_id')) {
                        $cart[$key]['product_quantity'] = $request->input('product_quantity');
                    }
                }
                Session::put($request->input('type'),$cart);
            } else {
                return 0;
            }
        }
    }

    public function destroy_cart(Request $request)
    {
        if (Auth::check()) {
            $cart = Session::get($request->input('type'));
            if ($cart == true) {
                foreach ($cart as $key => $val) {
                    if ($val['session_id'] == $request->session_id) {
                        unset($cart[$key]);
                    }
                }
                Session::put($request->input('type'),$cart);
                return 1;
            } else {
                return 0;
            }
        }
    }
    public function feeship(Request $request)
    {
        if (Auth::check()) {
            Session::put($request->input('type'),$request->input('value'));
        }
    }

    public function load_cart(Request $request)
    {
        // Session::forget('cart');
        if (Auth::check()) {
            if (Session::get($request->input('cart'))) {
                $output = '
            <table class="table table-separate table-head-custom table-checkable display nowrap" cellspacing="0" width="100%" id="table_'.$request->input('cart').'">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá bán</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th></th>
                    </tr>
                </thead>';
                $i = 1;
                $total = 0;
                $total_fee = 0;
                $total_coupon = 0;
                $iprice = 0;
                foreach (Session::get($request->input('cart')) as $key => $cart) {
                    $subtotal = $cart['product_price'] * $cart['product_quantity'];
                    $iprice += $cart['product_iprice'];
                    $total += $subtotal;
                    $detail = ImportDetail::query()->where('product_code','=',$cart['product_code'])->first();
                    $import = Import::query()->where('id','=',$detail->import_id)->first();
                    $detail_count = ImportDetail::query()->where('import_id','=',$detail->import_id)->count();
                    $fee = $import->import_fee_ship / $detail_count;
                    $total_fee += $fee;
                    $output .= '
                <tr>
                    <td>' . $i++ . '</td>';
                    if ($cart['product_image']) {
                        $output .= '
                        <td>
                            <div class="cart__shape">
                                <img class="cart__img" src="' . asset('uploads/import/' . $cart['product_image']) . '" alt="IMG">
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
                    <td>' . $cart['product_name'] . '</td>
                    <td>' . number_format($cart['product_price'],0,',','.') . 'đ</td>';
                    $check_qty = ImportDetail::query()->where('product_code',$cart['product_code'])->first();
                    if ($check_qty) {
                        $output .= '<input class="product_quantity_' . $cart['session_id'] . '" type="hidden" value="' . $check_qty->quantity - $check_qty->soldout. '">';
                    }
                    $output .= '
                    <td>
                        <div class="wrap-num-product flex-w">
                            <div data-session_id="' . $cart['session_id'] . '" class="btn-num-product-down hov-btn3 flex-c-m">
                                <i class="las la-minus"></i>
                            </div>
                            <input data-type="'.$request->input('cart').'" data-session_id="' . $cart['session_id'] . '" class="cart_qty txt-center num-product" type="number" value="' . $cart['product_quantity'] . '">
                            <div data-session_id="' . $cart['session_id'] . '" class="btn-num-product-up hov-btn3 flex-c-m">
                                <i class="las la-plus"></i>
                            </div>
                        </div>
                    </td>
                    <td>' . number_format($subtotal,0,',','.') . 'đ</td>
                    <td> <i style="cursor: pointer" data-type="cart" data-session_id="' . $cart['session_id'] . '" class="destroy_cart la la-trash"></td>
                </tr>';
                }
                $output .= '
                    </table>
                    </div>
                </div>
            </div>
            <div style="margin-top: 20px" class="row form-group">
                <div style="width: 10%">Tổng:</div>
                <div style="width: 90%">
                    ' . number_format($total,0,',','.') . 'đ' . '
                </div>
                ';
                if (Session::get($request->input('coupon'))) {
                    foreach (Session::get($request->input('coupon')) as $key => $cou) {
                        if ($cou['condition'] == 0) {
                            $total_coupon = ($total * $cou['number']) / 100;
                            $output .= '
                            <div style="width: 10%">Giảm giá:</div>
                            <div style="width: 90%">
                                ' . $cou['number'] . '% (' . number_format($total_coupon,0,',','.') . ' đ)' . '
                            </div>';
                        } else {
                            $total_coupon = $cou['number'];
                            $output .= '
                            <div style="width: 10%">Giảm giá:</div>
                            <div style="width: 90%">
                                ' . number_format($total_coupon,0,',','.') . 'đ' . '
                            </div>';
                        }
                    }
                }
                if ($iprice + $total_fee > $total - $total_coupon) {
                    $intomoney = $iprice + $total_fee;
                } else {
                    $intomoney = $total - $total_coupon;
                }
                if (Session::get($request->input('fee'))) {
                    $fee_ship = Session::get($request->input('fee'));
                    $intomoney += $fee_ship;
                    $output .= '
                    <div style="width: 10%">Phí lắp đặt:</div>
                    <div style="width: 90%">
                        ' . number_format($fee_ship,0,',','.') . 'đ' . '
                    </div>';
                }
                $output .= '
                <div style="width: 10%">Thành tiền:</div>
                <div style="width: 90%">
                    ' . number_format($intomoney,0,',','.') . 'đ' . '
                </div>
            </div>
            ';
            } else {
                $output = '';
            }
            return $output;
        }
    }
    public function edit_cart(int $id)
    {
        if (Auth::check()) {
            $detail = OrderDetail::query()->select('brands.name as brand_name','products.name as product_name','importdetails.*','orderdetails.*')
                ->join('importdetails','importdetails.product_code','=','orderdetails.product_code')
                ->join('products','products.id','=','importdetails.product_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->where('orderdetails.order_id','=',$id)
                ->get();
            if($detail){
                $session_id = substr(md5(microtime()),rand(0,26),5);
                foreach ($detail as $key){
                    $cart[] = array(
                        'session_id' => $session_id,
                        'product_code' => $key->product_code,
                        'product_name' => $key->brand_name .' '. $key->product_name,
                        'product_image' => $key->image,
                        'product_quantity' => $key->quantity,
                        'product_iprice' => $key->import_price,
                        'product_price' => $key->sell_price,
                    );
                }
                Session::put('edit_cart',$cart);
            }
        }
    }
}
