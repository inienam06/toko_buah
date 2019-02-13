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

    function daftar(Request $req)
    {
        if(User::where('email', $req->email)->count() > 0) {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'E-mail sudah digunakan !';
        } else {
            $req['password'] = $this->config->encrypt($req->password);
            
            User::create($req->all());

            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'User berhasil didaftarkan';
        }

        return response()->json($res);
    }

    function masuk(Request $req)
    {
        $user = User::where(['email' => $req->email, 'password' => $this->config->encrypt($req->password)]);

        if($user->count() < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'E-mail atau password salah !';
        }
        else
        {
            $u = $user->first();

            $u->update(['api_token' => base64_encode(str_random(50))]);

            if($u->verified == 0) 
            {
                $code = int_random(5);

                $u->update(['token_verify' => $code]);

                $res['status'] = true;
                $res['code'] = 403;
                $res['message'] = 'User belum terverifikasi';
                $res['mail'] = sending_mail($req->email, 'Code Verification', 'Your code verification : <b>'.$code.'</b>')->getData();
                $res['data'] = $u;
            }
            else
            {
                $res['status'] = true;
                $res['code'] = 200;
                $res['message'] = 'User ditemukan';
                $res['data'] = $u;
            }
        }

        return response()->json($res);
    }
}
