<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/admin-favicon.png') }}">
    <title>Dashboard</title>
    {{-- Bootstrap Core CSS --}}
    <link href="{{ asset('assets/libraries/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libraries/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libraries/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libraries/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">
    {{-- Custom Select CSS --}}
    <link href="{{ asset('assets/libraries/custom-select/custom-select.css') }}" rel="stylesheet">
    {{-- Menu CSS --}}
    <link href="{{ asset('assets/libraries/sidebar-nav/sidebar-nav.min.css') }}" rel="stylesheet">
    {{-- WYSIHTML5 CSS --}}
    <link href="{{ asset('assets/libraries/html5-editor/bootstrap-wysihtml5.css') }}" rel="stylesheet">
    {{-- animation CSS --}}
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    {{-- Sweet Alert CSS --}}
    <link href="{{ asset('assets/libraries/sweetalert/sweetalert.css') }}" rel="stylesheet">
    {{-- Dropify CSS --}}
    <link href="{{ asset('assets/libraries/dropify/css/dropify.min.css') }}" rel="stylesheet">
    {{-- Custom CSS --}}
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/map.css') }}" rel="stylesheet">
    {{-- color CSS --}}
    <link href="{{ asset('assets/css/colors/purple-dark.css') }}" id="theme" rel="stylesheet">
</head>

<body class="fix-header">
    {{-- ============================================================== --}}
    {{-- Preloader --}}
    {{-- ============================================================== --}}
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    {{-- ============================================================== --}}
    {{-- Wrapper --}}
    {{-- ============================================================== --}}
    <div id="wrapper">
        {{-- ============================================================== --}}
        {{-- Topbar header - style you can find in pages.scss --}}
        {{-- ============================================================== --}}
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    {{-- Logo --}}
                    <a class="logo" href="{{ route('dashboard') }}">
                        {{-- Logo icon image, you can use font-icon also --}}<b>
                        {{--This is dark logo icon--}}<img src="{{ asset('assets/images/admin-logo.png') }}" alt="home" class="dark-logo" />{{--This is light logo icon--}}<img src="{{ asset('assets/images/admin-logo-dark.png') }}" alt="home" class="light-logo" />
                     </b>
                        {{-- Logo text image you can use text also --}}<span class="hidden-xs">
                        {{--This is dark logo text--}}<img src="{{ asset('assets/images/admin-text.png') }}" alt="home" class="dark-logo" />{{--This is light logo text--}}<img src="{{ asset('assets/images/admin-text-dark.png') }}" alt="home" class="light-logo" />
                     </span> </a>
                </div>
                {{-- /Logo --}}
                {{-- Search input and Toggle icon --}}
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="{{ asset('assets/images/admin-foto.jpg') }}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{ session()->get('nama_admin') }}</b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="{{ asset('assets/images/admin-foto.jpg') }}" alt="user" /></div>
                                    <div class="u-text">
                                        <h4>{{ session()->get('nama_admin') }}</h4>
                                        <p class="text-muted">{{ session()->get('email_admin') }}</p><a href="{{ route('dashboard.profil') }}" class="btn btn-rounded btn-danger btn-sm">Lihat Akun Saya</a></div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('dashboard.profil') }}"><i class="ti-user"></i> Akun Saya</a></li>
                            <li><a href="{{ route('dashboard.ubah_password') }}"><i class="ti-lock"></i> Ubah Password</a></li>
                            <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('dashboard.keluar') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                        {{-- /.dropdown-user --}}
                    </li>
                    {{-- /.dropdown --}}
                </ul>
            </div>
            {{-- /.navbar-header --}}
            {{-- /.navbar-top-links --}}
            {{-- /.navbar-static-side --}}
        </nav>
        {{-- End Top Navigation --}}
        {{-- ============================================================== --}}
        {{-- Left Sidebar - style you can find in sidebar.scss  --}}
        {{-- ============================================================== --}}
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <div class="user-profile">
                    <div class="dropdown user-pro-body">
                        <div><img src="{{ asset('assets/images/admin-foto.jpg') }}" alt="user-img" class="img-circle"></div>
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ session()->get('nama_admin') }} <span class="caret"></span></a>
                        <ul class="dropdown-menu animated flipInY">
                            <li><a href="{{ route('dashboard.profil') }}"><i class="ti-user"></i> Akun Saya</a></li>
                            <li><a href="{{ route('dashboard.ubah_password') }}"><i class="ti-lock"></i> Ubah Password</a></li>
                            <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('dashboard.keluar') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="nav" id="side-menu">
                    @include('dashboard.menu')
                </ul>
            </div>
        </div>
        {{-- ============================================================== --}}
        {{-- End Left Sidebar --}}
        {{-- ============================================================== --}}
        {{-- ============================================================== --}}
        {{-- Page Content --}}
        {{-- ============================================================== --}}
        <div id="page-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
            {{-- /.container-fluid --}}
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
        </div>
        {{-- ============================================================== --}}
        {{-- End Page Content --}}
        {{-- ============================================================== --}}
    </div>
    {{-- wrapper --}}
    {{-- jQuery --}}
    <script src="{{ asset('assets/libraries/jquery/jquery.min.js') }}"></script>
    {{-- Bootstrap Core JavaScript --}}
    <script src="{{ asset('assets/libraries/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/libraries/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libraries/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libraries/datatables/jquery.dataTables.min.js') }}"></script>
    {{-- Custom Select JavaScript --}}
    <script src="{{ asset('assets/libraries/custom-select/custom-select.min.js') }}"></script>
    {{-- Menu Plugin JavaScript --}}
    <script src="{{ asset('assets/libraries/sidebar-nav/sidebar-nav.min.js') }}"></script>
    {{-- slimscroll JavaScript --}}
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    {{-- Wave Effects JavaScript --}}
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    {{-- Style Switcher JavaScript --}}
    <script src="{{ asset('assets/libraries/jquery/jQuery.style.switcher.js') }}"></script>
    {{-- Moment JS JavaScript --}}
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    {{-- Sweet Alert JavaScript --}}
    <script src="{{ asset('assets/libraries/sweetalert/sweetalert.min.js') }}"></script>
    {{-- TinyMce JavaScript --}}
    <script src="{{ asset('assets/libraries/tinymce/tinymce.min.js') }}"></script>
    {{-- Dropify JavaScript --}}
    <script src="{{ asset('assets/libraries/dropify/js/dropify.min.js') }}"></script>
    {{-- Custom Theme JavaScript --}}
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.number.min.js') }}" data-tipe="last"></script>
    @yield('script')
</body>

</html>
