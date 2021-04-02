<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class InventarisDigunakan extends Model
{
    use HasFactory;

    protected $table = 'inventarisdigunakan';

    protected $fillable = [
        'id',
        'inventarisbarang_id',
        'ruangan_id',
        'user_id',
        'jenispenggunaanbarang_id',
        'mulaidigunakan',
        'selesaidigunakan',
        'nopengajuan',
    ];

    public function scopePribadi($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function scopePinjam($query)
    {
        return $query->where('jenispenggunaanbarang_id', 2);
    }

    public function scopeAlatkerja($query)
    {
        return $query->where('jenispenggunaanbarang_id', 1);
    }

    public function scopeBaranghabispakai($query)
    {
        return $query->where('jenispenggunaanbarang_id', 3);
    }

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
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function jenisPenggunaanBarang()
    {
        return $this->belongsTo(
            JenisPenggunaanBarang::class,
            'jenispenggunaanbarang_id',
            'id'
        );
    }
}
