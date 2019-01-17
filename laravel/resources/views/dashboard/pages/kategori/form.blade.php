<div class="form-group">
    <label for="">Nama Kategori</label>
    {!! Form::text('nama_kategori', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required', 'placeholder' => 'Contoh : Apel']) !!}
</div>

<div class="form-group">
    <a href="{{ route('dashboard.kategori') }}" class="btn btn-default btn-sm">Kembali</a>
    <button type="submit" class="btn btn-primary btn-sm" id="simpan">Simpan</button>
</div>

@section('script')
    <script>
        $('#simpan').click(function(){
            var nama_kategori = $("input[name='nama_kategori']").val().trim();

            if(nama_kategori == '')
            {
                alert_custom("Gagal !", "Nama kategori tidak boleh kosong !", "error");
                return false;
            }
        });
    </script>
@endsection