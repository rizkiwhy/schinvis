<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GolonganBarang extends Model
{
    use HasFactory;

    protected $table = 'golonganbarang';

    protected $fillable = ['nama'];

    public function bidangBarang()
    {
        return $this->hasMany(BidangBarang::class, 'gedung_id', 'id');
    }
}
