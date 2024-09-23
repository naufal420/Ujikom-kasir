<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailpenjualan extends Model
{
    use HasFactory;
    protected $table = 'detailpenjualan';
    protected $primaryKey = 'id_detail';
    public $timestamps = false;

    protected $fillable = [
        'id_penjualan',
        'id_product',
        'jumlah_product',
        'sub_total'
    ];

    public function penjualan()
    {
        return $this->belongsTo(penjualan::class, 'id_penjualan');
    }
    public function product()
    {
        return $this->belongsTo(product::class, 'id_product');
    }
}
