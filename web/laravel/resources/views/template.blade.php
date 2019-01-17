<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
      <nav class="navbar navbar-default navbar-fixed-top no-border">
          <div class="container-fluid">
            {{-- Brand and toggle get grouped for better mobile display --}}
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
        
            {{-- Collect the nav links, forms, and other content for toggling --}}
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="{{ route('template') }}">Beranda</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kategori <span class="caret"></span></a>
                    <ul class="dropdown-menu no-border dropdown-kategori">
                    </ul>
                  </li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                @if (!empty(Session::get('is_loginUser')) || Session::get('is_loginUser') == 1)
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Session::get('nama_user') }} <span class="caret"></span></a>
                    <ul class="dropdown-menu no-border">
                      <li><a href="#">Profil</a></li>
                      <li><a href="#">Ubah Password</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="{{ route('pesanan') }}">Pesanan</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="{{ route('keluar') }}">Keluar</a></li>
                    </ul>
                  </li>
                @else
                  <li><a href="javascript:void(0)" data-toggle="modal" data-target="#masuk-daftar">Masuk / Daftar</a></li>
                @endif
              </ul>
            </div>{{-- /.navbar-collapse --}}
          </div>{{-- /.container-fluid --}}
      </nav>

      <div class="container body">
          @yield('content')
      </div>

      <div class="modal fade" id="masuk-daftar" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content no-border">
            <div class="modal-header">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#masuk-form" class="no-border" aria-controls="masuk-form" role="tab" data-toggle="tab">MASUK</a></li>
                  <li role="presentation"><a href="#daftar-form" class="no-border" aria-controls="daftar-form" role="tab" data-toggle="tab">DAFTAR</a></li>
              </ul>
            </div>
            <div class="modal-body">
              <!-- Tab panes -->
              <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="masuk-form">
                    {!! Form::open(['method' => 'POST', 'route' => 'masuk']) !!}
                      <div class="form-group">
                        {!! Form::email('email', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan E-mail Anda']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan Password Anda']) !!}
                      </div>

                      <div class="form-group row">
                        <div class="col-md-4">
                          <button class="btn btn-custom-default is-transition no-border" id="masuk">MASUK</button>
                        </div>

                        <div class="col-md-4 pull-right">
                            <button class="btn btn-default is-transition no-border" id="batal" data-dismiss="modal">Batal</button>
                          </div>
                      </div>
                    {!! FOrm::close() !!}
                  </div>

                  <div role="tabpanel" class="tab-pane" id="daftar-form">
                    <div class="form-group">
                      {!! Form::text('nama', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan Nama Anda']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::email('email', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan E-mail Anda']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::text('no_handphone', null, ['class' => 'form-control is_nohp', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan No Handphone Anda']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan Password Anda']) !!}
                    </div>

                    <div class="form-group row">
                      <div class="col-md-4">
                        <button class="btn btn-custom-default is-transition no-border" id="daftar">Daftar</button>
                      </div>

                      <div class="col-md-4 pull-right">
                          <button class="btn btn-default is-transition no-border" id="batal" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </div>
    
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
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/_function_frontEnd.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.number.min.js') }}"></script>
    <script src="https://www.gstatic.com/firebasejs/5.2.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.2.0/firebase-messaging.js"></script>
    <script src="{{ asset('assets/js/firebase/init.js') }}"></script>
    @yield('script')
</body>
</html>