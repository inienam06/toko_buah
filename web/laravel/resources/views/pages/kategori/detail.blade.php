@extends('template')

@section('content')
<div class="panel no-border kategori with-shadow">
    <div class="panel-heading">
        Kategori : {{ $kategori->nama_kategori }}
    </div>

    <div class="panel-body">
        @if (count($kategori->produk) < 1)
            <p class="text-muted text-center"><i>Tidak ada produk dalam kategori <b>{{ $kategori->nama_kategori }}</b> !</i></p>
        @else
            @foreach ($kategori->produk as $list)
                <div class="col-md-3">
                    <div class="thumbnail no-border">
                        <img class="img-responsive" src="{{ asset((!empty($list->url_foto) && !empty($list->foto_produk)) ? $list->url_foto.$list->foto_produk : 'assets/images/buah/no-image.jpg') }}">
                        <div class="caption">
                            <a href="{{ route('produk_detail', $list->slug) }}">{{ $list->nama_produk }}</a>
                            <p class="harga">Rp. {{ number_format($list->harga, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection