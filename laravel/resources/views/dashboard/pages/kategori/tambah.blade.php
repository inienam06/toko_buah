@extends('dashboard.template')

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tambah Kategori Buah</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Kategori Buah</a></li>
                <li class="active">Tambah Kategori Buah</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Form Tambah</div>

        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                {!! Form::open(['method' => 'POST', 'route' => 'dashboard.kategori.simpan', 'class' => 'form-horizontal']) !!}
                    @include('errors.msg')
                    @include('dashboard.pages.kategori.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection