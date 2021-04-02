<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangBarang extends Model
{
    use HasFactory;

    protected $table = 'bidangbarang';

    protected $fillable = ['id', 'nama', 'golonganbarang_id'];

    public function golonganBarang()
    {
        return $this->belongsTo(
            GolonganBarang::class,
            'golonganbarang_id',
            'id'
        );
    }
    public function kelompokBarang()
    {
        return $this->hasMany(KelompokBarang::class, 'kelompokbarang_id', 'id');
    }
}
