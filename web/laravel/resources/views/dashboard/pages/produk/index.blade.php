@extends('dashboard.template')

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Produk Buah</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Beranda</a></li>
                <li class="active">Produk Buah</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Daftar Produk Buah
                <div class="panel-action">
                    <a href="{{ route('dashboard.produk.tambah') }}"><i class="ti-plus"></i></a>
                </div>
        </div>

        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                @include('errors.msg')
                <div class="table-responsive">
                    <table class="table table-stripped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="10">No.</th>
                                <th>Nama Produk</th>
                                <th>Nama Kategori</th>
                                <th>Harga</th>
                                <th>Tanggal Dibuat</th>
                                <th>Dibuat Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var data = [{'data': 'no'},
            {'data': 'nama_produk'},
            {'data': 'kategori'},
            {'data': 'harga'},
            {'data': 'created_at'},
            {'data': 'created_by'},
            {'data': 'aksi'}];

            serverSideTable("table", "{{ route('dashboard.produk.datatable') }}", data);
        });
    </script>
@endsection