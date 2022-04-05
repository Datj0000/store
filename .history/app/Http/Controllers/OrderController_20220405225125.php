<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $data = order::query()->whereId($id)->first();
            return response()->json($data);
        }
    }

    public function update(Request $request,int $id)
    {
        if (Auth::check()) {
            $order = order::query()->whereId($id)->first();
            $order->supplier_id = $request->supplier_id;
            $order->order_fee_ship = $request->order_fee_ship;
            $order->save();
        }
    }

    public function destroy(int $id)
    {
        if (Auth::check()) {
            $check = orderDetail::query()->where('order_id','=',$id)->first();
            if($check){
                return 0;
            } else{
                order::query()->whereId($id)->delete();
                return 1;
            }
        }
    }
}
