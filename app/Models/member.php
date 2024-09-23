<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    use HasFactory;
    protected $table = 'member';
    protected $primaryKey = 'id_member';
    protected $fillable = ['Nama_member', 'Alamat', 'No_telepon', 'tanggal_input'];
    const CREATED_AT = 'tanggal_input';
    const UPDATED_AT = null;

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'id_member');
    }
}
