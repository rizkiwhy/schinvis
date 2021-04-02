<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKelompokBarang extends Model
{
    use HasFactory;

    protected $table = 'subkelompokbarang';

    protected $fillable = ['id', 'nama', 'kelompokbarang_id'];

    public function kelompokBarang()
    {
        return $this->belongsTo(
            KelompokBarang::class,
            'kelompokbarang_id',
            'id'
        );
    }

    public function subSubKelompokBarang()
    {
        return $this->hasMany(
            SubSubKelompokBarang::class,
            'subkelompokbarang_id',
            'id'
        );
    }
}
