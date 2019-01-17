<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Config;

use DataTables;
use Session;
use Auth;

use App\Kategori;
use App\Produk;

class KategoriController extends Controller
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
        
        $res = $this->config->get('admin/kategori', getAdminApiToken(session()->get('id_admin')));

    	foreach($res->data as $list)
    	{
    		$rows['no'] = $no++;
            $rows['nama_kategori'] = $list->nama_kategori;
            $rows['created_at'] = date('Y-m-d H:i:s', strtotime($list->created_at));
            $rows['created_by'] = $list->created_by;
            $rows['updated_at'] = date('Y-m-d H:i:s', strtotime($list->updated_at));
            $rows['updated_by'] = $list->updated_by;
            $rows['aksi'] = '<a href="'.route('dashboard.kategori.ubah', $list->id_kategori).'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
            <a href="'.route('dashboard.kategori.hapus', $list->id_kategori).'" class="btn btn-danger btn-sm" onclick="return confirm('."'Apa anda yakin akan menghapus kategori ".$list->nama_kategori."'".')"><i class="fa fa-trash-o"></i></a>';

    		$data[] = $rows;
    	}

    	return DataTables::of($data)->escapeColumns([])->make(true);
    }

    function tambah()
    {
        return view('dashboard.pages.kategori.tambah');
    }

    function simpan(Request $req)
    {
        if(trim($req->nama_kategori) == '' || trim($req->nama_kategori) == null)
        {
            Session::flash('gagal', 'Nama kategori tidak boleh kosong !');

            return redirect()->back();
        }
        else
        {
            $req['author'] = Auth::guard('admin')->user()->nama_lengkap;

            $res = $this->config->post('admin/kategori/simpan', getAdminApiToken(session()->get('id_admin')), $req->all());

            if($res->code != 200)
            {
                Session::flash('gagal', $res->message);

                return redirect()->back()->withInput($req->all());
            }
            else
            {
                Session::flash('sukses', $res->message);

                return redirect()->route('dashboard.kategori');
            }
        }
    }

    function ubah($id)
    {
        $res = $this->config->get('admin/kategori/ubah/'.$id, getAdminApiToken(session()->get('id_admin')));

        if($res->code != 200)
        {
            Session::flash('gagal', $res->message);
            
            return redirect()->back();
        }
        else
        {
            $kategori = $res->data;
            
            return view('dashboard.pages.kategori.ubah', compact('kategori', 'id'));
        }
    }

    function perbarui($id, Request $req)
    {
        if(trim($req->nama_kategori) == '' || trim($req->nama_kategori) == null)
        {
            Session::flash('gagal', 'Nama kategori tidak boleh kosong');

            return redirect()->back();
        }
        else
        {
            $req['author'] = Auth::guard('admin')->user()->nama_lengkap;

            $res = $this->config->post('admin/kategori/perbarui/'.$id, getAdminApiToken(session()->get('id_admin')), $req->all());

            if($res->code != 200)
            {
                Session::flash('gagal', $res->message);

                return redirect()->back()->withInput($req->all());
            }
            else
            {
                Session::flash('sukses', $res->message);

                return redirect()->route('dashboard.kategori');
            }
        }
    }

    function hapus($id)
    {
        $res = $this->config->get('admin/kategori/hapus/'.$id, getAdminApiToken(session()->get('id_admin')));

        if($res->code != 200)
        {
            Session::flash('gagal', $res->message);
            
            return redirect()->back();
        }
        else
        {
            Session::flash('sukses', $res->message);

            return redirect()->route('dashboard.kategori');
        }
    }
}
