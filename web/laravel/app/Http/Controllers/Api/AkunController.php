<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Controllers\Config;

class AkunController extends Controller
{
    function daftar(Request $req)
    {
        if(User::where('email', $req->email)->count() > 0) {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'E-mail sudah digunakan !';
        } else {
            $req['password'] = custom_crypt(0, $req->password);
            
            User::create($req->all());

            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = 'User berhasil didaftarkan';
        }

        return response()->json($res);
    }

    function masuk(Request $req)
    {
        $user = User::where(['email' => $req->email, 'password' => custom_crypt(0, $req->password)]);

        if($user->count() < 1)
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'E-mail atau password salah !';
        }
        else
        {
            $u = $user->first();

            $u->update(['api_token' => base64_encode(str_random(50))]);

            if($u->verified == 0) 
            {
                $code = int_random(5);

                $u->update(['token_verify' => $code]);

                $res['status'] = true;
                $res['code'] = 403;
                $res['message'] = 'User belum terverifikasi';
                $res['mail'] = sending_mail($req->email, 'Code Verification', 'Your code verification : <b>'.$code.'</b>')->getData();
                $res['data'] = $u;
            }
            else
            {
                $res['status'] = true;
                $res['code'] = 200;
                $res['message'] = 'User ditemukan';
                $res['data'] = $u;
            }
        }

        return response()->json($res);
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

        return response()->json($res);
    }

    function get_code_confirmation(Request $req)
    {
        $user = getUserFromId($req->id_user);

        if(empty($user))
        {
            $res['status'] = false;
            $res['code'] = 404;
            $res['message'] = 'User tidak ditemukan';
        }
        else
        {
            $res['status'] = true;
            $res['code'] = 200;
            $res['message'] = sending_mail($user->email, 'Code Verification', 'Your code verification : <b>'.$code.'</b>')->getData();
        }

        return response()->json($res);
    }
}
