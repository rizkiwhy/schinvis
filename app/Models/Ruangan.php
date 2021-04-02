<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';

    protected $fillable = [
        'gedung_id',
        'nama',
        'luas',
        'koridor_depan',
        'koridor_belakang',
    ];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'gedung_id', 'id');
    }

    public function inventarisDigunakan()
    {
        return $this->hasMany(InventarisDigunakan::class, 'ruangan_id', 'id');
    }
}
