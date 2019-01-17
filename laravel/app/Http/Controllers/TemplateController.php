<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TemplateController extends Controller
{
    private $config;

    function __construct()
    {
        $this->config = new Config();    
    }

    function index()
    {
        $res = $this->config->get('beranda');

        $populer = $res->data->terpopuler;
        $baru = $res->data->terbaru;

        return view('pages.beranda', compact('populer', 'baru'));
    }

    function pesanan()
    {
        $res = $this->config->get('pesanan/semua/'.session()->get('id_user'), getUserApiToken(session()->get('id_user')));

        return view('pages.pesanan.index', compact('res'));
    }
}
