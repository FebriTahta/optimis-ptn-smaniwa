<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Univ extends Model
{
    use HasFactory;

    protected $fillable = [
        'kota_id',
        'univ_name',
        'univ_alumni'
    ];

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function jurusan()
    {
        return $this->belongsToMany(Jurusan::class);
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
