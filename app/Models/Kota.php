<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $fillable = [
        'provinsi_id',
        'kota_name'
    ];

    public function detailsiswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function univ()
    {
        return $this->hasMany(Univ::class);
    }
}
