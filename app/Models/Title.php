<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    protected $table = 'title';

    protected $fillable = ['nama', 'aktif'];

    function personal()
    {
        return $this->hasMany(Personal::class, 'title_id', 'id');
    }
}
