<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPengajuanBarang extends Model
{
    use HasFactory;

    protected $table = 'jenispengajuanbarang';

    public function pengajuanBarang()
    {
        return $this->hasMany(
            PengajuanBarang::class,
            'jenispengajuanbarang_id',
            'id'
        );
    }

    public function inventarisDiperbaiki()
    {
        return $this->hasMany(
            InventarisDiperbaiki::class,
            'jenispengajuanbarang_id',
            'id'
        );
    }
}
