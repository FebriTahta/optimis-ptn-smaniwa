<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'univ_id',
        'jurusan_name'
    ];

    public function univ()
    {
        return $this->belongsTo(Univ::class);
    }
}
