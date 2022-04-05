<style>
    .dropdown-menu2 {
        min-width: 100%;
        max-width: 100%;
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
    input[list]:focus {
        outline: none;
    }
    input[list] + div[list] {
        display: none;
        position: absolute;
        width: 100%;
        max-height: 164px;
        overflow-y: auto;
        max-width: 330px;
        background: #FFF;
        border: var(--border);
        border-top: none;
        border-radius: 0 0 5px 5px;
        box-shadow: 0 3px 3px -3px #333;
        z-index: 100;
    }
    input[list] + div[list] span {
        display: block;
        padding: 7px 5px 7px 20px;
        color: #069;
        text-decoration: none;
        cursor: pointer;
    }
    input[list] + div[list] span:not(:last-child) {
    border-bottom: 1px solid #EEE;
    }
    input[list] + div[list] span:hover {
        background: rgba(100, 120, 140, .2);
    }
</style>
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách đơn hàng
                <span class="d-block text-muted pt-2 font-size-sm">Quả lý danh sách đơn hàng</span>
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
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                                <input list="customer" name="customer" type="text" class="form-control form-control-solid" id="customer_id" placeholder="Họ và tên" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                                <div list="list-cities" id="customer">
                                    @if($customer->count() > 0)
                                        @foreach ($customer as $key => $item)
                                            <option data-value="{{ $item->id }}" value="{{ $item->customer_name }} - {{ $item->customer_phone }}">
                                        @endforeach
                                    @else
                                        {{-- <option data-value="">Chưa có khách hàng</option> --}}
                                    @endif
                                </datalist>
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
                            @if(Auth::user()->role <= 1)
                                <div class="form-group">
                                    <label>Mã giảm giá:</label>
                                    <input name="coupon" type="text" class="form-control form-control-solid" id="order_coupon" autocomplete="off" placeholder="Mã giảm giá" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;" />
                                    <div id="search_coupon"></div>
                                </div>
                            @endif
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
                                <label>Họ và tên:</label>
                                <input name="name" type="text" class="form-control form-control-solid" id="edit_order_name" placeholder="Họ và tên" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;" />
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại:</label>
                                <input name="phone" type="text" class="form-control form-control-solid" id="edit_order_phone" placeholder="Số điện thoại" />
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ:</label>
                                <input name="address" type="text" class="form-control form-control-solid" id="edit_order_address" placeholder="Địa chỉ" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                            @if(Auth::user()->role <= 1)
                                <div class="form-group">
                                    <label>Loại đơn hàng:</label>
                                    <select name="role" id="edit_order_role" class="form-control">
                                        <option value disabled selected hidden>Chọn loại đơn hàng</option>
                                        <option value="0">đơn hàng thường</option>
                                        <option value="1">đơn hàng vip</option>
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="role" id="edit_order_role">
                            @endif
                        </div>
                        <div class="card-footer">
                            <button id="update_order" type="button" class="btn btn-primary mr-2">Lưu</button>
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
                <th>Họ và tên</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Loại đơn hàng</th>
                <th>Chức năng</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#order_method').change(function() {
            var query = $(this).val();
            if (query == 1) {
                $('.feeship').removeClass('hide');
                $('.feeship').addClass('show');
            } else if(query == 0) {
                $('.feeship').removeClass('show');
                $('.feeship').addClass('hide');
            }
        });
        $('#order_coupon').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                axios({
                    url: "autocomplete-coupon",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        query: query
                    },
                })
                .then(function (response) {
                    $('#search_coupon').fadeIn();
                    $('#search_coupon').html(response.data);
                });
            } else {
                $('#search_coupon').fadeOut();
            }
        });
        $(document).on('click', '.li_search_coupon', function() {
            $('#order_coupon').val($(this).text());
            $('#search_coupon').fadeOut();
        });
        var i = 0;
        // var table = $('#kt_datatable').DataTable({
        //     ajax: 'fetchdata-order',
        //     columns: [{
        //         'data': null,
        //         render: function() {
        //             return i = i + 1
        //             }
        //         },
        //         {
        //             'data': 'order_name'
        //         },
        //         {
        //             'data': 'order_phone'
        //         },
        //         {
        //             'data': 'order_address'
        //         },
        //         {
        //             'data': null,
        //             sortable: false,
        //             overflow: 'visible',
        //             autoHide: false,
        //             render: function(data, type, row) {
        //                 if (row.order_role == 0) {
        //                     return `\
        //                     <span class="label label-lg label-light label-inline">đơn hàng thường</span>\
        //                     `;
        //                 } else {
        //                     return `\
        //                     <span class="label label-lg label-light label-inline">đơn hàng vip</span>\
        //                     `;
        //                 }
        //             }
        //         },
        //         {
        //             'data': null,
        //             sortable: false,
        //             width: '75px',
        //             overflow: 'visible',
        //             autoHide: false,
        //             render: function(data, type, row) {
        //                 return `\
        //                     <span data-toggle="modal" data-target="#exampleModalPopovers" data-id='${row.id}' class="edit_order btn btn-sm btn-clean btn-icon" title="Sửa">\
		// 						<i class="la la-edit"></i>\
		// 					</span>\
        //                     <span data-id='${row.id}' class="destroy_order btn btn-sm btn-clean btn-icon" title="Xoá">\
		// 						<i class="la la-trash"></i>\
		// 					</span>\
        //                     `
        //             }
        //         },
        //     ],
        //     responsive: true,
        //     language: {
        //         processing: "Đang tải dữ liệu",
        //         search: "Tìm kiếm:",
        //         lengthMenu: "Hiển thị _MENU_ hàng",
        //         info: "Hiển thị từ _START_ đến _END_ trong _TOTAL_ hàng",
        //         infoEmpty: "Không có dữ liệu",
        //         loadingRecords: "Đang tải dữ liệu",
        //         zeroRecords: "Không tìm kiếm được dữ liệu",
        //         emptyTable: "Không có dữ liệu",
        //     },
        // });
        var validation;
        var form = KTUtil.getById('form_create_order');
        validation = FormValidation.formValidation(
            form, {
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
        $(document).on('click', '#create_order', function(e) {
            var order_name = $('#order_name').val();
            var order_phone = $('#order_phone').val();
            var order_address = $('#order_address').val();
            var order_role = $('#order_role').val();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'create-order',
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
                                    text: "Tạo đơn hàng thành công!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                i = 0;
                                table.ajax.reload();
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
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
                    $('#edit_order_id').val(response.data.id);
                    $('#edit_order_name').val(response.data.order_name);
                    $('#edit_order_phone').val(response.data.order_phone);
                    $('#edit_order_address').val(response.data.order_address);
                    $('#edit_order_role').val(response.data.order_role);
                })
                .catch(function (error) {
                    console.log(error);
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
                        })
                        .catch(function (error) {
                            console.log(error);
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
    })
</script>
