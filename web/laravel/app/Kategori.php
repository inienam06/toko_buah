<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'tbl_kategori';

    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori', 'slug', 'created_at', 'created_by', 'updated_at', 'updated_by'
    ];

    function produk()
    {
        return $this->hasMany('App\Produk', 'id_kategori');
    }
}
