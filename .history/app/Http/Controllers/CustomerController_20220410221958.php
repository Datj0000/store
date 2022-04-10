<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('user.customer.customer');
        }
        return Redirect::to('/login');
    }

    public function fetchdata()
    {
        if (Auth::check()) {
            $data = Customer::query()->get();
            return response()->json([
                "data" => $data->toArray(),
            ]);
        }
    }

    public function create(Request $request)
    {
        if (Auth::check()) {
            $check = Customer::query()->where('name','=',$request->input('name'))->where('phone','=',$request->input('phone'))->first();
            if (!$check){
                Customer::query()->create([
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'role' => $request->input('role'),
                ]);
                return 0;
            } else{
                return 1;
            }
        }
    }

    public function edit(int $id)
    {
        if (Auth::check()) {
            $query = Customer::query()->where('id','=',$id)->first();
            if($query){
                return response()->json($query->toArray());
            }
        }
    }

    public function update(Request $request,int $id)
    {
        if (Auth::check()) {
            $check = Customer::query()->where('name','=',$request->input('name'))->where('phone','=',$request->input('phone'))->where('id','!=',$id)->first();
            if (!$check) {
                Customer::query()->where('id','=',$id)->update([
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'role' => $request->input('role'),
                ]);
                return 0;
            } else {
                return 1;
            }
        }
    }
    public function destroy(int $id)
    {
        if (Auth::check()) {
            $check = Order::query()->where('customer_id','=',$id)->first();
            if($check){
                return 0;
            } else{
                $query = Customer::query()->where('id','=',$id)->first();
                if($query){
                    $query->delete();
                    return 1;
                }
            }
        }
    }
    public function autocomplete(Request $request)
    {
        if (Auth::check()) {
            $customer = Customer::query()->where('name','LIKE','%' .  $request->input('value') . '%')
            ->orwhere('phone','LIKE','%' . $request->input('value') . '%')->get();
                $output = '<ul class="dropdown-menu2">';
                            '<li class="li_add_customer">Thêm khách hàng mới</li>';
                if ($customer->count() > 0) {
                    foreach ($customer as $key => $val) {
                        $output .= '
                            <li class="li_search_customer" data-id="'.$val->id.'">' . $val->name . ' - ' . $val->phone . '</li>
                       ';
                    }
                }
                $output .= '</ul>';
                return $output;
        }
    }
}
