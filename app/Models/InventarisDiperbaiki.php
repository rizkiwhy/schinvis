<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class InventarisDiperbaiki extends Model
{
    use HasFactory;

    protected $table = 'inventarisdiperbaiki';

    protected $fillable = [
        'id',
        'inventarisbarang_id',
        'jenispengajuanbarang_id',
        'user_id',
        'statuspengajuan_id',
        'masalah',
        'estimasiperbaikan',
        'mulaiperbaikan',
        'selesaiperbaikan',
        'solusi',
    ];

    public function scopePribadi($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function jenisPengajuanBarang()
    {
        return $this->belongsTo(
            JenisPengajuanBarang::class,
            'jenispengajuanbarang_id',
            'id'
        );
    }

    public function inventarisBarang()
    {
        return $this->belongsTo(
            InventarisBarang::class,
            'inventarisbarang_id',
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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
