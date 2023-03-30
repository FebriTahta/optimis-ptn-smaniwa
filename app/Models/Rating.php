<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'siswa_id',
        'univ_id',
        'jurusan_id',
        'kelas',
        'jurusan',
        'angkatan',
        'akreditasi',
        'kkm',
        'nilai',
        'ranking',
        'sertifikat',
        'linjur',
        'domisili',
        'alumni',
        'score'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function univ()
    {
        return $this->belongsTo(Univ::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
