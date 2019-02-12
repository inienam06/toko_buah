<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends \Eloquent implements Authenticatable
{
    use AuthenticableTrait;
    
    protected $table = 'tbl_user';

    protected $primaryKey = 'id_user';

    protected $fillable = [
    	'nama_lengkap', 'email', 'password', 'no_handphone', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'lat', 'lng', 'api_token', 'token_firebase', 'token_verify', 'verified', 'remember_token', 'created_at', 'updated_at'
    ];
}
