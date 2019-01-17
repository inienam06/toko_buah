<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'tbl_produk';

    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_kategori', 'nama_produk', 'deskripsi', 'harga', 'foto_produk', 'url_foto', 'slug', 'dilihat', 'created_at', 'created_by', 'updated_at', 'updated_by'
    ];

    function kategori()
    {
        return $this->belongsTo('App\Kategori', 'id_kategori');
    }
}
