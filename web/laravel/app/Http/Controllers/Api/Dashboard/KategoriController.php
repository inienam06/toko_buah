<?php

namespace App\Http\Controllers\Api\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Config;

use App\Kategori;

class KategoriController extends Controller
{
    private $config;

    function __construct(Config $cfg)
    {
        $this->config = $cfg;
    }

    function index()
    {
        $res['status'] = true;
        $res['code'] = 200;
        $res['message'] = 'Daftar Kategori Buah';
        $res['data'] = Kategori::all();

        return response()->json($res, $res['code']);
    }

    function simpan(Request $req)
    {
        if(Kategori::where('nama_kategori', $req->nama_kategori)->count() > 0)
        {
            $res['status'] = true;
            $res['code'] = 400;
            $res['message'] = 'Kategori buah sudah digunakan';
        }
        else
        {
            $req['created_by'] = $req->author;
            $req['slug'] = str_slug($req->nama_kategori);

            Kategori::create($req->all());

            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Kategori buah berhasil ditambahkan';
        }

        return response()->json($res, $res['code']);
    }

    function ubah($id)
    {
        if(!is_numeric($id) || Kategori::where('id_kategori', $id)->count() < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Kategori buah tidak ditemukan';
        }
        else
        {
            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Data kategori buah';
            $res['data'] = Kategori::find($id);
        }

        return response()->json($res, $res['code']);
    }

    function perbarui($id, Request $req)
    {
        if(!is_numeric($id) || Kategori::where('id_kategori', $id)->count() < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Kategori buah tidak ditemukan';
        }
        else
        {
            if(Kategori::where('nama_kategori', $req->nama_kategori)->whereNotIn('id_kategori', [$id])->count() > 0)
            {
                $res['status'] = true;
                $res['code'] = 400;
                $res['message'] = 'Kategori buah sudah digunakan';
            }
            else
            {
                $req['updated_by'] = $req->author;
                $req['slug'] = str_slug($req->nama_kategori);

                Kategori::find($id)->update($req->all());
    
                $res['status'] = true;
                $res['code'] = 200;
                $res['message'] = 'Kategori buah berhasil diperbarui';
            }
        }

        return response()->json($res, $res['code']);
    }

    function hapus($id)
    {
        if(!is_numeric($id) || Kategori::where('id_kategori', $id)->count() < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Kategori buah tidak ditemukan';
        }
        else
        {
            Kategori::find($id)->delete();

            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Kategori buah berhasil dihapus';
        }

        return response()->json($res, $res['code']);
    }
}
