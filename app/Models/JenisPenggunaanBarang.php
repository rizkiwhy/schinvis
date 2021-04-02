<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPenggunaanBarang extends Model
{
    use HasFactory;

    protected $table = 'jenispenggunaanbarang';

    public function inventarisDigunakan()
    {
        return $this->hasMany(
            InventarisDigunakan::class,
            'id',
            'jenispenggunaabarang_id'
        );
    }
}
