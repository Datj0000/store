<!DOCTYPE html>
<html lang=en>

<head>
    <base href>
    <meta charset=utf-8 />
    <title>FunnyDev Store</title>
    <meta name=viewport content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name=csrf-token content="{{ csrf_token() }}">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <link rel=stylesheet href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('asset/css/themes/layout/header/base/light.css') }}" rel=stylesheet type=text/css />
    <link href="{{ asset('asset/css/themes/layout/header/menu/light.css') }}" rel=stylesheet type=text/css />
    <link href="{{ asset('asset/css/themes/layout/brand/dark.css') }}" rel=stylesheet type=text/css />
    <link href="{{ asset('asset/css/themes/layout/aside/dark.css') }}" rel=stylesheet type=text/css />
    <link href="{{ asset('asset/plugins/global/plugins.bundle.css') }}" rel=stylesheet type=text/css />
    <link href="{{ asset('asset/css/style.bundle.css') }}" rel=stylesheet type=text/css />
    <link href="{{ asset('asset/plugins/custom/datatables/datatables.bundle.css') }}" rel=stylesheet type=text/css />
    <link rel="shortcut icon" href="{{ url('asset/media/logos/favicon.ico') }}" />
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <style>
        select{
            padding: 7px 0;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }
    </style>
</head>

<body id=kt_body
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <div id=kt_header_mobile class="header-mobile align-items-center header-mobile-fixed">
        <a href="{{ URL::to('/dashboard') }}" class=header__logo>
            <img style=max-height:40px alt=Logo
                 src="{{ asset('asset/media/logos/logo.png') }}" />
        </a>
        <div class="d-flex align-items-center">
            <button class="btn p-0 burger-icon burger-icon-left" id=kt_aside_mobile_toggle>
                <span></span>
            </button>
            <button class="btn btn-hover-text-primary p-0 ml-2" id=kt_header_mobile_topbar_toggle>
                <span class="svg-icon svg-icon-xl">
                    <svg xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink width=24px
                         height=24px viewBox="0 0 24 24" version=1.1>
                        <g stroke=none stroke-width=1 fill=none fill-rule=evenodd>
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill=#000000 fill-rule=nonzero opacity=0.3 />
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill=#000000 fill-rule=nonzero />
                        </g>
                    </svg>
                </span>
            </button>
        </div>
    </div>
    <div class="d-flex flex-column flex-root" style="user-select: none">
        <div class="d-flex flex-row flex-column-fluid page">
            <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id=kt_aside>
                <div class="brand flex-column-auto" id=kt_brand>
                    <a href="{{ URL::to('/dashboard') }}" class=brand-logo>
                        <img style=max-height:40px alt=Logo
                             src="{{ asset('asset/media/logos/logo.png') }}" />
                    </a>
                    <button class="brand-toggle btn btn-sm px-0" id=kt_aside_toggle>
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <svg xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink width=24px
                                height=24px viewBox="0 0 24 24" version=1.1>
                                <g stroke=none stroke-width=1 fill=none fill-rule=evenodd>
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                        fill=#000000 fill-rule=nonzero
                                        transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                                    <path
                                        d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                        fill=#000000 fill-rule=nonzero opacity=0.3
                                        transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                                </g>
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="aside-menu-wrapper flex-column-fluid" id=kt_aside_menu_wrapper>
                    <div id=kt_aside_menu class="aside-menu my-4" data-menu-vertical=1 data-menu-scroll=1
                        data-menu-dropdown-timeout=500>
                        <ul class=menu-nav>
                            <li class=" menu-item" aria-haspopup=true>
                                <a class=menu-link>
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
													<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
											</g>
                                        </svg>
                                    </span>
                                    <span class=menu-text>Tổng quan</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup=true>
                                <a href="{{url('/order')}}" class=menu-link>
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                            </g>
                                        </svg>
                                    </span>
                                    <span class=menu-text>Đơn hàng</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000"/>
                                                    <path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3"/>
                                                </g>
											</svg>
										</span>
                                    <span class="menu-text">Sản phẩm</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-parent" aria-haspopup="true">
												<span class="menu-link">
													<span class="menu-text">Sản phẩm</span>
												</span>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('/supplier')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Nhà cung cấp</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('/category')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Danh mục</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('/brand')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Thương hiệu</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('/unit')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Đơn vị</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('/product')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Sản phẩm</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('/import')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Nhập hàng</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item" aria-haspopup=true>
                                <a href="{{url('/customer')}}" class=menu-link>
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"/>
                                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                            </g>
                                        </svg>
                                    </span>
                                    <span class=menu-text>Khách hàng</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup=true>
                                <a href="{{url('/coupon')}}" class=menu-link>
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1">
                                             <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M3,10.0500091 L3,8 C3,7.44771525 3.44771525,7 4,7 L9,7 L9,9 C9,9.55228475 9.44771525,10 10,10 C10.5522847,10 11,9.55228475 11,9 L11,7 L21,7 C21.5522847,7 22,7.44771525 22,8 L22,10.0500091 C20.8588798,10.2816442 20,11.290521 20,12.5 C20,13.709479 20.8588798,14.7183558 22,14.9499909 L22,17 C22,17.5522847 21.5522847,18 21,18 L11,18 L11,16 C11,15.4477153 10.5522847,15 10,15 C9.44771525,15 9,15.4477153 9,16 L9,18 L4,18 C3.44771525,18 3,17.5522847 3,17 L3,14.9499909 C4.14112016,14.7183558 5,13.709479 5,12.5 C5,11.290521 4.14112016,10.2816442 3,10.0500091 Z M10,11 C9.44771525,11 9,11.4477153 9,12 L9,13 C9,13.5522847 9.44771525,14 10,14 C10.5522847,14 11,13.5522847 11,13 L11,12 C11,11.4477153 10.5522847,11 10,11 Z" fill="#000000" opacity="0.3" transform="translate(12.500000, 12.500000) rotate(-45.000000) translate(-12.500000, -12.500000) "/>
                                            </g>
                                        </svg>
                                    </span>
                                    <span class=menu-text>Mã giảm giá</span>
                                </a>
                            </li>
                            <li class=" menu-item" aria-haspopup=true>
                                <a href="{{url('/insurance')}}" class=menu-link>
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"/>
                                                <polygon fill="#000000" opacity="0.3" points="11.3333333 18 16 11.4 13.6666667 11.4 13.6666667 7 9 13.6 11.3333333 13.6"/>
                                            </g>
                                        </svg>
                                    </span>
                                    <span class=menu-text>Bảo hành</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5"/>
                                                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5"/>
                                                    <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
                                                    <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"/>
                                                </g>
											</svg>
										</span>
                                    <span class="menu-text">Báo cáo</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-parent" aria-haspopup="true">
												<span class="menu-link">
													<span class="menu-text">Sản phẩm</span>
												</span>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a id=# class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Báo cáo bán hàng</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a id=# class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Báo cáo nhập hàng</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a id=# class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Báo cáo kho</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a id=# class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Báo cáo tài chính</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a id=# class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Báo cáo khách hàng</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a id=# class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Báo cáo nhà cung cấp</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?php
                            if(Auth::user()->role == 0){
                            ?>
                            <li class=menu-section>
                                <h4 class=menu-text>Quản lý</h4>
                                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                            </li>
                            <li class=" menu-item" aria-haspopup=true>
                                <a href="{{url('/user')}}" class=menu-link>
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"/>
                                                <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg>
                                    </span>
                                    <span class=menu-text>Nhân viên</span>
                                </a>
                            </li>
                            <li class=" menu-item" aria-haspopup=true>
                                <a class=menu-link>
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                    </span>
                                    <span class=menu-text>Cài đặt</span>
                                </a>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-row-fluid wrapper" id=kt_wrapper>
                <div id=kt_header class="header header-fixed">
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <div class="header-menu-wrapper header-menu-wrapper-left" id=kt_header_menu_wrapper>
                        </div>
                        <div class=topbar>
                            <div class=topbar-item>
                                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                                    id=kt_quick_user_toggle>
                                    <span
                                        class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Xin chào,</span>
                                    <span
                                        class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">
                                        {{Auth::user()->name}}
                                    </span>
                                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                        @php
                                        $image = Auth::user()->image;
                                        if ($image) {
                                        echo '<span class="symbol-label font-size-h5 font-weight-bold"
                                            style="background-image:url(uploads/avatar/' . $image . ')"></span>';
                                        } else {
                                        echo '<span class="symbol-label font-size-h5 font-weight-bold"
                                            style=background-image:url(asset/media/users/blank.png)></span>';
                                        }
                                        @endphp
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content d-flex flex-column flex-column-fluid" id=kt_content>
                    <div class="d-flex flex-column-fluid">
                        <div class=container id=container>
                            @yield('content')
                        </div>
                    </div>
                </div>
                <div class="footer bg-white py-4 d-flex flex-lg-column" id=kt_footer>
                    <div
                        class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted font-weight-bold mr-2">{{ date('Y') }} © </span>
                            <a href=# class="text-dark-75 text-hover-primary">Funny Dev Digital Solution Join-stock Company</a>
                        </div>
                        <div class="nav nav-dark"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id=kt_quick_user class="offcanvas offcanvas-right p-10">
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
            <h3 class="font-weight-bold m-0">Thông tin tài khoản
            </h3>
            <a href=# class="btn btn-xs btn-icon btn-light btn-hover-primary" id=kt_quick_user_close>
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
        <div class="offcanvas-content pr-5 mr-n5">
            <div class="d-flex align-items-center mt-5">
                <div class="symbol symbol-100 mr-5">
                    @php
                    if ($image) {
                    echo '<span class="symbol-label font-size-h5 font-weight-bold"
                        style="background-image:url(uploads/avatar/' . $image . ')"></span>';
                    } else {
                    echo '<span class="symbol-label font-size-h5 font-weight-bold"
                        style=background-image:url(asset/media/users/blank.png)></span>';
                    }
                    @endphp
                    <i class="symbol-badge bg-success"></i>
                </div>
                <div class="d-flex flex-column">
                    <span class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                        {{Auth::user()->name}}
                    </span>
                    <div class="text-muted mt-1">
                        @php
                            $role = Auth::user()->role;
                            if ($role == 3){
                                echo 'Cộng tác viên';
                            } else if ($role == 2){
                                echo 'Nhân viên';
                            } else if ($role == 1){
                                echo 'Thủ kho';
                            } else{
                                echo 'Quản lý';
                            }
                        @endphp
                    </div>
                    <div class="navi mt-2">
                        <span class=navi-item>
                            <span class="navi-link p-0 pb-2">
                                <span class="navi-icon mr-1">
                                    <span class="svg-icon svg-icon-lg svg-icon-primary">
                                        <svg xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink
                                            width=24px height=24px viewBox="0 0 24 24" version=1.1>
                                            <g stroke=none stroke-width=1 fill=none fill-rule=evenodd>
                                                <rect x=0 y=0 width=24 height=24 />
                                                <path
                                                    d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                    fill=#000000 />
                                                <circle fill=#000000 opacity=0.3 cx=19.5 cy=17.5 r=2.5 />
                                            </g>
                                        </svg>
                                    </span>
                                </span>
                                <span class="navi-text text-muted text-hover-primary">
                                    @php
                                    $email = Auth::user()->email;
                                    if ($email) {
                                    echo $email;
                                    }
                                    @endphp
                                </span>
                            </span>
                        </span>
                        <a href="{{ URL::to('/logout') }}"
                            class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Đăng xuất</a>
                    </div>
                </div>
            </div>
            <div class="separator separator-dashed mt-8 mb-5"></div>
            <div class="navi navi-spacer-x-0 p-0">
                <a href=# class=navi-item id=profile>
                    <div class=navi-link>
                        <div class="symbol symbol-40 bg-light mr-3">
                            <div class=symbol-label>
                                <span class="svg-icon svg-icon-md svg-icon-success">
                                    <svg xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink
                                        width=24px height=24px viewBox="0 0 24 24" version=1.1>
                                        <g stroke=none stroke-width=1 fill=none fill-rule=evenodd>
                                            <rect x=0 y=0 width=24 height=24 />
                                            <path
                                                d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"
                                                fill=#000000 />
                                            <circle fill=#000000 opacity=0.3 cx=18.5 cy=5.5 r=2.5 />
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class=navi-text>
                            <div class=font-weight-bold>Hồ sơ</div>
                            <div class=text-muted>Chỉnh sửa hồ sơ của bạn</div>
                        </div>
                    </div>
                </a>
                <a href=# class=navi-item id=change_pass>
                    <div class=navi-link>
                        <div class="symbol symbol-40 bg-light mr-3">
                            <div class=symbol-label>
                                <span class="svg-icon svg-icon-md svg-icon-warning">
                                    <svg xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink
                                        width=24px height=24px viewBox="0 0 24 24" version=1.1>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M14.1654881,7.35483745 L9.61055177,10.3622525 C9.47921741,10.4489666 9.39637436,10.592455 9.38694497,10.7495509 L9.05991526,16.197949 C9.04337012,16.4735952 9.25341309,16.7104632 9.52905936,16.7270083 C9.63705011,16.7334903 9.74423017,16.7047714 9.83451193,16.6451626 L14.3894482,13.6377475 C14.5207826,13.5510334 14.6036256,13.407545 14.613055,13.2504491 L14.9400847,7.80205104 C14.9566299,7.52640477 14.7465869,7.28953682 14.4709406,7.27299168 C14.3629499,7.26650974 14.2557698,7.29522855 14.1654881,7.35483745 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class=navi-text>
                            <div class=font-weight-bold>Mật khẩu</div>
                            <div class=text-muted>Thay đổi mật khẩu của bạn</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div id=kt_scrolltop class=scrolltop>
        <span class=svg-icon>
            <svg xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink width=24px height=24px
                viewBox="0 0 24 24" version=1.1>
                <g stroke=none stroke-width=1 fill=none fill-rule=evenodd>
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <rect fill=#000000 opacity=0.3 x=11 y=10 width=2 height=10 rx=1 />
                    <path
                        d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                        fill=#000000 fill-rule=nonzero />
                </g>
            </svg>
        </span>
    </div>
    <script>
        var KTAppSettings={breakpoints:{sm:576,md:768,lg:992,xl:1200,xxl:1400},colors:{theme:{base:{white:"#ffffff",primary:"#3699FF",secondary:"#E5EAEE",success:"#1BC5BD",info:"#8950FC",warning:"#FFA800",danger:"#F64E60",light:"#E4E6EF",dark:"#181C32"},light:{white:"#ffffff",primary:"#E1F0FF",secondary:"#EBEDF3",success:"#C9F7F5",info:"#EEE5FF",warning:"#FFF4DE",danger:"#FFE2E5",light:"#F3F6F9",dark:"#D6D6E0"},inverse:{white:"#ffffff",primary:"#ffffff",secondary:"#3F4254",success:"#ffffff",info:"#ffffff",warning:"#ffffff",danger:"#ffffff",light:"#464E5F",dark:"#ffffff"}},gray:{"gray-100":"#F3F6F9","gray-200":"#EBEDF3","gray-300":"#E4E6EF","gray-400":"#D1D3E0","gray-500":"#B5B5C3","gray-600":"#7E8299","gray-700":"#5E6278","gray-800":"#3F4254","gray-900":"#181C32"}},"font-family":"Poppins"};
    </script>
    <script src="{{ asset('asset/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('asset/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('asset/plugins/custom/datatables/datatables.bundle.js') }}"></script>
{{--    <script src=//cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js></script>--}}
{{--    <script src="{{ asset('asset/js/script.js') }}"></script> --}}
{{--    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>--}}
{{--    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>--}}
</body>

</html>
