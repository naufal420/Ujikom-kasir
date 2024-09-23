<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'id_product';
    protected $fillable = ['nama_product', 'harga', 'stock', 'id_kategori', 'tanggal_input'];
    const CREATED_AT = 'tanggal_input';
    const UPDATED_AT = null;

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'id_kategori');
    }
}
