<?php

namespace App\Http\Controllers;

use App\Models\Import;
use App\Models\ImportDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $customer = Customer::query()->get();
            return view('user.order.order')
                ->with('customer',$customer);
        }
        return view('auth.login');
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
            $order = new Order();
            do {
                $code = rand(106890122,1000000000);
                $check = Order::query()->where('code','=',$code)->first();
            }
            while ($check);
            $order->code = $code;
            $order->customer_id = $request->customer_id;
            $order->methodpay = $request->method_pay;
            if (Session::get('fee')){
                $order->fee_ship = Session::get('fee');
                Session::forget('fee');
            }
            if (Session::get('coupon')){
                $order->coupon = Session::get('coupon');
                Session::forget('coupon');
            }
            $order->save();
            if (Session::get('cart')) {
                foreach (Session::get('cart') as $key => $cart) {
                    $details = new OrderDetail();
                    $details->id = $order->id;
                    $details->product_code = $cart['product_code'];
                    $details->quantity = $cart['product_quantity'];
                    $details->save();
                    $import = ImportDetail::query()->where('product_code',$details->product_code)->first();
                    $import->detail_soldout = $cart['product_quantity'];
                    $import->save();
                }
                Session::forget('cart');
            }
        }
    }

    public function edit(int $id)
    {
        if (Auth::check()) {
            Session::forget('edit_fee');
            Session::forget('edit_coupon');
            Session::forget('edit_cart');
            $data = Order::query()->select('customers.customer_name','customers.customer_phone','orders.*')
                ->join('customers','customers.id','=','orders.customer_id')
                ->where('orders.id','=',$id)->first();
            return response()->json($data);
        }
    }

    public function update(Request $request,int $id)
    {
        if (Auth::check()) {
            $order = Order::query()->where('id','=',$id)->first();
            $order->supplier_id = $request->supplier_id;
            $order->fee_ship = $request->fee_ship;
            $order->save();
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

    public function load_cart()
    {
        if (Auth::check()) {
            if (Session::get('cart')) {
                $output = '
            <table class="table table-separate table-head-custom table-checkable display nowrap" cellspacing="0" width="100%" id="table_cart">
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
                foreach (Session::get('cart') as $key => $cart) {
                    $subtotal = $cart['product_price'] * $cart['product_quantity'];
                    $iprice += $cart['product_iprice'];
                    $total += $subtotal;
                    $detail = ImportDetail::query()->where('product_code','=',$cart['product_code'])->first();
                    $import = Import::query()->whereId($detail->import_id)->first();
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
                            <div data-type="cart" data-session_id="' . $cart['session_id'] . '" class="btn-num-product-down hov-btn3 flex-c-m">
                                <i class="las la-minus"></i>
                            </div>
                            <input data-type="cart" data-session_id="' . $cart['session_id'] . '" class="cart_qty txt-center num-product" type="number" value="' . $cart['product_quantity'] . '">
                            <div data-type="cart" data-session_id="' . $cart['session_id'] . '" class="btn-num-product-up hov-btn3 flex-c-m">
                                <i class="las la-plus"></i>
                            </div>
                        </div>
                    </td>
                    <td>' . number_format($subtotal,0,',','.') . 'đ</td>
                    <td> <i style="cursor: pointer" data-session_id="' . $cart['session_id'] . '" class="destroy_cart la la-trash"></td>
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
                if (Session::get('coupon')) {
                    foreach (Session::get('coupon') as $key => $cou) {
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
                if (Session::get('fee')) {
                    $total_fee = Session::get('fee');
                    $intomoney += $total_fee;
                    $output .= '
                    <div style="width: 10%">Phí lắp đặt:</div>
                    <div style="width: 90%">
                        ' . number_format($total_fee,0,',','.') . 'đ' . '
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
    public function load_edit_cart(int $id)
    {
        if (Auth::check()) {
            $detail = OrderDetail::query()->select('brands.name as brand_name','products.name as product_name','importdetails.*','orderdetails.*')
                ->join('importdetails','importdetails.product_code','=','orderdetails.product_code')
                ->join('products','products.id','=','importdetails.product_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->where('id','=',$id)
                ->get();
            $session_id = substr(md5(microtime()),rand(0,26),5);
            foreach ($detail as $key)
            $cart[] = array(
                'session_id' => $session_id,
                'product_code' => $key->product_code,
                'product_name' => $key->brand_name .' '. $key->product_name,
                'product_image' => $key->image,
                'product_quantity' => $key->quantity,
                'product_iprice' => $key->import_price,
                'product_price' => $key->sell_price,
            );
            Session::put('edit_cart',$cart);
            if (Session::get('edit_cart')) {
                $output = '
            <table class="table table-separate table-head-custom table-checkable display nowrap" cellspacing="0" width="100%" id="table_edit_cart">
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
                foreach (Session::get('edit_cart') as $key => $cart) {
                    $subtotal = $cart['product_price'] * $cart['product_quantity'];
                    $iprice += $cart['product_iprice'];
                    $total += $subtotal;
                    $detail = ImportDetail::query()->where('product_code','=',$cart['product_code'])->first();
                    $import = Import::query()->whereId($detail->import_id)->first();
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
                                <img class="cart__img" src="' . asset('public/uploads/product/' . $cart['product_image']) . '" alt="IMG">
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
                        $output .= '<input class="product_quantity_' . $cart['session_id'] . '" type="hidden" value="' . $check_qty->detail_quantity - $check_qty->detail_soldout. '">';
                    }
                    $output .= '
                    <td>
                        <div class="wrap-num-product flex-w">
                            <div data-type="edit_cart" data-session_id="' . $cart['session_id'] . '" class="btn-num-product-down hov-btn3 flex-c-m">
                                <i class="las la-minus"></i>
                            </div>
                            <input data-type="edit_cart" data-session_id="' . $cart['session_id'] . '" class="cart_qty txt-center num-product" type="number" value="' . $cart['product_quantity'] . '">
                            <div data-type="edit_cart" data-session_id="' . $cart['session_id'] . '" class="btn-num-product-up hov-btn3 flex-c-m">
                                <i class="las la-plus"></i>
                            </div>
                        </div>
                    </td>
                    <td>' . number_format($subtotal,0,',','.') . 'đ</td>
                    <td> <i style="cursor: pointer" data-session_id="' . $cart['session_id'] . '" class="destroy_cart la la-trash"></td>
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
                if (Session::get('edit_coupon')) {
                    foreach (Session::get('edit_coupon') as $key => $cou) {
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
                if (Session::get('edit_fee')) {
                    $total_fee = Session::get('edit_fee');
                    $intomoney += $total_fee;
                    $output .= '
                    <div style="width: 10%">Phí lắp đặt:</div>
                    <div style="width: 90%">
                        ' . number_format($total_fee,0,',','.') . 'đ' . '
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
}
