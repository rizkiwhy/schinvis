<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubKelompokBarang extends Model
{
    use HasFactory;

    protected $table = 'subsubkelompokbarang';

    protected $fillable = ['id', 'nama', 'subkelompokbarang_id'];

    public function subKelompokBarang()
    {
        return $this->belongsTo(
            SubKelompokBarang::class,
            'subkelompokbarang_id',
            'id'
        );
    }
}
