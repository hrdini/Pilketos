<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kandidat extends Model
{
    use HasApiTokens , HasFactory;

    protected $table = 'kandidats';

    protected $fillable = [
        'gambar',
        'nama_ketua',
        'ketua_id',
        'nama_wakil',
        'wakil_id',
        'visi',
        'misi',
        'periode',
        'terpilih'
    ];
}
