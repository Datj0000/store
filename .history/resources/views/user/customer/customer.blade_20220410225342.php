@extends('index')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách khách hàng
                <span class="d-block text-muted pt-2 font-size-sm">Quản lý danh sách khách hàng</span>
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
    </span>Thêm khách hàng</span>
        </div>
    </div>
    {{-- Add --}}
    <div class="modal fade" id="exampleModalPopovers2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm khách hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_create_customer">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Họ và tên:</label>
                                <input name="customer_name" type="text" class="form-control form-control-solid" id="customer_name" placeholder="Họ và tên" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại:</label>
                                <input name="customer_phone" type="text" class="form-control form-control-solid" id="customer_phone" placeholder="Số điện thoại" />
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ:</label>
                                <input name="customer_address" type="text" class="form-control form-control-solid" id="customer_address" placeholder="Địa chỉ" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                            @if(Auth::user()->role <= 1)
                                <div class="form-group">
                                    <label>Loại khách hàng:</label>
                                    <select name="customer_role" id="customer_role" class="form-control">
                                        <option value disabled selected hidden>Chọn loại khách hàng</option>
                                        <option value="0">Khách hàng thường</option>
                                        <option value="1">Khách hàng vip</option>
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="role" id="customer_role" value="0">
                            @endif
                        </div>
                        <div class="card-footer">
                            <button id="create_customer" type="button" class="btn btn-primary mr-2">Thêm mới</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin khách hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_edit_customer">
                        <div class="card-body">
                            <input type="hidden" id="edit_customer_id">
                            <div class="form-group">
                                <label>Họ và tên:</label>
                                <input name="customer_name" type="text" class="form-control form-control-solid" id="edit_customer_name" placeholder="Họ và tên" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;" />
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại:</label>
                                <input name="customer_phone" type="text" class="form-control form-control-solid" id="edit_customer_phone" placeholder="Số điện thoại" />
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ:</label>
                                <input name="customer_address" type="text" class="form-control form-control-solid" id="edit_customer_address" placeholder="Địa chỉ" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                            @if(Auth::user()->role <= 1)
                                <div class="form-group">
                                    <label>Loại khách hàng:</label>
                                    <select name="customer_role" id="edit_customer_role" class="form-control">
                                        <option value disabled selected hidden>Chọn loại khách hàng</option>
                                        <option value="0">Khách hàng thường</option>
                                        <option value="1">Khách hàng vip</option>
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="role" id="edit_customer_role">
                            @endif
                        </div>
                        <div class="card-footer">
                            <button id="update_customer" type="button" class="btn btn-primary mr-2">Cập nhật</button>
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
                <th>Loại khách hàng</th>
                <th>Chức năng</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var i = 0;
        var table = $('#kt_datatable').DataTable({
            ajax: 'fetchdata-customer',
            columns: [{
                'data': null,
                render: function() {
                    return i = i + 1
                    }
                },
                {
                    'data': 'name'
                },
                {
                    'data': 'phone'
                },
                {
                    'data': 'address'
                },
                {
                    'data': null,
                    sortable: false,
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if (row.role == 0) {
                            return `<span class="label label-lg label-light label-inline">Khách hàng thường</span>`;
                        } else {
                            return `<span class="label label-lg label-light label-inline">Khách hàng vip</span>`;
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
                            <span data-toggle="modal" data-target="#exampleModalPopovers" data-id='${row.id}' class="edit_customer btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-edit"></i>\
							</span>\
                            <span data-id='${row.id}' class="destroy_customer btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        var form = KTUtil.getById('form_create_customer');
        validation = FormValidation.formValidation(
            form, {
                fields: {
                    customer_name: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng không để trống mục này'
                            },
                        }
                    },
                    customer_phone: {
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
                    customer_address: {
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
        var form2 = KTUtil.getById('form_edit_customer');
        validation2 = FormValidation.formValidation(
            form2, {
                fields: {
                    customer_name: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng không để trống mục này'
                            },
                        }
                    },
                    customer_phone: {
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
                    customer_address: {
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
        $('#create_customer').click(function(e) {
            var name = $('#customer_name').val();
            var phone = $('#customer_phone').val();
            var address = $('#customer_address').val();
            var role = $('#customer_role').val();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'create-customer',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            name: name,
                            phone: phone,
                            address: address,
                            role: role
                        },
                    })
                        .then(function (response) {
                            if (response.data == 1) {
                                Swal.fire("", "Khách hàng này đã tồn tại!","warning");
                            } else {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công",
                                    text: "Tạo khách hàng thành công!",
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
        $(document).on('click', '.edit_customer', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            axios({
                url: 'edit-customer/' + id,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
            })
            .then(function (response) {
                $('#edit_customer_id').val(response.data.id);
                $('#edit_customer_name').val(response.data.name);
                $('#edit_customer_phone').val(response.data.phone);
                $('#edit_customer_address').val(response.data.address);
                $('#edit_customer_role').val(response.data.role);
                validation2.validate();
            });
        });
        $('#update_customer').click(function(e) {
            var id = $('#edit_customer_id').val();
            var name = $('#edit_customer_name').val();
            var phone = $('#edit_customer_phone').val();
            var address = $('#edit_customer_address').val();
            var role = $('#edit_customer_role').val();
            validation2.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'update-customer/' + id,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            name: name,
                            phone: phone,
                            address: address,
                            role: role
                        },
                    })
                    .then(function (response) {
                        if (response.data == 1) {
                            Swal.fire("", "Khách hàng này đã tồn tại!","warning");
                        } else {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Cập nhật khách hàng thành công!",
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
        $(document).on('click', '.destroy_customer', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Xoá khách hàng",
                text: "Bạn có chắc là muốn xóa khách hàng không?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Đồng ý!",
                cancelButtonText: "Không"
            })
            .then(function(result) {
                if (result.value) {
                    axios({
                        url: 'destroy-customer/' + id,
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                    })
                    .then(function () {
                        Swal.fire({
                            icon: "success",
                            title: "Thành công",
                            text: "Xoá khách hàng thành công!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        i = 0;
                        table.ajax.reload();
                    });
                }
            });
        });
    })
</script>
