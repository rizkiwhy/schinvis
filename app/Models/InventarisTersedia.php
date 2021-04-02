<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisTersedia extends Model
{
    use HasFactory;

    protected $table = 'inventaristersedia';

    protected $fillable = [
        'id',
        'inventarisbarang_id',
        'ruangan_id',
    ];

    public function inventarisBarang()
    {
        return $this->belongsTo(
            InventarisBarang::class,
            'inventarisbarang_id',
            'id'
        );
    }
    public function ruangan()
    {
        return $this->belongsTo(
            Ruangan::class,
            'ruangan_id',
            'id'
        );
    }
}
