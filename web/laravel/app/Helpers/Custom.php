<?php

use App\Admin;
use App\User;

function getBaseUrlApi()
{
    return url('api').'/';
}

function getApiKey()
{
    return '3NbeKqHdqRCsxL+i+HlsKA==:YWJkdWxyb2htYW4wMDAwMA==';
}

function getAdminFromId($id)
{
    return Admin::find($id);
}

function getAdminApiToken($id)
{
    try {
        return getAdminFromId($id)->api_token;
    } catch (\Throwable $th) {
        return null;
    }
}

function getUserFromId($id)
{
    return User::find($id);
}

function getUserApiToken($id)
{
    try {
        return getUserFromId($id)->api_token;
    } catch (\Throwable $th) {
        return null;
    }
}

function int_random($max)
{
    $alphabet = "0123456789";
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 1; $i <= $max; $i++) {
        $n = rand(1, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    $password =  implode($pass);

    return $password;
}

function custom_crypt($code, $data)
{
    $ivKey = 'abdulrohman';
    $chiperKey = 16;
    $chiperName = 'aes-128-cbc';
    $result = null;

    switch($code)
    {
        case 0:
            if (strlen($ivKey) < $chiperKey) {
                $ivKey = str_pad($ivKey, $chiperKey, "0"); //0 pad to len 16
            } else if (strlen($ivKey) > $chiperKey) {
                $ivKey = substr($str, 0, $chiperKey); //truncate to 16 bytes
            }

            $encodedEncryptedData = base64_encode(openssl_encrypt($data, $chiperName, $ivKey, OPENSSL_RAW_DATA, $ivKey));
            $encodedIV = base64_encode($ivKey);
            $encryptedPayload = $encodedEncryptedData.":".$encodedIV;

            $result = $encryptedPayload;
            break;

        case 1:
            if (strlen($ivKey) < $chiperKey) {
                $ivKey = str_pad($ivKey, $chiperKey, "0"); //0 pad to len 16
            } else if (strlen($ivKey) > $chiperKey) {
                $ivKey = substr($str, 0, $chiperKey); //truncate to 16 bytes
            }

            $parts = explode(':', $data); //Separate Encrypted data from iv.
            if(!preg_match('/:/', $data))
            {
                $decryptedData = null;
            }
            else
            {
                $decryptedData = openssl_decrypt(base64_decode($parts[0]), $chiperName, $ivKey, OPENSSL_RAW_DATA, base64_decode($parts[1]));
            }

            $result = $decryptedData;
            break;

        default:
            $result = null;
            break;
    }
    
    return $result;
}

function getDataFromUri($uri, $auth)
{
    $curl = curl_init();

    if(!empty($auth))
    {
        $params = array(
            'apikey: '. getApiKey(),
            'Authorization: Bearer '.$auth,
            'Content-Type: application/json'
        );
    }
    else
    {
        $params = array(
            'apikey: '. getApiKey(),
            'Content-Type: application/json'
        );
    }

    curl_setopt_array($curl, array(
    CURLOPT_URL => getBaseUrlApi().$uri,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 60,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => $params,
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        $result[] = array(
            'status' => true,
            'code' => 500,
            'message' => $err
        );

        $res = json_encode($result);
        
    } else {
        $res = json_decode($response);
    }

    return $res;
}

function sentDataToUri($uri, $auth, $fields)
{
    $curl = curl_init();

    if(!empty($auth))
    {
        $params = array(
            'apikey: ' . getApiKey(),
            'Authorization: Bearer '.$auth,
            'Content-Type: application/json',
            'cache-control: no-cache',
            'content-type: multipart/form-data'
        );
    }
    else
    {
        $params = array(
            'apikey: ' . getApiKey(),
            'Content-Type: application/json',
            'cache-control: no-cache',
            'content-type: multipart/form-data'
        );
    }

    curl_setopt_array($curl, array(
    CURLOPT_URL => getBaseUrlApi().$uri,
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
        $result[] = array(
            'status' => true,
            'code' => 500,
            'message' => $err
        );

        $res = json_encode($result);
        
    } else {
        $res = json_decode($response);
    }

    return $res;
}