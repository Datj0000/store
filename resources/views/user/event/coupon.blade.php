@extends('index')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách mã giảm giá
                <span class="d-block text-muted pt-2 font-size-sm">Quản lý danh sách mã giảm giá</span>
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
                </span>Thêm mã giảm giá</span>
        </div>
    </div>
    {{-- Add --}}
    <div class="modal fade" id="exampleModalPopovers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="True">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mã giảm giá</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="True" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_add_coupon">
                        <div class=" card-body">
                            <div class="form-group">
                                <label>Tên mã giảm giá:</label>
                                <input name="coupon_name" type="text" class="form-control form-control-solid" id="coupon_name"
                                       placeholder="Tên mã giảm giá" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Mã giảm giá:</label>
                                <input name="coupon_code" type="text" class="form-control form-control-solid" id="coupon_code"
                                       placeholder="Mã giảm giá" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Số lượng:</label>
                                <input name="coupon_time" type="number" class="form-control form-control-solid" id="coupon_time" min="0"
                                       placeholder="Số lượng" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Loại giảm giá:</label>
                                <select name="coupon_type" class="form-control" id="coupon_condition">
                                    <option value disabled selected hidden>Chọn loại giảm giá</option>
                                    <option value="0">Giảm theo phần trăm</option>
                                    <option value="1">Giảm theo tiền</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhập số % hoặc tiền giảm:</label>
                                <input name="coupon_number" type="text" class="form-control form-control-solid" id="coupon_number" min="0"
                                       placeholder="Nhập số % hoặc tiền giảm" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái:</label>
                                <select name="coupon_status" class="form-control" id="coupon_status">
                                    <option value disabled selected hidden>Chọn trạng thái</option>
                                    <option value="0">Kích hoạt</option>
                                    <option value="1">Tắt</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="input-daterange input-group" id="kt_datepicker_5">
                                    <label class="col-form-label text-right">Thời gian từ</label>
                                    <input style="border-radius: 7px; margin: 0 10px" autocomplete="off" id="coupon_date_start" type="text"
                                           class="form-control" name="coupon_start" />
                                    <label class="col-form-label text-right">Đến</label>
                                    <input style="border-radius: 7px; margin: 0 0 0 10px" autocomplete="off" id="coupon_date_end" type="text"
                                           class="form-control" name="coupon_end" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="create_coupon" type="button" class="btn btn-primary mr-2">Thêm mới</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Sửa mã giảm giá</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="True" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_edit_coupon">
                        <div class=" card-body">
                            <input type="hidden" id="edit_coupon_id">
                            <div class="form-group">
                                <label>Tên mã giảm giá:</label>
                                <input name="coupon_name" type="Text" class="form-control form-control-solid"
                                       id="edit_coupon_name" placeholder="Tên mã giảm giá" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Mã giảm giá:</label>
                                <input name="coupon_code" type="text" class="form-control form-control-solid" id="edit_coupon_code"
                                       placeholder="Mã giảm giá" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Số lượng:</label>
                                <input name="coupon_time" type="number" class="form-control form-control-solid" id="edit_coupon_time"
                                       placeholder="Số lượng" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Loại giảm giá:</label>
                                <select name="coupon_type" id="edit_coupon_condition" class="form-control">
                                    <option value disabled selected hidden>Chọn loại giảm giá</option>
                                    <option value="0">Giảm theo phần trăm</option>
                                    <option value="1">Giảm theo tiền</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhập số % hoặc tiền giảm:</label>
                                <input name="coupon_number" type="text" class="form-control form-control-solid" id="edit_coupon_number"
                                       placeholder="Nhập số % hoặc tiền giảm" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <div class="input-daterange input-group" id="kt_datepicker_6">
                                    <label class="col-form-label text-right">Thời gian từ</label>
                                    <input style="border-radius: 7px; margin: 0 10px" autocomplete="off" id="edit_coupon_date_start" type="text"
                                           class="form-control" name="coupon_start" />
                                    <label class="col-form-label text-right">Đến</label>
                                    <input style="border-radius: 7px; margin: 0 0 0 10px" autocomplete="off" id="edit_coupon_date_end" type="text"
                                           class="form-control" name="coupon_end" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_coupon" type="button" class="btn btn-primary mr-2">Cập nhật</button>
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
                <th>Tên mã</th>
                <th>Mã giảm giá</th>
                <th>Số lần sử dụng</th>
                <th>Mức giảm</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Chức năng</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script type="Text/javascript">
    $(document).ready(function() {
        var i = 0;
        var formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        });
        var table = $('#kt_datatable').DataTable({
            ajax: 'fetchdata-coupon',
            columns: [
                {
                    'data': null,
                    render: function() {
                        return i += 1
                    }
                },
                {
                    'data': 'name'
                },
                {
                    'data': 'code'
                },
                {
                    'data': 'time'
                },
                {
                    'data': null,
                    render: function(data, type, row) {
                        if (row.condition == 0) {
                            return `${row.number} %`;
                        } else {
                            return formatter.format(row.number);
                        }
                    }
                },
                {
                    'data': null,
                    render: function(data, type, row) {
                        return moment(row.date_start).format('DD-MM-YYYY');
                    }
                },
                {
                    'data': null,
                    render: function(data, type, row) {
                        return moment(row.date_end).format('DD-MM-YYYY');
                    }
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if (row.status == 0) {
                            return `\
                            <span data-id='${row.id}' data-coupon_status="1" class="status_coupon btn btn-sm btn-clean btn-icon" title="Đang kích hoạt">\
								<i class="la la-eye"></i>\
							</span>\
                            `;
                        } else {
                            return `\
                            <span data-id='${row.id}' data-coupon_status="0" class="status_coupon btn btn-sm btn-clean btn-icon" title="Đang tắt">\
								<i class="la la-eye-slash"></i>\
							</span>\
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
                            <span data-toggle="modal" data-target="#exampleModalPopovers2" data-id='${row.id}' class="edit_coupon btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-edit"></i>\
							</span>\
                            <span data-id='${row.id}' class="destroy_coupon btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        var form = KTUtil.getById('form_add_coupon');
        var validation = FormValidation.formValidation(
            form, {
                fields: {
                    coupon_name: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mục này'
                            },
                        }
                    },
                    coupon_code: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mục này'
                            },
                            stringLength: {
                                min: 6,
                                message: 'Mã giảm giá ít nhất 6 kí tự',
                            },
                        }
                    },
                    coupon_time: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mục này'
                            },
                        }
                    },
                    coupon_type: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn mục này'
                            },
                        }
                    },
                    coupon_number: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mục này'
                            },
                        }
                    },
                    coupon_status: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn mục này'
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
        var form2 = KTUtil.getById('form_edit_coupon');
        var validation2 = FormValidation.formValidation(
            form2, {
                fields: {
                    coupon_name: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mục này'
                            },
                        }
                    },
                    coupon_code: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mục này'
                            },
                            stringLength: {
                                min: 6,
                                message: 'Mã giảm giá ít nhất 6 kí tự',
                            },
                        }
                    },
                    coupon_time: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mục này'
                            },
                        }
                    },
                    coupon_type: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn mục này'
                            },
                        }
                    },
                    coupon_number: {
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
        $('#create_coupon').click(function(e) {
            e.preventDefault();
            var name = $('#coupon_name').val();
            var code = $('#coupon_code').val();
            var time = $('#coupon_time').val();
            var condition = $('#coupon_condition').val();
            var number = $('#coupon_number').val();
            var status = $('#coupon_status').val();
            var date_start = $('#coupon_date_start').val();
            var date_end = $('#coupon_date_end').val();
            validation.validate().then(function(check) {
                if (check != 'Valid') {
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
                } else if (coupon_condition == 0 && coupon_number > 100) {
                    swal.fire({
                        text: "Không thể giám giá lớn hơn 100%",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Đồng ý!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function () {
                        KTUtil.scrollTop();
                    });
                } else {
                    axios({
                        url: 'create-coupon',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            name: name,
                            code: code,
                            time: time,
                            condition: condition,
                            number: number,
                            date_start: date_start,
                            date_end: date_end,
                            status: status,
                        },
                    })
                    .then(function (response) {
                        console.log(response.data)
                        if (response.data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Thêm mã giảm giá thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (response.data == 0) {
                            Swal.fire("Thất bại", "Mã giảm giá đã nhập rồi!", "error");
                        }
                    });
                }
            });
        });
        $(document).on('click', '.status_coupon', function(e) {
            var id = $(this).data('id');
            var status = $(this).data('coupon_status');
            axios({
                url: 'status-coupon/' + id,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
                data: {
                    status : status,
                }
            })
            .then(function (response) {
                Swal.fire({
                    icon: "success",
                    title: "Thành công",
                    text: "Sửa mã giảm giá thành công!",
                    showConfirmButton: false,
                    timer: 1500
                });
                i = 0;
                table.ajax.reload();
            });
        });
        $(document).on('click', '.edit_coupon', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            axios({
                url: 'edit-coupon/' + id,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
            })
            .then(function (response) {
                $('#edit_coupon_id').val(response.data.id);
                $('#edit_coupon_name').val(response.data.name);
                $('#edit_coupon_code').val(response.data.code);
                $('#edit_coupon_time').val(response.data.time);
                $('#edit_coupon_condition').val(response.data.condition);
                $('#edit_coupon_number').val(response.data.number);
                $('#edit_coupon_date_start').val(moment(response.data.date_start).format('DD/MM/YYYY'));
                $('#edit_coupon_date_end').val(moment(response.data.date_end).format('DD/MM/YYYY'));
                validation2.validate();
            })
            .catch(function (error) {
                console.log(error);
            });
        });
        $('#update_coupon').click(function(e) {
            e.preventDefault();
            var id = $('#edit_coupon_id').val();
            var name = $('#edit_coupon_name').val();
            var code = $('#edit_coupon_code').val();
            var time = $('#edit_coupon_time').val();
            var condition = $('#edit_coupon_condition').val();
            var number = $('#edit_coupon_number').val();
            var date_start = $('#edit_coupon_date_start').val();
            var date_end = $('#edit_coupon_date_end').val();
            validation2.validate().then(function(status) {
                if (status != 'Valid') {
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
                }else if (coupon_condition == 0 && coupon_number > 100) {
                    swal.fire({
                        text: "Không thể giám giá lớn hơn 100%",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Đồng ý!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function () {
                        KTUtil.scrollTop();
                    });
                }  else {
                    axios({
                        url: 'update-coupon/' + id,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            name: name,
                            code: code,
                            time: time,
                            condition: condition,
                            number: number,
                            date_start: date_start,
                            date_end: date_end,
                        },
                    })
                    .then(function (response) {
                        console.log(response.data);
                        if (response.data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Sửa mã giảm giá thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (response.data == 0) {
                            Swal.fire("Thất bại", "mã giảm giá đã trùng tên!", "error");
                        }
                    });
                }
            });
        });
        $(document).on('click', '.destroy_coupon', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Xoá mã giảm giá",
                text: "Bạn có chắc là muốn xóa mã giảm giá không?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Đồng ý!",
                cancelButtonText: "Không"
            })
            .then(function(result) {
                if (result.value) {
                    axios({
                        url: 'destroy-coupon/' + id,
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
                                text: "Xoá mã giảm giá thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (response.data == 0) {
                            Swal.fire({
                                icon: "error",
                                title: "Thất bại",
                                text: "Đang có sản phẩm dùng mã giảm giá này!",
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
@endsection
