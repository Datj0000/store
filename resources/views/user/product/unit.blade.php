@extends('index')
@section('content')
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
                </span>Thêm đơn vị</span>
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
                    <form class="form" id="form_add_unit">
                        <div class=" card-body">
                            <div class="form-group">
                                <label>Tên đơn vị:</label>
                                <input name="unit_name" type="Text" class="form-control form-control-solid"
                                       id="unit_name" placeholder="Tên đơn vị" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Ghi chú:</label>
                                <textarea rows="5" class="form-control form-control-solid" id="unit_desc"
                                          placeholder="Ghi chú"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="create_unit" type="button" class="btn btn-primary mr-2">Thêm mới</button>
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
                    <form class="form" id="form_edit_unit">
                        <div class=" card-body">
                            <input type="hidden" id="edit_unit_id">
                            <div class="form-group">
                                <label>Tên đơn vị:</label>
                                <input name="unit_name" type="Text" class="form-control form-control-solid"
                                       id="edit_unit_name" placeholder="Tên đơn vị" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Ghi chú:</label>
                                <textarea rows="5" class="form-control form-control-solid" id="edit_unit_desc"
                                          placeholder="Ghi chú"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_unit" type="button" class="btn btn-primary mr-2">Cập nhật</button>
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
                <th>Đơn vị</th>
                <th>Ghi chú</th>
                <th>Chức năng</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script type="Text/javascript">
    $(document).ready(function() {
        var i = 0;
        var table = $('#kt_datatable').DataTable({
            ajax: 'fetchdata-unit',
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
                    'data': 'desc'
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers2" data-id='${row.id}' class="edit_unit btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-edit"></i>\
							</span>\
                            <span data-id='${row.id}' class="destroy_unit btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        var form = KTUtil.getById('form_add_unit');
        var validation = FormValidation.formValidation(
            form, {
                fields: {
                    unit_name: {
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
        var form2 = KTUtil.getById('form_edit_unit');
        var validation2 = FormValidation.formValidation(
            form2, {
                fields: {
                    unit_name: {
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
        $('#create_unit').click(function(e) {
            e.preventDefault();
            var name = $('#unit_name').val();
            var desc = $('#unit_desc').val();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'create-unit',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            name: name,
                            desc: desc,
                        },
                    })
                    .then(function (response) {
                        if (response.data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Thêm đơn vị thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (response.data == 0) {
                            Swal.fire({
                                icon: "warning",
                                title: "Thất bại",
                                text: "Đơn vị này đã nhập rồi!",
                                showConfirmButton: false,
                                timer: 1500
                            });
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
        $(document).on('click', '.edit_unit', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            axios({
                url: 'edit-unit/' + id,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
            })
            .then(function (response) {
                $('#edit_unit_id').val(response.data.id);
                $('#edit_unit_name').val(response.data.name);
                $('#edit_unit_desc').val(response.data.desc);
                validation2.validate();
            });
        });
        $('#update_unit').click(function(e) {
            e.preventDefault();
            var id = $('#edit_unit_id').val();
            var name = $('#edit_unit_name').val();
            var desc = $('#edit_unit_desc').val();
            validation2.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'update-unit/'+id,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            name: name,
                            desc: desc,
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
                            Swal.fire("Thất bại", "Đơn vị đã trùng tên!", "error");
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
        $(document).on('click', '.destroy_unit', function(e) {
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
                        url: 'destroy-unit/' + id,
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
    })
</script>
@endsection
