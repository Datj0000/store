<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;

class DeliveryController extends Controller
{
    public function load_city(){
        $output = '';
        $select_city = City::all();
        $output .= '<option value disabled selected hidden>Chọn tỉnh thành phố</option>';
        foreach ($select_city as $key => $city) {
            $output .= '<option value="' . $city->matp . '">' . $city->name_city . '</option>';
        }
        echo $output;
    }
    public function select_delivery(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = Province::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option value disabled selected hidden>Chọn quận huyện</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {

                $select_wards = Wards::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option value disabled selected hidden>Chọn xã phường</option>';

                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
    }
}
