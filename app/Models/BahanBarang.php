<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBarang extends Model
{
    use HasFactory;

    protected $table = 'bahanbarang';

    public function inventarisBarang()
    {
        return $this->hasMany(InventarisBarang::class, 'inventarisbarang_id', 'id');
    }

}
