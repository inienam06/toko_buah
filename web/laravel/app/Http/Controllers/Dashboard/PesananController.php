<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Config;

use Auth;
use DataTables;

class PesananController extends Controller
{
    private $config;

    function __construct(Config $cfg)
    {
        $this->config = $cfg;
    }

    function datatable_baru()
    {
    	$data = array();
        $no = 1;
        
        $res = $this->config->get('admin/pesanan/baru', getAdminApiToken(session()->get('id_admin')));

    	foreach($res->data as $list)
    	{
            $confirm = "antarkan(".$list->id_pesanan.", '".$list->produk->nama_produk."')";
            
            $rows['no'] = $no++;
            $rows['user'] = $list->user->nama_lengkap;
            $rows['produk'] = $list->produk->nama_produk;
            $rows['kilo'] = $list->kilo.' KG';
            $rows['total_harga'] = 'Rp. '.number_format($list->total_harga, 2);
            $rows['created_at'] = date('Y-m-d H:i:s', strtotime($list->created_at));
            $rows['aksi'] = '<button class="btn btn-sm btn-success" onclick="return '.$confirm.'">Antarkan Pesanan</button>';

    		$data[] = $rows;
    	}

    	return DataTables::of($data)->escapeColumns([])->make(true);
    }

    function datatable_diantar()
    {
    	$data = array();
        $no = 1;
        
        $res = $this->config->get('admin/pesanan/sedang-diantar', getAdminApiToken(session()->get('id_admin')));

    	foreach($res->data as $list)
    	{
            $confirm = "telah_sampai(".$list->id_pesanan.", '".$list->user->nama_lengkap."')";
            
            $rows['no'] = $no++;
            $rows['user'] = $list->user->nama_lengkap;
            $rows['produk'] = $list->produk->nama_produk;
            $rows['kilo'] = $list->kilo.' KG';
            $rows['total_harga'] = 'Rp. '.number_format($list->total_harga, 2);
            $rows['created_at'] = date('Y-m-d H:i:s', strtotime($list->created_at));
            $rows['aksi'] = '<button class="btn btn-sm btn-success" onclick="return '.$confirm.'">Telah Sampai</button>';

    		$data[] = $rows;
    	}

    	return DataTables::of($data)->escapeColumns([])->make(true);
    }
}
