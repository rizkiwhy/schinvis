<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    protected $table = 'personal';

    protected $fillable = ['user_id', 'noinduk', 'tanggallahir', 'jeniskelamin_id', 'title_id', 'agama_id', 'notelepon'];

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_id', 'id');
    }
    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class, 'jeniskelamin_id', 'id');
    }
    public function title()
    {
        return $this->belongsTo(Title::class, 'title_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

