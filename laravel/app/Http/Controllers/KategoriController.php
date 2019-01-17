<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    private $config;

    function __construct()
    {
        $this->config = new Config();    
    }

    function index($judul)
    {
        $res = $this->config->get('kategori/'.$judul);

        if($res->code != 200)
        {
            abort(404);
        }
        else
        {
            $kategori = $res->data;

            return view('pages.kategori.detail', compact('kategori'));
        }
    }
}
