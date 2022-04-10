@extends('index')
@section('content')
<div class="card card-custom card-stretch">
    <div class="card-header py-3">
        <div class="card-title align-items-start flex-column">
            <h3 class="card-label font-weight-bolder text-dark">Hồ sơ</h3>
            <span class="text-muted font-weight-bold font-size-sm mt-1">Chỉnh sửa hồ sơ của bạn</span>
        </div>
        <div class="card-toolbar">
            <button type="button" id="kt_edit_profile_submit" class="btn btn-success mr-2">Lưu thông tin</button>
        </div>
    </div>
    <form class="form" autocomplete="off" novalidate="novalidate"
        id="kt_edit_profile_form">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Ảnh đại diện:</label>
                <div class="col-lg-9 col-xl-6">
                    <div class="image-input image-input-outline" id="kt_profile_avatar">
                        @php
                            $image = Auth::user()->image;
                            if ($image) {
                                echo '<div class="image-input-wrapper" style="background-image: url(uploads/avatar/'.$image.')"></div>';
                            }
                            else {
                                echo '<div class="image-input-wrapper"></div>';
                            }
                        @endphp
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input id="image" type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="profile_avatar_remove" />
                        </label>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                    <span class="form-text text-muted">Chỉ tải được các loại file: png, jpg, jpeg.</span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Họ và tên:</label>
                <div class="col-lg-9 col-xl-6">
                    <input id="name" name="name" value="{{Auth::user()->name}}"
                           class="form-control form-control-lg form-control-solid" type="text" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Số điện thoại:</label>
                <div class="col-lg-9 col-xl-6">
                    <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="la la-phone"></i>
                            </span>
                        </div>
                        <input id="phone" name="phone" type="text" value="{{Auth::user()->phone}}"
                            class="form-control form-control-lg form-control-solid" />
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                <div class="col-lg-9 col-xl-6">
                    <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="la la-at"></i>
                            </span>
                        </div>
                        <input id="email" name="email" type="text" value="{{Auth::user()->email}}"
                            class="form-control form-control-lg form-control-solid" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    var validation;
    var form = KTUtil.getById('kt_edit_profile_form');
    validation = FormValidation.formValidation(
        form, {
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'Vui lòng điền thông tin'
                        },
                        stringLength: {
                            max: 255,
                            message: 'Không thể điền quá 255 kí tự',
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
                        notEmpty: {
                            message: 'Vui lòng điền thông tin'
                        },
                        emailAddress: {
                            message: 'Vui lòng kiểm tra email'
                        }
                    }
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap()
            }
        }
    );
    $('#kt_edit_profile_submit').on('click', function(e) {
        e.preventDefault();
        var image = $('#image').get(0).files[0];
        var name = $('#name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var form_data = new FormData();
        validation.validate().then(function(status) {
            if (status != 'Valid') {
                swal.fire({
                    text: "Xin lỗi, có vẻ như đã phát hiện thấy một số lỗi, vui lòng thử lại .",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Đồng ý!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                }).then(function() {
                    KTUtil.scrollTop();
                });
            }
            else {
                form_data.append("image", image);
                form_data.append("name", name);
                form_data.append("phone", phone);
                form_data.append("email", email);
                axios({
                    url : 'update-profile',
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
                    if (response.data == 0) {
                        Swal.fire("", "Email này đã được sử dụng rồi!", "warning");
                    } else if (response.data == 1) {
                        Swal.fire({
                            title: "Thành công",
                            text: "Tải lại trang để cập nhật thông tin?",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: "Đồng ý!",
                        })
                        .then(function(result) {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        });
    });
</script>
@endsection
