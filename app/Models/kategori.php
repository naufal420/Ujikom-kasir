<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = "id_kategori";
    protected $fillable = ['nama_kategori'];
    public $timestamps = false;
    public function product()
    {
        return $this->hasMany(product::class, 'id_kategori');
    }
}
