<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Controllers\Config;

class AkunController extends Controller
{
    private $config;

    function __construct(Config $cfg) {
        $this->config = $cfg;
    }

    function update_firebase(Request $req)
    {
        if(empty(getUserFromId($req->id_user)))
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'User tidak ditemukan';
        }
        else
        {
            getUserFromId($req->id_user)->update(['token_firebase' => $req->token]);

            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Firebase telah diperbarui';
        }

        return response()->json($res, $res['code']);
    }
}
