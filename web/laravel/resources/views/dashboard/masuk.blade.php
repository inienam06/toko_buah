<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/admin-favicon.png') }}">
<title>Ample Admin Template - The Ultimate Multipurpose admin template</title>
<!-- Bootstrap Core CSS -->
<link href="{{ asset('assets/libraries/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- animation CSS -->
<link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
<!-- Custom CSS -->
<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
<!-- color CSS -->
<link href="{{ asset('assets/css/colors/purple-dark.css') }}" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box login-sidebar">
    <div class="white-box">
      {!! Form::open(['method' => 'POST', 'class' => 'form-horizontal form-material', 'id' => 'loginform', 'route' => 'dashboard.masuk.auth']) !!}
        <a href="javascript:void(0)" class="text-center db"><img src="{{ asset('assets/images/admin-logo-dark.png') }}" alt="Home" /><br/><img src="{{ asset('assets/images/admin-text-dark.png') }}" alt="Home" /></a>

        @include('errors.msg')
        
        <div class="form-group m-t-40">
          <div class="col-xs-12">
            {!! Form::email('email', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required', 'placeholder' => 'E-mail']) !!}
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            {!! Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off', 'required', 'placeholder' => 'Password']) !!}
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Lupa Password ?</a> </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
            <div class="social"><a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip"  title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a> <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip"  title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a> </div>
          </div>
        </div>
        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Belum punya akun ? <a href="register2.html" class="text-primary m-l-5"><b>Daftar</b></a></p>
          </div>
        </div>
      </form>
      <form class="form-horizontal" id="recoverform" action="index.html">
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>Recover Password</h3>
            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" placeholder="Email">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="{{ asset('assets/libraries/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('assets/libraries/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{ asset('assets/libraries/sidebar-nav/sidebar-nav.min.js') }}"></script>

<!--slimscroll JavaScript -->
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('assets/js/waves.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<!--Style Switcher -->
<script src="{{ asset('assets/libraries/jquery/jQuery.style.switcher.js') }}"></script>

<script type="text/javascript">
  $('.cust-alert').delay(3000).slideUp(500);
</script>
</body>
</html>
