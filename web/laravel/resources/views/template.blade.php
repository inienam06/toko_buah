<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- UIKIT --}}
    <link href="{{ asset('assets/libraries/uikit/css/uikit.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libraries/uikit/less/uikit.theme.less') }}" rel="stylesheet/less" type="text/css">
    {{-- Bootstrap CORE --}}
    <link href="{{ asset('assets/libraries/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libraries/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libraries/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libraries/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">
    {{-- Font Awesome CSS --}}
    <link href="{{ asset('assets/libraries/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
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
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/manifest.json') }}" rel="manifest">
</head>
<body>

  <div id="preloader">
    <div id="loader"></div>
    <p id="titleLoad">Mohon Tunggu ...</p>
  </div>

  <div class="wrapper">
      @include('navbar')

      <div class="container body">
          @yield('content')
      </div>
    </div>
    
    {{-- jQuery --}}
    <script src="{{ asset('assets/libraries/jquery/jquery.min.js') }}"></script>
    {{-- UIKIT --}}
    <script src="{{ asset('assets/libraries/uikit/js/uikit.min.js') }}"></script>
    <script src="{{ asset('assets/libraries/uikit/js/uikit-icons.min.js') }}"></script>
    {{-- Bootstrap Core JavaScript --}}
    <script src="{{ asset('assets/libraries/bootstrap/js/bootstrap.min.js') }}"></script>
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
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/_function_frontEnd.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.number.min.js') }}"></script>
    <script src="https://www.gstatic.com/firebasejs/5.2.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.2.0/firebase-messaging.js"></script>
    <script src="{{ asset('assets/js/firebase/init.js') }}"></script>
    @yield('script')
</body>
</html>