<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Config;

use Session;
use Auth;

use App\Admin;

class LoginController extends Controller
{
	private $config;

    function __construct(Config $cfg)
	{
		$this->config = $cfg;
		if(Session::get('is_loginAdmin'))
		{
			return redirect()->route('dashboard');
		}
	}

	function formLogin()
	{
		return view('dashboard.masuk');
	}

	function masuk(Request $req)
	{
		$res = $this->config->post('admin/masuk', null, $req->all());

        if($res->code == 200)
        {
            $obj['id_admin'] = $res->data->id_admin;
            $obj['nama_admin'] = $res->data->nama_lengkap;
			$obj['email_admin'] = $res->data->email;
			$obj['is_superAdmin'] = $res->data->is_superadmin;
            $obj['is_loginAdmin'] = true;

            session($obj);

            return redirect()->route('dashboard');
        }
        else
        {
			Session::flash('gagal', $res->message);

            return redirect()->back()->withInput($req->all());
        }
	}

	function keluar()
	{
		session()->forget(['id_admin', 'nama_admin', 'email_admin', 'is_superAdmin', 'is_loginAdmin']);

		return redirect()->route('dashboard.masuk');
	}
}
