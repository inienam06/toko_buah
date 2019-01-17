@extends('template')

@section('content')
    <div class="panel no-border terpopuler with-shadow">
        <div class="panel-heading">
            Terpopuler

            @if (count($populer) > 4)
                <a href="" class="pull-right muat-lebih">muat lebih >></a>
            @endif
        </div>
        <div class="panel-body">
            <div class="row">
                @if (count($populer) < 1)
                    <p class="text-center text-muted"><i>Tidak ada produk buah</i></p>
                @else
                    @foreach ($populer as $list)
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
    </div>

    <div class="panel no-border terbaru with-shadow">
        <div class="panel-heading">
            Terbaru

            @if (count($baru) > 4)
                <a href="" class="pull-right muat-lebih">muat lebih >></a>
            @endif
        </div>
        <div class="panel-body">
            <div class="row">
                @if (count($baru) < 1)
                    <p class="text-center text-muted"><i>Tidak ada produk buah</i></p>
                @else
                    @foreach ($baru as $list)
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
    </div>
@endsection