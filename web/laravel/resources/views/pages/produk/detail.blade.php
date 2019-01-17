@extends('template')

@section('content')
<div class="panel no-border detail-produk with-shadow">
    <div class="panel-heading">
        Detail Produk
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-5">
                <div class="thumbnail no-border">
                    <img src="{{ asset((!empty($produk->url_foto) && !empty($produk->foto_produk)) ? $produk->url_foto.$produk->foto_produk : 'assets/images/buah/no-image.jpg') }}" class="img-responsive">
                </div>
            </div>

            <div class="col-md-7">
                <div class="pull-right">
                    <h3 class="judul">{{ $produk->nama_produk }}</h3>
                    <p class="harga">Rp. {{ number_format($produk->harga, 2) }}</p>
                    <div class="dilihat pull-right text-center">
                        <i class="fa fa-eye"></i>
                        <p>Dilihat</p>
                        <p>{{ $produk->dilihat }}</p>
                    </div>

                    <div class="clearfix"></div>

                    <div class="action pull-right">
                        <div class="align-right">
                            <a href="javascript:void(0)" class="kurang" data-tipe="kurang" onclick="action(this)">-</a>
                            {!! Form::text('jumlah', 0, ['class' => 'jumlah', 'autocomplete' => 'off', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57']) !!}
                            <a href="javascript:void(0)" class="tambah" data-tipe="tambah" onclick="action(this)">+</a>
                        </div>

                        <div class="clearfix"></div>
                        <p class="perkiraan-harga pull-right">* perkiraan harga per kilo : <b class="jumlah_perkiraan">Rp. 0</b></p>
                        <span id="total_harga" class="hide">0</span>

                        <div class="clearfix"></div>
                        <button class="btn btn-custom-default no-border is-transition" id="pesan">Pesan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel no-border with-shadow">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#deskripsi" class="no-border" aria-controls="deskripsi" role="tab" data-toggle="tab">Deskripsi</a></li>
    </ul>
    
    <div class="panel-body">
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="deskripsi">
                {!! $produk->deskripsi !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function action(obj)
        {
            var obj = $(obj);
            var tipe = obj.attr('class');
            var txtJumlah = $('input[name="jumlah"]');
            var txtPerkiraan = $('b.jumlah_perkiraan');
            var jumlah = txtJumlah.val();
            var perkiraan = parseInt('{{ $produk->harga }}');
            var total_harga = $('#total_harga');

            var hasil = 0;
            var hasil_perkiraan = 0;

            if(tipe == 'kurang')
            {
                if(jumlah > 0)
                {
                    hasil = parseInt(jumlah) - 1;
                }
            }
            else
            {
                hasil = parseInt(jumlah) + 1;
            }

            hasil_perkiraan = parseInt(hasil * perkiraan);

            txtJumlah.val(hasil);
            txtPerkiraan.text(hasil_perkiraan);

            total_harga.text(hasil_perkiraan);

            if(hasil > 0)
            {
                refresh_money(txtPerkiraan);
                txtPerkiraan.text('Rp. '+txtPerkiraan.text());
            }
            else
            {
                txtPerkiraan.text('Rp. '+txtPerkiraan.text());
            }
        }

        $('#pesan').click(function(){
            var isLogin = '{{ Session::get("is_loginUser") }}';
            var data = {
                'id_user': '{{ Session::get("id_user") }}',
                'id_produk': '{{ $produk->id_produk }}',
                'kilo': $('input[name="jumlah"]').val(),
                'total_harga': $('span#total_harga').text(),
                'nama': '{{ Session::get("nama_user") }}'
            };
            
            pesan(isLogin, data, '{{ getUserApiToken(session()->get("id_user")) }}');
        });
    </script>
@endsection