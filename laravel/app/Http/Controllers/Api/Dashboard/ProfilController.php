<?php

namespace App\Http\Controllers\Api\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Config;

class ProfilController extends Controller
{
    private $config;

    function __construct(Config $cfg)
    {
        $this->config = $cfg;
    }

    function profil($id) 
    {
        $admin = getAdminFromId($id);

        if(count($admin) < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Profil admin tidak ditemukan !';
        }
        else
        {
            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Profil admin';
            $res['data'] = $admin;
        }

        return response()->json($res, $res['code']);
    }

    function perbarui($id, Request $req)
    {
        $admin = getAdminFromId($id);

        if(count($admin) < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Data admin tidak ditemukan !';
        }
        else
        {
            $admin->update($req->all());

            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'Profil berhasil diperbarui';
        }

        return response()->json($res, $res['code']);
    }

    function perbarui_password($id, Request $req)
    {
        $admin = getAdminFromId($id);

        if(count($admin) < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'Data admin tidak ditemukan !';   
        }
        else
        {
            $res['status'] = true;

            if($this->config->encrypt($req->password) != $admin->password)
            {
                $res['code'] = 500;
                $res['message'] = 'Password lama salah !';
            }
            else
            {
                if($req->konfirmasi_password != $req->password_baru)
                {
                    $res['code'] = 500;
                    $res['message'] = 'Konfirmasi password salah !';
                }
                else
                {
                    $admin->update([
                        'password' => $this->config->encrypt($req->password_baru)
                    ]);

                    $res['code'] = 200;
                    $res['message'] = 'Password berhasil diperbarui';
                }
            }
        }

        return response()->json($res, $res['code']);
    }
}
