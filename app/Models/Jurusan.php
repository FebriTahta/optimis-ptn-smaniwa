<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jurusan_name'
    ];

    public function univ()
    {
        return $this->belongsToMany(Univ::class);
    }

    public function pilih()
    {
        return $this->hasMany(Pilih::class);
    }
}
