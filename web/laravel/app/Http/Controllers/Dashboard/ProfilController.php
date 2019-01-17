<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Config;

use Session;
use Auth;

use App\Admin;

class ProfilController extends Controller
{
    private $config;

    function __construct(Config $cfg)
    {
        $this->config = $cfg;
    }

    function profil(Request $req)
    {
        $res = $this->config->post('admin/profil/'.session()->get('id_admin').'/perbarui', getAdminApiToken(session()->get('id_admin')), $req->all());
        
        session()->put('nama_admin', $req->nama_lengkap);

    	Session::flash('sukses', $res->message);

    	return redirect()->back()->withInput($req->all());
    }

    function ubah_password(Request $req)
    {
        $res = $this->config->post('admin/profil/'.session()->get('id_admin').'/perbarui-password', getAdminApiToken(session()->get('id_admin')), $req->all());

        if($res->code != 200)
        {
            Session::flash('gagal', $res->message);
        }
        else
        {
            Session::flash('sukses', $res->message);
        }

        return redirect()->back();
    }
}
