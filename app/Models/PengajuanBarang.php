<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBarang extends Model
{
    use HasFactory;

    protected $table = 'pengajuanbarang';

    protected $fillable = [
        'id',
        'user_id',
        'jenispengajuanbarang_id',
        'subsubkelompokbarang_id',
        'statuspengajuan_id',
        'jumlahbarang',
        'estimasipenggunaan',
        'keterangan',
    ];

    public function scopeDalamantrian($query)
    {
        return $query->where('statuspengajuan_id', 1);
    }

    public function scopePengajuanbarang($query)
    {
        return $query->where('jenispengajuanbarang_id', 1);
    }

    public function scopePengajuanpinjam($query)
    {
        return $query->where('jenispengajuanbarang_id', 2);
    }

    public function scopePengajuanbaranghabispakai($query)
    {
        return $query->where('jenispengajuanbarang_id', 3);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function jenisPengajuanBarang()
    {
        return $this->belongsTo(
            JenisPengajuanBarang::class,
            'jenispengajuanbarang_id',
            'id'
        );
    }

    public function subSubKelompokBarang()
    {
        return $this->belongsTo(
            SubSubKelompokBarang::class,
            'subsubkelompokbarang_id',
            'id'
        );
    }

    public function statusPengajuan()
    {
        return $this->belongsTo(
            StatusPengajuan::class,
            'statuspengajuan_id',
            'id'
        );
    }
}
