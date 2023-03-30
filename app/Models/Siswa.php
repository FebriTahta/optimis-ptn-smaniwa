<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    // protected $table = 'siswa';
    // protected $fillable = [
    //     'name',
    //     'c_siswa',
    //     'c_kelas',
    //     'nisn',
    //     'nama',
    //     'jk',
    //     'alamat',
    //     'tl'
    // ];
    protected $fillable = [
        'user_id',
        'angkatan',
        // 'kelas_id',
        'nama_kelas',
        'jurusan_kelas',
        // 'tipekelas_id',
        'kota',
        'siswa_name',
        'siswa_nisn',
        'siswa_ranking',
        'siswa_sertifikat',
        'siswa_nilai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function tipekelas()
    {
        return $this->belongsTo(Tipekelas::class);
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function pilih()
    {
        return $this->hasMany(Pilih::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);
    }
}
