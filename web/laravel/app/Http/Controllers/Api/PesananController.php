<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Config;

use App\Pesanan;

class PesananController extends Controller
{
    private $config;

    function __construct(Config $cfg)
    {
        $this->config = $cfg;    
    }

    function pesan(Request $req)
    {
        if(Pesanan::where(['id_user' => $req->id_user, 'id_produk' => $req->id_produk])->count() > 0)
        {
            $pesanan = Pesanan::where(['id_user' => $req->id_user, 'id_produk' => $req->id_produk])->first();

            $pesanan->update([
                'kilo' => intval($pesanan->kilo + $req->kilo),
                'total_harga' => intval($pesanan->total_harga + $req->total_harga),
                'updated_by' => $req->nama_user]);
        }
        else
        {
            $req['created_by'] = $req->nama_user;
            $req['updated_by'] = $req->nama_user;

            Pesanan::create($req->all());
        }

        $res['status'] = true;
        $res['code'] = 200;
        $res['message'] = 'Pesanan berhasil ditambahkan, Silahkan cek pesanan anda';

        return response()->json($res, $res['code']);
    }

    function semua_pesanan($id)
    {
        $pesanan = Pesanan::where('id_user', $id);

        if(count($pesanan) < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Pesanan tidak ditemukan !';
            $res['data'] = array();
        }
        else
        {
            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Pesanan anda';
            $res['data'] = $pesanan->with('produk')->get();
        }

        return response()->json($res, $res['code']);
    }

    function detail_pesanan($id, $id_pesanan)
    {
        $pesanan = Pesanan::where(['id_user' => $id, 'id_pesanan' => $id_pesanan]);

        if(count($pesanan) < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Pesanan tidak ditemukan !';
            $res['data'] = array();
        }
        else
        {
            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Pesanan anda';
            $res['data'] = $pesanan->with('produk')->get();
        }

        return response()->json($res, $res['code']);
    }
}
