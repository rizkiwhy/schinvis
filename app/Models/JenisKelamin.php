<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKelamin extends Model
{
    use HasFactory;

    protected $table = 'jeniskelamin';

    function personal()
    {
        return $this->hasMany(Personal::class, 'jeniskelamin_id', 'id');
    }
}
