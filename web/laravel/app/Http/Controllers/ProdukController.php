<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    private $config;

    function __construct()
    {
        $this->config = new Config();    
    }

    function produk_detail($judul)
    {
        $res = $this->config->get('produk/'.$judul);

        if($res->code != 200)
        {
            abort(404);
        }
        else
        {
            $produk = $res->data;

            return view('pages.produk.detail', compact('produk'));
        }
    }
}
