@extends('index')
@section('content')
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
        .dropdown-menu2 li,
        .dropdown-menu2 a{
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dropdown-menu2 li:active,
        .dropdown-menu2 li:hover,
        .dropdown-menu2 a:active,
        .dropdown-menu2 a:hover{
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
            <h3 class="card-label">Danh sách đơn vị
                <span class="d-block text-muted pt-2 font-size-sm">Quản lý danh sách đơn vị</span>
            </h3>
        </div>
        <div class="card-toolbar">
            <span class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#exampleModalPopovers">
                <span class="svg-icon svg-icon-md">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                         height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <circle fill="#000000" cx="9" cy="15" r="6" />
                            <path
                                d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                </span>Thêm mới</span>
        </div>
    </div>
    {{-- Add --}}
    <div class="modal fade" id="exampleModalPopovers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="True">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm đơn vị</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="True" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_add_insurance">
                        <div class=" card-body">
                            <div class="form-group">
                                <label>Hình thức bảo hành:</label>
                                <select name="method" id="insurance_method" class="form-control">
                                    <option value disabled selected hidden>Chọn hình thức bảo hành</option>
                                    <option value="0">Khách bảo hành</option>
                                    <option value="1">Tự bảo hành</option>
                                </select>
                            </div>
                            <div class="form-group import hide">
                                <label>Nhập hàng:</label>
                                <input type="hidden" name="import" id="import_id">
                                <input autocomplete="off" type="text" class="form-control form-control-solid" id="import_name" placeholder="Tìm kiếm theo mã nhập hàng" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                                <div id="search_import"></div>
                            </div>
                            <div class="form-group order hide">
                                <label>Đơn hàng:</label>
                                <input type="hidden" name="order" id="order_id">
                                <input autocomplete="off" type="text" class="form-control form-control-solid" id="order_name" placeholder="Tìm kiếm theo mã đơn hàng" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                                <div id="search_order"></div>
                            </div>
                            <div class="form-group fee hide">
                                <label>Phí bảo hành:</label>
                                <input type="number" name="fee" class="form-control form-control-solid" id="insurance_fee" placeholder="Phí bảo hành" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group fee hide">
                                <label>Ghi chú:</label>
                                <input type="text" name="note" class="form-control form-control-solid" id="insurance_note" placeholder="Ghi chú" />
                            </div>
                            <div class="form-group product hide">
                                <label>Sản phẩm:</label>
                                <input type="hidden" name="product" id="product_id">
                                <input autocomplete="off" type="text" class="form-control form-control-solid" id="product_name" placeholder="Tìm kiếm theo mã sản phẩm hoặc tên sản phẩm" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                                <div id="search_product"></div>
                            </div>
                            <div id="load_insurance"></div>
                        </div>
                        <div class="card-footer">
                            <button id="create_insurance" type="button" class="btn btn-primary mr-2">Thêm mới</button>
                            <button type="reset" class="btn btn-secondary">Nhập lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit --}}
    <div class="modal fade" id="exampleModalPopovers2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
         aria-hidden="True">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa đơn vị</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="True" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_edit_insurance">
                        <div class=" card-body">
                            <input type="hidden" id="edit_insurance_id">
                            <div class="form-group">
                                <label>Tên đơn vị:</label>
                                <input name="name" type="Text" class="form-control form-control-solid"
                                       id="edit_insurance_name" placeholder="Tên đơn vị" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Ghi chú:</label>
                                <textarea name="description" rows="5" class="form-control form-control-solid" id="edit_insurance_desc"
                                          placeholder="Ghi chú"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_insurance" type="button" class="btn btn-primary mr-2">Cập nhật</button>
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
                <th>Mã bảo hành</th>
                <th>Loại</th>
                <th>Trạng thái</th>
                <th>Ghi chú</th>
                <th>Chức năng</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script type="Text/javascript">
    load_insurance('insurance');
    function load_btn(insurance){
        $('.btn-num-product-down').click(function() {
            var session_id = $(this).data('session_id');
            var numProduct = Number($(this).next().val());
            if (numProduct > 1) $(this).next().val(numProduct - 1);
            if (numProduct > 1) {
                var product_quantity = numProduct - 1;
            } else {
                var product_quantity = 1;
            }
            update_insurance(insurance,session_id, product_quantity);
        });
        $('.btn-num-product-up').click(function() {
            var session_id = $(this).data('session_id');
            var numProduct = Number($(this).prev().val());
            $(this).prev().val(numProduct + 1);
            var max_product_quantity = $('.product_quantity_' + session_id).val();
            var product_quantity = numProduct + 1;
            if (product_quantity > max_product_quantity) {
                update_insurance(insurance,session_id, max_product_quantity);
                Swal.fire({
                    icon: "warning",
                    title: "Cảnh báo",
                    text: "Chỉ có thể thêm " + max_product_quantity + " sản phẩm!",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                update_insurance(insurance,session_id, product_quantity);
            }
        });
    }
    function add_insurance(type, code){
        axios.post('add-insur',{
            type: type,
            code: code
        })
        .then(function(response) {
            if(response.data == 1){
                if(type == 'insurance'){
                    load_insurance('insurance');
                } else {
                    load_insurance('edit_insurance');
                }
            }else if(response.data == 0) {
                swal.fire({
                    icon: "error",
                    title: "Thất bại",
                    text: "Sản phẩm đã được thêm rồi!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }
    function load_insurance(insurance){
        axios.post('load-insur',{
            insurance: insurance,
        })
        .then(function(response) {
            if(insurance == 'insurance'){
                $("#load_insurance").html(response.data);
                $('#table_insurance').DataTable({
                    "ordering": false,
                    "responsive": true,
                    "searching": false,
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false,
                    "bAutoWidth": false
                });
                load_btn('insurance');
            } else {
                $("#load_edit_insurance").html(response.data);
                $('#table_edit_insurance').DataTable({
                    "ordering": false,
                    "responsive": true,
                    "searching": false,
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false,
                    "bAutoWidth": false
                });
                load_btn('edit_insurance');
            }

        });
    }
    function edit_insurance(id){
        axios.get('edit-insurance/'+id)
    }
    function update_insurance(type, session_id, product_quantity) {
        axios({
            url: 'update-insur',
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
            if(type == 'insurance'){
                load_insurance('insurance');
            } else {
                load_insurance('edit_insurance');
            }
        });
    }
    $(document).ready(function() {
        $('#insurance_method').change(function() {
            var query = $(this).val();
            if (query == 1) {
                $('.import').removeClass('hide');
                $('.import').addClass('show');
                $('.order').removeClass('show');
                $('.order').addClass('hide');
            } else if(query == 0) {
                $('.import').removeClass('show');
                $('.import').addClass('hide');
                $('.order').removeClass('hide');
                $('.order').addClass('show');
            }
            $('.product').removeClass('hide');
            $('.product').addClass('show');
            $('.fee').removeClass('hide');
            $('.fee').addClass('show');
        });
        $('#import_name').keyup(function() {
            var value = $(this).val();
            if (value != '') {
                axios({
                    url: "autocomplete-import",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        value: value
                    },
                })
                .then(function (response) {
                    $('#search_import').fadeIn();
                    $('#search_import').html(response.data);
                    $('.li_search_import').click(function() {
                        $('#import_id').val($(this).data('id'));
                        $('#import_name').val($(this).text());
                        $('#search_import').fadeOut();
                    });
                });
            } else {
                $('#search_import').fadeOut();
            }
        });
        $('#order_name').keyup(function() {
            var value = $(this).val();
            if (value != '') {
                axios({
                    url: "autocomplete-order",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        value: value
                    },
                })
                    .then(function (response) {
                        $('#search_order').fadeIn();
                        $('#search_order').html(response.data);
                        $('.li_search_order').click(function() {
                            $('#order_id').val($(this).data('id'));
                            $('#order_name').val($(this).text());
                            $('#search_order').fadeOut();
                        });
                    });
            } else {
                $('#search_order').fadeOut();
            }
        });
        $('#product_name').keyup(function() {
            var value = $(this).val();
            var order_id = $('#order_id').val();
            var import_id = $('#import_id').val();
            if ((value != '') && (order_id != '' || import_id != '')) {
                axios({
                    url: "autocomplete-product",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        order_id: order_id,
                        import_id: import_id,
                        value: value
                    },
                })
                .then(function (response) {
                    $('#search_product').fadeIn();
                    $('#search_product').html(response.data);
                    $('.li_search_product').click(function() {
                        $('#product_name').val('');
                        $('#search_product').fadeOut();
                        add_insurance('insurance',$(this).data('code'));
                    });
                });
            } else {
                $('#search_product').fadeOut();
            }
        });
        var i = 0;
        var table = $('#kt_datatable').DataTable({
            ajax: 'fetchdata-insurance',
            columns: [
                {
                    'data': null,
                    render: function() {
                        return i += 1
                    }
                },
                {
                    'data': 'code'
                },
                {
                    'data': null,
                    sortable: false,
                    render: function(data, type, row) {
                        if(row.method == 0){
                            return `Khách bảo hành`;
                        } else {
                            return `Tự bảo hành`;
                        }
                    }
                },
                {
                    'data': null,
                    sortable: false,
                    render: function(data, type, row) {
                        if(row.status == 0){
                            return `<span data-status="1" class="insurance_status label label-lg label-light-warning label-inline cursor-pointer">Đang xử lý</span>`;
                        } else if(row.status == 1){
                            return `<span data-status="0" class="insurance_status label label-lg label-light-success label-inline cursor-pointer">Thành công</span>`;
                        }
                    }
                },
                {
                    'data': 'note'
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    render: function(data, type, row) {
                        return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers2" data-id='${row.id}' class="edit_insurance btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-edit"></i>\
							</span>\
                            <span data-id='${row.id}' class="destroy_insurance btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        var form = KTUtil.getById('form_add_insurance');
        var validation = FormValidation.formValidation(
            form, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mục này'
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
        var form2 = KTUtil.getById('form_edit_insurance');
        var validation2 = FormValidation.formValidation(
            form2, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mục này'
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
        $('#create_insurance').click(function(e) {
            e.preventDefault();
            var method = $('#insurance_method').val();
            var fee = $('#insurance_fee').val();
            var note = $('#insurance_note').val();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'create-insurance',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            method: method,
                            fee: fee,
                            note: note,
                        },
                    })
                    .then(function (response) {
                        Swal.fire({
                            icon: "success",
                            title: "Thành công",
                            text: "Tạo đơn bảo hành thành công thành công!",
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
        $(document).on('click', '.edit_insurance', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            axios({
                url: 'edit-insurance/' + id,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
            })
                .then(function (response) {
                    $('#edit_insurance_id').val(response.data.id);
                    $('#edit_insurance_name').val(response.data.insurance_name);
                    $('#edit_insurance_desc').val(response.data.insurance_desc);
                    validation2.validate();
                });
        });
        $('#update_insurance').click(function(e) {
            e.preventDefault();
            var id = $('#edit_insurance_id').val();
            var insurance_name = $('#edit_insurance_name').val();
            var insurance_desc = $('#edit_insurance_desc').val();
            validation2.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'update-insurance/'+id,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            insurance_name: insurance_name,
                            insurance_desc: insurance_desc,
                        },
                    })
                        .then(function (response) {
                            if (response.data == 1) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công",
                                    text: "Sửa đơn vị thành công!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                i = 0;
                                table.ajax.reload();
                            } else if (response.data == 0) {
                                Swal.fire("Thất bại", "Sản phẩm này đã bảo hành rồi!", "error");
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
        $(document).on('click', '.destroy_insurance', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Xoá đơn vị",
                text: "Bạn có chắc là muốn xóa đơn vị không?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Đồng ý!",
                cancelButtonText: "Không"
            })
            .then(function(result) {
                if (result.value) {
                    axios({
                        url: 'destroy-insurance/' + id,
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                    })
                    .then(function (response) {
                        if (response.data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Xoá đơn vị thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (response.data == 0) {
                            Swal.fire({
                                icon: "error",
                                title: "Thất bại",
                                text: "Đang có sản phẩm dùng đơn vị này!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
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
        $(document).on('click', '.destroy_insur', function(e) {
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
                    if(type == 'cart'){
                        load_cart('insurance');
                    } else {
                        load_cart('edit_insurance');
                    }
                });
        });
    })
</script>
@endsection
