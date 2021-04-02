<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;

    protected $table = 'agama';

    public function personal()
    {
        return $this->hasMany(Personal::class, 'agama_id', 'id');
    }
}
