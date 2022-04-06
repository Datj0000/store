<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (Auth::check()) {
            return view('user.event.coupon');
        }
        return view('auth.login');
    }
    public function fetchdata():\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Coupon::query()->get();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request):int
    {
        if (Auth::check()) {
            $check = Coupon::query()->where('coupon_code','=', $request->coupon_code)->first();
            if (!$check){
                $coupon = new Coupon();
                $coupon->coupon_name = $request->coupon_name;
                $coupon->coupon_code = $request->coupon_code;
                $coupon->coupon_condition = $request->coupon_condition;
                $coupon->coupon_number = $request->coupon_number;
                $coupon->coupon_date_start = Carbon::parse($request->coupon_date_start)->format('Y-m-d');
                $coupon->coupon_date_end = Carbon::parse($request->coupon_date_end)->format('Y-m-d');
                $coupon->coupon_status = $request->coupon_status;
                $coupon->save();
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function edit(int $id):\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Coupon::query()->whereId($id)->first();
            return response()->json($data);
        }
    }
    public function status(Request $request,int $id)
    {
        if (Auth::check()) {
            $coupon = Coupon::query()->whereId($id)->first();
            $coupon->coupon_status = $request->coupon_status;
            $coupon->save();
        }
    }
    public function update(Request $request, int $id):int
    {
        if (Auth::check()) {
            $check = Coupon::query()->where('coupon_code','=', $request->coupon_code)->where('id','!=', $id)->first();
            if (!$check){
                $coupon = Coupon::query()->whereId($id)->first();
                $coupon->coupon_name = $request->coupon_name;
                $coupon->coupon_code = $request->coupon_code;
                $coupon->coupon_condition = $request->coupon_condition;
                $coupon->coupon_number = $request->coupon_number;
                $coupon->coupon_date_start = Carbon::parse($request->coupon_date_start)->format('Y-m-d');
                $coupon->coupon_date_end = Carbon::parse($request->coupon_date_end)->format('Y-m-d');
                $coupon->save();
                return 1;
            } else{
                return 0;
            }
        }
    }

    public function destroy(int $id):int
    {
        if (Auth::check()) {
            Coupon::query()->whereId($id)->delete();
            return 1;
        }
    }
    public function autocomplete(Request $request)
    {
        if (Auth::check()) {
            $data = $request->all();
            // $coupon = Coupon::query()->where('coupon_status','=', 0)->where('coupon_code', $request->query)->get();
            $coupon = Coupon::query()->where('coupon_status','=', 0)->where('coupon_code', 'LIKE', '%' . $data['query']. '%')->get();
            if ($coupon->count() > 0) {
                $output = '
                <ul class="dropdown-menu2">';
                foreach ($coupon as $key => $val) {
                    $output .= '
                        <li class="li_search_coupon">' . $val->coupon_code . '</li>
                   ';
                }
                $output .= '</ul>';
                return $output;
            }
        }
    }
}
