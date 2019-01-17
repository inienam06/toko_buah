<?php

namespace App\Http\Controllers\Api\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Config;

use App\Admin;

class LoginRegisterController extends Controller
{
    private $config;

    function __construct(Config $cfg) {
        $this->config = $cfg;
    }

    function masuk(Request $req)
    {
        $admin = Admin::where(['email' => $req->email, 'password' => $this->config->encrypt($req->password)]);

        if($admin->count() < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'E-mail atau password salah !';
        }
        else
        {
            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Admin ditemukan';
            $res['data'] = $admin->first();
        }

        return response()->json($res, $res['code']);
    }
}
