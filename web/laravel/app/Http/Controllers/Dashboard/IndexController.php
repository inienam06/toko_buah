<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Config;

use Auth;

use App\Admin;

class IndexController extends Controller
{
    private $config;

    function __construct(Config $cfg)
    {
        $this->config = $cfg;
    }

    function index()
    {
    	return view('dashboard.pages.beranda');
    }

    function profil()
    {
        $res = $this->config->get('admin/profil/'.session()->get('id_admin'), getAdminApiToken(session()->get('id_admin')));

        $profil = $res->data;

    	return view('dashboard.pages.akun.profil', compact('profil'));
    }

    function ubah_password()
    {
    	return view('dashboard.pages.akun.ubah_password');
    }

    function kategori()
    {
        return view('dashboard.pages.kategori.index');
    }

    function produk()
    {
        return view('dashboard.pages.produk.index');
    }

    function pesanan_baru()
    {
        return view('dashboard.pages.pesanan.baru');
    }

    function pesanan_diantar()
    {
        return view('dashboard.pages.pesanan.diantar');
    }
}
