<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $fillable = ['kelas_name'];

    public function detailsiswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
