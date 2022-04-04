<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset=utf-8>
    <title>Đăng nhập</title>
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name=viewport>
    <meta content="{{ csrf_token() }}" name=csrf-token>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel=stylesheet>
    <link href="{{ asset('asset/css/pages/login/login-2.css') }}" rel=stylesheet>
    <link href="{{ asset('asset/plugins/global/plugins.bundle.css') }}" rel=stylesheet>
    <link href="{{ asset('asset/css/style.bundle.css') }}" rel=stylesheet>
    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon">

<body
    class="aside-enabled aside-fixed aside-minimize-hoverable header-fixed header-mobile-fixed page-loading subheader-enabled subheader-fixed"
    id=kt_body>
    <div class="d-flex flex-column flex-root">
        <div class="bg-white d-flex flex-column flex-column-fluid flex-lg-row login login-2 login-signin-on"
            id=kt_login>
            <div class="d-flex flex-row-auto login-aside order-2 order-lg-1 overflow-hidden position-relative">
                <div class="d-flex flex-column flex-column-fluid justify-content-between px-7 px-lg-35 py-9 py-lg-13">
                    <span class="pt-2 text-center"><img alt
                            class=max-h-75px src="{{ asset('asset/media/logos/logo2.png') }}"/></span>

                    <div class="d-flex flex-center flex-column flex-column-fluid">
                        <div class="login-form login-signin py-11">
                            <form class=form id=kt_login_signin_form novalidate>
                                <div class="pb-8 text-center">
                                    <h2 class="font-size-h1-lg font-size-h2 font-weight-bolder text-dark">Đăng nhập</h2>
                                </div>
                                <div class=form-group><label
                                        class="font-size-h6 font-weight-bolder text-dark">Email</label> <input
                                        class="form-control form-control-solid h-auto px-6 py-7 rounded-lg"
                                        id=email name=username type=text></div>
                                <div class=form-group>
                                    <div class="d-flex justify-content-between mt-n5"><label
                                            class="font-size-h6 font-weight-bolder pt-5 text-dark">Mật khẩu</label> <a
                                            class="font-size-h6 font-weight-bolder pt-5 text-hover-primary text-primary"
                                            href=javascript:; id=kt_login_forgot>Quên mật khẩu ?</a></div> <input
                                        class="form-control form-control-solid h-auto px-6 py-7 rounded-lg"
                                        id=password name=password type=password>
                                </div>
                                <div class="pt-2 text-center"><button
                                        class="btn btn-dark font-size-h6 font-weight-bolder my-3 px-8 py-4"
                                        id=kt_login_signin_submit>Đăng nhập</button></div>
                            </form>
                        </div>
                        <div class="login-forgot login-form pt-11">
                            <form class=form id=kt_login_forgot_form novalidate>
                                <div class="pb-8 text-center">
                                    <h2 class="font-size-h1-lg font-size-h2 font-weight-bolder text-dark">Quên mật khẩu
                                        ?</h2>
                                    <p class="font-size-h4 font-weight-bold text-muted">Điền Email của bạn để lấy lại
                                        mật khẩu
                                </div>
                                <div class=form-group><input autocomplete=off
                                        class="font-size-h6 form-control form-control-solid h-auto px-6 py-7 rounded-lg"
                                        id=email_forgot name=email placeholder=Email type=email></div>
                                <div class="d-flex flex-center flex-wrap form-group pb-3 pb-lg-0"><button
                                        class="btn btn-primary font-size-h6 font-weight-bolder mx-4 my-3 px-8 py-4"
                                        id=kt_login_forgot_submit type=button>Submit</button> <button
                                        class="btn btn-light-primary font-size-h6 font-weight-bolder mx-4 my-3 px-8 py-4"
                                        id=kt_login_forgot_cancel type=button>Cancel</button></div>
                            </form>
                        </div>
                        <div class="login-form login-signup pt-11">
                            <form autocomplete=off class=form id=kt_login_signup_form novalidate>
                                <div class="pb-8 text-center">
                                    <h2 class="font-size-h1-lg font-size-h2 font-weight-bolder text-dark">Lấy lại mật
                                        khẩu</h2>
                                    <p class="font-size-h4 font-weight-bold text-muted">Điền mã và mật khẩu mới của bạn
                                </div>
                                <div class=form-group><input autocomplete=off
                                        class="font-size-h6 form-control form-control-solid h-auto px-6 py-7 rounded-lg"
                                        id=token name=token placeholder="Mã token" type=text></div>
                                <div class=form-group><input autocomplete=new-password
                                        class="font-size-h6 form-control form-control-solid h-auto px-6 py-7 rounded-lg"
                                        id=password name=password placeholder="Mật khẩu" type=password></div>
                                <div class=form-group><input autocomplete=off
                                        class="font-size-h6 form-control form-control-solid h-auto px-6 py-7 rounded-lg"
                                        id=re_password name=cpassword placeholder="Nhập lại mật khẩu" type=password>
                                </div>
                                <div class="d-flex flex-center flex-wrap form-group pb-3 pb-lg-0"><button
                                        class="btn btn-primary font-size-h6 font-weight-bolder mx-4 my-3 px-8 py-4"
                                        id=kt_login_signup_submit type=button>Submit</button> <button
                                        class="btn btn-light-primary font-size-h6 font-weight-bolder mx-4 my-3 px-8 py-4"
                                        id=kt_login_signup_cancel type=button>Cancel</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content d-flex flex-column order-1 order-lg-2 pb-0 w-100" style=background-color:#b1dced>
                <div
                    class="d-flex flex-column justify-content-center pt-5 pt-lg-40 pt-md-5 pt-sm-5 px-7 px-lg-0 text-center">
                    <h3 class="display4 font-weight-bolder my-7 text-dark" style=color:#986923>FunnyDev Store</h3>
                    <p class="font-size-h2-md font-size-lg font-weight-bolder opacity-70 text-dark">Nền tảng quản lý và
                        bán hàng đa kênh
                </div>
                <div class="bgi-no-repeat bgi-position-x-center bgi-position-y-bottom content-img d-flex flex-row-fluid"
                    style="background-image:url({{asset('asset/media/svg/illustrations/login-visual-2.svg')}})">
                </div>
            </div>
        </div>
        <script>
            var KTAppSettings={breakpoints:{sm:576,md:768,lg:992,xl:1200,xxl:1400},colors:{theme:{base:{white:"#ffffff",primary:"#3699FF",secondary:"#E5EAEE",success:"#1BC5BD",info:"#8950FC",warning:"#FFA800",danger:"#F64E60",light:"#E4E6EF",dark:"#181C32"},light:{white:"#ffffff",primary:"#E1F0FF",secondary:"#EBEDF3",success:"#C9F7F5",info:"#EEE5FF",warning:"#FFF4DE",danger:"#FFE2E5",light:"#F3F6F9",dark:"#D6D6E0"},inverse:{white:"#ffffff",primary:"#ffffff",secondary:"#3F4254",success:"#ffffff",info:"#ffffff",warning:"#ffffff",danger:"#ffffff",light:"#464E5F",dark:"#ffffff"}},gray:{"gray-100":"#F3F6F9","gray-200":"#EBEDF3","gray-300":"#E4E6EF","gray-400":"#D1D3E0","gray-500":"#B5B5C3","gray-600":"#7E8299","gray-700":"#5E6278","gray-800":"#3F4254","gray-900":"#181C32"}},"font-family":"Poppins"};
        </script>
        <script src="{{ asset('asset/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('asset/js/scripts.bundle.js') }}"></script>
        <script src="{{ asset('asset/js/pages/custom/login/login-general.js') }}"></script>
