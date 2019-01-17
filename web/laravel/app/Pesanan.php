<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 't_pesanan';

    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'id_user', 'id_produk', 'kilo', 'total_harga', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'
    ];

    function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id_user');
    }

    function produk()
    {
        return $this->belongsTo('App\Produk', 'id_produk', 'id_produk');
    }
}
