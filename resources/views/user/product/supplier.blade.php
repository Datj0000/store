<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách nhà cung cấp
                <span class="d-block text-muted pt-2 font-size-sm">Quản lý danh sách nhà cung cấp</span>
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
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm nhà cung cấp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_add_supplier">
                        <div class=" card-body">
                            <div class="form-group">
                                <label>Tên nhà cung cấp:</label>
                                <input name="name" type="text" class="form-control form-control-solid"
                                       id="supplier_name" placeholder="Tên nhà cung cấp" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại:</label>
                                <input name="phone" type="text" class="form-control form-control-solid"
                                       id="supplier_phone" placeholder="Số điện thoại" />
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input name="email" type="text" class="form-control form-control-solid"
                                       id="supplier_email" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <label>Mã số thuế:</label>
                                <input name="mst" type="text" class="form-control form-control-solid"
                                       id="supplier_mst" placeholder="Mã số thuế" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ:</label>
                                <input name="address" type="text" class="form-control form-control-solid"
                                       id="supplier_address" placeholder="Địa chỉ" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Thông tin thanh toán:</label>
                                <input name="information" type="text" class="form-control form-control-solid"
                                       id="supplier_information" placeholder="Thông tin thanh toán" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="create_supplier" type="button" class="btn btn-primary mr-2">Thêm mới</button>
                            <button type="reset" class="btn btn-secondary">Nhập lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit --}}
    <div class="modal fade" id="exampleModalPopovers2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa nhà cung cấp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_edit_supplier">
                        <div class=" card-body">
                            <input type="hidden" id="edit_supplier_id">
                            <div class="form-group">
                                <label>Tên nhà cung cấp:</label>
                                <input name="name" type="text" class="form-control form-control-solid"
                                       id="edit_supplier_name" placeholder="Tên nhà cung cấp" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại:</label>
                                <input name="phone" type="text" class="form-control form-control-solid"
                                       id="edit_supplier_phone" placeholder="Số điện thoại" />
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input name="email" type="text" class="form-control form-control-solid"
                                       id="edit_supplier_email" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <label>Mã số thuế:</label>
                                <input name="mst" type="text" class="form-control form-control-solid"
                                       id="edit_supplier_mst" placeholder="Mã số thuế" maxlength="13"/>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ:</label>
                                <input name="address" type="text" class="form-control form-control-solid"
                                       id="edit_supplier_address" placeholder="Địa chỉ" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Thông tin thanh toán:</label>
                                <input name="information" type="text" class="form-control form-control-solid"
                                       id="edit_supplier_information" placeholder="Thông tin thanh toán" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_supplier" type="button" class="btn btn-primary mr-2">Cập nhật</button>
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
                <th>Nhà cung cấp</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Mã số thuế</th>
                <th>Công nợ</th>
                <th>Địa chỉ</th>
                <th>Thông tin thanh toán</th>
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
            ajax: 'fetchdata-supplier',
            columns: [
                {
                    'data': null,
                    render: function() {
                        return i += 1
                    }
                },
                {
                    'data': 'supplier_name'
                },
                {
                    'data': 'supplier_email'
                },
                {
                    'data': 'supplier_phone'
                },
                {
                    'data': 'supplier_mst'
                },
                {
                    'data': 'supplier_debt'
                },
                {
                    'data': 'supplier_address'
                },
                {
                    'data': 'supplier_information'
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers2" data-id='${row.id}' class="edit_supplier btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-edit"></i>\
							</span>\
                            <span data-id='${row.id}' class="destroy_supplier btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        var form = KTUtil.getById('form_add_supplier');
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
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền thông tin'
                            },
                            phone: {
                                country: 'US',
                                message: 'Vui lòng kiểm tra số điện thoại'
                            },
                        }
                    },
                    email: {
                        validators: {
                            emailAddress: {
                                message: 'Vui lòng kiểm tra email'
                            }
                        }
                    },
                    mst: {
                        validators: {
                            stringLength: {
                                min: 10,
                                message: 'Vui lòng kiểm tra lại mã số thuê',
                            },
                        }
                    },
                    address: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền thông tin'
                            },
                        }
                    },
                    information: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền thông tin'
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
        var form2 = KTUtil.getById('form_edit_supplier');
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
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền thông tin'
                            },
                            phone: {
                                country: 'US',
                                message: 'Vui lòng kiểm tra số điện thoại'
                            },
                        }
                    },
                    email: {
                        validators: {
                            emailAddress: {
                                message: 'Vui lòng kiểm tra email'
                            }
                        }
                    },
                    mst: {
                        validators: {
                            stringLength: {
                                min: 10,
                                message: 'Vui lòng kiểm tra lại mã số thuê',
                            },
                        }
                    },
                    address: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền thông tin'
                            },
                        }
                    },
                    information: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền thông tin'
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
        $('#create_supplier').click(function(e) {
            e.preventDefault();
            var supplier_name = $('#supplier_name').val();
            var supplier_phone = $('#supplier_phone').val();
            var supplier_email = $('#supplier_email').val();
            var supplier_mst = $('#supplier_mst').val();
            var supplier_address = $('#supplier_address').val();
            var supplier_information = $('#supplier_information').val();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'create-supplier',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            supplier_name: supplier_name,
                            supplier_phone: supplier_phone,
                            supplier_email: supplier_email,
                            supplier_mst: supplier_mst,
                            supplier_address: supplier_address,
                            supplier_information: supplier_information,
                        },
                    })
                        .then(function (response) {
                            switch (response.data){
                                case 0:
                                    Swal.fire({
                                        icon: "warning",
                                        title: "Thất bại",
                                        text: "Đã tồn tại tên nhà cung cấp này rồi!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    break;
                                case 1:
                                    Swal.fire({
                                        icon: "warning",
                                        title: "Thất bại",
                                        text: "Đã tồn tại số điện thoại của nhà cung cấp này rồi!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    break;
                                case 2:
                                    Swal.fire({
                                        icon: "warning",
                                        title: "Thất bại",
                                        text: "Đã tồn tại email của nhà cung cấp này rồi!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    break;
                                case 3:
                                    Swal.fire({
                                        icon: "warning",
                                        title: "Thất bại",
                                        text: "Đã tồn tại mã số thuế của nhà cung cấp này rồi!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    break;
                                case 4:
                                    Swal.fire({
                                        icon: "success",
                                        title: "Thành công",
                                        text: "Sửa nhà cung cấp thành công!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    i = 0;
                                    table.ajax.reload();
                                    break;
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
        $(document).on('click', '.edit_supplier', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            axios({
                url: 'edit-supplier/' + id,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
            })
                .then(function (response) {
                    $('#edit_supplier_id').val(response.data.id);
                    $('#edit_supplier_name').val(response.data.supplier_name);
                    $('#edit_supplier_email').val(response.data.supplier_email);
                    $('#edit_supplier_phone').val(response.data.supplier_phone);
                    $('#edit_supplier_mst').val(response.data.supplier_mst);
                    $('#edit_supplier_address').val(response.data.supplier_address);
                    $('#edit_supplier_information').val(response.data.supplier_information);
                    validation2.validate();
                });
        });
        $('#update_supplier').click(function(e) {
            e.preventDefault();
            var id = $('#edit_supplier_id').val();
            var supplier_name = $('#edit_supplier_name').val();
            var supplier_phone = $('#edit_supplier_phone').val();
            var supplier_email = $('#edit_supplier_email').val();
            var supplier_mst = $('#edit_supplier_mst').val();
            var supplier_address = $('#edit_supplier_address').val();
            var supplier_information = $('#edit_supplier_information').val();
            validation2.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'update-supplier/'+id,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            supplier_name: supplier_name,
                            supplier_phone: supplier_phone,
                            supplier_email: supplier_email,
                            supplier_mst: supplier_mst,
                            supplier_address: supplier_address,
                            supplier_information: supplier_information,
                        },
                    })
                        .then(function (response) {
                            switch (response.data){
                                case 0:
                                    Swal.fire({
                                        icon: "warning",
                                        title: "Thất bại",
                                        text: "Đã tồn tại tên nhà cung cấp này rồi!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    break;
                                case 1:
                                    Swal.fire({
                                        icon: "warning",
                                        title: "Thất bại",
                                        text: "Đã tồn tại số điện thoại của nhà cung cấp này rồi!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    break;
                                case 2:
                                    Swal.fire({
                                        icon: "warning",
                                        title: "Thất bại",
                                        text: "Đã tồn tại email của nhà cung cấp này rồi!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    break;
                                case 3:
                                    Swal.fire({
                                        icon: "warning",
                                        title: "Thất bại",
                                        text: "Đã tồn tại mã số thuế của nhà cung cấp này rồi!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    break;
                                case 4:
                                    Swal.fire({
                                        icon: "success",
                                        title: "Thành công",
                                        text: "Sửa nhà cung cấp thành công!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    i = 0;
                                    table.ajax.reload();
                                    break;
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
        $(document).on('click', '.destroy_supplier', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Xoá nhà cung cấp",
                text: "Bạn có chắc là muốn xóa nhà cung cấp không?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Đồng ý!",
                cancelButtonText: "Không"
            })
                .then(function(result) {
                    if (result.value) {
                        axios({
                            url: 'destroy-supplier/' + id,
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
                                        text: "Xoá nhà cung cấp thành công!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    i = 0;
                                    table.ajax.reload();
                                } else if (response.data == 0) {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Thất bại",
                                        text: "Đang có sản phẩm thuộc nhà cung cấp này!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            });
                    }
                });
        });
    })
</script>
