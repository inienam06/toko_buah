@extends('dashboard.template')

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pesanan Diantar</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Beranda</a></li>
                <li class="active">Pesanan Diantar</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Daftar Pesanan
        </div>

        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                @include('errors.msg')
                <div class="table-responsive">
                    <table class="table table-stripped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="10">No.</th>
                                <th>Nama User</th>
                                <th>Nama Produk</th>
                                <th width="10">Berat</th>
                                <th>Total Harga</th>
                                <th>Tanggal Dibuat</th>
                                <th width="50">Aksi</th>
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
            {'data': 'user'},
            {'data': 'produk'},
            {'data': 'kilo'},
            {'data': 'total_harga'},
            {'data': 'created_at'},
            {'data': 'aksi'}];

            serverSideTable("table", "{{ route('dashboard.pesanan.diantar.datatable') }}", data);
        });

        function telah_sampai(id, nama)
        {
            var data = {
                'id': id,
                'url': '{{ route("dashboard.pesanan.diantar") }}',
                'auth': 'Bearer {{ getAdminApiToken(session()->get("id_admin")) }}'
            };

            confirm_custom('Pesanan telah sampai kepada customer '+nama, 2, data);
        }
    </script>
@endsection