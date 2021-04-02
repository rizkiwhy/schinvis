<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkuranBarang extends Model
{
    use HasFactory;

    protected $table = 'ukuranbarang';

    public function inventarisBarang()
    {
        return $this->hasMany(InventarisBarang::class, 'ukuranbarang_id', 'id');
    }
}
