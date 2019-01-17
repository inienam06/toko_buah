<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

use App\Kategori;

class KategoriController extends Controller
{
    function detail($judul)
    {
        $res['status'] = true;
        $res['code'] = 200;
        $res['message'] = 'Kategori '.$judul;
        $res['data'] = Kategori::with('produk')->where('slug', $judul)->first();

        return response()->json($res, $res['code']);
    }
}
