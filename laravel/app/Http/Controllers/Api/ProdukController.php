<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Produk;

class ProdukController extends Controller
{
    function produk_detail($judul)
    {
        if(Produk::where('slug', $judul)->count() < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Tidak ada produk';
        }
        else
        {
            $produk = Produk::where('slug', $judul)->with('kategori')->first();

            $produk->update(['dilihat' => intval($produk->dilihat + 1)]);

            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Detail produk';
            $res['data'] = $produk;
        }

        return response()->json($res, $res['code']);
    }
}
