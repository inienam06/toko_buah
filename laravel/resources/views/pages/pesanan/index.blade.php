@extends('template')

@section('content')
<div class="panel no-border detail-pesanan with-shadow">
    <div class="panel-heading">
        Pesanan Anda
    </div>

    <div class="panel-body">
        @if ($res->code != 200)
            <p class="text-muted text-center"><i>Anda belum memiliki pesanan !</i></p>
        @else
            @foreach ($res->data as $list)
                <div class="panel no-border detail-item with-shadow">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ asset((!empty($list->produk->foto_produk)) ? $list->produk->url_foto.'/'.$list->produk->foto_produk : 'assets/images/buah/no-image.jpg') }}" class="img-responsive">
                        </div>

                        <div class="col-md-10">
                            <h3 class="judul text-primary"><a href="javascript:void(0)" data-toggle="modal" data-target="#m_detailPesanan" data-id="{{ $list->id_pesanan }}">{{ $list->produk->nama_produk }}</a></h3>
                            <p class="harga color-secondary">Rp. {{ number_format($list->total_harga, 2).' - '.$list->kilo.' KG' }}</p>

                            @switch($list->status)
                                @case(0)
                                    <strong class="pull-right text-danger status">Menunggu Konfirmasi</strong>
                                    @break
                                @case(1)
                                    <strong class="pull-right text-warning status">Sedang Diantar</strong>
                                    @break 

                                @case(2)
                                    <strong class="pull-right text-warning status">Barang Sudah Sampai</strong>
                                    @break

                                @case(3)
                                    <strong class="pull-right text-success status">Selesai</strong>
                                    @break 
                            @endswitch
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="m_detailPesanan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail Pesanan</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
    $('#m_detailPesanan').on('show.bs.modal', function(e) {
        var id = $(e.relatedTarget).data('id');
    })
</script>
@endsection