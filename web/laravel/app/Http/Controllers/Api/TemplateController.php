<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Produk;
use App\Kategori;
use App\User;
use App\Http\Controllers\Config;

class TemplateController extends Controller
{
    private $config;

    function __construct(Config $cfg) {
        $this->config = $cfg;
    }

    function index()
    {
        $data['terpopuler'] = Produk::orderBy('dilihat', 'DESC')->get();
        $data['terbaru'] = Produk::orderBy('id_produk', 'DESC')->get();

        $res['status'] = true;
        $res['code'] = 200;
        $res['message'] = 'Data Beranda';
        $res['data'] = $data;

        return response()->json($res);
    }

    function kategori()
    {
        $res['status'] = true;
        $res['code'] = 200;
        $res['message'] = 'Kategori produk';
        $res['data'] = Kategori::select('nama_kategori', 'slug')->orderBy('nama_kategori', 'ASC')->get();

        return response()->json($res);
    }
}
