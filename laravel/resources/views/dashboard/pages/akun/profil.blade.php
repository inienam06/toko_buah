@extends('dashboard.template')

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Akun Saya</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Beranda</a></li>
                <li class="active">Akun Saya</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="white-box">
                <div class="user-bg"> <img width="100%" alt="user" src="{{ asset('assets/images/admin-profil-bg.jpg') }}">
                    <div class="overlay-box">
                        <div class="user-content">
                            <a href="javascript:void(0)"><img src="{{ asset('assets/images/admin-foto.jpg') }}" class="thumb-lg img-circle" alt="img"></a>
                            <h4 class="text-white">{{ $profil->nama_lengkap }}</h4>
                            <h5 class="text-white">{{ $profil->email }}</h5> </div>
                    </div>
                </div>
                <div class="user-btm-box">
                    <div class="col-md-4 col-sm-4 text-center">
                        <p class="text-purple"><i class="ti-facebook"></i></p>
                        <h1>258</h1> </div>
                    <div class="col-md-4 col-sm-4 text-center">
                        <p class="text-blue"><i class="ti-twitter"></i></p>
                        <h1>125</h1> </div>
                    <div class="col-md-4 col-sm-4 text-center">
                        <p class="text-danger"><i class="ti-dribbble"></i></p>
                        <h1>556</h1> </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="white-box">
                <ul class="nav nav-tabs tabs customtab">
                    <li class="tab active">
                        <a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Akun Saya</span> </a>
                    </li>
                    <li class="tab">
                        <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Ubah Data</span> </a>
                    </li>
                </ul>
                <div class="tab-content">
                    @include('errors.msg')
                    <div class="tab-pane active" id="profile">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Nama Lengkap</strong>
                                <br>
                                <p class="text-muted">{{ $profil->nama_lengkap }}</p>
                            </div>
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Tempat Lahir</strong>
                                <br>
                                <p class="text-muted">{{ $profil->tempat_lahir }}</p>
                            </div>
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Tanggal Lahir</strong>
                                <br>
                                <p class="text-muted">{{ $profil->tanggal_lahir }}</p>
                            </div>
                            <div class="col-md-3 col-xs-6"> <strong>Email</strong>
                                <br>
                                <p class="text-muted">{{ $profil->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <p class="m-t-30">
                            <b>Alamat :</b><br>
                            {{ $profil->alamat }}
                        </p>
                    </div>

                    <div class="tab-pane" id="settings">
                        {!! Form::model($profil, ['method' => 'POST', 'route' => 'dashboard.profil.simpan', 'class' => 'form-material']) !!}
                            <div class="form-group">
                                <label>E-mail</label>
                                {!! Form::email('email', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required', 'placeholder' => 'Nama Lengkap', 'disabled']) !!}
                            </div>

                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                {!! Form::text('nama_lengkap', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required', 'placeholder' => 'Nama Lengkap']) !!}
                            </div>

                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                {!! Form::text('tempat_lahir', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Tempat Lahir']) !!}
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                {!! Form::text('tanggal_lahir', null, ['class' => 'form-control tanggal', 'autocomplete' => 'off', 'placeholder' => 'Tanggal Lahir']) !!}
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control custom-select" name="jenis_kelamin">
                                    <option value="" {{ ($profil->jenis_kelamin == null || $profil->jenis_kelamin == '') ? 'selected' : '' }}>-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-Laki" {{ ($profil->jenis_kelamin == 'Laki-Laki') ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ ($profil->jenis_kelamin == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                {!! Form::textarea('alamat', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Alamat', 'rows' => 3]) !!}
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            </div>       
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection