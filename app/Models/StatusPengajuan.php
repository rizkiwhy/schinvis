<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPengajuan extends Model
{
    use HasFactory;

    protected $table = 'statuspengajuan';

    public function pengajuanBarang()
    {
        return $this->hasMany(
            PengajuanBarang::class,
            'statuspengajuan_id',
            'id'
        );
    }
}
