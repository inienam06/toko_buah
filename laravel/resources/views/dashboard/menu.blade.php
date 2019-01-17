<li> <a href="{{ route('dashboard') }}" class="waves-effect {{ (empty(Request::segment(2))) ? 'active' : '' }}"><i class="mdi mdi-home fa-fw"></i> <span class="hide-menu"> Beranda</span></a></li>
<li class="{{ (Request::segment(2) == 'kategori' || Request::segment(2) == 'produk') ? 'active' : '' }}"> <a href="javascript:void(0)" class="waves-effect {{ (Request::segment(2) == 'kategori' || Request::segment(2) == 'produk') ? 'active' : '' }}"><i class="mdi mdi-book-open-variant fa-fw"></i><span class="hide-menu"> Master Data<span class="fa arrow"></span></span></a>
    <ul class="nav nav-second-level">
        <li><a href="{{ route('dashboard.kategori') }}" class="{{ (Request::segment(2) == 'kategori') ? 'active' : '' }}"><i class="fa fa-circle-o fa-fw"></i><span class="hide-menu"> Kategori</span></a></li>
        <li><a href="{{ route('dashboard.produk') }}" class="{{ (Request::segment(2) == 'produk') ? 'active' : '' }}"><i class="fa fa-circle-o fa-fw"></i><span class="hide-menu"> Produk Buah</span></a></li>
    </ul>
</li>

<li role="separator" class="divider"></li>

<li class="{{ (Request::segment(2) == 'pesanan') ? 'active' : '' }}"> <a href="javascript:void(0)" class="waves-effect {{ (Request::segment(2) == 'pesanan') ? 'active' : '' }}"><i class="mdi mdi-clipboard-text fa-fw"></i><span class="hide-menu"> Pesanan<span class="fa arrow"></span></span></a>
    <ul class="nav nav-second-level">
        <li><a href="{{ route('dashboard.pesanan.baru') }}" class="{{ (Request::segment(3) == 'baru') ? 'active' : '' }}"><i class="fa fa-circle-o fa-fw"></i><span class="hide-menu"> Baru</span></a></li>
        <li><a href="{{ route('dashboard.pesanan.diantar') }}" class="{{ (Request::segment(3) == 'sedang-diantar') ? 'active' : '' }}"><i class="fa fa-circle-o fa-fw"></i><span class="hide-menu"> Sedang Diantar</span></a></li>
    </ul>
</li>