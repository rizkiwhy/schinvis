<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiBarang extends Model
{
    use HasFactory;

    protected $table = 'kondisibarang';

    public function inventarisBarang()
    {
        return $this->hasMany(
            InventarisBarang::class,
            'kondisibarang_id',
            'id'
        );
    }
}
