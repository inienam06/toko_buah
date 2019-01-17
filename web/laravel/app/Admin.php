<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Admin extends \Eloquent implements Authenticatable
{
    use AuthenticableTrait;

    protected $table = 'tbl_admin';

    protected $primaryKey = 'id_admin';

    protected $fillable = [
    	'nama_lengkap', 'email', 'password', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'is_superadmin', 'api_token', 'remember_token', 'created_at', 'updated_at'
    ];
}
