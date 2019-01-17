<div class="form-group">
    <label for="">Nama Produk Buah</label>
    {!! Form::text('nama_produk', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required', 'placeholder' => 'Contoh : Apel Manis']) !!}
</div>

<div class="form-group">
    <label for="">Kategori Produk</label>
    {!! Form::select('id_kategori', $kategori, null, ['class' => 'form-control custom-select', 'required', 'placeholder' => '-- Pilih Kategori --']) !!}
</div>

<div class="form-group">
    <label for="">Deskripsi</label>
    {!! Form::textarea('deskripsi', null, ['class' => 'form-group editor']) !!}
</div>

<div class="form-group">
    <label for="">Harga Per Kilo</label>
    {!! Form::text('harga', null, ['class' => 'form-control money', 'autocomplete' => 'off', 'required', 'placeholder' => 'Contoh : 62,000']) !!}
</div>

<div class="form-group">
    <label for="">Foto Produk</label>
    {!! Form::file('foto', ['class' => 'dropify', 'data-height' => 500, 'accept' => 'image/*', 'data-default-file' => ((Request::segment(3) == 'ubah') ? (!empty($produk->foto_produk) ? asset($produk->url_foto.$produk->foto_produk) : '') : '')]) !!}
</div>

<div class="form-group">
    <a href="{{ route('dashboard.produk') }}" class="btn btn-default btn-sm">Kembali</a>
    <button type="submit" class="btn btn-primary btn-sm" id="simpan">Simpan</button>
</div>

@section('script')
    <script>
        $('#simpan').click(function(){
            var nama_produk = $("input[name='nama_produk']").val().trim();
            var kategori = $("select[name='id_kategori']").val().trim();
            var harga = $("input[name='harga']").val().trim();

            if(nama_produk == "")
            {
                alert_custom("Gagal !", "Nama produk tidak boleh kosong !", "error");
                return false;
            }

            if(kategori == "" ||kategori == "-- Pilih Kategori --")
            {
                alert_custom("Gagal !", "Silahkan pilih kategori produk !", "error");
                return false;
            }

            if(harga == "")
            {
                alert_custom("Gagal !", "Harga tidak boleh kosong !", "error");
                return false;
            }
        });
    </script>
@endsection