"use strict";

// Class Definition
var KTLogin = function () {
    var _login;

    var _showForm = function (form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-forgot-on');
        _login.removeClass('login-signin-on');
        _login.removeClass('login-signup-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }
    function _send_token(email){
        $.ajax({
            url: 'send-token',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
            },
            data: {
                email: email,
            }
        })
    }
    const strongPassword = function () {
        return {
            validate: function (input) {
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
    var _handleSignInForm = function () {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            KTUtil.getById('kt_login_signin_form'),
            {
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền email'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mật khẩu'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        $('#kt_login_signin_submit').on('click', function (e) {
            e.preventDefault();
            var email = $('#email').val();
            var password = $('#password').val();
            validation.validate().then(function (status) {
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
                } else {
                    $.ajax({
                        url: 'login',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            email: email,
                            password: password,
                        },
                        success: function(data) {
                            if (data == 0) {
                                Swal.fire("", "Sai tài khoản hoặc mật khẩu!", "warning");
                            } else {
                                window.location = 'dashboard';
                            }
                        }
                    })
                }
            });
        });

        // Handle forgot button
        $('#kt_login_forgot').on('click', function (e) {
            e.preventDefault();
            _showForm('forgot');
        });

        // Handle signup
        $('#kt_login_signup').on('click', function (e) {
            e.preventDefault();
            _showForm('signup');
        });
    }
    var _handleSignUpForm = function (e) {
        var validation;
        var form = KTUtil.getById('kt_login_signup_form');
        FormValidation.validators.checkPassword = strongPassword;
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            form,
            {
                fields: {
                    token: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mã token'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mật khẩu'
                            },
                            checkPassword: {
                                message: 'Mật khẩu ít nhất 8 kí tự gồm cả số và chữ viết hoa, viết thường'
                            },
                        }
                    },
                    cpassword: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mật khẩu'
                            },
                            identical: {
                                compare: function () {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'Hai mật khẩu vui lòng trùng nhau'
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
        $('#kt_login_signup_submit').on('click', function (e) {
            e.preventDefault();
            var email = $('#email_forgot').val();
            var token = $('#token').val();
            var password = $('#password').val();
            validation.validate().then(function (status) {
                if (status == 'Valid') {
                    $.ajax({
                        url: 'reset-pass',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            email: email,
                            token: token,
                            password: password
                        },
                        success: function (data) {
                            if (data == 0) {
                                Swal.fire("", "Mã của bạn đã hết hạn!", "warning");
                            }
                            else if (data == 1) {
                                Swal.fire("", "Đổi mật khẩu thành công!", "success");
                                _showForm('signin');
                            }
                        }
                    })
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

        // Handle cancel button
        $('#kt_login_signup_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }
    var _handleForgotForm = function (e) {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            KTUtil.getById('kt_login_forgot_form'),
            {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền email'
                            },
                            emailAddress: {
                                message: 'Email này không hợp lệ'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        // Handle submit button
        $('#kt_login_forgot_submit').on('click', function (e) {
            e.preventDefault();
            validation.validate().then(function (status) {
                if (status == 'Valid') {
                    var email = $('#email_forgot').val();
                    $.ajax({
                        url: 'recover-pass',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            email: email,
                        },
                        success: function (data) {
                            if (data == 0) {
                                Swal.fire("", "Email này chưa đăng kí tài khoản!", "warning");
                            }
                            else if (data == 1) {
                                Swal.fire("", "Vui lòng kiểm tra email để lấy lại mật khẩu!", "success");
                                _showForm('signup');
                                _send_token(email);
                            }
                        }
                    })
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
        // Handle cancel button
        $('#kt_login_forgot_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    // Public Functions
    return {
        // public functions
        init: function () {
            _login = $('#kt_login');

            _handleSignInForm();
            _handleSignUpForm();
            _handleForgotForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function () {
    KTLogin.init();
});
