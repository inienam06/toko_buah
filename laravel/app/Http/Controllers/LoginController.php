<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Config;

use Session;

class LoginController extends Controller
{
    private $config;

    function __construct(Config $cfg) {
        $this->config = $cfg;
    }

    function masuk(Request $req)
    {
        $res = $this->config->post('user/masuk', null, $req->all());

        if($res->code == 200)
        {
            $obj['id_user'] = $res->data->id_user;
            $obj['nama_user'] = $res->data->nama_lengkap;
            $obj['email_user'] = $res->data->email;
            $obj['is_loginUser'] = true;

            session($obj);

            return redirect()->route('template');
        }
        else
        {
            return redirect()->back()->withInput($req->all());
        }
    }

    function keluar()
    {
        Session::forget(['id_user', 'nama_user', 'email_user', 'is_loginUser']);

        return redirect()->back();
    }
}
