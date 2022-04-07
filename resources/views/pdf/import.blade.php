<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hoá đơn nhập hàng</title>
    <style>
        body{
            font-family: DejaVu Sans;
            font-size: 14px;
        }
        @page {
            size: A4;
        }
        .logo {
            background-color:#FFFFFF;
            text-align:left;
            float:left;
        }
        .company {
            float:right;
            font-size:16px;
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
            background: rgba(0,0,255,0.1);
            text-align: center;
            font-weight: bold;
            color: #000;
            border: solid 1px #ccc;
            height: 24px;
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
    </style>
</head>
<body>
    <div>
{{--        <div class="logo"><img src="https://ibb.co/58vZcCm" /></div>--}}
        <div class="company">C.Ty CP Giải pháp số FunnyDev</div>
    </div>
    <br>
    <br>
    <h3><center>HÓA ĐƠN NHẬP HÀNG</center></h3>
    <h4><center>-------oOo-------</center></h4>
    <h4>Thông tin nhà cung cấp</h4>
        Tên nhà cung cấp: {{$supplier->supplier_name}}<br>
        Email: {{$supplier->supplier_email}}<br>
        Điện thoại: {{$supplier->supplier_phone}}<br>
        Địa chỉ: {{$supplier->supplier_address}}<br>
    <h4>Đơn hàng</h4>
    <table class="TableData">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
            $total = 0;
        @endphp
        @foreach($details as $item)
            @php
                $subtotal = $item->detail_import_price * $item->detail_quantity;
                $total += $subtotal;
            @endphp
            <tr>
                <td>{{$i++}}</td>
                <td>{{$item->product_name}}</td>
                <td align='center'>{{$item->detail_quantity}}</td>
                <td align='right'>{{number_format($item->detail_import_price, 0, ',', '.')}}đ</td>
                <td align='right'>{{number_format($subtotal, 0, ',', '.')}}đ</td>
            <tr>
        @endforeach
            <tr>
                <td colspan="4" class="tong">Tổng cộng</td>
                <td class="cotSo" align='right'>{{number_format($total, 0, ',', '.')}}đ</td>
            </tr>
        </table>
        <div class="footer-left"> Uông Bí, ngày ... tháng ... năm {{ date('Y') }}<br/>
            Nhà cung cấp </div>
        <div class="footer-right"> Uông Bí, ngày ... tháng ... năm {{ date('Y') }}<br/>
            Nhân viên </div>
    </div>
</body>
</html>
