<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasApiTokens , HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'nama',
        'nip',
        'status_pilih'
    ];
}
