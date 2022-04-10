@extends('index')
@section('content')
<style>
    .product__shape {
        width: 5rem;
        height: 5rem;
        border: 1px solid #fff4de;
    }

    .product__img {
        width: 100%;
        height: 100%
    }
</style>
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách sản phẩm
                 <span class="d-block text-muted pt-2 font-size-sm">Quản lý danh sách sản phẩm</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="True" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_add_product">
                        <div class=" card-body">
                            <div class="form-group">
                                <label>Hình ảnh:</label><br>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="image-input image-input-outline image-input" id="kt_image_1">
                                        <div class="image-input-wrapper"></div>
                                        <label
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="change" data-toggle="tooltip" title=""
                                            data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input id="product_image" type="file" name="image" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="profile_avatar_remove" />
                                        </label>
                                        <span
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">Chỉ tải được các loại file: png, jpg, jpeg.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm:</label>
                                <input name="product_name" type="Text" class="form-control form-control-solid"
                                       id="product_name" placeholder="Tên sản phẩm" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Thương hiệu:</label>
                                <select id="brand_id" name="product_brand" class="form-control">
                                    @if($brand->count() > 0)
                                        <option value disabled selected hidden>Chọn thương hiệu</option>
                                        @foreach ($brand as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Chưa có thương hiệu</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Danh mục:</label>
                                <select id="category_id" name="product_category" class="form-control">
                                    @if($cate->count() > 0)
                                        <option value disabled selected hidden>Chọn danh mục</option>
                                        @foreach ($cate as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Chưa có danh mục</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Đơn vị:</label>
                                <select id="unit_id" name="product_unit" class="form-control">
                                    @if($unit->count() > 0)
                                        <option value disabled selected hidden>Chọn đơn vị</option>
                                        @foreach ($unit as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Chưa có đơn vị</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="create_product" type="button" class="btn btn-primary mr-2">Thêm mới</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Sửa sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="True" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_edit_product">
                        <div class=" card-body">
                            <input type="hidden" id="edit_product_id">
                            <div class="form-group">
                                <label>Hình ảnh:</label><br>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="image-input image-input-outline image-input" id="kt_image_2">
                                        <div class="view_image image-input-wrapper"></div>
                                        <label
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="change" data-toggle="tooltip" title=""
                                            data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input id="edit_product_image" type="file" name="image" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="profile_avatar_remove" />
                                        </label>
                                        <span
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">Chỉ tải được các loại file: png, jpg, jpeg.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm:</label>
                                <input name="product_name" type="Text" class="form-control form-control-solid"
                                       id="edit_product_name" placeholder="Tên sản phẩm" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Thương hiệu:</label>
                                <select id="edit_brand_id" name="product_brand" class="form-control">
                                    @if($brand->count() > 0)
                                        <option value disabled selected hidden>Chọn thương hiệu</option>
                                        @foreach ($brand as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Chưa có thương hiệu</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Danh mục:</label>
                                <select id="edit_category_id" name="product_category" class="form-control">
                                    @if($cate->count() > 0)
                                        <option value disabled selected hidden>Chọn danh mục</option>
                                        @foreach ($cate as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Chưa có danh mục</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Đơn vị:</label>
                                <select id="edit_unit_id" name="product_unit" class="form-control">
                                    <option value disabled selected hidden>Chọn đơn vị</option>
                                    @if($unit->count() > 0)
                                        <option value disabled selected hidden>Chọn đơn vị</option>
                                        @foreach ($unit as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Chưa có đơn vị</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_product" type="button" class="btn btn-primary mr-2">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- View product detail --}}
    <div class="modal fade" id="exampleModalSizeSm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Danh sách sản phẩm trong kho</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="load_productdetail"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
    <div class="card-body">
        <table class="table table-separate table-head-custom table-checkable display nowrap" cellspacing="0" width="100%" id="kt_datatable">
            <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Sản phẩm</th>
                <th>Thương hiệu</th>
                <th>Danh mục</th>
                <th>Đơn vị</th>
                <th>Tồn kho</th>
                <th>Chức năng</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script src="{{ asset('asset/js/pages/crud/file-upload/image-input.js') }}"></script>
<script type="Text/javascript">
    function load_productdetail(id){
        axios.get('load-productdetail/' + id)
            .then(function(response) {
                $("#load_productdetail").html(response.data);
                $('#responsive2').DataTable({
                    "ordering": false,
                    "responsive": true,
                    "searching": false,
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false,
                    "bAutoWidth": false
                });
            })
            .catch((error) => {
                console.log(error);
            });
    }
    $(document).ready(function() {
        var i = 0;
        var formatter = new Intl.NumberFormat();
        var table = $('#kt_datatable').DataTable({
            ajax: 'fetchdata-product',
            columns: [
                {
                    'data': null,
                    render: function() {
                        return i += 1.
                    }
                },
                {
                    'data': null,
                    sortable: false,
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if(row.image){
                            return `\
                            <div class="product__shape">
                                <img class="product__img" src="{{url('uploads/product/${row.image}')}}">
                            </div>
                            `
                        }else {
                            return `\
                            <div class="product__shape">
                                <img class="product__img" src="{{url('asset/media/users/noimage.png')}}">
                            </div>
                            `
                        }
                    }
                },
                {
                    'data': 'name'
                },
                {
                    'data': 'brand_name'
                },
                {
                    'data': 'category_name'
                },
                {
                    'data': 'unit_name'
                },
                {
                    'data': null,
                    render: function(data, type, row) {
                        return formatter.format(row.quantity - row.soldout);
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
                            <span onclick="load_productdetail(${row.id})" data-toggle="modal" data-target="#exampleModalSizeSm" class="btn btn-sm btn-clean btn-icon" title="Danh sách sản phẩm trong kho">\
								<i class="la la-list"></i>\
							</span>\
                            <span data-toggle="modal" data-target="#exampleModalPopovers2" data-id='${row.id}' class="edit_product btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-edit"></i>\
							</span>\
                            <span data-id='${row.id}' class="destroy_product btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        var form = KTUtil.getById('form_add_product');
        var validation = FormValidation.formValidation(
            form, {
                fields: {
                    product_name: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mục này'
                            },
                        }
                    },
                    product_category: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn danh mục sản phẩm'
                            },
                        }
                    },
                    product_brand: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn thương hiệu sản phẩm'
                            },
                        }
                    },
                    product_unit: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn đơn vị'
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
        var form2 = KTUtil.getById('form_edit_product');
        var validation2 = FormValidation.formValidation(
            form2, {
                fields: {
                    product_name: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mục này'
                            },
                        }
                    },
                    product_category: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn danh mục sản phẩm'
                            },
                        }
                    },
                    product_brand: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn thương hiệu sản phẩm'
                            },
                        }
                    },
                    product_unit: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn đơn vị'
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
        $('#create_product').click(function(e) {
            e.preventDefault();
            var image = $('#product_image').get(0).files[0];
            var name = $('#product_name').val();
            var category_id = $('#category_id').val();
            var brand_id = $('#brand_id').val();
            var unit_id = $('#unit_id').val();
            var form_data = new FormData();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    form_data.append("image", image);
                    form_data.append("name", name);
                    form_data.append("category_id", category_id);
                    form_data.append("brand_id", brand_id);
                    form_data.append("unit_id", unit_id);
                    axios({
                        url: 'create-product',
                        method : 'POST',
                        data: form_data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content'),
                            'cache': false,
                            'Content-Type' : false,
                            'processData': false,
                        },
                        withCredentials: true,
                    })
                    .then(function (response) {
                        console.log(response.data)
                        if (response.data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Thêm sản phẩm thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (response.data == 0) {
                            Swal.fire({
                                icon: "error",
                                title: "Thất bại",
                                text: "Sản phẩm đã nhập rồi!",
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
        $(document).on('click', '.edit_product', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            axios({
                url: 'edit-product/' + id,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
            })
                .then(function (response) {
                    $('.view_image').css("background-image", "url(uploads/product/" +response.data.image + ")");
                    $('#edit_product_id').val(response.data.id);
                    $('#edit_product_name').val(response.data.name);
                    $('#edit_category_id').val(response.data.category_id);
                    $('#edit_brand_id').val(response.data.brand_id);
                    $('#edit_unit_id').val(response.data.unit_id);
                    validation2.validate();
                });
        });
        $('#update_product').click(function(e) {
            e.preventDefault();
            var id = $('#edit_product_id').val();
            var image = $('#edit_product_image').get(0).files[0];
            var name = $('#edit_product_name').val();
            var category_id = $('#edit_category_id').val();
            var brand_id = $('#edit_brand_id').val();
            var unit_id = $('#edit_unit_id').val();
            var form_data = new FormData();
            validation2.validate().then(function(status) {
                if (status == 'Valid') {
                    form_data.append("image", image);
                    form_data.append("name", name);
                    form_data.append("category_id", category_id);
                    form_data.append("brand_id", brand_id);
                    form_data.append("unit_id", unit_id);
                    axios({
                        url: 'update-product/'+id,
                        method : 'POST',
                        data: form_data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content'),
                            'cache': false,
                            'Content-Type' : false,
                            'processData': false,
                        },
                        withCredentials: true,
                    })
                    .then(function (response) {
                        if (response.data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Sửa sản phẩm thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (response.data == 0) {
                            Swal.fire({
                                icon: "error",
                                title: "Thất bại",
                                text: "Sản phẩm đã nhập rồi!",
                                showConfirmButton: false,
                                timer: 1500
                            });
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
        $(document).on('click', '.destroy_product', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Xoá sản phẩm",
                text: "Bạn có chắc là muốn xóa sản phẩm không?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Đồng ý!",
                cancelButtonText: "Không"
            })
            .then(function(result) {
                if (result.value) {
                    axios({
                        url: 'destroy-product/' + id,
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
                                text: "Xoá sản phẩm thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (response.data == 0) {
                            Swal.fire({
                                icon: "error",
                                title: "Thất bại",
                                text: "Không thể xoá sản phẩm này!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                }
            });
        });
        $(document).on('click', '.edit_importdetail', function(e) {
            e.preventDefault();
            $('#exampleModalSizeSm4').modal();
            $('#exampleModalSizeSm4').css("z-index","2000");
            var id = $(this).data('id');
            axios({
                url: 'edit-importdetail/' + id,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
            })
                .then(function (response) {
                    $('#edit_importdetail_id').val(response.data.id);
                    $('.view_image').css("background-image", "url(uploads/import/" +response.data.image + ")");
                    $('#edit_product_id').val(response.data.product_id);
                    $('#edit_importdetail_import_id').val(response.data.import_id);
                    $('#edit_importdetail_import_price').val(response.data.import_price);
                    $('#edit_importdetail_sell_price').val(response.data.sell_price);
                    $('#edit_importdetail_date_start').val(response.data.date_start);
                    $('#edit_importdetail_date_end').val(response.data.date_end);
                    $('#edit_importdetail_quantity').val(response.data.quantity);
                    $('#edit_importdetail_drive').val(response.data.drive);
                    $('#edit_importdetail_vat').val(response.data.vat);
                    validation4.validate();
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
        $('#update_importdetail').click(function(e) {
            e.preventDefault();
            var id = $('#edit_importdetail_id').val();
            var import_id = $('#edit_importdetail_import_id').val();
            var product_id = $('#edit_product_id').val();
            var image = $('#edit_importdetail_image').get(0).files[0];
            var import_price = $('#edit_importdetail_import_price').val();
            var sell_price = $('#edit_importdetail_sell_price').val();
            var date_start = $('#edit_importdetail_date_start').val();
            var date_end = $('#edit_importdetail_date_end').val();
            var quantity = $('#edit_importdetail_quantity').val();
            var drive = $('#edit_importdetail_drive').val();
            var vat = $('#edit_importdetail_vat').val();
            validation4.validate().then(function(status) {
                if (status == 'Valid') {
                    var form_data = new FormData();
                    form_data.append("import_id", import_id);
                    form_data.append("product_id", product_id);
                    form_data.append("image", image);
                    form_data.append("import_price", import_price);
                    form_data.append("sell_price", sell_price);
                    form_data.append("date_start", date_start);
                    form_data.append("date_end", date_end);
                    form_data.append("quantity", quantity);
                    form_data.append("drive", drive);
                    form_data.append("vat", vat);
                    axios({
                        url: 'update-importdetail/'+id,
                        method: 'POST',
                        data: form_data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content'),
                            'cache': false,
                            'Content-Type' : false,
                            'processData': false,
                        },
                        withCredentials: true,
                    })
                        .then(function (response) {
                            if (response.data == 1) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công",
                                    text: "Sửa sản phẩm thành công!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                i = 0;
                                table.ajax.reload();
                                load_importdetail(import_id)
                            } else if (response.data == 0) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Thất bại",
                                    text: "Sản phẩm này đã tồn tại!",
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
        $(document).on('click', '.destroy_productdetail', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var product_id = $(this).data('product_id');
            Swal.fire({
                title: "Xoá nhập hàng",
                text: "Bạn có chắc là muốn xóa sản phẩm không?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Đồng ý!",
                cancelButtonText: "Không"
            })
                .then(function(result) {
                    if (result.value) {
                        axios({
                            url: 'destroy-importdetail/' + id,
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
                                    text: "Xoá sản phẩm thành công!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                i = 0;
                                table.ajax.reload();
                                load_productdetail(product_id)
                            } else if (response.data == 0) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Thất bại",
                                    text: "Đang có đơn hàng dùng sản phẩm này!",
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