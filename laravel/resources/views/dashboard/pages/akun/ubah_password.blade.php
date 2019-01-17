@extends('dashboard.template')

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Ubah Password</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Beranda</a></li>
                <li class="active">Ubah Password</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="panel panel-default">
       <div class="panel-heading">Form Ubah Password</div> 

        <div class="panel-wrapper collapse in">
           <div class="panel-body">
                {!! Form::open(['method' => 'POST', 'route' => 'dashboard.ubah_password.simpan', 'class' => 'form-material']) !!}
                    @include('errors.msg')
                    <div class="form-group">
                        <label>Password Lama</label>
                        {!! Form::password('password', ['class' => 'form-control pass_lama', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan Password Lama']) !!}
                    </div>

                    <div class="form-group">
                        <label>Password Baru</label>
                        {!! Form::password('password_baru', ['class' => 'form-control password', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan Password Baru']) !!}
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        {!! Form::password('konfirmasi_password', ['class' => 'form-control konf_password', 'autocomplete' => 'off', 'required', 'placeholder' => 'Masukkan Konfirmasi Password Baru']) !!}
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm simpan">Simpan</button>
                    </div>
                {!! Form::close() !!}
           </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(".password").keyup(function(){
            var parent = $(this).parent();
            var pesan = parent.find(".help-block");
            var jmlVal = $(this).val().trim().length;
            
            if(jmlVal < 6)
            {
                parent.addClass("has-error");
                pesan.text("Password baru minimal 6 karakter !");
            }
            else
            {
                parent.removeClass("has-error");
                pesan.text(null);
            }
        });

        $(".konf_password").keyup(function(){
            var parent = $(this).parent();
            var pesan = parent.find(".help-block");
            var password = $(".password").val().trim();

            if($(this).val().trim() != password)
            {
                parent.addClass("has-error");
                pesan.text("Konfirmasi password tidak sesuai !");
            }
            else
            {
                parent.removeClass("has-error");
                pesan.text(null);
            }
        });

        $(".simpan").click(function() {
            var pass_lama = $(".pass_lama").val().trim();
            var password = $(".password").val().trim();
            var konf_password = $(".konf_password").val().trim();

            if(pass_lama == "" || pass_lama == null)
            {
                alert_custom("Gagal !", "Password lama tidak boleh kosong !", "error");
                return false;
            }

            if(password == "" || password == null)
            {
                alert_custom("Gagal !", "Password baru tidak boleh kosong !", "error");
                return false;
            }

            if(password.length < 6)
            {
                alert_custom("Gagal !", "Password baru minimal 6 karakter !", "error");
                return false;
            }

            if(konf_password !== password)
            {
                alert_custom("Gagal !", "Konfirmasi password tidak sesuai !", "error");
                return false;
            } 
        });
    </script>
@endsection