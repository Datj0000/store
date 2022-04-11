
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Phiếu nhập kho hàng</title>
    <style>
        body{
            font-family: DejaVu Sans;
            font-size: 14px;
        }
        @page {
            size: A4;
        }
        .footer-left {
            text-align:center;
            padding-top:24px;
            position:relative;
            height: 150px;
            width:50%;
            color:#000;
            float:left;
            font-size: 12px;
            bottom:1px;
        }
        .footer-right {
            text-align:center;
            padding-top:24px;
            position:relative;
            height: 150px;
            width:50%;
            color:#000;
            font-size: 12px;
            float:right;
            bottom:1px;
        }
        .TableData {
            background:#ffffff;
            font: 11px;
            width:100%;
            border-collapse:collapse;
            font-size:12px;
            border:thin solid #d3d3d3;
        }
        .TableData TH {
            text-align: center;
            font-weight: bold;
            color: #000;
            border: solid 1px #ccc;
            height: 24px;
            padding: 7px 0;
        }
        .TableData TR {
            height: 24px;
            border:thin solid #d3d3d3;
        }
        .TableData TR TD {
            padding-right: 2px;
            padding-left: 2px;
            border:thin solid #d3d3d3;
        }
        .TableData TR:hover {
            background: rgba(0,0,0,0.05);
        }
        .TableData .tong {
            text-align: right;
            font-weight:bold;
            padding-right: 4px;
        }
        img{
            width: 15%;
            /*opacity: .2;*/
            position: fixed;
            top: -1%;
            left: -1%;
        }
    </style>
</head>
<body>
<div>
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('asset/media/logos/logo2.png'))) }}">
    <center>
        <h3>CÔNG TY CỔ PHẦN GIẢI PHÁP SỐ FUNNY DEV</h3>
        Số 2, Trần Nhân Tông, Phường Thanh Sơn, Uông Bí, Quảng Ninh<br>
        Website: www.maytinhuongbi24h.vn - MST: 5702056524 - Hotline: 1900.633.918
    </center>
    <p style="float: right; font-size:13px">Ngày {{date('d',strtotime($order['created_at']))}} tháng {{date('m',strtotime($order['created_at']))}} năm {{date('Y',strtotime($order['created_at']))}}</p>
    <br>
    <br>
    <h3>
        <center>PHIẾU XUẤT KHO HÀNG<br>
            <span style="font-weight:bold; font-style:italic; color:#000000; font-size:13px">(Kiêm chứng nhận bảo hành theo chính sách công ty)</span><br>
            <span style="font-size:13px">Số: {{$order['code']}}</span><br>
            <span> -------oOo-------</span>
        </center>
    </h3>
    <h4>Khách hàng</h4>
        Họ và tên: {{$customer->name}}<br>
        Điện thoại: {{$customer->phone}}<br>
        Địa chỉ: {{$customer->address}}<br>
    <h4>Đơn hàng</h4>
</div>
<table class="TableData">
    <thead>
    <tr>
        <th>STT</th>
        <th>Mã sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Bảo hành</th>
        <th>Đơn giá</th>
        <th>Thành tiền</th>
    </tr>
    </thead>
    <tbody>
    @php
        $i = 1;
        $total = 0;
        $iprice = 0;
        $count = 0;
        $intomoney = 0;
    @endphp
    @foreach($details as $item)
        @php
            $subtotal = $item->sell_price * $item->quantity;
            $total += $subtotal;
            $date_start = \Carbon\Carbon::parse($item->date_start)->floorMonth();
            $date_end = \Carbon\Carbon::parse($item->date_end)->floorMonth();
            $diff = $date_end->diffInMonths($date_start);
            $iprice += $item->import_price;
            $detail = \App\Models\ImportDetail::query()->where('product_code','=',$item->product_code)->first();
            $detail_count = \App\Models\ImportDetail::query()->where('import_id','=',$detail->import_id)->get();
            foreach($detail_count as $key){
                $count += $key->quantity;
            }
            $import = \App\Models\Import::query()->where('id','=',$detail->import_id)->first();
            $total_fee = $import->fee_ship / $count;
            $total_fee = ceil($total_fee);
        @endphp
        <tr>
            <td align='center'>{{$i++}}</td>
            <td align='center'>{{ $item->product_code}}</td>
            <td>{{$item->brand_name }} {{ $item->product_name}} </td>
            <td align='center'>{{$item->quantity}} {{$item->unit_name}}</td>
            <td align='center'>{{$diff}} tháng</td>
            <td align='right'>{{number_format($item->sell_price, 0, ',', '.')}}đ</td>
            <td align='right'>{{number_format($subtotal, 0, ',', '.')}}đ</td>
        <tr>
    @endforeach
    <tr>
        <td colspan="6" class="tong">Tổng cộng</td>
        <td class="cotSo" align='right'>{{number_format($total, 0, ',', '.')}}đ</td>
    </tr>
    @if($order->coupon)
        @php
            $coupon = \App\Models\Coupon::query()->where('code','=',$order->coupon)->first();
            if($coupon->condition == 0){
                $total_coupon = ($total * $coupon->number) / 100;
            } else{
                $total_coupon = $coupon->number;
            }
            if ($iprice + $total_fee > $total - $total_coupon) {
                $total_coupon = $iprice + $total_fee;
                $intomoney = $iprice + $total_fee;
            } else {
                $intomoney = $total - $total_coupon;
            }
        @endphp
        <tr>
            <td colspan="6" class="tong">Giảm giá</td>
            <td class="cotSo" align='right'>{{number_format($total_coupon, 0, ',', '.')}}đ</td>
        </tr>
    @endif
    @if($order->fee_ship)
        <?php
            $intomoney += $order->fee_ship
        ?>
        <tr>
            <td colspan="6" class="tong">Phí ship</td>
            <td class="cotSo" align='right'>{{number_format($order->fee_ship, 0, ',', '.')}}đ</td>
        </tr>
    @endif
    <tr>
        <td colspan="6" class="tong">Thành tiền</td>
        <td class="cotSo" align='right'>{{number_format($intomoney, 0, ',', '.')}}đ</td>
    </tr>
</table>
<div class="footer-left">
    Người mua <br>
    <span style="font-style:italic; font-size:13px">(Ký và ghi rõ họ tên)</span>
</div>
<div class="footer-right">
    Người lập phiếu <br>
    <span style="font-style:italic; font-size:12px">(Ký và ghi rõ họ tên)</span>
</div>
</div>
</body>
</html>
