@extends('dashboard.template')

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tambah Produk Buah</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Produk Buah</a></li>
                <li class="active">Tambah Produk Buah</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Form Tambah</div>

        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                {!! Form::open(['method' => 'POST', 'route' => 'dashboard.produk.simpan', 'class' => 'form-horizontal', 'files' => true]) !!}
                    @include('errors.msg')
                    @include('dashboard.pages.produk.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection