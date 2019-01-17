<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class Config extends Controller
{
    private static $OPENSSL_CIPHER_NAME = "aes-128-cbc"; //Name of OpenSSL Cipher 
    private static $CIPHER_KEY_LEN = 16; //128 bits
    private static $dataIvKey = "abdulrohman";

    private $url = 'http://localhost/project/toko_buah/api/';
    private $apikey = '3NbeKqHdqRCsxL+i+HlsKA==:YWJkdWxyb2htYW4wMDAwMA==';

    public static function encrypt($data) {
        if (strlen(Config::$dataIvKey) < Config::$CIPHER_KEY_LEN) {
            Config::$dataIvKey = str_pad(Config::$dataIvKey, Config::$CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen(Config::$dataIvKey) > Config::$CIPHER_KEY_LEN) {
            Config::$dataIvKey = substr($str, 0, Config::$CIPHER_KEY_LEN); //truncate to 16 bytes
        }

        $encodedEncryptedData = base64_encode(openssl_encrypt($data, Config::$OPENSSL_CIPHER_NAME, Config::$dataIvKey, OPENSSL_RAW_DATA, Config::$dataIvKey));
        $encodedIV = base64_encode(Config::$dataIvKey);
        $encryptedPayload = $encodedEncryptedData.":".$encodedIV;

        return $encryptedPayload;

    }

    public static function decrypt($data) {
        if (strlen(Config::$dataIvKey) < Config::$CIPHER_KEY_LEN) {
            Config::$dataIvKey = str_pad(Config::$dataIvKey, Config::$CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen(Config::$dataIvKey) > Config::$CIPHER_KEY_LEN) {
            Config::$dataIvKey = substr($str, 0, Config::$CIPHER_KEY_LEN); //truncate to 16 bytes
        }

        $parts = explode(':', $data); //Separate Encrypted data from iv.
        if(!preg_match('/:/', $data))
        {
            $decryptedData = false;
        }
        else
        {
            $decryptedData = openssl_decrypt(base64_decode($parts[0]), Config::$OPENSSL_CIPHER_NAME, Config::$dataIvKey, OPENSSL_RAW_DATA, base64_decode($parts[1]));
        }

        return $decryptedData;
    }

    public function by($tipe, $req)
    {
        switch($tipe)
        {
            case 'simpan':
                $req['created_by'] = Auth::guard('admin')->user()->nama_lengkap;
                break;
            
            case 'ubah':
                $req['updated_by'] = Auth::guard('admin')->user()->nama_lengkap;
                break;
        }

        return $req->all();
    }

    public function upload_foto($file, $name)
    {
        $max = intval(1024 * 1024 * 5);

        if(empty($file))
        {
            $res['status'] = false;
            $res['code'] = 201;
            $res['message'] = 'Foto tidak ditemukan !';
        }
        else
        {
            if($file->getClientSize() > $max)
            {
                $res['status'] = false;
                $res['code'] = 203;
                $res['message'] = 'Maksimal Ukuran Foto adalah 5MB !';
            }
            else
            {
                $exp =  explode(' ', $name);
                
                $res['status'] = true;
                $res['code'] = 200;
                $res['message'] = 'Foto berhasil diupload';
                $res['name'] = strtolower($exp[0]).'_'.date('YmdHis').'.'.$file->getClientOriginalExtension();
            }
        }

        return response()->json($res, $res['code']);
    }

    public function get($nextUrl, $auth = null)
    {
        $curl = curl_init();

        if(!empty($auth))
        {
            $params = array(
                'apikey: '.$this->apikey,
                'Authorization: Bearer '.$auth,
                'Content-Type: application/json'
            );
        }
        else
        {
            $params = array(
                'apikey: '.$this->apikey,
                'Content-Type: application/json'
            );
        }

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->url.$nextUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => $params,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }

    public function post($nextUrl, $auth = null, $fields = array(), $fileName = null)
    {
        $curl = curl_init();

        if(!empty($auth))
        {
            $params = array(
                'apikey: '.$this->apikey,
                'Authorization: Bearer '.$auth,
                'Content-Type: application/json',
                'cache-control: no-cache',
                'content-type: multipart/form-data'
            );
        }
        else
        {
            $params = array(
                'apikey: '.$this->apikey,
                'Content-Type: application/json',
                'cache-control: no-cache',
                'content-type: multipart/form-data'
            );
        }

        if(!empty($fileName))
        {
            if(!empty($fields[$fileName]))
            {
                $cFile = new \CURLFile($fields[$fileName]->getPathName(), $fields[$fileName]->getClientOriginalExtension(), $fields[$fileName]->getClientOriginalName());
            
                $fields['from'] = 'web';
                $fields[$fileName] = $cFile;
            }
        }

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->url.$nextUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($fields),
        CURLOPT_HTTPHEADER => $params,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }
}
