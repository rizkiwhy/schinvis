<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisBarang extends Model
{
    use HasFactory;

    protected $table = 'inventarisbarang';

    protected $fillable = [
        'id',
        'subsubkelompokbarang_id',
        'noregister',
        'merekmodel',
        'noseri',
        'ukuran',
        'ukuranbarang_id',
        'bahanbarang_id',
        'tahunpembuatan',
        'tanggalpembelian',
        'kondisibarang_id',
        'statusbarang_id',
    ];

    public function scopeTersedia($query)
    {
        return $query->where('statusbarang_id', 1);
    }

    public function subSubKelompokBarang()
    {
        return $this->belongsTo(
            SubSubKelompokBarang::class,
            'subsubkelompokbarang_id',
            'id'
        );
    }

    public function ukuranBarang()
    {
        return $this->belongsTo(UkuranBarang::class, 'ukuranbarang_id', 'id');
    }

    public function bahanBarang()
    {
        return $this->belongsTo(BahanBarang::class, 'bahanbarang_id', 'id');
    }

    public function kondisiBarang()
    {
        return $this->belongsTo(KondisiBarang::class, 'kondisibarang_id', 'id');
    }

    public function statusBarang()
    {
        return $this->belongsTo(StatusBarang::class, 'statusbarang_id', 'id');
    }

    public function inventarisDigunakan()
    {
        return $this->hasOne(
            InventarisDigunakan::class,
            'inventarisbarang_id',
            ' id'
        );
    }
}
