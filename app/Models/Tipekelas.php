<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipekelas extends Model
{
    use HasFactory;
    protected $fillable = ['tipekelas_name'];

    public function detailsiswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
