<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    const CREATED_AT = 'tanggal_penjualan';
    const UPDATED_AT = null;

    protected $fillable = [
        'total_harga',
        'tanggal_penjualan',
        'id_member',
        'diskon',
        'jumlah_bayar',
        'kembalian'
    ];

    public function detailpenjualan()
    {
        return $this->hasMany(detailpenjualan::class, 'id_penjualan');
    }

    public function member()
    {
        return $this->belongsTo(member::class, 'id_member');
    }
}
