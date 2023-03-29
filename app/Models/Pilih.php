<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilih extends Model
{
    use HasFactory;

    protected $fillable = [
        'univ_id',
        'jurusan_id',
        'siswa_id'
    ];

    public function univ()
    {
        return $this->belongsTo(Univ::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
