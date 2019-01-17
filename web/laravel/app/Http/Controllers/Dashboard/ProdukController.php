<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Config;

use DataTables;
use Session;
use File;
use Storage;
use Auth;

use App\Produk;
use App\Kategori;

class ProdukController extends Controller
{
    private $config;

    function __construct(Config $cfg)
    {
        $this->config = $cfg;
    }

    function datatable()
    {
    	$data = array();
        $no = 1;
        
        $res = $this->config->get('admin/produk', getAdminApiToken(session()->get('id_admin')));

    	foreach($res->data as $list)
    	{
    		$rows['no'] = $no++;
            $rows['nama_produk'] = $list->nama_produk;
            $rows['kategori'] = $list->kategori->nama_kategori;
            $rows['harga'] = 'Rp. '.number_format($list->harga, 2);
            $rows['created_at'] = date('Y-m-d H:i:s', strtotime($list->created_at));
            $rows['created_by'] = $list->created_by;
            $rows['aksi'] = '<a href="'.route('dashboard.produk.ubah', $list->slug).'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
            <a href="'.route('dashboard.produk.hapus', $list->slug).'" class="btn btn-danger btn-sm" onclick="return confirm('."'Apa anda yakin akan menghapus produk ".$list->nama_produk."'".')"><i class="fa fa-trash-o"></i></a>';

    		$data[] = $rows;
    	}

    	return DataTables::of($data)->escapeColumns([])->make(true);
    }

    function tambah()
    {
        $kategori = Kategori::pluck('nama_kategori', 'id_kategori');

        return view('dashboard.pages.produk.tambah', compact('kategori'));
    }

    function simpan(Request $req)
    {
        if(trim($req->nama_produk) == '' || $req->id_kategori == '' || $req->kategori == '-- Pilih Kategori --' || $req->harga == '')
        {
            Session::flash('gagal', 'Data produk belum lengkap !');

            return redirect()->back()->withInput($req->all());
        }
        else
        {
            if(Produk::where('nama_produk', $req->nama_produk)->count() > 0)
            {
                Session::flash('gagal', 'Nama produk sudah digunakan !');

                return redirect()->back()->withInput($req->all());
            }
            else
            {
                $req['author'] = Auth::guard('admin')->user()->nama_lengkap;

                $res = $this->config->post('admin/produk/simpan', getAdminApiToken(session()->get('id_admin')), $req->all(), 'foto');

                if($res->code != 200)
                {
                    Session::flash('gagal', $res->message);

                    return redirect()->back()->withInput($req->all());
                }
                else
                {
                    Session::flash('sukses', $res->message);

                    return redirect()->route('dashboard.produk');
                }
            }
        }
    }

    function ubah($title)
    {
        $res = $this->config->get('admin/produk/ubah/'.$title, getAdminApiToken(session()->get('id_admin')));

        if($res->code != 200)
        {
            Session::flash('gagal', $res->message);

            return redirect()->back();
        }
        else
        {
            $produk = $res->data;
            $kategori = Kategori::pluck('nama_kategori', 'id_kategori');

            return view('dashboard.pages.produk.ubah', compact('produk', 'title', 'kategori'));
        }
    }

    function perbarui($title, Request $req)
    {
        if(trim($req->nama_produk) == '' || $req->id_kategori == '' || $req->kategori == '-- Pilih Kategori --' || $req->harga == '')
        {
            Session::flash('gagal', 'Data produk belum lengkap !');

            return redirect()->back()->withInput($req->all());
        }
        else
        {
            $req['author'] = Auth::guard('admin')->user()->nama_lengkap;

            $res = $this->config->post('admin/produk/perbarui/'.$title, getAdminApiToken(session()->get('id_admin')), $req->all(), 'foto');

            if($res->code != 200)
            {
                Session::flash('gagal', $res->message);

                return redirect()->back()->withInput($req->all());
            }
            else
            {
                Session::flash('sukses', $res->message);

                return redirect()->route('dashboard.produk');
            }
        }
    }

    function hapus($title)
    {
        $res = $this->config->get('admin/produk/hapus/'.$title, getAdminApiToken(session()->get('id_admin')));

        if($res->code != 200)
        {
            Session::flash('gagal', $res->message);
        }
        else
        {
            Session::flash('sukses', $res->message);
        }

        return redirect()->route('dashboard.produk');
    }
}
