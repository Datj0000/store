<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (Auth::check()) {
            return view('user.customer.customer');
        }
        return view('auth.login');
    }

    public function fetchdata():\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Customer::query()->get();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request):int
    {
        if (Auth::check()) {
            $check = Customer::query()->where('customer_name', '=', $request->customer_name)->where('customer_phone','=', $request->customer_phone)->first();
            if (!$check){
                $customer = new Customer();
                $customer->customer_name = $request->customer_name;
                $customer->customer_phone = $request->customer_phone;
                $customer->customer_address = $request->customer_address;
                $customer->customer_role = $request->customer_role;
                $customer->save();
                return 0;
            } else{
                return 1;
            }
        }
    }

    public function edit(int $id):\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = Customer::query()->whereId($id)->first();
            return response()->json($data);
        }
    }

    public function update(Request $request, int $id)
    {
        if (Auth::check()) {
            $check = Customer::query()->where('customer_name', '=', $request->customer_name)->where('customer_phone', '=', $request->customer_phone)->where('id', '!=', $id)->first();
            if (!$check) {
                $customer = Customer::query()->whereId($id)->first();
                $customer->customer_name = $request->customer_name;
                $customer->customer_phone = $request->customer_phone;
                $customer->customer_address = $request->customer_address;
                $customer->customer_role = $request->customer_role;
                $customer->save();
                return 0;
            } else {
                return 1;
            }
        }
    }
    public function destroy(int $id)
    {
        if (Auth::check()) {
            Customer::query()->whereId($id)->delete();
        }
    }
    public function autocomplete(Request $request)
    {
        $data = $request->all();
        if ($data['query']) {
            $customer = Customer::query()->where('customer_name', 'LIKE', '%' . $data['query'] . '%')->get();
            if ($customer->count() > 0) {
                $output = '
                <ul class="dropdown-menu2">';
                foreach ($customer as $key => $val) {
                    $output .= '
                        <li class="li_search_customer" data-id="'.$val->id.'">' . $val->customer_name . ' - ' . $val->customer_phone . '</li>
                   ';
                }
                $output .= '</ul>';
                return $output;
            }
        }
        if (Auth::check()) {
            $customer = Customer::query()->where('customer_name', 'LIKE', '%' . $data['query'] . '%')->get();
            if ($customer->count() > 0) {
                $output = '
                <ul class="dropdown-menu2">';
                foreach ($customer as $key => $val) {
                    $output .= '
                        <li class="li_search_customer" data-id="'.$val->id.'">' . $val->customer_name . ' - ' . $val->customer_phone . '</li>
                   ';
                }
                $output .= '</ul>';
                return $output;
            }
        }
    }
}
