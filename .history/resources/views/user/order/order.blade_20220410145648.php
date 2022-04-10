<style>
    .dropdown-menu2 {
        width: 100%;
        padding: .5rem 0;
        margin: .125rem 0 0;
        font-size: 1rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0,0,0,.15);
        border-radius: .25rem;
        padding-left: 20px;
        cursor: pointer;
    }
    .dropdown-menu2 li{
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .dropdown-menu2 li:active,
    .dropdown-menu2 li:hover {
        color: #717fe0;
    }
    .show{
        display: block;
    }
    .hide{
        display: none;
    }
     .cart__shape {
         width: 5rem;
         height: 5rem;
         border: 1px solid #fff4de;
     }

    .cart__img {
        width: 100%;
        height: 100%
    }

    .wrap-num-product {
        width: 140px;
        height: 45px;
        border: 1px solid #e6e6e6;
        border-radius: 3px;
        overflow: hidden;
        float: left;
    }

    .btn-num-product-up,
    .btn-num-product-down {
        width: 45px;
        height: 100%;
        cursor: pointer;
    }

    .num-product {
        width: calc(100% - 90px);
        height: 100%;
        border-left: 1px solid #e6e6e6;
        border-right: 1px solid #e6e6e6;
        background-color: #f7f7f7;
    }

    input.num-product {
        -moz-appearance: textfield;
        appearance: none;
        -webkit-appearance: none;
        outline: none;
        border: none;
    }

    input.num-product::-webkit-outer-spin-button,
    input.num-product::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        outline: none;
        border: none;
    }
    .hov-btn3:hover {
        border-color: #717fe0;
        background-color: #717fe0;
        color: #fff;
    }

    .hov-btn3:hover i {
        color: #fff;
    }

    .flex-w,.flex-c-m {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        justify-content: center;
        -ms-align-items: center;
        align-items: center;
    }
    .txt-center {text-align: center;}
    .flex-w {
        -webkit-flex-wrap: wrap;
        -moz-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        -o-flex-wrap: wrap;
        flex-wrap: wrap;
    }
</style>
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách đơn hàng
                <span class="d-block text-muted pt-2 font-size-sm">Quản lý danh sách đơn hàng</span>
            </h3>
        </div>
        <div class="card-toolbar">
            <span class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#exampleModalPopovers2">
            <span class="svg-icon svg-icon-md">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24" />
                    <circle fill="#000000" cx="9" cy="15" r="6" />
                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                </g>
            </svg>
            </span>Thêm mới</span>
        </div>
    </div>
    {{-- Add --}}
    <div class="modal fade" id="exampleModalPopovers2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_create_order">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Khách hàng:</label>
                                <input type="hidden" name="customer" id="customer_id">
                                <input type="text" class="form-control form-control-solid" id="customer_name" placeholder="Tìm kiếm theo tên khách hàng hoặc số điện thoại" autocomplete="off" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                                <div id="search_customer"></div>
                            </div>
                            <div class="form-group">
                                <label>Hình thức giao hàng:</label>
                                <select name="method" id="order_method" class="form-control">
                                    <option value disabled selected hidden>Chọn hình thức giao hàng</option>
                                    <option value="0">Nhận tại cửa hàng</option>
                                    <option value="1">Giao đến nhà</option>
                                </select>
                            </div>
                            <div class="form-group feeship hide">
                                <label>Phí lắp đặt:</label>
                                <input name="feeship" type="number" class="form-control form-control-solid" id="order_fee_ship" placeholder="Phí lắp đặt" min="0" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Hình thức thanh toán:</label>
                                <select name="methodpay" id="order_methodpay" class="form-control">
                                    <option value disabled selected hidden>Chọn hình thức thanh toán</option>
                                    <option value="0">Tiền mặt</option>
                                    <option value="1">Chuyển khoản</option>
                                </select>
                            </div>
                            @if(Auth::user()->role <= 1)
                                <div class="form-group">
                                    <label>Mã giảm giá:</label>
                                    <input name="coupon" type="text" class="form-control form-control-solid" id="order_coupon" autocomplete="off" placeholder="Tìm kiếm theo mã giảm giá" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;" />
                                    <div id="search_coupon"></div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Sản phẩm:</label>
                                <input type="text" class="form-control form-control-solid" id="product_name" autocomplete="off" placeholder="Tìm kiếm sản phẩm theo mã vạch hoặc tên sản phẩm" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                                <div id="search_product"></div>
                            </div>
                            <div id="load_cart"></div>
                        </div>
                        <div class="card-footer">
                            <button id="create_order" type="button" class="btn btn-primary mr-2">Thêm mới</button>
                            <button type="reset" class="btn btn-secondary">Nhập lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalPopovers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_edit_order">
                        <div class="card-body">
                            <input type="hidden" id="edit_order_id">
                            <div class="form-group">
                                <label>Khách hàng:</label>
                                <input type="hidden" name="customer" id="edit_customer_id">
                                <input type="text" class="form-control form-control-solid" id="edit_customer_name" placeholder="Tìm kiếm theo tên khách hàng hoặc số điện thoại" autocomplete="off" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                                <div id="search_customer"></div>
                            </div>
                            <div class="form-group">
                                <label>Hình thức giao hàng:</label>
                                <select name="method" id="edit_order_method" class="form-control">
                                    <option value disabled selected hidden>Chọn hình thức giao hàng</option>
                                    <option value="0">Nhận tại cửa hàng</option>
                                    <option value="1">Giao đến nhà</option>
                                </select>
                            </div>
                            <div class="form-group feeship hide">
                                <label>Phí lắp đặt:</label>
                                <input name="feeship" type="number" class="form-control form-control-solid" id="edit_order_fee_ship" placeholder="Phí lắp đặt" min="0" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Hình thức thanh toán:</label>
                                <select name="methodpay" id="edit_order_methodpay" class="form-control">
                                    <option value disabled selected hidden>Chọn hình thức thanh toán</option>
                                    <option value="0">Tiền mặt</option>
                                    <option value="1">Chuyển khoản</option>
                                </select>
                            </div>
                            @if(Auth::user()->role <= 1)
                                <div class="form-group">
                                    <label>Mã giảm giá:</label>
                                    <input name="coupon" type="text" class="form-control form-control-solid" id="edit_order_coupon" autocomplete="off" placeholder="Tìm kiếm theo mã giảm giá" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;" />
                                    <div id="edit_search_coupon"></div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Sản phẩm:</label>
                                <input type="text" class="form-control form-control-solid" id="edit_product_name" autocomplete="off" placeholder="Tìm kiếm sản phẩm theo mã vạch hoặc tên sản phẩm" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                                <div id="edit_search_product"></div>
                            </div>
                            <div id="load_edit_cart"></div>
                        </div>
                        <div class="card-footer">
                            <button id="update_order" type="button" class="btn btn-primary mr-2">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-separate table-head-custom table-checkable display nowrap" cellspacing="0" width="100%" id="kt_datatable">
            <thead>
            <tr>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Thời gian tạo</th>
                <th>Tên khách hàng</th>
                <th>Thanh toán</th>
                <th>Chức năng</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script>
    load_cart();
    function feeship(type,value){
        axios({
            url: "feeship",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
            },
            data: {
                type: type,
                value: value
            },
        })
        .then(function (response) {
            if(type == 'cart'){
                load_cart();
            } else {
                var id = $('#edit_order_id').val();
                load_edit_cart(id);
            }
        });
    }
    function use_coupon(type,coupon){
        axios({
            url: "use-coupon",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
            },
            data:{
                type: type,
                coupon: coupon
            }
        })
        .then(function (response) {
            if(type == 'cart'){
                load_cart();
            } else {
                var id = $('#edit_order_id').val();
                load_edit_cart(id);
            }
        });
    }
    function add_cart(type, code){
        axios.post('add-cart',{
            type: type,
            code: code
        })
        .then(function(response) {
            if(response.data == 1){
                load_cart();
            }else if(response.data == 0) {
                swal.fire({
                    icon: "error",
                    title: "Thất bại",
                    text: "Sản phẩm đã có trong giỏ hàng!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }
    function load_cart(){
        axios.get('load-cart')
        .then(function(response) {
            $("#load_cart").html(response.data);
            $('#table_cart').DataTable({
                "ordering": false,
                "responsive": true,
                "searching": false,
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false
            });
            $('.btn-num-product-down').click(function() {
                var session_id = $(this).data('session_id');
                var numProduct = Number($(this).next().val());
                if (numProduct > 1) $(this).next().val(numProduct - 1);
                if (numProduct > 1) {
                    var product_quantity = numProduct - 1;
                } else {
                    var product_quantity = 1;
                }
                update_cart('cart',session_id, product_quantity);
            });
            $('.btn-num-product-up').click(function() {
                var session_id = $(this).data('session_id');
                var numProduct = Number($(this).prev().val());
                $(this).prev().val(numProduct + 1);
                var max_product_quantity = $('.product_quantity_' + session_id).val();
                var product_quantity = numProduct + 1;
                if (product_quantity > max_product_quantity) {
                    update_cart('cart',session_id, max_product_quantity);
                    Swal.fire({
                        icon: "warning",
                        title: "Cảnh báo",
                        text: "Sản phẩm chỉ còn " + max_product_quantity + " sản phẩm!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    update_cart('cart',session_id, product_quantity);
                }
            });
        });
    }
    function load_edit_cart(id){
        axios.get('load-edit-cart/'+id)
        .then(function(response) {
            $("#load_edit_cart").html(response.data);
            $('#table_edit_cart').DataTable({
                "ordering": false,
                "responsive": true,
                "searching": false,
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false
            });
            $('.btn-num-product-down').click(function() {
                var session_id = $(this).data('session_id');
                var numProduct = Number($(this).next().val());
                if (numProduct > 1) $(this).next().val(numProduct - 1);
                if (numProduct > 1) {
                    var product_quantity = numProduct - 1;
                } else {
                    var product_quantity = 1;
                }
                update_cart('edit_cart',session_id, product_quantity);
            });
            $('.btn-num-product-up').click(function() {
                var session_id = $(this).data('session_id');
                var numProduct = Number($(this).prev().val());
                $(this).prev().val(numProduct + 1);
                var max_product_quantity = $('.product_quantity_' + session_id).val();
                var product_quantity = numProduct + 1;
                if (product_quantity > max_product_quantity) {
                    update_cart('edit_cart',session_id, max_product_quantity);
                    Swal.fire({
                        icon: "warning",
                        title: "Cảnh báo",
                        text: "Sản phẩm chỉ còn " + max_product_quantity + " sản phẩm!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    update_cart('edit_cart',session_id, product_quantity);
                }
            });
        });
    }
    function update_cart(type, session_id, product_quantity) {
        axios({
            url: 'update-cart',
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
            },
            data: {
                type: type,
                session_id: session_id,
                product_quantity: product_quantity
            },
        })
        .then(function (response) {
            if(type == 'cart'){
                load_cart();
            } else {
                var id = $('#edit_order_id').val();
                load_edit_cart(id);
            }
        });
    }
    $(document).ready(function() {
        $('#order_method').change(function() {
            var value = $(this).val();
            if (value == 1) {
                $('.feeship').removeClass('hide');
                $('.feeship').addClass('show');
            } else if(value == 0) {
                $('.feeship').removeClass('show');
                $('.feeship').addClass('hide');
                axios({
                    url: "feeship",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        type: 0,
                        data: 0
                    },
                })
                .then(function (response) {
                    load_cart();
                });
            }
        });
        $('#order_fee_ship').keyup(function() {
            var data = $(this).val();
            feeship(0,data);
        });
        $('#order_coupon').keyup(function() {
            var value = $(this).val();
            if (value != '') {
                axios({
                    url: "autocomplete-coupon",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        value: value
                    },
                })
                .then(function (response) {
                    $('#search_coupon').fadeIn();
                    $('#search_coupon').html(response.data);
                    $('.li_search_coupon').click(function() {
                        $('#order_coupon').val($(this).text());
                        $('#search_coupon').fadeOut();
                        use_coupon('coupon',$(this).text());
                    });
                });
            } else {
                use_coupon('coupon',$(this).text());
                $('#search_coupon').fadeOut();
            }
        });
        $('#customer_name').keyup(function() {
            var value = $(this).val();
            if (value != '') {
                axios({
                    url: "autocomplete-customer",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        value: value
                    },
                })
                .then(function (response) {
                    $('#search_customer').fadeIn();
                    $('#search_customer').html(response.data);
                    $('.li_add_customer').click(function() {
                        $('#view_order').removeClass("menu-item-active");
                        $('#view_customer').addClass("menu-item-active");
                        $('#exampleModalPopovers2').modal('hide');
                        axios.get("view-customer")
                            .then(function(response) {
                                $("#container").html(response.data);
                            });
                    });
                    $('.li_search_customer').click(function() {
                        $('#customer_id').val($(this).data('id'));
                        $('#customer_name').val($(this).text());
                        $('#search_customer').fadeOut();
                        validation.validate();
                    });
                });
            } else {
                $('#search_customer').fadeOut();
            }
        });
        $('#product_name').keyup(function() {
            var value = $(this).val();
            if (value != '') {
                axios({
                    url: "autocomplete-product",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        value: value
                    },
                })
                .then(function (response) {
                    $('#search_product').fadeIn();
                    $('#search_product').html(response.data);
                    $('.li_search_product').click(function() {
                        $('#product_name').val('');
                        $('#search_product').fadeOut();
                        add_cart('cart',$(this).data('code'));
                    });
                });
            } else {
                $('#search_product').fadeOut();
            }
        });
        $('#edit_order_method').change(function() {
            var value = $(this).val();
            if (value == 1) {
                $('.feeship').removeClass('hide');
                $('.feeship').addClass('show');
            } else if(value == 0) {
                $('.feeship').removeClass('show');
                $('.feeship').addClass('hide');
                feeship('edit_feeship',0);
            }
        });
        $('#edit_order_fee_ship').keyup(function() {
            var data = $(this).val();
            feeship('edit_fee',data);
        });
        $('#edit_order_coupon').keyup(function() {
            var value = $(this).val();
            if (value != '') {
                axios({
                    url: "autocomplete-coupon",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        value: value
                    },
                })
                .then(function (response) {
                    $('#search_coupon').fadeIn();
                    $('#search_coupon').html(response.data);
                    $('.li_search_coupon').click(function() {
                        $('#order_coupon').val($(this).text());
                        $('#search_coupon').fadeOut();
                        use_coupon('edit_coupon',$(this).text());
                    });
                });
            } else {
                use_coupon('edit_coupon',$(this).text());
                $('#search_coupon').fadeOut();
            }
        });
        $('#edit_customer_name').keyup(function() {
            var value = $(this).val();
            if (value != '') {
                axios({
                    url: "autocomplete-customer",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        value: value
                    },
                })
                    .then(function (response) {
                        $('#edit_search_customer').fadeIn();
                        $('#edit_search_customer').html(response.data);
                        $('.li_add_customer').click(function() {
                            $('#view_order').removeClass("menu-item-active");
                            $('#view_customer').addClass("menu-item-active");
                            $('#exampleModalPopovers').modal('hide');
                            axios.get("view-customer")
                                .then(function(response) {
                                    $("#container").html(response.data);
                                });
                        });
                        $('.li_search_customer').click(function() {
                            $('#edit_customer_id').val($(this).data('id'));
                            $('#edit_customer_name').val($(this).text());
                            $('#edit_search_customer').fadeOut();
                            validation.validate();
                        });
                    });
            } else {
                $('#search_customer').fadeOut();
            }
        });
        $('#edit_product_name').keyup(function() {
            var value = $(this).val();
            if (value != '') {
                axios({
                    url: "autocomplete-product",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        value: value
                    },
                })
                .then(function (response) {
                    $('#edit_search_product').fadeIn();
                    $('#edit_search_product').html(response.data);
                    $('.li_search_product').click(function() {
                        $('#product_name').val('');
                        $('#edit_search_product').fadeOut();
                        add_cart(1,$(this).data('code'));
                    });
                });
            } else {
                $('#edit_search_product').fadeOut();
            }
        });
        var i = 0;
        var table = $('#kt_datatable').DataTable({
            ajax: 'fetchdata-order',
            columns: [{
                'data': null,
                render: function() {
                    return i = i + 1
                    }
                },
                {
                    'data': 'code'
                },
                {
                    'data': null,
                    render: function(data, type, row) {
                        return moment(row.created_at).format('H:mm DD-MM-YYYY');
                    }
                },
                {
                    'data': 'customer_name'
                },
                {
                    'data': null,
                    render: function(data, type, row) {
                        if(row.method_pay == 0){
                            return `<span class="label label-lg label-light label-inline">Tiền mặt</span>`;
                        }
                        else {
                            return `<span class="label label-lg label-light label-inline">Chuyển khoản</span>`;
                        }
                    }
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers" data-id='${row.id}' class="edit_order btn btn-sm btn-clean btn-icon" title="Sửa">\
        						<i class="la la-edit"></i>\
        					</span>\
                            <span data-id='${row.id}' class="destroy_order btn btn-sm btn-clean btn-icon" title="Xoá">\
        						<i class="la la-trash"></i>\
        					</span>\
                            `
                    }
                },
            ],
            responsive: true,
            language: {
                processing: "Đang tải dữ liệu",
                search: "Tìm kiếm:",
                lengthMenu: "Hiển thị _MENU_ hàng",
                info: "Hiển thị từ _START_ đến _END_ trong _TOTAL_ hàng",
                infoEmpty: "Không có dữ liệu",
                loadingRecords: "Đang tải dữ liệu",
                zeroRecords: "Không tìm kiếm được dữ liệu",
                emptyTable: "Không có dữ liệu",
            },
        });
        var validation;
        var form = KTUtil.getById('form_create_order');
        validation = FormValidation.formValidation(
            form, {
                fields: {
                    customer: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn khách hàng'
                            },
                        }
                    },
                    method: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn hình thức giao hàng'
                            },
                        }
                    },
                    methodpay: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn hình thức thanh toán'
                            },
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );
        var validation2;
        var form2 = KTUtil.getById('form_edit_order');
        validation2 = FormValidation.formValidation(
            form2, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng không để trống mục này'
                            },
                        }
                    },
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng không để trống mục này'
                            },
                            phone: {
                                country: 'US',
                                message: 'Vui lòng kiểm tra lại số điện thoại'
                            }
                        }
                    },
                    address: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng không để trống mục này'
                            },
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );
        $('#create_order').click(function(e) {
            var customer_id = $('#customer_id').val();
            var _methodpay = $('#order_methodpay').val();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'create-order',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            customer_id: customer_id,
                            order_methodpay: order_methodpay,
                        },
                    })
                    .then(function (response) {
                        Swal.fire({
                            icon: "success",
                            title: "Thành công",
                            text: "Tạo đơn hàng thành công!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        i = 0;
                        table.ajax.reload();
                    });
                } else {
                    swal.fire({
                        text: "Xin lỗi, có vẻ như đã phát hiện thấy một số lỗi, vui lòng thử lại .",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Đồng ý!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function () {
                        KTUtil.scrollTop();
                    });
                }
            });
        });
        $(document).on('click', '.edit_order', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            axios({
                url: 'edit-order/' + id,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
            })
            .then(function (response) {
                use_coupon('edit_coupon',response.data.order_coupon);
                feeship('edit_fee',response.data.order_fee_ship);
                $('#edit_order_id').val(response.data.id);
                $('#edit_customer_id').val(response.data.customer_id);
                $('#edit_customer_name').val(response.data.customer_name +' - '+ response.data.customer_phone);
                $('#edit_order_methodpay').val(response.data.order_methodpay);
                if(response.data.order_fee_ship > 0){
                    $('#edit_order_method').val(1);
                } else {
                    $('#edit_order_method').val(0);
                }
                $('#edit_order_fee_ship').val(response.data.order_fee_ship);
                $('#edit_order_coupon').val(response.data.order_coupon);
                load_edit_cart(response.data.id);
                validation2.validate();
            });
        });
        $(document).on('click', '#update_order', function(e) {
            var id = $('#edit_order_id').val();
            var order_name = $('#edit_order_name').val();
            var order_phone = $('#edit_order_phone').val();
            var order_address = $('#edit_order_address').val();
            var order_role = $('#edit_order_role').val();
            validation2.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'update-order/' + id,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            order_name: order_name,
                            order_phone: order_phone,
                            order_address: order_address,
                            order_role: order_role
                        },
                    })
                    .then(function (response) {
                        if (response.data == 1) {
                            Swal.fire("", "đơn hàng này đã tồn tại!","warning");
                        } else {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Cập nhật đơn hàng thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        }
                    });
                } else {
                    swal.fire({
                        text: "Xin lỗi, có vẻ như đã phát hiện thấy một số lỗi, vui lòng thử lại .",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Đồng ý!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function () {
                        KTUtil.scrollTop();
                    });
                }
            });
        });
        $(document).on('click', '.destroy_order', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Xoá đơn hàng",
                text: "Bạn có chắc là muốn xóa đơn hàng không?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Đồng ý!",
                cancelButtonText: "Không"
            })
                .then(function(result) {
                    if (result.value) {
                        axios({
                            url: 'destroy-order/' + id,
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                            },
                        })
                        .then(function () {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Xoá đơn hàng thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    }
                });
        });
        $(document).on('change', '.cart_qty', function(e) {
            var type = $(this).data('type');
            var session_id = $(this).data('session_id');
            var max_product_quantity = $('.product_quantity_' + session_id).val();
            var product_quantity = $(this).val();
            if (product_quantity < 1) {
                product_quantity = 1;
            }
            if (product_quantity > max_product_quantity) {
                product_quantity = max_product_quantity;
                Swal.fire({
                    icon: "warning",
                    title: "Cảnh báo",
                    text: "Sản phẩm chỉ còn " + max_product_quantity + " sản phẩm!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            update_cart(type,session_id, product_quantity);
        });
        $(document).on('click', '.destroy_cart', function(e) {
            e.preventDefault();
            var session_id = $(this).data('session_id');
            var type = $(this).data('type');
            axios({
                url: 'destroy-cart',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
                data: {
                    type: type,
                    session_id: session_id
                }
            })
            .then(function () {
                load_cart()
            });
        });
    })
</script>
