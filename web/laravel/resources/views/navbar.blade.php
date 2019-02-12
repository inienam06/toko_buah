<div class="uk-container uk-container-expand uk-background-default custom-nav">
    <nav class="uk-navbar">
        <div class="uk-navbar-left">
            <a href="../" class="uk-navbar-item uk-logo">
                <img uk-svg="" src="../images/uikit-logo.svg" class="uk-margin-small-right" hidden="true">
                <svg width="28" height="34" viewBox="0 0 28 34" xmlns="http://www.w3.org/2000/svg" class="uk-margin-small-right uk-svg" data-svg="../images/uikit-logo.svg">
	                <polygon fill="#fff" points="19.1,4.1 13.75,1 8.17,4.45 13.6,7.44 "></polygon>
	                <path fill="#fff" d="M21.67,5.43l-5.53,3.34l6.26,3.63v9.52l-8.44,4.76L5.6,21.93v-7.38L0,11.7v13.51l13.75,8.08L28,25.21V9.07 L21.67,5.43z"></path>
                </svg> Lestari Buah
            </a>
        </div> 
        
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav uk-visible@m">
                <li class="uk-active"><a href="{{ route('template') }}">Beranda</a></li> 
                <li>
                    <a href="javascript:void(0)">Kategori</a>
                    <div class="uk-navbar-dropdown" uk-dropdown="mode: click; animation: uk-animation-slide-bottom-small; duration: 500">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                        </ul>
                    </div>
                </li>
            </ul> 
            
            <div class="uk-navbar-item uk-visible@m">
                <a href="javascript:void(0)" class="uk-button uk-button-default tm-button-default uk-icon" uk-toggle="target: #masuk">Masuk</a>
            </div> 
            
            <a uk-navbar-toggle-icon="" href="#offcanvas-nav" uk-toggle="" class="uk-navbar-toggle uk-hidden@m uk-navbar-toggle-icon uk-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="navbar-toggle-icon">
                    <rect y="9" width="20" height="2"></rect>
                    <rect y="3" width="20" height="2"></rect>
                    <rect y="15" width="20" height="2"></rect>
                </svg>
            </a>
        </div>
    </nav>
</div>
    
<div id="offcanvas-nav" uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar">

        <ul class="uk-nav uk-nav-default">
            <li class="uk-active"><a href="#">Beranda</a></li>
            <li class="uk-parent">
                <a href="#">Parent</a>
                <ul class="uk-nav-sub">
                    <li><a href="#">Sub item</a></li>
                    <li><a href="#">Sub item</a></li>
                </ul>
            </li>

            <li class="uk-nav-divider"></li>
            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a></li>
            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a></li>
            <li class="uk-nav-divider"></li>
            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: trash"></span> Item</a></li>
        </ul>

    </div>
</div>

<div id="masuk" uk-offcanvas="esc-close: true; bg-close: false; overlay: true;">
    <div class="uk-offcanvas-bar uk-offcanvas-content">

        <button class="uk-offcanvas-close close-canvas" type="button" uk-close></button>

        <h3>Masuk</h3>

        {!! Form::open(['method' => 'POST', 'route' => 'masuk']) !!}
            <div class="uk-margin">
                <div class="uk-inline">
                    <a class="uk-form-icon" href="#" uk-icon="icon: mail"></a>
                    {!! Form::email('email', null, ['class' => 'uk-input', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan E-mail Anda']) !!}
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-inline">
                    <a class="uk-form-icon" href="#" uk-icon="icon: lock"></a>
                    {!! Form::password('password', ['class' => 'uk-input', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan Password Anda']) !!}
                </div>
                <a href="javascript:void(0)" class="uk-text-small" uk-toggle="target: #daftar">Belum Punya akun ? Daftar Sekarang</a>
            </div>

            <div class="uk-margin">
                <div class="uk-inline">
                    <button class="uk-button uk-button-primary" data-tipe="masuk" onclick="regisLogin(this)">MASUK</button>
                </div>
            </div>
        {!! Form::close() !!}

    </div>
</div>

<div id="daftar" uk-offcanvas="esc-close: true; bg-close: false; overlay: true;">
    <div class="uk-offcanvas-bar uk-offcanvas-content" id="daftar-form">

        <button class="uk-offcanvas-close close-canvas" type="button" uk-close></button>

        <h3>Daftar</h3>

        {!! Form::open(['method' => 'POST', 'route' => 'masuk']) !!}
            <div class="uk-margin">
                <div class="uk-inline">
                    <a class="uk-form-icon" href="#" uk-icon="icon: user"></a>
                    {!! Form::text('nama', null, ['class' => 'uk-input', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan Nama Anda']) !!}
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-inline">
                    <a class="uk-form-icon" href="#" uk-icon="icon: mail"></a>
                    {!! Form::email('email', null, ['class' => 'uk-input', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan E-mail Anda']) !!}
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-inline">
                    <a class="uk-form-icon" href="#" uk-icon="icon: receiver"></a>
                    {!! Form::text('no_handphone', null, ['class' => 'uk-input is_nohp', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan No Handphone Anda']) !!}
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-inline">
                    <a class="uk-form-icon" href="#" uk-icon="icon: lock"></a>
                    {!! Form::password('password', ['class' => 'uk-input', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan Password Anda']) !!}
                </div>
                <a href="javascript:void(0)" class="uk-text-small" uk-toggle="target: #masuk">Sudah Punya akun ? Masuk Sekarang</a>
            </div>

            <div class="uk-margin">
                <div class="uk-inline">
                    <button class="uk-button uk-button-primary" data-tipe="daftar" onclick="regisLogin(this)">DAFTAR</button>
                </div>
            </div>
        {!! Form::close() !!}

    </div>
</div>