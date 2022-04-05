<style>
    .import__shape {
        width: 3rem;
        height: 3rem;
        border: 1px solid #fff4de;
    }

    .import__img {
        width: 100%;
        height: 100%
    }
</style>
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách nhập hàng
                <span class="d-block text-muted pt-2 font-size-sm">Quản lý danh sách nhập hàng</span>
            </h3>
        </div>
        <div class="card-toolbar">
            <span class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#exampleModalSizeSm">
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
    <div class="modal fade" id="exampleModalSizeSm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm nhập hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_add_import">
                        <div class=" card-body">
                            <div class="form-group">
                                <label>Nhà cung cấp:</label>
                                <select id="supplier_id" name="supplier" class="form-control">
                                    @if($supplier->count() > 0)
                                        <option value disabled selected hidden>Chọn nhà cung cấp</option>
                                        @foreach ($supplier as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->supplier_name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Chưa có nhà cung cấp</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Phí ship:</label>
                                <input name="fee_ship" type="number" class="form-control form-control-solid" min="0"
                                       id="import_fee_ship" placeholder="Phí ship" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="create_import" type="button" class="btn btn-primary mr-2">Thêm mới</button>
                            <button type="reset" class="btn btn-secondary">Nhập lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit --}}
    <div class="modal fade" id="exampleModalSizeSm2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa nhập hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_edit_import">
                        <div class=" card-body">
                            <input type="hidden" id="edit_import_id">
                            <div class="form-group">
                                <label>Nhà cung cấp:</label>
                                <select id="edit_supplier_id" name="supplier" class="form-control">
                                    @if($supplier->count() > 0)
                                        <option value disabled selected hidden>Chọn nhà cung cấp</option>
                                        @foreach ($supplier as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->supplier_name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Chưa có nhà cung cấp</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Phí ship:</label>
                                <input name="fee_ship" type="number" class="form-control form-control-solid" min="0"
                                       id="edit_import_fee_ship" placeholder="Phí ship" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_import" type="button" class="btn btn-primary mr-2">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Add importdetail --}}
    <div class="modal fade" id="exampleModalSizeSm3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm nhập hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_add_importdetail">
                        <div class=" card-body">
                            <input type="hidden" id="import_id">
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
                                            <input id="importdetail_image" type="file" name="image" accept=".png, .jpg, .jpeg" />
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
                                <label>Thương hiệu sản phẩm:</label>
                                <select id="brand_id" name="brand" class="form-control">
                                    @if($brand->count() > 0)
                                        <option value disabled selected hidden>Chọn thương hiệu sản phẩm</option>
                                        @foreach ($brand as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->brand_name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Chưa có thương hiệu sản phẩm</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Danh mục sản phẩm:</label>
                                <select id="category_id" name="category" class="form-control">
                                    @if($category->count() > 0)
                                        <option value disabled selected hidden>Chọn danh mục sản phẩm</option>
                                        @foreach ($category as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Chưa có danh mục sản phẩm</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sản phẩm:</label>
                                <select id="product_id" name="product" class="form-control">
                                    @if($product->count() > 0)
                                        <option value disabled selected hidden>Chọn sản phẩm</option>
                                        @foreach ($product as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Chưa có sản phẩm</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Giá nhập:</label>
                                <input name="iprice" type="number" class="form-control form-control-solid" min="0"
                                       id="importdetail_import_price" placeholder="Giá nhập" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Giá bán:</label>
                                <input name="sprice" type="number" class="form-control form-control-solid" min="0"
                                       id="importdetail_sell_price" placeholder="Giá bán" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Số lượng:</label>
                                <input name="quantity" type="number" class="form-control form-control-solid" min="0"
                                       id="importdetail_quantity" placeholder="Số lượng" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Link drive:</label>
                                <input name="drive" type="text" class="form-control form-control-solid"
                                       id="importdetail_drive" placeholder="Link drive" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                                <span class="form-text text-muted">Link google drive chứa các hình ảnh, video bảo gồm:</span>
                                <span class="form-text text-muted">- Của nhà cung cấp gửi cho mình trước khi gửi hàng</span>
                                <span class="form-text text-muted">- Unbox lấy hàng và kiểm tra hàng trước khi nhập kho</span>
                                <span class="form-text text-muted">- Sau khi nhập kho và sắp xếp vị trí để bày bán</span>
                            </div>
                            <div class="form-group">
                                <label>Thuế:</label>
                                <input name="vat" type="text" class="form-control form-control-solid"
                                       id="importdetail_vat" placeholder="Thuế" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                                <span class="form-text text-muted">Nếu sản phẩm có thuế ghi theo định dạng:</span>
                                <span class="form-text text-muted">Tên thuế + % thuế + bản giấy/link thuế điện tử/email nhận thuế</span>
                            </div>
                            <div class="form-group">
                                <div class="input-daterange input-group" id="kt_datepicker_5">
                                    <label class="col-form-label text-right">Bảo hành từ</label>
                                    <input style="border-radius: 7px; margin: 0 10px" autocomplete="off" id="importdetail_date_start" type="text"
                                           class="form-control" name="start" />
                                    <label class="col-form-label text-right">Đến</label>
                                    <input style="border-radius: 7px; margin: 0 0 0 10px" autocomplete="off" id="importdetail_date_end" type="text"
                                           class="form-control" name="end" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="create_importdetail" type="button" class="btn btn-primary mr-2">Thêm mới</button>
                            <button type="reset" class="btn btn-secondary">Nhập lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit Detail --}}
    <div class="modal fade" id="exampleModalSizeSm4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa nhập hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_edit_importdetail">
                        <div class=" card-body">
                            <input type="hidden" id="edit_importdetail_id">
                            <div class="form-group">
                                <label>Hình ảnh:</label><br>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="image-input image-input-outline image-input" id="kt_image_1">
                                        <div class="view_image image-input-wrapper"></div>
                                        <label
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="change" data-toggle="tooltip" title=""
                                            data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input id="importdetail_image" type="file" name="image" accept=".png, .jpg, .jpeg" />
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
                                <label>Thương hiệu sản phẩm:</label>
                                <select id="edit_brand_id" name="brand" class="form-control">
                                    @if($brand->count() > 0)
                                        <option value disabled selected hidden>Chọn thương hiệu sản phẩm</option>
                                        @foreach ($brand as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->brand_name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Chưa có thương hiệu sản phẩm</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Danh mục sản phẩm:</label>
                                <select id="edit_category_id" name="category" class="form-control">
                                    @if($category->count() > 0)
                                        <option value disabled selected hidden>Chọn danh mục sản phẩm</option>
                                        @foreach ($category as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Chưa có danh mục sản phẩm</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sản phẩm:</label>
                                <select id="edit_product_id" name="product" class="form-control">
                                    @if($product->count() > 0)
                                        <option value disabled selected hidden>Chọn sản phẩm</option>
                                        @foreach ($product as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Chưa có sản phẩm</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Giá nhập:</label>
                                <input name="iprice" type="number" class="form-control form-control-solid" min="0"
                                       id="edit_importdetail_import_price" placeholder="Giá nhập" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Giá bán:</label>
                                <input name="sprice" type="number" class="form-control form-control-solid" min="0"
                                       id="edit_importdetail_sell_price" placeholder="Giá bán" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Số lượng:</label>
                                <input name="quantity" type="number" class="form-control form-control-solid" min="0"
                                       id="edit_importdetail_quantity" placeholder="Số lượng" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;"/>
                            </div>
                            <div class="form-group">
                                <label>Link drive:</label>
                                <input name="drive" type="text" class="form-control form-control-solid"
                                       id="edit_importdetail_drive" placeholder="Link drive" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                                <span class="form-text text-muted">Link google drive chứa các hình ảnh, video bảo gồm:</span>
                                <span class="form-text text-muted">- Của nhà cung cấp gửi cho mình trước khi gửi hàng</span>
                                <span class="form-text text-muted">- Unbox lấy hàng và kiểm tra hàng trước khi nhập kho</span>
                                <span class="form-text text-muted">- Sau khi nhập kho và sắp xếp vị trí để bày bán</span>
                            </div>
                            <div class="form-group">
                                <label>Thuế:</label>
                                <input name="vat" type="text" class="form-control form-control-solid"
                                       id="edit_importdetail_vat" placeholder="Thuế" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==255) return false;"/>
                                <span class="form-text text-muted">Nếu sản phẩm có thuế ghi theo định dạng:</span>
                                <span class="form-text text-muted">Tên thuế + % thuế + bản giấy/link thuế điện tử/email nhận thuế</span>
                            </div>
                            <div class="form-group">
                                <div class="input-daterange input-group" id="kt_datepicker_5">
                                    <label class="col-form-label text-right">Bảo hành từ</label>
                                    <input style="border-radius: 7px; margin: 0 10px" autocomplete="off" id="edit_importdetail_date_start" type="text"
                                           class="form-control" name="start" />
                                    <label class="col-form-label text-right">Đến</label>
                                    <input style="border-radius: 7px; margin: 0 0 0 10px" autocomplete="off" id="edit_importdetail_date_end" type="text"
                                           class="form-control" name="end" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_importdetail" type="button" class="btn btn-primary mr-2">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Viewimportdetail --}}
    <div class="modal fade" id="exampleModalSizeSm5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết hoá đơn nhập hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="load_importdetail"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-separate table-head-custom table-checkable display nowrap" cellspacing="0" width="100%" id="kt_datatable">
            <thead>
            <tr>
                <th>STT</th>
                <th>Thời gian tạo</th>
                <th>Nhà cung cấp</th>
                <th>Phí ship</th>
                <th>Chức năng</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script src="{{ asset('asset/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('asset/js/pages/crud/file-upload/image-input.js') }}"></script>
<script type="text/javascript">
    function load_importdetail(id){
        axios.get('fetchdata-importdetail/' + id)
            .then(function(response) {
                $("#load_importdetail").html(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    }
    $(document).ready(function() {
        var i = 0;
        var formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        });
        var table = $('#kt_datatable').DataTable({
            ajax: 'fetchdata-import',
            columns: [
                {
                    'data': null,
                    render: function() {
                        return i += 1
                    }
                },
                {
                    'data': null,
                    render: function(data, type, row) {
                        return moment(row.created_at).format('H:mm DD-MM-YYYY');
                    }
                },
                {
                    'data': 'supplier_name'
                },
                {
                    'data': null,
                    render: function(data, type, row) {
                        return formatter.format(row.import_fee_ship);
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
                            <div class="dropdown dropdown-inline">\
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">\
	                                <i class="la la-cog"></i>\
	                            </a>\
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
									<ul class="nav nav-hoverable flex-column">\
							    		<li data-toggle="modal" data-target="#exampleModalSizeSm3" class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-edit"></i><span class="nav-text">Thêm sản phẩm</span></a></li>\
							    		<li onclick="load_importdetail(${row.id})" data-toggle="modal" data-target="#exampleModalSizeSm5" class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-leaf"></i><span class="nav-text">Danh sách</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-print"></i><span class="nav-text">In hoá đơn</span></a></li>\
									</ul>\
							  	</div>\
							</div>\
                            <span data-toggle="modal" data-target="#exampleModalSizeSm2" data-id='${row.id}' class="edit_import btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-edit"></i>\
							</span>\
                            <span data-id='${row.id}' class="destroy_import btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        var form = KTUtil.getById('form_add_import');
        var validation = FormValidation.formValidation(
            form, {
                fields: {
                    supplier: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mục này'
                            },
                        }
                    },
                    fee_ship: {
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
        var form2 = KTUtil.getById('form_edit_import');
        var validation2 = FormValidation.formValidation(
            form2, {
                fields: {
                    supplier: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mục này'
                            },
                        }
                    },
                    fee_ship: {
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
        var form3 = KTUtil.getById('form_add_importdetail');
        var validation3 = FormValidation.formValidation(
            form3, {
                fields: {
                    image: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn ảnh cho sản phẩm'
                            },
                        }
                    },
                    product: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn sản phẩm'
                            },
                        }
                    },
                    iprice: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền thông tin'
                            },
                        }
                    },
                    sprice: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền thông tin'
                            },
                        }
                    },
                    quantity: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền thông tin'
                            },
                        }
                    },
                    drive: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền thông tin'
                            },
                            uri: {
                                message: 'Vui lòng kiểm tra lại đường dẫn'
                            },
                        }
                    },
                    start: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn thời gian bảo hành'
                            },
                        }
                    },
                    end: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn thời gian bảo hành'
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
        var form4 = KTUtil.getById('form_edit_importdetail');
        var validation4 = FormValidation.formValidation(
            form4, {
                fields: {
                    product: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn sản phẩm'
                            },
                        }
                    },
                    iprice: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền thông tin'
                            },
                        }
                    },
                    sprice: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền thông tin'
                            },
                        }
                    },
                    quantity: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền thông tin'
                            },
                        }
                    },
                    drive: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền thông tin'
                            },
                            uri: {
                                message: 'Vui lòng kiểm tra lại đường dẫn'
                            },
                        }
                    },
                    start: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn thời gian bảo hành'
                            },
                        }
                    },
                    end: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn thời gian bảo hành'
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
        $(document).on('click', '#create_import', function(e) {
            e.preventDefault();
            var supplier_id = $('#supplier_id').val();
            var import_fee_ship = $('#import_fee_ship').val();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'create-import',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            supplier_id: supplier_id,
                            import_fee_ship: import_fee_ship,
                        },
                    })
                        .then(function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Tạo đơn nhập hàng thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                            $('#exampleModalSizeSm3').modal();
                            $('#import_id').val(response.data);
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
        $(document).on('click', '.edit_import', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            axios({
                url: 'edit-import/' + id,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
            })
                .then(function (response) {
                    $('#edit_import_id').val(response.data.id);
                    $('#edit_supplier_id').val(response.data.supplier_id);
                    $('#edit_import_fee_ship').val(response.data.import_fee_ship);
                    validation2.validate();
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
        $(document).on('click', '#update_import', function(e) {
            e.preventDefault();
            var id = $('#edit_import_id').val();
            var supplier_id = $('#edit_supplier_id').val();
            var import_fee_ship = $('#edit_import_fee_ship').val();
            validation2.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'update-import/'+id,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            supplier_id: supplier_id,
                            import_fee_ship: import_fee_ship,
                        },
                    })
                        .then(function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Sửa nhập hàng thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
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
        $(document).on('click', '.destroy_import', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Xoá nhập hàng",
                text: "Bạn có chắc là muốn xóa nhập hàng không?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Đồng ý!",
                cancelButtonText: "Không"
            })
                .then(function(result) {
                    if (result.value) {
                        axios({
                            url: 'destroy-import/' + id,
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
                                        text: "Xoá nhập hàng thành công!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    i = 0;
                                    table.ajax.reload();
                                } else if (response.data == 0) {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Thất bại",
                                        text: "Đang có sản phẩm thuộc nhập hàng này!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    }
                });
        });
        $(document).on('click', '#create_importdetail', function(e) {
            e.preventDefault();
            var id = $('#import_id').val();
            var detail_image = $('#importdetail_image').get(0).files[0];
            var product_id = $('#product_id').val();
            var detail_import_price = $('#importdetail_import_price').val();
            var detail_sell_price = $('#importdetail_sell_price').val();
            var detail_date_start = $('#importdetail_date_start').val();
            var detail_date_end = $('#importdetail_date_end').val();
            var detail_quantity = $('#importdetail_quantity').val();
            var detail_drive = $('#importdetail_drive').val();
            var detail_vat = $('#importdetail_vat').val();
            validation3.validate().then(function(status) {
                if (status == 'Valid') {
                    var form_data = new FormData();
                    form_data.append("product_id", product_id);
                    form_data.append("detail_image", detail_image);
                    form_data.append("detail_import_price", detail_import_price);
                    form_data.append("detail_sell_price", detail_sell_price);
                    form_data.append("detail_date_start", detail_date_start);
                    form_data.append("detail_date_end", detail_date_end);
                    form_data.append("detail_quantity", detail_quantity);
                    form_data.append("detail_drive", detail_drive);
                    form_data.append("detail_vat", detail_vat);
                    axios({
                        url: 'create-importdetail/' + id,
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
                            console.log(response.data);
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Thêm sản phẩm thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
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
        $(document).on('click', '.ki-close', function(e) {
            $('.modal-backdrop').removeClass('show');
            $('.modal-backdrop').removeClass('fade');
            var body = $('body');
            if ( body.is('.modal-backdrop') ){
                body.removeClass('modal-backdrop');
            } else {
                setTimeout(cleanBody, 500);
            }
        });
        $(document).on('click', '.edit_importdetail', function(e) {
            e.preventDefault();
            
            $('#exampleModalSizeSm5').hide();
            $('#exampleModalSizeSm4').modal();
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
                    $('.view_image').css("background-image", "url(uploads/import/" +response.data.detail_image + ")");
                    $('#product_id').val(response.data.product_id);
                    $('#edit_importdetail_import_price').val(response.data.product_id);
                    $('#edit_importdetail_sell_price').val(response.data.detail_sell_price);
                    $('#edit_importdetail_date_start').val(response.data.detail_date_start);
                    $('#edit_importdetail_date_end').val(response.data.detail_date_end);
                    $('#edit_importdetail_quantity').val(response.data.detail_quantity);
                    $('#edit_importdetail_drive').val(response.data.detail_drive);
                    $('#edit_importdetail_vat').val(response.data.detail_vat);
                    validation4.validate();
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
        $(document).on('click', '#update_importdetail', function(e) {
            e.preventDefault();
            var id = $('#edit_importdetail_id').val();
            var supplier_id = $('#edit_supplier_id').val();
            var import_fee_ship = $('#edit_import_fee_ship').val();
            validation2.validate().then(function(status) {
                if (status == 'Valid') {
                    axios({
                        url: 'update-import/'+id,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            supplier_id: supplier_id,
                            import_fee_ship: import_fee_ship,
                        },
                    })
                        .then(function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Sửa nhập hàng thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
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
        $(document).on('click', '.destroy_importdetail', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Xoá nhập hàng",
                text: "Bạn có chắc là muốn xóa nhập hàng không?",
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
                                        text: "Xoá nhập hàng thành công!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    i = 0;
                                    table.ajax.reload();
                                } else if (response.data == 0) {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Thất bại",
                                        text: "Đang có sản phẩm thuộc nhập hàng này!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    }
                });
        });
    })
</script>
