<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $table = 'gedung';

    protected $fillable = ['nama', 'kode','kelompok'];

    public function ruangan()
    {
        return $this->hasMany(Ruangan::class, 'gedung_id', 'id');
    }
}
