<?php

namespace App\Http\Controllers\Api\Dashboard;

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

    function pesanan_baru()
    {
        $pesanan = Pesanan::where('status', 0);

        if($pesanan->count() < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Tidak ada pesanan baru';
            $res['data'] = array();
        }
        else
        {
            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Ada '.$pesanan->count().' pesanan baru';
            $res['data'] = $pesanan->with(['user', 'produk'])->get();
        }

        return response()->json($res);
    }

    function antar_pesanan($id)
    {
        $pesanan = Pesanan::find($id);

        if(count($pesanan) < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Pesanan tidak ditemukan !';
        }
        else
        {
            $pesanan->update(['status' => 1]);

            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Pesanan sedang diantarkan';
        }

        return response()->json($res, $res['code']);
    }

    function pesanan_diantar()
    {
        $pesanan = Pesanan::where('status', 1);

        if($pesanan->count() < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Tidak ada pesanan yang diantar';
            $res['data'] = array();
        }
        else
        {
            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Ada '.$pesanan->count().' pesanan diantar';
            $res['data'] = $pesanan->with(['user', 'produk'])->get();
        }

        return response()->json($res);
    }

    function telah_sampai($id)
    {
        $pesanan = Pesanan::find($id);

        if(count($pesanan) < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Pesanan tidak ditemukan !';
        }
        else
        {
            if($pesanan->status < 1)
            {
                $res['status'] = true;
                $res['code'] = 400;
                $res['message'] = 'Pesanan belum diantar';
            }
            else
            {
                $pesanan->update(['status' => 2]);

                $res['status'] = true;
                $res['code'] = 200;
                $res['message'] = 'Pesanan telah sampai';
            }
        }

        return response()->json($res, $res['code']);
    }
}
