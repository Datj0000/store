<?php

namespace App\Http\Controllers;

use App\Models\ImportDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index():\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (Auth::check()) {
            $customer = Customer::query()->get();
            return view('user.order.order')
                ->with('customer', $customer);
        }
        return view('auth.login');
    }

    public function fetchdata():\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Order::query()->select('customers.customer_name', 'orders.*')
                ->join('customers', 'customers.id', '=', 'orders.customer_id')
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
            $order->customer_id = $request->customer_id;
            $order->order_fee_ship = $request->order_fee_ship;
            $order->save();
            return 1;
        }
    }

    public function edit(int $id):\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Order::query()->whereId($id)->first();
            return response()->json($data);
        }
    }

    public function update(Request $request,int $id)
    {
        if (Auth::check()) {
            $order = Order::query()->whereId($id)->first();
            $order->supplier_id = $request->supplier_id;
            $order->order_fee_ship = $request->order_fee_ship;
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
                Order::query()->whereId($id)->delete();
                return 1;
            }
        }
    }
    public function add_cart($code)
    {
        if (Auth::check()) {
            $detail = ImportDetail::query()->select('brands.brand_name', 'products.product_name', 'products.brand_id', 'importdetails.*')
                ->join('products', 'products.id', '=', 'importdetails.product_id')
                ->join('brands', 'brands.id', '=', 'products.brand_id')
                ->where('product_code','=', $code)
                ->first();
            $session_id = substr(md5(microtime()), rand(0, 26), 5);
            $cart = Session::get('cart');
            if ($cart == true) {
                $check = 0;
                foreach ($cart as $key => $val) {
                    if ($val['product_code'] == $code) {
                        $check++;
                    }
                }
                if ($check == 0) {
                    $cart[] = array(
                        'session_id' => $session_id,
                        'product_code' => $detail->product_code,
                        'product_name' => $detail->brand_name .' '. $detail->product_name,
                        'product_image' => $detail->detail_image,
                        'product_quantity' => '1',
                        'product_price' => $detail->detail_sell_price,
                    );
                    Session::put('cart', $cart);
                    return 1;
                }
                return 0;
            } else {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_code' => $detail->product_code,
                    'product_name' => $detail->brand_name .' '. $detail->product_name,
                    'product_image' => $detail->detail_image,
                    'product_quantity' => '1',
                    'product_price' => $detail->detail_sell_price,
                );
                Session::put('cart', $cart);
                return 1;
            }
        }
    }
    public function update_cart(Request $request)
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $request->session_id) {
                    $cart[$key]['product_quantity'] = $request->product_quantity;
                }
            }
            Session::put('cart', $cart);
        } else {
            return 0;
        }
    }

    public function destroy_cart($session_id)
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return 1;
        } else {
            return 0;
        }
    }

    public function load_cart()
    {
//        unset($_SESSION['cart']);
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
            foreach (Session::get('cart') as $key => $cart) {
                $subtotal = $cart['product_price'] * $cart['product_quantity'];
                $total += $subtotal;
                $output .= '
                <tr>
                    <td>'.$i++.'</td>';
                    if($cart['product_image']){
                        $output .= '
                        <td>
                            <div class="cart__shape">
                                <img class="cart__img" src="' . asset('public/uploads/product/' . $cart['product_image']) . '" alt="IMG">
                            </div>
                        </td>';
                    }else{
                        $output .= '
                        <td>
                            <div class="cart__shape">
                                <img class="cart__img" src="' . asset('asset/media/users/noimage.png') . '" alt="IMG">
                            </div>
                        </td>';
                    }
                $output .= '
                    <td>'.$cart['product_name'].'</td>
                    <td>'.number_format($cart['product_price'], 0, ',', '.').'đ</td>';
                    $check_qty = ImportDetail::query()->where('product_code', $cart['product_code'])->first();
                    if($check_qty){
                        $output .= '
                        <input class="product_quantity_' . $cart['session_id'] . '" type="hidden" value="' . $check_qty->detail_quantity . '">
                        ';
                    }
                    $output .= '
                    <td>
                        <div class="wrap-num-product flex-w">
                            <div data-session_id="' . $cart['session_id'] . '" class="btn-num-product-down hov-btn3 flex-c-m">
                                <i class="las la-minus"></i>
                            </div>
                            <input data-session_id="' . $cart['session_id'] . '" class="cart_qty txt-center num-product" type="number" value="' . $cart['product_quantity'] . '">
                            <div data-session_id="' . $cart['session_id'] . '" class="btn-num-product-up hov-btn3 flex-c-m">
                                <i class="las la-plus"></i>
                            </div>
                        </div>
                    </td>
                    <td>' . number_format($subtotal, 0, ',', '.') . 'đ</td>
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
                    ' . number_format($total, 0, ',', '.') . 'đ' . '
                </div>
                ';
            if (Session::get('coupon')) {
                foreach (Session::get('coupon') as $key => $cou) {
                    if ($cou['coupon_condition'] == 1) {
                        $total_coupon = ($total * $cou['coupon_number']) / 100;
                        $output .= '
                        <div style="width: 10%">Giảm giá:</div>
                        <div style="width: 90%">
                            ' . $cou['coupon_number'] . '% (' . number_format($total_coupon, 0, ',', '.') . ' đ' . '
                        </div>
                    ';
                    } else {
                        $total_coupon = $cou['coupon_number'];
                        $output .= '
                        <div style="width: 10%">Giảm giá:</div>
                        <div style="width: 90%">
                            ' . number_format($total_coupon, 0, ',', '.') . 'đ' . '
                        </div>
                    ';
                    }
                }
            }
            $output .= '
                <div style="width: 10%">Thành tiền:</div>
                <div style="width: 90%">
                    ' . number_format($total, 0, ',', '.') . 'đ' . '
                </div>
            </div>
            ';
        }else{
            $output = '';
        }
        return $output;
    }
}
