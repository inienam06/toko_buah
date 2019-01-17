<?php

namespace App\Http\Controllers\Api\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Config;

use File;
use Storage;

use App\Kategori;
use App\Produk;

class produkController extends Controller
{
    private $config;
    private $path;
    private $max;

    function __construct(Config $cfg)
    {
        $this->config = $cfg;
        $this->path = 'assets/images/buah';
        $this->max = intval(1024 * 1024 * 5);
    }

    function index()
    {
        $res['status'] = true;
        $res['code'] = 200;
        $res['message'] = 'Daftar Produk Buah';
        $res['data'] = Produk::with('kategori')->get();

        return response()->json($res, $res['code']);
    }

    function simpan(Request $req)
    {
        if(Produk::where('nama_produk', $req->nama_produk)->count() > 0)
        {
            $res['status'] = false;
            $res['code'] = 401;
            $res['message'] = 'Nama produk sudah digunakan';
        }
        else
        {
            if(!empty($req->foto) || !empty($req->hasFile('foto')))
            {
                if($req->from == 'web')
                {
                    try {
                        $exp_nama = explode(' ', $req->nama_produk);
    
                        $nama = strtolower($exp_nama[0]).'_'.time().'.'.$req->foto['mime'];
    
                        $req['foto_produk'] = $nama;
                        $req['url_foto'] = $this->path.'/';
    
                        Storage::disk('buah')->put($nama, file_get_contents($req->foto['name']));
                    } catch (\Throwable $th) {
                        $res['error'] = $th->getMessage();
                    }
                }
                else
                {
                    $file = $req->file('foto');

                    if($file->getClientSize() > $this->max)
                    {
                        return response()->json(['status' => false, 'code' => 400, 'message' => 'Foto Maksimal 5MB']);
                    }
                    else
                    {
                        $exp_nama = explode(' ', $req->nama_produk);

                        $nama = strtolower($exp_nama[0]).'_'.time().'.'.$file->getClientOriginalExtension();

                        $req['foto_produk'] = $nama;
                        $req['url_foto'] = 'assets/images/buah/';

                        $file->move($this->path, $nama);
                    }
                }
            }

            $req['created_by'] = $req->author;
            $req['slug'] = str_slug($req->nama_produk);
            $req['harga'] = str_replace(',', '', $req->harga);
        
            Produk::create($req->all());

            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Produk buah berhasil ditambahkan';
            $res['req'] = $req->foto;
        }

        return response()->json($res, $res['code']);
    }

    function ubah($judul)
    {
        if(Produk::where('slug', $judul)->count() < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Produk buah tidak ditemukan';
        }
        else
        {
            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Data produk buah';
            $res['data'] = Produk::where('slug', $judul)->first();
        }

        return response()->json($res, $res['code']);
    }

    function perbarui($judul, Request $req)
    {
        if(Produk::where('slug', $judul)->count() < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Produk buah tidak ditemukan';
        }
        else
        {
            if(Produk::where('nama_produk', $req->nama_produk)->whereNotIn('slug', [$judul])->count() > 0)
            {
                $res['status'] = false;
                $res['code'] = 401;
                $res['message'] = 'Nama produk sudah digunakan';
            }
            else
            {
                $produk = Produk::where('slug', $judul)->first();

                $old_foto = $produk->foto_produk;
                $old_path = $produk->url_foto;

                if(!empty($req->foto) || !empty($req->hasFile('foto')))
                {
                    File::delete($old_path.$old_foto);
                    
                    if($req->from == 'web')
                    {
                        try {
                            $exp_nama = explode(' ', $req->nama_produk);
        
                            $nama = strtolower($exp_nama[0]).'_'.time().'.'.$req->foto['mime'];
        
                            $req['foto_produk'] = $nama;
                            $req['url_foto'] = $this->path.'/';
        
                            Storage::disk('buah')->put($nama, file_get_contents($req->foto['name']));
                        } catch (\Throwable $th) {
                            $res['error'] = $th->getMessage();
                        }
                    }
                    else
                    {
                        $file = $req->file('foto');

                        if($file->getClientSize() > $this->max)
                        {
                            return response()->json(['status' => false, 'code' => 400, 'message' => 'Foto Maksimal 5MB']);
                        }
                        else
                        {
                            $exp_nama = explode(' ', $req->nama_produk);

                            $nama = strtolower($exp_nama[0]).'_'.time().'.'.$file->getClientOriginalExtension();

                            $req['foto_produk'] = $nama;
                            $req['url_foto'] = 'assets/images/buah/';

                            $file->move($this->path, $nama);
                        }
                    }
                }
                
                $req['updated_by'] = $req->author;
                $req['slug'] = str_slug($req->nama_produk);
                $req['harga'] = str_replace(',', '', $req->harga);
            
                $produk->update($req->all());

                $res['status'] = true;
                $res['code'] = 200;
                $res['message'] = 'Produk buah berhasil diperbarui';
            }
        }

        return response()->json($res, $res['code']);
    }

    function hapus($judul)
    {
        if(Produk::where('slug', $judul)->count() < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Produk buah tidak ditemukan';
        }
        else
        {
            $produk = Produk::where('slug', $judul)->first();

            if(!empty($produk->foto_produk) || !empty($produk->url_foto))
            {
                File::delete($produk->url_foto.$produk->foto_produk);
            }

            $produk->delete();

            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Produk buah berhasil dihapus';
        }

        return response()->json($res, $res['code']);
    }
}
