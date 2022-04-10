@extends('index')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách nhân viên
                <span class="d-block text-muted pt-2 font-size-sm">Quản lý danh sách nhân viên</span>
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
                </span>Thêm nhân viên</span>
        </div>
    </div>
    {{-- Add --}}
    <div class="modal fade" id="exampleModalPopovers2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm nhân viên</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_create_user">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Họ và tên:</label>
                                <input name="user_name" type="text" class="form-control form-control-solid" id="user_name" placeholder="Họ và tên" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input name="user_email" type="email" class="form-control form-control-solid" id="user_email" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại:</label>
                                <input name="user_phone" type="text" class="form-control form-control-solid" id="user_phone" placeholder="Số điện thoại" />
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu:</label>
                                <input name="user_password" type="text" class="form-control form-control-solid" id="user_password" placeholder="Mật khẩu" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Phân quyền:</label>
                                <select name="user_role" id="user_role" class="form-control">
                                    <option value disabled selected hidden>Chọn quyền</option>
                                    <option value="3">Cộng tác viên</option>
                                    <option value="2">Nhân viên</option>
                                    <option value="1">Thủ kho</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="create_user" type="button" class="btn btn-primary mr-2">Thêm mới</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Phân quyền nhân viên</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="card-body">
                            <input type="hidden" id="edit_user_id">
                            <div class="form-group">
                                <label>Họ và tên:</label>
                                <input readonly type="text" class="form-control form-control-solid" id="edit_user_name"/>
                            </div>
                            <div class="form-group">
                                <label>Phân quyền:</label>
                                <select name="user_role" id="edit_user_role" class="form-control">
                                    <option value disabled selected hidden>Chọn quyền</option>
                                    <option value="3">Cộng tác viên</option>
                                    <option value="2">Nhân viên</option>
                                    <option value="1">Thủ kho</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_user" type="button" class="btn btn-primary mr-2">Cập nhật</button>
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
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Quyền</th>
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
            ajax: 'fetchdata-user',
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
                    'data': 'email'
                },
                {
                    'data': 'phone'
                },
                {
                    'data': null,
                    sortable: false,
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if (row.role == 3) {
                            return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers" data-id='${row.id}' style="cursor: pointer" class="view_role label label-lg label-light label-inline">Cộng tác viên</span>\
                            `;
                        } else if (row.role == 2) {
                            return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers" data-id='${row.id}' style="cursor: pointer" class="view_role label label-lg label-light label-inline">Nhân viên</span>\
                            `;
                        } else if (row.role == 1) {
                            return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers" data-id_='${row.id}' style="cursor: pointer" class="view_role label label-lg label-light label-inline"">Quản lý</span>\
                            `;
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
                            <span data-id='${row.id}' class="destroy_user btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        const strongPassword = function() {
            return {
                validate: function(input) {
                    const value = input.value;
                    if (value === '') {
                        return {
                            valid: true,
                        };
                    }

                    if (value.length < 8) {
                        return {
                            valid: false,
                        };
                    }

                    if (value === value.toLowerCase()) {
                        return {
                            valid: false,
                        };
                    }

                    if (value === value.toUpperCase()) {
                        return {
                            valid: false,
                        };
                    }

                    if (value.search(/[0-9]/) < 0) {
                        return {
                            valid: false,
                        };
                    }

                    return {
                        valid: true,
                    };
                },
            };
        };
        var validation;
        var form = KTUtil.getById('form_create_user');
        FormValidation.validators.checkPassword = strongPassword;
        validation = FormValidation.formValidation(
            form, {
                fields: {
                    user_name: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng không để trống mục này'
                            },
                        }
                    },
                    user_phone: {
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
                    user_email: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng không để trống mục này'
                            },
                            emailAddress: {
                                message: 'Vui lòng kiểm tra lại email'
                            }
                        }
                    },
                    user_password: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng không để trống mục này'
                            },
                            checkPassword: {
                                message: 'Vui lòng điền mật khẩu mạnh hơn'
                            },
                        }
                    },
                    user_role: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn quyền'
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
        $('#create_user').click(function(e) {
            var email = $('#user_email').val();
            var name = $('#user_name').val();
            var phone = $('#user_phone').val();
            var password = $('#user_password').val();
            var role = $('#user_role').val();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'create-user',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            email: email,
                            name: name,
                            phone: phone,
                            password: password,
                            role: role
                        },
                    })
                    .then(function (response) {
                        console.log(response.data);
                        if (response.data == 1) {
                            Swal.fire({
                                icon: "warning",
                                title: "Thất bại",
                                text: "Email này đã được sử dụng!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Tạo tài khoản thành công!",
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
        $(document).on('click', '.view_role', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            axios({
                url: 'edit-user/' + id,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
            })
            .then(function (response) {
                $('#edit_user_id').val(response.data.id);
                $('#edit_user_name').val(response.data.name);
                $('#edit_user_role').val(response.data.role);
            });
        });
        $('#update_user').click(function(e) {
            var id = $('#edit_user_id').val();
            var role = $('#edit_user_role').val();
            axios({
                url: 'update-user/' + id,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
                data: {
                    role: role,
                },
            })
            .then(function (response) {
                Swal.fire({
                    icon: "success",
                    title: "Thành công",
                    text: "Cập nhật quyền thành công!",
                    showConfirmButton: false,
                    timer: 1500
                });
                i = 0;
                table.ajax.reload();
            });
        });
        $(document).on('click', '.destroy_user', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Xoá tài khoản",
                text: "Bạn có chắc là muốn xóa tài khoản không?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Đồng ý!",
                cancelButtonText: "Không"
            })
                .then(function(result) {
                    if (result.value) {
                        axios({
                            url: 'destroy-user/' + id,
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                            },
                        })
                        .then(function () {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Xoá tài khoản thành công!",
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
@endsection