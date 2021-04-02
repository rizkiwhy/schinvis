<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokBarang extends Model
{
    use HasFactory;

    protected $table = 'kelompokbarang';

    protected $fillable = ['id', 'nama', 'bidangbarang_id'];

    public function bidangBarang()
    {
        return $this->belongsTo(BidangBarang::class, 'bidangbarang_id', 'id');
    }

    public function subKelompokBarang()
    {
        return $this->hasMany(
            SubKelompokBarang::class,
            'subkelompokbarang_id',
            'id'
        );
    }
}
